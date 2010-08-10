<?php defined('SYSPATH') or die('No direct script access.');
  
class Controller_Page extends Controller_Base {

    // load a web page in to the default template (trialto_public) from file or database
    // special case for overview ages of web site 'sections'
    public function action_index() {
        
        // set up parameters to send to all template pages that are used in this method
        $commonTemplateData = array(
            'section' => $this->section,
            'page' => $this->page,
        );

        // get the page from the static templates or database
        try {
            $this->template->bodyHtml .= View::factory('menus/' . $this->section) . EOL; 
            $this->template->bodyHtml .= '    <div class="subpagecontent">' . EOL;
            $this->template->bodyHtml .= $this->getStaticTemplate($this->page, $commonTemplateData);
            $this->template->bodyHtml .= '    </div>' . EOL;
        } catch (Exception $e) {
            $this->template->bodyHtml .= '<p>There was a problem loading the page content.</p>';
            $this->template->bodyHtml .= Kohana::debug($e);
        }
   
    }
}