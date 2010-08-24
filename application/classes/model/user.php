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
	// column definitions
	protected $_table_columns = array(
		'id' => array(
			'type' => 'int',
			'min' => '-2147483648',
			'max' => '2147483647',
			'column_name' => 'id',
			'column_default' => '',
			'data_type' => 'int',
			'is_nullable' => false,
			'ordinal_position' => '1',
			'display' => '11',
			'comment' => '',
			'extra' => 'auto_increment',
			'key' => 'PRI',
			'privileges' => 'select,insert,update,references',
			
			'field_size' => 6,
			'edit_flag' => 1,
		),
		'username' => array(
			'type' => 'string',
			'column_name' => 'username',
			'column_default' => '',
			'data_type' => 'varchar',
			'is_nullable' => false,
			'ordinal_position' => '2',
			'character_maximum_length' => '100',
			'collation_name' => 'utf8_general_ci',
			'comment' => '',
			'extra' => '',
			'key' => 'UNI',
			'privileges' => 'select,insert,update,references',
		),
		'password' => array(
			'type' => 'password',
			'column_name' => 'password',
			'column_default' => '',
			'data_type' => 'varchar',
			'is_nullable' => false,
			'ordinal_position' => '3',
			'character_maximum_length' => '35',
			'collation_name' => 'utf8_general_ci',
			'comment' => '',
			'extra' => '',
			'key' => 'MUL',
			'privileges' => 'select,insert,update,references',
		),
		'password_confirm' => array(
			'type' => 'password',
			'data_type' => 'varchar',
		),
		'first_name' => array(
			'type' => 'string',
			'column_name' => 'first_name',
			'column_default' => '',
			'data_type' => 'varchar',
			'is_nullable' => false,
			'ordinal_position' => '4',
			'character_maximum_length' => '128',
			'collation_name' => 'utf8_general_ci',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
		),
		'last_name' => array(
			'type' => 'string',
			'column_name' => 'last_name',
			'column_default' => '',
			'data_type' => 'varchar',
			'is_nullable' => false,
			'ordinal_position' => '5',
			'character_maximum_length' => '128',
			'collation_name' => 'utf8_general_ci',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
		),
		'inactive_flag' => array(
			'type' => 'checkbox',
			'min' => '-128',
			'max' => '127',
			'column_name' => 'inactive_flag',
			'column_default' => 1,
			'data_type' => 'tinyint',
			'is_nullable' => false,
			'ordinal_position' => '6',
			'display' => '1',
			'comment' => '',
			'extra' => '',
			'key' => 'MUL',
			'privileges' => 'select,insert,update,references',
		),
		'passphrase_q' => array(
			'type' => 'string',
			'column_name' => 'passphrase_q',
			'column_default' => '',
			'data_type' => 'varchar',
			'is_nullable' => false,
			'ordinal_position' => '7',
			'character_maximum_length' => '150',
			'collation_name' => 'utf8_general_ci',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
		),
		'passphrase_a' => array(
			'type' => 'string',
			'column_name' => 'passphrase_a',
			'column_default' => '',
			'data_type' => 'varchar',
			'is_nullable' => false,
			'ordinal_position' => '8',
			'character_maximum_length' => '50',
			'collation_name' => 'utf8_general_ci',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
		),
		'login_count' => array(
			'type' => 'int',
			'min' => '-32768',
			'max' => '32767',
			'column_name' => 'login_count',
			'column_default' => '',
			'data_type' => 'smallint',
			'is_nullable' => false,
			'ordinal_position' => '9',
			'display' => '6',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
		),
	);
    
    // relationships
    protected $_has_many = array('group' => array('through' => 'user_group', 'foreign_key' => 'grop_id', 'far_key' => 'group_id'));
    
	// Validation rules
	protected $_rules = array(
		'username' => array(
			'not_empty'  => true,
			'min_length' => array(4),
			'max_length' => array(255),
			//'regex'      => array('/^[-\pL\pN_.]++$/uD'),
		),
		'first_name' => array('not_empty' => true),
		'last_name' => array('not_empty' => true),
		'password' => array(
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