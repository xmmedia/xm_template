<?php defined('SYSPATH') or die ('No direct script access.');

/**
 * This model was created using Claero_ORM and should provide
 * standard Kohana ORM features in additon to cl4 specific features.
 */

class Model_User extends Model_Auth_User {

	//protected $_db = 'default'; // or any group in database configuration
	protected $_table_names_plural = FALSE;
	protected $_table_name = 'user';
	protected $_table_name_display = 'User';
	protected $_primary_key = 'id'; // default: id
	protected $_primary_val = 'username'; // default: name (column used as primary value)
	// see http://v3.kohanaphp.com/guide/api/Database_MySQL#list_columns for all possible column attributes

	// column labels
	protected $_labels = array(
		'id' => 'ID',
		'date_expired' => 'Date Expired',
		'username' => 'Username',
		'password' => 'Password',
		'first_name' => 'First Name',
		'last_name' => 'Last Name',
		'inactive_flag' => 'Inactive Flag',
		'login_count' => 'Login Count',
		'last_login' => 'Last Login',
		'reset_token' => 'Reset Password Token',
	);

	protected $_table_columns = array(
		'last_login' => array(
			'edit_flag' => TRUE,
			'field_type' => 'datetime',
		),
	);

	// relationships
    protected $_has_many = array(
		'user_token' => array('model' => 'user_token'), // todo: source model shouldn't be needed
		'role'       => array('model' => 'role', 'through' => 'role_user'),
	);

	// Columns to ignore
	protected $_ignored_columns = array('password_confirm');

	public function __construct($id = NULL, $options = array()) {
		parent::__construct($id, $options);

		$this->_rules['username']['regex'] = array('/^[-\pL\pN_@.]++$/uD');
	}

    /**
	 * Allows a model use both email and username as unique identifiers for login
	 *
	 * @param   string  unique value
	 * @return  string  field name
	 */
	public function unique_key($value)
	{
		return 'username';
	}

} // class
