<?php

/**
 * Options for Groups admin.
 */
class AdminOptions_Groups extends AdminOptions_Default {
    /**
     * Constructor, sets defaults.
     *
     * @param array $options The options to set.
     */
    public function __construct($options = array()) {
        parent::__construct($options);
        
        // The following are not options to be overridden, but intrinsic to the workings of the class.
        
        $this->jelly_model      = 'group';
        $this->url_model_name   = 'groups';
        $this->display_name     = 'Groups';
        
        $url_prefix = $this->url_base . $this->url_model_name . "/";
        
        // Have to specify what kind of list fields to include.
        $this->list_fields = array(
            'name'          => new Field_List_Display('name'),
            'description'   => new Field_List_Display('description'),
            'roles'         => new Field_List_Display_Collection('roles'),
            'edit'          => new Field_List_Action_Image('edit', $url_prefix, array('source' => '/images/icons/page_white_edit.png')),
            'delete'        => new Field_List_Action_Image('delete', $url_prefix),
        );
        
        // Edit fields are more auto-detectable.
        $this->edit_fields = array(
            'id'            => $this->edit_field('id'),
            'name'          => $this->edit_field('name'),
            'description'   => $this->edit_field('description'),
        );
    }
}