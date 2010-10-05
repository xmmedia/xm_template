<?php defined('SYSPATH') or die('No direct script access.');

// todo: make generic, right now it just does pages
class Controller_Edit extends Controller_Base {

    public $internal = false;

    public function before() {

        // don't auto-render the default template, we will take care of this later if we need it
        // in most cases the action methods will redirect
        //$this->auto_render = false;

        // check to see if this was an internal request, or direct external call
        if ($this->request != Request::instance()) {
            //Fire::log($this->request);  // this is the HMVC request from trialto.php
            Fire::log(Request::instance()); // this is the original request to trialto.php
            $this->internal = true;
            $this->auto_render = false;
        }
        $this->auto_render = false;
        parent::before();
    }

    // NOT USED RIGHT NOW
    public function action_index() {


    }

    // create the edit form and populate it with data
    // so far by design this action only works if called from an HMVC request internally from within another page of the site
    public function action_createform() {

        $pageId = $this->request->param('id');
        $formType = $this->request->param('type');
        // load the page and section names from GET vars, or if not GET then parms (depends on ajax call or new page route request in page controller)
        $this->page = Security::xss_clean(Arr::get($_GET, 'page', Request::instance()->param('page')));
        $this->section = Security::xss_clean(Arr::get($_GET, 'section', Request::instance()->param('section')));

        //Fire::log($_GET);

        // todo: make this generic so it selects the correct form or creates a default form based on the model?  prompt to confirm?
        // todo: if the model does not exist, create a new one from the database columns?  prompt to confirm?

        // only does pages right now
        $templateParameters = array();
        $templateParameters['statusHtml'] = '';

        // set up the default data, this will be overwritten below if valid data is found in the database for this page/content
        // todo: generate this from the models

        // get the section id from the section name in case we needed it
        $sectionId = 0;
        $sectionData = Jelly::select('Section')->where('short_name','=',$this->section)->limit(1)->execute();
        if ($sectionData && $sectionData->id) $sectionId = $sectionData->id;
        Fire::log('attempt to get section id for section: ' . $this->section . ' id returned is: ' . $sectionId);

        $pageData = array(
            'id' => '',
            'section' => $sectionId, // this is really the id
            'short_name' => $this->page,
            'publish_flag' => 1,
            'publish_flag_checked' => true,
            'publish_start_time' => date('Y-m-d H:i:s'),
            'publish_end_time' => '',
        );
        $enContentData = array(
            'id' => '',
            //'locale' => '',
            //'page' => '',
            //'article' => '',
            //'summary' => '',
            'title' => '',
            'html' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'publish_flag' => 1,
            'publish_flag_checked' => true,
        );
        $frContentData = array(
            'id' => '',
            //'locale' => '',
            //'page' => '',
            //'article' => '',
            //'summary' => '',
            'title' => '',
            'html' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'publish_flag' => 1,
            'publish_flag_checked' => true,
        );

        // get the form data if an id is passed (otherwise use defaults from model
        // todo: make generic
        if ($pageId > 0) {

            Fire::log('looks like we have an id of: `' . $pageId . '` so we will try to load default form data');
            $pageModelData = Jelly::select('Page',$pageId);
            if ($pageModelData->id > 0) {

                // extract the page data from the page model
                $pageData = array(
                    'id' => $pageModelData->id,
                    'section' => $pageModelData->section->id,
                    'short_name' => $pageModelData->short_name,
                    'name' => $pageModelData->name,
                    'publish_flag' => $pageModelData->publish_flag,
                    'publish_flag_checked' => ($pageModelData->publish_flag) ? true : false,
                    'publish_start_time' => $pageModelData->publish_start_time,
                    'publish_end_time' => $pageModelData->publish_end_time,
                );

                // extract the english content data from the page model if it exists
                $enContent = $pageModelData->get('content')->where('content.locale:foreign_key','=',EN_LOCALE_ID)->limit(1)->execute()->as_array();
                //Fire::log($enContent);
                if ($enContent['id'] > 0) {
                    $enContentData = array(
                        'id' => $enContent['id'],
                        //'locale' => $enContent['locale'],
                        //'page' => $enContent['page'],
                        //'article' => $enContent['article'],
                        //'summary' => $enContent['summary'],
                        'title' => $enContent['title'],
                        'html' => $enContent['html'],
                        'meta_description' => $enContent['meta_description'],
                        'meta_keywords' => $enContent['meta_keywords'],
                        'publish_flag' => $enContent['publish_flag'],
                        'publish_flag_checked' => ($enContent['publish_flag']) ? true : false,
                    );
                } // if

                // extract the french content data from the model if it exists
                $frContent = $pageModelData->get('content')->where('content.locale:foreign_key','=',FR_LOCALE_ID)->limit(1)->execute()->as_array();
                //Fire::log($frContent);
                if ($frContent['id'] > 0) {
                    $frContentData = array(
                        'id' => $frContent['id'],
                        //'locale' => $frContent['locale'],
                        //'page' => $frContent['page'],
                        //'article' => $frContent['article'],
                        //'summary' => $frContent['summary'],
                        'title' => $frContent['title'],
                        'html' => $frContent['html'],
                        'meta_description' => $frContent['meta_description'],
                        'meta_keywords' => $frContent['meta_keywords'],
                        'publish_flag' => $frContent['publish_flag'],
                        'publish_flag_checked' => ($frContent['publish_flag']) ? true : false,
                    );
                } // if
            } else {
                // looks like an error occurred in the rest request or this record does not exist
                // todo: something
            } // if
        } else {
            Fire::log('no id received so we will use the default data to populate the form');
        } // if

        // load the form tempate with the default data
        $templateParameters['page'] = $this->page;
        $templateParameters['section'] = $this->section;
        $templateParameters['pageId'] = $pageId;
        $templateParameters['sectionData'] = array(
            '5' => __('Home'),
            '1' => __('Our Wineries'),
            '2' => __('About Trialto Wine Group'),
            '3' => __('News & Events'),
            '4' => __('Contact Us'),
        );
        $templateParameters['formUrl'] = Route::get('edit')->uri(array('lang' => 'en-ca', 'type' => 'page', 'action' => 'edit', 'id' => $pageId));
        $templateParameters['pageData'] = $pageData;
        $templateParameters['enContentData'] = $enContentData;
        $templateParameters['frContentData'] = $frContentData;
        /* 20100812 csn removed
        // set up the main page template parameters
        Request::instance()->template->scripts[] = 'htmlbox.colors.js';
        Request::instance()->template->scripts[] = 'htmlbox.styles.js';
        Request::instance()->template->scripts[] = 'htmlbox.syntax.js';
        Request::instance()->template->scripts[] = 'xhtml.js';
        Request::instance()->template->scripts[] = 'htmlbox.full.js';
        */
        /*
        //$this->template->styles['jquery.wysiwyg.css'] = 'screen';
        //$this->template->scripts[] = 'jquery.wymeditor.min.js';
        */
        /* 20100812 csn removed
        Request::instance()->template->styles['jquery-ui-1.8.2.custom.css'] = 'screen';
        Request::instance()->template->on_load_js .= <<<EOA
    $("#start_date").datepicker({dateFormat: "DD MM d, yy", showAnim : "fadeIn"});
    $("#end_date").datepicker({dateFormat: "DD MM d, yy", showAnim : "fadeIn"});
    $("#en_html").css("height","100%").css("width","100%").htmlbox({
        toolbars:[
    	    [
    		// Cut, Copy, Paste
    		"separator","cut","copy","paste",
    		// Undo, Redo
    		"separator","undo","redo",
    		// Bold, Italic, Underline, Strikethrough, Sup, Sub
    		"separator","bold","italic","underline","strike","sup","sub",
    		// Left, Right, Center, Justify
    		"separator","justify","left","center","right",
    		// Ordered List, Unordered List, Indent, Outdent
    		"separator","ol","ul","indent","outdent",
    		// Hyperlink, Remove Hyperlink, Image
    		"separator","link","unlink","image"

    		],
    		[// Show code
    		"separator","code",
            // Formats, Font size, Font family, Font color, Font, Background
            "separator","formats","fontsize","fontfamily",
    		"separator","fontcolor","highlight",
    		],
    		[
    		//Strip tags
    		"separator","removeformat","striptags","hr","paragraph",
    		// Styles, Source code syntax buttons
    		"separator","quote","styles","syntax"
    		]
    	],
    	skin:"blue"
    });
EOA;
        */
        //$templateParameters['statusHtml'] .= Kohana::debug($templateParameters);

        // set the form template and pass in the data for the view
        //$this->request->response = View::factory('editforms/' . $this->locale . '/create_new_page', $templateParameters)->render();
        // 20100630 CSN just use en-ca for now, it is mostly bilingual
        $this->request->response = View::factory('editforms/en-ca/create_new_page', $templateParameters)->render();

    }

