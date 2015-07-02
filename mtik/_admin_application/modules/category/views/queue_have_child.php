<?php

/**
 * @author phpdesigner
 * @copyright 2013
 */

echo '';

?>
<center>
    <div class="box" style="width: 400px; margin-top: 70px;">
        <div style="padding: 10px;"><span style="font-size: 13px; color:#0080C0;"><strong>Parent of other Queue</strong></span>
            <div class="box" style="width:360px;  background: #F3F3F5; text-align:; padding: 7px;">
                <strong>This queue is parent of other Queue, so please delete child first</strong><br />
            <a href="<?php echo base_url(); ?>category/actions/<?php echo $cat_id; ?>" style="width: 140px; margin-top: 10px;" class="btn btn-primary">Back to Category</a>
        </div>
    </div>
</center>