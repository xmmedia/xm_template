<?php try {

$test_data = array();
$test_data[] = array('row1col1', 'row1col2', 'row1col3', 'row1col4', 'row1col5');
$test_data[] = array('row2col1', 'row2col2', 'row2col3', 'row2col4', 'row2col5');
$test_data[] = array('row3col1', 'row3col2', 'row3col3', 'row3col4', 'row3col5');
$test_data[] = array('row4col1', 'row4col2', 'row4col3', 'row4col4', 'row4col5');

$table = new Claero_Table(array(
	'heading' => array('Col 1', 'Col 2', 'Col 3', 'Col 4', 'Col 5')
));

// add the data rows to the table
foreach ($test_data as $data_row) {
    $table->add_row($data_row);
} // foreach

echo $table;

?>

<?php } catch (Exception $e) {
    if (DEVELOPMENT_FLAG) {
        Kohana::exception_handler($e);
    }

    echo 'There was a problem generating the form. Please try again later.';
}