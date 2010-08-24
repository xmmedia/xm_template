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
            $pageViewName = ($this->page != '') ? $this->page : $this->section;
            //$this->template->bodyHtml .= View::factory('menus/' . $this->section) . EOL;
            $this->template->bodyHtml .= $this->get_static_template($pageViewName, $commonTemplateData);

            // special code to add additional date fields
            if ($pageViewName == 'demo') {
                $this->template->onLoadJs .= <<<EOA
$('#newDate').click(function() {
    $('#dateFieldToCopy').after('Date 2: <input type="text" id="date" name="date" value="2010-08-10" size="10" maxlength="10" class="testField date_field-date"><br><br>');
    $('.date_field-date').datepicker();
    return false;
});
EOA;
            }

        } catch (Exception $e) {
            $this->template->bodyHtml .= '<p>There was a problem loading the page content.</p>';
            $this->template->bodyHtml .= Kohana::debug($e);
        }

    }
}