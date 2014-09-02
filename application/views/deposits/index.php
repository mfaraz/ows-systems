<div class="panel-heading">
	<h3 class="panel-title"><?php echo $title; ?></h3>
</div>
<div class="panel-body">
	<?php
	echo $this->session->flashdata('message');
	?>
	<div class="content">
		<div class="filter">
			<?php
			echo form_open('deposits/', 'class="form-inline" role="form"')
			?>
			<div class="form-group">
				<label class="sr-only" for="invoice_number">Invoice Number</label>
				<input type="text" class="form-control input-sm" id="invoice_number" name="invoice_number" value="<?php echo set_value('invoice_number'); ?>" placeholder="Invoice Number" pattern=".{1, 12}" title="Allow enter between 1 to 12 character(s)">
			</div>
			<button type="submit" class="btn btn-primary btn-sm" value="submit" name="submit"><i class="glyphicon glyphicon-filter"></i> Filter</button>
			</form>
		</div>
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>N&ordm;</th>
					<th>Invoice Number</th>
					<th>Cashier</th>
					<th>Customer</th>
					<th>Grand Total</th>
					<th>Deposit</th>
					<th>Remaining</th>
					<th>Deposit Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($deposits):
					$i = 1;
					foreach ($deposits as $deposit):
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $deposit->invoice_number; ?></td>
							<td><?php echo $deposit->firstname; ?></td>
							<td><?php echo $deposit->customer_phone; ?></td>
							<td><?php
								echo $deposit->cash_type == 'US' ? '$' . $deposit->grand_total :
									$deposit->grand_total . '៛';
								?></td>
							<td><?php
								echo $deposit->cash_type == 'US' ? '$' . $deposit->deposit : $deposit->deposit .
									'៛';
								?></td>
							<td><?php echo $deposit->cash_type == 'US' ? '$' . $deposit->balance : $deposit->balance . '៛'; ?></td>
							<td><?php echo mdate('%d-%M-%Y %H:%i', $deposit->crdate); ?></td>
							<td>
								<?php
								echo anchor('invoices/complete_payment/' . $deposit->chash, '<span class="glyphicon
								glyphicon-saved"></span>', 'title="Complete Payment" class="btn btn-warning btn-xs"');
								?>
							</td>
						</tr>
						<?php
					endforeach;
				else:
					echo '<tr><td colspan="9">There is not any deposit.</td></tr>';
				endif;
				?>
			</tbody>
		</table>
	</div>
</div>
