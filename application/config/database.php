<?php defined('SYSPATH') or die('No direct access allowed.');

return array(
	'development' => array(
		'type'       => 'MySQLi',
		'connection' => array(
			'hostname'   => 'localhost',
			'port'       => 3306,
			'database'   => 'templat1_main',
			'username'   => 'templat1_main',
			'password'   => '1j,r08o825dM<304>8y',
			'persistent' => FALSE,
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
		'profiling'    => TRUE,
	),

	'production' => array(
		'type'       => 'MySQLi',
		'connection' => array(
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
		'profiling'    => FALSE,
	),
);