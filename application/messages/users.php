<?php

return array(
    'email' => array(
        'not_empty'     => 'Email must not be empty.',
        'max_length'    => 'Email must be less than :param1 characters long.',
    ),
    'password' => array(
        'not_empty'     => 'Password must not be empty.',
        'min_length'    => 'Password must be at least :param1 characters long.',
        'max_length'    => 'Password must be less than :param1 characters long.',
    ),
    'password_confirm'  => array(
        'not_empty'     => 'Password confirm must not be empty.',
        'matches'       => 'Password confirm must match password.',
        'min_length'    => 'Password confirm must be at least :param1 characters long.',
        'max_length'    => 'Password confirm must be less than :param1 characters long.',
    ),
    'name' => array(
        'not_empty'     => 'Name must not be empty.',
        'max_length'    => 'Name must be less than :param1 characters long.',
    )
);