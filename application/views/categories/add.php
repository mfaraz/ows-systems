<div class="panel-heading">
	<h3 class="panel-title">New - Categories Management</h3>
</div>
<div class="panel-body">
	<?php
	echo form_open('categories/add', 'role="form" class="form-horizontal"');
	echo form_toolbar();
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
							<?php echo form_input('name', set_value('name'), 'class="form-control input-sm" placeholder="Name" pattern=".{3,50}" title="Allow enter between 3 to 50 characters"'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Description', 'description', array('class' => 'col-md-3 control-label')); ?>
						<div class="col-md-9">
							<?php echo form_textarea('description', set_value('description'), 'class="form-control input-sm" placeholder="Description"'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Status', 'status', array('class' => 'col-md-3 control-label')); ?>
						<div class="col-md-9">
							<div class="checkbox"><input type="checkbox" name="status" id="status" value="1" <?php echo set_checkbox('status', 1, TRUE); ?>> Check to enable this category</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	echo form_close();
	?>
</div>