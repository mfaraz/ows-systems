<div class="panel-heading">
	<h3 class="panel-title">Edit - Categories Management</h3>
</div>
<div class="panel-body">
	<?php
	echo form_open('products/edit/' . $this->uri->segment(3), 'role="form" class="form-horizontal"');
	echo form_toolbar();
	if ($products):
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
								<?php echo form_input('name', set_value('name', $products->name), 'id="name" class="form-control input-sm" pattern=".{2,50}" title="Allow enter 2 to 50 characters"') . form_error('name'); ?>
							</div>
						</div>
						<div class="form-group <?php echo form_is_error('unit_in_stocks'); ?>">
							<?php echo form_label('Unit in Stocks <span class="required">*</span>', 'unit_in_stocks', array('class' => 'col-md-3 control-label')); ?>
							<div class="col-md-9">
								<?php echo form_input('unit_in_stocks', set_value('name', $products->unit_in_stocks), 'id="unit_in_stocks" class="form-control input-sm" pattern=".{1,50}" title="Allow enter 1 to 50 characters"') . form_error('unit_in_stocks'); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo form_label('Description', 'description', array('class' => 'col-md-3 control-label')); ?>
							<div class="col-md-9">
								<?php echo form_textarea('description', set_value('description', $products->description), 'id="description" class="form-control input-sm"'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">Product Settings</h4>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<?php echo form_label('Category', 'cid', array('class' => 'col-sm-3 control-label')); ?>
							<div class="col-sm-9">
								<?php echo form_select('cid', $categories, 'category', set_value('cid', $products->cid)); ?>
							</div>
						</div>
						<div class="form-group">
							<?php echo form_label('Product status', 'status', array('class' => 'col-sm-3 control-label')); ?>
							<div class="col-sm-9">
								<div class="checkbox"><input type="checkbox" name="status" id="status" value="1" <?php echo set_checkbox('status', 1, ($products->status == 1) ? TRUE : FALSE); ?>> Check to publish this product</div>
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