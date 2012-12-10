<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'default' => array(
		'debug' => (KOHANA_ENVIRONMENT > Kohana::PRODUCTION),
		'from' => 'webmaster@example.com',
		'from_name' => 'Template4',
		'log_email' => ADMIN_EMAIL,
		'error_email' => ADMIN_EMAIL,
		/*'smtp' => array(
			'host' => 'smtp.mandrillapp.com',
			'username' => '',
			'password' => '',
			'port' => 587,
		),*/
	),
);