<?php

/**
* FLAG
*   - Not very elegant or dynamic
*/
$urlManipulator = new UrlManipulator();

// Allowed superset file extensions, mapped to their format
$allowedFormats = array();
$temp = $servant->settings()->formats('stylesheets');
unset($temp['css']);
foreach ($temp as $type => $extensions) {
	foreach ($extensions as $extension) {
		$allowedFormats[$extension] = $type;
	}
}
unset($temp, $type, $extensions, $extension);

// All stylesheets go here
$stylesheetSets = array(
	'site' => array('format' => false, 'content' => ''),
	'page' => array('format' => false, 'content' => ''),
);

// We need this for URL manipulations
$actionsPath = $servant->paths()->root('domain');



/**
* Site-wide styles
*
* If SCSS or LESS is used, the first such file determines the type used for the whole set. These cannot be mixed within one set.
*/
foreach ($servant->site()->stylesheets('plain') as $path) {

	// Special format is used
	$extension = pathinfo($path, PATHINFO_EXTENSION);
	if (array_key_exists($extension, $allowedFormats)) {

		// Set's format has not been selected yet, we'll do it now
		if (!$stylesheetSets['site']['format']) {
			$stylesheetSets['site']['format'] = $allowedFormats[$extension];

		// Mixing preprocessor formats will fail
		} else if ($stylesheetSets['site']['format'] !== $allowedFormats[$extension]) {
			fail('CSS preprocessor formats cannot be mixed in assets');
		}

	}
	unset($extension);



	// Root is asset directory root
	$rootUrl = $servant->paths()->assets('domain');

	// We can parse relative path
	$relativeUrl = substr((dirname($path).'/'), strlen($servant->paths()->assets('plain')));

	// Get CSS file contents with URLs replaced
	$stylesheetSets['site']['content'] .= $urlManipulator->cssUrls(file_get_contents($servant->format()->path($path, 'server')), $rootUrl, $relativeUrl, $actionsPath);
}



/**
* Page-specific style files
*
* FLAG
*   - We only want these in read action (we should print this upon request only - needs input support)
*/
foreach ($page->stylesheets('plain') as $path) {

	// A preprocessor format is used
	$extension = pathinfo($path, PATHINFO_EXTENSION);
	if (array_key_exists($extension, $allowedFormats)) {

		// Set's format has not been selected yet, we'll do it now
		if (!$stylesheetSets['page']['format']) {
			$stylesheetSets['page']['format'] = $allowedFormats[$extension];

		// Mixing specia formats will fail
		} else if ($stylesheetSets['page']['format'] !== $allowedFormats[$extension]) {
			fail('CSS preprocessor formats cannot be mixed in page styles');
		}

	}
	unset($extension);



	// Root is the root pages directory
	$rootUrl = $servant->paths()->pages('domain');

	// We can parse relative path
	$relativeUrl = substr((dirname($path).'/'), strlen($servant->paths()->pages('plain')));

	// Get CSS file contents with URLs replaced
	$stylesheetSets['page']['content'] .= $urlManipulator->cssUrls(file_get_contents($servant->format()->path($path, 'server')), $rootUrl, $relativeUrl, $actionsPath);
}



/**
* Output
*/

// Site and page styles use the same superset format; parse as one (so variables from site can be used in page styles, for example)
if ($stylesheetSets['site']['format'] and $stylesheetSets['site']['format'] === $stylesheetSets['page']['format']) {
	$stylesheetSets['site']['content'] = $stylesheetSets['site']['content'].$stylesheetSets['page']['content'];
	unset($stylesheetSets['page']);
}

// Parse sets
$output = '';
foreach ($stylesheetSets as $stylesheetSet) {

	// Special format is used
	if ($stylesheetSet['format']) {
		$methodName = $stylesheetSet['format'].'ToCss';

		// Parse if possible
		if (method_exists($servant->parse(), $methodName)) {
			$output .= $servant->parse()->$methodName($stylesheetSet['content']);
		} else {
			fail(strtoupper($stylesheetSet['format']).' stylesheets are not supported.');
		}

	// Raw CSS
	} else {
		$output .= $stylesheetSet['content'];
	}

}



// We're done
$action->output(trim($output));

?>