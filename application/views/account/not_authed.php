<h2>Not Authorized</h2>

<p>You are not authorized to perform this action.  You require the following roles:</p>

<ul>
    <? foreach($roles as $role): ?>
        <li><?=$role?></li>
    <? endforeach; ?>
</ul>

<p>Please contact your administrator.</p>