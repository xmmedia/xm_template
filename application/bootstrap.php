<?php defined('SYSPATH') or die('No direct script access.');

//-- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH . 'classes/Kohana/Core' . EXT;

if (is_file(APPPATH . 'classes/Kohana' . EXT)) {
	// Application extends the core
	require APPPATH . 'classes/Kohana' . EXT;
} else {
	// Load empty core extension
	require SYSPATH . 'classes/Kohana' . EXT;
}

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
setlocale(LC_ALL, 'en_CA.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Optionally, you can enable a compatibility auto-loader for use with
 * older modules that have not been updated for PSR-0.
 *
 * It is recommended to not enable this unless absolutely necessary.
 */
//spl_autoload_register(array('Kohana', 'auto_load_lowercase'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

//-- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-ca');

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV'])) {
	Kohana::$environment = constant('Kohana::' . strtoupper($_SERVER['KOHANA_ENV']));
/**
 * Set Kohana::$environment to the value of KOHANA_ENVIRONMENT
 */
} else {
	Kohana::$environment = KOHANA_ENVIRONMENT;
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * Type      | Setting    | Description                                    | Default Value
 * ----------|------------|------------------------------------------------|---------------
 * `string`  | base_url   | set the base URL for the application           | NULL
 * `string`  | index_file | set the index.php file name                    | "index.php"
 * `boolean` | errors     | use internal error and exception handling?     | TRUE
 * `boolean` | profile    | do internal benchmarking?                      | TRUE
 * `boolean` | caching    | cache the location of files between requests?  | FALSE
 * `string`  | charset    | character set used for all input and output    | "utf-8"
 * `string`  | cache_dir  | set the cache directory path                   | APPPATH."cache"
 * `integer` | cache_life | set the default cache lifetime                 | 60
 * `string`  | error_view | set the error rendering view                   | "kohana/error"
 */
Kohana::init(array(
	'base_url'   => URL_ROOT,
	'index_file' => '',
	'profile'    => DEBUG_FLAG,
	'caching'    => CACHE_FLAG,
	'cache_dir'  => ABS_ROOT . DIRECTORY_SEPARATOR . 'cache',
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(ABS_ROOT . DIRECTORY_SEPARATOR . 'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 * ORDER MATTERS HERE!!!
 */
Kohana::modules(array(
	'xm'       => MODPATH . 'xm',         // xmmedia
	'database' => MODPATH . 'database',   // Database access
	'image'    => MODPATH . 'image',      // Image manipulation
	'minion'   => MODPATH . 'minion',     // CLI Tasks
	'orm'      => MODPATH . 'orm',        // Object Relationship Mapping
	'auth'     => MODPATH . 'auth',       // Basic authentication
	'cache'    => MODPATH . 'cache',      // Caching with multiple backends
));

// this sets the default database to use
Database::$default = DATABASE_DEFAULT;

// this sets the session type so we don't need to set it when calling Session::instance()
Session::$default = SESSION_TYPE;

// the salt to use when creating the cookies for validation
Cookie::$salt = '=V,]tB|H!;?RP!2Fv(<)"mC\sx48XmiF5|@JkM{.?W+SV>lj?QQs^:;\!ah~oj%';

// if we're in development, logged in and allowed then include the userguide and codebench modules
if (Kohana::$environment == Kohana::DEVELOPMENT && Auth::instance()->logged_in() && Auth::instance()->allowed('userguide')) {
	$modules = array_merge(Kohana::modules(), array(
		'userguide' => MODPATH . 'userguide', // Kohana userguide and API documentation
		'codebench' => MODPATH . 'codebench', // Benchmarking tool
	));
	Kohana::modules($modules);
}

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI. Routes are selected by whichever one matches first.
 */

// routes for "static" pages without a sub folder
Route::set('public', '(<action>)')
	->defaults(array(
		'controller' => 'Public',
		'action' => 'index',
));