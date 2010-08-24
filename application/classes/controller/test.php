<?php defined('SYSPATH') or die('No direct script access.');
  
class Controller_Test extends Controller_Base {

    public $claeroDb = '';
    public $id = '';

    public function action_index() {
    
    
        $this->template->bodyHtml .= ORM::factory('user',2)->get_html();
        
    
        //$this->template->bodyHtml .= Kohana::debug(Kohana::config('production'));
    
        //$this->template->bodyHtml .= Kohana::config('development')->long_name;
        //$this->template->bodyHtml .= Kohana::config('production')->LONG_NAME;
    
        
        //$content = new Model_TrialtoContent(1);
        //$content = ORM::factory('trialtoContent')->find_all()->as_array('id');
        
        //$article = ORM::factory('trialtoArticle')->find_all();
        
        //$article = ORM::factory('trialtoArticle');
        
        //$this->template->bodyHtml .= kohana::debug($article->list_columns());
        
        
        /*
        $article = new Model_TrialtoArticle(2);
        $this->template->bodyHtml .= "<p>{$article->name}</p>";        
        //$this->template->bodyHtml .= Kohana::debug($article);
        $contentData = $article->trialtocontent->where('locale_id','=',1)->find();
        $this->template->bodyHtml .= "<p>{$contentData->html}</p>";  
        $this->template->bodyHtml .= Kohana::debug($contentData);
    */
    
        //$content = ORM::factory('trialtoContent', array('article_id' => 2))->find();
        //$this->template->bodyHtml .= Kohana::debug($content);
    
        //$this->template->bodyHtml .= '<p>Load page table, id 3:</p>';
        
        //fire::log($this->request->uri());
        
        
        
        //$page = Jelly::select('page')->where('id', '=', 1)->load(1);
        //fire::log($page);
        //fire::log($page->get('content')->execute);
        //fire::log($page->get('content')->where('locale_id','=',1)->execute);
        //fire::log($page->get('content')->where('locale_id','=',1)->load(1));
        //fire::log($page->get('content')->where('locale_id','=',1)->load(1)->html);
        
        /*
        $category = Jelly::select('category',3);
        fire::log($category);
        //fire::log($category->article);
        foreach ($category->article as $article) {
            fire::log($article);
        }
        */
        
        
        //$article = Jelly::select('article',1);
        //fire::log($article);
        //fire::log($article->get('content')->execute());
        
        //foreach ($article->author as $author) {
        //    fire::log($article->author->first_name);
        //}
        
        //foreach ($article->category as $category) {
        //    fire::log($category);
        //}
        
        
        //$contentList = $article->get('content')->execute();
        //foreach ($article->content as $content) {
        //    fire::log($content);
        //}
        
        //fire::log($article->get('content')->where('locale_id','=',1)->limit(1)->execute()->html);
        //$this->template->bodyHtml .= $article->get('content')->where('locale_id','=',1)->load(1)->html;
   
   
/*       

// set up database connection
$dsn = array('localhost', 'dev_trialto_com', 'MpF3GmeZCPxn8pZ6', 3306, 'dev_trialto_com');
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$this->claeroDb = new claerodb($dsn, $userId);
if (!$this->claeroDb->GetStatus()) {
    trigger_error('Connection Error: Connection to database failed. ' . $this->claeroDb->GetError(), E_USER_ERROR);
    echo 'No database connection. Cannot continue.';
    exit;
}

// create a form
$formName = 'page';
$editOptions = array(
    'claero_db' => $this->claeroDb,
    //'id' => $this->id,
    'mode' => 'add',
);
$contentEditForm = new claeroedit($formName, $editOptions);
$this->template->bodyHtml .= $contentEditForm->getHtml();
*/






/* 
// set up some test data
$testData = array();
$testData[] = array('row1col1', 'row1col2', 'row1col3', 'row1col4', 'row1col5');
$testData[] = array('row2col1', 'row2col2', 'row2col3', 'row2col4', 'row2col5');
$testData[] = array('row3col1', 'row3col2', 'row3col3', 'row3col4', 'row3col5');
$testData[] = array('row4col1', 'row4col2', 'row4col3', 'row4col4', 'row4col5');
 
// create the table object
$table = new claerotable();
 
// add the data rows to the table
foreach ($testData as $dataRow) {
    $table->AddRow($dataRow);
} // foreach
 
// output the HTML table
$this->template->bodyHtml .= $table->GetHtml();
*/
           
           
           
           
           
/*
// set up some test data
$testData = array();
$testData[] = array('row0col0', 'row0col1', 'row0col2', 'row0col3', 'row0col4'); // row 0
$testData[] = array('row1col0', 'row1col1', 'row1col2', 'row1col3', 'row1col4'); // row 1
$testData[] = array('row2col0', 'row2col1', 'row2col2', 'row2col3', 'row2col4'); // row 2
$testData[] = array(0 => 'row3col0', 1 =>'row3col1', 2 => 'row3col2 and col3 together', 4=>'row3col4'); // row 3
$testData[] = array('row4col0', 'row4col1', 'row4col2', 'row4col3', 'row4col4'); // row 4

//set up the options for the table
$options = array();
$options['cellspacing'] = 0;
$options['cellpadding'] = 0;
$options['heading'] = array('Column0 Title','Column1 Title','Column 2 Title','Column 3 Title','Column 4 Title');
$options['min_width']  = array(100,120,140,160,180);
$options['width'] = array('96%','1%','1%','1%','1%');
$options['stripe'] = true;
$options['sort_by'] = 3;
$options['table_class'] = 'myclass';
$options['table_id'] = 'mytable';
$options['populate_all_cols'] = false; // default is true, but need false for colspan to work

// create the table object
$table = new claerotable($options);
 
$table->SetCellClass(1,4,'row1col4class'); // parameters are: ($rowNumber, $columnNumber, $class);
$table->SetRowClass(2, 'row2class'); // parameters are: ($rowNumber, $class);
$table->SetColSpan(3,2,2); // parameters are: ($rowNumber, $columnNumber, $count = 2);

// add the data rows to the table
foreach ($testData as $dataRow) {
    $table->AddRow($dataRow);
} // foreach

// output the HTML table
$this->template->bodyHtml .= $table->GetHtml();
*/
        
        //$pageData = Jelly::select('page')->load(3);
        //$this->template->bodyHtml .= Kohana::debug($pageData);
        
        //$this->template->bodyHtml .= json_encode($pageData['_original']);
        
        // grab all records with jelly
        /*
        $pageData = Jelly::select('page')->execute();
        //$this->template->bodyHtml .= '<p>All Pages (' . $pageData->count() . ') is: </p>' . Kohana::debug($pageData);
        
        foreach ($pageData as $data)
        {
            $this->template->bodyHtml .= '<p>' . $data->name . '</p>';
        }
        */
        
        // get the content
        //$contentData = Jelly::select('content')->where('page_id','=',3)->where('locale_id','=',2)->execute();
        //$this->template->bodyHtml .= '<p>Content (' . $contentData->count() . ') is: </p>' . Kohana::debug($contentData->as_array());
        
        
        /*

                    // get the page data for the selected language
                    $pageData = Jelly::select('Page',3)->as_array();  
                    
                    // get the page content
                    $localeId = 1;
                    $contentData = Jelly::select('content')->where('page_id','=',29)->execute();
                    //$contentData = Jelly::select('content')->where('page_id','=',3)->where('locale_id','=',$localeId);
                    
                    $this->template->bodyHtml .= Kohana::debug($contentData);
                    
                    $pageData['content'] = $contentData->as_array();
                    
                    //$this->template->bodyHtml .= Kohana::debug($contentData);

                    $output = json_encode($pageData);   
                    
                    $this->template->bodyHtml .= $output;
                    
                    
                    */
        
        /*
        $this->template->bodyHtml .=  '<hr />';
        
        $pageData = Jelly::select('page', 1)->as_array();
        
        $this->template->bodyHtml .= '<p>Section name is: ' . $pageData['section']->name . '</p>';
        $this->template->bodyHtml .= '<p>Content title is: ' . $pageData['content']->count() . '</p>';
        
        $this->template->bodyHtml .=  '<hr />';
        
        foreach($pageData['content'] AS $data) {
            $this->template->bodyHtml .= '<p>' . $data->name . '</p>';
            //$this->template->bodyHtml .= Kohana::debug($contentData);
        }
        
        $this->template->bodyHtml .=  '<hr />';
        
        $this->template->bodyHtml .= '<p>Content (' . $pageData['content']->count() . ') is: </p>' . Kohana::debug($pageData['content']);
        
        //$this->template->bodyHtml .= Kohana::debug($pageData);
        
        // grab one field with jelly
        //$this->template->bodyHtml .= Jelly::select('page', 1)->short_name;
        */
    } 

}