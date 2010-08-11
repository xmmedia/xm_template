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

    protected $authenticated = true; // until auth is added, use this to flip
    protected $auth; // auth object
    protected $user; // currently logged-in user
    protected $roles_required = array(); // roles required to perform current action (must satisfy all)
    
    // called before our action method
    public function before()
    {
        parent::before();

        // open a session
        $this->session = Session::instance();

        // a few things while working on claero admin
        //$_SESSION['username'] = 'admin@admin.com';

        // see if we have a locale cookie to use
        $defaultLocale = Cookie::get('language', 'en-ca');

        // set locale and language and save in a cookie
        $this->locale = Request::instance()->param('lang',$defaultLocale);
        if (!in_array($this->locale, $this->allowedLanguages)) {
            $this->locale = 'en-ca';
        } // if
        i18n::lang($this->locale);
        Cookie::set('language', $this->locale); // todo: put this in a try()?
        $this->language = substr(i18n::lang(),0,2);

        // perform authorization checks
        $this->perform_auth();

	    // set up the config settings
	    $this->config = Kohana::config(CONFIG_FILE);

        // set up the controller properties
        // 20100616 CSN TODO: add error checking here in case we don't have a section or page and leave them blank
        $this->section = Request::instance()->param('section');
        $this->page = Request::instance()->param('page');
        $this->thisPage = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $this->controller = 'home';

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
            $this->template->pageName = ($this->page != '') ? $this->page : $this->controller;
            $this->template->onLoadJs = '';
            $this->template->styles = array('base.css' => 'screen');
            $this->template->scripts = array();
            $this->template->bodyClass = i18n::lang(); // other classes are added to this with spaces
            $this->template->language = $this->language;
            $this->template->message = __(claero::flash_get('message'));
            $this->template->dateToday = $this->get_current_date();
            $this->template->languageOptions = $languageSwitchLink;
            $this->template->dateinputOptions = $dateinputOptions;
            $this->template->bodyHtml = '';
            $this->template->user = '';

            // connect to the database
            $db = Database::instance();

            // set up the externals for editing
            // todo: make sure the user has auth to edit
            if (0) {
                $this->template->scripts[] = 'jwysiwyg/jquery.wysiwyg.js'; // needed for wysiwyg editor
                $this->template->styles['jwysiwyg/jquery.wysiwyg.css'] = 'screen'; // needed for wysiwyg editor
                $this->template->styles['jquery-ui-1.8.2.custom.css'] = 'screen'; // needed for date picker, etc.
            } // if

        }
    }


    /**
     * Perform authorization.
     */
    private function perform_auth() {


        /* 20100709 CSN started to implement standard claero auth, but stopped and reverted to jely auth
        // set up authentication
        $authOptions = array(
            'logout_exclude' => array('username', CLAERO_SESSION_LOGIN_RETRIES, 'status_message'),
            'login_where_clause' => " AND inactive_flag = 0 ",
        );
        $this->auth = new ClaeroAuth($authOptions);

        //if (!in_array($_SERVER['SCRIPT_NAME'], $publicPages)) {
            if (!$this->auth->IsLoggedIn()) {
                claero::AddStatusMsg($this->auth->GetMessage(HEOL));
                if (isset($_SERVER['REQUEST_URI'])) {
                    Redirect('/private/login.php?' . CLAERO_REQUEST_USER_ACTION . '=logout&redir=' . urlencode($_SERVER['REQUEST_URI']));
                } else {
                    Redirect('/private/login.php?' . CLAERO_REQUEST_USER_ACTION . '=logout');
                }
                exit;
            } else if (!$this->auth->CheckPerm()) {
                claero::AddStatusMsg('You do not have permission to view this page.');
                $pageTitle = 'Permission Error';
                require_once(SITE::$header);
                echo claero::DisplayStatusMsg();
                require_once(SITE::$footer);
                exit;
            } // if
        //} // if

        // add user to template (for displaying name)
        // todo: don't need all this stuff - just name, etc.
        if ($this->auto_render) $this->template->user = $this->user;
        */


/*
        // create a new auth object for this page
        // creates a new Auth object defined in modules/jelly-group-auth/config/auth.php of Auth_Jelly_Group
        // modules/jelly-group-auth/classes/auth/jelly/group.php
        $this->auth = Auth::instance();

        // get the current user (if already logged in)
        $this->user = $this->auth->get_user();

        //fire::log($this->user);

        // add user to template (for displaying name)
        // todo: don't need all this stuff - just name, etc.
        if ($this->auto_render) $this->template->user = $this->user;

        // check for roles and permissions
        if (count($this->roles_required) > 0) {
            // If we have a user
            if (false !== $this->user) {
                try {
                    $this->user->authorize($this->roles_required);
                }
                // User is not authorized
                catch (Exception_NotAuthorized $e) {
                    // Display the "Not Authorized" warning
                    $this->template->content = View::factory(
                        Kohana::config('site.not_authed_view'), array(
                            'roles' => $e->missing_roles
                        )
                    );

                    echo $this->template;
                    exit;
                }
            }
            // If user is not logged in
            else {
                // Redirect to login page
                Flash::set('message', 'You must log in to perform this action.');
                Flash::set('return_to', $this->request->uri);
                $this->request->redirect('/account/login');
            }
        }
*/
        $this->auth = false;
        $this->user = false;
        if ($this->auto_render) $this->template->user = $this->user;
        
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
                    if ($this->locale != 'en-ca' && $pageContent = $this->getPageContents($page, 'en-ca')) {
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
                            //if (DEBUG_FLAG) $returnHtml .= '<p>Template file:<br />' . ABS_ROOT . '/application/views/staticpages/en-ca/' . $page . '.php</p>';
                        } // if
                    } // if
                } // if
            } // if
        } // if
        $returnHtml .= '</div> <!-- ' . $containerDivId . '-->' . EOL;

        // if this is an admin, display the control bar with add/edit/delete, etc. functions
        if ($pageLoaded && $this->user) {

            // if we don't have a pageid yet, see if this page has one in the db
            if (!$pageId) $pageId = $this->get_page_id($page);

            // display the edit bar at the bottom of the page
            $returnHtml .= '<aside class="controlRow" style="clear:both">' . EOL;
            $returnHtml .= Form::button('Edit', __('Edit'), array(
                    'type' => 'button', 'onclick' => 'EditRecord(\'' . $containerDivId . '\',\'page\',' . $pageId . ',true);')) . EOL;
            $returnHtml .= Form::button('EditHtml', __('Edit HTML Source'), array(
                    'type' => 'button', 'onclick' => 'EditRecord(\'' . $containerDivId . '\',\'page\',' . $pageId . ',false);')) . EOL;
            // display meta information so it is easy for admins, etc. to view
            $returnHtml .= '<p>Meta Description: ' . $this->template->metaDescription . '</p>' . EOL;
            $returnHtml .= '<p>Meta Keywords: ' . $this->template->metaKeywords . '</p>' . EOL;
            $returnHtml .= '</aside>' . EOL;
        }

        return $returnHtml;

    }

    // set up the page with the data from the database
    private function create_page($pageData) {

        Fire::log($pageData);
        $pageContent = '';

        // clean / replace some stuff in the html field, add email addresses to employee names, etc.
        $formattedContent = trialto::filter_page_output($pageData['html']);

        // create the page conent
        $pageContent .= '<h1>' . $pageData['title'] . '</h1>' . EOL;
        $pageContent .= $formattedContent . EOL;

        // add the other relevant data to the template
        if (isset($pageData['best_meta_description']) && $pageData['best_meta_description'] != '') $this->template->metaDescription = $pageData['best_meta_description'];
        if (isset($pageData['best_meta_keywords']) && $pageData['best_meta_keywords'] != '') $this->template->metaKeywords = $pageData['best_meta_keywords'];
        // set up the page title
        $this->template->pageTitle = ucwords($pageData['title']);

        return $pageContent;
    }

    // tries to get the page id for the page with the given short_name, returns 0 if none
    private function get_page_id($shortName) {
        $pageId = 0;
        $pageData = Jelly::select('page')->where('short_name','=',$shortName)->limit(1)->execute();
        if ($pageData->id) $pageId = $pageData->id;
        Fire::log('attempt to get page id for page: ' . $shortName . ' id returned is: ' . $pageId);
        return $pageId;
    }

    /* query the database for the given page content / locale and return the data array or false if none or error */
    // 20100621 CSN TODO change so that it uses the cached view if it exists
    private function get_page_contents($pageName, $locale) {

        // create the query
        $sql = "
            SELECT c.*, p.*, l.*,
                IF(c.meta_keywords != '', c.meta_keywords, p.meta_keywords) AS best_meta_keywords,
                IF(c.meta_description != '', c.meta_description, p.meta_description) AS best_meta_description
            FROM page AS p
            LEFT JOIN content AS c ON c.page_id = p.id
            LEFT JOIN locale AS l ON l.id = c.locale_id
            WHERE p.short_name = '{$pageName}'
                AND l.name = '{$locale}'
                AND c.publish_flag = 1
            LIMIT 1
        ";
        $sql = DB::query(Database::SELECT, $sql);
        /*
        $sql = DB::select(DB::expr('content.*, page.*, locale.*'))->from('page');
        $sql->join('content')->on('content.page_id','=','page.id');
        $sql->join('locale')->on('locale.id', '=', 'content.locale_id');
        $sql->and_where('page.short_name','LIKE',$pageName);
        $sql->and_where('page.publish_flag','=',1);
        $sql->and_where('locale.name','LIKE',$locale);
        $sql->and_where('content.publish_flag','=',1);
        $sql->limit(1); // there should only be one content item per locale per page
        */
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
                    //$styles['trialto_iphone.css'] = 'screen';
                    break;
                case 'mobile_default':
                    //$styles['trialto_mobile.css'] = 'screen';
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
                    //$styles['base_fr.css'] = 'screen';
                    break;
            } // switch

            // set up default styles that are used on ALL pages
            $scripts = array(
                'base.js',
            );

            // merge with any existing styles or scripts added within the controller
            $this->template->styles = array_merge( $this->template->styles, $styles );
            $this->template->scripts = array_merge( $this->template->scripts, $scripts );
        }
        parent::after();
    }
}