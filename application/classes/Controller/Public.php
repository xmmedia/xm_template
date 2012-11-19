<?php defined('SYSPATH') or die ('No direct script access.');

/**
 * Public controller for public pages.
 */
class Controller_Public extends Controller_CL4_Public {
	/**
	 * Action: index
	 *
	 * @return void
	 */
	public function action_index() {
		try {
			$this->template->body_html = View::factory('pages/index');
		} catch (Exception $e) {
			Kohana_Exception::caught_handler($e);
			$this->error_500();
		}
	} // function action_index
}