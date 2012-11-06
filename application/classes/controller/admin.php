<?php defined('SYSPATH') or die ('No direct script access.');

class Controller_Admin extends Controller_Base {
	public $template = 'base/template';

	/**
	 * Called before the action.
	 * Does everything else in the parent before()'s and also adds the admin CSS.
	 */
	public function before() {
		parent::before();

		if ($this->auto_render) {
			$this->template->styles['css/admin.css'] = NULL;
		}

	} // function before
}