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

	/**
	 * Sets up and adds some styles, including 1140 gride, normalize, jquery ui, cl4.css and base.css
	 *
	 * @return  Controller_Base
	 */
	public function add_template_styles() {
		$this->template->styles = array(
			'css/1140.css' => 'screen',
			'css/normalize.css' => NULL,
			'//ajax.googleapis.com/ajax/libs/jqueryui/1.8.19/themes/pepper-grinder/jquery-ui.css' => NULL,
			'cl4/css/cl4.css' => NULL,
			'css/base.css' => NULL,
		);

		return $this;
	} // function add_template_styles

	/**
	 * Sets up the template script var, add's modernizr, jquery, jquery ui, cl4.js and base.js if they are not already set
	 *
	 * @return  Controller_Base
	 */
	public function add_template_js() {
		if (empty($this->template->modernizr_path)) $this->template->modernizr_path = 'js/modernizr.min.js';

		if (empty($this->template->scripts)) $this->template->scripts = array();
		// add jquery js (for all pages, other js relies on it, so it has to be included first)
		if ( ! isset($this->template->scripts['jquery'])) $this->template->scripts['jquery'] = '//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js';
		if ( ! isset($this->template->scripts['jquery_ui'])) $this->template->scripts['jquery_ui'] = '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.19/jquery-ui.min.js';
		if ( ! isset($this->template->scripts['jquery_outside'])) $this->template->scripts['jquery_outside'] = 'js/jquery.outside.min.js';
		if ( ! isset($this->template->scripts['css3_mediaqueries'])) $this->template->scripts['css3_mediaqueries'] = 'js/css3-mediaqueries.js';
		if ( ! isset($this->template->scripts['cl4'])) $this->template->scripts['cl4'] = 'cl4/js/cl4.js';
		if ( ! isset($this->template->scripts['cl4_ajax'])) $this->template->scripts['cl4_ajax'] = 'cl4/js/ajax.js';
		if ( ! isset($this->template->scripts['base'])) $this->template->scripts['base'] = 'js/base.js';

		if (empty($this->template->on_load_js)) $this->template->on_load_js = '';

		return $this;
	} // function add_template_js
} // class