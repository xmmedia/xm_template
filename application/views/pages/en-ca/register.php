<h2>Registration</h2>
<p>If you are an employee, supplier, or customer and you have been asked to request an account, please fill out the form below.
Accounts are not automatically granted and will require approval and validation.  You will receive an email once your account has
been activated.</p>
<div class="statusMessage">Please note that ALL fields except 'Mobile Phone' are required in order to proceed.</div>
<form action="/<?php echo i18n::lang(); ?>/account/register" method="post" >
    <table class="tableForm">
        <tr>
            <td class="label required">Email:</td>
            <td><input type="text" class="text" name="email" value="<?php echo Security::xss_clean(Arr::get($_POST, 'email', '')); ?>"/></td>
            <td rowspan="8" valign="bottom" align="right" style="padding-left:20px;">
                <p>You are required to type in the two words below in order for us to ensure that
                you are a real person.  This helps us avoid spam and other malicious
                behaviour associated with accepting information through our web page.  We apologize
                for the inconvenience.</p>
<?php
    require_once(ABS_ROOT . '/lib/recaptcha/recaptchalib.php');
    echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY);
?>
                <br />
                <input type="submit" name="submit" value="SUBMIT"/>
            </td>
        </tr>
        <tr>
            <td class="label required">Password (min. 6 chars):</td>
            <td><input type="password" class="password" name="password" value=""/></td>
        </tr>
        <tr>
            <td class="label required">Confirm Password:</td>
            <td><input type="password" class="password" name="password_confirm" value=""/></td>
        </tr>
        <tr>
            <td class="label required">First Name:</td>
            <td><input type="text" class="text" name="first_name" value="<?php echo Security::xss_clean(Arr::get($_POST, 'first_name', '')); ?>"/></td>
        </tr>
        <tr>
            <td class="label required">Middle Name:</td>
            <td><input type="text" class="text" name="middle_name" value="<?php echo Security::xss_clean(Arr::get($_POST, 'middle_name', '')); ?>"/></td>
        <tr>
        </tr>
            <td class="label required">Last Name:</td>
            <td><input type="text" class="text" name="last_name" value="<?php echo Security::xss_clean(Arr::get($_POST, 'last_name', '')); ?>"/></td>
        </tr>
        <tr>
            <td class="label required">Company:</td>
            <td><input type="text" class="text" name="company" value="<?php echo Security::xss_clean(Arr::get($_POST, 'company', '')); ?>"/></td>
        </tr>
        <tr>
            <td class="label required">Province:</td>
            <td>
                <select name="province_id" id="province_id" onchange="$('#province_select').submit();">
<?php
foreach($provinceList AS $id => $name) {
    $selected = ($id == $provinceId) ? ' selected' : '';
    echo '                    <option value="' . $id . '"' . $selected . '>' . $name . '</option>' . EOL;
} // foreach
?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="label required">Work Phone:</td>
            <td><input type="text" class="text" name="work_phone" value="<?php echo Security::xss_clean(Arr::get($_POST, 'work_phone', '')); ?>"/></td>
        </tr>
        <tr>
            <td class="label">Mobile Phone (optional):</td>
            <td><input type="text" class="text" name="mobile_phone" value="<?php echo Security::xss_clean(Arr::get($_POST, 'mobile_phone', '')); ?>"/></td>
        </tr>
    </table>
    <input type="hidden" name="return_to" value=""/>
</form>