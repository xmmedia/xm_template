<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends Controller_Template {
    /**
     * Display the main page of the administration area
     */
	public function action_index() {
		$this->template->content = Request::factory('claero-admin/users')->execute()->response;
	}
    
}
