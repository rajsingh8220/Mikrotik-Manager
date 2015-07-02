<?php

/**
 * @author phpdesigner
 * @copyright 2013
 */
$this->load->model('category/category_model');
//print_r($queues);

?>
<div>
 <?php 
 
 $sn=0;
        if($queues!=''||$queues!=null){
    ?>
                    
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    	  <tr>
                              <th>Sn</th>
                    		  <th>Queue Name</th>
                    		  <th>Target Address</th>
                    		 
                              <th>Rx Max Limit</th>
                              <th>Tx Max Limit</th>
                              <th>Parent</th>
                              <th>Actions</th>
                              <th></th>
                              <th></th>
                    	  </tr>
                      </thead>   
                      <tbody>
                        <?php
                        
                        	foreach($queues as $index=>$data_array){
                        	   $sn = $sn+1;
                               $parent_info = $this->category_model->get_queue_by_qid($data_array['parent_queue_id']);
                               //print_r($parent_info);
                               //print_r($parent_info.'<br>');
                               if($parent_info==null){
                                $parent_name = '<i style="color:gray;">Not Defined!</i>';
                               }
                               else{
                                $parent_name = $parent_info[0]['name'];
                               }
                        ?>
                           <tr align="left" >
                               <td><?php echo $sn;?></td>
                               
                               <td><?php echo $data_array['name'];?></td>
                               <td><?php echo $data_array['target_address'];?></td>
                              
                                
                               <td><?php echo $data_array['rx_max_limit'];?></td>
                               
                               <td><?php echo $data_array['tx_max_limit'];?></td>
                               <td><?php echo $parent_name;?></td>
                               <td><a href="<?php echo base_url(); ?>category/delete_queue/<?php echo $data_array['name']; ?>/<?php echo $data_array['cat_id']; ?>">Delete</a></td>
                                <td><a href="<?php echo base_url(); ?>category/edit_queue/<?php echo $data_array['name']; ?>/<?php echo $data_array['cat_id']; ?>">Bandwidth Update</a></td>
                                <td><a href="<?php echo base_url(); ?>category/admin_edit_queue/<?php echo $data_array['name']; ?>/<?php echo $data_array['cat_id']; ?>">Edit</a></td>
                        
                               
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