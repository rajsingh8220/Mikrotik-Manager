<div id="add">
            <?php 
            
            $sn1=0;
            if($records!=''||$records!=null){
            ?>
            
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
              <tr>
                  <th>Sn</th>
                  <th>Started at</th>
                  <th>End Date</th>
                  <th>Orginal Bandwidth</th>
                  <th>Ugrated Bandwidth</th>
                  <th>Client</th>
                  <th>Affected Category</th>
                   <th>Status</th>
              </tr>
            </thead>   
            <tbody>
            <?php
            
            	foreach($records as $index=>$data_array){
            	   $sn1 = $sn1+1;
            	  
            ?>
               <tr align="left" >
               <td><?php echo $sn1;?></td>
                <td><?php echo $data_array['start_time'];?></td>
                   
                   <td><?php echo $data_array['end_time'];?></td>
                    
                    <td><?php echo $data_array['previous_bandwidth'];?></td>
                    <td><?php echo $data_array['new_bandwidth'];?></td>
                    <td style="color: #0080C0;"><?php echo $data_array['queue_name'];?></td>
                    <td><?php echo $data_array['cat_id'];?></td>
                    <td><?php echo $data_array['status'];?></td>
                   
            
                   
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
   
  