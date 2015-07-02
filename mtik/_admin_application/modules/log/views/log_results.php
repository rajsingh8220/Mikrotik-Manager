<?php

/**
 * @author phpdesigner
 * @copyright 2013
 */

echo "result log";
//print_r($records);
//echo "<br>";

?>
<?php

/**
 * @author phpdesigner
 * @copyright 2013
 */

//echo 'Logs';
//print_r($records);

?>

 <?php 
 $this->load->model('category/category_model');
 $sn=0;
        if($records!=''||$records!=null){
    ?>
                    
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                      <thead>
                    	  <tr>
                              <th>Sn</th>
                    		  <th>Table/Field</th>
                    		  <th>Field Old Value</th>
                              <th>Field New Value</th>
                              <th>Edited On</th>
                              <th>Edited By</th>
                              <th>Added On</th>
                              <th>Added By</th>
                              <th>Afected Category</th>
                    	  </tr>
                      </thead>   
                      <tbody>
                        <?php
                        	$notice_ids = array();
                        	foreach($records as $index=>$data_array){
                        	   $sn = $sn+1;
                        	  
                        ?>
                           <tr align="left" >
                           <td><?php echo $sn;?></td>
                               <td><?php echo $data_array['fieldname'];?></td>
                               <td><?php echo $data_array['field_old_value'];?></td>
                               <td><?php echo $data_array['field_new_value'];?></td>
                                <td><?php echo $data_array['edited_on'];?></td>
                                <td><?php echo $data_array['edited_by'];?></td>
                                <td><?php echo $data_array['added_on'];?></td>
                                <td><?php echo $data_array['added_by'];?></td>
                                <td><?php echo $data_array['category_name'];?></td>
                               
                        
                               
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
                    