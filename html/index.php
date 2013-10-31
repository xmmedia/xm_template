<?php

// include the config file
// for each server, replace this file with the correct config
require_once('../application/init.php');

// set the upload paths based on the ABS root
// these can be set here because it's unlikely the relative path will change per site
define('UPLOAD_ROOT_PUBLIC', ABS_ROOT . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'uploads');
define('UPLOAD_ROOT_PRIVATE', ABS_ROOT . DIRECTORY_SEPARATOR . 'uploads');
define('UPLOAD_ROOT', UPLOAD_ROOT_PRIVATE);

/**
 * Set the PHP error reporting level. If you set this in php.ini, you remove this.
 * @see  http://php.net/error_reporting
 *
 * When developing your application, it is highly recommended to enable notices
 * and strict warnings. Enable them by using: E_ALL | E_STRICT
 *
 * In a production environment, it is safe to ignore notices and strict warnings.
 * Disable them by using: E_ALL ^ E_NOTICE
 *
 * When using a legacy application with PHP >= 5.3, it is recommended to disable
 * deprecated notices. Disable with: E_ALL & ~E_DEPRECATED
 */
if (DEBUG_FLAG) {
	// debug mode
	error_reporting(-1);
	ini_set('display_errors', 'On');
} else {
	// production site
	error_reporting(E_ALL | E_STRICT);
} // if

/**
 * The default extension of resource files. If you change this, all resources
 * must be renamed to use the new extension.
 *
 * @see  http://kohanaframework.org/guide/about.install#ext
 */
define('EXT', '.php');

/**
*   Define some line endings
*/
define('EOL', "\n");
define('HEOL', "<br>\n");

/**
 * The directory in which your application specific resources are located.
 * The application directory must contain the bootstrap.php file.
 *
 * @see  http://kohanaframework.org/guide/about.install#application
 */
$application = '../application/';

/**
 * The directory in which your modules are located.
 *
 * @see  http://kohanaframework.org/guide/about.install#modules
 */
$modules = '../modules/';

/**
 * The directory in which the Kohana resources are located. The system
 * directory must contain the classes/kohana.php file.
 *
 * @see  http://kohanaframework.org/guide/about.install#system
 */
$system = '../system/';

/**
 * End of standard configuration! Changing any of the code below should only be
 * attempted by those with a working knowledge of Kohana internals.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 */

// Set the full path to the docroot
define('DOCROOT', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

// Make the application relative to the docroot
if ( ! is_dir($application) && is_dir(DOCROOT . $application))
	$application = DOCROOT . $application;

// Make the modules relative to the docroot
if ( ! is_dir($modules) && is_dir(DOCROOT . $modules))
	$modules = DOCROOT . $modules;

// Make the system relative to the docroot
if ( ! is_dir($system) && is_dir(DOCROOT . $system))
	$system = DOCROOT . $system;

// Define the absolute paths for configured directories
define('APPPATH', realpath($application) . DIRECTORY_SEPARATOR);
define('MODPATH', realpath($modules) . DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system) . DIRECTORY_SEPARATOR);
// set a path for xm which will be used on our extension of Kohana so we can use the xm exception handler
define('XM_PATH', realpath(MODPATH . 'xm') . DIRECTORY_SEPARATOR);

// Clean up the configuration vars
unset($application, $modules, $system);

/**
 * Define the start time of the application, used for profiling.
 */
if ( ! defined('KOHANA_START_TIME')) {
	define('KOHANA_START_TIME', microtime(TRUE));
}

/**
 * Define the memory usage at the start of the application, used for profiling.
 */
if ( ! defined('KOHANA_START_MEMORY')) {
	define('KOHANA_START_MEMORY', memory_get_usage());
}

// Bootstrap the application
require APPPATH . 'bootstrap' . EXT;

if (PHP_SAPI == 'cli') {
	class_exists('Minion_Task') OR die('Please enable the Minion module for CLI support.');
	set_exception_handler(array('Minion_Exception', 'handler'));

	Minion_Task::factory(Minion_CLI::options())->execute();

} else {
	/**
	 * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
	 * If no source is specified, the URI will be automatically detected.
	 */
	echo Request::factory(TRUE, array(), FALSE)
		->execute()
		->send_headers(TRUE)
		->body();
}