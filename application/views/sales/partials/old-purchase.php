<div class="print-invoice">
	<?php
	if ($invoice_items) {
		$i = 1;
		?>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>N&ordm;</th>
					<th>Description</th>
					<th>Qty</th>
					<th>Price</th>
					<th>Total</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($invoice_items as $item) { ?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td class="align-left"><?php echo $item->name == 'Accessories' ? $item->accessories : $item->name; ?></td>
						<td class="align-left"><?php echo $item->qty; ?></td>
						<td class="align-left"><?php echo '$' . $item->unit_price; ?></td>
						<td class="align-left"><?php echo '$' . $item->sub_total; ?></td>
						<td><a class="btn btn-danger btn-xs" href="<?php echo base_url(); ?>sales/removeitem/<?php echo $item->idid . '/' . urlencode($item->name) . '/' . $item->qty . '/' . $item->iid . '/' . $this->uri->segment(3); ?>" title="Remove" onclick="return confirm('Are you sure you want to remove this item.');" style="position: inherit;"><i class="glyphicon glyphicon-remove-circle"></i> Remove</a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } else { ?>
		<p>There is not any purchase product yet!</p>
	<?php } ?>
</div>
