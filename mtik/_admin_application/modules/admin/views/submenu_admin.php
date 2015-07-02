<?php
	$read_write = $this->session->userdata('read_write_blocked');
    
?>
<ul>
    <li class="first"><a href="<?php echo base_url();?>admin/">List Admin Users</a></li>
    <?php
	if($read_write=='0'){
	   
	
?>
<li><a href="<?php echo base_url();?>admin/add_admin">Add Admin</a></li>
<?php
	}
    else{
?>
  <li><a href="<?php echo base_url();?>admin/not_allowed">Add Admin</a></li>
  <?php
	}
?>
    <div class="clear">
    </div><!-- clear ends here -->
</ul>