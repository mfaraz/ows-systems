<?php
echo doctype('html5');
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<?php
		print stylesheets();
		print site_title($title);
		?>
	</head>
	<body class="login">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Please Sign In</h3>
						</div>
						<div class="panel-body">
							<?php
							echo form_open('login/');
							echo $this->session->flashdata('message');
							?>
							<div class="form-group <?php echo form_is_error('username'); ?>">
								<?php
								echo form_label('Username');
								echo form_input('username', set_value('username'), 'class="form-control" placeholder="Username"');
								?>
							</div>
							<div class="form-group <?php echo form_is_error('password'); ?>">
								<?php
								echo form_label('Password');
								echo form_password('password', set_value('password'), 'class="form-control" placeholder="Password"');
								?>
							</div>
							<div class="form-group last">
								<?php
								echo form_submit('login', 'Sign In', 'class="btn btn-primary form-control"');
								?>
							</div>
							<?php
							echo form_close();
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		print javascripts();
		?>
	</body>
</html>