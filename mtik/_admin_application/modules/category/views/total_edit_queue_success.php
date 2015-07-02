<?php
	foreach($error as $e){
	   if($e['error_code']=='0'){
?>
<div class="alert-success">
    <div style="padding: 10px;">
        <?php
        
        //echo "success";
        //echo "New IPs:".$new_ips;
        //echo "Queue Name:".$name;
        //echo '<br>Parent:'.$parent;
        //echo "<br>Download/Upload:".$download_limit."/".$upload_limit;
        print_r($e['msg']);
        echo '<br>';
        print_r($e['msg_detail']);
       
        if($e['result']==null){
            
            
        }
        else{
            echo '<br>';
            print_r($e['result']); 
        }
        
        
        ?>
    </div>
</div>
<?php
    }
    else{
    ?>
        <div class="alert-error" style="margin-top: 10px;">
            <div style="padding: 10px;">
            <?php
                print_r($e['msg']);
                echo '<br>';
                print_r($e['msg_detail']);
                echo '<br>';
                print_r($e['result']);
            ?>
            </div>
        </div>
    <?php
    }
	}
?>