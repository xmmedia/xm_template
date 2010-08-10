<?php
//-- Environment setup --------------------------------------------------------

define('EOL', "\n");
define('HEOL', "<br />\n");

// identify what server this code is running from, and set up the global constants for the application
if (!defined('RUNNING_AT_COMMAND_LINE')) define('RUNNING_AT_COMMAND_LINE', false);
if (!RUNNING_AT_COMMAND_LINE && isset($_SERVER['SERVER_NAME']) && isset($_SERVER['SERVER_PORT'])) {
    // script called through the webserver
    $serverId = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
} else if (RUNNING_AT_COMMAND_LINE) {
    $serverId = $_SERVER['PWD'];
}
switch ($serverId) {
    case 'template4.claero.com:80':
        define('CONFIG_FILE', 'development');
        define('DEVELOPMENT_FLAG', true);
        define('CACHE_FLAG', false);
        define('DEBUG_FLAG', true);
        define('UNAVAILABLE_FLAG', false);
        define('LONG_NAME','CL4 Template Site');
        define('SHORT_NAME','CL4');
        define('APP_VERSION','3.0');
        define('URL_ROOT','http://template4.claero.com');
        define('ABS_ROOT','/home/templat4/template4.claero.com');
        define('UPLOAD_ROOT','/home/templat4/template4.claero.com/uploads');
        define('ANALYTICS_ID', 'ADD_YOURS_HERE');
        define('GOOGLE_API_KEY','ADD_YOURS_HERE');
        define('CAPTCHA_PUBLIC_KEY','ADD_YOURS_HERE'); 
        define('CAPTCHA_PRIVATE_KEY','ADD_YOURS_HERE');
        define('SMTP_HOST','localhost');
        define('SMTP_PORT','25');
        define('SMTP_USER','');
        define('SMTP_PASS','');
        define('AWS_MEDIA_URL','ADD_YOURS_HERE');
        define('DEFAULT_DB','dev_trialto_com'); // default config/database.php database settings name
        define('EN_LOCALE_ID', 1);
        define('FR_LOCALE_ID', 2);
        break;

    default:
        die("We cannot continue because the following server configuration is not defined in global.php: '{$serverId}'");
        break;
} // switch

define('THIS_PAGE','http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);

// set up browser types
$userAgent = $_SERVER['HTTP_USER_AGENT'];
if (substr_count($userAgent,'iPhone') > 0) {
    $browserType = 'mobile_safari';
} else if (substr_count($userAgent,'Windows CE') > 0 && substr_count($userAgent,'Smartphone') > 0) {
    $browserType = 'mobile_default';
} else if (substr_count($userAgent,'IEMobile') > 0) {
    $browserType = 'mobile_default';
} else {
    $browserType = 'pc_default';
};
define('BROWSER_TYPE',$browserType);

/**
 * The directory in which your application specific resources are located.
 * The application directory must contain the bootstrap.php file.
 *
 * @see  http://kohanaframework.org/guide/about.install#application
 */
$application = '../application';

/**
 * The directory in which your modules are located.
 *
 * @see  http://kohanaframework.org/guide/about.install#modules
 */
$modules = '../modules';

/**
 * The directory in which the Kohana resources are located. The system
 * directory must contain the classes/kohana.php file.
 *
 * @see  http://kohanaframework.org/guide/about.install#system
 */
$system = '../system';

/**
 * The default extension of resource files. If you change this, all resources
 * must be renamed to use the new extension.
 *
 * @see  http://kohanaframework.org/guide/about.install#ext
 */
define('EXT', '.php');

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
    error_reporting(-1); // debug mode
    ini_set('display_errors', 'On');
} else {
    error_reporting(E_ALL | E_STRICT); // production site
} // if

/**
 * End of standard configuration! Changing any of the code below should only be
 * attempted by those with a working knowledge of Kohana internals.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 */

// Set the full path to the docroot
define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

// Make the application relative to the docroot
if ( ! is_dir($application) AND is_dir(DOCROOT.$application))
	$application = DOCROOT.$application;

// Make the modules relative to the docroot
if ( ! is_dir($modules) AND is_dir(DOCROOT.$modules))
	$modules = DOCROOT.$modules;

// Make the system relative to the docroot
if ( ! is_dir($system) AND is_dir(DOCROOT.$system))
	$system = DOCROOT.$system;

// Define the absolute paths for configured directories
define('APPPATH', realpath($application).DIRECTORY_SEPARATOR);
define('MODPATH', realpath($modules).DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system).DIRECTORY_SEPARATOR);

// Clean up the configuration vars
unset($application, $modules, $system);

if (file_exists('install'.EXT))
{
	// Load the installation check
	return include 'install'.EXT;
}

// Load the base, low-level functions
require SYSPATH.'base'.EXT;

// Load the core Kohana class
require SYSPATH.'classes/kohana/core'.EXT;

if (is_file(APPPATH.'classes/kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/kohana'.EXT;
}

// Bootstrap the application
require APPPATH.'bootstrap'.EXT;
