<script type="text/javascript">
	$(document).ready(function(){
	   $('.ppp').keyup(function(){
	       //alert('fdf');
           var cat_id = $('#cat_id').val();
           //alert(cat_id);
           var ip1=$('#1').val();
           //alert('first:'+ip1);
	       var ip=$(this).val();
           var id=$(this).attr('id');
           //$('#validity_result'+id).html(ip);
           $.ajax({
                    //submit ip and check whehter it is exist or not
                    type:'POST',
                    url:'<?php echo base_url(); ?>operation/check_ips',
                    data:'ip='+ip+'&cat_id='+cat_id,
                    success: function(msg){
                        //alert(msg);
                        if(msg=='1'){
                            //alert('already Exist');
                            //total_ips = total_ips-1;
                            flag = 1;
                             //$('#validity_result'+id).html('<span style="color:red;">Already Exist: </span>'+ip);
                             $('#validity_result'+id).html(' <img src="<?php echo base_url(); ?>images/publish_x.png" /><span style="color:red;">Already Exist </span>');
                             
                        }
                        else{
                            //ips = ips+','+$('#'+id).val();
                            
                           // ip = ip.replace( /\s/g, "") //remove spaces for checking
                           // var re = /^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/; //regex. check for digits and in
                                flag1 = 0;
                                $('#validity_result'+id).html('<img src="<?php echo base_url(); ?>images/tick.png" />');                                  //all 4 quadrants of the IP
                           // if (re.test(ip)) {
                                //split into units with dots "."
                               // var parts = ip.split(".");
                                //if the first unit/quadrant of the IP is zero
                               // if (parseInt(parseFloat(parts[0])) == 0) {
                                  //  flag = 1;
                                  //  $('#validity_result'+id).html(' <img src="<?php echo base_url(); ?>images/publish_x.png" /><span style="color:red;">Not Valid </span>');
                                //}
                                //if the fourth unit/quadrant of the IP is zero
                               // if (parseInt(parseFloat(parts[3])) == 0) {
                                    //flag = 1;
                                    //$('#validity_result'+id).html(' <img src="<?php echo base_url(); ?>images/publish_x.png" /><span style="color:red;">Not Valid </span>');
                                //}
                                //if any part is greater than 255
                               // for (var i=0; i<parts.length; i++) {
                                    //if (parseInt(parseFloat(parts[i])) > 255){
                                       // flag = 1;
                                        //$('#validity_result'+id).html(' <img src="<?php echo base_url(); ?>images/publish_x.png" /><span style="color:red;">Not Valid </span>');
                                 //   }
                               // }
                               // flag = 0;
                               // $('#validity_result'+id).html('<img src="<?php echo base_url(); ?>images/tick.png" />');
                           // } else {
                                //flag = 1;
                                //$('#validity_result'+id).html(' <img src="<?php echo base_url(); ?>images/publish_x.png" /><span style="color:red;">Not Valid </span>');
                            //}
                            
                        }
                        
                    },
                    beforeSend: function(){
                        $('#validity_result'+id).html('Please Wait..');
                    }
                })
	   });
	})
</script>

<b>
    <span for="p_scnts">
        <a class="btn" href="#" id="remScnt" style="margin-right:10px; position:relative; top:-4px;">-</a>
        <input type="text" id="<?php echo $count; ?>"  size="20" class="ppp" name="ip<?php echo $count; ?>" value="" placeholder="Input Value" />
    </span> 
    
    <span id="validity_result<?php echo $count; ?>"></span><br />
</b>