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
     * Display the list of groups.
     */
	public function action_index() {
        $groups = Jelly::select('group')->execute();
        
        $this->template->content = View::factory(
            'admin/groups/index',
            array(
                'groups' => $groups
            )
        );
	}
    
    /**
     * Edit a group.
     */
    public function action_edit($id) {
        try {
            $roles = Jelly::select('role')->execute();
            
            // If form was submitted
            if ('POST' == Request::$method) {
                // If no checkboxes selected, field doesn't even show up in post, must be set
                $_POST['roles'] = isset($_POST['roles']) ? $_POST['roles'] : array();
                
                // Build group from form
                $group = Jelly::factory(
                    'group',
                    Arr::extract(
                        $_POST,
                        array(
                            'id',
                            'name',
                            'description',
                            'roles'
                        )
                    )
                );
                
                // Save (involves multiple tables, wrap in transaction)
                DB::query(null, 'START TRANSACTION')->execute();
                $group->save($_POST['id']);
                DB::query(null, 'COMMIT')->execute();
                
                Flash::set('message', __("Group ':group' saved.", array(':group' => $group->name)));
                $this->request->redirect('/admin/groups');
            }
            // If form has not been submitted
            else {
                // Build group from ID
                $group = Jelly::select('group', $id);
            }
        }
        // Error while validating form
        catch (Validate_Exception $e) {
            $this->template->message = $this->get_error_messages($e, 'groups');
        }
        // Other error
        catch (Exception $e) {
            $this->template->message = __("Could not edit group.");
            Fire::error($e);
        }
        
        $this->template->content = View::factory(
            'admin/groups/details',
            array(
                'title'         => __("Edit Group"),
                'action'        => "/admin/groups/edit/$id",
                'id'            => $id,
                'group'         => $group,
                'roles'         => $roles,
                'group_roles'   => arr::pluck('id', $group->roles->as_array())
            )
        );
    }
    
    /**
     * Delete a group.
     */
    public function action_delete($id) {
        try {
            // Get name
            $group = Jelly::select('group')->load($id);
            $name  = $group->name;
            
            // Delete group
            $group->delete();
            
            Flash::set('message', __("Group ':group' has been deleted.", array(':group' => $name)));
        }
        // Couldn't delete group.
        catch (Exception $e) {
            Flash::set('message', __("Could not delete group."));
        }
        
        $this->request->redirect('/admin/groups');
    }
    
    /**
     * Create a new group.
     */
    public function action_new() {
        try {
            $roles = Jelly::select('role')->execute();
            
            // If form was submitted
            if ('POST' == Request::$method) {
                // If no checkboxes selected, field doesn't even show up in post, must be set
                $_POST['roles'] = isset($_POST['roles']) ? $_POST['roles'] : array();
                
                // Build group from form
                $group = Jelly::factory(
                    'group',
                    Arr::extract(
                        $_POST,
                        array(
                            'id',
                            'name',
                            'description',
                            'roles'
                        )
                    )
                );
                
                // Save (involves multiple tables, wrap in transaction)
                DB::query(null, 'START TRANSACTION')->execute();
                $group->save();
                DB::query(null, 'COMMIT')->execute();
                
                Flash::set('message', __("Group ':group' created.", array(':group' => $group->name)));
                $this->request->redirect('/admin/groups');
            }
            // If form has not been submitted
            else {
                // Build blank
                $group = Jelly::factory('group');
            }
        }
        // Error while validating form
        catch (Validate_Exception $e) {
            $this->template->message = $this->get_error_messages($e, 'groups');
        }
        // Other error
        catch (Exception $e) {
            $this->template->message = __("Could not create new group.");
            Fire::error($e);
        }
        
        $this->template->content = View::factory(
            'admin/groups/details',
            array(
                'title'         => __("New Group"),
                'action'        => '/admin/groups/new',
                'id'            => '',
                'group'         => $group,
                'roles'         => $roles,
                'group_roles'   => array()
            )
        );
    }
}
