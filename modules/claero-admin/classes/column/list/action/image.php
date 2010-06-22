<?php

class Column_List_Action_Image extends Column_List_Action {
    /**
     * @var string The image source.
     */
    public $source;
    
    /**
     * Constructor.
     *
     * Set up sensible defaults for this column based on given name.
     *
     * @param string $name       The name of this column.
     * @param string $url_prefix Use this to start building URLs for actions (must end with /).
     * @param array  $options    Options to override default properties with.
     */
    public function __construct($name, $url_prefix, $options = array()) {
        $property_name = strtolower($name);
        $display_name = ucfirst(strtolower($name));
        
        $this->set_defaults($options, array(
            'property_name' => $property_name,
            'display_name'  => $display_name,
            'source'        => "/images/icons/$property_name.png",
            'anchor_text'   => '<a href="' . $url_prefix . $property_name . '/{id}" title="{display}"><img src="{source}" /></a>',
        ));
    }
    
    /**
     * Displays this column from the given record.
     *
     * @param object $record The record to display this column from.
     */
    public function value($record) {
        $value = str_replace("{id}",      $record->id,         $this->anchor_text);
        $value = str_replace("{source}",  $this->source,       $value);
        $value = str_replace("{display}", $this->display_name, $value);
        
        return $value;
    }
    
    /**
     * Action columns have no header.
     */
    public function header() {
        return '';
    }
}