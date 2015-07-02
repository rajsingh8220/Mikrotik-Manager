<?php
	$this->load->model('category/category_model');
    $cat = $this->category_model->get_category($record['category_id']);
?>
<form accept="" action="<?php echo base_url(); ?>home/edit_device_info_detail" method="post">
    <table>
        <input type="hidden" name="device_id" value="<?php echo $record['id']; ?>" />
        <tr>
            <td>IP Address:</td>
            <td><input type="text" value="<?php echo $record['ip_addr']; ?>" name="ip_address" /></td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text" value="<?php echo $record['username']; ?>" name="username" /></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="text" value="<?php echo $record['password']; ?>" name="password" /></td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <input type="hidden" name="category_id" value="<?php echo $record['category_id']; ?>" />
                <input type="text" value="<?php echo $cat['category_name']; ?>" disabled="true" />
            </td>
        </tr>
    </table>
    <div class="form-actions">
      <button type="submit" class="btn  btn-primary">Edit Device</button>
      <button type="reset" class="btn ">Cancel</button>
    </div>
</form>
