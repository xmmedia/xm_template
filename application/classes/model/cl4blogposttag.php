<?php defined('SYSPATH') or die ('No direct script access.');

/**
 * This model was created using Claero_ORM and should provide
 * standard Kohana ORM features in additon to cl4 specific features.
 */

class Model_Cl4BlogPostTag extends Claero_ORM {

	protected $_db = 'default'; // or any group in database configuration
	protected $_table_names_plural = false;
	protected $_table_name = 'cl4_blog_post_tag';
	protected $_table_name_display = 'Cl4 Blog Post Tag';
	protected $_primary_key = 'id'; // default: id
	protected $_primary_val = 'name'; // default: name (column used as primary value)
	// see http://v3.kohanaphp.com/guide/api/Database_MySQL#list_columns for all possible column attributes

	// column definitions
	protected $_table_columns = array(
		'cl4_blog_post_id' => array(
			'type' => 'int',
			'min' => '-2147483648',
			'max' => '2147483647',
			'column_name' => 'cl4_blog_post_id',
			'column_default' => null,
			'data_type' => 'int',
			'is_nullable' => false,
			'ordinal_position' => 1,
			'display' => '11',
			'comment' => '',
			'extra' => '',
			'key' => 'MUL',
			'privileges' => 'select,insert,update,references',
			'field_type' => 'select',
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
		'cl4_blog_tag_id' => array(
			'type' => 'int',
			'min' => '-2147483648',
			'max' => '2147483647',
			'column_name' => 'cl4_blog_tag_id',
			'column_default' => null,
			'data_type' => 'int',
			'is_nullable' => false,
			'ordinal_position' => 2,
			'display' => '11',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
			'field_type' => 'select',
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
		'cl4_blog_post_id' => 'Cl4 Blog Post Id',
		'cl4_blog_tag_id' => 'Cl4 Blog Tag Id',
	);

	// relationships
	protected $_has_one = array();
	protected $_has_many = array();
	protected $_belongs_to = array();

	// validation rules
	protected $_rules = array(
	);
} // class
