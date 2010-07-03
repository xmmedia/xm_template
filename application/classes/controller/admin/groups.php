<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Groups extends Controller_Template {
    /**
     * Restrict access and define section.
     */
    public function before() {
        $this->roles_required = array('Edit Groups');
        
        $this->section = 'groups';
        
        parent::before();
    }
    
    /**
     * Display the main page of the administration area.
     */
	public function action_index() {
		$this->template->content = Request::factory('claero-admin/groups')->execute()->response;
	}
    
	/**
	 * Edits an instance of this class.
	 *
	 * @param integer $id The ID of the instance to edit.
	 */
	public function action_edit($id) {
		$this->template->content = Request::factory("claero-admin/groups/edit/$id")->execute()->response;
	}
}
