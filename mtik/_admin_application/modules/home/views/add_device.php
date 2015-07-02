<?php
	echo validation_errors();
    
?>
<form  action="<?php echo base_url(); ?>home/add_device_info" method="post">
    <table>
        <tr>
            <td>IP Address:</td>
            <td><input type="text"  name="ip_address" value="<?php echo set_value('ip_address'); ?>" /></td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text"  name="username" value="<?php echo set_value('username'); ?>" /></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="text"  name="password" value="<?php echo set_value('password');?>" /></td>
        </tr>
        <tr>
            <td>Category:</td>
            <td>
                <input type="hidden" name="category_id" value="<?php echo $category_detail['id']; ?>" />
                <input type="text" value="<?php echo $category_detail['category_name']; ?>" disabled="true" />
            </td>
        </tr>
    </table>
    <div class="form-actions">
      <button type="submit" class="btn  btn-primary">Add Device</button>
      <a href="<?php echo base_url(); ?>category/actions/<?php echo $category_detail['id'];?>" type="reset" class="btn ">Cancel</a>
    </div>
</form>
