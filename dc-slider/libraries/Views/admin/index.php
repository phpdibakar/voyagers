<div class="wrap">
<?php if(isset($flash) && !empty($flash)): ?>
	<h2><?php echo $flash; ?></h2>
<?php endif; ?>
<h2>List of Slides <a class="add-new-h2" href="<?php echo admin_url('admin.php?page='. $slug); ?>&action=add">Add New</a></h2>
<table class="wp-list-table widefat pages" cellpadding="2" cellspacing="2">
  <thead>
    <tr>
      <th width="10%" class="check-column"><input type="checkbox" id="snsf-all-checkboxes" /></th>
      <th width="10%">ID</th>
      <th width="10%">Slide Name</th>
      <th width="15%">Caption</th>
      <th width="5%">Order</th>
      <th width="5%">Status</th>
      <th width="15%">Created On</th>
      <th width="15%">Modified On</th>
      <th width="15%">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php if(count($sliders)): ?>
	<?php foreach($sliders as $slider): ?>
	<tr>
		<th class="check-column"><input type="checkbox" value="<?php echo $slider->id; ?>"/></th>
		<td><?php echo $slider->id; ?></td>
		<td><?php echo $slider->name; ?></td>
		<td><?php echo $slider->title; ?></td>
		<td><?php echo $slider->order; ?></td>
		<td>
			<?php 
				$link = admin_url('admin.php?page='. $slug). '&action=active&id=' . $slider->id. '&status=';
				echo $slider->active ? HtmlHelper::link($IconHelper->drawIcon('active'), $link. '0', 'Active', true) : 
					HtmlHelper::link($IconHelper->drawIcon('inactive'), $link. '1', 'Inactive', true); 
			?>
		</td>
		<td><?php echo date('d F, Y h:i a', strtotime($slider->created_on)); ?></td>
		<td><?php echo !is_null($slider->modified_on) ? date('d F, Y h:i a', strtotime($slider->modified_on)) : 'Never'; ?></td>
		<td>
			<?php 
				$edit_link = admin_url('admin.php?page='. $slug). '&action=edit&id=' . $slider->id;
				echo HtmlHelper::link($IconHelper->drawIcon('edit'), $edit_link, 'Edit');
			?>
			<?php 
				$edit_link = admin_url('admin.php?page='. $slug). '&action=view&id=' . $slider->id;
				echo HtmlHelper::link($IconHelper->drawIcon('view'), $edit_link, 'View');
			?>
			<?php 
				$edit_link = admin_url('admin.php?page='. $slug). '&action=delete&id=' . $slider->id;
				echo HtmlHelper::link($IconHelper->drawIcon('delete'), $edit_link, 'Delete', true);
			?>
		</td>
    </tr>
	<?php endforeach; ?>
  <?php else: ?>
	<tr>
      <td colspan="8" align="center"><strong> No Records Found! </strong></td>
    </tr>
  <?php endif; ?>
  </tbody>
  <tfoot>
   <tr>
      <th class="check-column"><input type="checkbox" id="snsf-all-checkboxes" /></th>
      <th >ID</th>
      <th >Slide Name</th>
      <th >Caption</th>
	  <th >Order</th>
      <th >Status</th>
      <th >Created On</th>
      <th >Modified On</th>
      <th >Actions</th>
    </tr>
  </tfoot>
  <tbody>
    
  </tbody>
</table>
</div>