<form <? foreach ($model['attributes'] as $k => $v) echo "$k=\"$v\" ";?>>
    <table class="table-form">
        <? foreach ($model['fields'] as $field) : ?>
            <?= $field['view']?>
        <? endforeach; ?>
    </table>
</form>