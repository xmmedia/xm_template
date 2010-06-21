<?php defined('SYSPATH') or die('No direct script access.');

// Catch-all route for Codebench classes to run
// Cannot use "action" as an identifier, as that is reserved for use by Route
Route::set('claero-admin', Kohana::config('claero-admin.url-prefix') . '/<model>(/<model_action>(/<id>))')
	->defaults(array(
		'controller'    => 'cadmin',
		'model_action'  => 'list',      // Default action for a model is listing records
        'action'        => 'route'      // All requests go to "route" action, to allow for custom actions
    ));
