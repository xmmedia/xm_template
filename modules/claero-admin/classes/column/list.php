<?php

abstract class Column_List extends DefaultOverridable {
    /**
     * The name of the property displayed in this column.
     */
    public $property_name = '';
    
    /**
     * The name to display to the user.
     */
    public $display_name = '';
    
    /**
     * Displays this column from the given record.
     *
     * @param object $record The record to display this column from.
     */
    abstract public function value($record);
    
    /**
     * Displays the header for this column.
     */
    abstract public function header();
}