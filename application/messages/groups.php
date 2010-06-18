<?php

return array(
    'name' => array(
        'unique'        => 'Name must be unique.',
        'not_empty'     => 'Name must not be empty.',
        'max_length'    => 'Name must be less than :param1 characters long.',
    ),
    'description' => array(
        'max_length'    => 'Description must be less than :param1 characters long.'
    )
);