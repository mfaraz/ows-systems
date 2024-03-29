﻿<div class="print-invoice">
	<?php
	if ($invoice_items) {
		foreach ($invoice_items as $item) {
			$customer = $item->customer ? $item->customer : '?';
			$cashier = $this->musers->has_login('sess_fullname');
			$invoice_date = $item->modate != 0 ? mdate('%d-%m-%Y %H:%i', $item->modate) : '?';
			$invoice_number = $item->invoice_number;
			if ($item->cash_type == 'US') {
				$grand_total = $item->grand_total !== '0.00' ? '$' . $item->grand_total : '0.00';
				$deposit = $item->deposit !== '0.00' ? '$' . $item->deposit : '0.00';
				$balance = $item->balance !== '0.00' ? '$' . $item->balance : '0.00';
				$cash_receive = $item->cash_receive !== '0.00' ? '$' . $item->cash_receive : '0.00';
				$cash_exchange = $item->cash_exchange !== '0.00' ? '$' . $item->cash_exchange : '0.00';
			} else {
				$grand_total = $item->grand_total !== '0.00' ? $item->grand_total . '៛' : '0.00';
				$deposit = $item->deposit !== '0.00' ? $item->deposit . '៛' : '0.00';
				$balance = $item->balance !== '0.00' ? $item->balance . '៛' : '0.00';
				$cash_receive = $item->cash_receive !== '0.00' ? $item->cash_receive . '៛' : '0.00';
				$cash_exchange = $item->cash_exchange !== '0.00' ? $item->cash_exchange . '៛' : '0.00';
			}
			break;
		}
		?>
		<table class="table table-header">
			<caption>
				<?php echo img(array('src' => IMG_PATH . $this->msettings->display_setting('DEFAULT_COMPANY_LOGO'), 'align' => 'center')) . br(1); ?>
				<?php echo$this->msettings->display_setting('DEFAULT_COMPANY_ADDRESS') . br(); ?>
				<strong><?php echo $this->msettings->display_setting('DEFAULT_COMPANY_PHONE'); ?></strong>
			</caption>
			<tr>
				<td colspan="2" class="hidden-print align-left" style="width: 50%;">
					Cashier: <?php echo $cashier; ?><br>
					Customer: <?php echo $customer ?>
				</td>
				<td colspan="2" class="visible-print align-left" style="width: 50%;">
					Cashier: <?php echo $cashier; ?><br>
					Customer: <?php echo $customer ?>
				</td>
				<td colspan="2" class="align-left">
					Date: <?php echo $invoice_date; ?><br>
					N&ordm;: <?php echo $invoice_number; ?>
				</td>
			</tr>
		</table>
		<table class="table table-striped table-hover print" style="margin-bottom: 0;">
			<thead>
				<tr>
					<th>N&ordm;</th>
					<th>Description</th>
					<th>Total</th>
					<th>Deposit</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>Complete Payment</td>
					<td><?php echo $grand_total; ?></td>
					<td><?php echo $deposit; ?></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
					<td class="align-left">
						<?php
						if ($balance != '0.00') {
							echo '<strong>Remaining</strong>:<br>';
						}
						if ($cash_receive != '0.00') {
							echo 'Cash Received:<br>';
						}
						if ($cash_exchange != '0.00') {
							echo 'Exchange:';
						}
						?>
					</td>
					<td>
						<?php
						if ($balance != '0.00') {
							echo '<strong>' . $balance . '</strong><br>';
						}
						if ($cash_receive != '0.00') {
							echo $cash_receive . '<br>';
						}
						if ($cash_exchange != '0.00') {
							echo $cash_exchange;
						}
						?>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="table table-header">
			<tr>
				<td>
					សូមអរគុណ សូមអញ្ជើញមកម្ដងទៀត <br />
					Thank you, please come again!<br />
					ទំនិញទិញហើយមិនអាចប្ដូរវិញបានទេ <br />
					Goods sold not returnable
				</td>
			</tr>
		</table>
	<?php } else { ?>
		<p>There is not any purchase product yet!</p>
	<?php } ?>
</div>
