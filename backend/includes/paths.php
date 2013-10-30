<?php

/**
* Main paths for internal use
*/
$paths = array(

	// User-facing locations
	'manifest' 		=> 'site/settings.json',
	'pages' 		=> 'site/content/',
	'template' 		=> 'site/template/',
	'theme' 		=> 'site/theme/',

	// Backend
	'cache' 		=> 'cache/',
	'actions' 		=> 'backend/actions/',
	'temp' 			=> 'backend/temp/',
	'utilities' 	=> 'backend/utilities/',

	// Roots (uncomment to override auto detection)
	// 'documentRoot' 	=> '/Users/username/Documents/Development/',
	// 'root' 			=> 'foo.com/www/',
	// 'host' 			=> 'http://foo.com/',
	'index' 		=> 'backend/',

);



// Detect document root
if (!isset($paths['documentRoot'])) {
	$paths['documentRoot'] = $_SERVER['DOCUMENT_ROOT'];
}

// Detect relative root
if (!isset($paths['root'])) {
	$paths['root'] = substr($_SERVER['SCRIPT_NAME'], 0, -(strlen($paths['index'].'index.php')));
	if (substr($paths['root'], 0, 1) == '/') {
		$paths['root'] = substr($paths['root'], 1);
	}
}

// Detect domain
// If you need to add port, use this:			.':'.$_SERVER['SERVER_PORT'])
if (!isset($paths['host'])) {
	$paths['host'] = strtolower(substr($_SERVER['SERVER_PROTOCOL'], 0, strpos($_SERVER['SERVER_PROTOCOL'], '/'))).'://'.$_SERVER['HTTP_HOST'].'/';
}

?>