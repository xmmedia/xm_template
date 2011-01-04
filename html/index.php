<?php

//-- Environment setup --------------------------------------------------------

// identify what server this code is running from, and set up the global constants for the application
if (isset($_SERVER['SERVER_NAME']) && isset($_SERVER['SERVER_PORT'])) {
    // script called through the webserver
    $server_id = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
} else if (isset($_SERVER['PWD'])) {
    $server_id = $_SERVER['PWD'];
} else {
	$server_id = 'Unknown';
}

switch ($server_id) {
	// production site
	case 'www.claero.com:80' :
		define('KOHANA_ENVIRONMENT', 'production');
		define('DEVELOPMENT_FLAG', FALSE);
		define('CACHE_FLAG', FALSE);
		define('DEBUG_FLAG', FALSE);
		define('FIREPHP_FLAG', FALSE);
		define('UNAVAILABLE_FLAG', FALSE);
		define('LONG_NAME', 'cl4 Template Site');
		define('SHORT_NAME', 'cl4template');
		define('APP_VERSION', '0.1');
		if ( ! isset($_SERVER['SERVER_PORT'])) {
			define('HTTP_PROTOCOL', 'http');
		} else {
			define('HTTP_PROTOCOL', ($_SERVER['SERVER_PORT'] == '443' ? 'https' : 'http'));
		}
		define('URL_ROOT', HTTP_PROTOCOL . '://template4.claero.com');
		define('ABS_ROOT', '/home/templat4/template4.claero.com');
		define('ANALYTICS_ID', '');
		define('RECAPTCHA_PUBLIC_KEY', '');
		define('RECAPTCHA_PRIVATE_KEY', '');
		define('DATABASE_DEFAULT', 'production');
		define('SESSION_TYPE', 'database');
		define('ADMIN_EMAIL', 'claero-support@claero.com');
		break;

	// development site
	case 'template4.claero.com:80' :
	case '/home/templat4/template4.claero.com' :
		define('KOHANA_ENVIRONMENT', 'development');
		define('DEVELOPMENT_FLAG', TRUE);
		define('CACHE_FLAG', FALSE);
		define('DEBUG_FLAG', TRUE);
		define('FIREPHP_FLAG', FALSE);
		define('UNAVAILABLE_FLAG', FALSE);
		define('LONG_NAME', 'cl4 Template Site');
		define('SHORT_NAME', 'cl4template');
		define('APP_VERSION', '0.1');
		if ( ! isset($_SERVER['SERVER_PORT'])) {
			define('HTTP_PROTOCOL', 'http');
		} else {
			define('HTTP_PROTOCOL', ($_SERVER['SERVER_PORT'] == '443' ? 'https' : 'http'));
		}
		define('URL_ROOT', HTTP_PROTOCOL . '://template4.claero.com');
		define('ABS_ROOT', '/home/templat4/template4.claero.com');
		define('ANALYTICS_ID', 'UA-468095-28'); // UA-468095-28 is for template4.claero.com
		define('RECAPTCHA_PUBLIC_KEY', '6LfEc78SAAAAAK0dnSQ7bu9NgcEA-PSku-7qR2w8');
		define('RECAPTCHA_PRIVATE_KEY', '6LfEc78SAAAAAAOLItfy5lH_x-43dZxXF-cCblC6');
		define('DATABASE_DEFAULT', 'development');
		define('SESSION_TYPE', 'database');
		define('ADMIN_EMAIL', 'darryl.hein@claero.com');
		break;

	default:
		die('We cannot continue because the following server configuration is not defined: ' . $server_id);
		break;
} // switch

// set the upload paths based on the ABS root
// these can be set here because it's unlikely the relative path will change per site
define('UPLOAD_ROOT_PUBLIC', ABS_ROOT . '/html/uploads');
define('UPLOAD_ROOT_PRIVATE', ABS_ROOT . '/uploads');
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

// detect the browser to get the browser type
if ( ! empty($_SERVER['HTTP_USER_AGENT'])) {
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	if (strpos($user_agent, 'iPhone') !== FALSE) {
		$browser_type = 'mobile_safari';
	} else if ((strpos($user_agent, 'Windows CE') !== FALSE && strpos($user_agent, 'Smartphone') !== FALSE) || strpos($user_agent, 'IEMobile') !== FALSE) {
		$browser_type = 'mobile_default';
	} else {
		$browser_type = 'pc_default';
	}
} else {
	$browser_type = 'pc_default';
}
define('BROWSER_TYPE', $browser_type);

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

// Clean up the configuration vars
unset($application, $modules, $system);

// Load the base, low-level functions
require SYSPATH . 'base' . EXT;

// Load the core Kohana class
require SYSPATH . 'classes/kohana/core' . EXT;

if (is_file(APPPATH . 'classes/kohana' . EXT)) {
	// Application extends the core
	require APPPATH . 'classes/kohana' . EXT;
} else {
	// Load empty core extension
	require SYSPATH . 'classes/kohana' . EXT;
}

// Bootstrap the application
require APPPATH . 'bootstrap' . EXT;