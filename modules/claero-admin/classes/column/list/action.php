<?php

class Column_List_Action extends Column_List {
    /**
     * @var string The anchor text linking to the action specified.  Contains {id} where the ID will be inserted.
     */
    public $anchor_text;
    
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
            'anchor_text'   => '<a href="' . $url_prefix . $property_name . '/{id}">' . $display_name . '</a>',
        ));
    }
    
    /**
     * Displays this column from the given record.
     *
     * @param object $record The record to display this column from.
     */
    public function value($record) {
        return str_replace("{id}", $record->id, $this->anchor_text);
    }
    
    /**
     * Action columns have no header.
     */
    public function header() {
        return '';
    }
}