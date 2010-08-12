<h2>Web Site Login</h2>
<p>You must be authorized to access the privileged areas and features of this website.  Please log in below:</p>
<form action="/<?php echo i18n::lang(); ?>/account/login" method="post" >
    <table class="tableForm">                   
        <tr>
            <td class="label required">Email:</td>
            <td><input type="text" class="text" name="username" value="" autocomplete="false" /></td>
        </tr>                    
        <tr>
            <td class="label required">Password:</td>
            <td><input type="password" class="password" name="password" value="" autocomplete="false" /></td>
        </tr>                    
        <tr class="submit">
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="SUBMIT"/></td>
        </tr>            
    </table>
    <input type="hidden" name="return_to" value=""/>
</form>