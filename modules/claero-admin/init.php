<?php defined('SYSPATH') or die('No direct script access.');

define('REQUIRED_CLAERO_TOOLS_VERSION', 0.1);

if (( ! defined('CLAERO_TOOLS_VERSION')) || (CLAERO_TOOLS_VERSION < REQUIRED_CLAERO_TOOLS_VERSION)) {
    header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
    echo "<h1>500 Internal Server Error</h1>";
    echo "<p>Claero Admin requires Claero Tools version " . REQUIRED_CLAERO_TOOLS_VERSION . " or greater.</p>";
    echo "<p>If you have it installed and included, please be sure it appears above Claero Admin in the modules array.</p>";
    exit;
}

define('CLAERO_ADMIN_VERSION', 0.1);

// Catch-all route for Codebench classes to run
// Cannot use "action" as an identifier, as that is reserved for use by Route
Route::set('claero-admin', Kohana::config('claero-admin.url-prefix') . '/<model>(/<model_action>(/<id>))')
	->defaults(array(
		'controller'    => 'cadmin',
		'model_action'  => 'list',      // Default action for a model is listing records
        'action'        => 'route'      // All requests go to "route" action, to allow for custom actions
    ));
