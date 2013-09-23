<?php

// Main paths for internal use
$paths = array(

	// Uncomment to override auto detection
	// 'documentRoot' 	=> '/Users/jjappinen/Documents/Development/',
	// 'root' 			=> 'foo.net/www/',
	// 'host' 			=> 'http://foo.net/',
	'index' 		=> 'backend/',

	// User-facing locations
	'pages' 		=> 'site/pages/',
	'siteSettings' 	=> 'site/settings.json',
	'template' 		=> 'site/template/',
	'theme' 		=> 'site/theme/',

	// Backend
	'actions' 		=> 'backend/actions/',
	'cache' 		=> 'cache/',
	'temp' 			=> 'backend/temp/',
	'utilities' 	=> 'backend/utilities/',

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