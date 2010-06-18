<h2>User Administration</h2>

<table style="width: 100%">
    <thead>
        <tr>
            <th>Email</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <? foreach ($users as $user): ?>
            <tr>
                <td><?=$user->email?></td>
                <td><?=$user->name?></td>
                <td>
                    <a href="/admin/users/edit/<?=$user->id?>">Edit</a> |
                    <a href="/admin/users/delete/<?=$user->id?>">Delete</a>
                </td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>

<p><a href="/admin/users/new">New User</a></p>