<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Test extends Controller_Base {

	public $claeroDb = '';
	public $id = '';

	public function action_index() {


		$options = array(
			'test1' => 1,
			'test2' => array(
				'test2-1' => 1,
				'test2-2' => 2,
			),
			'test3' => 'test',
		);
		$this->template->bodyHtml .= kohana::debug($options);

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
		$this->template->bodyHtml .= kohana::debug($default_options);

		//$options += $default_options;
		//$options = array_merge($default_options, $options);
		//$options = array_merge_recursive($default_options, $options);
		$options = arr::merge($default_options, $options);
		$this->template->bodyHtml .= kohana::debug($options);


		//$this->template->bodyHtml .= '<style>.required {color:red;}</style>' . EOL;
		//$this->template->bodyHtml .= ORM::factory('user',2)->get_html();
	}

}