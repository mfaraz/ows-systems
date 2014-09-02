<div class="panel-heading hidden-print">
	<h2 class="panel-title">Sale Activity</h2>
</div>
<div class="panel-body">
	<?php
	echo $this->session->flashdata('message');
	?>
	<div class="content sale">
		<div class="row">
			<div class="col-md-6 hidden-print">
				<?php
				echo form_open('sales/', 'class="form-horizontal" role="form"');
				?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							Sale Information
							<button type="submit" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
						</h3>
					</div>
					<div class="panel-body">
						<?php $this->load->view('sales/partials/sale'); ?>
					</div>
				</div>
				<?php
				echo form_close();
				?>
			</div>
			<div class="col-md-6">
				<?php
				echo form_open('sales/clear', 'class="form-horizontal" role="form"');
				?>
				<div class="panel panel-default">
					<div class="panel-heading hidden-print">
						<h3 class="panel-title">
							Purchase Information
							<?php
							if ($invoice_items) {
								echo anchor('invoices/', '<span class="glyphicon
								glyphicon-circle-arrow-right"></span> Next', 'class="btn btn-sm btn-info"');
							}
							?>
						</h3>
					</div>
					<div class="panel-body">
						<?php $this->load->view('sales/partials/purchase'); ?>
					</div>
				</div>
				<?php
				echo form_close();
				?>
			</div>
		</div>
	</div>
</div>
