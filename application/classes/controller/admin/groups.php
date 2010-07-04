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
	
	/**
	 * Views a group.
	 *
	 * @param integer $id The ID of the group to view.
	 */
	public function action_view($id) {
		$this->template->content = Request::factory("claero-admin/groups/view/$id")->execute()->response;
	}
	
	/**
	 * Deletes a group.
	 *
	 * @param integer $id The ID of the group to delete.
	 */
	public function action_delete($id) {
		Request::factory("claero-admin/groups/delete/$id")->execute();
	}
}