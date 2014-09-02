<div class="panel-heading">
	<h3 class="panel-title">User Management</h3>
</div>
<div class="panel-body">
	<ul class="nav nav-tabs" role="tablist">
		<li class="<?php echo ($active == 'user') ? 'active' : ''; ?>">
			<a href="#users" role="tab" data-toggle="tab">List users</a>
		</li>
		<li class="<?php echo ($active == 'role') ? 'active' : ''; ?>">
			<a href="#roles" role="tab" data-toggle="tab">User Roles</a>
		</li>
	</ul>
	<?php
	echo $this->session->flashdata('message');
	?>
	<div class="tab-content">
		<div class="tab-pane <?php echo ($active == 'user') ? 'active' : ''; ?>" id="users">
			<div class="panel-group" id="accordion">
				<div class="btn-toolbar" role="toolbar">
					<?php
					echo anchor('/users/add_user/', '<span class="glyphicon glyphicon-plus-sign"></span> Create', 'class="btn btn-sm btn-success" title="Add new user"');
					?>
				</div>
				<div class="content">
					<div class="filter">
						<?php
						echo form_open('users/', 'class="form-inline"');
						?>
						<div class="form-group">
							<label class="sr-only" for="fname">Name</label>
							<input type="text" class="form-control input-sm" id="fname" name="fname" value="<?php echo set_value('fname'); ?>" placeholder="Name">
						</div>
						<div class="form-group">
							<label class="sr-only" for="username">Username</label>
							<input type="text" class="form-control input-sm" id="username" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username">
						</div>
						<div class="form-group">
							<label class="sr-only" for="email">Email</label>
							<input type="text" class="form-control input-sm" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email">
						</div>
						<div class="form-group">
							<label class="sr-only" for="status">Status</label>
							<?php echo form_dropdown('status', array('' => '-- All Status --', '1' => 'Enabled', '0' => 'Disabled'), set_value('status', $this->session->userdata('status')), 'class="form-control input-sm"') ?>
						</div>
						<button type="submit" class="btn btn-primary btn-sm" value="submit" name="submit"><i class="glyphicon glyphicon-filter"></i> Filter</button>
						<?php
						echo form_close();
						?>
					</div>
					<table class="table table-striped table-hover table-bordered">
						<thead>
							<tr>
								<th>N&ordm;</th>
								<th>Name</th>
								<th>Username</th>
								<th>Role</th>
								<th>Email</th>
								<th>Sex</th>
								<th>Phone</th>
								<th>Created Date</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($users) {
								$i = 1;
								foreach ($users as $user) {
									echo '<tr>'
									. '<td>' . $i++ . '</td>'
									. '<td class="align-left">' . $user->firstname . ' ' . $user->lastname . '</td>'
									. '<td class="align-left">' . $user->username . '</td>'
									. '<td class="align-left">' . ucfirst($user->name) . '</td>'
									. '<td class="align-left">' . $user->email . '</td>'
									. '<td>' . ($user->sex == 0 ? 'M' : 'F') . '</td>'
									. '<td>' . $user->phone . '</td>'
									. '<td>' . mdate('%d-%m-%Y', $user->crdate) . '</td>';
									?>
								<td><?php echo ($user->status == 1) ? '<span class="glyphicon glyphicon-ok-sign color-green"></span>' : '<span class="glyphicon glyphicon-minus-sign color-red"></span>'; ?></td>
								<td>
									<?php
									if ($user->uid > 1) {
										echo anchor('users/edit_user/' . $user->uid, '<span class="glyphicon glyphicon-edit"></span>', 'class="btn btn-warning btn-xs" title="Edit"') . '&nbsp;' . anchor('users/discard_user/' . $user->uid, '<span class="glyphicon glyphicon-trash"></span>', 'class="btn btn-danger btn-xs" title="Delete" onclick="return confirm(\'Are you sure you want to delete?\')"');
									} else {
										echo anchor('users/edit_user/' . $user->uid, '<span class="glyphicon
										glyphicon-edit"></span>', 'class="btn btn-warning btn-xs" title="Edit" disabled="disabled"') . '&nbsp;' . anchor('users/discard_user/' . $user->uid, '<span class="glyphicon glyphicon-trash"></span>', 'class="btn btn-danger btn-xs" title="Delete" disabled="disabled"');
									}
									?>
								</td>
								</tr>
								<?php
							}
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="tab-pane <?php echo ($active == 'role') ? 'active' : ''; ?>" id="roles">
			<div class="panel-group" id="accordion">
				<div class="btn-toolbar" role="toolbar">
					<?php
					echo anchor('users/add_role/', '<span class="glyphicon glyphicon-plus-sign"></span> Create', 'class="btn btn-sm btn-success" title="Add new roles"');
					?>
				</div>
				<div class="content">
					<table class="table table-striped table-hover table-bordered">
						<thead>
							<tr>
								<th rowspan="2" class="valign-middle">N&ordm;</th>
								<th rowspan="2" class="valign-middle">Role</th>
								<th colspan="8">Modules Permission</th>
								<th rowspan="2" class="valign-middle">Date Created</th>
								<th rowspan="2" class="valign-middle">Date Modified</th>
								<th rowspan="2" class="valign-middle">Status</th>
								<th rowspan="2" class="valign-middle">Action</th>
							</tr>
							<tr>
								<th>Home</th>
								<th>Sales</th>
								<th>Deposits</th>
								<th>Products</th>
								<th>Categories</th>
								<th>Reports</th>
								<th>Users</th>
								<th>Settings</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($roles) {
								$yes = '<span class="glyphicon glyphicon-ok-sign color-green"></span>';
								$no = '<span class="glyphicon glyphicon-minus-sign color-red"></span>';
								foreach ($roles as $role) {
									?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td class="align-left"><?php echo $role->name; ?></td>
										<td><?php echo $role->mul_welcome == 1 ? $yes : $no; ?></td>
										<td><?php echo $role->mul_sales == 1 ? $yes : $no; ?></td>
										<td><?php echo $role->mul_deposits == 1 ? $yes : $no; ?></td>
										<td><?php echo $role->mul_products == 1 ? $yes : $no; ?></td>
										<td><?php echo $role->mul_categories == 1 ? $yes : $no; ?></td>
										<td><?php echo $role->mul_reports == 1 ? $yes : $no; ?></td>
										<td><?php echo $role->mul_users == 1 ? $yes : $no; ?></td>
										<td><?php echo $role->mul_settings == 1 ? $yes : $no; ?></td>
										<td><?php echo mdate('%d-%m-%Y', $role->crdate); ?></td>
										<td><?php echo $role->modate != 0 ? mdate('%d-%m-%Y', $role->modate) : '---'; ?></td>
										<td><?php echo ($role->status == 1) ? $yes : $no; ?></td>
										<td>
											<?php
											if ($role->rid > 1) {
												echo anchor('users/edit_role/' . $role->rid, '<span class="glyphicon glyphicon-edit"></span>', 'class="btn btn-warning btn-xs" title="Edit" disabled="disabled"') . '&nbsp;' . anchor('users/discard_role/' . $role->rid, '<span class="glyphicon glyphicon-trash"></span>', 'class="btn btn-danger btn-xs" title="Delete" onclick="return confirm(\'Are you sure you want to delete this role?\')"');
											} else {
												echo anchor('users/edit_role/' . $role->rid, '<span class="glyphicon
											glyphicon-edit"></span>', 'class="btn btn-warning btn-xs" title="Edit" disabled="disabled"') . '&nbsp;' . anchor('users/discard_role/' . $role->rid, '<span class="glyphicon glyphicon-trash"></span>', 'class="btn btn-danger btn-xs" title="Delete" disabled="disabled"');
											}
											?>
										</td>
									</tr>
									<?php
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
