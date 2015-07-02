
<style type="text/css">
<!--
	input[type=text]{
	   width: 180px;
	}
-->
</style>
<?php

$form_password = '';

if(isset($password)){
    $form_password = $password;
}
?>
<h3>Edit Admin User</h3>
<div class="new_msg1">
<?php
    echo validation_errors();
?>
<form action="<?php echo base_url(); ?>admin/edit/<?php echo $record['user_id']; ?>" method="post" >
<table>
<tr>
    <td>Recovery Email:</td>
    <td><input type="text" name="recovery_email" id="recovery_email" value="<? echo $record['recovery_email']; ?>" /></td>
</tr>
<tr>
    <td>Username:</td>
    <td><input type="text" name="username" id="username" value="<? echo $record['username']; ?>" /></td>
</tr>
<tr>
    <td>Enter New Password:</td>
    <td><input type="text" name="new_password" id="new_password" value="<? echo $form_password; ?>" /></td>
</tr>
<tr>
    <td>Re-Password:</td>
    <td><input type="text" name="re_password" id="re_password" /></td>
</tr>
<tr>
    <td><input class="btn btn-primary" name="edit_submit" type="submit" value="Submit" /></td>
    
</tr>
</table>
</form>
</div>