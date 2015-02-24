<div class="panel-heading">
	<h3 class="panel-title">Edit - User Management</h3>
</div>
<div class="panel-body">
	<?php
	echo form_open('users/edit_user/' . $this->uri->segment(3), 'role="form" class="form-horizontal"');
	echo $this->session->flashdata('message');
	echo form_toolbar();
	?>
	<div class="row-fluid">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">User Profile</h4>
				</div>
				<div class="panel-body">
					<div class="form-group <?php echo form_is_error('firstname'); ?>">
						<?php echo form_label('First name', 'firstname', array('class' => 'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
							<?php echo form_input('firstname', set_value('firstname', $user->firstname), 'class="form-control input-sm" pattern=".{3,50}" title="Allow enter from 3 to 50 characters"') . form_error('firstname'); ?>
						</div>
					</div>
					<div class="form-group <?php echo form_is_error('lastname'); ?>">
						<?php echo form_label('Last name', 'lastname', array('class' => 'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
							<?php echo form_input('lastname', set_value('lastname', $user->lastname), 'class="form-control input-sm" pattern=".{3,50}" title="Allow enter from 3 to 50 characters"') . form_error('lastname'); ?>
						</div>
					</div>
					<div class="form-group <?php echo form_is_error('username'); ?>">
						<?php echo form_label('Username<span class="required">*</span>', 'username', array('class' => 'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
							<?php echo form_input('username', set_value('username', $user->username), 'class="form-control input-sm" pattern=".{5,50}" title="Allow enter from 5 to 50 characters"') . form_error('username'); ?>
						</div>
					</div>
					<div class="form-group <?php echo form_is_error('email'); ?>">
						<?php echo form_label('Email', 'email', array('class' => 'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
							<?php echo form_input('email', set_value('email', $user->email), 'class="form-control input-sm" pattern=".{5,50}" title="Allow enter from 5 to 50 characters"') . form_error('email'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Phone', 'phone', array('class' => 'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
							<?php echo form_input('phone', set_value('phone', $user->phone), 'class="form-control input-sm"') . form_error('phone'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('Sex', 'sex', array('class' => 'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
							<?php
							echo form_sex(set_value('sex', $user->sex));
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">User Setting</h4>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<?php echo form_label('Select user group', 'role_id', array('class' => 'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
							<?php echo form_dropdown('rid', $roles, set_value('rid', $user->rid), 'class="form-control input-sm"'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label('User status', 'status', array('class' => 'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
							<div class="checkbox"><input type="checkbox" name="status" id="status" value="1" <?php echo set_checkbox('status', 1, ($user->status == 1) ? TRUE : FALSE); ?>> Check to enable this user account</div>
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
