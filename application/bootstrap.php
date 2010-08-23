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
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
$settings = array(
    'base_url' => '/',
    'index_file' => '',
    'errors' => DEBUG_FLAG,
    'profiling' => DEBUG_FLAG,
    'caching' => CACHE_FLAG,
);
Kohana::init($settings);

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Kohana_Log_File(ABS_ROOT . '/logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Kohana_Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 * ORDER MATTERS HERE!!!
 */
$modules = array(
    'claero'            => MODPATH . 'claero',            // Claerolib3 conversion (must be at the top)
    'firephp'           => MODPATH . 'firephp',
    'database'          => MODPATH . 'database',          // Database access
    'image'             => MODPATH . 'image',             // Image manipulation
    'orm'               => MODPATH . 'orm',               // Object Relationship Mapping
    //'jelly'             => MODPATH . 'jelly',             // Jelly ORM
    //'auth'              => MODPATH . 'auth',              // Basic authentication
    'pagination'        => MODPATH . 'pagination',        // Paging of results
    //'userguide'         => MODPATH . 'userguide',         // User guide and API documentation
);
if (CACHE_FLAG) $modules['cache'] = MODPATH . 'cache';      // Caching with multiple backends
if (DEBUG_FLAG) $modules['codebench'] = MODPATH . 'codebench';  // Benchmarking tool
Kohana::modules($modules);

// set up firephp for debugging
if (DEBUG_FLAG) {
    Kohana::$log->attach(new FirePHP_Log_File(APPPATH . 'logs'));
    Kohana::$log->attach(new FirePHP_Log_Console());
}

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI. Routes are selected by whichever one matches first.
 */

 // routes for public pages
Route::set('pages', '<lang>/page/<section>(/<page>(/<action>))', array('lang' => '(en-ca|fr-ca)', 'page' => '.*'))
    ->defaults(array(
        'lang' => 'en-ca',
        'controller' => 'page',
        'section' => 'home',
        'page' => '',
));

// account page
Route::set('account', '(<lang>/)account(/<action>(/<id>))', array('lang' => '(en-ca|fr-ca)'))
    ->defaults(array(
        'lang' => 'en-ca',
        'controller' => 'account',
        'action' => 'index',
        'section' => 'admin',
        'page' => '',
));

// administration pages
Route::set('admin', '(<lang>/)<controller>(/<action>(/<id>))', array('lang' => '(en-ca|fr-ca)', 'controller' => '(admin|meta)'))
    ->defaults(array(
        'lang' => 'en-ca',
        'controller' => 'admin',
        'action' => 'index',
        'section' => 'admin',
        'page' => '',
));

// routes for editing
Route::set('edit', '<lang>/edit/<type>/<action>(/<id>)', array('lang' => '(en-ca|fr-ca)', 'id'=>'.+'))
    ->defaults(array(
        'lang' => 'en-ca',
        'controller' => 'edit',
        'action' => 'createform',
        'id' => '',
));

 // home page is the default for everything else
Route::set('home', '(<lang>/)', array('lang' => '(en-ca|fr-ca)'))
    ->defaults(array(
        'lang' => 'en-ca',
        'controller' => 'home',
        'action' => 'index',
        'section' => 'home',
        'page' => 'home',
        'id' => '',
));

// last chance default route: is this safe?  what about modules, third-party modules, etc.?
// in a production site this should be locked to specific controllers or commented out
Route::set('default', '(<lang>/)(<controller>)(/<action>(/<id>))', array('lang' => '(en-ca|fr-ca)', 'id'=>'.+'))
    ->defaults(array(
        'controller' => 'home',
        'action' => 'index',
        'section' => '',
        'page' => '',
        'id' => '',
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
if (DEBUG_FLAG) {
    FirePHP_Profiler::instance()
    	->group('KO3 FirePHP Profiler Results:')
    	->superglobals() // New Superglobals method to show them all...
    	->database()
    	->benchmark()
    	->groupEnd();
}