<script>
	// set up the model field update function
	function UpdateModel() {
		$.get('/rest/model/' + $('#table_name option:selected').html(), function(data) {
			$('#model_code').html(data);
		});
	} // function

</script>
<style>
	code, .code {display:block; width:500px; padding:4px; border:1px #ccc dashed; margin:5px;}
	table.cl4 td {padding:4px;}
	table.cl4 input[type="password"], table.cl4 input[type=text], table.cl4 select {width:200px;}
	table.cl4 tr.even td, table.cl4 tr.odd td {background-color:#fff;}
	table.cl4 td.column0 {text-align:right; padding-right:20px; width:100px;}
</style>
<h1>cl4 ORM Extension Examples</h1>

<?php 
	//echo kohana::debug(ORM::factory('AuthLog',2)->authtype->name);
	//echo kohana::debug(ORM::factory('AuthLog',2)->user->first_name);
	//echo kohana::debug(ORM::factory('AuthLog',2)->authtype); 
	//echo kohana::debug(ORM::factory('AuthLog',2)->find());
?>

<h2>Generate a precanned edit form, from a model</h2>
<code>echo ORM::factory('User',2)->get_html();</code>
<?php echo ORM::factory('User',2)->get_html(); ?>

<h2>same as above but using the magic PHP __toString() function:</h2>
<code>echo ORM::factory('AuthLog',2);</code>
<?php echo ORM::factory('AuthLog',2); ?>

<h2>Create a custom form, from a model</h2>
<?php 
	// create the new model and prepare the form fields
	$new_user = new Model_User;
	$new_user->prepare_form(); 
	// now generate our custom form and grab the fields we want
?>
<form>
 	EMAIL: <?php echo $new_user->get_field_html('username') . EOL; ?>
	PASS: <?php echo $new_user->get_field_html('password') . EOL; ?>
	FIRST: <?php echo $new_user->get_field_html('first_name') . EOL; ?>
	LAST: <?php echo $new_user->get_field_html('last_name') . EOL; ?>
	<?php echo ClaeroForm::input('submit', 'submit', array('type' => 'submit')) . EOL; ?>
</form>

<h2>Generate model PHP from table</h2>
<?php 
	$db = Database::instance();
	$table_name = Security::xss_clean(Arr::get($_GET, 'table_name', 100));
	$table_list = $db->list_tables();
?>
Select a table to generate the cl4/orm model code:
<?php echo ClaeroForm::select('table_name', $table_list, $table_name, array('onchange' => 'UpdateModel()')); ?>
<textarea id="model_code" style="width:100%; height:400px; margin-top:15px;">
<?php echo ORM::factory('user')->create_model('user'); ?>
</textarea>