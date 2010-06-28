<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for displaying Claero Base App documentation
 */
class Controller_Docs extends Controller_Template {
    /**
     * Show the documentation requested.
     *
     * @param string $docName The name of the documentation requested, and thus the view to show.
     */
	public function action_showdoc($docName) {
		$this->template->content = View::factory("docs/$docName");
	}
}
