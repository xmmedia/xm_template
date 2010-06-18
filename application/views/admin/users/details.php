<h2><?=$title?></h2>

<form action="<?=$action?>" method="post" >
    <table class="table-form">
        <input type="hidden" name="id" value="<?=$user->id?>" />
        <tr>
            <td class="label required">Email:</td>
            <td><input type="text" class="text" name="email" value="<?=$user->email?>" /></td>
        </tr>                    
        <tr>
            <td class="label required">Name:</td>
            <td><input type="text" class="text" name="name" value="<?=$user->name?>" /></td>
        </tr>                    
        <tr>
            <td class="label required">New Password:</td>
            <td><input type="password" class="text" name="password" value="" /></td>
        </tr>                    
        <tr>
            <td class="label required">Confirm New Password:</td>
            <td><input type="password" class="text" name="password_confirm" value="" /></td>
        </tr>                    
        <tr>
            <td class="label required">Groups:</td>
            <td>
                <? foreach ($groups as $group): ?>
                    <label for="group-<?=$group->id?>">
                        <input type="checkbox" name="groups[]" value="<?=$group->id?>" id="group-<?=$group->id?>"<?=in_array($group->id, $user_groups) ? ' checked="checked"' : ''?> />
                        <?=$group->name?>
                    </label>
                <? endforeach ?>
            </td>
        </tr>                    
        <tr class="submit">
            <td colspan="2"><input type="submit" name="" value="Save"/></td>
        </tr>
    </table>
</form>

<p><a href="/admin/users">Back to Users list</a></p>