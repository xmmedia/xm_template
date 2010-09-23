<?php defined('SYSPATH') or die ('No direct script access.');

/**
 * This model was created using Claero_ORM and should provide
 * standard Kohana ORM features in additon to cl4 specific features.
 */

class Model_Role extends Model_Auth_Role {

	//protected $_db = 'default'; // or any group in database configuration
	protected $_table_names_plural = FALSE;
	protected $_table_name = 'role';
	protected $_table_name_display = 'Role';
	//protected $_primary_key = 'id'; // default: id
	//protected $_primary_val = 'username'; // default: name (column used as primary value)
	// see http://v3.kohanaphp.com/guide/api/Database_MySQL#list_columns for all possible column attributes

	protected $_has_many = array('user' => array('through' => 'role_user'));

} // class
