<?php defined('SYSPATH') or die ('No direct script access.');

/**
 * Public controller for public pages.
 */
class Controller_Public extends Controller_Base {
	public $template = 'public/template';

	/**
	 * Called before the action.
	 * Does everything else in the parent before()'s and also adds the public CSS.
	 */
	public function before() {
		parent::before();

		if ($this->auto_render) {
			$this->add_style('public', 'css/public.css');
		}
	} // function before

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