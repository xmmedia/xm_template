<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Account extends Controller_Template {
    /**
     * Runs before the private controller tries to restrict access.
     */
    public function before() {
        // Define roles required for actions
        switch($this->request->action) {
            case 'index':
                $this->roles_required = array('view own account', 'eat the sun');
            break;
        }
        
        parent::before();
    }
    
    /**
     * Display the main page of the administration area
     */
	public function action_index() {
        $this->template->content = "Details of your account should follow.";
	}
    
    /**
     * Log a user in.
     */
    public function action_login() {
		// If user is already logged in
		if ($this->auth->logged_in()) {
			Flash::set('message', 'You are already logged in.');
			$this->request->redirect("/");
		}
		
		// Create new login form, and note if user needs to return to another page
		$form = new KForm('login');
		$form->pre_populate(array('return_to' => Flash::get('return_to')));
		
		// If user submitted valid form data
		if (Request::$method == 'POST' && $form->populate($_POST)) {
			$data = $form->result();
			
			// If valid email/password
			if ($this->auth->login($data['email'], $data['password'], false)) {
				// Go to index or page they tried to access when not logged in.
				$this->request->redirect($data['return_to']);
			}
			// If invalid email/password
			else {
				$this->template->message = "Invalid email/password combination.";
			}
		}
		
        $this->template->content = View::factory(
			'account/login',
			array(
				'form' => $form
			)
		);
    }
	
	/**
	 * Logs a user out.
	 */
	public function action_logout() {
		if ($this->auth->logged_in()) {
			$this->auth->logout();
		}
		
		$this->request->redirect('/');
	}
	
	/**
	 * Registers a new user.
	 */
	public function action_register() {
		// If user is already logged in
		if ($this->auth->logged_in()) {
			Flash::set('message', 'You already have an account.');
			$this->request->redirect("/");
		}
		
		$form = new KForm("user");
		
		// If user submitted valid form data
		if (Request::$method == 'POST' && $form->populate($_POST)) {
			try {
				// Create a new user
				$user = Jelly::factory('user');
				
				// Get SPECIFIC data from form so user can't maliciously add new fields
				$user->set(Arr::extract($form->result(), array(
					'email', 'password', 'password_confirm', 'name'
				)));
				
				// Add new user to basic "User" group
				$user->add('groups', 2);
				
				// Save new user
				$user->save();
				
				// Redirect to login
				Flash::set('message', __("Account created."));
				$this->request->redirect("/account/login");
			}
			catch (Validate_Exception $e) {
				$this->template->message = $this->get_error_messages($e, 'users');
			}
			// Error when creating user
			catch (Exception $e) {
				Fire::log($e);
				$this->template->message = 'Could not create user. Error: "' . $e->getMessage() . '"';
			}
        }	
		
		// Show form
		$this->template->content = View::factory(
			'account/register',
			array(
				'form' => $form
			)
		);
	}
}