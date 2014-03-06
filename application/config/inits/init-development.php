<?php

/**
* Config for template4dev.xmmedia.net
*/

define('KOHANA_ENVIRONMENT', 40); // development
define('DEVELOPMENT_FLAG', TRUE);
define('DEBUG_FLAG', DEVELOPMENT_FLAG);
define('UNAVAILABLE_FLAG', FALSE);
define('CACHE_FLAG', FALSE);
define('LONG_NAME', 'XM Template Site');
if ( ! isset($_SERVER['SERVER_PORT'])) {
	define('HTTP_PROTOCOL', 'http');
} else {
	define('HTTP_PROTOCOL', ($_SERVER['SERVER_PORT'] == '443' ? 'https' : 'http'));
}
define('URL_ROOT', HTTP_PROTOCOL . '://template4dev.xmmedia.net');
define('ABS_ROOT', '/home/templat1/template4dev.xmmedia.net/');
define('ANALYTICS_ID', 'UA-17170806-9'); // UA-17170806-9 is for template4.xmmedia.net
define('RECAPTCHA_PUBLIC_KEY', '6Lc1xMgSAAAAAI7B-eRAahlvGQS2yKB16o5qBP3X');
define('RECAPTCHA_PRIVATE_KEY', '6Lc1xMgSAAAAAMh1B01a4esghv32GyG36rZM6-VA');
define('DATABASE_DEFAULT', 'development');
define('SESSION_TYPE', 'database');
define('ADMIN_EMAIL', 'admin@xmmedia.net');
define('CHANGE_SCRIPT_CONFIG', 'template4dev.xmmedia.net');