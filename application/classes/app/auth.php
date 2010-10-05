<?php defined('SYSPATH') or die('No direct access allowed.');

class App_Auth extends Claero_Auth {
	protected function complete_login($user) {
		// add any session setting stuff or after login stuff you want to do here
		return parent::complete_login($user);
	}
}