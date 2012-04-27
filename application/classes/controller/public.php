<?php defined('SYSPATH') or die ('No direct script access.');

class Controller_Public extends Controller_Base {
	public $template = 'public/base';

	/**
	* Called before the action
	* Does everything else in the parent before()'s, but also logs the request.
	*
	*/
	public function before() {
		parent::before();

		if ($this->auto_render) {
			$this->template->styles['css/public.css'] = NULL;
		}

	} // function before

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