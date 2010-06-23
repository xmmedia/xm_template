<?php defined('SYSPATH') OR die('No direct access allowed.');

switch (ENVIRONMENT) {
    case ENVIRONMENT_LOCAL:
        return array (
            'default' => array (
                'type'       => 'mysql',
                'connection' => array(
                    'hostname'   => 'localhost',
                    'username'   => 'claero',
                    'password'   => 'claero',
                    'persistent' => FALSE,
                    'database'   => 'claero',
                ),
                'table_prefix' => '',
                'charset'      => 'utf8',
                'caching'      => FALSE,
                'profiling'    => TRUE,
            )
        );
    break;

    case ENVIRONMENT_STORM6:
       return array (
            'default' => array (
                'type'       => 'mysql',
                'connection' => array(
                    'hostname'   => 'localhost',
                    'username'   => 'templat4_core',
                    'password'   => 'template467',
                    'persistent' => FALSE,
                    'database'   => 'templat4_core',
                ),
                'table_prefix' => '',
                'charset'      => 'utf8',
                'caching'      => FALSE,
                'profiling'    => TRUE,
            )
        );
    break;
}