    // process the results of an add/edit form
    public function action_edit() {

        $editStatus = true;
        $pageId = Request::instance()->param('id');
        $pageName = Security::xss_clean(Arr::get($_POST, 'page_short_name', ''));
        $sectionId = Security::xss_clean(Arr::get($_POST, 'page_section_id', ''));
        $sectionName = Security::xss_clean(Arr::get($_POST, 'section', ''));
        $statusHtml = '';

        $statusHtml .= '<p>Save this record with id: `' . $pageId . '`:</p>';
        $statusHtml .= Kohana::debug($_POST);

        Fire::log($_POST);

        // authentication

        // authorization

        // validation

        // check to see if an components of this page exist

        // backup current records

        // save new record

        // save the page record
        if ($pageId > 0) {
            // try to load any existing records for this page, we have an ID passed, probably edit form case
            $page = Jelly::select('page')->load($pageId);
            $enContent = Jelly::select('content')->where('locale_id','=',EN_LOCALE_ID)->where('page_id','=',$pageId)->limit(1)->execute();
            $frContent = Jelly::select('content')->where('locale_id','=',FR_LOCALE_ID)->where('page_id','=',$pageId)->limit(1)->execute();
        } else {
            // try to load the record using the page short_name?
            /*
            $page = Jelly::select('page')->where('short_name','=',$page)->limit(1)->execute();
            $enContent = Jelly::factory('content');
            $frContent = Jelly::factory('content');
            */
            $page = Jelly::factory('page');
            $enContent = Jelly::factory('content');
            $frContent = Jelly::factory('content');
        } // if

        try {
            $endDate = Security::xss_clean(Arr::get($_POST, 'end_date', ''));
            $startDate = Security::xss_clean(Arr::get($_POST, 'start_date', ''));
            $pageData = array(
                'section' => Security::xss_clean(Arr::get($_POST, 'page_section_id', '')),
                'short_name' => Security::xss_clean(Arr::get($_POST, 'page_short_name', '')),
                'name' => Security::xss_clean(Arr::get($_POST, 'page_name', '')),
                'publish_flag' => (isset($_POST['publish_flag'])) ? 1 : 0,
                'publish_start_time' => ($startDate != '') ? $startDate : date('Y-m-d H:i:s'),
                'publish_end_time' => Security::xss_clean(Arr::get($_POST, 'end_date', '')),
            );
            $page->set($pageData);
            if ($page->save()) {
                // worked
                $pageId = $page->id;
                $statusHtml .= '<p>The page was saved.  Id: `' . $pageId . '`</p>';
            } else {
                // failed do something
                $editStatus = false;
                $pageId = false;
                $statusHtml .= '<p class="error">The page was not saved</p>';
            } // if

        } catch (Validate_Exception $e) {
            claero::flash_set('message', __("A validation error occurred, please correct your information and try again."));
            Fire::log('A validation exception occurred: ');
            Fire::log($e->array);
            $statusHtml .= '<p class="error">The page record was not saved, not continuing to content, so content was not saved either</p>';
            $editStatus = false;
        } catch (Exception $e) {
            Fire::log('Some other exception occurred');
            Fire::log($e);
            $this->template->body_html .= 'Could not create user. Error: "' . $e->getMessage() . '"';
            claero::flash_set('message', 'An error occurred during registration, please try again later.');
            $statusHtml .= '<p class="error">The page record was not saved, not continuing to content, so content was not saved either</p>';
            $editStatus = false;
        } // try

        if ($editStatus) {

            // try to save the content for each locale

            // english
            try {
                $enContentData = array(
                    'page_id' => $pageId,
                    'locale_id' => EN_LOCALE_ID,
                    'article_id' => 0,
                    'publish_flag' => (isset($_POST['en_publish_flag'])) ? 1 : 0,
                    'title' => Security::xss_clean(Arr::get($_POST, 'en_title', '')),

                    // need to not clean this so that we capture any HTML, including iframes, etc.
                    //'html' => Security::xss_clean(Arr::get($_POST, 'en_html', '')),
                    'html' => Arr::get($_POST, 'en_html', ''),

                    'meta_description' => Security::xss_clean(Arr::get($_POST, 'en_meta_description', '')),
                    'meta_keywords' => Security::xss_clean(Arr::get($_POST, 'en_meta_keywords', '')),
                );
                $enContent->set($enContentData);
                if ($enContent->save()) {
                    // worked
                    $enContentId = $enContent->id;
                    $statusHtml .= '<p>The english content was saved.  Id: `' . $enContentId . '`</p>';
                } // if
            } catch(Exception $e) {
                // failed do something
                Fire::log('english content was not saved');
                Fire::log($e);
                $editStatus = false;
                $statusHtml .= '<p class="error">The english content was not saved</p>';
            }

            // french
            try {
                $frContentData = array(
                    'page_id' => $pageId,
                    'locale_id' => FR_LOCALE_ID,
                    'article_id' => 0,
                    'publish_flag' => (isset($_POST['fr_publish_flag'])) ? 1 : 0,
                    'title' => Security::xss_clean(Arr::get($_POST, 'fr_title', '')),

                    // need to not clean this so that we capture any HTML, including iframes, etc.
                    //'html' => Security::xss_clean(Arr::get($_POST, 'fr_html', '')),
                    'html' => Arr::get($_POST, 'fr_html', ''),

                    'meta_description' => Security::xss_clean(Arr::get($_POST, 'fr_meta_description', '')),
                    'meta_keywords' => Security::xss_clean(Arr::get($_POST, 'fr_meta_keywords', '')),
                );
                $frContent->set($frContentData);
                if ($frContent->save()) {
                    // worked
                    $frContentId = $frContent->id;
                    $statusHtml .= '<p>The french content was saved.  Id: `' . $frContentId . '`</p>';
                } // if
            } catch(Exception $e) {
                // failed do something
                Fire::log('french content was not saved');
                Fire::log($e);
                $editStatus = false;
                $statusHtml .= '<p class="error">The french content was not saved</p>';
            }

        }

        // if all worked reidrect to new page?

        if ($editStatus) {
            $sectionData = Jelly::select('section')->load($sectionId); // get the section name from the section id
            //Fire::log($sectionData);
            //$statusHtml .= Kohana::debug($section);
            $sectionName = $sectionData->short_name;
            $newPageRoute = Route::get('pages')->uri(array('lang' => $this->locale, 'section' => $sectionName, 'page' => $pageName));
            $statusHtml .= '<p>Now redirect to: ' . $newPageRoute . '</p>'; // for debug, used when Request::instance()->redirect($newPageRoute); is commented out
            Request::instance()->redirect($newPageRoute);
            echo $statusHtml; // for debug, used when Request::instance()->redirect($newPageRoute); is commented out
        } else {
            // what to do if this didn't work
            echo '<p>The edit did not work, need to do something smart here.</p>';
            echo $statusHtml;
        } // if
    }

}