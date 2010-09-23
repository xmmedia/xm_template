<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Account extends Controller_Base {
    public $auth_required = FALSE;

   /** Controls access for separate actions
    *
    *  See Controller_App for how this implemented.
    *
    *  Examples:
    * 'adminpanel' => 'admin' will only allow users with the role admin to access action_adminpanel
    * 'moderatorpanel' => array('login', 'moderator') will only allow users with the roles login and moderator to access action_moderatorpanel
    */
   public $secure_actions = array(
      // user actions
      'profile' => 'login',
      );

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
		Request::instance()->redirect('account/profile');
	}

    /**
    * View: Profile editor
    */
   public function action_profile() {
      // set the template title (see Controller_App for implementation)
      $this->template->title = 'Edit user profile';
      $id = Auth::instance()->get_user()->id;
      // load the content from view
      $view = View::factory('claero/profile');

      // save the data
      if ( !empty($_POST) && is_numeric($id) ) {
         $model = null;
         // Load the validation rules, filters etc...
         $model = ORM::factory('user', $id);
         // password can be empty if an id exists - it will be ignored in save.
         if (is_numeric($id) && (empty($_POST['password']) || (trim($_POST['password']) == '')) )  {
            unset($_POST['password']);
            unset($model->password);
         }
         // editing requires that the username and email do not exist (EXCEPT for this ID)
         $post = $model->validate_edit($id, $_POST);

         // If the post data validates using the rules setup in the user model
         if ($post->check()) {
            // Affects the sanitized vars to the user object
            $model->values($post);
            // save first, so that the model has an id when the relationships are added
            $model->save();
            // message: save success
            Message::add('success', 'Values saved.');
            // redirect and exit
            Request::instance()->redirect('account/profile');
            return;
         } else {
            // Get errors for display in view
            Message::add('error', 'Validation errors: '.var_export($post->errors(), TRUE));
            // set the data from POST
            $view->set('defaults', $post->as_array());
         }
      } else {
         // load the information for viewing
         $model = ORM::factory('user', $id);
         $view->set('data', $model->as_array());
         // retrieve roles into array
         $roles = array();
         foreach($model->role->find_all() as $role) {
            $roles[$role->name] = $role->description;
         }
         $view->set('user_role', $roles);
      }
      $view->set('id', $id);
      $this->template->bodyHtml = $view;

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
                $resp = recaptcha_check_answer(RECAPTCHA_PRIVATE_KEY, $_SERVER['REMOTE_ADDR'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field']);
                if (!$resp->is_valid) {
                    claero::flash_set('message', __('The reCAPTCHA text did not match up, please try again.'));
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