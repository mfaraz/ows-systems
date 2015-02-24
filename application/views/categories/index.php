<div class="panel-heading">
	<h3 class="panel-title">Categories Management</h3>
</div>
<div class="panel-body">
	<ul class="nav nav-tabs" role="tablist">
		<li class="active">
			<a href="#category" role="tab" data-toggle="tab">Category</a>
		</li>
		<li>
			<a href="#brand" role="tab" data-toggle="tab">Brand</a>
		</li>
	</ul>
	<?php
	echo $this->session->flashdata('message');
	?>
	<div class="tab-content">
		<div class="tab-pane active" id="category">
			<div class="panel-group" id="accordion">
				<div class="btn-toolbar" role="toolbar">
					<?php
					echo anchor('/categories/add_category/', '<span class="glyphicon glyphicon-plus-sign"></span> Create', 'class="btn btn-sm btn-success" title="Add new category"');
					?>
				</div>
				<div class="content">
					<div class="filter"></div>
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
											echo anchor('categories/edit_category/' . $category->cid, '<span class="glyphicon glyphicon-edit"></span>', 'title="Edit" class="btn btn-warning btn-xs"');
											echo '&nbsp;' . anchor('categories/discard_category/' . $category->cid, '<span class="glyphicon glyphicon-trash"></span>', 'title="Delete" class="btn btn-danger btn-xs'.($category->cid <=3 ? ' disabled' : '').'" onclick="return confirm(\'Are you sure you want to delete? All brands that are belong to this category will be deleted as well!\')"');
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
		</div>
		<div class="tab-pane" id="brand">
			<div class="panel-group" id="accordion">
				<div class="btn-toolbar" role="toolbar">
					<?php
					echo anchor('/categories/add_brand/', '<span class="glyphicon glyphicon-plus-sign"></span> Create', 'class="btn btn-sm btn-success" title="Add new brand"');
					?>
				</div>
				<div class="content">
					<div class="filter">
						<?php
						echo form_open('categories/', 'class="form-inline" role="form"');
						echo form_hidden('active', 'brand');
						?>
						<div class="form-group">
							<label class="sr-only" for="parent_id">Category</label>
							<?php
							if ($categories) {
								echo form_dropdown('parent_id', array('' => '--All Categories--') + $categorylist, set_value('parent_id'), 'class="form-control input-sm"');
							}
							?>
						</div>
						<button type="submit" class="btn btn-primary btn-sm" value="submit" name="submit"><i class="glyphicon glyphicon-filter"></i> Filter</button>
						<?php echo form_close(); ?>
					</div>
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
							if ($brands):
								$i = 1;
								foreach ($brands as $brand):
									?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td class="align-left"><?php echo $brand->name; ?></td>
										<td class="align-left"><?php echo ($brand->description) ? $brand->description : '---'; ?></td>
										<td><?php echo mdate('%d-%M-%Y', $brand->crdate); ?></td>
										<td><?php echo ($brand->modate) ? mdate('%d-%M-%Y', $brand->modate) : '---'; ?></td>
										<td>
											<?php
											echo ($brand->status == 1) ? '<span class="glyphicon glyphicon-ok-sign color-green"></span>' : '<span class="glyphicon glyphicon-minus-sign color-red"></span>';
											?>
										</td>
										<td>
											<?php
											echo anchor('categories/edit_brand/' . $brand->cid, '<span class="glyphicon glyphicon-edit"></span>', 'title="Edit" class="btn btn-warning btn-xs"') . '&nbsp;' . anchor('categories/discard_brand/' . $brand->cid, '<span class="glyphicon glyphicon-trash"></span>', 'title="Delete" class="btn btn-danger btn-xs" onclick="return confirm(\'Are you sure you want to delete?\')"');
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
		</div>
	</div>
</div>