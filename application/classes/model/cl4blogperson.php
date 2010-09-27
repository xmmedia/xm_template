<?php defined('SYSPATH') or die ('No direct script access.');

/**
 * This model was created using Claero_ORM and should provide
 * standard Kohana ORM features in additon to cl4 specific features.
 */

class Model_Cl4BlogPerson extends ORM {

	// these are default Kohana_ORM properties
	protected $_db = 'default'; // or any group in database configuration
	protected $_table_names_plural = false;
	protected $_table_name = 'cl4_blog_person';
	protected $_primary_key = 'id'; // default: id
	protected $_primary_val = 'name'; // default: name (column used as primary value)

	// these are cl4-specific properties
	public $_table_name_display = 'Blog Author'; // the friendly display name used for this object

	// column definitions
	// see http://v3.kohanaphp.com/guide/api/Database_MySQL#list_columns for all possible column attributes
	// see http://cl4.claero.com/en-ca/dokuwiki/cl4:model for cl4-specific properties
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
			// these are cl4-specific properties
			'field_type' => 'hidden',
			'display_order' => 1,
			'display_flag' => 0,
			'edit_flag' => 1,
			'search_flag' => 1,
			'view_flag' => 1,
			'field_size' => 30,
			'max_length' => 255,
			'min_width' => 0,
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
			'ordinal_position' => 2,
			'character_maximum_length' => '255',
			'collation_name' => 'utf8_unicode_ci',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
			// these are cl4-specific properties
			'field_type' => 'text',
			'display_order' => 1,
			'display_flag' => 1,
			'edit_flag' => 1,
			'search_flag' => 1,
			'view_flag' => 1,
			'field_size' => 30,
			'max_length' => 255,
			'min_width' => 0,
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
			'ordinal_position' => 3,
			'character_maximum_length' => '255',
			'collation_name' => 'utf8_unicode_ci',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
			// these are cl4-specific properties
			'field_type' => 'text',
			'display_order' => 1,
			'display_flag' => 1,
			'edit_flag' => 1,
			'search_flag' => 1,
			'view_flag' => 1,
			'field_size' => 30,
			'max_length' => 255,
			'min_width' => 0,
			'source_data' => '',
			'source_label' => 'name',
			'source_value' => 'id',
		),
		'email_address' => array(
			'type' => 'string',
			'column_name' => 'email_address',
			'column_default' => null,
			'data_type' => 'varchar',
			'is_nullable' => false,
			'ordinal_position' => 4,
			'character_maximum_length' => '255',
			'collation_name' => 'utf8_unicode_ci',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
			// these are cl4-specific properties
			'field_type' => 'text',
			'display_order' => 1,
			'display_flag' => 1,
			'edit_flag' => 1,
			'search_flag' => 1,
			'view_flag' => 1,
			'field_size' => 30,
			'max_length' => 255,
			'min_width' => 0,
			'source_data' => '',
			'source_label' => 'name',
			'source_value' => 'id',
		),
	);

	// column labels
	protected $_labels = array(
		'id' => 'Id',
		'first_name' => 'First Name',
		'last_name' => 'Last Name',
		'email_address' => 'Email Address',
	);

	// relationships
	protected $_has_one = array();
	protected $_has_many = array();
	protected $_belongs_to = array();

	// validation rules
	protected $_rules = array(
		'first_name' => array('not_empty' => array()),
		'email_address'    => array('not_empty' => array(), 'email' => array()),
	);
} // class
