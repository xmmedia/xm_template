<?php defined('SYSPATH') or die ('No direct script access.');

/**
 * This model was created using Claero_ORM and should provide
 * standard Kohana ORM features in additon to cl4 specific features.
 */

class Model_Locale extends ORM {

	protected $_db = 'default'; // or any group in database configuration
	protected $_table_names_plural = false;
	protected $_table_name = 'locale';
	protected $_table_name_display = 'Locale';
	protected $_primary_key = 'id'; // default: id
	protected $_primary_val = 'name'; // default: name (column used as primary value)
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
			'list_flag' => 0,
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
		'name' => array(
			'type' => 'string',
			'column_name' => 'name',
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
			'field_type' => 'text',
			'display_order' => 1,
			'list_flag' => 1,
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
		'description' => array(
			'type' => 'string',
			'character_maximum_length' => '65535',
			'column_name' => 'description',
			'column_default' => null,
			'data_type' => 'text',
			'is_nullable' => false,
			'ordinal_position' => 3,
			'collation_name' => 'utf8_unicode_ci',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
			'field_type' => 'text',
			'display_order' => 1,
			'list_flag' => 1,
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
		'name' => 'Name',
		'description' => 'Description',
	);

	// relationships
	protected $_has_one = array();
	protected $_has_many = array();
	protected $_belongs_to = array();

	// validation rules
	protected $_rules = array(
	);
} // class
