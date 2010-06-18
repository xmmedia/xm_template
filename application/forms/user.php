<?php

return array(
    'attributes' => array(
        'action' => '/account/register'
    ),
    'result_type' => 'array',
    'fields' => array(
        array(
            'type'          => 'hidden',
            'name'          => 'return_to',
            'validation'    => array() // Validation happens in model
        ),
        array(
            'type' => 'text',
            'name' => 'email',
            'label' => 'Email: ',
            'validation' => array() // Validation happens in model
        ),
        array(
            'type' => 'password',
            'name' => 'password',
            'label' => 'Password: ',
            'validation' => array() // Validation happens in model
        ),
        array(
            'type' => 'password',
            'name' => 'password_confirm',
            'label' => 'Confirm Password: ',
            'validation' => array() // Validation happens in model
        ),
        array(
            'type' => 'text',
            'name' => 'name',
            'label' => 'Name: ',
            'validation' => array() // Validation happens in model
        ),
        array(
            'type' => 'submit',
            'value'=> 'Save'
        )
    )
);