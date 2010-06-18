<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title>ClaeroLib 4</title>
    
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Your description goes here" />
	<meta name="keywords" content="your,keywords,go,here" />
	<meta name="author" content="Claero Systems" />
    
	<link rel="stylesheet" type="text/css" href="/css/daleri-single.css" />
    <? foreach($css as $css_filename): ?>
        <link rel="stylesheet" type="text/css" href="<?=$css_filename?>" />
    <? endforeach; ?>
</head>

<body>
<div id="wrap">
    <div id="auth">
        <? if (false !== $user): ?>
			<p>Hello, <b><?=$user->name?></b>. <a href="/account/logout">Log out?</a></p>
        <? else: ?>
            <p>Please <a href="/account/login">log in</a> or <a href="/account/register">register</a>.</p>
        <? endif; ?>
    </div>
    
	<h1><a href="/">Claero Base Application</a></h1>

	<p class="toptabs">
        <strong class="hide">Main menu:</strong>
        <? foreach($menus as $key => $menu): ?>
            <a class="toptab<?=$menu['active']?>" href="<?=$menu['link']?>"><?=$menu['text']?></a><span class="hide"> | </span>
        <? endforeach; ?>
	</p>
	
	<? if (isset($message)): ?>
		<div id="message">
			<?=$message?>
		</div>
	<? endif; ?>
	
	<div id="maincontent">
        <?=$content?>
	</div>

	<p class="footer">Copyright &copy; 2010<?=(date("Y") > 2010) ? (" - " . date("Y")) : ""?> <a href="http://www.claero.com">Claero Systems</a></p>
    
    <? foreach($scripts as $script_filename): ?>
        <script src="<?=$script_filename?>" type="text/javascript"></script>
    <? endforeach; ?>
</div>
</body>
</html>
