<?php defined('SYSPATH') or die ('No direct script access.');

return array(
	// hash key for Kohana 3.1 hashing
	'hash_key' => 'H,Mi8&kc|Zs?{4=,V_,0MS%(g,3AH=[DXUak\+7i^qHg5g)\`+pQ!7y4Ij2KiUA',

	// uncomment this if you want the system to use md5 (vs default of sha1)
	// also comment out the function in application/class/auth/orm.php to not use a salt
	//'hash_method'    => 'md5',

	// for Kohana 3.0.x hashing (using the default sha1 hash with salt), remove if using >=3.1.0
	//'enable_3.0.x_hashing' => TRUE,
	//'hash_method' => 'sha1', // remove once 3.1 update is done
	//'salt_pattern'  => '1, 3, 5, 9, 14, 15, 20, 21, 28, 30',
);