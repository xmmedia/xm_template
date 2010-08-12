<?php defined('SYSPATH') or die ('No direct script access.');

class Model_Locale extends Jelly_Model
{
    public static function initialize(Jelly_Meta $meta)
    {
        $meta->table('locale')
            ->sorting(array('name' => 'ASC'))
            ->fields(array(
                'id' => new Field_Primary(array(
                    'column' => 'id',
                )),
                'name' => new Field_String(array(
                    'column' => 'name',
                    'label' => 'Name',
                    'unique' => FALSE,
                    'rules' => array(
                        'max_length' => array(255),
                        'not_empty' => array(TRUE)
                    )
                )),
                'description' => new Field_Text(array(
                    'column' => 'description',
                    'label' => 'Description',
                    'rules' => array(
                        //'max_length' => array(255),
                        //'not_empty' => array(FALSE)
                    )
                )),

        ));
    }
}
