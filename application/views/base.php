<?php // DH? - should we have the SYSPATH check here as well ?>
<!DOCTYPE html>
<html lang="<?php if (isset($language)) echo $language; ?>" class="no-js">
<head>
    <meta charset="utf-8">
    <title><?php if (DEVELOPMENT_FLAG) echo '*** DEVELOPMENT SITE '; ?><?php echo SHORT_NAME . ' v' . APP_VERSION; ?> <?php if (isset($pageTitle) && trim($pageTitle) != '') echo ' - ' . $pageTitle; ?></title>
    <?php if ($metaDescription != '') { ?><meta name="description" content="<?php echo $metaDescription; ?>"><?php } ?>
    <?php if ($metaKeywords != '') { ?><meta name="keywords" content="<?php echo $metaKeywords; ?>"><?php } ?>
    <?php if ($metaAuthor != '') { ?><meta name="author" content="<?php echo $metaAuthor; ?>"><?php } ?>
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
    <aside class="mainTitle"><?php echo LONG_NAME . ' v' . APP_VERSION; ?></aside>
    <header>
        <nav class="primary">
            <ul>
                <li class="home"><a href="/<?php echo i18n::lang(); ?>/page/home"><?php echo __('Home'); ?></a></li>
                <li class="about"><a href="/<?php echo i18n::lang(); ?>/page/about"><?php echo __('About'); ?></a></li>
                <li class="news"><a href="/<?php echo i18n::lang(); ?>/page/news"><?php echo __('News'); ?></a></li>
                <li class="missing"><a href="/<?php echo i18n::lang(); ?>/page/missing"><?php echo __('Missing'); ?></a></li>
                <li class="contact"><a href="/<?php echo i18n::lang(); ?>/page/contact"><?php echo __('Contact'); ?></a></li>
<?php if (!$loggedIn) { ?>
                <li><a href="/<?php echo i18n::lang(); ?>/account"><?php echo __('Login'); ?></a></li>
<?php } // if ?>
                <li class="last language"><?php echo __('Language: '); ?><?php if (isset($languageOptions)) echo $languageOptions; ?></li>
            </ul>
        </nav>
<?php if ($loggedIn) { ?>
        <nav class="private">
            <ul>
                <li style="padding-left:7px;"><?php echo __('Welcome') . ' ' . $_SESSION['full_name']; ?></li>
                <li><a href="/<?php echo i18n::lang(); ?>/account"><?php echo __('My Account'); ?></a></li>
                <li><a href="/<?php echo i18n::lang(); ?>/admin"><?php echo __('Admin'); ?></a></li>
                <li><a href="/<?php echo i18n::lang(); ?>/meta"><?php echo __('Meta'); ?></a></li>
                <li class="last"><a href="/<?php echo i18n::lang(); ?>/account/logout"><?php echo __('Logout'); ?></a></li>
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
<?php if (DEBUG_FLAG) { ?>
        <div id="kohana-profiler" style="display:none;">
<?php //echo View::factory('profiler/stats'); ?>
        </div>
<?php //echo Kohana::debug($_SERVER); ?>
<?php } ?>

    </footer>
</div><!-- wrapper -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>

<!--  -->
<?php // Javascript, put all javascript here or in $onloadJs if possible
foreach ($scripts as $file) echo HTML::script($file) . EOL;
?>

<?php // Javascript to run once the page is loaded ?>
<script>
    $(function() {
        $.ajaxSetup({ cache: false }); // don't cache ajax calls
        $('a').click(function() { this.blur(); }); // avoid lingering borders on selected links
    <?php if (isset($onLoadJs)) echo $onLoadJs . EOL; ?>
    });
</script>

<?php if (ANALYTICS_ID != '') { // Google Analytics; code from http://mathiasbynens.be/notes/async-analytics-snippet ?>
<script>
    var _gaq = [['_setAccount', '<?php echo ANALYTICS_ID; ?>'], ['_trackPageview']];
    (function(d, t) {
        var g = d.createElement(t),
        s = d.getElementsByTagName(t)[0];
        g.async = true;
        g.src = '//www.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g, s);
    })(document, 'script');
</script>
<?php } // if ?>
</body>
</html>