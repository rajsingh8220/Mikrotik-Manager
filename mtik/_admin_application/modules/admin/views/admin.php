<?php
$read_write = $this->session->userdata('read_write_blocked');
    if($this->uri->segment(5)){
        $paging = '/'.$this->uri->segment(5);
    }else{
        $paging = '';
    }
            $sn =1;
            if($this->uri->segment(5)){
                $sn = $sn+(int)$this->uri->segment(5);
            }
?>
<style type="text/css">
<!--
	.table th a{
	   text-decoration: none;
       color: black;
	}
    .cross_img{
        height: 19px;
        width: 19px;
        
    }
    .edit_img{
        height: 19px;
        width: 19px;
    }
-->
</style>
<h3>Admin Users</h3>
<div class="new_msg1">

<?php
	if($records){
 ?>
<form method="post" action="<?php echo base_url();?>admin/get_delete_data">
<table class="table table-striped table-bordered bootstrap-datatable datatable" >
 <thead>
		<tr align="left"><th>Sn</th><?php foreach($fields as $field_name => $field_display): ?>
			<th <?php $unique_id = $this->uri->segment(3);if ($sort_by == $field_name) echo "class=\"sort_$sort_order\"" ?> align="left">
				<?php echo anchor("admin/index/$field_name/" .
					(($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc').$paging ,
					$field_display); ?>
			</th>
            
			<?php endforeach; ?><th>Action</th></tr>
             
</thead>
 <tbody>
<?php
	
	foreach($records as $index=>$data_array){
	
	
?>

   <tr align="left" >
       <td><?php echo $sn;?></td>
       <td><input type="checkbox" name="ids[]" value="<?php echo $data_array['user_id'];?>" /></td>
       <td><?php echo $data_array['username'];?></td>
       <td><?php
            if($read_write=='0'){
            echo anchor('admin/shuffle/'.$data_array['user_id'].'/'.$data_array['blocked'],$data_array['blocked']=='0'?'<img src="'.base_url().'images/tick.png">':'<img class="cross_img" src="'.base_url().'images/publish_x.png">');
            }
            else{
            echo anchor('admin/not_allowed/'.$data_array['user_id'].'/'.$data_array['blocked'],$data_array['blocked']=='0'?'<img src="'.base_url().'images/tick.png">':'<img class="cross_img" src="'.base_url().'images/publish_x.png">');    
            }
       ?>
       </td>
       <td><?php
            if($read_write=='0'){
            echo anchor('admin/shuffle_read_write/'.$data_array['user_id'].'/'.$data_array['read_write_blocked'],$data_array['read_write_blocked']=='0'?'<img src="'.base_url().'images/tick.png">':'<img class="cross_img" src="'.base_url().'images/publish_x.png">');
            }
            else{
            echo anchor('admin/not_allowed/'.$data_array['user_id'].'/'.$data_array['read_write_blocked'],$data_array['read_write_blocked']=='0'?'<img src="'.base_url().'images/tick.png">':'<img class="cross_img" src="'.base_url().'images/publish_x.png">');    
            }
        ?>
        </td>
        <td><?php
            if($read_write=='0'){
            echo anchor('admin/shuffle_queue/'.$data_array['user_id'].'/'.$data_array['allow_queue_add'],$data_array['allow_queue_add']=='0'?'<img src="'.base_url().'images/tick.png">':'<img class="cross_img" src="'.base_url().'images/publish_x.png">');
            }
            else{
            echo anchor('admin/not_allowed/'.$data_array['user_id'].'/'.$data_array['allow_queue_add'],$data_array['allow_queue_add']=='0'?'<img src="'.base_url().'images/tick.png">':'<img class="cross_img" src="'.base_url().'images/publish_x.png">');    
            }
        ?>
        </td>
       <td><?php
            if($read_write=='0'){
            echo anchor('admin/shuffle_queue_edit/'.$data_array['user_id'].'/'.$data_array['allow_queue_edit'],$data_array['allow_queue_edit']=='0'?'<img src="'.base_url().'images/tick.png">':'<img class="cross_img" src="'.base_url().'images/publish_x.png">');
            }
            else{
            echo anchor('admin/not_allowed/'.$data_array['user_id'].'/'.$data_array['allow_queue_edit'],$data_array['allow_queue_edit']=='0'?'<img src="'.base_url().'images/tick.png">':'<img class="cross_img" src="'.base_url().'images/publish_x.png">');    
            }
        ?>
        </td>
       <td><?php 
            if($read_write=='0'){
            echo anchor('admin/edit_admin/'.$data_array['user_id'],'<img class="edit_img" src="'.base_url().'images/edit.jpg">');
            }
            else{
            echo anchor('admin/not_allowed/'.$data_array['user_id'],'<img class="edit_img" src="'.base_url().'images/edit.jpg">');    
            }
       ?> </td>
   </tr>
   
 <?php      
	$sn++;	
	}
?>
   </tbody>
</table>
    <?php
    if($read_write=='0'){
    
    
    ?>
   <input type="hidden" name="return_url" value="<?php echo common::full_url();?>" /></td><td colspan="7"><input class="btn btn-primary" type="submit" name="submit" value="Delete Selected" />
    <?php
    }
    else{
    ?>
    <a class="btn btn-primary" href="<?php echo base_url();?>admin/not_allowed">Delete Selected</a>
    
    <?php
    }
?>
    

</form>
<?
            }
            else{
                echo "No Records";
            }
    ?> 

</div>
<div class="box" style="width: 700px; float: right; background: #F3F3F5; font-size: 10px;">
    <div style="">
        <span style="float: left; padding: 10px; margin-left: 10px; border-right: 1px solid silver;">
        <h5>Web Login</h5>
        <?
         echo '<img height="15" width="15" src="'.base_url().'images/tick.png">: Active User (Allow Users to Login)<br>';
         echo '<img style="position:relative; top:1px;" height="15" width="15" src="'.base_url().'images/publish_x.png">: Blocked User';
        ?>
        </span>
        <span style="float: left; padding: 10px; margin-left: 10px; border-right: 1px solid silver;">
        <h5>Allow all Updates Except Queue</h5>
        <?
         echo '<img height="15" width="15" src="'.base_url().'images/tick.png">: Read and Write Both<br>';
         echo '<img style="position:relative; top:1px;" height="15" width="15" src="'.base_url().'images/publish_x.png">: Read Only User';
        ?>
        </span>
        <span style="float: left; padding: 10px; margin-left: 10px; ">
        <h5>Allow Queue Operation</h5>
        <?
         echo '<img height="15" width="15" src="'.base_url().'images/tick.png">: Allow Queue Operations<br>';
         echo '<img style="position:relative; top:1px;" height="15" width="15" src="'.base_url().'images/publish_x.png">: Deny Queue Operations';
        ?>
        </span>
    </div>
</div>
<?php
	}
?>