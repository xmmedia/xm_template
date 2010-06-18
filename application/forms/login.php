<?php

return array(
    'attributes' => array(
        'action' => '/account/login'
    ),
    'result_type' => 'array',
    'fields' => array(
        array(
            'type'          => 'hidden',
            'name'          => 'return_to'
        ),
        array(
            'type' => 'text',
            'name' => 'email',
            'label' => 'Email: ',
            'validation' => array(
                array(
                    'not_empty' => true,
                    'params'    => array(),
                    'error'     => __("Must enter an email address.")
                ),
                array(
                    'email'     => true,
                    'params'    => array(),
                    'error'     => __("Must enter a valid email address.")
                ),
                array(
                    'max_length' => true,
                    'params' => array(128),
                    'error' => __("Email address can not be longer than 128 characters.")
                )
            )
        ),
        array(
            'type' => 'password',
            'name' => 'password',
            'label' => 'Password: ',
            'validation' => array(
                array(
                    'not_empty' => true,
                    'params'    => array(),
                    'error'     => __("Must enter a password.")
                )
            )
        ),
        array(
            'type' => 'submit',
            'value'=> 'Save'
        )
    )
);