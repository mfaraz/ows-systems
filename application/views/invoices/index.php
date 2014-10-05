<div class="panel-heading hidden-print">
	<h2 class="panel-title"><?php echo $title; ?></h2>
</div>
<div class="panel-body">
	<?php
	echo $this->session->flashdata('message');
	?>
	<div class="content">
		<div class="filter">
			<?php
			echo form_open('invoices/', 'class="form-inline" role="form"');
			?>
			<div class="form-group">
				<label class="sr-only" for="invoice_number">Invoice Number</label>
				<input type="text" class="form-control input-sm" id="invoice_number" name="invoice_number" value="<?php echo set_value('invoice_number'); ?>" placeholder="Invoice Number" pattern=".{1,12}" title="Allow enter between 1 to 12 character(s)">
			</div>
			<div class="form-group">
				<label class="sr-only" for="customer">Customer</label>
				<input type="text" class="form-control input-sm" id="customer" name="customer" value="<?php echo set_value('customer'); ?>" placeholder="Customer" pattern=".{1,50}" title="Allow enter between 1 to 50 character(s)">
			</div>
			<button type="submit" class="btn btn-primary btn-sm" value="submit" name="submit"><i class="glyphicon glyphicon-filter"></i> Filter</button>
			<?php if ($this->musers->has_login('sess_role') == 1): ?><span class="pull-right">Total Invoice = <span class="badge badge-success"><?php echo $total_invoices; ?></span> Deposit = <span class="badge badge-warning"><?php echo $total_deposits; ?></span></span><?php endif; ?>
			</form>
		</div>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>N&ordm;</th>
					<th>Invoice No</th>
					<th>Cashier</th>
					<th>Customer</th>
					<th>Total</th>
					<th>Deposit</th>
					<th>Remaining</th>
					<th>Invoice or Deposit<br /> Date</th>
					<th>Complete Payment<br /> Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($invoices) {
					$i = 1;
					if ($this->musers->has_login('sess_role') != 1) {
						foreach ($invoices->result() as $invoice) {
							$expired = ceil(abs(time() - $invoice->modate) / 86400);
							if ($expired <= 3) {
								?>
								<tr <?php echo $invoice->deposit != '0.00' ? 'class="warning"' : ''; ?>>
									<td><?php echo $i++; ?></td>
									<td><?php echo $invoice->invoice_number; ?></td>
									<td><?php echo $invoice->cashier; ?></td>
									<td><?php echo $invoice->customer; ?></td>
									<td><?php
										echo $invoice->cash_type == 'US' ? '$' . $invoice->grand_total :
											$invoice->grand_total . '៛';
										?></td>
									<td><?php
										if ($invoice->deposit != '0.00') {
											echo $invoice->cash_type == 'US' ? '$' . $invoice->deposit : $invoice->deposit .
												'៛';
										} else {
											echo '---';
										}
										?></td>
									<td><?php
										if ($invoice->balance != '0.00') {
											echo $invoice->cash_type == 'US' ? '$' . $invoice->balance : $invoice->balance . '៛';
										} else {
											echo '---';
										}
										?></td>
									<td><?php echo mdate('%d-%M-%Y %H:%i', $invoice->crdate); ?></td>
									<td><?php echo $invoice->modate != 0 ? mdate('%d-%M-%Y %H:%i', $invoice->modate) : '---'; ?></td>
									<td>
										<?php
										if ($invoice->deposit != '0.00') {
											echo anchor('sales/returnable/' . $invoice->chash, '<span class="glyphicon
								glyphicon-saved"></span>', 'title="Returnable" class="btn btn-warning btn-xs" disabled="disabled"');
										} else {
											$expired = ceil(abs(time() - $invoice->modate) / 86400);
											echo anchor('sales/returnable/' . $invoice->chash, '<span class="glyphicon
								glyphicon-saved"></span>', 'title="Returnable" class="btn btn-warning btn-xs"' . ($expired > 3 ? 'disabled="disabled"' : ''));
										}
										?>
									</td>
								</tr>
								<?php
							}
						}
					} else {
						foreach ($invoices->result() as $invoice) {
							?>
							<tr <?php echo $invoice->deposit != '0.00' ? 'class="warning"' : ''; ?>>
								<td><?php echo $i++; ?></td>
								<td><?php echo $invoice->invoice_number; ?></td>
								<td><?php echo $invoice->cashier; ?></td>
								<td><?php echo $invoice->customer; ?></td>
								<td><?php
									echo $invoice->cash_type == 'US' ? '$' . $invoice->grand_total :
										$invoice->grand_total . '៛';
									?></td>
								<td><?php
									if ($invoice->deposit != '0.00') {
										echo $invoice->cash_type == 'US' ? '$' . $invoice->deposit : $invoice->deposit .
											'៛';
									} else {
										echo '---';
									}
									?></td>
								<td><?php
									if ($invoice->balance != '0.00') {
										echo $invoice->cash_type == 'US' ? '$' . $invoice->balance : $invoice->balance . '៛';
									} else {
										echo '---';
									}
									?></td>
								<td><?php echo mdate('%d-%M-%Y %H:%i', $invoice->crdate); ?></td>
								<td><?php echo $invoice->modate != 0 ? mdate('%d-%M-%Y %H:%i', $invoice->modate) : '---'; ?></td>
								<td>
									<?php
									if ($invoice->deposit != '0.00') {
										echo anchor('sales/returnable/' . $invoice->chash, '<span class="glyphicon
								glyphicon-saved"></span>', 'title="Returnable" class="btn btn-warning btn-xs" disabled="disabled"');
									} else {
										$expired = ceil(abs(time() - $invoice->modate) / 86400);
										echo anchor('sales/returnable/' . $invoice->chash, '<span class="glyphicon
								glyphicon-saved"></span>', 'title="Returnable" class="btn btn-warning btn-xs"' . ($expired > 3 ? 'disabled="disabled"' : ''));
									}
									?>
								</td>
							</tr>
							<?php
						}
					}
				} else {
					echo '<tr><td colspan="9">There is not any deposit.</td></tr>';
				}
				?>
			</tbody>
		</table>
	</div>
	<?php
	//page_browser(base_url() . 'invoices/index/', $total_invoices, 2);
	echo $this->pagination->create_links();
	?>
</div>
