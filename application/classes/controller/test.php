<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Test extends Controller_Base {

	public $claeroDb = '';
	public $id = '';

	public function action_index() {
		$this->template->bodyHtml .= '<style>.required {color:red;}</style>' . EOL;
		$this->template->bodyHtml .= ORM::factory('user',2)->get_html();
	} 

}