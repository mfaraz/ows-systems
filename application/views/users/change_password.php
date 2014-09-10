<div class="panel-heading">
	<h3 class="panel-title">Change Password - User Management</h3>
</div>
<div class="panel-body">
	<?php
	echo form_open('users/change_password/' . $this->uri->segment(3), 'role="form" class="form-horizontal"');
	echo $this->session->flashdata('message');
	echo form_toolbar();
	?>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">Change Password</h4>
				</div>
				<div class="panel-body">
					<div class="form-group <?php echo form_is_error('password'); ?>">
						<?php echo form_label('Password', 'password', array('class' => 'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
							<?php echo form_password('password', set_value('password'), 'class="form-control input-sm" pattern=".{3,50}" title="Allow enter from 3 to 50 characters" required') . form_error('password'); ?>
						</div>
					</div>
					<div class="form-group <?php echo form_is_error('conpassword'); ?>">
						<?php echo form_label('Confirm Password', 'conpassword', array('class' => 'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
							<?php echo form_password('conpassword', set_value('conpassword'), 'class="form-control input-sm" pattern=".{3,50}" title="Allow enter from 3 to 50 characters" required') . form_error('conpassword'); ?>
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
