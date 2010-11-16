<?php defined('SYSPATH') or die('No direct script access.');

//-- Environment setup --------------------------------------------------------

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('America/Edmonton');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'en-ca.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
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
 * Type      | Setting    | Description                                    | Default Value
 * ----------|------------|------------------------------------------------|---------------
 * `boolean` | errors     | use internal error and exception handling?     | `TRUE`
 * `boolean` | profile    | do internal benchmarking?                      | `TRUE`
 * `boolean` | caching    | cache the location of files between requests?  | `FALSE`
 * `string`  | charset    | character set used for all input and output    | `"utf-8"`
 * `string`  | base_url   | set the base URL for the application           | `"/"`
 * `string`  | index_file | set the index.php file name                    | `"index.php"`
 * `string`  | cache_dir  | set the cache directory path                   | `APPPATH."cache"`
 * `integer` | cache_life | set the default cache lifetime                 | `60`
 * `string`  | error_view | set the error rendering view                   | `"kohana/error"`
 */
$settings = array(
    'index_file' => '',
    'errors' => DEBUG_FLAG,
    'profiling' => DEBUG_FLAG,
    'caching' => CACHE_FLAG,
);
Kohana::init($settings);

// tell Kohana if we are dev, production, staging or testing
Kohana::$environment = KOHANA_ENVIRONMENT;

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Kohana_Log_File(ABS_ROOT . '/logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Kohana_Config_File);

/**
* setting the default language
* if set to NULL, then the route won't include a language by default
* if you want a language in the route, set default_lang to the language (ie, en-ca)
*/
define('DEFAULT_LANG', NULL);
$lang_options = '(en-ca|fr-ca)';

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 * ORDER MATTERS HERE!!!
 */
$modules = array();
$modules['cl4'] = MODPATH . 'cl4';                  // cl4
$modules['cl4auth'] = MODPATH . 'cl4auth';          // cl4auth
$modules['cl4admin'] = MODPATH . 'cl4admin';        // cl4admin
$modules['cl4base'] = MODPATH . 'cl4base';          // cl4base
if (FIREPHP_FLAG) $modules['firephp'] = MODPATH . 'firephp';          // FIre PHP debugging - ONLY WORKS IN FIREFOX
$modules['database'] = MODPATH . 'database';        // Database access
$modules['image'] = MODPATH . 'image';              // Image manipulation
$modules['orm'] = MODPATH . 'orm';                  // Object Relationship Mapping
$modules['auth'] = MODPATH . 'auth';                // Basic authentication
$modules['pagination'] = MODPATH . 'pagination';    // Paging of results
if (Kohana::$environment == Kohana::DEVELOPMENT) $modules['userguide'] = MODPATH . 'userguide';      // User guide and API documentation

if (CACHE_FLAG) $modules['cache'] = MODPATH . 'cache';      // Caching with multiple backends
if (DEBUG_FLAG) $modules['codebench'] = MODPATH . 'codebench';  // Benchmarking tool
Kohana::modules($modules);

// set up firephp for debugging
if (FIREPHP_FLAG && DEBUG_FLAG) {
    Kohana::$log->attach(new FirePHP_Log_File(APPPATH . 'logs'));
    Kohana::$log->attach(new FirePHP_Log_Console());
}

if (isset($modules['claero'])) {
	// sets the error handlers to use the customized Claero module versions only when the claero module is included
	Claero::set_error_handlers();
}

// this sets the default database to use
Database::$default = DATABASE_DEFAULT;

// this sets the session type so we don't need to set it when calling Session::instance()
Session::$default = SESSION_TYPE;

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI. Routes are selected by whichever one matches first.
 */

// routes for "static" pages without a sub folder
Route::set('pages', '(<lang>/)(<page>)', array('lang' => $lang_options))
	->defaults(array(
		'controller' => 'page',
		'lang' => DEFAULT_LANG,
		'page' => 'index',
		'section' => NULL,
));

// route for "static" pages with a sub folder
Route::set('pages_section', '(<lang>/)<section>/(<page>)', array('lang' => $lang_options))
	->defaults(array(
		'controller' => 'page',
		'lang' => DEFAULT_LANG,
		'section' => 'index',
		'page' => 'index',
));

// for all other pages, show a 404
Route::set('catch_all', '<path>', array('path' => '(|.+)'))
	->defaults(array(
		'controller' => 'base',
		'action' => '404',
));

if ( ! defined('SUPPRESS_REQUEST')) {
	/**
	 * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
	 * If no source is specified, the URI will be automatically detected.
	 */
	echo Request::instance()
		->execute()
		->send_headers()
		->response;
}

// set up firephp for debugging
if (FIREPHP_FLAG && DEBUG_FLAG) {
	FirePHP_Profiler::instance()
		->group('KO3 FirePHP Profiler Results:')
		->superglobals() // New Superglobals method to show them all...
		->database()
		->benchmark()
		->groupEnd();
}
