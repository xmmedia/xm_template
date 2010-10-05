<?php


class Controller_Auth extends Controller_Base {
    	function action_register()
	{
		#If user already signed-in
		if(Auth::instance()->logged_in()!= 0){
			#redirect to the user account
                        Request::instance()->redirect('account/myaccount');
		}

		#Load the view
		$content = $this->template->body_html = View::factory('register');

		#If there is a post and $_POST is not empty
		if ($_POST)
		{
			#Instantiate a new user
			$user = ORM::factory('user');

			#Load the validation rules, filters etc...
			$post = $user->validate_create($_POST);

			#If the post data validates using the rules setup in the user model
			if ($post->check())
			{
				#Affects the sanitized vars to the user object
				$user->values($post);

				#create the account
				$user->save();

				#Add the login role to the user
				$login_role = new Model_Role(array('name' =>'login'));
				$user->add('roles',$login_role);

				#sign the user in
				Auth::instance()->login($post['username'], $post['password']);

				#redirect to the user account
				Request::instance()->redirect('account/myaccount');
			}
			else
			{
                                #Get errors for display in view
			    $errors = $post->errors('register');
			    foreach ($errors as $error) {
					$this->template->body_html .= $error . HEOL;
			    }

			}
		}
	}




	public function action_signin()
	{
		#If user already signed-in
		if(Auth::instance()->logged_in()!= 0){
			#redirect to the user account
			Request::instance()->redirect('account/myaccount');
		}

		$content = $this->template->content = View::factory('signin');

		#If there is a post and $_POST is not empty
		if ($_POST)
		{
			#Instantiate a new user
			$user = ORM::factory('user');

			#Check Auth
			$status = $user->login($_POST);

			#If the post data validates using the rules setup in the user model
			if ($status)
			{
				#redirect to the user account
				Request::instance()->redirect('account/myaccount');
			}else
			{
                                #Get errors for display in view
				$content->errors = $_POST->errors('signin');
			}

		}
	}




	public function action_signout()
	{
		#Sign out the user
		Auth::instance()->logout();

		#redirect to the user account and then the signin page if logout worked as expected
		Request::instance()->redirect('account/myaccount');
	}
}