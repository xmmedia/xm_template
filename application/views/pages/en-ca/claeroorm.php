<script>
	// set up the model field update function
	function UpdateModel() {
		$.get('/rest/model/' + $('#table_name option:selected').html(), function(data) {
			$('#model_code').html(data);
		});
	} // function

</script>

<h1>cl4 ORM Extension Examples</h1>

<h2>Generate a precanned edit form, from a model</h2>
<?php echo ORM::factory('user',2)->get_html(); ?>

<h2>Create a custom form, from a model</h2>
<?php 
	$new_user = new Model_User;
	$new_user->prepare_form(); 
?>
<form>
EMAIL: <?php echo $new_user->get_field_html('username'); ?>
PASS: <?php echo $new_user->get_field_html('password'); ?>
FIRST: <?php echo $new_user->get_field_html('first_name'); ?>
LAST: <?php echo $new_user->get_field_html('last_name'); ?>
<?php echo ClaeroForm::input('submit', 'submit', array('type' => 'submit')); ?>
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