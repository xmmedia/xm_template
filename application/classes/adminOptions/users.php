<?php

/**
 * Options for Users admin.
 */
class AdminOptions_Users extends AdminOptions_Default {
    /**
     * Constructor.
     */
    public function __construct() {
        $this->jelly_model      = 'user';
        $this->url_model_name   = 'users';
        $this->display_name     = 'Users';
        
        $url_prefix = "/" . Kohana::config('claero-admin.url-prefix') . "/" . $this->url_model_name . "/";
        
        $this->list_columns = array(
            'email'     => new Column_List_Display('email'),
            'name'      => new Column_List_Display('name'),
            'edit'      => new Column_List_Action('edit', $url_prefix),
            'delete'    => new Column_List_Action('delete', $url_prefix),
        );
    }
}