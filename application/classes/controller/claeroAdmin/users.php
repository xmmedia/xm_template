<?php

class Controller_ClaeroAdmin_Users extends Controller_ClaeroAdmin_Claero_Default {
    /**
     * Constructor.
     * 
	 * @param object $request Request that created the controller
     */
    public function __construct($request) {
        parent::__construct($request);
        
        $this->model('user')
			 ->identifier_label_field('name')
			 ->list_fields(array(
                'name'          => new Field_List_Display,
				'email'			=> new Field_List_Display,
                'groups'        => new Field_List_Display_Collection,
                'view'          => new Field_List_Action_Image(array('source' => '/images/icons/magnifier.png')),
                'edit'          => new Field_List_Action_Image(array('source' => '/images/icons/page_white_edit.png')),
                'delete'        => new Field_List_Action_Image,
             ))
             ->edit_fields(array(
                'id'            => new Field_Edit_Hidden,
                'name'          => new Field_Edit_Text,
                'email'   		=> new Field_Edit_Text,
                'groups'        => new Field_Edit_Checkboxes,
             ));
    }
}