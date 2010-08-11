<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Base {

	public function action_index()
	{
        // normally all sorts of cool dynamic stuff would happen here, but for now, we just blob out some helpful advice
        $this->request->redirect('/' . i18n::lang() . '/page/home');
	}

} // End Welcome