<form <? foreach ($model['attributes'] as $k => $v) echo "$k=\"$v\" ";?>>
<? foreach ($model['fields'] as $field) : ?>
<?= $field['view']?><br/>
<? endforeach; ?>
</form>