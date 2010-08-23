<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Base extends Controller_Template {

    public $template = 'base'; // this is the default template file
    public $allowedLanguages = array('en-ca', 'fr-ca'); // set allowed languages
    public $page = '';
    public $section = '';
    public $config = '';
    public $locale = ''; // the locale string, eg. 'en-ca' or 'fr-ca'
    public $language = ''; // the two-letter language code, eg. 'en' or 'fr'
    public $provinceList = array(); // all the provinces with ids, used throughout the site
    public $provinceId = false; //  the selected province id, just chosen, or from session, or from cookie - or false
    public $provinceName = false; // the selected province full name
    public $thisPage = '';
    public $claeroDb = ''; // the cl4 database resource

    protected $authenticated = true; // until auth is added, use this to flip
    protected $auth; // auth object
    protected $user; // currently logged-in user
    protected $loggedIn = false; // whether user is logged in

    // called before our action method
    public function before() {
        parent::before();

        // open a session
        $this->session = Session::instance();

        // a few things while working on claero admin
        //$_SESSION['username'] = 'admin@admin.com';

        // see if we have a locale cookie to use
        $defaultLocale = Cookie::get('language', 'en-ca');

        // set locale and language and save in a cookie
        $this->locale = Request::instance()->param('lang', $defaultLocale);
        if (!in_array($this->locale, $this->allowedLanguages)) {
            $this->locale = 'en-ca';
        } // if
        i18n::lang($this->locale);
        Cookie::set('language', $this->locale); // todo: put this in a try()?
        $this->language = substr(i18n::lang(),0,2);

	    // set up the config settings
	    $this->config = Kohana::config(CONFIG_FILE);

        // set up the controller properties
        // 20100616 CSN TODO: add error checking here in case we don't have a section or page and leave them blank
        $this->section = Request::instance()->param('section');
        $this->page = Request::instance()->param('page');
        $this->thisPage = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

        //Fire::log(Request::instance());

        // create the language switch link and set the locale
        $thisPage = (THIS_PAGE != URL_ROOT . '/') ? THIS_PAGE : URL_ROOT . '/' . $this->locale . '/home';
        if ($this->locale == 'fr-ca') {
            // french, set the date
            setlocale(LC_TIME, 'fr_CA.utf8');
            // create the switch lanuage link
            $languageLink = str_replace('fr-ca','en-ca',$thisPage);
            //$languageLink = Request::instance()->url(array('lang','en-ca')); // 20100720 CSN this breaks on overview pages
            $languageSwitchLink = '<a href="' . $languageLink . '">EN</a> / FR';
            $dateinputOptions = "            format: 'dddd dd, mmmm yyyy'" . EOL;
        } else {
            // english, set the date
            setlocale(LC_TIME, 'en_CA.utf8');
            // create the switch lanuage link
            $languageLink = str_replace('en-ca','fr-ca',$thisPage);
            //$languageLink = Request::instance()->url(array('lang','fr-ca')); // 20100720 CSN this breaks on overview pages
            $languageSwitchLink = 'EN / <a href="' . $languageLink . '">FR</a>';
            $dateinputOptions = "            lang: 'fr', " . EOL; // defined in master js file, must execute before this does
            $dateinputOptions .= "            format: 'dddd mmmm dd, yyyy'" . EOL;
        } // if

        // set up the database connection
        $databaseSettings = Kohana::config('database');
        $dsn = array(
            $databaseSettings[DEFAULT_DB]['connection']['hostname'],
            $databaseSettings[DEFAULT_DB]['connection']['username'],
            $databaseSettings[DEFAULT_DB]['connection']['password'],
            $databaseSettings[DEFAULT_DB]['connection']['port'],
            $databaseSettings[DEFAULT_DB]['connection']['database'],
        );
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
        $this->claeroDb = new claerodb($dsn, $userId);
        if (!$this->claeroDb->GetStatus()) {
            trigger_error('Connection Error: Connection to database failed. ' . $this->claeroDb->GetError(), E_USER_ERROR);
            echo 'No database connection. Cannot continue.';
            exit;
        }

        // set up the default template values for the base template
        if ($this->auto_render)
        {
  	    	// Initialize default values
  	    	$this->template->thisPage = $this->thisPage;
  	    	//$this->template->thisUri = $this->request->uri();
            $this->template->pageTitle = '';
            $this->template->metaDescription = __("This template site uses the open source cl4 Kohana 3 module!");
            $this->template->metaKeywords = __('claero systems kohana3 module default site');
            $this->template->pageSection = $this->section;
            $this->template->pageName = ($this->page != '') ? $this->page : $this->request->controller;
            $this->template->onLoadJs = '';
            $this->template->styles = array('css/base.css' => 'screen');
            $this->template->scripts = array();
            $this->template->bodyClass = i18n::lang(); // other classes are added to this with spaces
            $this->template->language = $this->language;
            $this->template->message = __(claero::flash_get('message'));
            $this->template->dateToday = $this->get_current_date();
            $this->template->languageOptions = $languageSwitchLink;
            $this->template->dateinputOptions = $dateinputOptions;
            $this->template->bodyHtml = '';
            // add jquery js (for all pages, other js relies on it, so it has to be included first)
            $this->template->scripts[] = 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js';
        }

        // perform authorization checks
        $this->perform_auth();

        // add 'logged in' flag to template
        if ($this->auto_render) $this->template->loggedIn = $this->auth->IsLoggedIn();
    }


    /**
     * Perform authorization based on controller and action
     */
    private function perform_auth() {

        // set up publicly accessible controllers
        $publicControllers = array('home', 'page', 'account');

        // set up authentication
        $authOptions = array(
            'logout_exclude' => array('username', CLAERO_SESSION_LOGIN_RETRIES, 'status_message'),
            'login_where_clause' => " AND inactive_flag = 0 ",
            'claero_db' => $this->claeroDb,
            'publicControllers' => $publicControllers,
        );
        $this->auth = new ClaeroAuth($authOptions);

        // check to see if the user is logged in
        $this->loggedIn = $this->auth->IsLoggedIn();

        if (!in_array($this->request->controller, $publicControllers)) {
            if (!$this->loggedIn) {
                claero::AddStatusMsg($this->auth->GetMessage(HEOL));
                $this->request->redirect('/account');
                exit;
            } else if (!$this->auth->CheckPerm($this->request->controller,  $this->request->action)) {
                claero::AddStatusMsg('You do not have permission to view that page.');
                $this->request->redirect('/account');
                exit;
            } else {
                $this->user = $_SESSION['username'];
            } // if
        } else {
            $this->user = false;
        } // if

    }

    public function get_current_date($format = null, $timestamp = null) {

        if ($timestamp == null) $timestamp = time();
        if ($format == null) {
            if (i18n::lang() == 'en-ca') {
                $format = '%B %e, %Y';
            } else {
                $format = '%e %B %Y';
            }
        } // if

        return strftime($format, $timestamp);

    }

    // return the given static page in the language specified, or in english if it exists
    // this method will display the follwing if they exist, in this order, the first one that works:
    //     - static view file in the locale specified
    //     - static view file in english with a notice
    //     - database content in locale specified
    //     - database content in english with a notice
    //     - if authorized, then a create form to create the page
    //     - if not authorized, then a relevant notive that the page is empty
    public function get_static_template($page, $parameters) {

        $returnHtml = '';
        $pageLoaded = true;
        $pageId = 0;

        // add container used for edit case
        $containerDivId = 'content_' . $this->section . '_' . $this->page;
        $returnHtml .= '<div id="' . $containerDivId . '">' . EOL;

        // check for language specific static page template file and use this if it exists
        Fire::log('loading page: looking for file:' . ABS_ROOT . '/application/views/pages/en-ca/' . $page . '.php');
        if (file_exists(ABS_ROOT . '/application/views/pages/' . $this->locale . '/' . $page . '.php')) {
            Fire::log('loading page: using file:' . 'pages/' . $this->locale . '/' . $page);
            $returnHtml .= View::factory('pages/' . $this->locale . '/' . $page, $parameters) . EOL;
        } else {
            // not in this language, so see if the page template file exists in english, and use that with an appropriate message
            if ($this->locale != 'en-ca') Fire::log('loading page: looking for file:' . 'pages/en-ca/' . $page);
            if ($this->locale != 'en-ca' && file_exists(ABS_ROOT . '/application/views/pages/en-ca/' . $page . '.php')) {
                Fire::log('loading page: using file:' . 'pages/en-ca/' . $page);
                // display the english verson with a notice
                $returnHtml .= '<p class="statusMessage">' . __('No translation was available, we apologize for any inconvenience. Here is the Canadian English version:') . '</p>' . EOL;
                $returnHtml .= View::factory('pages/en-ca/' . $page, $parameters) . EOL;
            } else {
                // OK, no template file, so see if the page exists in the database in the language specified
                $pageContent = $this->get_page_contents($page, $this->locale);
                if ($pageContent) {
                    Fire::log('loading page: using db content with locale:' . $this->locale);
                    // display the page contents
                    $returnHtml .= $this->create_page($pageContent);
                    $pageId = $pageContent['page_id'];
                } else {
                    // display the english verson with a notice
                    if ($this->locale != 'en-ca' && $pageContent = $this->get_page_contents($page, 'en-ca')) {
                        Fire::log('loading page: using db content with locale: en-ca');
                        // display the page contents
                        $returnHtml .= '<p class="statusMessage">' . __('No translation was available, we apologize for any inconvenience. Here is the Canadian English version:') . '</p>' . EOL;
                        $returnHtml .= $this->create_page($pageContent);
                        $pageId = $pageContent['page_id'];
                    } else {
                        Fire::log('loading page: could not find the page anywhere');
                        $pageLoaded = false;
                        // todo: check role instead of logged in
                        if ($this->user) {
                            Fire::log('loading page: user is logged in and authorized to edit pages, creating edit form');
                            // if authed, then display create form
                            // see if this page already exists in the database (may just be unpublished)
                            $pageId = $this->get_page_id($page);
                            $createFormRoute = Route::get('edit')->uri(array('lang' => $this->locale, 'type' => 'page', 'action' => 'createform', 'id' => $pageId));
                            Fire::log('loading page: creating edit form with: ' . $createFormRoute);
                            $returnHtml .= '<p class="statusMessage">' . __('This page has no public content.  Since you are logged in and have permissions, you can create it now:') . '</p>' . EOL;
                            $returnHtml .= Request::factory($createFormRoute)->execute()->response;

                            // set up the special edit form template parameters
                            //eg $this->template->styles['jquery.wysiwyg.css'] = 'screen';
                            //eg $this->template->scripts[] = 'jquery.wymeditor.min.js';

                            // jsywsiywg option
                            //$this->template->scripts[] = 'jwysiwyg/jquery.wysiwyg.js';
                            //$this->template->styles['jwysiwyg/jquery.wysiwyg.css'] = 'screen';
                            $this->template->onLoadJs = <<<EOA
    $("#start_date").datepicker({dateFormat: "DD MM d, yy", showAnim : "fadeIn"});
    $("#end_date").datepicker({dateFormat: "DD MM d, yy", showAnim : "fadeIn"});
    $("#en_html").wysiwyg();
    $("#fr_html").wysiwyg();
EOA;
                        } else {
                            Fire::log('loading page: user not authorized to edit pages, displaying error message');
                            // display a notice
                            $returnHtml .= '<p class="statusMessage">' . __('Unfortunately this page has no content yet. We apologize for any inconvenience.');
                            $returnHtml .= ' If you are an authorized user, you can log in and publish or create this page.</p>' . EOL;
                            //$returnHtml .= '<p class="statusMessage">' . __('If you were logged in, you could create this page.') . '</p>' . EOL;
                            //if (DEBUG_FLAG) $returnHtml .= '<p>Template file:<br>' . ABS_ROOT . '/application/views/staticpages/en-ca/' . $page . '.php</p>';
                        } // if
                    } // if
                } // if
            } // if
        } // if
        $returnHtml .= '</div> <!-- ' . $containerDivId . '-->' . EOL;

        // if the current user has edit permissions, display the control bar with add/edit/delete, etc. functions
        if ($pageLoaded && $this->loggedIn) {

            // if we don't have a page id yet, see if this page has one in the db
            if (!$pageId) $pageId = $this->get_page_id($page);

            // generate the edit html for this content
            $editHtml = '<aside class="controlRow" style="clear:both">' . EOL;
            $editHtml .= Form::button('Edit', __('Edit'), array(
                    'type' => 'button', 'onclick' => 'EditRecord(\'' . $containerDivId . '\',\'page\',' . $pageId . ',true);')) . EOL;
            $editHtml .= Form::button('EditHtml', __('Edit HTML Source'), array(
                    'type' => 'button', 'onclick' => 'EditRecord(\'' . $containerDivId . '\',\'page\',' . $pageId . ',false);')) . EOL;
            // display meta information so it is easy for admins, etc. to view
            $editHtml .= '<p>Meta Description: ' . $this->template->metaDescription . '</p>' . EOL;
            $editHtml .= '<p>Meta Keywords: ' . $this->template->metaKeywords . '</p>' . EOL;
            $editHtml .= '</aside>' . EOL;

            // add the edit html to the begining of the content
            $returnHtml = $editHtml . $returnHtml;

            // add jquery ui css and js
            $this->template->styles['css/jquery-ui-1.8.2.custom.css'] = 'screen';
            $this->template->scripts[] = 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js';

            // add jquery wysiwyg css and js
            $this->template->scripts[] = 'jwysiwyg/jquery.wysiwyg.js'; // needed for wysiwyg editor
            $this->template->styles['jwysiwyg/jquery.wysiwyg.css'] = 'screen'; // needed for wysiwyg editor

            // add claerolib4 css and js
            $this->template->styles['css/cl4.css'] = 'screen';
            $this->template->scripts[] = 'js/cl4.js';

        }

        return $returnHtml;

    }

    // tries to get the page id for the page with the given short_name, returns 0 if none
    private function get_page_id($shortName) {
        $pageId = 0;
        $pageData = Jelly::select('page')->where('short_name','=',$shortName)->limit(1)->execute();
        if ($pageData && $pageData->id) $pageId = $pageData->id;
        Fire::log('attempt to get page id for page: ' . $shortName . ' id returned is: ' . $pageId);
        return $pageId;
    }

    /* query the database for the given page content / locale and return the data array or false if none or error */
    // 20100621 CSN TODO change so that it uses the cached view if it exists
    private function get_page_contents($pageName, $locale) {

        // create the query
        $sql = "
            SELECT c.*, p.*, l.*
            FROM page AS p
            LEFT JOIN content AS c ON c.page_id = p.id
            LEFT JOIN locale AS l ON l.id = c.locale_id
            WHERE p.short_name = '{$pageName}'
                AND l.name = '{$locale}'
                AND c.publish_flag = 1
            LIMIT 1
        ";
        $sql = DB::query(Database::SELECT, $sql);

        Fire::log('loading page: looking in db with: ' . $sql);

        // try to execute the query
        try {
            $query = $sql->execute();
            $data = $query->as_array();

            if ($query->count() == 1) {
                // return the page data
                return $data[0];

                // 20100617 CSN TODO also create static view page for next time so we don't hit the database again


            } else {
                // return 0
                return false;
            }
        }
        catch(Database_Exception $e)
        {
            // log error messsage?

            return false;
        }
        catch(Exception $e)
        {
            // log error messsage?

            return false;
        }
    }

    // set up the page with the data from the database
    private function create_page($pageData) {

        //fire::log($pageData);
        $pageContent = '';

        // clean / replace some stuff in the html field, add email addresses to employee names, etc.
        $formattedContent = $pageData['html'];

        // create the page conent
        $pageContent .= '<h1>' . $pageData['title'] . '</h1>' . EOL;
        $pageContent .= $formattedContent . EOL;

        // add the other relevant data to the template
        $this->template->metaDescription = $pageData['meta_description'];
        $this->template->metaKeywords = $pageData['meta_keywords'];
        // set up the page title
        $this->template->pageTitle = ucwords($pageData['title']);

        return $pageContent;
    }

    // called after our action method
    public function after()
    {
        if ($this->auto_render)
        {

            // set these up here in case another controller sets section and page
            $this->template->bodyClass .= ' s_' . $this->section;
            $this->template->bodyClass .= ' p_' . $this->page;
            if ($this->page != '') $this->template->onLoadJs .= "$('li." . $this->page . "').addClass('active');";  // this determines the page menu highlighting if applicable

            // set up default css stylesheets to be used on ALL pages
            $styles = array();
            // set up the css depending on the browser type, these files override trialto.css
            switch (BROWSER_TYPE) {
                case 'mobile_safari':
                    //$styles['css/iphone.css'] = 'screen';
                    break;
                case 'mobile_default':
                    //$styles['css/mobile.css'] = 'screen';
                    break;
                case 'pc_default':
                default:
                    break;
            } // switch

            // set up any language specific styles
            switch($this->language) {
                case 'en':
                    break;
                case 'fr':
                    //$styles['css/base_fr.css'] = 'screen';
                    break;
            } // switch

            // set up default styles that are used on ALL pages
            $scripts = array(
                'js/base.js',
            );

            // merge with any existing styles or scripts added within the controller
            $this->template->styles = array_merge( $this->template->styles, $styles );
            $this->template->scripts = array_merge( $this->template->scripts, $scripts );

            // look for any status message and display
            $this->template->message = claero::DisplayStatusMsg();
        }
        parent::after();
    }
}