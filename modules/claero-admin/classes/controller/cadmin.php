<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Cadmin extends Controller_Template {
	/**
     * Display a list for the current model.
     */
    public function action_index($model, $action = null, $id = null) {
		echo "Model: $model - Y: $action - ID: $id";
		exit;
		
        $groups = Jelly::select(Inflector::singular($model))->execute();
        
        $this->template->content = View::factory(
            'admin/groups/index',
            array(
                'groups' => $groups
            )
        );
	}
	
	/**
	 * Route the admin action.
	 *
	 * @param string  $model  The model to operate on.
	 * @param string  $action The action to perform.
	 * $param integer $id     The ID of the record to operate on.
	 */
	public function action_route($model, $action = null, $id = null) {
		// Default action is list
		$action = isset($action) ? ('action_' . strtolower($action)) : 'action_list';
		
		// Singularize model name, in case it was singular already (groups/group = group)
		$model_singular = Inflector::singular($model);
		
		// Now make it plural (group = groups)
		$model_plural = Inflector::plural($model_singular); // Work from singular, in case it was already plural
		
		// Uppercase the first letter (groups = Groups)
		$model_display = ucfirst($model_plural);
		
		// Get the name of the class we're working with (Groups = AdminOptions_Groups)
		$class_name = 'AdminOptions_' . $model_display;
		
		$options = new $class_name();
		
		// If the requested action has been defined
		if (in_array($action, get_class_methods($options))) {
			$this->template->content = $options->$action($id);
		}
		// If that action doesn't exist
		else {
			header("HTTP/1.0 404 Not Found");
			echo "<h1>404 Not Found</h1>";
			exit;
		}
	}
}