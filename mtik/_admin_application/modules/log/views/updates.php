<div id="edit">
            <?php 
            
            $sn2=0;
            if($records!=''||$records!=null){
            ?>
            
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
              <tr>
                  <th>Sn</th>
                  <th>Description</th>
 	             <!--
<th>Field</th>
-->
                  <th>Edited On</th>
                  <th>Edited By</th>
                  <th>Affected Category</th>
                  <th>Affected device</th>
                  <th>Affected Queue</th>
                  <th>Action</th>
              </tr>
            </thead>   
            <tbody>
            <?php
            
            	foreach($records as $index=>$data_array1){
            	   $sn2 = $sn2+1;
            	  
            ?>
               <tr align="left" >
               <td><?php echo $sn2;?></td>
                <td><?php echo substr($data_array1['table_name'],0,16)."...";?></td>
                  <!--
 <td><?php echo $data_array1['fieldname'];?></td>
-->
                  <!--
 <td><?php echo $data_array1['field_old_value'];?></td>
                   <td><?php echo $data_array1['field_new_value'];?></td>
-->
                    
                    <td><?php echo $data_array1['edited_on'];?></td>
                    <td><?php echo $data_array1['edited_by'];?></td>
                    <td style="color: #0080C0;"><?php echo $data_array1['category_name'];?></td>
                    <td><?php echo $data_array1['device_name'];?></td>
                    <td style="color: #0080C0;"><?php echo $data_array1['affected_queue'];?></td>
                    <td><a data-rel="tooltip"  data-original-title="<strong><?php echo $data_array1['table_name'];?></strong><br><strong>Old Value: </strong><?php echo $data_array1['field_old_value'];?><br><strong>New Value: </strong><?php echo $data_array1['field_new_value'];?><br><strong>Category: </strong><?php echo $data_array1['category_name'];?><br><strong>Edited By:</strong> <?php echo $data_array1['edited_by'];?>" href="<?php echo base_url(); ?>log/detail/<?php echo $data_array1['log_id']; ?>" style="text-decoration: none; cursor: pointer;">Detail</a></td>
                   
            
                   
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