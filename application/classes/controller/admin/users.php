<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends Controller_Template {
    /**
     * Restrict access and define section.
     */
    public function before() {
        $this->roles_required = array('Edit Users');
        
        $this->section = 'users';
        
        parent::before();
    }
    
    /**
     * Display the list of users.
     */
	public function action_index() {
        $users = Jelly::select('user')->execute();
        
        $this->template->content = View::factory(
            'admin/users/index',
            array(
                'users' => $users
            )
        );
	}
    
    /**
     * Edit a user.
     */
    public function action_edit($id) {
        try {
            $groups = Jelly::select('group')->execute();
            
            // If form was submitted
            if ('POST' == Request::$method) {
                // If no checkboxes selected, field doesn't even show up in post, must be set
                $_POST['groups'] = isset($_POST['groups']) ? $_POST['groups'] : array();
                
                // Build user from form
                $user = Jelly::factory(
                    'user',
                    Arr::extract(
                        $_POST,
                        array(
                            'id',
                            'email',
                            'name',
                            'password',
                            'password_confirm',
                            'groups'
                        )
                    )
                );
                
                // Save (involves multiple tables, wrap in transaction)
                DB::query(null, 'START TRANSACTION')->execute();
                $user->save($_POST['id']);
                DB::query(null, 'COMMIT')->execute();
                
                Flash::set('message', __("User ':user' saved.", array(':user' => $user->name)));
                $this->request->redirect('/admin/users');
            }
            // If form has not been submitted
            else {
                // Build user from ID
                $user = Jelly::select('user', $id);
            }
        }
        // Error while validating form
        catch (Validate_Exception $e) {
            $this->template->message = $this->get_error_messages($e, 'users');
        }
        // Other error
        catch (Exception $e) {
            $this->template->message = __("Could not edit user.");
            Fire::error($e);
        }
        
        $this->template->content = View::factory(
            'admin/users/details',
            array(
                'title'         => __("Edit User"),
                'action'        => "/admin/users/edit/$id",
                'id'            => $id,
                'user'          => $user,
                'groups'        => $groups,
                'user_groups'   => arr::pluck('id', $user->groups->as_array())
            )
        );
    }
    
    /**
     * Delete a user.
     */
    public function action_delete($id) {
        try {
            // Get name
            $user = Jelly::select('user')->load($id);
            $name  = $user->name;
            
            // Delete user
            $user->delete();
            
            Flash::set('message', __("Group ':user' has been deleted.", array(':user' => $name)));
        }
        // Couldn't delete user.
        catch (Exception $e) {
            Flash::set('message', __("Could not delete user."));
        }
        
        $this->request->redirect('/admin/users');
    }
    
    /**
     * Create a new user.
     */
    public function action_new() {
        try {
            $groups = Jelly::select('group')->execute();
            
            // If form was submitted
            if ('POST' == Request::$method) {
                // If no checkboxes selected, field doesn't even show up in post, must be set
                $_POST['groups'] = isset($_POST['groups']) ? $_POST['groups'] : array();
                
                // Build user from form
                $user = Jelly::factory(
                    'user',
                    Arr::extract(
                        $_POST,
                        array(
                            'id',
                            'email',
                            'name',
                            'password',
                            'password_confirm',
                            'groups'
                        )
                    )
                );
                
                // Save (involves multiple tables, wrap in transaction)
                DB::query(null, 'START TRANSACTION')->execute();
                $user->save();
                DB::query(null, 'COMMIT')->execute();
                
                Flash::set('message', __("User ':user' created.", array(':user' => $user->name)));
                $this->request->redirect('/admin/users');
            }
            // If form has not been submitted
            else {
                // Build blank
                $user = Jelly::factory('user');
            }
        }
        // Error while validating form
        catch (Validate_Exception $e) {
            $this->template->message = $this->get_error_messages($e, 'users');
        }
        // Other error
        catch (Exception $e) {
            $this->template->message = __("Could not create new user.");
            Fire::error($e);
        }
        
        $this->template->content = View::factory(
            'admin/users/details',
            array(
                'title'         => __("New User"),
                'action'        => '/admin/users/new',
                'id'            => '',
                'user'          => $user,
                'groups'        => $groups,
                'user_groups'   => array()
            )
        );
    }
}
