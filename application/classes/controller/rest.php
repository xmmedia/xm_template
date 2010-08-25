<?php defined('SYSPATH') OR die('No Direct Script Access');

/* Controller to handle rest type or ajax requests */

// TODO: critical, add auth so only logged in users can do certain things, double check permissions?
Class Controller_Rest extends Kohana_Controller_REST
{
    public $fileRoot = '/var/www/vhosts/dev.trialto.com'; // should be global and based on site (dev vrs www)
    public $cacheRoot = '/var/www/vhosts/dev.trialto.com/cache'; // should be global and based on site (dev vrs www)
    public $recordType = false;
    public $recordIndex = false;
    public $recordLimit = 100;
    public $outputType = 'html'; // 'html', 'json', or 'xml' ?
    
    public $internal = false;

    function before() {
        parent::before();
        // check to see if this was an internal request, or direct external call
        if ($this->request != Request::instance()) $this->internal = true;
        // process the request parameters
        $this->locale = Request::instance()->param('lang');
        $this->language = substr($this->locale,0,2);
        $this->recordType = Security::xss_clean(Request::instance()->param('rtype'));
        $this->recordIndex = Security::xss_clean(Request::instance()->param('rindex'),0);
        $this->recordLimit = Security::xss_clean(Arr::get($_GET, 'limit', 100));
        $this->outputType = Security::xss_clean(Arr::get($_GET, 'type', 'json')); // 'html', 'json', or 'xml' ?
    }

	
	function action_index() {
		// this is a GET request
		// TODO: make this dynamic / global based on site, etc.
		$fileName = $this->cacheRoot . '/' . $this->recordType . '/' . $this->recordIndex . '.html';
		$output = '';
		switch($this->recordType) {
			// todo: add options here
			case 'model':
				if ($this->recordIndex != '') {
					$output .= ORM::factory('user')->create_model($this->recordIndex);
				} else {
					$output .= 'Sorry, we did not receive a valid table name';
				} 
				break;
			default:
				$output .= "invalid type received in rest controller: " . $this->recordType;
				break;
		} // switch

		$this->request->response = $output;
	}
}