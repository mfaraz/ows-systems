<div class="panel-heading">
	<h3 class="panel-title">Products Management</h3>
</div>
<div class="panel-body">
	<?php
	echo $this->session->flashdata('message');
	echo form_toolbar();
	?>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>N&ordm;</th>
				<th>Name</th>
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
