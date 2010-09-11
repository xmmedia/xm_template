<?php defined('SYSPATH') or die ('No direct script access.');

/**
 * This model was created using Claero_ORM and should provide
 * standard Kohana ORM features in additon to cl4 specific features.
 */

class Model_User extends Claero_ORM {

	protected $_db = 'default'; // or any group in database configuration
	protected $_table_names_plural = false;
	protected $_table_name = 'user';
	protected $_table_name_display = 'User';
	protected $_primary_key = 'id'; // default: id
	protected $_primary_val = 'username'; // default: name (column used as primary value)
	// see http://v3.kohanaphp.com/guide/api/Database_MySQL#list_columns for all possible column attributes

	// column definitions
	protected $_table_columns = array(
		'id' => array(
			'type' => 'int',
			'min' => '-2147483648',
			'max' => '2147483647',
			'column_name' => 'id',
			'column_default' => null,
			'data_type' => 'int',
			'is_nullable' => false,
			'ordinal_position' => 1,
			'display' => '11',
			'comment' => '',
			'extra' => 'auto_increment',
			'key' => 'PRI',
			'privileges' => 'select,insert,update,references',
			'field_type' => 'hidden',
			'display_order' => 1,
			'display_flag' => 0,
			'edit_flag' => 1,
			'search_flag' => 1,
			'view_flag' => 1,
			'field_size' => 30,
			'max_length' => 255,
			'source_data' => '',
			'source_label' => 'name',
			'source_value' => 'id',
		),
		'username' => array(
			'type' => 'string',
			'column_name' => 'username',
			'column_default' => null,
			'data_type' => 'varchar',
			'is_nullable' => false,
			'ordinal_position' => 2,
			'character_maximum_length' => '100',
			'collation_name' => 'utf8_general_ci',
			'comment' => '',
			'extra' => '',
			'key' => 'UNI',
			'privileges' => 'select,insert,update,references',
			'field_type' => 'text',
			'display_order' => 1,
			'display_flag' => 1,
			'edit_flag' => 1,
			'search_flag' => 1,
			'view_flag' => 1,
			'field_size' => 30,
			'max_length' => 255,
			'source_data' => '',
			'source_label' => 'name',
			'source_value' => 'id',
		),
		'password' => array(
			'type' => 'string',
			'column_name' => 'password',
			'column_default' => null,
			'data_type' => 'varchar',
			'is_nullable' => false,
			'ordinal_position' => 3,
			'character_maximum_length' => '35',
			'collation_name' => 'utf8_general_ci',
			'comment' => '',
			'extra' => '',
			'key' => 'MUL',
			'privileges' => 'select,insert,update,references',
			'field_type' => 'password',
			'display_order' => 1,
			'display_flag' => 0,
			'edit_flag' => 1,
			'search_flag' => 0,
			'view_flag' => 0,
			'field_size' => 30,
			'max_length' => 255,
			'source_data' => '',
			'source_label' => 'name',
			'source_value' => 'id',
		),
		'first_name' => array(
			'type' => 'string',
			'column_name' => 'first_name',
			'column_default' => null,
			'data_type' => 'varchar',
			'is_nullable' => false,
			'ordinal_position' => 4,
			'character_maximum_length' => '128',
			'collation_name' => 'utf8_general_ci',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
			'field_type' => 'text',
			'display_order' => 1,
			'display_flag' => 1,
			'edit_flag' => 1,
			'search_flag' => 1,
			'view_flag' => 1,
			'field_size' => 30,
			'max_length' => 255,
			'source_data' => '',
			'source_label' => 'name',
			'source_value' => 'id',
		),
		'last_name' => array(
			'type' => 'string',
			'column_name' => 'last_name',
			'column_default' => null,
			'data_type' => 'varchar',
			'is_nullable' => false,
			'ordinal_position' => 5,
			'character_maximum_length' => '128',
			'collation_name' => 'utf8_general_ci',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
			'field_type' => 'text',
			'display_order' => 1,
			'display_flag' => 1,
			'edit_flag' => 1,
			'search_flag' => 1,
			'view_flag' => 1,
			'field_size' => 30,
			'max_length' => 255,
			'source_data' => '',
			'source_label' => 'name',
			'source_value' => 'id',
		),
		'inactive_flag' => array(
			'type' => 'int',
			'min' => '-128',
			'max' => '127',
			'column_name' => 'inactive_flag',
			'column_default' => null,
			'data_type' => 'tinyint',
			'is_nullable' => false,
			'ordinal_position' => 6,
			'display' => '1',
			'comment' => '',
			'extra' => '',
			'key' => 'MUL',
			'privileges' => 'select,insert,update,references',
			'field_type' => 'checkbox',
			'display_order' => 1,
			'display_flag' => 1,
			'edit_flag' => 1,
			'search_flag' => 1,
			'view_flag' => 1,
			'field_size' => 30,
			'max_length' => 255,
			'source_data' => '',
			'source_label' => 'name',
			'source_value' => 'id',
		),
		'login_count' => array(
			'type' => 'int',
			'min' => '-32768',
			'max' => '32767',
			'column_name' => 'login_count',
			'column_default' => null,
			'data_type' => 'smallint',
			'is_nullable' => false,
			'ordinal_position' => 7,
			'display' => '6',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
			'field_type' => 'text',
			'display_order' => 1,
			'display_flag' => 1,
			'edit_flag' => 1,
			'search_flag' => 1,
			'view_flag' => 1,
			'field_size' => 30,
			'max_length' => 255,
			'source_data' => '',
			'source_label' => 'name',
			'source_value' => 'id',
		),
	);

	// column labels
	protected $_labels = array(
		'id' => 'Id',
		'username' => 'Username',
		'password' => 'Password',
		'first_name' => 'First Name',
		'last_name' => 'Last Name',
		'inactive_flag' => 'Inactive Flag',
		'login_count' => 'Login Count',
	);

	// sorting
	protected $_sorting = array(
		'first_name' => 'ASC',
		'last_name' => 'ASC',
	);

	// relationships
	protected $_has_one = array();
	protected $_has_many = array();
	protected $_belongs_to = array();

	// validation rules
	protected $_rules = array(
		'username' => array(
			'not_empty'  => true,
			'min_length' => array(4),
			'max_length' => array(32),
			'regex'      => array('/^[-\pL\pN_.]++$/uD'),
		),
		'password' => array(
			'min_length' => array(5),
			'max_length' => array(42),
		),
		'password_confirm' => array(
			'matches'    => array('password'),
		),
		'first_name' => array(
			'not_empty' => true,
		),
		'last_name' => array(
			'not_empty' => true,
		)
	);

	// Columns to ignore
	protected $_ignored_columns = array('password_confirm');

} // class
