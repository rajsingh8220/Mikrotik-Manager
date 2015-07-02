<?php

/**
 * @author phpdesigner
 * @copyright 2013
 */

//echo "already scheduled";
//print_r($record);
?>
<div class="alert-error">
    <div style="padding: 10px;">
    <span style="font-size: 14px; font-variant: ; font-style: italic;"><u>Queue: <b>"<?php echo $record[0]['queue_name']; ?>"</b> is already Scheduled!!</u></span>
    <br />
    Orginal Bandwidth was(rx/tx):<strong><?php echo $record[0]['previous_upload_limit'].'/'.$record[0]['previous_download_limit']; ?></strong>
    <br />
    Upgrated Bandwidth is(rx/tx):<strong><?php echo $record[0]['scheduled_upload_limit'].'/'.$record[0]['scheduled_download_limit']; ?></strong>
    <br />
    End Date of This Schedule:<strong><?php echo $record[0]['end_time']; ?></strong>
    </div>
</div>
<a style="margin: 10px;" class="btn btn-primary">Edit Current Schedule for this client</a>