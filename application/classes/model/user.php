<?php defined('SYSPATH') or die ('No direct script access.');
/**
 * Modified for Trialto, taken originally from: Jelly Auth User Model
 * @package Jelly Auth
 * @author	Israel Canasa
 */
class Model_User extends Jelly_Model
{
	public static function initialize(Jelly_Meta $meta)
    {
		$meta->table('user')
            ->name_key('username')
            ->sorting(array('username' => 'ASC'))
            ->fields(array(
                'id' => new Field_Primary,
                'inactive_flag' => new Field_Integer(array(
                    'label' => 'Inactive Flag',
                )),
                'username' => new Field_Email(array(
                    'label' => 'Email Address',
                    'unique' => TRUE,
                    'rules' => array(
                        'not_empty' => array(true),
                        'max_length' => array(100),
                        )
                )),
    			'password' => new Field_Password(array(
    				'rules' => array(
    					'not_empty' => array(true),
    					'max_length' => array(50),
    					'min_length' => array(6)
    				)
    			)),
    			'password_confirm' => new Field_Password(array(
    				'in_db' => false,
    				'callbacks' => array(
    					'matches' => array('Model_User', '_check_password_matches')
    				),
    				'rules' => array(
    					'not_empty' => array(true),
    					'max_length' => array(50),
    					'min_length' => array(6)
    				)
    			)),
    			'first_name' => new Field_String(array(
    				'rules' => array(
    					'not_empty' => array(true),
    					'max_length' => array(255)
    				)
    			)),
    			'last_name' => new Field_String(array(
    				'rules' => array(
    					'not_empty' => array(true),
    					'max_length' => array(255)
    				)
    			)),
    			'name' => new Field_String(array(
    			     'label' => 'Full Name',
    			     'in_db' => false,
    			     // tbd
    			)),
    			'login_count' => new Field_Integer(array(
    				'default' => 0
    			)),
    			'tokens' => new Field_HasMany(array(
    				'foreign' => 'user_token'
    			)),
    			//'groups' => new Field_ManyToMany(array(
    			//	'through' => 'user_group'
    			//))
        ));
    }

	/**
	 * Validate callback wrapper for checking password match
	 * @param Validate $array
	 * @param string   $field
	 * @return void
	 */
	public static function _check_password_matches(Validate $array, $field)
	{
		$auth = Auth::instance();
		
		if ($array['password'] !== $array[$field])
		{
			// Re-use the error messge from the 'matches' rule in Validate
			$array->error($field, 'matches', array('param1' => 'password'));
		}
	}
	
	/**
	 * Check if user has a particular role
	 * @param mixed $role 	Role to test for, can be Model_Role object, string role name of integer role id
	 * @return bool			Whether or not the user has the requested role
	 */
	public function has_role($role) {
		// Check what sort of argument we have been passed
		if ($role instanceof Model_Role) {
			$key = 'id';
			$val = $role->id;
		}
		elseif (is_string($role)) {
			$key = 'name';
			$val = $role;
		}
		else {
			$key = 'id';
			$val = (int) $role;
		}

		foreach ($this->groups as $group) {
			// If user is a Superuser, they are authorized to do all things
			if ('Superuser' == $group->name) {
				return true;
			}
			
			foreach ($group->roles as $user_role) {	
				if ($user_role->{$key} === $val) {
					return true;
				}
			}
		}
		
		return true;
	}
	
	/**
	 * Check if user has a list of roles.
	 * 
	 * @param array(string) $required_roles List of roles to test for.
	 */
	public function authorize($required_roles) {
		$user_roles = array();
		
		// Get all roles user has
		foreach($this->groups as $group) {
			// If user is a Superuser, they are authorized to do all things
			if ('Superuser' == $group->name) {
				return;
			}
			
			foreach ($group->roles as $role) {
				$user_roles[] = $role->name;
			}
		}
		
		// Get roles that are missing
		$missing_roles = array_diff($required_roles, $user_roles);
		
		// If there are any missing, user is not authorized
		if (count($missing_roles) > 0) {
			throw new Exception_NotAuthorized($missing_roles);
		}
	}
} // End Model_Auth_User