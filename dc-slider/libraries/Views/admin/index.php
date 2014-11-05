<?php
	$IconHelper->drawIcon('active');
?>
<div class="wrap">
<h2>List of Slides <a class="add-new-h2" href="<?php echo admin_url('admin.php?page='. $slug); ?>&action=add">Add New</a></h2>
<table class="wp-list-table widefat pages" cellpadding="2" cellspacing="">
  <thead>
    <tr>
      <th width="10%" class="check-column"><input type="checkbox" id="snsf-all-checkboxes" /></th>
      <th width="10%">ID</th>
      <th width="30%">Slide Name</th>
      <th width="20%">Caption</th>
      <th width="5%">Status</th>
      <th width="10%">Created On</th>
      <th width="10%">Modified On</th>
      <th width="10%">Actions</th>
    </tr>
  </thead>
  <?php if(count($sliders)): ?>
	<?php foreach($sliders as $slider): ?>
	<tr>
      <th class="check-column"><input type="checkbox" value="<?php echo $slider->id; ?>"/></th>
      <td><?php echo $slider->id; ?></td>
      <td><?php echo $slider->name; ?></td>
      <td><?php echo $slider->title; ?></td>
      <td><?php echo $slider->active; ?></td>
      <td><?php echo date('d F, Y h:i a', strtotime($slider->created_on)); ?></td>
      <td>&nbsp;</td>
    </tr>
	<?php endforeach; ?>
  <?php else: ?>
	<tr>
      <td colspan="6" align="center"><strong> No Records Found! </strong></td>
    </tr>
  <?php endif; ?>
  <tfoot>
   <tr>
      <th width="10%" class="check-column"><input type="checkbox" id="snsf-all-checkboxes" /></th>
      <th width="10%">ID</th>
      <th width="20%">Slide Name</th>
      <th width="20%">Caption</th>
      <th width="5%">Status</th>
      <th width="20%">Created On</th>
      <th width="20%">Modified On</th>
      <th width="10%">Actions</th>
    </tr>
  </tfoot>
  <tbody>
    
  </tbody>
</table>
</div>