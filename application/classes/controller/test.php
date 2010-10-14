<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Test extends Controller_Base {

	public $claeroDb = '';
	public $id = '';

	public function action_index() {

	$this->template->body_html .= Route::get('claeroadmin')->uri(array('object' => 'user', 'action' => 'edit', 'id' => 3));
	$this->template->body_html .= kohana::debug(Request::instance()->route);
	$this->template->body_html .= kohana::debug(Route::name(Request::instance()->route));

		//$this->template->body_html .= '<p>sanity check</p>';
		//$test_data = array('row_count' => '23', 'query_time' => '23');
		//$test = ClaeroORM::factory('claerochange', 65);
			//$test->row_count = 2;
		//$test->values($test_data);
		//$test->save();


		//$this->template->body_html .= Request::instance()->uri(); //  $_SERVER['REQUEST_URI'];
		//$this->template->body_html .= Kohana::debug(Kohana::list_files('classes/model'));
		//$this->template->body_html .= Kohana::find_file('views','base');
		//$this->template->body_html .= Kohana::find_file('classes/model','user');

		/* testing array merge options
		$options = array(
			'test1' => 1,
			'test2' => array(
				'test2-1' => 1,
				'test2-2' => 2,
			),
			'test3' => 'test',
		);
		$this->template->body_html .= kohana::debug($options);

		$default_options = array(
			'test1' => 0,
			'test2' => array(
				'test2-1' => 'default',
				'test2-2' => 'default2',
				'test2-3' => 'default3',
			),
			'test3' => 'default3',
			'test4' => 'default4',
			'test5' => array(
				'test5-1' => 0,
				'test5-2' => 'default2',
			),
		);
		$this->template->body_html .= kohana::debug($default_options);

		//$options += $default_options;
		//$options = array_merge($default_options, $options);
		//$options = array_merge_recursive($default_options, $options);
		$options = arr::merge($default_options, $options);
		$this->template->body_html .= kohana::debug($options);

		*/


		//$this->template->body_html .= '<style>.required {color:red;}</style>' . EOL;
		//$this->template->body_html .= ORM::factory('user',2)->get_html();
	}

}