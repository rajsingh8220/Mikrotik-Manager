<style type="text/css">
<!--
	table{
	   font-size: 11px;
	}
    table td{
        font-size: 11px;
    }
    table tr{
        font-size: 11px;
    }
    th{
        font-size: 11px;
    }
-->
</style>

 <script>
$(function() {
$( "#tabs" ).tabs();
});
</script>

<div id="tabs">
<ul>
    <li><a href="#add">Add Log</a></li>
    <li><a href="#edit">Edit Log</a></li>
    <li><a href="#delete">Delete Log</a></li>
</ul>
    <div id="add">
            <?php 
            
            $sn1=0;
            if($add_log!=''||$add_log!=null){
            ?>
            
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
              <tr>
                  <th>Sn</th>
                  <th>Description</th>
                  <th>Added Value</th>
                  <th>Added On</th>
                  <th>Added By</th>
                  <th>Affected Category</th>
                  <th>Affected device</th>
              </tr>
            </thead>   
            <tbody>
            <?php
            
            	foreach($add_log as $index=>$data_array){
            	   $sn1 = $sn1+1;
            	  
            ?>
               <tr align="left" >
               <td><?php echo $sn1;?></td>
                <td><?php echo $data_array['table_name'];?></td>
                   
                   <td><?php echo $data_array['field_new_value'];?></td>
                    
                    <td><?php echo $data_array['added_on'];?></td>
                    <td><?php echo $data_array['added_by'];?></td>
                    <td><?php echo $data_array['category_name'];?></td>
                    <td><?php echo $data_array['device_name'];?></td>
                   
            
                   
               </tr>
             <?php      
            	
            	}
            ?>
            
              
             </tbody>
             
            </table>
            
            
            <?php
                }
                else
               {
                  echo "No Record Found!!";
            ?>
                  
            <?php
                }
            ?>
    </div>
    
    <div id="edit">
            <?php 
            
            $sn2=0;
            if($edit_log!=''||$edit_log!=null){
            ?>
            
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
              <tr>
                  <th>Sn</th>
                  <th>Description</th>
 	             
<th>Field</th>

                  <th>Edited On</th>
                  <th>Edited By</th>
                  <th>Affected Category</th>
                  <th>Affected device</th>
                  <th>Affected Queue</th>
                  
              </tr>
            </thead>   
            <tbody>
            <?php
            
            	foreach($edit_log as $index=>$data_array1){
            	   $sn2 = $sn2+1;
            	  
            ?>
               <tr align="left" >
               <td><?php echo $sn2;?></td>
                <td><?php echo$data_array1['table_name'];?></td>
                
 <td><?php echo $data_array1['fieldname'];?></td>

                  <!--
 <td><?php echo $data_array1['field_old_value'];?></td>
                   <td><?php echo $data_array1['field_new_value'];?></td>
-->
                    
                    <td><?php echo $data_array1['edited_on'];?></td>
                    <td><?php echo $data_array1['edited_by'];?></td>
                    <td ><?php echo $data_array1['category_name'];?></td>
                    <td><?php echo $data_array1['device_name'];?></td>
                    <td ><?php echo $data_array1['affected_queue'];?></td>
                   
                   
            
                   
               </tr>
             <?php      
            	
            	}
            ?>
            
              
             </tbody>
             
            </table>
            
            
            <?php
                }
                else
               {
                  echo "No Record Found!!";
            ?>
                  
            <?php
                }
            ?>
    </div>
    
    <div id="delete">
            <?php 
            
            $sn3=0;
            if($delete_log!=''||$delete_log!=null){
            ?>
            
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
              <tr>
                  <th>Sn</th>
                  <th>Description</th>
                  <th>Deleted value</th>
                  <th>Deleted On</th>
                  <th>Deleted By</th>
                  <th>Affected Category</th>
                  <th>Affected device</th>
              </tr>
            </thead>   
            <tbody>
            <?php
            
            	foreach($delete_log as $index=>$data_array2){
            	   $sn3 = $sn3+1;
            	  
            ?>
               <tr align="left" >
               <td><?php echo $sn3;?></td>
                <td><?php echo $data_array2['table_name'];?></td>
                   <td><?php echo $data_array2['field_old_value'];?></td>
                    
                    <td><?php echo $data_array2['edited_on'];?></td>
                    <td><?php echo $data_array2['edited_by'];?></td>
                    <td><?php echo $data_array2['category_name'];?></td>
                    <td><?php echo $data_array2['device_name'];?></td>
                   
            
                   
               </tr>
             <?php      
            	
            	}
            ?>
            
              
             </tbody>
             
            </table>
            
            
            <?php
                }
                else
               {
                  echo "No Record Found!!";
            ?>
                  
            <?php
                }
            ?>
    </div>
    </div>
 
                    