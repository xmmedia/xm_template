<?php

class DefaultOverridable {
    /**
     * Sets this object's propertie either with the defaults or overrides with options.
     *
     * @param array $options  Options to override default values with.
     * @param array $defaults The default values for this class.  MUST CONTAIN ONE ENTRY FOR ALL PROPERTIES.
     */
    protected function set_defaults($options, $defaults) {
        foreach (array_keys(get_class_vars(get_class($this))) as $property) {
            $this->$property = isset($options[$property]) ? $options[$property] : $defaults[$property];
        }
    }
}