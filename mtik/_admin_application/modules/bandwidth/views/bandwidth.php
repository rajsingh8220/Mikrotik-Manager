<span style="color: #0080C0; font-weight: bold;">Define Bandwidth to use in queue definition</span>
<div class="box">
<form method="post" action="<?php echo base_url(); ?>bandwidth/add">
    <table style="margin: 10px;">
        <tr>
            <td>Title:</td>
            <td><input type="text" value="" name="title" /></td>
        </tr>
        <tr>
            <td>Bandwidth:</td>
            <td><input type="text" value="" name="bandwidth" /></td>
        </tr>
        <tr>
            <td></td>
            <td><span style="position: relative; top: -8px;">e.g: 64k, 312k, 1M, 2M</span></td>
        </tr>
    </table>
    <input class="btn btn-primary" style="margin-left: 20px;" type="submit" value="Add" />
</form>
</div>
<?php
$sn=0;
        if($records!=''||$records!=null){
    ?>
                    
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                      <thead>
                    	  <tr>
                              <th>Sn</th>
                    		  <th>Title</th>
                    		  <th>Limit</th>
                              <th>Action</th>
                    	  </tr>
                      </thead>   
                      <tbody>
                        <?php
                        	
                        	foreach($records as $index=>$data_array){
                        	   $sn = $sn+1;
                        	   
                        ?>
                           <tr align="left" >
                               <td><?php echo $sn;?></td>
                               
                               <td><?php echo $data_array['title'];?></td>
                               <td><?php echo $data_array['limits'];?></td>
                                <td><a href="<?php echo base_url(); ?>bandwidth/delete/<?php echo $data_array['id']; ?>">Delete</a></td>
                               
                        
                               
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