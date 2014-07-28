<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'default' => array(
		'debug' => (KOHANA_ENVIRONMENT > Kohana::PRODUCTION),
		'from' => 'webmaster@example.com',
		'from_name' => 'Template4',
		'debug_email' => ADMIN_EMAIL,
		'allowed_debug_emails' => array(ADMIN_EMAIL),
		/*'smtp' => array(
			'host' => 'smtp.mandrillapp.com',
			'username' => '',
			'password' => '',
			'port' => 587,
		),*/
	),
);