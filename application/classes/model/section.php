<?php defined('SYSPATH') or die ('No direct script access.');

class Model_Section extends Jelly_Model
{
    public static function initialize(Jelly_Meta $meta)
    {
        $meta->table('section')->fields(array(
            'id' => new Field_Primary,
            'short_name' => new Field_String(array(
                'unique' => TRUE,
                'rules' => array(
                    'max_length' => array(32),
                    'not_empty' => array(TRUE)
                )
            )),
            'name' => new Field_String(array(
                'unique' => FALSE,
                'rules' => array(
                    'max_length' => array(255),
                    'not_empty' => array(TRUE)
                )
            )),
        ));
    }
}
