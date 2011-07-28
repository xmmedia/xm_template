<?php

/**
* Config for template4.claero.com
*/

define('KOHANA_ENVIRONMENT', 4); // development
define('DEVELOPMENT_FLAG', TRUE);
define('CACHE_FLAG', FALSE);
define('DEBUG_FLAG', TRUE);
define('UNAVAILABLE_FLAG', FALSE);
define('LONG_NAME', 'cl4 Template Site');
define('SHORT_NAME', 'cl4template');
define('APP_VERSION', '0.1');
if ( ! isset($_SERVER['SERVER_PORT'])) {
	define('HTTP_PROTOCOL', 'http');
} else {
	define('HTTP_PROTOCOL', ($_SERVER['SERVER_PORT'] == '443' ? 'https' : 'http'));
}
define('URL_ROOT', HTTP_PROTOCOL . '://template4.claero.com');
define('ABS_ROOT', '/home/templat4/template4.claero.com');
define('ANALYTICS_ID', 'UA-468095-28'); // UA-468095-28 is for template4.claero.com
define('RECAPTCHA_PUBLIC_KEY', '6LfEc78SAAAAAK0dnSQ7bu9NgcEA-PSku-7qR2w8');
define('RECAPTCHA_PRIVATE_KEY', '6LfEc78SAAAAAAOLItfy5lH_x-43dZxXF-cCblC6');
define('DATABASE_DEFAULT', 'development');
define('SESSION_TYPE', 'database');
define('ADMIN_EMAIL', 'darryl.hein@claero.com');