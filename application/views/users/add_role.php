<div class="panel-heading">
	<h3 class="panel-title">New - <?php echo $title; ?></h3>
</div>
<div class="panel-body">
	<?php
	echo form_open('users/add_role', 'role="form" class="form-horizontal"');
	echo $this->session->flashdata('message');
	echo form_toolbar('add');
	?>
	<div class="row-fluid">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">User Role</h4>
				</div>
				<div class="panel-body">
					<div class="form-group <?php echo form_is_error('name'); ?>">
						<?php echo form_label('Name <span class="required">*</span>', 'name', array('class' => 'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
							<?php echo form_input('name', set_value('name'), 'class="form-control input-sm" pattern=".{2,50}" title="Allow enter from 2 to 50 characters" required') . form_error('name'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Description', 'description', array('class' => 'col-sm-3
						control-label')); ?>
						<div class="col-sm-9">
							<?php echo form_textarea('description', set_value('description'),
								'class="form-control input-sm" pattern=".{1,250}" title="Allow enter from 1 to 250 character(s)"'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Status', 'status', array('class' => 'col-sm-3
						control-label')); ?>
						<div class="col-sm-9">
							<div class="checkbox"><input type="checkbox" name="status" id="status" value="1" <?php echo set_checkbox('status', 1, TRUE); ?>>Check to enable this user role</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Role Permission Setting</h4>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="col-sm-12">
							<div class="checkbox"><input type="checkbox" name="mul_welcome" value="1" <?php echo set_checkbox('mul_welcome', 1, FALSE); ?>> Allow to manage <strong>Home</strong> module</div>
						</div>
						<div class="col-sm-12">
							<div class="checkbox"><input type="checkbox" name="mul_sales" value="1" <?php echo set_checkbox('mul_sales', 1, FALSE); ?>> Allow to manage <strong>Sales</strong> module</div>
						</div>
						<div class="col-sm-12">
							<div class="checkbox"><input type="checkbox" name="mul_deposits" value="1" <?php echo set_checkbox('mul_deposits', 1, FALSE); ?>> Allow to manage <strong>Deposits</strong> module</div>
						</div>
						<div class="col-sm-12">
							<div class="checkbox"><input type="checkbox" name="mul_products" value="1" <?php echo set_checkbox('mul_products', 1, FALSE); ?>> Allow to manage <strong>Products</strong> module</div>
						</div>
						<div class="col-sm-12">
							<div class="checkbox"><input type="checkbox" name="mul_categories" value="1" <?php echo set_checkbox('mul_categories', 1, FALSE); ?>> Allow to manage <strong>Categories</strong> module</div>
						</div>
						<div class="col-sm-12">
							<div class="checkbox"><input type="checkbox" name="mul_reports" value="1" <?php echo set_checkbox('mul_reports', 1, FALSE); ?>> Allow to manage <strong>Reports</strong> module</div>
						</div>
						<div class="col-sm-12">
							<div class="checkbox"><input type="checkbox" name="mul_users" value="1" <?php echo set_checkbox('mul_users', 1, FALSE); ?>> Allow to manage <strong>Users</strong> module</div>
						</div>
						<div class="col-sm-12">
							<div class="checkbox"><input type="checkbox" name="mul_settings" value="1" <?php echo set_checkbox('mul_settings', 1, FALSE); ?>> Allow to manage <strong>Settings</strong> module</div>
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
