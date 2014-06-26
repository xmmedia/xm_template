<!DOCTYPE html>
<html class="no-js" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php
if (DEVELOPMENT_FLAG) {
	echo '*** Dev *** ';
}
echo HTML::chars($page_title); ?></title>

<?php
if ( ! empty($meta_tags)) :
	foreach ($meta_tags as $name => $content) :
		if ( ! empty($content)) :
			echo TAB . HTML::meta($name, $content) . EOL;
		endif;
	endforeach;
endif;
?>
	<meta property="og:title" content="<?php echo HTML::chars($page_title); ?>">
	<meta property="og:type"  content="website">
	<meta property="og:url"   content="<?php echo HTML::chars($_SERVER['SCRIPT_URI']); ?>">
	<meta property="og:site_name" content="<?php echo HTML::chars(LONG_NAME); ?>">
	<meta property="og:image" content="<?php if ( ! empty($og_image)) { echo HTML::chars(URL::site($og_image)); } else { echo HTML::chars(URL::site('/apple-touch-icon.png')); } ?>">
<?php if ( ! empty($meta_tags['description'])) : ?>	<meta property="og:description" content="<?php echo HTML::chars($meta_tags['description']); ?>"><?php endif ?>
	<link rel="author" href="/humans.txt">

<?php
foreach ($styles as $file => $type) :
	echo TAB, HTML::style($file, array('media' => $type)), EOL;
endforeach;
?>

	<!--[if lt IE 9]>
	<script><?php echo include(DOCROOT . 'js' . DIRECTORY_SEPARATOR . 'html5shiv.min.js'); ?></script>
	<![endif]-->
	<script>
		var in_debug = <?php echo (int) DEBUG_FLAG; ?>;
	</script>
</head>
