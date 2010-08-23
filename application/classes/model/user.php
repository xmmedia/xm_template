<?php defined('SYSPATH') or die ('No direct script access.');
/**
 * 
 */
class Model_User extends ORM
{
    protected $_db = DEFAULT_DB; // or any db group defined in database configuration
 
    protected $_table_names_plural 	 = false;
    protected $_table_name  = 'user'; // default: accounts
    protected $_primary_key = 'id';      // default: id
    protected $_primary_val = 'username';      // default: name (column used as primary value)
 
    // default for $_table_columns: use db introspection to find columns and info
    // see http://v3.kohanaphp.com/guide/api/Database_MySQL#list_columns for all possible column attributes
    //protected $_table_columns = array(
    //    'column_name'   => array('data_type' => 'int',    'is_nullable' => FALSE),
    //    'column_name2'  => array('data_type' => 'string', 'is_nullable' => TRUE),
    //);
 
    // fields mentioned here can be accessed like properties, but will not be referenced in write operations
    //protected $_ignored_columns = array(
    //    'helper_field',
    //);
    
    // relationships
    protected $_has_many = array('group' => array('through' => 'user_group', 'foreign_key' => 'grop_id', 'far_key' => 'group_id'));
}