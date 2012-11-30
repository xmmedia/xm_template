<!DOCTYPE html>
<html class="no-js" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="utf-8">
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
	<meta property="og:title" content="<?php echo HTML::chars($page_title); ?>">
	<meta property="og:type"  content="website">
	<meta property="og:url"   content="<?php echo HTML::chars($_SERVER['SCRIPT_URI']); ?>">
	<meta property="og:site_name" content="<?php echo HTML::chars(LONG_NAME); ?>">
	<meta property="og:image" content="<?php echo HTML::chars(URL_ROOT . '/apple-touch-icon.png'); ?>">

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
