<h2>Group Administration</h2>

<table style="width: 100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <? foreach ($groups as $group): ?>
            <tr>
                <td><?=$group->name?></td>
                <td><?=$group->description?></td>
                <td>
                    <a href="/admin/groups/edit/<?=$group->id?>">Edit</a> |
                    <a href="/admin/groups/delete/<?=$group->id?>">Delete</a>
                </td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>

<p><a href="/admin/groups/new">New Group</a></p>