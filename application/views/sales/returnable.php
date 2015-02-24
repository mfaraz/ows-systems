<div class="panel-heading hidden-print">
	<h2 class="panel-title">Sale Activity</h2>
</div>
<div class="panel-body">
	<?php
	echo $this->session->flashdata('message');
	?>
	<div class="content sale returnable">
		<div class="row">
			<div class="col-md-6 hidden-print">
				<?php
				echo form_open('sales/returnable/' . $this->uri->segment(3) . '/' . $this->uri->segment(4), 'class="form-horizontal" role="form"');
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
							if($this->uri->segment(4)){
								if ($invoice_items) {
									echo anchor('invoices/prepare_invoice/' . $this->uri->segment(3) . '/' . $this->uri->segment(4), '<span class="glyphicon
									glyphicon-circle-arrow-right"></span> Next', 'class="btn btn-sm btn-info"');
								}
							}
							?>
						</h3>
					</div>
					<div class="panel-body">
						<?php $this->load->view('sales/partials/old-purchase'); ?>
					</div>
				</div>
				<?php
				echo form_close();
				?>
			</div>
		</div>
	</div>
</div>
