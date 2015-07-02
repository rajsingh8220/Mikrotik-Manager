<?php

/**
 * @author phpdesigner
 * @copyright 2013
 */

//echo 'cnfirm!!';
//echo $queue_name;
?>
<center>
    <div class="box" style="width: 400px; margin-top: 70px;">
        <div style="padding: 10px;">
            <h4>Do You Really Want to Delete the Queue: <span>"<?php echo $queue_name; ?>"</span> ?</h4><br />
            <div class="box" style="width:360px;  background: #F3F3F5; text-align: left; padding: 7px; margin-top: -10px;">
                Click Yes to delete the queue <span style="color:#DD4814; font-size: 12px;"><strong><u><?php echo $queue_name ?></u></strong></span>, It will delete the selected queue from all 
                connectd devices in <span style="color:#0080C0; font-size: 12px;"><strong><u><?php echo $category_title; ?></u></strong></span> category
            </div><br />
            <a href="<?php echo base_url(); ?>category/delete_queue_yes/<?php echo $cat_id; ?>/<?php echo $queue_name; ?>" style="width: 70px;" class="btn btn-primary">Yes</a>
            <a href="<?php echo base_url(); ?>category/delete_queue_no/<?php echo $cat_id; ?>" style="width: 70px;" class="btn btn-primary">No</a>
        </div>
    </div>
</center>