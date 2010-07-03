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
			 ->list_fields(array(
                'name'          => new Field_List_Display,
				'email'			=> new Field_List_Display,
                'delete'        => new Field_List_Action,
             ));
    }
}