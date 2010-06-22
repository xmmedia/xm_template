<?php

class Column_List_Display extends Column_List {
    /**
     * Constructor.
     *
     * Set up sensible defaults for this column based on given name.
     *
     * @param string $name    The name of this column.
     * @param array  $options Options to override default properties with.
     */
    public function __construct($name, $options = array()) {
        $this->set_defaults($options, array(
            'property_name' => strtolower($name),
            'display_name'  => ucfirst(strtolower($name)),
        ));
    }
    
    /**
     * Displays this column from the given record.
     *
     * @param object $record The record to display this column from.
     */
    public function value($record) {
        // Collections are displayed a little differently
        if (is_object($record->{$this->property_name}) && 'Jelly_Collection' == get_class($record->{$this->property_name})) {
            $value = 'Collection';
        }
        else {
            $value = $record->{$this->property_name};
        }
        
        return $value;
    }
    
    /**
     * Displays the header for this column.
     */
    public function header() {
        return $this->display_name;
    }
}