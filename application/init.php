<?php

/**
* Config for template4.claero.com
*/

define('KOHANA_ENVIRONMENT', 40); // development
define('DEVELOPMENT_FLAG', TRUE);
define('CACHE_FLAG', FALSE);
define('DEBUG_FLAG', TRUE);
define('UNAVAILABLE_FLAG', FALSE);
define('LONG_NAME', 'cl4 + XM Template Site');
define('SHORT_NAME', 'cl4template');
define('APP_VERSION', '1');
if ( ! isset($_SERVER['SERVER_PORT'])) {
	define('HTTP_PROTOCOL', 'http');
} else {
	define('HTTP_PROTOCOL', ($_SERVER['SERVER_PORT'] == '443' ? 'https' : 'http'));
}
define('URL_ROOT', HTTP_PROTOCOL . '://template4.xmmedia.net');
define('ABS_ROOT', '/home/template/template4.xmmedia.net');
define('ANALYTICS_ID', 'UA-17170806-9'); // UA-17170806-9 is for template4.xmmedia.net
define('RECAPTCHA_PUBLIC_KEY', '6Lc1xMgSAAAAAI7B-eRAahlvGQS2yKB16o5qBP3X');
define('RECAPTCHA_PRIVATE_KEY', '6Lc1xMgSAAAAAMh1B01a4esghv32GyG36rZM6-VA');
define('DATABASE_DEFAULT', 'development');
define('SESSION_TYPE', 'database');
define('ADMIN_EMAIL', 'admin@xmmedia.net');