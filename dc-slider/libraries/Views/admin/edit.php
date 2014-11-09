<style>
@import url(<?php echo  plugins_url() . '/'. $this_plugin_dir .'/assets/css/forms.css'; ?>);
</style>

<div class="wrap">
<?php if(isset($flash) && !empty($flash)): ?>
	<h2><?php echo $flash; ?></h2>
<?php endif; ?>
<h2>Edit Slide <a class="add-new-h2" href="<?php echo admin_url('admin.php?page='. $slug); ?>&action=index">List All</a></h2>
<?php if(count($row)): ?>
	<form action="<?php echo admin_url('admin.php?page='.$slug); ?>&action=edit&id=<?php echo isset($row->id) ? $row->id : 0; ?> " method="post" enctype="multipart/form-data" id="editslider">
	<table class="form-table">
		<tbody>
		<tr class="form-field form-required">
			<input type="hidden" name="id" id="id" value="<?php echo isset($row->id) ? $row->id : null; ?>" />
			<th scope="row"><label for="name">Name <span class="description">(required)</span></label></th>
			<td><input type="text" aria-required="true" value="<?php echo isset($row->name) ? $row->name : null; ?>" id="name" name="name"></td>
		</tr>
		<tr class="form-field form-required">
			<th scope="row"><label for="title">Title <span class="description">(required)</span></label></th>
			<td><input type="text" value="<?php echo isset($row->title) ? $row->title : null; ?>" id="subtitle" name="title"></td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="sub_title">Subtitle </label></th>
			<td><input type="text" value="<?php echo isset($row->sub_title) ? $row->sub_title : null; ?>" id="sub_title" name="sub_title"></td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="img"> Upload Image <span class="description">(required)</span></label></th>
			<td>
			<?php 
				$image = (isset($row->img) && !empty($row->img)) ? 'uploads/'. $row->img : 'img/icon-no-image.png';
				echo HtmlHelper::image(plugins_url() . '/'. $this_plugin_dir .'/assets/' . $image, 'image', 200, 200);
			?>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="img"> Upload Image <span class="description">(required)</span></label></th>
			<td>
				<input type="hidden" value="<?php echo isset($row->img) ? $row->img : null; ?>" id="oldimg" name="oldimg">
				<input type="file" value="" id="img" name="img">
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row"><input type="submit" value="Save" class="button button-primary" id="updateslider" name="updateslider"></th>
			<td>&nbsp;</td>
		</tr>
		</tbody></table>
	</form>
<?php endif; ?>
<?php  
	//wp_register_script( 'jquery.validate.min',, array( 'jquery' ), '3.0', false );
	//wp_enqueue_script( 'jquery.validate.min' ); 
?>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="<?php echo  plugins_url() . '/'. $this_plugin_dir .'/assets/js/jquery.validate.min.js'; ?>"> </script>
<script>
	$(document).ready(function(){
		$('#editslider').validate({
			rules: {
				"name": {
					required: true,
				},
				"title": {
					required: true,
				},
			},
			
			messages: {
				"name": {
					required: "Please enter slider name",
				},
				"name": {
					required: "Please enter slider title",
				},
			},
		});
	});
	
</script>
</div>