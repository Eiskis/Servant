<?php

/**
* Output page-specific scripts
*/
$output = '';

// Select root by default, page node if pointer given
$page = $servant->sitemap()->root();
if (count($input->pointer())) {
	$page = $servant->sitemap()->select($input->pointer())->page();
}

foreach ($page->scripts('server') as $path) {
	$output .= file_get_contents($path);
}

// Compress
if (!$servant->debug()) {
	$servant->utilities()->load('jshrink');
	$output = Minifier::minify($output, array('flaggedComments' => false));
}

// Output scripts
$action->contentType('js')->output($output);
?>