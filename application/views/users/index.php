<div class="panel-heading">
	<h3 class="panel-title">User Management</h3>
</div>
<div class="panel-body">
	<ul class="nav nav-tabs" role="tablist">
		<li class="active">
			<a href="#users" role="tab" data-toggle="tab">List users</a>
		</li>
		<li>
			<a href="#roles" role="tab" data-toggle="tab">User Roles</a>
		</li>
	</ul>
	<?php
	echo $this->session->flashdata('message');
	?>
	<div class="tab-content">
		<div class="tab-pane active" id="users">
			<div class="panel-group" id="accordion">
				<div class="btn-toolbar" role="toolbar">
					<?php
					echo anchor('/users/add_user/', '<span class="glyphicon glyphicon-plus-sign"></span> Create', 'class="btn btn-sm btn-success" title="Add new user"');
					?>
				</div>
				<div class="content">
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
									echo anchor('users/edit_user/' . $user->uid, '<span class="glyphicon
										glyphicon-edit"></span>', 'class="btn btn-warning btn-xs" title="Edit"') . '&nbsp;' . anchor('users/change_password/' . $user->uid, '<span class="glyphicon glyphicon-lock"></span>', 'class="btn btn-default btn-xs" title="Change Password" onclick="return confirm(\'Are you sure you want to change password?\')"') . '&nbsp;' . anchor('users/discard_user/' . $user->uid, '<span class="glyphicon glyphicon-trash"></span>', (($user->uid > 1) ? '' : 'disabled="disabled"') . 'class="btn btn-danger btn-xs" title="Delete"');
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
		<div class="tab-pane" id="roles">
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
								<th>Sales</th>
								<th>Deposits</th>
								<th>Products</th>
								<th>Categories</th>
								<th>Invoices</th>
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
										<td><?php echo $role->mul_sales == 1 ? $yes : $no; ?></td>
										<td><?php echo $role->mul_deposits == 1 ? $yes : $no; ?></td>
										<td><?php echo $role->mul_products == 1 ? $yes : $no; ?></td>
										<td><?php echo $role->mul_categories == 1 ? $yes : $no; ?></td>
										<td><?php echo $role->mul_invoices == 1 ? $yes : $no; ?></td>
										<td><?php echo $role->mul_reports == 1 ? $yes : $no; ?></td>
										<td><?php echo $role->mul_users == 1 ? $yes : $no; ?></td>
										<td><?php echo $role->mul_settings == 1 ? $yes : $no; ?></td>
										<td><?php echo mdate('%d-%m-%Y', $role->crdate); ?></td>
										<td><?php echo $role->modate != 0 ? mdate('%d-%m-%Y', $role->modate) : '---'; ?></td>
										<td><?php echo ($role->status == 1) ? $yes : $no; ?></td>
										<td>
											<?php
											echo anchor('users/edit_role/' . $role->rid, '<span class="glyphicon
											glyphicon-edit"></span>', 'class="btn btn-warning btn-xs" title="Edit"') . '&nbsp;' . anchor('users/discard_role/' . $role->rid, '<span class="glyphicon glyphicon-trash"></span>', 'class="btn btn-danger btn-xs" title="Delete"' . (($role->rid > 1) ? '' : 'disabled="disabled"'));
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
