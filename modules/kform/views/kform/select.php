<? if (array_key_exists('errors', $model)) : ?>
<? foreach ($model['errors'] as $error) : ?>
	<?=$error?><br/>
<? endforeach; ?>
<? endif; ?>
<? if (get('not_empty', $model)) : ?>
<span class="required">*</span>
<? endif; ?>
<b><?= get('label', $model)?></b>
<select name="<?= $model['name']?>"/>
<? foreach ($model['items'] as $item) : ?>
<option value="<?=$item['value']?>" <?= get('value', $model) == $item['value'] ? 'selected' : ''?>><?=$item['text']?></option>
<? endforeach; ?>
</select>