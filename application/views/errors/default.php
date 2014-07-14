<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo HTML::chars($title); ?></title>
<?php
$styles = array(
	'css/base.css' => NULL,
	'css/public.css' => NULL,
);
foreach ($styles as $file => $type) :
	echo TAB, HTML::style($file, array('media' => $type)), EOL;
endforeach;
?>
	<!--[if lt IE 9]>
	<script><?php echo include(DOCROOT . 'js' . DIRECTORY_SEPARATOR . 'html5shiv.min.js'); ?></script>
	<![endif]-->
</head>

<body>
<?php
// header: menus, logos, etc
echo View::factory('public/header')
	->set($kohana_view_data);
?>
<div class="main_content">
	<div class="grid">
		<div class="col">
			<h1><?php echo HTML::chars($title); ?></h1>
			<p><?php echo HTML::chars(UTF8::clean($message)); ?></p>
		</div>
	</div>
</div>
<?php
// the footer
echo View::factory('public/footer')
	->set($kohana_view_data);
// debug: debug output; detects debug mode within view
echo View::factory('base/debug')
		->set($kohana_view_data); ?>
</body>
</html>