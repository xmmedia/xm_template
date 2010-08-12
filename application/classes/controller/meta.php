<?php defined('SYSPATH') or die('No direct script access.');
  
/*
This controller helps manage the meta table data.  It will be deprecated once models are implemented in cl4.
The authentication and authorization is managed by Controller_Base.  
*/
class Controller_Meta extends Controller_Base {

    public $claeroDb = '';

    public function before() {
    
        parent::before();
        
        // add jquery ui css and js
        $this->template->styles['css/jquery-ui-1.8.2.custom.css'] = 'screen';
        $this->template->scripts[] = 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js';
        
        // add claerolib4 css and js
        $this->template->styles['css/cl4.css'] = 'screen';
        $this->template->scripts[] = 'js/cl4.js';
        
    } 
    
    function action_index() {
    
        /***********************************
        * CONFIGURATION
        ************************************/
        $resultHtml = '';
        $sqlHtml = '<strong>SQL Statements Run</strong>' . HEOL;
        
        $tableName = claero::ProcessRequest('table_name');
        $userAction = claero::ProcessUserAction();
        $claeroMeta = new claerometa(array('claero_db' => $this->claeroDb));

        /***********************************
        * MAIN
        ************************************/

        switch ($userAction) {
            case 'add' :
                $resultHtml .= $claeroMeta->AddTable($tableName);
                $sqlHtml .= $claeroMeta->GetSqlStatments();
                break;
        
            case 'update' :
                $resultHtml .= $claeroMeta->UpdateTable($tableName);
                $sqlHtml .= $claeroMeta->GetSqlStatments();
                break;
        
            case 'delete' :
                $resultHtml .= $claeroMeta->DeleteTable($tableName);
                $sqlHtml .= $claeroMeta->GetSqlStatments();
                break;
        
            case 'reorder' :
                $resultHtml .= $claeroMeta->ReorderTable($tableName);
                $sqlHtml .= $claeroMeta->GetSqlStatments();
                break;
        
            case 'search' :
                // search is performed any time there is a user action and a table is selected
                break;
        }
        
        if ($userAction && $tableName) {
            $displayOptions = array(
                'claero_db' => $this->claeroDb,
                'criteria' => array(
                    'table_name' => $tableName,
                ),
            );
            $tableResult = new claerodisplay(CLAERO_META_TABLE, $displayOptions);
            $resultHtml .= $tableResult->GetHtml();
        } // if
        
        $tableSelect = new claerofield('table_select', 'table_name', $tableName, array('claero_db' => $this->claeroDb));
        $tableHtml = $tableSelect->GetField();
        
        $this->template->bodyHtml .= <<<EOA
        <h3>Claero Libraries Meta Editor</h3>
        Database: {$this->claeroDb->GetDbName()}
        <form name="meta" method="post">
            {$tableHtml}
            <input type="submit" name="c_user_action" value="Search" />
            <input type="submit" name="c_user_action" value="Add" />
            <input type="submit" name="c_user_action" value="Update" />
            <input type="submit" name="c_user_action" value="Reorder" />
            <input type="submit" name="c_user_action" value="Delete" />
        </form>
        
        <legend><a href="javascript:;" onClick="document.getElementById('sql_statements').style.display = '';">SQL Statements</a></span></legend>
        <dl style="display:none; border:1px solid black; padding:3px;" id="sql_statements"><dt>
        {$sqlHtml}
        </dt></dl>
        {$resultHtml}
EOA;
    }

}