<?php defined('SYSPATH') or die ('No direct script access.');

class Model_Content extends Jelly_Model
{
    public static function initialize(Jelly_Meta $meta)
    {
        $meta->table('content')
            //->sorting(array('short_name' => 'ASC'))
            ->fields(array(
                'id' => new Field_Primary(array(
                )),
                'summary' => new Field_String(array(
                    'label' => 'Summary',
                    'default' => '',
                    'rules' => array(
                        'max_length' => array(255),
                    )
                )),
                'title' => new Field_String(array(
                    'label' => 'Title',
                    'rules' => array(
                        'max_length' => array(255),
                        //'not_empty' => array(TRUE)
                    )
                )),
                'html' => new Field_String(array(
                    'label' => 'HTML Content',
                    'rules' => array(
                        //'max_length' => array(255),
                        //'not_empty' => array(TRUE)
                    )
                )),
                'meta_keywords' => new Field_String(array(
                    'label' => 'HTML META Keywords',
                    'rules' => array(
                        'max_length' => array(255),
                        //'not_empty' => array(TRUE)
                    )
                )),
                'meta_description' => new Field_String(array(
                    'label' => 'HTML META Description',
                    'rules' => array(
                        'max_length' => array(255),
                        //'not_empty' => array(TRUE)
                    )
                )),
                'publish_flag' => new Field_Integer(array(
                    'default' => 1,
                    'label' => 'Publish Flag',
                    'rules' => array(
                        'max_length' => array(1),
                    )
                )),
                'locale_id' => new Field_BelongsTo(array(
                    'foreign' => 'locale.id',
                )),
                'page_id' => new Field_BelongsTo(array(
                    'foreign' => 'page.id',
                )),
                'article_id' => new Field_BelongsTo(array(
                    'foreign' => 'article.id',
                )),
        ));
    }
}
