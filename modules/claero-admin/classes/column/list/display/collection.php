<?php

class Column_List_Display_Collection extends Column_List_Display {
    /**
     * @var string The field from the collection objects to display as value.
     */
    protected $display_field;
    
    /**
     * @var integer The maximum number of entries of the collection to show.
     */
    protected $max_entries;
    
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
            'display_field' => 'name',
            'max_entries'   => 3,
        ));
    }
    
    /**
     * Displays this column from the given record.
     *
     * @param object $record The record to display this column from.
     */
    public function value($record) {
        // Get all values for this record
        $values = Arr::pluck($this->display_field, $record->{$this->property_name}->as_array());
        
        // Only display the first max_entries of them
        $display_values = array_slice($values, 0, $this->max_entries);
        
        // Add ellipsis if there are any entries not displayed
        return implode(", ", $display_values) . (count($values) > $this->max_entries ? '...' : '');
    }
}