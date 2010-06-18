<? if (array_key_exists('errors', $model)) : ?>
<? foreach ($model['errors'] as $error) : ?>
	<?=$error?><br/>
<? endforeach; ?>
<? endif; ?>
<? if (get('not_empty', $model)) : ?>
<span class="required">*</span>
<? endif; ?>
<b><?= get('label', $model)?> </b><br/>
<textarea name="<?= get('name', $model)?>" cols="<?= get('cols', $model)?>" rows="<?= get('rows', $model)?>">
<?= get('value', $model)?>
</textarea><br/>