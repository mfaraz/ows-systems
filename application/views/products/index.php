<div class="panel-heading">
	<h3 class="panel-title">Products Management</h3>
</div>
<div class="panel-body">
	<?php
	echo $this->session->flashdata('message');
	echo form_toolbar();
	$total = 0;
	if ($products) {
		foreach ($products as $product) {
			$total += $product->unit_in_stocks;
		}
	}
	?>
	<span class="pull-right">Total: <strong><?php echo $total; ?></strong></span>
	<div class="content">
		<div class="filter">
			<?php
			echo form_open('products/', 'class="form-inline" role="form"');
			?>
			<div class="form-group">
				<label class="sr-only" for="parent_id">Category</label>
				<?php
				if ($categories) {
					echo form_dropdown('parent_id', array('' => '--All Categories--') + $categories, set_value('parent_id'), 'class="form-control input-sm" id="parent_id"');
				}
				?>
			</div>
			<?php
			$brands = array();
			foreach ($categories as $key => $value) {
				$brands = $this->mcategories->select_brandlist($key);
				if ($brands) {
					echo '<div class="form-group brand ' . (($brand == 'brand' . $key) ? '' : 'hidden') . '" id="brand' . $key . '">'
					. form_hidden('brand', 'brand' . $key)
					. form_dropdown('cid', $brands, set_value('cid'), 'class="form-control input-sm"')
					. '</div>';
					unset($brands);
				}
			}
			?>
			<button type="submit" class="btn btn-primary btn-sm" value="submit" name="submit"><i class="glyphicon glyphicon-filter"></i> Filter</button>
			<?php echo form_close(); ?>
		</div>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>N&ordm;</th>
					<th>Name</th>
					<th>Brand</th>
					<th>Unit in stocks</th>
					<th>Description</th>
					<th>Created Date</th>
					<th>Modified Date</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($products):
					$i = 1;
					foreach ($products as $product):
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td class="align-left"><?php echo $product->name; ?></td>
							<td class="align-left"><?php echo $product->brand; ?></td>
							<td class="<?php echo $product->unit_in_stocks <= 5 ? 'color-red' : ''; ?>"><?php echo $product->unit_in_stocks; ?></td>
							<td><?php echo ($product->description) ? $product->description : '---'; ?></td>
							<td><?php echo mdate('%d-%M-%Y', $product->crdate); ?></td>
							<td><?php echo ($product->modate) ? mdate('%d-%M-%Y', $product->modate) : '---'; ?></td>
							<td>
								<?php
								echo ($product->status == 1) ? '<span class="glyphicon glyphicon-ok-sign color-green"></span>' : '<span class="glyphicon glyphicon-minus-sign color-red"></span>';
								?>
							</td>
							<td>
								<?php
								echo anchor('products/edit/' . $product->pid, '<span class="glyphicon glyphicon-edit"></span>', 'title="Edit" class="btn btn-warning btn-xs"') . '&nbsp;' . anchor('products/discard/' . $product->pid, '<span class="glyphicon glyphicon-trash"></span>', 'title="Delete" class="btn btn-danger btn-xs" onclick="return confirm(\'Are you sure you want to delete this product?\')"');
								?>
							</td>
						</tr>
						<?php
					endforeach;
				endif;
				?>
			</tbody>
		</table>
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