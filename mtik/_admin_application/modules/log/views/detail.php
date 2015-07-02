<?php

/**
 * @author phpdesigner
 * @copyright 2013
 */
//echo "detail";
//print_r($records);

?>
<style type="text/css">
<!--
	table{
	   margin: 10px;
	}
-->
</style>
<h3>Basic</h3>
<div class="box">
    <table>
        <tr style="font-weight: bold; color: #0080C0;">
            <td>Operation:</td>
            <td><?php echo $records['table_name']; ?></td>
        </tr>
        <?php 
            if($records['action']=='add'){
        ?>
            <tr>
                <td><strong>Added By:</strong></td>
                <td><?php echo $records['added_by']; ?></td>
            </tr>
            <tr>
                <td><strong>Added On:</strong></td>
                <td><?php echo $records['added_on']; ?></td>
            </tr>
            <tr>
                <td><strong>Action:</strong></td>
                <td><?php echo $records['action']; ?></td>
            </tr>
            <tr>
                <td><strong>Added:</strong></td>
                <td><?php echo $records['field_new_value']; ?></td>
            </tr>
        <?php
            }
        ?>
        <?php 
            if($records['action']=='edit'){
        ?>
            <tr>
                <td><strong>Edited By:</strong></td>
                <td><?php echo $records['added_by']; ?></td>
            </tr>
            <tr>
                <td><strong>Edited On:</strong></td>
                <td><?php echo $records['added_on']; ?></td>
            </tr>
            <tr>
                <td><strong>Action:</strong></td>
                <td><?php echo $records['action']; ?></td>
            </tr>
            <tr>
                <td><strong>Old Value:</strong></td>
                <td><?php echo $records['field_old_value']; ?></td>
            </tr>
            <tr>
                <td><strong>New Value:</strong></td>
                <td><?php echo $records['field_new_value']; ?></td>
            </tr>
        <?php
            }
        ?>
        <?php 
            if($records['action']=='delete'){
        ?>
            <tr>
                <td><strong>Deleted By:</strong></td>
                <td><?php echo $records['added_by']; ?></td>
            </tr>
            <tr>
                <td><strong>Deleted On:</strong></td>
                <td><?php echo $records['added_on']; ?></td>
            </tr>
            <tr>
                <td><strong>Action:</strong></td>
                <td><?php echo $records['action']; ?></td>
            </tr>
            <tr>
                <td><strong>deleted Value:</strong></td>
                <td><?php echo $records['field_old_value']; ?></td>
            </tr>
            
        <?php
            }
        ?>
        
        
    </table>
    <hr />
    <table>
        <tr>
            <td><strong>Affected Category:</strong></td>
            <td><?php echo $records['category_name']; ?></td>
        </tr>
        <tr>
            <td><strong>Affected Device:</strong></td>
            <td><?php echo $records['device_name']; ?></td>
        </tr>
    </table>
</div>
