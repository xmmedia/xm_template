<? if (array_key_exists('errors', $model)) : ?>
    <tr class="error">
        <td colspan="2">
            <ul>
                <? foreach ($model['errors'] as $error) : ?>
                    <li><?=$error?></li>
                <? endforeach; ?>
            </ul>
        </td>
    </tr>
<? endif; ?>

<tr>
    <td class="label<?=(get('not_empty', $model)) ? ' required' : ''?>">
        <?= get('label', $model) ?>
    </td>
    <td>
        <input type="text" class="text" name="<?=$model['name']?>" value="<?= get('value', $model) ?>"/>
    </td>
</tr>