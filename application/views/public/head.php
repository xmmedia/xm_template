<!DOCTYPE html>
<html <?php if (isset($language)) { ?>lang="<?php echo HTML::chars($language); ?>" <?php } ?>class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php
if (DEVELOPMENT_FLAG) {
	echo '*** ' . HTML::chars(SHORT_NAME . ' v' . APP_VERSION) . ' Development Site *** ';
}
if ( ! empty($page_title) && trim($page_title) != '') {
	echo HTML::chars($page_title);
} ?></title>
<?php if ( ! empty($meta_tags)) {
	foreach ($meta_tags as $name => $content) {
		if ( ! empty($content)) {
			echo TAB . HTML::meta($name, $content) . EOL;
		} // if
	} // foreach
} // if
?>
	<!--[if lte IE 9]><link href="/css/1140ie.css" rel="stylesheet"><![endif]-->
<?php
foreach ($styles as $file => $type) {
	echo TAB, HTML::style($file, array('media' => $type)), EOL;
}

echo TAB, HTML::script('js/modernizr.min.js'), EOL;
?>
	<script>
		var cl4_in_debug = <?php echo (int) DEBUG_FLAG; ?>;
	</script>
</head>
