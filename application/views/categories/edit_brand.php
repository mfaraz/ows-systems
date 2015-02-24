<div class="panel-heading">
	<h3 class="panel-title">Edit - Brand Management</h3>
</div>
<div class="panel-body">
	<?php
	echo form_open('categories/edit_brand/' . $this->uri->segment(3), 'role="form" class="form-horizontal"');
	echo form_toolbar();
	if ($brand):
		?>
		<div class="row-fluid">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"></h4>
					</div>
					<div class="panel-body">
						<div class="form-group <?php echo form_is_error('name'); ?>">
							<?php echo form_label('Name <span class="required">*</span>', 'name', array('class' => 'col-md-3 control-label')); ?>
							<div class="col-md-9">
								<?php echo form_input('name', set_value('name', $brand->name), 'class="form-control input-sm" pattern=".{3,50}" title="Allow enter 3 to 50 characters"') . form_error('name'); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo form_label('Category', 'parent_id', array('class' => 'col-md-3 control-label')); ?>
							<div class="col-md-9">
								<?php
								if ($categories) {
									echo form_dropdown('parent_id', $categories, set_value('parent_id', $brand->parent_id), 'class="form-control input-sm"');
								}
								?>
							</div>
						</div>
						<div class="form-group">
							<?php echo form_label('Description', 'description', array('class' => 'col-md-3 control-label')); ?>
							<div class="col-md-9">
								<?php echo form_textarea('description', set_value('description', $brand->description), 'class="form-control input-sm"'); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo form_label('Status', 'status', array('class' => 'col-md-3 control-label')); ?>
							<div class="col-md-9">
								<div class="checkbox"><input type="checkbox" name="status" id="status" value="1" <?php echo set_checkbox('status', 1, ($brand->status == 1) ? TRUE : FALSE); ?>> Check to enable this brand</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	endif;
	echo form_close();
	?>
</div>