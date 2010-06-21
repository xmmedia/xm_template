<?php

class AdminOptions_Default {
    /**
     * @var string The name of the Jelly model to use.
     */
    protected $jelly_model = '';
    
    /**
     * @var string The name to use when building URLs.
     */
    protected $url_model_name = '';
    
    /**
     *@var string The name to display to users.
     */
    protected $display_name = '';
    
    /**
     * @var array Details on the columns to display in a list.
     */
    protected $list_columns = array();
    
    /**
     * @var array Details on the columns to display when editing.
     */
    protected $edit_columns = array();
    
    /**
     * Delete an instance of this model.
     *
     * @param integer $id The ID of the instance to delete.
     */
    public function action_delete($id) {
        
    }
    
    /**
     * Edit an instance of this model.
     *
     * @param integer $id The ID of the instance to edit.
     */
    public function action_edit($id) {
        
    }
    
    /**
     * Display a list of all records for this model.
     *
     * @return View The view containing the records for this model.
     */
    public function action_list() {
        try {
            return View::factory(
                'claero-admin/list',
                array(
                    'list'          => Jelly::select($this->jelly_model)->execute(),
                    'url_prefix'    => Kohana::config('claero-admin.url-prefix') . "/" . $this->url_model_name,
                    'display_name'  => $this->display_name,
                    'columns'       => $this->list_columns,
                )
            );
        }
        catch (Exception $e) {
            return __("Could not display list.");
            Fire::error($e);
        }
    }
    
    /**
     * Create a new instance of this model.
     */
    public function action_new() {
        
    }
}