<h2><?=$title?></h2>

<form action="<?=$action?>" method="post" >
    <table class="table-form">
        <input type="hidden" name="id" value="<?=$group->id?>" />
        <tr>
            <td class="label required">Name:</td>
            <td><input type="text" class="text" name="name" value="<?=$group->name?>" /></td>
        </tr>                    
        <tr>
            <td class="label required">Description:</td>
            <td><input type="text" class="text" name="description" value="<?=$group->description?>" /></td>
        </tr>                    
        <tr>
            <td class="label required">Roles:</td>
            <td>
                <? foreach ($roles as $role): ?>
                    <label for="role-<?=$role->id?>">
                        <input type="checkbox" name="roles[]" value="<?=$role->id?>" id="role-<?=$role->id?>"<?=in_array($role->id, $group_roles) ? ' checked="checked"' : ''?> />
                        <?=$role->name?>
                    </label>
                <? endforeach ?>
            </td>
        </tr>                    
        <tr class="submit">
            <td colspan="2"><input type="submit" name="" value="Save"/></td>
        </tr>
    </table>
</form>

<p><a href="/admin/groups">Back to Groups list</a></p>