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
foreach ($styles as $file => $type) {
	echo TAB, HTML::style($file, array('media' => $type)), EOL;
}

echo TAB, HTML::script('js/modernizr.min.js'), EOL;
?>
</head>

<body>
<?php
// header: menus, logos, etc
echo View::factory('public/header')
	->set($kohana_view_data);
?>
<div class="grid">
	<h1><?php echo HTML::chars($title); ?></h1>
	<p><?php echo HTML::chars($message); ?></p>
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