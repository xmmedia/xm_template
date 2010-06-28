<?php defined('SYSPATH') OR die('No direct access allowed.');

switch (Kohana::config('environment.server')) {
    case 'local':
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

    case 'storm6':
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