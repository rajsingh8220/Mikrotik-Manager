
<form accept="" action="<?php echo base_url(); ?>home/edit_device_info" method="post">
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
            <td>Category:</td>
            <td>
                <select name="category_id">
                    <option value="0">Select Category</option>
                    <?php 
                        foreach($categories as $cat){
                            //echo '<option value ="'.$cat['id'].'">'.$cat['title'].'</option>';
                    ?>
                            <option value="<?php echo $cat['id'];?>" <?php if($cat['id']==$record['category_id']){ echo 'selected';}?> <?php echo set_select('id',$cat['id']); ?>><?php echo $cat['title'];?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <div class="form-actions">
      <button type="submit" class="btn  btn-primary">Edit Device</button>
      <button type="reset" class="btn ">Cancel</button>
    </div>
</form>
