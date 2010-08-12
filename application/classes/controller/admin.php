<?php defined('SYSPATH') or die('No direct script access.');

/* 
This controller handles CRUD and provides a back-end admin interface to the database.
The authentication and authorization is managed by Controller_Base.    
 */

class Controller_Admin extends Controller_Base {

    public $internal = false;
    public $pageTitle = 'Administration';
    public $bodyHtml = '';
    public $defaultSettings = '';
    public $userAction = '';
    public $formName = '';
    public $id = 0;
    public $offset = 0;
    public $sortColumn = '';
    public $sortOrder= '';
    public $allowedTables = array();
    public $fileOptions = array();
    public $editOptions = array();
    public $displayOptions = array();

    public function before() {
    
        parent::before();
        
        // add jquery ui css and js
        $this->template->styles['css/jquery-ui-1.8.2.custom.css'] = 'screen';
        $this->template->scripts[] = 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js';
        
        // add claerolib4 css and js
        $this->template->styles['css/cl4.css'] = 'screen';
        $this->template->scripts[] = 'js/cl4.js';
        
        // default settings
        $this->defaultSettings = array(
            'sort_by_column' => 'id',
            'sort_by_order' => 'DESC',
            'offset' => 0,
            CLAERO_REQUEST_FORM_NAME => 'user',
        );
        
        /***********************************
        * USER INPUT
        ************************************/
        $this->userAction = claero::ProcessUserAction(null);
        $this->formName = claero::ProcessRequest(CLAERO_REQUEST_FORM_NAME, null);
        $this->id = claero::ProcessRequest(array('id', 'ids'), null);
        $this->offset = claero::ProcessRequest('offset', null);
        $this->sortColumn = claero::ProcessRequest('sort_by_column', null);
        $this->sortOrder = claero::ProcessRequest('sort_by_order', null);
        
        // the first time to the page
        if (!isset($_SESSION['db_admin'])) {
            $_SESSION['db_admin'] = $this->defaultSettings;
        } else {
            // we have changed tables/forms or we are clearing the search or we are performing a new search
            if (($this->formName !== null && $_SESSION['db_admin'][CLAERO_REQUEST_FORM_NAME] != $this->formName) || $this->userAction == 'cancel_search' || $this->userAction == 'search') {
                $_SESSION['db_admin'] = $this->defaultSettings;
                $_SESSION['db_admin'][CLAERO_REQUEST_FORM_NAME] = $this->formName;
            } else {
                // we have not changed table, performed a new search or cleared search, so check the post for each value
                if ($this->formName != null) $_SESSION['db_admin'][CLAERO_REQUEST_FORM_NAME] = $this->formName;
                if ($this->offset != null) $_SESSION['db_admin']['offset'] = $this->offset;
                if ($this->sortColumn != null) $_SESSION['db_admin']['sort_by_column'] = $this->sortColumn;
                if ($this->sortOrder != null) $_SESSION['db_admin']['sort_by_order'] = $this->sortOrder;
            }
        }
        
        $this->formName = $_SESSION['db_admin'][CLAERO_REQUEST_FORM_NAME];
        $this->offset = $_SESSION['db_admin']['offset'];
        $this->sortColumn = $_SESSION['db_admin']['sort_by_column'];
        $this->sortOrder = $_SESSION['db_admin']['sort_by_order'];

        /***********************************
        * OBJECT SETTINGS
        ************************************/
        $this->fileOptions = array(
            'file_options' => array(
                // inside doc root
                'file_location' => UPLOAD_ROOT, // the path where the uploads should go
                'doc_root' => FILE_ROOT, // used to figure out the value to put into the db
                'original_filename_column' => 'original_filename',
            ),
        );
        
        $this->displayOptions = array(
            'claero_db' => $this->claeroDb,
            'page_max_rows' => 30,
            'sort_by_column' => $this->sortColumn,
            'sort_by_order' => $this->sortOrder,
            'page_offset' => $this->offset,
            'action_buttons' => array(
                'export' => true,
            ),
            'replace_spaces' => true,
        );
        $this->editOptions = array(
            'claero_db' => $this->claeroDb,
            'id' => $this->id,
        );
        
        $this->editOptions = array_merge($this->editOptions, $this->fileOptions);
        $this->displayOptions = array_merge($this->displayOptions, $this->fileOptions);
    }

