<div id="add">
            <?php 
            
            $sn1=0;
            if($records!=''||$records!=null){
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
                   <th>Action</th>
              </tr>
            </thead>   
            <tbody>
            <?php
            
            	foreach($records as $index=>$data_array){
            	   $sn1 = $sn1+1;
            	  
            ?>
               <tr align="left" >
               <td><?php echo $sn1;?></td>
                <td><?php echo $data_array['table_name'];?></td>
                   
                   <td><?php echo $data_array['field_new_value'];?></td>
                    
                    <td><?php echo $data_array['added_on'];?></td>
                    <td><?php echo $data_array['added_by'];?></td>
                    <td style="color: #0080C0;"><?php echo $data_array['category_name'];?></td>
                    <td><?php echo $data_array['device_name'];?></td>
                    <td><a href="<?php echo base_url(); ?>log/detail/<?php echo $data_array['log_id']; ?>" style="text-decoration: none; cursor: pointer;"  data-rel="tooltip"  data-original-title="<strong><?php echo $data_array['table_name'];?></strong><br>Added:<?php echo $data_array['field_new_value'];?><br>Category:<?php echo $data_array['category_name'];?><br>Added By:<?php echo $data_array['added_by'];?><br>Added On:<?php echo $data_array['added_on'];?><br>Affected Device On:<?php echo $data_array['device_name'];?>">Detail</a></td>
                   
            
                   
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
   
  