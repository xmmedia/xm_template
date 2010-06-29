<?php

/**
 * Options for Users admin.
 */
class AdminOptions_Users extends AdminOptions_Default {
    /**
     * Constructor, sets defaults.
     *
     * @param array $options The options to set.
     */
    public function __construct($options = array()) {
        parent::__construct($options);
        
        // The following are not options to be overridden, but intrinsic to the workings of the class.
        
        $this->jelly_model      = 'user';
        $this->url_model_name   = 'users';
        $this->display_name     = 'Users';
        
        $url_prefix = $this->url_base . $this->url_model_name . "/";
        
        $this->list_columns = array(
            'email'     => new Column_List_Display('email'),
            'name'      => new Column_List_Display('name'),
            'edit'      => new Column_List_Action('edit', $url_prefix),
            'delete'    => new Column_List_Action('delete', $url_prefix),
        );
    }
}