    public function action_index() {
        
        // display the list of tables and the default table data
        $options = array(
            'claero_db' => $this->claeroDb,
            'class' => 'small',
            'id' => 'form_name',
            'attributes' => array('on_change' => 'this.form.submit();'),
            //'allowed_tables' => $this->allowedTables,
        );
        
        //fire::log($options);
        //claero::PrintR($options);
        
        $tableList = new claerofield('table_select', CLAERO_REQUEST_FORM_NAME, $this->formName, $options);
        //echo kohana::debug($tableList);
        $this->template->bodyHtml .= '<form name="form_select" method="get">
            <div class="tableMenu">
                Tables ' . $tableList->GetHtml() . '
                <input type="submit" value="Go" />
                <a href="?' . CLAERO_REQUEST_FORM_NAME . '=user">Users</a>
                &nbsp;&nbsp;<a href="?' . CLAERO_REQUEST_FORM_NAME . '=' . CLAERO_META_TABLE . '">Meta Data</a>
            </div>
            </form>';
        
        //claero::PrintR($this);exit;
        
        // switch user action
        switch ($this->userAction) {
        
            case 'edit':
            case 'add':
            case 'add_row':
                $this->action_edit();
                break;
            case 'save':
                $this->action_save();
                break;
            case 'view':
                $this->action_view();
                break;
            case 'delete':
                $this->action_delete();
                break;
            case 'cancel_search':
                $this->action_cancel_search();
                break;
            case 'search':
                $this->action_search();
                // no break here
            default:
                $claeroDisplay = new claerodisplay($this->formName, $this->displayOptions);
                $this->template->bodyHtml .= '<section class="claeroDisplay">' . $claeroDisplay->GetHtml() . '</section>';
                break;
        
        } // switch
    }
    
    public function action_edit_multiple() {

        $this->editOptions['id'] = array(
            $this->formName => $this->id,
        );
        $this->action_view();
        
    } 
    
    public function action_edit() {
        //case 'add' :
        //case 'add_row' :
        switch ($this->formName) {
            case 'user' :
                $editOptions['meta']['user']['password']['form_type'] = 'password_confirm';
                break;
            default:
                break;
        }
        $this->action_view();
    }

    public function action_view() {
    
        $this->editOptions['mode'] = $this->userAction;

        $claeroEdit = new ClaeroEdit($this->formName, $this->editOptions);
        $this->template->bodyHtml .= $claeroEdit->GetHtml();
        
    } // if

    public function action_delete() {
    
        $editOptions['mode'] = 'delete';
        $claeroEdit = new ClaeroEdit($this->formName, $this->editOptions);
        if ($claeroEdit->GetStatus() && isset($_POST[CLAERO_REQUEST_CONFIRM_DELETE])) {
            claero::AddStatusMsg($claeroEdit->GetHtml());
            claero::Redirect($_SERVER['SCRIPT_NAME'] . '?' . CLAERO_REQUEST_FORM_NAME . '=' . $this->formName);
            exit;
        } else {
            $this->template->bodyHtml .= $claeroEdit->GetHtml();
        }
        
    }
    
    public function action_save() {
    
        $editOptions['mode'] = 'save';        
        $claeroEdit = new ClaeroEdit($this->formName, $this->editOptions);
        if ($claeroEdit->GetStatus()) {
            claero::AddStatusMsg($claeroEdit->GetHtml());
            claero::Redirect('/admin');
            //exit;
        } else {
            claero::AddStatusMsg($claeroEdit->GetHtml());
            $claeroEdit = new ClaeroEdit($this->formName, $this->editOptions);
        }
        
    }

    public function action_create_csv() {
    
        $displayOptions['mode'] = 'csv';
        $displayOptions['ids'][$formName] = $id;
        $claeroDisplay = new ClaeroDisplay($this->formName, $this->displayOptions);
        $claeroDisplay->GetCsv();
        
    }

    public function action_cancel_search() {
    
        unset($_SESSION[CLAERO_SESSION_CURRENT_SEARCH]);
        claero::Redirect($_SERVER['SCRIPT_NAME']);
        
    }
    
    /**
    *   perform a search based on POST variables
    *
    */
    public function action_search() {
    
        if (count($_POST) == 0) {
            $this->editOptions['mode'] = 'search';
            $claeroEdit = new ClaeroEdit($this->formName, $this->editOptions);
            $this->template->bodyHtml .= $claeroEdit->GetHtml();
        } else {
            $this->displayOptions['new_search_flag'] = true;
        }
        
    }

}