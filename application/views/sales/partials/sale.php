<div class="row">
	<div class="col-md-8">
		<div class="form-group <?php echo form_is_error('name'); ?>">
			<label for="name" class="control-label col-sm-3">Product <span class="required">*</span></label>
			<div class="col-sm-9">
				<input type="text" name="name" id="name" class="form-control input-sm" value="<?php echo set_value('pid'); ?>" pattern=".{1,50}" title="Allow enter between 1 to 50 characters" required placeholder="Product Name" />
				<?php echo form_error('name'); ?>
			</div>
		</div>
		<?php// print_r($categories);exit();?>

		<?php if ($categories):  ?>
			<div class="form-group <?php echo form_is_error('parent_id'); ?>">
				<label for="parent_id" class="control-label col-sm-3">Category</label>
				<div class="col-sm-9">
					<?php echo form_dropdown('parent_id', array('' => '--category--') + $categories, set_value('parent_id'), 'class="form-control input-sm" id="parent_id"'); ?>
					<?php echo form_error('parent_id'); ?>
				</div>
			</div>
		<?php endif; ?>
		<?php
		if($categories):
			$brands = array();
			foreach ($categories as $key => $value) {
				$brands = $this->mcategories->select_brandlist($key);
				if ($brands) {
					echo '<div class="form-group brand hidden" id="brand' . $key . '">'
					. '<label for="cid" class="control-label col-sm-3">Brand</label>'
					. '<div class="col-sm-9">'
					. form_dropdown('cid', $brands, set_value('cid'), 'class="form-control input-sm"')
					. '</div></div>';
					unset($brands);
				} else {
					echo '<div class="form-group brand hidden" id="brand' . $key . '">'
					. '<label for="cid" class="control-label col-sm-3">Brand</label>'
					. '<div class="col-sm-9"><select name="cid" id="brand' . $key . '" class="form-control input-sm" disabled="disabled"></select>'
					. '</div></div>';
				}
			}
		endif;
		?>
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