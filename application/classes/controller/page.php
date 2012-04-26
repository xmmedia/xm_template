<?php defined('SYSPATH') or die ('No direct script access.');

class Controller_Page extends Controller_Base {
	/**
	 * Action: index
	 *
	 * @return void
	 */
	public function action_index() {
		try {
			$this->template->body_html = View::factory('pages/en-ca/index');
		} catch (Exception $e) {
			Kohana_Exception::caught_handler($e);
		}
	} // function action_index
}