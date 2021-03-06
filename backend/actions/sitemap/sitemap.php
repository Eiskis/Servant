<?php

// Dump sitemap
$dumpNodes = function ($parents) use (&$dumpNodes) {
	$output = array();
	foreach ($parents as $node) {
		$output[$node->id()] = $node->children() ? $dumpNodes($node->children()) : $node->name();
	}
	return $output;
};

// Create custom HTML for sitemap page
$message = '<h1>Sitemap</h1>'.html_dump($dumpNodes($servant->sitemap()->pages()));



// FLAG I can't know what content the template wants - I'm assuming the same as site action
$template = $servant->create()->template($servant->sitemap()->root()->template(), $message);

// Output via template
$action->contentType('html')->output($template->output());

?>