<?php

/**
 * @author phpdesigner
 * @copyright 2013
 */

echo "Only Inforamtion Retrival Commands Supported Yet";

?>
<script type="text/javascript">
	$(document).ready(function(){
	   //alert("we");
       $("#terminal").keyup(function(e) {
        var command_string = $('#terminal').val();
            if(e.keyCode == 13) {
                 //alert(command_string);
                   $.ajax({
                        type:'POST',
                        url:"<?php echo base_url(); ?>terminal/command_execute/",
                        data:'command='+command_string,
                        success:function(msg){
                            $('#terminal_result').html(msg);
                            $('#command').html(command_string);
                            $('#terminal').val('');
                        },
                        beforeSend:function(mm){
                            $('#terminal_result').html("<span style='color:red;'>Please Wait...</span>");
                        }
                   })
            }
        }); 
      
	})
	   
	
</script>
<br />
<textarea id="terminal" name="terminal" style="width: 800px; height: 20px;"></textarea>
<br />
<span id="command" style="font-weight: bold;"></span>
<div id="terminal_result">

</div>