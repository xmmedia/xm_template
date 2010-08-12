<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Account extends Controller_Base {


    public $redirctUrl = ''; // holds the url to which the user should be eventually redirected
    public $redirectPage = 'login';

    /**
     * Runs before the private controller tries to restrict access.
     */
    public function before() {
        parent::before();

        // Define roles required for actions
        switch($this->request->action) {
            case 'index':
                //$this->roles_required = array('view own account');
            break;
        }
        
        // need to figure out a safe way to do this if at all, for now just go home
        $this->redirectUrl = '/' . i18n::lang() . '/account';
    }
    
    /**
     * If the user is logged in, then the account page is displayed, otherwise the login page is displayed
     */
	public function action_index() {
	   
        // check to see if we are already logged in
        if ($this->auth->IsLoggedIn()) {
            $this->template->bodyHtml .= View::factory('pages/' . i18n::lang() . '/account') . EOL;
        } else {
            // display the login form
            //$this->template->bodyHtml .= "<p>Display the login form.<p>";
            $this->template->bodyHtml .= View::factory('pages/' . i18n::lang() . '/login') . EOL; 
        } // if
	}
    
    /**
     * Log a user in.
     */
    public function action_login() {
    
		// check to see if we are already logged in
		if ($this->auth->IsLoggedIn()) {
			claero::AddStatusMsg('You already appear to be logged in. (<a href="/account/destroy_seession">kill session</a>)');
		} else if (Request::$method == 'POST') {

            // check for the required post variables, clean them, etc. 
    		$submittedEmail = Security::xss_clean(Arr::get($_POST, 'username', false));
    		$submittedPassword = Security::xss_clean(Arr::get($_POST, 'password', false));

			// try to login
			if ($this->auth->Login($submittedEmail, $submittedPassword, false)) {
                
                // now get the user information
                $this->user = Jelly::select('user')->where('username', '=', $submittedEmail)->load(1);

                // make sure that the user is active
                if ($this->user->inactive_flag == 0) {
                    claero::AddStatusMsg('Login succeeded!');
    				$this->redirectUrl = '/';
                } else {
                    $this->auth->logout();
                    claero::AddStatusMsg('Your account has not yet been activated.  Please contact an administrator to have your account activated.  If you just registered, it may take a few days before someone processes your request.');
                } // if

			}
			claero::AddStatusMsg($this->auth->GetError());
		} else {
            // do something smart
            claero::AddStatusMsg("Invalid login request type (not POST).");
		}
		
		// redirect to login page or redirect page
		$this->request->redirect($this->redirectUrl);

    }
    
    /**
     * destroy the session and reload the main account page (login form)
     */
    public function action_destroy_session() {
    
        session_destroy();
        
        $this->request->redirect($this->redirectUrl);
        
    }
	
	/**
	 * Logs a user out.
	 */
	public function action_logout() {
	
		if ($this->auth->IsLoggedIn()) {
			$this->auth->Logout();
		}
		
		$this->request->redirect('/');
	}
	
	/**
	 * Registers a new user.
	 */
	public function action_register() {
	
		// see if the user is already logged in
		// todo: do something smarter here, like ask if they want to register a new user?
		if ($this->auth->logged_in()) {
			claero::flash_set('message', 'You already have an account.');
			$this->request->redirect($this->redirectUrl);
		}
		
		$this->redirectPage = 'register';
		
		if (Request::$method == 'POST') {
            // try to create a new user with the supplied credentials
            try {
            
                // check the recaptcha string to make sure it was entered properly    
                require_once(ABS_ROOT . '/lib/recaptcha/recaptchalib.php');
                $resp = recaptcha_check_answer(CAPTCHA_PRIVATE_KEY,
                    $_SERVER["REMOTE_ADDR"],
                    $_POST["recaptcha_challenge_field"],
                    $_POST["recaptcha_response_field"]
                );
                if (!$resp->is_valid) {
                    claero::flash_set('message', __("The reCAPTCHA text did not match up, please try again."));
                    Fire::log('The reCAPTCHA text did not match up, please try again.');
                } else {
                
                    // try to create the new user
                    $newUser = Jelly::factory('user')
                         ->set(array(
                            'active_flag' => 0, // already defaulted in database
                            'date_created' => date('Y-m-d H:i:s'),
                            'email' => Security::xss_clean(Arr::get($_POST, 'email', '')),
                            'password' => Security::xss_clean(Arr::get($_POST, 'password', '')),
                            'password_confirm' => Security::xss_clean(Arr::get($_POST, 'password_confirm', '')),
                            'first_name' => Security::xss_clean(Arr::get($_POST, 'first_name', '')),
                            'middle_name' => Security::xss_clean(Arr::get($_POST, 'middle_name', '')),
                            'last_name' => Security::xss_clean(Arr::get($_POST, 'last_name', '')),
                            'company' => Security::xss_clean(Arr::get($_POST, 'company', '')),
                            'province_id' => Security::xss_clean(Arr::get($_POST, 'province_id', '')),
                            'work_phone' => Security::xss_clean(Arr::get($_POST, 'work_phone', '')),
                            'mobile_phone' => Security::xss_clean(Arr::get($_POST, 'mobile_phone', '')),
                         ));
                    if ($newUser->save()) {
                        claero::flash_set('message', __("Your account was created successfully."));
                        $this->redirectPage = 'index';
                    } // if
                    //Fire::log('looks like it worked?');
                } // if
                
            } catch (Validate_Exception $e) {
                claero::flash_set('message', __("A validation error occurred, please correct your information and try again."));
                Fire::log('A validation exception occurred: ');
                Fire::log($e->array);
            
            } catch (Exception $e) {
                Fire::log('Some other exception occured');
                Fire::log($e);
                $this->template->bodyHtml .= 'Could not create user. Error: "' . $e->getMessage() . '"';
                claero::flash_set('message', 'An error occurred during registration, please try again later.');
                
            } // try
        } else {
            // invalid request type for registration
            Fire::log('invalid request type for registration');
		} // if
		
        // Redirect to login
        //$this->request->redirect($this->redirectUrl);
        fire::log('here we are');
        
        
        $this->provinceId = Security::xss_clean(Arr::get($_POST, 'province_id', ''));
        
	} // function action_register
	
} // class