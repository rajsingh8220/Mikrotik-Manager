<script type="text/javascript">
	$(document).ready(function(){
	   var flag2 = 0;
	   var total_ip_before_addition = parseInt($('#count_ip').val());
       var new_count = total_ip_before_addition;
       $('#add_addresses').click(function(){
        //alert('s');
            new_count = new_count+1;
            //alert(total_ip_before_addition);
            //total_ip_before_addition.............
            //ajax call to add new field to do ...
            $.ajax({
                type:'POST',
                url:'<?php echo base_url(); ?>category/ajax_edit_inputs',
                data:'new_count='+new_count,
                success:function(msg){
                    $('#result_inputs').append(msg);
                }
            });
            
            $('#new_count').val(new_count);
            
       });
      
       
       $('.aa').keyup(function(){
            //alert('d');
           var cat_id = $('#cat_id').val();
           var ip1=$('#1').val();
	       var ip=$(this).val();
           var id=$(this).attr('id');
           
           $.ajax({
                    //submit ip and check whehter it is exist or not
                    type:'POST',
                    url:'<?php echo base_url(); ?>operation/check_ips',
                    data:'ip='+ip+'&cat_id='+cat_id,
                    success: function(msg){
                        if(msg=='1'){
                            flag1 = 1;
                             $('#validity_result'+id).html(' <img src="<?php echo base_url(); ?>images/publish_x.png" /><span style="color:red;">Already Exist </span>');
                        }
                        else{
                           //ips = ips+','+$('#'+id).val();
                            
                            //ip = ip.replace( /\s/g, "") //remove spaces for checking
                            //var re = /^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/; //regex. check for digits and in
                                                                  //all 4 quadrants of the IP
                            //if (re.test(ip)) {
                                //split into units with dots "."
                                //var parts = ip.split(".");
                                //if the first unit/quadrant of the IP is zero
                                //if (parseInt(parseFloat(parts[0])) == 0) {
                                    //flag1 = 1;
                                    //$('#validity_result'+id).html(' <img src="<?php echo base_url(); ?>images/publish_x.png" /><span style="color:red;">Not Valid </span>');
                                //}
                                //if the fourth unit/quadrant of the IP is zero
                                //if (parseInt(parseFloat(parts[3])) == 0) {
                                    //flag1 = 1;
                                    //$('#validity_result'+id).html(' <img src="<?php echo base_url(); ?>images/publish_x.png" /><span style="color:red;">Not Valid </span>');
                               // }
                                //if any part is greater than 255
                                //for (var i=0; i<parts.length; i++) {
                                    //if (parseInt(parseFloat(parts[i])) > 255){
                                        //flag1 = 1;
                                        //$('#validity_result'+id).html(' <img src="<?php echo base_url(); ?>images/publish_x.png" /><span style="color:red;">Not Valid </span>');
                                    //}
                                //}
                                flag1 = 0;
                                $('#validity_result'+id).html('<img src="<?php echo base_url(); ?>images/tick.png" />');
                            //} else {
                                //flag1 = 1;
                                //$('#validity_result'+id).html(' <img src="<?php echo base_url(); ?>images/publish_x.png" /><span style="color:red;">Not Valid </span>');
                            }
                        //}
                        
                    }
                    ,
                    beforeSend: function(){
                        $('#validity_result'+id).html('Please Wait..');
                    }                    
                })
	   });
       
       $('#name').keyup(function(){
            var cat_id = $('#cat_id').val();
	       var name=$(this).val();
           $.ajax({
                    //submit ip and check whehter it is exist or not
                    type:'POST',
                    url:'<?php echo base_url(); ?>operation/check_name',
                    data:'name='+name+'&cat_id='+cat_id,
                    success: function(msg){
                        if(msg=='1'){
                            flag_name = 1;
                             $('#queue_name_error').html(' <img src="<?php echo base_url(); ?>images/publish_x.png" /><span style="color:red;">Already Exist </span>');
                        }
                        else{
                            //ips = ips+','+$('#'+id).val();
                            $('#queue_name_error').html('<img src="<?php echo base_url(); ?>images/tick.png" />');
                            flag_name = 0;
                        }
                        
                    },
                    beforeSend: function(){
                        $('#queue_name_error').html('Please Wait..');
                    }
                });
       });
       
       
	});
    function checkSubmit()
        {
            alert(flag2);            
        	if (flag1==1||flag2==1)
                {
                    return false;
                }
                else
                {
                    return true;
                }
        } 
</script>
<style type="text/css">
<!--
    fieldset { border:none; width:320px;}
    legend { font-size:15px; margin:0px; padding:0px 0px; color:#555555; font-weight:bold;}
    label { display:block; margin:0px 0 5px;}
    fieldset{
    width: 90%;
    text-align: left;
    
    }
    .prev { float:left;}
    .next { float:right;}
    #steps { list-style:none; width:100%; overflow:hidden; margin:0px; padding:0px; border: 1px solid #dddddd; border-top-left-radius:3px; border-top-right-radius:3px; width: 218px; background: #F3F3F5; border-left: none; border-bottom: none;}
    #steps li {font-size:18px; float:left; padding-left:10px; padding-right:10px; padding-top: 5px; color:#b0b1b3; background: #F3F3F5; border-left: 1px solid #dddddd;}
    #steps li span {font-size:13px; margin-top: -4px; color: #DD4814; display:block;}
    #steps li.current { color:#000; background: #DDDDDD;  }
    #makeWizard { background-color:#b0232a; color:#fff; padding:5px 10px; text-decoration:none; font-size:18px;}
    #makeWizard:hover { background-color:#000;}
    #inner_div_my{
    border: 1px solid #DDDDDD;
    border-radius:3px;
    }
    .field_inside{
        min-height: 300px;
    }
    b { padding:0 0 5px 0; }


    

