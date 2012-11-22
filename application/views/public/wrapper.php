
<?php
$message_html = (string) $message;
if ( ! empty($pre_message) || ! empty($message_html)) { ?>
<div class="grid">
	<div class="col">
	<?php
	echo $pre_message, $message_html;
	?>
	</div>
</div>
<?php } // if ?>

<div class="main_content">
<?php echo $body_html; ?>
</div>

<?php echo View::factory('public/footer')
	->set($kohana_view_data); ?>