<? if (array_key_exists('errors', $model)) : ?>
<? foreach ($model['errors'] as $error) : ?>
	<?=$error?><br/>
<? endforeach; ?>
<? endif; ?>
<? if (get('not_empty', $model)) : ?>
<span class="required">*</span>
<? endif; ?>
<b><?= get('label', $model)?></b><br/>
<? foreach ($model['items'] as $item) : ?>
<input type="radio" name="<?= $model['name']?>" value="<?=$item['value']?>" <?= get('value', $model) == $item['value'] ? 'checked' : ''?>/><?=$item['text']?><br/>
<? endforeach; ?>
