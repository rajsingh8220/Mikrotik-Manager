<?php

/**
 * @author phpdesigner
 * @copyright 2013
 */

//$new_count = $_POST['new_count'];

?>
<script type="text/javascript">
	//$(document).ready(function(){
	   //var flag2 ='';
	    $('.nn').keyup(function(){
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
                            flag2 = 1;
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
                                flag2 = 0;
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
//	});
</script>
<input type="text" class="nn" id="<?php echo $new_count; ?>" name ="<?php echo $new_count; ?>" /><span id="validity_result<?php echo $new_count; ?>"></span><br />
