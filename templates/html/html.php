<?php

/**
* HTML meta tags and boilerplate code
*
* NESTED TEMPLATES
*	debug
*
* CONTENT PARAMETERS
*	0: Body content (string)
*	1: Current page (ServantPage)
*/

$root = $servant->sitemap()->root();
$page = $template->content(1);
if (!$page) {
	$page = $root;
}



/**
* Preparing meta info
*/
$meta = '';
$links = '';



/**
* Page title
*/
$title = (!$page->isHome() ? htmlspecialchars($page->name()).' &ndash; ' : '').htmlspecialchars($page->siteName());
$meta .= '<title>'.$title.'</title><meta property="og:title" content="'.$title.'">';
unset($title);



/**
* Site name
*/
$meta .= '<meta name="application-name" content="'.htmlspecialchars($page->siteName()).'">'
        .'<meta property="og:site_name" content="'.htmlspecialchars($page->siteName()).'">';



/**
* Description
*/
$description = htmlspecialchars(trim_text($page->description(), true));
if ($description) {
	$meta .= '<meta name="description" content="'.$description.'">'
	        .'<meta property="og:description" content="'.$description.'">';
}
unset($description);



/**
* Other Open Graph stuff
*/
$meta .= '<meta property="og:type" content="'.($page->isHome() ? 'website' : 'article').'">'
         .'<meta property="og:url" content="'.$servant->paths()->root('url').'">';



/**
* Splash image
*/
$splashImage = $page->splashImage('url');
if ($splashImage) {
	$links .= '<meta property="og:image" content="'.$splashImage.'">'
	         .'<meta name="msapplication-TileImage" content="'.$splashImage.'"/>'
	         .'<link rel="apple-touch-startup-image" href="'.$splashImage.'">';
}

/**
* Icon
*/
$icon = $page->icon('domain');
if ($icon) {
	$extension = pathinfo($icon, PATHINFO_EXTENSION);

	// .ico for browsers
	if ($extension === 'ico') {
		$links .= '<link rel="shortcut icon" href="'.$icon.'" type="image/x-icon">';

	// Image icons for browsers and various platforms
	} else {
		$links .= '<link rel="icon" href="'.$icon.'" type="'.$servant->constants()->contentTypes($extension).'">'
		        .'<link rel="apple-touch-icon" href="'.$icon.'" />'
		        .($splashImage ? '' : '<meta name="msapplication-TileImage" content="'.$icon.'"/>');
	}

	unset($extension);

}
unset($splashImage, $icon);



// Web app capabilities
// $meta .= '<meta name="mobile-web-app-capable" content="yes">'
//         .'<meta name="apple-mobile-web-app-capable" content="yes">';



/**
* Links to stylesheets (external from settings + internal from stylesheets action)
*/
$stylesheetsLinks = '';

// External stylesheets
$urls = array();
$urls[] = $page->externalStylesheets('domain');

// Assets
$urls[] = $servant->paths()->endpoint('sitestyles', 'domain');
$urls[] = $servant->paths()->endpoint('templatestyles', 'domain', $page->template());

// Page-specific stylesheets
if (!$page->isRoot() and $page->stylesheets()) {
	$urls[] = $servant->paths()->endpoint('pagestyles', 'domain', $page->pointer());
}

// Generate HTML
foreach (array_flatten($urls) as $url) {
	$stylesheetsLinks .= '<link rel="stylesheet" type="text/css" href="'.$url.'" media="screen">';
}
unset($urls, $url);



/**
* Links to scripts (external from settings + internal from script actions)
*/
$scriptLinks = '';

// External scripts
$urls = array();
$urls[] = $page->externalScripts('domain');

// Assets
$urls[] = $servant->paths()->endpoint('sitescripts', 'domain');
$urls[] = $servant->paths()->endpoint('templatescripts', 'domain', $page->template());

// Page-specific scripts
if (!$page->isRoot() and $page->scripts()) {
	$urls[] = $servant->paths()->endpoint('pagescripts', 'domain', $page->pointer());
}

// Generate HTML
foreach (array_flatten($urls) as $url) {
	$scriptLinks .= '<script type="text/javascript" src="'.$url.'"></script>';
}
unset($urls, $url);



/**
* Create classes for body
*/
$i = 1;
$nodeClasses = array();
$pointer = $page->pointer();
foreach ($pointer as $value) {
	$nodeClasses[] = 'page-'.implode('-', array_slice($pointer, 0, $i));
	$i++;
}
$bodyClasses = 
	'depth-'.$page->depth().
	' index-'.$page->index().
	' template-'.$page->template().
	($page->language() ? ' language-'.$page->language() : '').
	' '.implode(' ', $nodeClasses);
unset($nodeClasses, $pointer, $i, $value);

?>



<!DOCTYPE html>
<html<?php echo $page->language() ? ' lang="'.$page->language().'"' : '' ?>>
	<head>

		<meta charset="utf-8">

		<?php echo $meta ?>

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<style type="text/css">
			@-ms-viewport{width: device-width;}
			@-o-viewport{width: device-width;}
			@viewport{width: device-width;}
			body{-webkit-tap-highlight-color: transparent;-webkit-text-size-adjust: none;-moz-text-size-adjust: none;-ms-text-size-adjust: none;}
		</style>

		<?php echo $links ?>

		<?php echo $stylesheetsLinks ?>

	</head>

	<body class="<?php echo $bodyClasses ?>">

		<?php
		if ($servant->debug()) {
			echo $template->nest('debug');
		}
		?>

		<?php echo $template->content() ?>

		<?php echo $scriptLinks ?>

	</body>
</html>
