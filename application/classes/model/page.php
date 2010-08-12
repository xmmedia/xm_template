<?php defined('SYSPATH') or die ('No direct script access.');

class Model_Page extends Jelly_Model
{
    public static function initialize(Jelly_Meta $meta)
    {
        $meta->table('page')
            ->fields(array(
                'id' => new Field_Primary(array(
                )),
                'short_name' => new Field_String(array(
                    'label' => 'Short Name',
                    'unique' => TRUE,
                    'rules' => array(
                        'max_length' => array(32),
                        'not_empty' => array(TRUE),
                        //'min_length' => array(6)
                    )
                )),
                'publish_flag' => new Field_Integer(array(
                    'default' => 0,
                    'label' => 'Publish Flag',
                    'rules' => array(
                        'max_length' => array(1),
                    )
                )),
                'publish_start_time' => new Field_String(array(
                    'label' => 'Start Publish Date',
                    )
                ),
                'publish_end_time' => new Field_String(array(
                    'label' => 'End Publish Date',
                    )
                ),
                'section' => new Field_BelongsTo(array(
                    'column' => 'section_id',
                    'foreign' => 'section.id',
                    'rules' => array(
                        'not_empty' => array(TRUE),
                    ),
                )),
                'content' => new Field_HasMany(array(
                    'foreign' => 'content.page_id',
                )),
                
                //'content' => 
        ));
    }
}
