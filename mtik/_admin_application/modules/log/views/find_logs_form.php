<?php

/**
 * @author phpdesigner
 * @copyright 2013
 */



?>
<script type="text/javascript">
	$(document).ready(function(){
	   $('#datepicker').datetimepicker({
           	    dateFormat: "yy-mm-dd",
                showSecond: true,
                 timeFormat:'hh:mm:ss'
        	   
            	
            });
            $('#datepicker1').datetimepicker({
           	    dateFormat: "yy-mm-dd",
                showSecond: true,
                 timeFormat:'hh:mm:ss'
        	   
            	
            });
            $('#datepicker2').datetimepicker({
           	    dateFormat: "yy-mm-dd",
                showSecond: true,
                 timeFormat:'hh:mm:ss'
        	   
            	
            });
	});
</script>
<div>
    <form action="<?php echo base_url(); ?>log/find_logs" method="post">
        <table>
            <tr>
                <td>Category Name</td>
                <td><input type="text" name="category_name" placeholder="Category Name"  /></td>
            </tr>
            <tr>
                <td>Edited By/ Added By</td>
                <td><input type="text" name="username" placeholder="Admin Username"  /></td>
            </tr>
            <tr>
                <td>Edited On/ Added On</td>
                <td><input type="text" name="edited_date" id="datepicker" placeholder="YYYY-MM-DD"  /></td>
            </tr>
            <tr>
                <td>Search By Date</td>
                <td><input type="text" name="from_date" id="datepicker1" placeholder="YYYY-MM-DD"  />
                     - <input type="text" name="to_date" id="datepicker2" placeholder="YYYY-MM-DD"  />
                </td>
            </tr>
        </table>
        <div class="form-actions">
          <button type="submit" class="btn  btn-primary" name="submit">Find</button>
          <button type="reset" class="btn ">Cancel</button>
        </div>
    </form>
</div>