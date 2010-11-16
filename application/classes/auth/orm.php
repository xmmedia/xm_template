<?php defined('SYSPATH') or die ('No direct script access.');

class Auth_ORM extends cl4_Auth {
	/**
	* This will override the hash function such that the password will only be md5'd (no salt)
	* This allows sites to work with existing password that are already md5'd
	*
	* @param string $password
	* @param bool $salt
	* @return string
	*/
/*
	public function hash_password($password, $salt = FALSE) {
		return md5($password);
	} // functionhash_password
*/

	/**
	* Returns false which can be passed hash_password() to disable the use of a salt
	*
	* @param string $password
	* @return string
	*/
/*
	public function find_salt($password) {
		return FALSE;
	} // function find_salt
*/
}