<?php defined('SYSPATH') or die ('No direct script access.');

class Model_Article extends Jelly_Model
{
    public static function initialize(Jelly_Meta $meta)
    {
        $meta->table('article')
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
                'name' => new Field_String(array(
                    'label' => 'Name',
                    'unique' => FALSE,
                    'rules' => array(
                        'max_length' => array(255),
                        //'not_empty' => array(TRUE)
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
                )),
                'publish_end_time' => new Field_String(array(
                    'label' => 'End Publish Date',
                )),
                'section_id' => new Field_BelongsTo(array(
                    'foreign' => 'section.id',
                    'rules' => array(
                        'not_empty' => array(TRUE),
                        ),
                )),
                'content' => new Field_HasMany(array(
                    'foreign' => 'content.article_id',
                )),
                'author' => new Field_BelongsTo (array(
                    'column' => 'author_id',
                    'foreign' => 'person.id'
                
                )),
    			'category' => new Field_ManyToMany(array(                
                    'through' => array(
                        'model'   => 'article_category',
                        'columns' => array('article_id', 'category_id'),
                    ),
                )),
            ));
    }
/*
    // only works for article or page record, gets content with appropriate locale
    public function get_content($localeId, $maxLength = false, $htmlFlag = true) {
    
        $returnData = '';
    
        // todo OK this just doesn't work when there are tags!!!  you can't randomly truncate an html snippet and maintain integrity
        try {
            $returnData = $this->get('content')->where('locale_id','=',$localeId)->limit(1)->execute()->html;
            if ($maxLength && strlen($returnData) > $maxLength) {
                // have to truncate the string
                $returnData = substr($returnData, 0, $maxLength - 3) . '...';
                $returnData .= ($htmlFlag) ? HEOL : EOL;
            } // if
        } catch (Exception $e) {
            trigger_error('Error getting content.');
        }
        
        return $returnData;
    
    }

    // only works for article or page record, gets the short description of the content with appropriate locale
    public function get_summary($localeId) {
    
        $returnData = '';
    
        // todo OK this just doesn't work when there are tags!!!  you can't randomly truncate an html snippet and maintain integrity
        try {
            $returnData = $this->get('content')->where('locale_id','=',$localeId)->limit(1)->execute()->short_description;
        } catch (Exception $e) {
            trigger_error('Error getting content.');
        }
        
        return $returnData;
    
    }
*/    
    
    // only works for article or page record, gets the short description of the content with appropriate locale, get the content object or
    // the specific field if specified
    public function get_content($localeId, $field = false) {
    
        $returnData = false;
    
        try {
            $contentData = $this->get('content')->where('locale_id','=',$localeId)->limit(1)->execute();
            // return the object or the specified field
            if ($contentData->loaded()) $returnData = ($field) ? $contentData->$field : $contentData;
            
        } catch (Exception $e) {
            trigger_error('Error getting content.');
        }
        
        return $returnData;
    
    }


}
