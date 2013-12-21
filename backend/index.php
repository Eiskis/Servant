<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', '0');
ini_set('error_log', 'errors.log');
date_default_timezone_set('UTC');

/**
* Welcome
*
* This script is where we route all dynamic requests to.
*
* We run Servant via a wrapper class that clears dangerous globals and includes core classes.
* 
* After that, Servant is ready to be used to serve responses for requests.
*/
require_once 'IndexWrapper.php';
new IndexWrapper(
	'core/debug.php',
	'core/errors.php',
	'core/helpers/',
	'core/classes/',
	'paths.php',
	'constants/'
);
die();

?>