<?php defined('SYSPATH') or die ('No direct script access.');

/**
 * Public controller for public pages.
 */
class Controller_Public extends Controller_XM_Public {
	/**
	 * Action: index
	 *
	 * @return void
	 */
	public function action_index() {
		$this->template->page_title = 'XM Template';
		$this->template->body_html = View::factory('pages/index');
	}
}