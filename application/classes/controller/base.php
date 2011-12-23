<?php defined('SYSPATH') or die ('No direct script access.');

class Controller_Base extends Controller_XM_Base {
	/**
	* Called before the action
	* Does everything else in the parent before()'s, but also logs the request.
	*
	*/
	public function before() {
		try {
			// only log the request if they're logged in
			if (Auth::instance()->logged_in()) {
				Model_Request_Log::store_request();
			}
		} catch (Exception $e) {
			Kohana_Exception::caught_handler($e, FALSE, FALSE);
		}

		parent::before();
	} // function before
} // class