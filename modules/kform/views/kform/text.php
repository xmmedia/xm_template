<? if (array_key_exists('errors', $model)) : ?>
<? foreach ($model['errors'] as $error) : ?>
	<?=$error?><br/>
<? endforeach; ?>
<? endif; ?>
<? if (get('not_empty', $model)) : ?>
<span class="required">*</span>
<? endif; ?>
<b><?= get('label', $model) ?></b>
<input type="text" name="<?=$model['name']?>" value="<?= get('value', $model) ?>"/>