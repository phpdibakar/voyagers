<style>
@import url(<?php echo  plugins_url() . '/'. $this_plugin_dir .'/assets/css/forms.css'; ?>);
</style>

<div class="wrap">
<?php if(isset($flash) && !empty($flash)): ?>
	<h2><?php echo $flash; ?></h2>
<?php endif; ?>
<h2>View Slide <a class="add-new-h2" href="<?php echo admin_url('admin.php?page='. $slug); ?>&action=index">List All</a></h2>
<?php if(count($row)): ?>
	<form action="<?php echo admin_url('admin.php?page='.$slug); ?>&action=edit&id=<?php echo isset($row->id) ? $row->id : 0; ?> " method="post" enctype="multipart/form-data" id="editslider">
	<table class="form-table">
		<tbody>
		<tr class="form-field form-required">
			<input type="hidden" name="id" id="id" value="<?php echo isset($row->id) ? $row->id : null; ?>" />
			<th scope="row"><label for="name">Name</label></th>
			<td><?php echo isset($row->name) ? $row->name : 'Unknown'; ?></td>
		</tr>
		<tr class="form-field form-required">
			<th scope="row"><label for="title">Title</label></th>
			<td><?php echo isset($row->title) ? $row->title : 'Unknown'; ?></td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="sub_title">Subtitle </label></th>
			<td><?php echo isset($row->sub_title) ? $row->sub_title : 'Unknown'; ?></td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="img"> Image</label></th>
			<td>
			<?php 
				$image = (isset($row->img) && !empty($row->img)) ? 'uploads/'. $row->img : 'img/icon-no-image.png';
				echo HtmlHelper::image(plugins_url() . '/'. $this_plugin_dir .'/assets/' . $image, 'image', 200, 200);
			?>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row"><input type="button" value="Back" class="button button-primary" onclick ="window.location.href='<?php echo admin_url('admin.php?page='. $slug); ?>&action=index'"></th>
			<td>&nbsp;</td>
		</tr>
		</tbody></table>
	</form>
<?php endif; ?>
</div>