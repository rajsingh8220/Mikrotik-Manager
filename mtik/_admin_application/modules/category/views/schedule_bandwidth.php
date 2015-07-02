<?php

/**
 * @author phpdesigner
 * @copyright 2013
 */
date_default_timezone_set('GMT');
   $hour =date('h')+5; 
   $minut = date('i')+45;
   if($minut==60){
      $hour=$hour+1;
     $minut =0;
   }
   else if($minut>60){
      $hour=$hour+1;
      $minut =$minut-60;
   }
   if($hour==24){
    $hour = 0;
   }
   else if($hour>=24){
    $hour = $hour-24;
   }
   $second = date('s');
   $time = $hour.":".$minut.":".$second;
   $date = date('Y-m-d')." ".$time;

//echo "schedule bandwidth";
//echo $cat_id;
//echo "<br>";
///print_r($queue_detail);
?>
<script type="text/javascript">

	$(document).ready(function(){
	   
	   
       $('#date2').datetimepicker({
	       dateFormat: "yy-mm-dd",
    	   showSecond: false,
           showMinute:true,
    	   timeFormat: 'hh:mm:00'
	   });
	});
    function check_date(){
        var date_end = document.getElementById('date2').value;
        //alert(date_end);
        if(date_end==''){
            alert("Please Enter the end date of the new bandwidth update")
            return false;
        }
        else{
            return true;
        }
    }
</script>
<div>
    <form method="post" action="<?php echo base_url(); ?>category/bandwidth_scheduling_process/<?php echo $cat_id; ?>/<?php echo $queue_detail['q_id']; ?>" onsubmit="return check_date();">
        <table>
            <tr>
                <td><strong>Queue Name:</strong></td>
                <td><?php echo $queue_detail['name']; ?></td>
            </tr>
            <tr>
                <td><strong>Current Bandwidth:</strong></td>
                <td>
                    Upload:<?php echo $queue_detail['rx_max_limit']; ?><br />
                    Download:<?php echo $queue_detail['tx_max_limit']; ?>
                </td>
                
            </tr>
            <tr>
                <td><strong>New Bandwidth</strong></td>
                
                
            </tr>
            <tr>
                <td>
                    Target Upload:<br />
                    <select id="upload_limit" name="upload_limit">
                    <option>Select</option>
                        <?php
                          
                         foreach($limits as $l){
                            //echo $result
                            ?>
                          <option value="<?php echo $l['limits'];?>" <?php echo ($l['limits']=='0k'?'selected':''); ?>><?php echo $l['title'];?></option>
                          <?php
                                }
                          ?>
                    </select>
                </td>
                <td>Target Download:<br />
                    <select id="download_limit" name="download_limit">
                    <option>Select</option>
                        <?php
                          
                         foreach($limits as $l){
                            //echo $result
                            ?>
                          <option value="<?php echo $l['limits'];?>" <?php echo ($l['limits']=='0k'?'selected':''); ?>><?php echo $l['title'];?></option>
                          <?php
                                }
                          ?>
                    </select>bits/s
                </td>
               
            </tr>
            <tr>
                <td><strong>Timestamp</strong></td>
                
                
            </tr>
            <tr>
                <td>Start Date-Time:<br /><input value="<?php echo $date; ?>" type="text" disabled="true" /><input type="hidden" name="start_time" value="<?php echo $date; ?>"  /></td>
                <td>End Date-Time:<br /><input name="end_time" id="date2" type="text" /></td>
               
            </tr>
            <tr><td>Comment</td></tr>
            <tr>
                
                <td><textarea name="comment"></textarea></td>
            </tr>
        </table>
    <input type="submit" value="Submit" class="btn btn-primary" />
    </form>

</div>