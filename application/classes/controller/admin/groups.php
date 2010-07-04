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
     * Display a list of all groups.
     */
	public function action_index() {
		$this->template->content = Request::factory('claero-admin/groups')->execute()->response;
	}
    
	/**
	 * Edits a group.
	 *
	 * @param integer $id The ID of the group to edit.
	 */
	public function action_edit($id) {
		$this->template->content = Request::factory("claero-admin/groups/edit/$id")->execute()->response;
	}
	
	/**
	 * Creates a new group.
	 */
	public function action_new() {
		$this->template->content = Request::factory("claero-admin/groups/new")->execute()->response;
	}
}
