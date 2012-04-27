
<?php
$message_html = (string) $message;
if ( ! empty($pre_message) || ! empty($message_html)) { ?>
<div id="container">
	<div id="row">
		<div class="twelvecol">
	<?php
	echo $pre_message, $message_html;
	?>
		</div>
	</div>
</div>
<?php } // if ?>

<div class="main_content">
<?php echo $body_html; ?>
</div>

<?php echo View::factory('public/footer')
	->set($kohana_view_data); ?>