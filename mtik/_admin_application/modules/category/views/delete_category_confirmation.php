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
            <h4>Do You Really Want to Delete the Category: <span>"<?php echo $category_detail['title']; ?>"</span> ?</h4><br />
            <div class="box" style="width:360px;  background: #F3F3F5; text-align: left; padding: 7px; margin-top: -10px;">
                Click Yes to delete the category <span style="color:#DD4814; font-size: 12px;"><strong><u><?php echo $category_detail['title']; ?></u></strong></span>, 
                It will delete all the devices in this category<br />
                <span style="color:#0080C0; font-size: 12px;">Number of Devices in this Category: <strong><u><?php echo $count_device[0]['count']; ?></u></strong></span>
            </div><br />
            <a href="<?php echo base_url(); ?>category/delete_category_yes/<?php echo $category_detail['id']; ?>" style="width: 70px;" class="btn btn-primary">Yes</a>
            <a href="<?php echo base_url(); ?>category/delete_category_no/<?php echo $category_detail['id']; ?>" style="width: 70px;" class="btn btn-primary">No</a>
        </div>
    </div>
</center>