<div class="panel-heading">
	<h3 class="panel-title">New - Products Management</h3>
</div>
<div class="panel-body">
	<?php
	echo form_open('products/add', 'role="form" class="form-horizontal"');
	echo form_toolbar();
	?>
	<div class="row-fluid">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Product Information</h4>
				</div>
				<div class="panel-body">
					<div class="form-group <?php echo form_is_error('name'); ?>">
						<?php echo form_label('Name <span class="required">*</span>', 'name', array('class' => 'col-md-3 control-label')); ?>
						<div class="col-md-9">
							<?php echo form_input('name', set_value('name'), 'id="name" class="form-control input-sm" placeholder="Name" pattern=".{1,50}" title="Allow enter between 1 to 50 characters" required') . form_error('name'); ?>
						</div>
					</div>
					<div class="form-group <?php echo form_is_error('name'); ?>">
						<?php echo form_label('Unit in Stock <span class="required">*</span>', 'unit_in_stocks', array('class' => 'col-md-3 control-label')); ?>
						<div class="col-md-9">
							<?php echo form_input('unit_in_stocks', set_value('unit_in_stocks'), 'id="unit_in_stocks" class="form-control input-sm" placeholder="Unit in stock" pattern=".{1,50}" title="Allow enter between 1 to 50 character(s)" required') . form_error('unit_in_stocks'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Description', 'description', array('class' => 'col-md-3 control-label')); ?>
						<div class="col-md-9">
							<?php echo form_textarea('description', set_value('description'), 'id="description" class="form-control input-sm"'); ?>
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
					<div class="form-group <?php echo form_is_error('category_id'); ?>">
						<?php echo form_label('Category <span class="required">*</span>', 'parent_id', array('class' => 'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
							<?php
							if ($categories) {
								echo form_dropdown('parent_id', array('' => '--select category--') + $categories, set_value('parent_id'), 'class="form-control input-sm" id="parent_id"') . form_error('parent_id');
							}
							?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Brand', 'cid', array('class' => 'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
							<?php
							$brands = array();
							foreach ($categories as $key => $value) {
								$brands = $this->mcategories->select_brandlist($key);
								if ($brands) {
									echo form_dropdown('cid', $brands, set_value('cid'), 'class="form-control input-sm brand hidden" id="brand' . $key . '"');
									unset($brands);
								} else {
									echo '<select name="cid" class="form-control input-sm brand hidden" id="brand' . $key . '" disabled="disabled"></select>';
								}
							}
							?>
							<select name="cid" class="form-control input-sm brand" id="brand_empty" disabled="disabled"></select>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Product status', 'status', array('class' => 'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
							<div class="checkbox"><input type="checkbox" name="status" id="status" value="1" <?php echo set_checkbox('status', 1, TRUE); ?>> Check to publish this product</div>
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
<script>
	$(function() {
		$('#parent_id').change(function() {
			var parent_id = $(this).val();
			if ($('#brand' + parent_id)) {
				$('.brand').addClass('hidden');
				$('#brand' + parent_id).removeClass('hidden');
			}
		});
	});
</script>