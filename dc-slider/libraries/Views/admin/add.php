<style>
@import url(<?php echo  plugins_url() . '/'. $this_plugin_dir .'/assets/css/forms.css'; ?>);
</style>
<div class="wrap">
<?php if(isset($flash) && !empty($flash)): ?>
	<h2><?php echo $flash; ?></h2>
<?php endif; ?>
<h2>Add New Slide <a class="add-new-h2" href="<?php echo admin_url('admin.php?page='. $slug); ?>&action=index">List All</a></h2>
<form action="<?php echo admin_url('admin.php?page='.$slug); ?>&action=add" method="post" enctype="multipart/form-data" id="addslider">
<table class="form-table">
	<tbody>
	<tr class="form-field form-required">
		<th scope="row"><label for="name">Name <span class="description">(required)</span></label></th>
		<td><input type="text" aria-required="true" value="" id="name" name="name"></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="title">Title <span class="description">(required)</span></label></th>
		<td><input type="text" value="" id="subtitle" name="title"></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="sub_title">Subtitle </label></th>
		<td><input type="text" value="" id="sub_title" name="sub_title"></td>
	</tr>
	<tr class="form-field form-required">
			<th scope="row"><label for="title">Display Order <span class="description">(required)</span></label></th>
			<td><input type="text" value="" id="order" name="order"></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="img"> Upload Image <span class="description">(required)</span></label></th>
		<td><input type="file" value="" id="img" name="img"></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><input type="submit" value="Add" class="button button-primary" id="createslider" name="createslider"></th>
		<td>&nbsp;</td>
	</tr>
	</tbody></table>
</form>
<?php  
	//wp_register_script( 'jquery.validate.min',, array( 'jquery' ), '3.0', false );
	//wp_enqueue_script( 'jquery.validate.min' ); 
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="<?php echo  plugins_url() . '/'. $this_plugin_dir .'/assets/js/jquery.validate.min.js'; ?>"> </script>
<script>
	$(document).ready(function(){
		$('#addslider').validate({
			rules: {
				"name": {
					required: true,
				},
				"title": {
					required: true,
				},
				"img": {
					required: true,
				},
				"order": {
					required: true,
					digits: true
				},
			},
			
			messages: {
				"name": {
					required: "Please enter slider name",
				},
				"name": {
					required: "Please enter slider title",
				},
				"img": {
					required: "Please select a valid image(.jpg, .png)",
				},
				"order": {
					required: "Please enter display order",
					digits: "Only digits are allowed",
				},
			},
		});
	});
	
</script>
</div>