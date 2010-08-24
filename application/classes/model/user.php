<?php defined('SYSPATH') or die ('No direct script access.');
/**
 * 
 */
class Model_User extends ClaeroORM
{
    protected $_db = DEFAULT_DB; // or any db group defined in database configuration
 
    protected $_table_names_plural 	 = false;
    protected $_table_name  = 'user'; // default: accounts
    protected $_primary_key = 'id';      // default: id
    protected $_primary_val = 'username';      // default: name (column used as primary value)
 
    // default for $_table_columns: use db introspection to find columns and info
    // see http://v3.kohanaphp.com/guide/api/Database_MySQL#list_columns for all possible column attributes
    protected $_table_columns = array(
        'id'                => array('data_type' => 'int',    'is_nullable' => FALSE),
        'username'          => array('data_type' => 'string', 'is_nullable' => FALSE),
        'password'          => array('data_type' => 'string', 'is_nullable' => FALSE),
        'password_confirm'  => array(),
        'first_name'        => array('data_type' => 'string', 'is_nullable' => FALSE),
        'last_name'         => array('data_type' => 'string', 'is_nullable' => FALSE),
        'inactive_flag'     => array('data_type' => 'string', 'is_nullable' => FALSE),
        'passphrase_q'      => array('data_type' => 'string', 'is_nullable' => FALSE),
        'passphrase_a'      => array('data_type' => 'string', 'is_nullable' => FALSE),
        'login_count'       => array('data_type' => 'int', 'is_nullable' => FALSE),
    );
    
    // relationships
    protected $_has_many = array('group' => array('through' => 'user_group', 'foreign_key' => 'grop_id', 'far_key' => 'group_id'));
    
	// Validation rules
	protected $_rules = array(
		'username' => array(
			'not_empty'  => NULL,
			'min_length' => array(4),
			'max_length' => array(255),
			//'regex'      => array('/^[-\pL\pN_.]++$/uD'),
		),
		'password' => array(
			'not_empty'  => NULL,
			'min_length' => array(4),
			'max_length' => array(255),
		),
		'password_confirm' => array(
			'matches'    => array('password'),
		),
	);

	// Validation callbacks
	//protected $_callbacks = array(
	//	'username' => array('username_available'),
	//	'email' => array('email_available'),
	//);

	// Field labels
	protected $_labels = array(
		'username'         => 'Email Address (username)',
		'password'         => 'Password',
		'password_confirm' => 'Password Confirmation',
		'first_name'       => 'First Name',
		'last_name'        => 'Last Name',
		'inactive_flag'    => 'Inactive Flag',
		'passphrase_q'     => 'Passphrase Question',
		'passphrase_a'     => 'Passphrase Answer',
	);

 
    // fields mentioned here can be accessed like properties, but will not be referenced in write operations
    //protected $_ignored_columns = array(
    //    'helper_field',
    //);
     
    
    // cl4 additions
    protected $form_options = array(
    	'form_type' => 'post',
    	
    );
}