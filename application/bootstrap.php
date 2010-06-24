<?php defined('SYSPATH') or die('No direct script access.');

//-- Identify environment -----------------------------------------------------

define('ENVIRONMENT_LOCAL', 'local');
define('ENVIRONMENT_STORM6', 'storm6');

switch ($_SERVER['SERVER_NAME']) {
    // Running on storm6
    case 'template4.claero.com':
        define('ENVIRONMENT', ENVIRONMENT_STORM6);
    break;
    
    // Running on local machine
    case 'template4':
    default:
        define('ENVIRONMENT', ENVIRONMENT_LOCAL);
    break;
}

//-- Environment setup --------------------------------------------------------

/**
 * Set the default time zone.
 *
 * @see  http://docs.kohanaphp.com/about.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('America/Montreal');

/**
 * Set the default locale.
 *
 * @see  http://docs.kohanaphp.com/about.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://docs.kohanaphp.com/about.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

//-- Configuration and initialization -----------------------------------------

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
    'base_url'      => '/',
    'index_file'    => ''
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Kohana_Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Kohana_Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 * Order matters.
 */
Kohana::modules(array(
    'claero-common'     => MODPATH.'claero-common',     // Claero Common
	'database'          => MODPATH.'database',          // Database access
    'firephp'           => MODPATH.'firephp',           // FirePHP library
    'kform'             => MODPATH.'kform',             // KForm form generation library
    'jelly'             => MODPATH.'jelly',             // Jelly ORM
    'jelly-group-auth'  => MODPATH.'jelly-group-auth',  // Jelly group-based authentication plug-in (must be included before auth)
    'auth'              => MODPATH.'auth',              // Authorization
    'claero-admin'      => MODPATH.'claero-admin',      // Claero administration module (must be included after claero-common)
	));

Kohana::$log->attach(new FirePHP_Log_File(APPPATH.'logs'));
Kohana::$log->attach(new FirePHP_Log_Console());

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
Route::set('default_doc', '')
	->defaults(array(
		'controller' => 'docs',
		'action'     => 'showdoc',
        'id'         => 'welcome'
	));

// Admin controllers
Route::set('admin', '(admin/(<controller>(/<action>(/<id>))))')
	->defaults(array(
        'directory'  => 'admin',
		'action'     => 'index'
	));

Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
        'controller' => 'docs',
		'action'     => 'index'
	));

/**
 * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
 * If no source is specified, the URI will be automatically detected.
 */
echo Request::instance()
	->execute()
	->send_headers()
	->response;

FirePHP_Profiler::instance()
	->group('KO3 FirePHP Profiler Results:')
	->superglobals() // New Superglobals method to show them all...
	->database()
	->benchmark()
	->groupEnd();
