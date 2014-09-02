<div class="row">
	<div class="col-md-8">
		<div class="form-group <?php echo form_is_error('name'); ?>">
			<label for="name" class="control-label col-sm-3">Product <span class="required">*</span></label>
			<div class="col-sm-9">
				<input type="text" name="name" id="name" class="form-control input-sm" value="<?php echo set_value('pid'); ?>" pattern=".{1,50}" title="Allow enter between 1 to 50 characters" required placeholder="Product Name" />
				<?php echo form_error('name'); ?>
			</div>
		</div>
		<?php if ($categories): ?>
			<div class="form-group <?php echo form_is_error('cid'); ?>">
				<label for="cid" class="control-label col-sm-3">Category</label>
				<div class="col-sm-9">
					<?php echo form_select('cid', $categories, 'category', set_value('cid')); ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="form-group <?php echo form_is_error('qty'); ?>">
			<label for="qty" class="control-label col-sm-3">Quantity <span class="required">*</span></label>
			<div class="col-sm-9">
				<input type="text" name="qty" id="qty" class="form-control input-sm" value="<?php echo set_value('qty'); ?>" pattern=".{1,5}" title="Allow enter between 1 to 5 characters" required placeholder="Quantity" />
				<?php echo form_error('qty'); ?>
			</div>
		</div>
		<div class="form-group <?php echo form_is_error('unit_price'); ?>">
			<label for="unit_price" class="control-label col-sm-3">Unit Price <span class="required">*</span></label>
			<div class="col-sm-9">
				<input type="text" name="unit_price" id="unit_price" class="form-control input-sm" value="<?php echo set_value('unit_price'); ?>" pattern=".{1,25}" title="Allow enter between 1 to 25 characters" required placeholder="Unit Price" />
				<?php echo form_error('unit_price'); ?>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="thumbnail">
			<?php echo img(IMG_PATH . 'w1.jpg'); ?>
		</div>
	</div>
</div>