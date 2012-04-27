
<?php if ( ! empty($pre_message) || ! empty($message)) { ?>
<div id="container">
	<div id="row">
		<div class="twelvecol">
	<?php
	echo $pre_message;
	if ( ! empty($message)) {
		echo $message;
	}
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