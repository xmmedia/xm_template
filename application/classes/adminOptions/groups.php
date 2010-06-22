<?php

/**
 * Options for Groups admin.
 */
class AdminOptions_Groups extends AdminOptions_Default {
    /**
     * Constructor.
     */
    public function __construct() {
        $this->jelly_model      = 'group';
        $this->url_model_name   = 'groups';
        $this->display_name     = 'Groups';
        
        $url_prefix = "/" . Kohana::config('claero-admin.url-prefix') . "/" . $this->url_model_name . "/";
        
        $this->list_columns = array(
            'name'          => new Column_List_Display('name'),
            'description'   => new Column_List_Display('description'),
            'roles'         => new Column_List_Display_Collection('roles'),
            'edit'          => new Column_List_Action_Image('edit', $url_prefix, array('source' => '/images/icons/page_white_edit.png')),
            'delete'        => new Column_List_Action_Image('delete', $url_prefix),
        );
    }
}