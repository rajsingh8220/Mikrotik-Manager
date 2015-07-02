<?php
$read_write = $this->session->userdata('read_write_blocked');
/**
 * @author phpdesigner
 * @copyright 2013
 */

//echo "Actions";

?>
<script type="text/javascript">
	$(document).ready(function(){
	   $('#check_connection').click(function(){
	       $('#result_con').append('<br />');
	       var i=0;
           var j=0;
           var devices_addr = new Array();
	       var total_devices = $('#total_devices').val();
           for(i=1; i<=total_devices; i++){
               $.ajax({
    	           type:'POST',
                   url:'<?php echo base_url(); ?>category/check_device_connection',
                   data:'device='+$('#ip_addr_'+i).val()+'&username='+$('#username_'+i).val()+'&password='+$('#password_'+i).val(),
                   success:function(msg){
                        $('#result_con').append('<span>'+msg+'</span><br>');
                   },
                   beforeSend:function(a){
                        //$('#result_con').html('Please Wait...');
                   }
    	      }); 
           }
                
	   });
       
       $('#close').click(function(){
                    //alert('dsf');
                    $('#device_detail').fadeOut();
                });
    //check connection and change background color
           
	      
	})
</script>
<div class="box" style="background: #F3F3F5;">
    
    <table style="margin-left: 5px; ">
        <tr>
            <td>Category Title:</td>
            <td><strong><?php echo $category['title']; ?></strong></td>
        </tr>
        <tr>
            <td>Category Description:</td>
            <td><strong><?php echo $category['description']; ?></strong></td>
        </tr>
        <tr>
            <td>Total Number of Devices:</td>
            <td><strong><?php print_r($total_devices[0]['count']); ?></strong></td>
        </tr>
    </table>
</div>
<h4>Mikrotik Devices</h4>
<div class="box">
    
    <div style="margin: 10px;">
    
    <?php 
     $sn=0;
        if($devices!=''||$devices!=null){
    ?>
                    
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                      <thead>
                    	  <tr>
                              <th>Sn</th>
                    		  <th>IP Address</th>
                    		  <th>Username</th>
                    		  <th>Password</th>
                              <th>Active</th>
                              <th>Action</th>
                              
                    	  </tr>
                      </thead>   
                      <tbody>
                        <?php
                        	//$notice_ids = array();
                        	foreach($devices as $index=>$data_array){
                        	   $sn = $sn+1;
                        	   if($data_array['password']==''){
                        	       $password = '';
                        	   }
                               else{
                                    $password = $data_array['password'];
                               }
                               
                               
                        ?>
                           <tr align="left" >
                               <td><?php echo $sn;?></td>
                               
                               <td><?php echo $data_array['ip_addr'];?>
                                <input type="hidden" id="ip_addr_<?php echo $sn; ?>" value="<?php echo $data_array['ip_addr'] ?>" />
                               </td>
                               <td><?php echo $data_array['username'];?></td>
                               <input type="hidden" id="username_<?php echo $sn ?>" value="<?php echo $data_array['username']; ?>" />
                               <td><?php if($password==''){echo '<i style="color:silver;">Null</i>';}else{echo $password;}?></td>
                               <input type="hidden" id="password_<?php echo $sn; ?>" value="<?php echo $password; ?>" />
                               <td>
                               <?php
                                    if($read_write=='0'){
                                    echo anchor('home/device_shuffle/'.$data_array['id'].'/'.$data_array['block_status'].'/'.$category['id'],$data_array['block_status']=='0'?'<img src="'.base_url().'images/tick.png">':'<img class="cross_img" src="'.base_url().'images/publish_x.png">');
                                    }
                                    else{
                                    echo anchor('admin/not_allowed/'.$data_array['id'].'/'.$data_array['block_status'],$data_array['block_status']=='0'?'<img src="'.base_url().'images/tick.png">':'<img class="cross_img" src="'.base_url().'images/publish_x.png">');    
                                    }
                               ?>
                               </td>
                               <td><a  href="<? echo base_url() ?>home/edit_device_detail/<?php echo $data_array['id'];?>" name="ids[]" >
				                Edit
                               </a>
                               &nbsp;&nbsp;&nbsp;<a  href="<? echo base_url() ?>home/delete_device_confirmation/<?php echo $data_array['id'];?>/<?php echo $category['id'];?>" name="ids[]" >
				                Delete
                               </a>
                               </td>
                               
                               
                           </tr>
                         <?php      
                        	
                        	}
                            //echo $sn;
                        ?>
                           
                         </tbody>
                        </table>
                      <a class="btn btn-primary" href="<?php echo base_url(); ?>home/add_device/<?php echo $category['id'];  ?>">Add Device</a> 
                      <a id="check_connection" class="btn btn-primary">Check Connection status of listed Device(s)</a>
                        <input type="hidden" value="<?php echo $sn; ?>" id="total_devices" />
                        
                    <?php
                            }
                            else
                           {
                              echo "No Notice Found!!";
                    ?>
                               <br/><a class="btn btn-primary" href="<?php echo base_url(); ?>home/add_device/<?php echo $category['id'];  ?>">Add Device</a>
                    <?php
                            }
                        ?>
                        <div class="box alert-success" style="display: none; padding: 10px;" id="device_detail"><a style="float: right;" id='close' class='btn'>Close</a><span id="detail_results"></span></div>
                        <div class="box" style="margin-top: 10px; padding-bottom: 10px; background: #FEF0BA; font-size: 13px; font-weight: bold; color: #0080C0;" id="result_con"></div>
                        
    </div>
</div>