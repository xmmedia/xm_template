<?php

/**
* Production config
*/

define('KOHANA_ENVIRONMENT', 1); // production
define('DEVELOPMENT_FLAG', FALSE);
define('CACHE_FLAG', FALSE);
define('DEBUG_FLAG', FALSE);
define('FIREPHP_FLAG', FALSE);
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
define('ANALYTICS_ID', '');
define('RECAPTCHA_PUBLIC_KEY', '');
define('RECAPTCHA_PRIVATE_KEY', '');
define('DATABASE_DEFAULT', 'production');
define('SESSION_TYPE', 'database');
define('ADMIN_EMAIL', 'claero-support@claero.com');