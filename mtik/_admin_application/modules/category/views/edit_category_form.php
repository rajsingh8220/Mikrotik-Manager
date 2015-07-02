<script type="text/javascript">
	$(document).ready(function(){
	   $('#title').blur(function(){
	       //alert('sdf');
            var title = $(this).val();
            //alert(title);
            $('#name').val(title);
            $('#n').val(title);
        });
	});
</script>
<?php 
    //print_r($records);
 ?>
<div>
    <form accept="" action="<?php echo base_url(); ?>category/edit_category_submit" method="post">
    <table>
    <input type="hidden" value="<?php echo $records['id']; ?>" name="category_id" />
        <tr>
            <td>Title</td>
            <td><input type="text" value="<?php echo $records['title'];?>" name="title" id="title" /></td>
        </tr>
        <tr>
            <td>Category Name</td>
            <td>
            <input type="hidden" value="<?php echo $records['category_name'];?>" id="n" name="category_name" /><input type="text" value="<?php echo $records['category_name'];?>"  id="name" disabled="true" />
            
        </tr>
        <tr>
            <td>Description:</td>
            <td><input type="text" value="<?php echo $records['description'];?>" name="description" /></td>
        </tr>
    </table>
    <div class="form-actions">
      <button type="submit" class="btn  btn-primary" name="submit">Edit Category</button>
      <button type="reset" class="btn ">Cancel</button>
    </div>
</form>

</div>