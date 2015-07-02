<?php

/**
 * @author phpdesigner
 * @copyright 2013
 */

//echo 'cnfirm!!';
//echo $queue_name;
//$this->load->model('category/category_model');

?>

<center>
    <div class="box" style="width: 400px; margin-top: 70px;">
        <div style="padding: 10px;">
            <h4>Do You Really Want to Delete the Device: <span style="color: #DD4814;">"<?php echo $device_detail['ip_addr']; ?>"</span> ?</h4><br />
            <div class="box" style="width:360px;  background: #F3F3F5; text-align: left; padding: 7px; margin-top: -10px;">
               <span>Device Address : <strong><?php echo $device_detail['ip_addr']; ?></strong></span><br />
               <span>Username : <strong><?php echo $device_detail['username']; ?></strong></span><br />
               <span style="color: red;">This Device Belongs to the Category : <strong style="color: #0080C0;"><?php echo $cat_detail['title']; ?></strong></span>
            </div><br />
            <a href="<?php echo base_url(); ?>home/delete_device_detail/<?php echo $device_id; ?>/<?php echo $cat_id; ?>" style="width: 70px;" class="btn btn-primary">Yes</a>
            <a href="<?php echo base_url(); ?>category/actions/<?php echo $cat_id; ?>" style="width: 70px;" class="btn btn-primary">No</a>
        </div>
    </div>
</center>