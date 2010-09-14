<script>
	// set up the model field update function
	function UpdateModel() {
		$.get('/rest/model/' + $('#m_table_name option:selected').html(), function(data) {
			$('#model_code').html(data);
		});
	} // function

</script>
<style>
	code, .code {display:block; width:700px; padding:4px; border:1px #ccc dashed; margin:5px;}
	/* table form css */
	table.cl4 {border:1px solid #ccc; margin-top:10px; margin-bottom:10px;}
	table.cl4 td {padding:4px;}
	table.cl4 input[type="password"], table.cl4 input[type=text], table.cl4 select {width:200px;}
	table.cl4 tr.even td, table.cl4 tr.odd td {background-color:#fff;}
	table.cl4 td.column0 {text-align:right; padding-right:20px; width:100px;}
	/* ul form css */
	ul.cl4 {display:block; margin-top:10px; margin-bottom:10px;}
	ul.cl4 li {list-style-type:none;}
	ul.cl4 li ul {width:450px;}
	ul.cl4 li ul li{position:relative; float:left; width:200px;}
</style>
<h1>cl4 ORM Extension Examples</h1>

<?php
	//echo kohana::debug(ORM::factory('AuthLog',2)->authtype->name);
	//echo kohana::debug(ORM::factory('AuthLog',2)->user->first_name);
	//echo kohana::debug(ORM::factory('AuthLog',2)->authtype);
	//echo kohana::debug(ORM::factory('AuthLog',2)->find());
?>

<h2>Generate a precanned edit form, from a model</h2>
<p>The edit form is generated based on the model information.  cl4 uses the default Kohana ORM model data
and also adds some properties (form and column) to provide additional features.</p>
<code>echo ORM::factory('Claerochange',2)->get_form(array('form_id' => 'test1'));</code>
<?php echo ORM::factory('Claerochange',2)->get_form(array('form_id' => 'test1')); ?>

<h2>same as above but using the magic PHP __toString() function:</h2>
<code>echo ORM::factory('AuthLog',2);</code>
<?php echo ORM::factory('AuthLog',2); ?>

<h2>Generate a pre-canned edit form, from a model, with a different view</h2>
<code>
	$userForm = new Model_User(1);<br />
	$userForm->set_options(array('form_view' => 'claero/form_ul'));<br />
	echo $userForm->get_form(); <br />
</code>
<?php
	$userForm = new Model_Claerochange(1);
	$userForm->set_options(array('form_view' => 'claero/form_ul'));
	echo $userForm->get_form();
?>

<h2>Create a custom form, from a model</h2>
<?php
	// create the new model and prepare the form fields
	$new_user = new Model_Claerochange;
	$new_user->prepare_form();
	// now generate our custom form and grab the fields we want
?>
<form>
 	EMAIL: <?php echo $new_user->get_field('username') . EOL; ?>
	PASS: <?php echo $new_user->get_field('password') . EOL; ?>
	FIRST: <?php echo $new_user->get_field('first_name') . EOL; ?>
	LAST: <?php echo $new_user->get_field('last_name') . EOL; ?>
	<?php echo ClaeroForm::input('submit', 'submit', array('type' => 'submit')) . EOL; ?>
</form>

<h2>Generate a listing of data from a model</h2>
<?php //echo ClaeroORM::factory('claerochange')->get_list(); ?>
<?php //echo ClaeroORM::factory('claerochange', array('table_name' => 'claero_meta'))->get_list(); ?>
<?php echo ClaeroORM::factory('claerochange')->where('table_name','=','claero_meta')->limit(5)->get_list(); ?>

<h2>Generate an editable listing of data from a model</h2>
<?php //echo ClaeroORM::factory('claerochange')->get_list(); ?>
<?php //echo ClaeroORM::factory('claerochange', array('table_name' => 'claero_meta'))->get_list(); ?>
<?php echo ClaeroORM::factory('claerochange')->where('table_name','=','claero_meta')->get_editable_list(); ?>

<h2>Generate model PHP from table</h2>
<?php
	$db = Database::instance();
	$table_name = Security::xss_clean(Arr::get($_GET, 'table_name', 100));
	$table_list = $db->list_tables();
?>
Select a table to generate the cl4/orm model code:
<?php echo ClaeroForm::select('m_table_name', $table_list, $table_name, array('id' => 'm_table_name', 'onchange' => 'UpdateModel()')); ?>
<textarea id="model_code" style="width:100%; height:400px; margin-top:15px;">
<?php echo ORM::factory('Claerochange')->create_model('claero_change'); ?>
</textarea>
<h2>Sample Model</h2>
<?php echo kohana::debug(ORM::factory('user')); ?>