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
	table.cl4_form {border:1px solid #ccc; margin-top:10px; margin-bottom:10px;}
	table.cl4_form td {padding:4px;}
	table.cl4_form input[type="password"], table.cl4_form input[type=text], table.cl4_form select {width:200px;}
	table.cl4_form input.date_field-date {width:80px;}
	table.cl4_form input.date_field-hour, table.cl4_form input.date_field-min, table.cl4_form input.date_field-sec {width:20px;}
	table.cl4_form tr.even td, table.cl4_form tr.odd td {background-color:#fff;}
	table.cl4_form td.column0 {text-align:right; padding-right:20px; width:100px;}
	/* ul form css */
	ul.cl4_form {display:block; margin-top:10px; margin-bottom:10px;}
	ul.cl4_form li {list-style-type:none;}
	ul.cl4_form li ul {width:700px;}
	ul.cl4_form li ul li{position:relative; float:left;}
	ul.cl4_form li ul li.field_label{width:200px;}
	ul.cl4_form li ul li.field_value{width:500px;}
</style>
<h1>cl4 ORM Extension Examples</h1>

<h2>Generate a precanned edit form, from a model</h2>
<p>The edit form is generated based on the model information.  cl4 uses the default Kohana ORM model data
and also adds some properties (form and column) to provide additional features.</p>
<code>echo ORM::factory('Cl4BlogPost',2)->get_form(array('form_id' => 'test1'));</code>
<?php echo ORM::factory('Cl4BlogPost',2)->get_form(array('form_id' => 'test1')); ?>

<h2>same as above but using the magic PHP __toString() function:</h2>
<code>echo ORM::factory('Cl4BlogTag',2);</code>
<?php echo ORM::factory('Cl4BlogTag',2); ?>

<h2>Generate a pre-canned edit form, from a model, with a different view</h2>
<code>
	$userForm = new Model_Cl4BlogPerson(1);<br />
	$userForm->set_options(array('form_view' => 'claero/form_ul'));<br />
	echo $userForm->get_form(); <br />
</code>
<?php
	$userForm = new Model_Cl4BlogPost(1);
	$userForm->set_options(array('form_view' => 'claero/form_ul'));
	echo $userForm->get_form();
?>

<h2>Create a custom form, from a model</h2>
<code>
	$new_user = new Model_Cl4BlogPerson;<br />
	$new_user->prepare_form();<br />
 	EMAIL: echo $new_user->get_field('email_address') . EOL;<br />
	FIRST: echo $new_user->get_field('first_name') . EOL;<br />
	LAST: echo $new_user->get_field('last_name') . EOL;<br />
	echo Form::input('submit', 'submit', array('type' => 'submit')) . EOL;<br />
</code>
<?php
	// create the new model and prepare the form fields
	$new_user = new Model_Cl4BlogPerson;
	$new_user->prepare_form();
	// now generate our custom form and grab the fields we want
?>
<form>
 	EMAIL: <?php echo $new_user->get_field('email_address') . EOL; ?>
	FIRST: <?php echo $new_user->get_field('first_name') . EOL; ?>
	LAST: <?php echo $new_user->get_field('last_name') . EOL; ?>
	<?php echo Form::input('submit', 'submit', array('type' => 'submit')) . EOL; ?>
</form>

<h2>Generate a listing of data from a model</h2>
<?php //echo ORM::factory('claerochange')->get_list(); ?>
<?php //echo ORM::factory('claerochange', array('table_name' => 'claero_meta'))->get_list(); ?>
<?php echo ORM::factory('Cl4BlogPost')->where('publish_flag','=','1')->limit(5)->get_list(); ?>

<h2>Generate an editable listing of data from a model</h2>
<?php //echo ORM::factory('claerochange')->get_list(); ?>
<?php //echo ORM::factory('claerochange', array('table_name' => 'claero_meta'))->get_list(); ?>
<?php echo ORM::factory('Cl4BlogPost')->where('publish_flag','=','1')->get_editable_list(); ?>

<h2>Generate model PHP from table</h2>
<?php
	$db = Database::instance();
	$table_name = Security::xss_clean(Arr::get($_GET, 'table_name', 100));
	$table_list = $db->list_tables();
?>
Select a table to generate the cl4/orm model code:
<?php echo Form::select('m_table_name', $table_list, $table_name, array('id' => 'm_table_name', 'onchange' => 'UpdateModel()')); ?>
<textarea id="model_code" style="width:100%; height:400px; margin-top:15px;">
<?php echo ORM::factory('Cl4BlogPost')->create_model('claero_change'); ?>
</textarea>