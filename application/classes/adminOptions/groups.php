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
            'edit'          => new Column_List_Action('edit', $url_prefix),
            'delete'        => new Column_List_Action('delete', $url_prefix, array(
                                        'anchor_text' => '<a href="' . $url_prefix . 'delete/{id}"><img src="/images/icons/delete.png" /></a>'
                                    )
                                ),
        );
    }
}