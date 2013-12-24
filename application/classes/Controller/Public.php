<?php defined('SYSPATH') or die ('No direct script access.');

/**
 * Public controller for public pages.
 */
class Controller_Public extends Controller_XM_Public {
	public function before() {
		parent::before();

		// remove jQuery UI if it exists since we typically don't need it for public sites
		if ($this->auto_render && isset($this->scripts['jquery_ui'])) {
			unset($this->scripts['jquery_ui']);
		}
	}

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