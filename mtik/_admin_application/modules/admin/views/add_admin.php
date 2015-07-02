<?php

/**
 * @author phpdesigner
 * @copyright 2012
 */



?>
<style type="text/css">
<!--
	input[type=text]{
	   width: 180px;
	}
-->
</style>
<?php
$form_username = '';
$form_recovery_email = '';
$form_password = '';
if(isset($username)){
    $form_username = $username;
}
if(isset($recovery_email)){
    $form_recovery_email = $recovery_email;
}
if(isset($password)){
    $form_password = $password;
}
?>
<h3>Add Admin User</h3>
<div class="new_msg1">
<?php
    echo validation_errors();
?>
<form action="<?php echo base_url(); ?>admin/add" method="post">
<table>
<!--
<tr>
    <td>Recovery Email:</td>
    <td><input type="text" name="recovery_email" id="recovery_email" value="<?php echo $form_recovery_email; ?>" /></td>
</tr>
-->
<tr>
    <td>Username:</td>
    <td><input type="text" name="username" id="username" value="<?php echo $form_username; ?>" /></td>
</tr>
<tr>
    <td>Password:</td>
    <td><input type="text" name="password" id="password" value="<?php echo $form_password; ?>"  /></td>
</tr>
<tr>
    <td>Re-Password:</td>
    <td><input type="text" name="re_password" id="re_password" /></td>
</tr>
<tr>
    <td><input class="btn btn-primary" name="submit" type="submit" value="Submit" /></td>
    
</tr>

</table>
</form>
</div>