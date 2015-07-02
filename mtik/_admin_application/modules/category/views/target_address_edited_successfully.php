
<?php
    $flag =0;
	foreach($error as $e){
	   //print_r($e);
       if($e['error_code']=='1'){
        $flag = 1;
?>
            <div id="error_div" class="alert alert-error" style="">
                <strong>
                    <?php 
                        echo $e['msg'];
                    ?>
                </strong>
                <span >
                    <?php
                    echo '<br>'.$e['msg_detail']."<br>";
                    print_r($e['result']);
                    ?>
                </span>
            </div>
<?php 
       }
       else{
?>
            <div class="alert alert-success">
                <strong>
                    <?php 
                        echo $e['msg'];
                    ?>
                </strong>
                <span id="success_msg">
                    <?php
                    echo '<br>'.$e['msg_detail']."<br>";
                    print_r('Unique Id: '.$e['result']);
                    //echo "<hr>";
                    //echo '<br>Total Ips: '.$total_ips;
                    //echo '<br>Upload Ips: '.$upload_limit;
                    //echo '<br>Download Ips: '.$download_limit;
                    //echo '<br>Target Addresses: ';
                    //print_r($ips);
                    //$this->data['total_ips'] = $total_ips;
            //$this->data['upload_limit'] = $somedata['rx_max_limit'];
            //$this->data['download_limit'] = $somedata['tx_max_limit'];
            //$this->data['queue_name'] = $somedata['name'];
            //$this->data['ips'] = $ips;
            //$this->data['cat_id'] = $somedata['cat_id'];
            //$this->data['parent'] = $somedata['parent_queue_id'];
            //$this->data['all_ips'] = $exp;
                    ?>
                </span>
            </div>
            <span><h2>Please Wait.....</h2></span>
<?php  
       }
	}
    if($flag==1){
        
    }
    else{
    ?>
       <script type="text/javascript">
	       window.location.replace("<?php echo $redirect_url; ?>");
        </script> 
        <?php
    }
?>

<div class="alert" style="font-size: 14px;">
 <span><strong><u>Redirecting to the editing page</u></strong> </span> <br />
 <span class="counter" id="count" style="color: #0080C0; font-weight: bold;" ></span> seconds.<br />
 
 <span>Redirect page manually to edit the Queue, Click <strong> <a href="<?php echo $redirect_url; ?>" style="padding-left: 14px; padding-right: 14px;" class="btn btn-mini">Redirect</a></strong></span>
</div>
<script type="text/javascript">
   
    $(function(){
        var counter = 10;
        $('#count').html(counter);
       setInterval( function(){
            counter = counter-1;
            if(counter<0){
                window.location.replace("<?php echo $redirect_url; ?>");
            }
            else{
               $('#count').html(counter); 
            }
           
        }, 1000);  
    }); 
	
</script>
