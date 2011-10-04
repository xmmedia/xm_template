<?php defined('SYSPATH') or die('No direct access allowed.');

return array(
	'development' => array(
		'type'       => 'mysql',
		'connection' => array(
			/**
			 * The following options are available for MySQL:
			 *
			 * string   hostname    server hostname, or socket
             * string   port        server port
			 * string   database    database name
			 * string   username    database username
			 * string   password    database password
			 * boolean  persistent  true to use persistent connections
			 *
			 * Ports and sockets may be appended to the hostname.
			 */
			'hostname'   => 'localhost',
			'port'       => 3306,
			'database'   => 'template_main',
			'username'   => 'template_main',
			'password'   => '_wrVyi95utzl\'09}@{p',
			'persistent' => FALSE,
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => TRUE,
	),
);