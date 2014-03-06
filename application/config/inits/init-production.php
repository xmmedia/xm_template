<?php

/**
* Production config: template4.xmmedia.net
*/

define('KOHANA_ENVIRONMENT', 10); // production
define('DEVELOPMENT_FLAG', FALSE);
define('DEBUG_FLAG', DEVELOPMENT_FLAG);
define('UNAVAILABLE_FLAG', FALSE);
define('CACHE_FLAG', FALSE);
define('LONG_NAME', 'XM Template Site');
if ( ! isset($_SERVER['SERVER_PORT'])) {
	define('HTTP_PROTOCOL', 'http');
} else {
	define('HTTP_PROTOCOL', ($_SERVER['SERVER_PORT'] == '443' ? 'https' : 'http'));
}
define('URL_ROOT', HTTP_PROTOCOL . '://template4.xmmedia.net');
define('ABS_ROOT', '/home/template/template4.xmmedia.net');
define('ANALYTICS_ID', '');
define('RECAPTCHA_PUBLIC_KEY', '');
define('RECAPTCHA_PRIVATE_KEY', '');
define('DATABASE_DEFAULT', 'production');
define('SESSION_TYPE', 'database');
define('ADMIN_EMAIL', 'admin@xmmedia.net');
define('CHANGE_SCRIPT_CONFIG', 'template4.xmmedia.net');