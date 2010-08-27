<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<style>
.claero_table tr td { padding:3px; width:75px; }
</style>
<?php try {

$test_data = array();
$test_data[] = array('row1 col1', 'row1 col2', 'row1 col3', 'row1 col4', 'row1 col5');
$test_data[] = array('row2 col1', 'row2 col2', 'row2 col3', 'row2 col4', 'row2 col5');
$test_data[] = array('row3 col1', 'row3 col2', 'row3 col3', 'row3 col4', 'row3 col5');
$test_data[] = array('row4 col1', 'row4 col2', 'row4 col3', 'row4 col4', 'row4 col5');

$table = new Claero_Table(array(
	'table_attributes' => array(
		'id' => 'blah',
		'class' => 'claero_table',
	),
	'heading' => array('Col 1', 'Col 2', 'Col 3', 'Col 4', 'Col 5'),
	'data' => $test_data,
));

// add the data rows to the table
/*foreach ($test_data as $data_row) {
    $table->add_row($data_row);
} // foreach*/

echo $table->get_html();

?>

<?php } catch (Exception $e) {
    if (DEVELOPMENT_FLAG) {
        Kohana::exception_handler($e);
    }

    echo 'There was a problem generating the form. Please try again later.';
}