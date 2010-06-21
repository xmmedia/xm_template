<h2><?=$display_name?> Administration</h2>

<table style="width: 100%">
    <thead>
        <tr>
            <? foreach($columns as $column): ?>
                <th class="<?=$column->property_name?>"><?=$column->header()?></th>
            <? endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <? foreach ($list as $entry): ?>
            <tr>
                <? foreach ($columns as $column): ?>
                    <td class="<?=$column->property_name?>"><?=$column->value($entry)?></td>
                <? endforeach; ?>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>

<p><a href="/<?=$url_prefix?>/new">New Group</a></p>