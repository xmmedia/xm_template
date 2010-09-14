<?php defined('SYSPATH') or die ('No direct script access.');

/**
 * This model was created using Claero_ORM and should provide
 * standard Kohana ORM features in additon to cl4 specific features.
 */

class Model_Cl4BlogPost extends Claero_ORM {

	protected $_db = 'default'; // or any group in database configuration
	protected $_table_names_plural = false;
	protected $_table_name = 'cl4_blog_post';
	protected $_primary_key = 'id'; // default: id
	protected $_primary_val = 'name'; // default: name (column used as primary value)

	// column labels
	protected $_labels = array(
		'id' => 'Id',
		'cl4_blog_person_id' => 'Blog Author',
		'title' => 'Title',
		'post' => 'Post',
		'publish_flag' => 'Publish Flag',
		'publish_start_time' => 'Publish Start',
		'publish_end_time' => 'Publish End',
	);

	public $_table_name_display = 'Blog Post';

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
		'cl4_blog_person_id' => array(
			'type' => 'int',
			'min' => '-2147483648',
			'max' => '2147483647',
			'column_name' => 'cl4_blog_person_id',
			'column_default' => null,
			'data_type' => 'int',
			'is_nullable' => false,
			'ordinal_position' => 2,
			'display' => '11',
			'comment' => '',
			'extra' => '',
			'key' => 'MUL',
			'privileges' => 'select,insert,update,references',
			// cl4-specific properties
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
			'source_label' => 'email_address',
			'source_value' => 'id',
		),
		'title' => array(
			'type' => 'string',
			'column_name' => 'title',
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
			// cl4-specific properties
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
		'post' => array(
			'type' => 'string',
			'character_maximum_length' => '65535',
			'column_name' => 'post',
			'column_default' => null,
			'data_type' => 'text',
			'is_nullable' => false,
			'ordinal_position' => 4,
			'collation_name' => 'utf8_unicode_ci',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
			// cl4-specific properties
			'field_type' => 'textarea',
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
		'publish_flag' => array(
			'type' => 'int',
			'min' => '-128',
			'max' => '127',
			'column_name' => 'publish_flag',
			'column_default' => null,
			'data_type' => 'tinyint',
			'is_nullable' => false,
			'ordinal_position' => 5,
			'display' => '1',
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
			// cl4-specific properties
			'field_type' => 'checkbox',
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
		'publish_start_time' => array(
			'type' => 'string',
			'column_name' => 'publish_start_time',
			'column_default' => null,
			'data_type' => 'datetime',
			'is_nullable' => false,
			'ordinal_position' => 6,
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
			// cl4-specific properties
			'field_type' => 'datetime',
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
		'publish_end_time' => array(
			'type' => 'string',
			'column_name' => 'publish_end_time',
			'column_default' => null,
			'data_type' => 'datetime',
			'is_nullable' => false,
			'ordinal_position' => 7,
			'comment' => '',
			'extra' => '',
			'key' => '',
			'privileges' => 'select,insert,update,references',
			// cl4-specific properties
			'field_type' => 'datetime',
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

	// relationships
	protected $_has_one = array();
	protected $_has_many = array(
		'cl4blogtag' => array('through' => 'cl4blogposttag', 'foreign_key' => 'cl4_blog_post_id', 'far_key' => 'cl4_blog_tag_id')
	);
	protected $_belongs_to = array(
		'cl4blogperson' => array('foreign_key' => 'cl4_blog_person_id'), // or should this be has one?
	);

	// validation rules
	protected $_rules = array(
		'cl4_blog_person_id' => array('not_empty'  => array()),
		'title' => array('not_empty'  => array()),
		'post' => array('not_empty'  => array()),
	);
} // class
