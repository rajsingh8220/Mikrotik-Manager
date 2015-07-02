<?php
    
    //echo $queue_operation;
    $this->load->model('category/category_model');
	$queues = $this->category_model->get_queues($cat_id);
    //print_r($queues);
?>
<script type="text/javascript">
	$(document).ready(function(){
	       var scntDiv = $('#p_scents');
            var i = $('#p_scents b').size() + 1;
            var flag = 0;
            var flag1 = 0;
            var flag_name = 0;
        $('#addScnt').live('click', function() {
                $.ajax({
                   type:'POST',
                   url:'<?php echo base_url(); ?>category/ajax_field',
                   data:'count='+i,
                   success:function(msg){
                        $(msg).appendTo(scntDiv);
                        i++;
                        return false;
                   }
                });
                
        });
        
        $('#remScnt').live('click', function() { 
                if( i > 2 ) {
                        $(this).parents('b').remove();
                        i--;
                }
                return false;
        });
	   
        $('#SaveAccount').click(function(){
            var cat_id = $('#cat_id').val();
            var parent = $('#parent').val();
            var j=1;
            var ips='';
            var total_ips = i-1;
            alert('Total ips: '+total_ips)
            var name = $('#name').val();
            
            if(total_ips==1){
                var multiple_ips = 0;
                ips = $('#1').val();
                
            }
            else{
                var multiple_ips = 1;
                ips = $('#1').val();
                for(j=2; j<=total_ips; j++){
                $.ajax({
                    //submit ip and check whehter it is exist or not
                    type:'POST',
                    url:'<?php echo base_url(); ?>operation/check_ips',
                    data:'ip='+$('#'+j).val()+'&cat_id='+cat_id,
                    success: function(msg){
                        if(msg=='1'){
                            flag = 1;
                             $('#validity_result'+j).html(' <img src="<?php echo base_url(); ?>images/publish_x.png" /><span style="color:red;">Already Exist: </span>');
                        }
                        else{
                            flag = 0;
                        }
                        
                        
                    }
                })
                
                alert($('#'+j).val());
                }
            }
            var upload_limit = $('#upload_limit').val();
            var download_limit = $('#download_limit').val();
            if(flag==0&&name!=''&&flag_name==0&&flag1==0){
                ips = $('#1').val();
                 if(total_ips==1){
                    ips = $('#1').val();
                 }
                 else{
                    for(j=2; j<=total_ips; j++){
                        ips = ips+','+$('#'+j).val();
                        
                    }
                 }
                
                $.ajax({
                   url:'<?php echo base_url(); ?>operation/add_queue',
                   type:'POST',
                   data:'name='+name+'&count='+total_ips+'&upload_limit='+upload_limit+'&download_limit='+download_limit+'&ips='+ips+'&cat_id='+cat_id+'&parent='+parent+'&multiple_ips='+multiple_ips,
                   success:function(msg){
                        
                        $('#waiting').html('<span style="color:green;">'+msg+'</span>');
                       
                   },
                   beforeSend:function(mm){
                     $('#waiting').html('<br><br><center><span style="color:red;"><img src="<?php echo base_url(); ?>images/ajax-loader.gif" /><br><span style="color:#DD4814;">Please Wait for the Result!</span></span></center>');
                   }
                });  
            }
            else{
                
            }
            
        });
        
        
        
        
        
        $('.ppp1').keyup(function(){
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

<div>

<div id="waiting">
<div style="text-align: left; margin-left: 20px;">
<form id="SignupForm"  method="post">

<div id="inner_div_my" >

<center>
    <fieldset>
        <div class="field_inside">
            
            <label for="CompanyName"><strong>Queue Name</strong></label>
            <input  id="name" name="name" type="text"  /><span  id="queue_name_error"></span><br/>
            <span style="color: #DD4814; font-weight: ;"><strong>Queue Name:</strong> Spaces and Special Characters are not Allowed!</span>
            <label for="CompanyName"><strong>Target Address</strong></label>
            <a id="addScnt" style="position: relative; top: -5px; margin-right: 5px;" class="btn">+</a>
            
            <span id="p_scents">
                <b>
                    <span for="p_scnts"><input type="text" id="1" class="ppp ppp1" size="20" name="ip1" value="" placeholder="Input Value" /></span>
                    <span id="validity_result1"></span><br />
                </b> 
            </span>
            <div style="border-bottom: 1px solid #DDDDDD;"></div>
            
            <input type="hidden" value="<?php echo $cat_id; ?>" id="cat_id" />
            <span style="font-size: 14px;">Target Upload</span><span style="margin-left: 132px; font-size: 14px;">Target Download</span><br />
            <select id="upload_limit">
                <?php
                  
                 foreach($limits as $l){
                    //echo $result
                    ?>
                  <option value="<?php echo $l['limits'];?>" <?php echo ($l['limits']=='128k'?'selected':''); ?>><?php echo $l['title'];?></option>
                  <?php
                        }
                  ?>
            </select>
            <select id="download_limit">
                <?php
                  
                 foreach($limits as $l){
                    //echo $result
                    ?>
                  <option value="<?php echo $l['limits'];?>" <?php echo ($l['limits']=='128k'?'selected':''); ?>><?php echo $l['title'];?></option>
                  <?php
                        }
                  ?>
            </select>bits/s
            
      
            
            <label for="CompanyName"><strong>Parent</strong></label>
            <select id="parent">
                <option value="0" >Select Parent</option>
                <?php
	               foreach($queues as $q){
	                   
                ?>
                <option value="<?php echo $q['q_id']; ?>"><?php echo $q['name']; ?></option>
                <?php
	               }
                ?>
            </select>
        </div>
    </fieldset>
    
    <p>
        
        <div class="form-actions" style="text-align: left;">
            <button id="SaveAccount" type="button" class="btn btn-primary">Add Queue</button>
            
        </div>
    </p>
</center>
</div>
</form>
</div>
</div>




