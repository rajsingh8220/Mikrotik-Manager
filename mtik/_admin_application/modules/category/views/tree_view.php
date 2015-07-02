<?php

/**
 * @author phpdesigner
 * @copyright 2013
 */

//echo "tree view";
//print_r($queues);
?>
<table class="table table-striped table-bordered bootstrap-datatable datatable">

<tr>
    <th>Queue View</th>
    <th>Target Address</th>
    <th>Tx Max Limit</th>
    <th>Rx Max Limit</th>
    <th>Actions</th>
    <th></th>
    <th></th>
    
</tr>


<?php
//echo $cat_id;
function show_unlimited($tx, $rx){
    if($tx=='0k'&&$rx!='0k'){
        return 'unlimited'."<td>".$rx;
    }
    if($rx=='0k'&&$tx!='0k'){
        return $tx."<td>".'unlimited';
    }
    if($tx=='0k'&&$rx=='0k'){
       return 'unlimited'."<td>".'unlimited'; 
    }
    else{
       return $tx."<td>".$rx; 
    }
}
foreach($queues as $que){
    
    if($que['parent_queue_id']=='0'){
        echo "<tr><td>";
        echo '<span style="color:#0054A8; "><strong>'.$que['name'].'</strong></span>';
        echo "</td><td>".$que['target_address']."</td><td>".show_unlimited($que['tx_max_limit'],$que['rx_max_limit'])."</td></td>";
        ?>
            <td><a href="<?php echo base_url(); ?>category/delete_queue/<?php echo $que['name']; ?>/<?php echo $cat_id; ?>">Delete</a></td>
            <td><a href="<?php echo base_url(); ?>category/edit_queue/<?php echo $que['name']; ?>/<?php echo $cat_id; ?>">Bandwidth Update</a></td>
            <td><a href="<?php echo base_url(); ?>category/admin_edit_queue/<?php echo $que['name']; ?>/<?php echo $cat_id; ?>">Edit</a></td>
            <td><a href="<?php echo base_url(); ?>category/schedule_bandwidth/<?php echo $que['name']; ?>/<?php echo $cat_id; ?>">Bandwidth Scheduling</a></td></tr>
        <?php
        foreach($queues as $q){
            if($que['q_id']==$q['parent_queue_id']){
                echo "<tr><td>";
                echo "<span style='margin-left:15px; color:blue; '>".$q['name']."</span>";
                echo "</td><td>".$q['target_address']."</td><td>".show_unlimited($q['tx_max_limit'],$q['rx_max_limit'])."</td></td>";
                ?>
                    <td><a href="<?php echo base_url(); ?>category/delete_queue/<?php echo $q['name']; ?>/<?php echo $cat_id; ?>">Delete</a></td>
                    <td><a href="<?php echo base_url(); ?>category/edit_queue/<?php echo $q['name']; ?>/<?php echo $cat_id; ?>">Bandwidth Update</a></td>
                    <td><a href="<?php echo base_url(); ?>category/admin_edit_queue/<?php echo $q['name']; ?>/<?php echo $cat_id; ?>">Edit</a></td>
                    <td><a href="<?php echo base_url(); ?>category/schedule_bandwidth/<?php echo $q['name']; ?>/<?php echo $cat_id; ?>">Bandwidth Scheduling</a></td></tr>
                <?php
                foreach($queues as $q1){
                    
                    if($q['q_id']==$q1['parent_queue_id']){
                        echo "<tr><td>";
                        echo "<span style='margin-left:30px; color:teal; '>".$q1['name']."</span>";
                        echo "</td><td>".$q1['target_address']."</td><td>".show_unlimited($q1['tx_max_limit'],$q1['rx_max_limit'])."</td></td>";
                        ?>
                            <td><a href="<?php echo base_url(); ?>category/delete_queue/<?php echo $q1['name']; ?>/<?php echo $cat_id; ?>">Delete</a></td>
                            <td><a href="<?php echo base_url(); ?>category/edit_queue/<?php echo $q1['name']; ?>/<?php echo $cat_id; ?>">Bandwidth Update</a></td>
                            <td><a href="<?php echo base_url(); ?>category/admin_edit_queue/<?php echo $q1['name']; ?>/<?php echo $cat_id; ?>">Edit</a></td>
                            <td><a href="<?php echo base_url(); ?>category/schedule_bandwidth/<?php echo $q1['name']; ?>/<?php echo $cat_id; ?>">Bandwidth Scheduling</a></td></tr>
                        <?php
                        foreach($queues as $q2){
                            
                            if($q1['q_id']==$q2['parent_queue_id']){
                                echo "<tr><td>";
                                echo "<span style='margin-left:45px; color:#0080FF; '>".$q2['name']."</span>";
                                echo "</td><td>".$q2['target_address']."</td><td>".show_unlimited($q2['tx_max_limit'],$q2['rx_max_limit'])."</td></td>";
                                ?>
                                    <td><a href="<?php echo base_url(); ?>category/delete_queue/<?php echo $q2['name']; ?>/<?php echo $cat_id; ?>">Delete</a></td>
                                    <td><a href="<?php echo base_url(); ?>category/edit_queue/<?php echo $q2['name']; ?>/<?php echo $cat_id; ?>">Bandwidth Update</a></td>
                                    <td><a href="<?php echo base_url(); ?>category/admin_edit_queue/<?php echo $q2['name']; ?>/<?php echo $cat_id; ?>">Edit</a></td>
                                    <td><a href="<?php echo base_url(); ?>category/schedule_bandwidth/<?php echo $q2['name']; ?>/<?php echo $cat_id; ?>">Bandwidth Scheduling</a></td></tr>
                                <?php
                                foreach($queues as $q3){
                                    
                                   if($q2['q_id']==$q3['parent_queue_id']){
                                        echo "<tr><td>";
                                        echo "<span style='margin-left:60px; color:#8080C0; '>".$q3['name']."</span>"; 
                                        echo "</td><td>".$q3['target_address']."</td><td>".show_unlimited($q3['tx_max_limit'],$q3['rx_max_limit'])."</td></td>";
                                        ?>
                                            <td><a href="<?php echo base_url(); ?>category/delete_queue/<?php echo $q3['name']; ?>/<?php echo $cat_id; ?>">Delete</a></td>
                                            <td><a href="<?php echo base_url(); ?>category/edit_queue/<?php echo $q3['name']; ?>/<?php echo $cat_id; ?>">Bandwidth Update</a></td>
                                            <td><a href="<?php echo base_url(); ?>category/admin_edit_queue/<?php echo $q3['name']; ?>/<?php echo $cat_id; ?>">Edit</a></td>
                                            <td><a href="<?php echo base_url(); ?>category/schedule_bandwidth/<?php echo $q3['name']; ?>/<?php echo $cat_id; ?>">Bandwidth Scheduling</a></td></tr>
                                        <?php
                                        foreach($queues as $q4){
                                            
                                             if($q3['q_id']==$q4['parent_queue_id']){
                                                echo "<tr><td>";
                                                echo "<span style='margin-left:75px; color:#999999; '>".$q4['name']."</span>";  
                                                echo "</td><td>".$q4['target_address']."</td><td>".show_unlimited($q4['tx_max_limit'],$q4['rx_max_limit'])."</td></td>"; 
                                                ?>
                                                    <td><a href="<?php echo base_url(); ?>category/delete_queue/<?php echo $q4['name']; ?>/<?php echo $cat_id; ?>">Delete</a></td>
                                                    <td><a href="<?php echo base_url(); ?>category/edit_queue/<?php echo $q4['name']; ?>/<?php echo $cat_id; ?>">Bandwidth Update</a></td>
                                                    <td><a href="<?php echo base_url(); ?>category/admin_edit_queue/<?php echo $q4['name']; ?>/<?php echo $cat_id; ?>">Edit</a></td>
                                                    <td><a href="<?php echo base_url(); ?>category/schedule_bandwidth/<?php echo $q4['name']; ?>/<?php echo $cat_id; ?>">Bandwidth Scheduling</a></td></tr>
                                                <?php
                                             }
                                        }
                                   }
                                }
                            }
                            
                        }
                    }
                }
            }
            
        }
    }
}
?>

</table>
