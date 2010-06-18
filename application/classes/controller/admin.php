<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Template {
    /**
     * Runs before the private controller tries to restrict access.
     */
    public function before() {
		// All actions in this controller require the "admin" role.
		$this->roles_required = array('admin');
        
        parent::before();
    }
    
    /**
     * Display the main page of the administration area
     */
	public function action_index() {
        $this->template->content = View::factory('admin_index')->render();
	}
    
}
