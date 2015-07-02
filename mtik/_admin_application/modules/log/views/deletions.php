<div id="delete">
            <?php 
            
            $sn3=0;
            if($records!=''||$records!=null){
            ?>
            
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
              <tr>
                  <th>Sn</th>
                  <th>Description</th>
                  
                  <th>Deleted On</th>
                  <th>Deleted By</th>
                  <th>Affected Category</th>
                  <th>Affected device</th>
                  <th>Affected Queue</th>
                  <th>Delete</th>
              </tr>
            </thead>   
            <tbody>
            <?php
            
            	foreach($records as $index=>$data_array2){
            	   $sn3 = $sn3+1;
            	  
            ?>
               <tr align="left" >
               <td><?php echo $sn3;?></td>
                <td><?php echo substr($data_array2['table_name'],0,17)."...";?></td>
                  
                    
                    <td><?php echo $data_array2['edited_on'];?></td>
                    <td><?php echo $data_array2['edited_by'];?></td>
                    <td style="color: #0080C0;"><?php echo $data_array2['category_name'];?></td>
                    <td><?php echo $data_array2['device_name'];?></td>
                     <td style="color: #0080C0;"><?php echo $data_array2['affected_queue'];?></td>
                     <td><a href="<?php echo base_url(); ?>log/detail/<?php echo $data_array2['log_id']; ?>" data-rel="tooltip"  data-original-title="<strong><?php echo $data_array2['table_name'];?></strong><br><strong>Affected Category: </strong><?php echo $data_array2['category_name'];?><br><strong>Deleted By:</strong> <?php echo $data_array2['edited_by'];?>" style="text-decoration: none; cursor: pointer;">Detail</a></td>
                   
            
                   
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