<?php defined('SYSPATH') or die ('No direct script access.');

/**
 * This model was created using Claero_ORM and should provide
 * standard Kohana ORM features in additon to cl4 specific features.
 */

class Model_Cl4BlogPostTag extends Claero_ORM {

	protected $_db = 'default'; // or any group in database configuration
	protected $_table_names_plural = false;
	protected $_table_name = 'cl4_blog_post_tag';
	protected $_primary_key = 'id'; // default: id
	protected $_primary_val = 'cl4_blog_post_id'; // default: name (column used as primary value)

	// column labels
	protected $_labels = array(
		'cl4_blog_post_id' => 'Blog Post',
		'cl4_blog_tag_id' => 'Blog Tag',
	);

	public $_table_name_display = 'Blog Post Tags';

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
			// cl4-specific properties
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
			'source_data' => 'cl4_blog_post',
			'source_label' => 'title',
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
			'source_data' => 'cl4_blog_tag',
			'source_label' => 'name',
			'source_value' => 'id',
		),
	);

	// relationships
	protected $_has_one = array();
	protected $_has_many = array();
	protected $_belongs_to = array(
		'cl4blogpost' => array('foreign_key' => 'cl4_blog_post_id'),
		'cl4blogtag' => array('foreign_key' => 'cl4_blog_tag_id')
	);

	// validation rules
	protected $_rules = array(

	);
} // class
