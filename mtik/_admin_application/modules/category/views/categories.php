
 <?php 
 $read_write = $this->session->userdata('read_write_blocked');
 $this->load->model('category/category_model');
 $sn=0;
        if($records!=''||$records!=null){
    ?>
                    
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                      <thead>
                    	  <tr>
                              <th>Sn</th>
                    		  <th>Title</th>
                    		  <th>Category Name</th>
                    		 <!--
                             <th>Description</th>
                            -->
                              <th>No. of Devices</th>
                              <th>Action</th>
                    	  </tr>
                      </thead>   
                      <tbody>
                        <?php
                        	$notice_ids = array();
                        	foreach($records as $index=>$data_array){
                        	   $sn = $sn+1;
                        	   if($data_array['description']==''){
                        	       $description = '<i>Null</i>';
                        	   }
                               else{
                                    $description = $data_array['description'];
                               }
                               $count_device = $this->category_model->get_count_no_of_devices_by_category($data_array['id']);
                        ?>
                           <tr align="left" >
                               <td><?php echo $sn;?></td>
                               
                               <td><?php echo $data_array['title'];?></td>
                               <td><?php echo $data_array['category_name'];?></td>
                               <!--
                                <td><?php echo $description;?></td>
                                -->
                                <td><?php echo $count_device[0]['count'];?></td>
                               <td><a  href="<? echo base_url() ?>category/edit_category/<?php echo $data_array['id'];?>" name="ids[]" >
				                Edit
                               </a>
                               &nbsp;<span style="color:silver;">|</span>&nbsp;
                               <a href="<?php echo base_url(); ?>category/delete_category/<?php echo $data_array['id']; ?>">Delete</a>
                               
                               &nbsp;<span style="color:silver;">|</span>&nbsp;<a  href="<?php echo base_url() ?>category/actions/<?php echo $data_array['id'];?>" name="ids[]" >
				                Detail / Actions
                               </a>
                               </td>
                        
                               
                           </tr>
                         <?php      
                        	
                        	}
                        ?>
                        <!--
<tr>
                            <td><a class="btn btn-primary" href="<?php echo base_url(); ?>category/add_category">Add Category</a> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
-->
                          
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
                            if($read_write=='0'){
                        ?>
                         <a class="btn btn-primary" href="<?php echo base_url(); ?>category/add_category">Add Category</a> 
                    <?php
	                       }
                           else{
                    ?>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/not_allowed">Add Category</a>
                    <?php
                           }
?>