<script type="text/javascript">
	$(document).ready(function(){
	   $('#title').blur(function(){
            var title = $(this).val();
            $('#name').val(title);
            $('#n').val(title);
        });
	});
</script>
<?php echo validation_errors();

 ?>
<div>
    <form accept="" action="<?php echo base_url(); ?>category/new_category" method="post">
    <table>
        <tr>
            <td>Title</td>
            <td><input type="text" id="title" value="<?php echo set_value('title');?>" name="title" /></td>
        </tr>
        <tr>
            <td>Category Name</td>
            <td><input type="hidden" value="" id="n" name="category_name" /><input type="text" value="<?php echo set_value('category_name');?>"  id="name" disabled="true" /></td>
        </tr>
        <tr>
            <td>Description:</td>
            <td><input type="text" value="<?php echo set_value('description');?>" name="description" /></td>
        </tr>
    </table>
    <div class="form-actions">
      <button type="submit" class="btn  btn-primary" name="submit">Add Category</button>
      <button type="reset" class="btn ">Cancel</button>
    </div>
</form>

</div>