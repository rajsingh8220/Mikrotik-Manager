
 <?php 
 $this->load->model('category/category_model');
 $sn=0;
        if($records!=''||$records!=null){
    ?>
                    
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                      <thead>
                    	  <tr>
                              <th>Sn</th>
                    		  <th>IP Address</th>
                    		  <th>Username</th>
                    		  <th>Password</th>
                              <th>Category</th>
                              <th>Action</th>
                    	  </tr>
                      </thead>   
                      <tbody>
                        <?php
                        	$notice_ids = array();
                        	foreach($records as $index=>$data_array){
                        	   $sn = $sn+1;
                        	   if($data_array['password']==''){
                        	       $password = '<i style="color:gray;">Null</i>';
                        	   }
                               else{
                                    $password = $data_array['password'];
                               }
                               if($data_array['category_id']=='0'){
                                    $cat_title = '<i style="color:gray;">Not Defined!</i>';
                               }
                               else{
                                    $category = $this->category_model->get_category($data_array['category_id']);
                                   if($category){
                                        $cat_title = $category['title'];
                                        
                                   }
                                   else{
                                        $cat_title = '<i style="color:gray;">Not Defined!</i>';
                                   }
                               }
                               
                        ?>
                           <tr align="left" >
                               <td><?php echo $sn;?></td>
                               
                               <td><?php echo $data_array['ip_addr'];?></td>
                               <td><?php echo $data_array['username'];?></td>
                               
                               <td><?php echo $password;?></td>
                               <td><?php echo $cat_title;?></td>
                               <td><a  href="<? echo base_url() ?>home/edit_device/<?php echo $data_array['id'];?>" name="ids[]" >
				                Edit
                               </a></td>
                        
                               
                           </tr>
                         <?php      
                        	$sn++;	
                        	}
                        ?>
                           
                         </tbody>
                        </table>
                        <a class="btn btn-primary" href="<?php echo base_url(); ?>home/add_device">Add Device</a> 
                    
                    <?php
                            }
                            else
                           {
                              echo "No Notice Found!!";
                    ?>
                              <br/><a class="btn btn-primary" href="<?php echo base_url(); ?>home/add_device">Add Device</a>
                    <?php
                            }
                        ?>