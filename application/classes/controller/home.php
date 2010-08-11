<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Base {

	public function action_index()
	{
	   $this->section = 'home';
	   
	   // normally all sorts of cool dynamic stuff would happen here, but for now, we just blob out some helpful advice
		$this->template->bodyHtml .= <<<EOA
<div id="mainContent">
    <h1>Welcome to the cl4 sample site</h1>
    <p>Welcome to the current cl4 template site.  This site is designed to help get you started with cl4.</p>
    <h2>Debugging</h2>
    <p>By default FirePHP is used for debugging, this can be overridden easily by doing the following:</p>
    <ul>
        <li></li>
    </ul>
    <p>If you are using Firefox, you need to have Firebug and FirePHP add-ons installed.  Once this is done, you should be able to
    open firebug and see the debugging and benchmark data in the console. Sometimes you have to restart the browser to make this work.</p>
</div>	
EOA;
	}

} // End Welcome