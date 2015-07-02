<style type="text/css">

</style>
<?php
	foreach($error as $e){
	   //print_r($e);
       if($e['error_code']=='1'){
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
                    echo '<br>Total Ips: '.$total_ips;
                    echo '<br>Upload Ips: '.$upload_limit;
                    echo '<br>Download Ips: '.$download_limit;
                    echo '<br>Target Addresses: ';
                    print_r($ips);
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
<?php  
       }
	}
?>
<div>
    <a class="btn btn-primary" href="<?php echo base_url(); ?>category/tree_view/<?php echo $cat_id ?>">List Queues in this category</a>
</div>