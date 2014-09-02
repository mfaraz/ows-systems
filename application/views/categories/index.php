<div class="panel-heading">
	<h3 class="panel-title">Categories Management</h3>
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
				<th>Description</th>
				<th>Created Date</th>
				<th>Modified Date</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if ($categories):
				$i = 1;
				foreach ($categories as $category):
					?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td class="align-left"><?php echo $category->name; ?></td>
						<td class="align-left"><?php echo ($category->description) ? $category->description : '---'; ?></td>
						<td><?php echo mdate('%d-%M-%Y', $category->crdate); ?></td>
						<td><?php echo ($category->modate) ? mdate('%d-%M-%Y', $category->modate) : '---'; ?></td>
						<td>
							<?php
							echo ($category->status == 1) ? '<span class="glyphicon glyphicon-ok-sign color-green"></span>' : '<span class="glyphicon glyphicon-minus-sign color-red"></span>';
							?>
						</td>
						<td>
							<?php
							echo anchor('categories/edit/' . $category->cid, '<span class="glyphicon glyphicon-edit"></span>', 'title="Edit" class="btn btn-warning btn-xs"') . '&nbsp;' . anchor('categories/discard/' . $category->cid, '<span class="glyphicon glyphicon-trash"></span>', 'title="Delete" class="btn btn-danger btn-xs" onclick="return confirm(\'Are you sure you want to delete?\')"');
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