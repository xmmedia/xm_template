<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_users extends Controller_Template {
    /**
     * Restrict access and define section.
     */
    public function before() {
        $this->roles_required = array('Edit Users');
        
        $this->section = 'users';
        
        parent::before();
    }
    
    /**
     * Display a list of all users.
     */
	public function action_index() {
		$this->template->content = Request::factory('claero-admin/users')->execute()->response;
	}
    
	/**
	 * Edits a user.
	 *
	 * @param integer $id The ID of the user to edit.
	 */
	public function action_edit($id) {
		$this->template->content = Request::factory("claero-admin/users/edit/$id")->execute()->response;
	}
	
	/**
	 * Creates a new user.
	 */
	public function action_new() {
		$this->template->content = Request::factory("claero-admin/users/new")->execute()->response;
	}
	
	/**
	 * Views a user.
	 *
	 * @param integer $id The ID of the user to view.
	 */
	public function action_view($id) {
		$this->template->content = Request::factory("claero-admin/users/view/$id")->execute()->response;
	}
	
	/**
	 * Deletes a user.
	 *
	 * @param integer $id The ID of the user to delete.
	 */
	public function action_delete($id) {
		Request::factory("claero-admin/users/delete/$id")->execute();
	}
}