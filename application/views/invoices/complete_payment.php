<div class="panel-heading hidden-print">
	<h2 class="panel-title">Invoice Deposit Complete Payment</h2>
</div>
<div class="panel-body">
	<?php
	echo $this->session->flashdata('message');
	if ($invoice_items) {
		foreach ($invoice_items as $item) {
			if ($item->cash_type == 'US') {
				$balance = $item->balance !== '0.00' ? $item->balance : '0.00';
			} else {
				$balance = $item->balance !== '0.00' ? $item->balance : '0.00';
			}
			break;
		}
	}
	?>
	<div class="content sale">
		<div class="row">
			<div class="col-md-6 hidden-print">
				<?php
				echo form_open('invoices/complete_payment/' . $invoice_no, 'class="form-horizontal" role="form"');
				echo form_hidden('balance', $balance);
				echo form_hidden('prev_cash_type', $item->cash_type);
				?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							Customer Information
							<button type="submit" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
						</h3>
					</div>
					<div class="panel-body">
						<div class="form-group <?php echo form_is_error('cash_receive'); ?>">
							<label for="cash_receive" class="control-label col-sm-3">Cash Received <span
									class="required">*</span></label>
							<div class="col-md-9">
								<input type="text" name="cash_receive" id="cash_receive" class="form-control input-sm" value="<?php echo set_value('cash_receive'); ?>" pattern=".{1,50}" title="Allow enter between 1 to 50 characters" required />
								<?php echo form_error('cash_receive'); ?>
							</div>
						</div>
						<div class="form-group">
							<label for="cash_type" class="control-label col-sm-3">Cash Type</label>
							<div class="col-md-9">
								<?php
								$options = array(
									'US' => 'US Dollars',
									'KH' => 'KH Riels'
								);
								echo form_dropdown('cash_type', $options, set_value('cash_type'), 'id="cash_type" class="form-control input-sm"');
								?>
							</div>
						</div>
					</div>
				</div>
				<?php
				echo form_close();
				?>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading hidden-print">
						<h3 class="panel-title">
							Purchase Information
							<?php
							if ($invoice_items) {
								foreach ($invoice_items as $item) {
									if ($item->cash_receive != '0.00') {
										?>
										<a href="<?php echo base_url(); ?>invoices/print_invoice/<?php echo $item->invoice_number; ?>" class="btn btn-sm btn-info print"
										   title="Print"><span class="glyphicon glyphicon-print"></span> Print</a>
										   <?php
									   }
									   break;
								   }
							   }
							   ?>
						</h3>
					</div>
					<div class="panel-body">
						<?php $this->load->view('invoices/invoice_complete_payment'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