-->
</style>
<?php
	//print_r($queue_detail);
    
     //print_r($limits);
     //echo $queue_detail['parent_queue_id'];
     
     
     
     //print_r($parent);
     //echo "<hr>";
     //print_r($queues);
?>
<div>
Edit for Head Queue
<div id="waiting">
<div style="text-align: left; margin-left: 20px;">
<form onsubmit="return checkSubmit();" id="SignupForm"  method="post" action="<?php echo base_url(); ?>category/admin_edit_queue_operation_for_head">

<div id="inner_div_my" >

<center>
    <fieldset>
        <div class="field_inside">
            
            <label for="CompanyName"><strong>Queue Name</strong></label>
            <input   type="text" name="name" id="name" value="<?php echo $queue_detail['name']; ?>"   /><span  id="queue_name_error"></span>
            <br />
            <span style="color: #DD4814; font-weight: ;"><strong>Queue Name:</strong> Spaces and Special Characters are not Allowed!</span>
            
            <label for="CompanyName"><strong>Target Address</strong></label>
            <?php
	               $total_ips = $queue_detail['target_address'];
                    $exp_ip = explode(',',$total_ips);
                    $count_ip = 0;
                    foreach($exp_ip as $ips){
                    $count_ip = $count_ip+1;
                    }
                    if($count_ip=='1'){
                    ?>
                    <input class="aa" type="text"  size="20" id="1" name="1" value="<?php echo $queue_detail['target_address']; ?>"  /><span id="validity_result1"></span>
                    <span style="position: relative; top: -3px;">    
                        <a href="<?php echo base_url(); ?>category/delete_ip_of_queue/<?php echo $queue_detail['q_id'] ?>/<?php echo $queue_detail['target_address']; ?>/<?php echo $cat_id; ?>" style="margin-left: 5px; cursor: pointer;"><img style="border: 1px solid silver;" src="<?php echo base_url(); ?>images/delete.png" title="Delete" /></a> 
                    </span>
                    
                    <?php
                    }
                    else{
                    for($i=0; $i<$count_ip; $i++){
                        
                        ?>
                            <input class="aa" type="text" id="<?php echo $i+1; ?>" size="20" name="<?php echo $i+1; ?>"  value="<?php echo $exp_ip[$i]; ?>"  /><span id="validity_result<?php echo $i+1; ?>"></span>
                            <span style="position: relative; top: -3px;">
                                <a href="<?php echo base_url(); ?>category/delete_ip_of_queue/<?php echo $queue_detail['q_id'] ?>/<?php echo $exp_ip[$i]; ?>/<?php echo $cat_id; ?>" style="margin-left: 5px; cursor: pointer;"><img style="border: 1px solid silver;" src="<?php echo base_url(); ?>images/delete.png" title="Delete" /></a> 
                            </span>
                            <?php
                            if($i==$count_ip-1){
                                
                            }
                            else{
                                
                            ?>
                            <br />
                        <?php
                            }
                    }
                    }
                    
            ?>
            
            </span>
            <input type="hidden" id="count_ip" name="previouse_total_count" value="<?php echo $count_ip; ?>" />
            <input type="hidden" name="previouse_ips" value="<?php echo $total_ips; ?>" />
            <input type="hidden" name="queue_id" value="<?php echo $queue_detail['q_id']; ?>" />
            <input type="hidden" name="new_count" id="new_count" value="" />
            <a style="position: relative; top: -3px;" id="add_addresses" class="btn "><strong>+</strong></a>
            <br /><span id="result_inputs"></span>
            <br />        
            
            <input type="hidden" value="<?php echo $cat_id; ?>" id="cat_id" name="cat_id" />
            <span style="font-size: 14px;">Target Upload</span><span style="margin-left: 132px; font-size: 14px;">Target Download</span><br />
            <select name="upload_limit" >
                <?php
                  
                 foreach($limits as $l){
                    //echo $result
                    ?>
                  <option value="<?php echo $l['limits'];?>" <?php echo ($queue_detail['rx_max_limit']==$l['limits']?'selected':''); ?>><?php echo $l['title'];?></option>
                  <?php
                        }
                  ?>
            </select>
            <select name="download_limit" >
                <?php
                  
                 foreach($limits as $l){
                    //echo $result
                    ?>
                  <option value="<?php echo $l['limits'];?>" <?php echo ($queue_detail['tx_max_limit']==$l['limits']?'selected':''); ?>><?php echo $l['title'];?></option>
                  <?php
                        }
                  ?>
            </select>bits/s
            
      
            
            <label for="CompanyName"><strong>Parent</strong></label>
            <select id="parent" name="parent" >
                
                <?php
                if($queue_detail['parent_queue_id']=='0'){
                    ?>
                    <option value="0" selected="" >Select Parent</option>   
                    <?php
                    foreach($queues as $q11){
                ?>
                     <option value="<?php echo $q11['name'];?>" ><?php echo $q11['name'];?></option>   
                <?php 
                    }
                }
                else{
                    $parent = $this->category_model->get_queue_by_qid($queue_detail['parent_queue_id']);
               ?>
               <option value="0">Select Parent</option>
               <?php
	               foreach($queues as $q){
	                   
                ?>
                <option value="<?php echo $q['name'];?>" <?php echo ($parent[0]['name']==$q['name']?'selected':'true'); ?>><?php echo $q['name'];?></option>
                <?php
	               }
                    }
                ?>
            </select>
        </div>
    </fieldset>
    
    <p>
        
        <div class="form-actions" style="text-align: left;">
            <button  type="submit" class="btn btn-primary">Edit Queue</button>
            
        </div>
    </p>
</center>
</div>
</form>
</div>
</div>