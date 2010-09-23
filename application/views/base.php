<?php // DH? - should we have the SYSPATH check here as well ?>
<!DOCTYPE html>
<html lang="<?php if (isset($language)) echo $language; ?>" class="no-js">
<head>
    <meta charset="utf-8">
    <?php if (!DEBUG_FLAG) { ?><!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1"><![endif]--><?php echo EOL; } ?>
    <title><?php if (DEVELOPMENT_FLAG) echo '*** DEVELOPMENT SITE '; ?><?php echo SHORT_NAME . ' v' . APP_VERSION; ?> <?php if (isset($pageTitle) && trim($pageTitle) != '') echo ' - ' . $pageTitle; ?></title>
    <?php if (isset($metaDescription) && $metaDescription != '') { ?><meta name="description" content="<?php echo $metaDescription; ?>"><?php } ?>
    <?php if (isset($metaKeywords) && $metaKeywords != '') { ?><meta name="keywords" content="<?php echo $metaKeywords; ?>"><?php } ?>
    <?php if (isset($metaAuthor) && $metaAuthor != '') { ?><meta name="author" content="<?php echo $metaAuthor; ?>"><?php } ?>
    <meta name="viewport" content="width=device-width">
<?php foreach ($styles as $file => $type) echo '    ' . HTML::style($file, array('media' => $type)) . EOL; ?>
<?php // http://www.modernizr.com fixes missing html5 elements in IE and detects for new HTML5 features; this needs to be loaded here so the HTML5 tags will show in IE ?>
    <script src="/js/modernizr-1.5.min.js"></script>
    <script>
        var pageLocale = '<?php echo i18n::lang(); ?>';
        var pageUrl = 'http://<?php echo THIS_PAGE; ?>';
        var baseUrl = 'http://<?php echo URL_ROOT; ?>';
        var pageSection = '<?php echo $pageSection; ?>';
        var pageName = '<?php echo $pageName; ?>';
        var googleMapsApiPublicKey = '<?php echo GOOGLE_API_KEY; ?>';
    </script>
</head>
<body class="<?php echo $bodyClass; ?>">
<div id="wrapper">
<?php if (DEVELOPMENT_FLAG) { ?>
    <aside class="development">THIS SITE IS CURRENTLY UNDER DEVELOPMENT</aside>
<?php } // if ?>
<?php // DH? - should this be an aside? kind of important for the page; craig agrees ?>
    <aside class="mainTitle"><?php echo LONG_NAME . ' v' . APP_VERSION; ?><?php if (isset($pageTitle) && trim($pageTitle) != '') echo ' - ' . $pageTitle; ?></aside>
    <header>
        <nav class="primary">
            <ul>
                <li class="home"><a href="/<?php echo i18n::lang(); ?>/page/home"><?php echo __('Home'); ?></a></li>
                <li class="claeroform"><a href="/<?php echo i18n::lang(); ?>/page/claeroform"><?php echo __('claeroform'); ?></a></li>
                <li class="claerotable"><a href="/<?php echo i18n::lang(); ?>/page/claerotable"><?php echo __('claerotable'); ?></a></li>
                <li class="claeroorm"><a href="/<?php echo i18n::lang(); ?>/page/claeroorm"><?php echo __('claeroorm'); ?></a></li>
<?php if ( ! $logged_in) { ?>
                <li><a href="/<?php echo i18n::lang(); ?>/login"><?php echo __('Login'); ?></a></li>
<?php } // if ?>
                <li><a href="/claeroadmin"><?php echo __('claeroadmin'); ?></a></li>
                <li class="last language"><?php echo __('Language: '); ?><?php if (isset($languageOptions)) echo $languageOptions; ?></li>
            </ul>
        </nav>
<?php if ($logged_in) { ?>
        <nav class="private">
            <ul>
                <li style="padding-left:7px;"><?php echo __('Welcome')/* . ' ' . $_SESSION['full_name']*/; ?></li>
                <li><a href="/<?php echo i18n::lang(); ?>/account/profile"><?php echo __('My Account'); ?></a></li>
                <li><a href="/<?php echo i18n::lang(); ?>/admin"><?php echo __('Admin'); ?></a></li>
                <li><a href="/<?php echo i18n::lang(); ?>/meta"><?php echo __('Meta'); ?></a></li>
                <li class="last"><a href="/<?php echo i18n::lang(); ?>/logout"><?php echo __('Logout'); ?></a></li>
            </ul>
        </nav>
<?php } // if ?>
    </header>
<?php if (isset($message) && $message != '') echo '<div class="statusMessage message">' . $message . '</div>' . EOL; ?>
    <div id="mainContent">
<?php echo $bodyHtml; ?>
    </div>
    <div style="clear:both;"></div>

    <footer>
        <nav>
            &copy;<?php echo date('Y'); ?> Claero Systems <?php echo __('All Rights Reserved'); ?>
            | <a href="/<?php echo i18n::lang(); ?>/page/home/sitemap"><?php echo __('Site Map'); ?></a>
            | <a href="/<?php echo i18n::lang(); ?>/page/home/privacy"><?php echo __('Privacy Policy'); ?></a>
            | <a href="/<?php echo i18n::lang(); ?>/page/home/aboutsite"><?php echo __('About this site'); ?></a>
        </nav>

        <div style="clear:both;"></div>
    </footer>
</div><!-- wrapper -->

<?php // Javascript, put all javascript here or in $onloadJs if possible
foreach ($scripts as $file) echo HTML::script($file) . EOL;
?>

<?php // Javascript to run once the page is loaded ?>
<script>
    $(function() {
        $.ajaxSetup({ cache: false }); // don't cache ajax calls
        $('a').click(function() { this.blur(); }); // avoid lingering borders on selected links
    <?php if ($onLoadJs) echo $onLoadJs . EOL; ?>
    });
</script>

<?php if (ANALYTICS_ID != '') { // Google Analytics; code from http://mathiasbynens.be/notes/async-analytics-snippet ?>
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', '<?php echo ANALYTICS_ID; ?>']);
	_gaq.push(['_trackPageview']);
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	</script>
<?php } // if ?>

<?php if (DEBUG_FLAG) { ?>
        <div id="kohana-profiler">
<?php echo View::factory('profiler/stats'); ?>
        </div>
<?php echo View::factory('claero/debug'); ?>
<?php //echo Kohana::debug($_SERVER); ?>
<?php } ?>

</body>
</html>
