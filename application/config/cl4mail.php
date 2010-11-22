<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'default' => array(
		'language' => 'en',
		'from' => 'webmaster@example.com',
		'from_name' => 'Website',
		'log_email' => ADMIN_EMAIL,
		'mailer' => 'smtp', // smtp or sendmail
		'smtp' => array(
			'host' => 'localhost',
			'username' => NULL,
			'password' => NULL,
			'port' => 25,
		),
	),
);