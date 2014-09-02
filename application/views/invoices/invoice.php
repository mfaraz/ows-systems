<div class="print-invoice">
	<?php
	if ($invoice_items) {
		foreach ($invoice_items as $item) {
			$customer_phone = $item->customer_phone ? $item->customer_phone : '?';
			$cashier = $this->session->userdata('ci_firstname');
			$invoice_date = mdate('%d-%m-%Y %H:%i', $item->crdate);
			$invoice_number = $item->invoice_number;
			$discount = $item->discount !== '0' ? $item->discount . '%' : '0';
			if ($item->cash_type == 'US') {
				$total = $item->total !== '0.00' ? '$' . $item->total : '0.00';
				$grand_total = $item->grand_total !== '0.00' ? '$' . $item->grand_total : '0.00';
				$deposit = $item->deposit !== '0.00' ? '$' . $item->deposit : '0.00';
				$balance = $item->balance !== '0.00' ? '$' . $item->balance : '0.00';
				$cash_receive = $item->cash_receive !== '0.00' ? '$' . $item->cash_receive : '0.00';
				$cash_exchange = $item->cash_exchange !== '0.00' ? '$' . $item->cash_exchange : '0.00';
			} else {
				$total = $item->total !== '0.00' ? $item->total . '៛' : '0.00';
				$grand_total = $item->grand_total !== '0.00' ? $item->grand_total . '៛' : '0.00';
				$deposit = $item->deposit !== '0.00' ? $item->deposit . '៛' : '0.00';
				$balance = $item->balance !== '0.00' ? $item->balance . '៛' : '0.00';
				$cash_receive = $item->cash_receive !== '0.00' ? $item->cash_receive . '៛' : '0.00';
				$cash_exchange = $item->cash_exchange !== '0.00' ? $item->cash_exchange . '៛' : '0.00';
			}
			break;
		}
		$i = 1;
		?>
		<table class="table table-header">
			<caption>
				<?php echo img(array('src' => IMG_PATH . 'logo.jpg', 'align' => 'center')) . br(1); ?>
				<?php echo COMPANY_ADDRESS . br(); ?>
				<strong><?php echo COMPANY_PHONE; ?></strong>
			</caption>
			<tr>
				<td colspan="2" class="hidden-print align-left" style="width: 50%;">
					Cashier: <?php echo $cashier; ?><br>
					Customer: <?php echo $customer_phone ?>
				</td>
				<td colspan="2" class="visible-print align-left" style="width: 50%;">
					Cashier: <?php echo $cashier; ?><br>
					Customer: <?php echo $customer_phone ?>
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
					<th>Qty</th>
					<th>Price</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($invoice_items as $item) { ?>
					<tr>
						<td class="align-left"><?php echo $i++; ?></td>
						<td class="align-left">&nbsp;<?php echo $item->name; ?></td>
						<td><?php echo $item->qty; ?></td>
						<td><?php echo '$' . $item->unit_price; ?></td>
						<td class="align-right"><?php echo '$' . $item->sub_total; ?></td>
					</tr>
				<?php } ?>
				<tr>
					<td colspan="3">&nbsp;</td>
					<td class="align-left">
						<?php
						if ($cash_receive == '0.00') {
							echo 'Total:';
						}
						if ($total !== '0.00' && $discount !== '0') {
							echo 'Sub Total:<br>';
						}
						if ($discount !== '0') {
							echo 'Discount:<br>';
						}
						if ($grand_total != '0.00') {
							echo 'Grand Total:<br>';
						}
						if ($deposit != '0.00') {
							echo 'Deposit:<br>';
						}
						if ($cash_receive != '0.00') {
							echo 'Paid Amount:<br>';
						}
						if ($balance != '0.00') {
							echo 'Remaining:<br>';
						}
						if ($cash_exchange != '0.00') {
							echo 'Exchange:';
						}
						?>
					</td>
					<td class="align-right">
						<?php
						if ($cash_receive == '0.00') {
							echo '$' . $sub_total;
						}
						if ($total !== '0.00' && $discount !== '0') {
							echo $total . '<br>';
						}
						if ($discount !== '0') {
							echo $discount . '<br>';
						}
						if ($grand_total != '0.00') {
							echo $grand_total . '<br>';
						}
						if ($deposit != '0.00') {
							echo $deposit . '<br>';
						}
						if ($cash_receive != '0.00') {
							echo $cash_receive . '<br>';
						}
						if ($balance != '0.00') {
							echo $balance . '<br>';
						}
						if ($cash_exchange != '0.00') {
							echo $cash_exchange;
						}
						?>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="table table-header visible-print">
			<tr>
				<td>
					Thanks you for shopping at our shop, please come again
				</td>
			</tr>
		</table>
		<div class="only-invoice-number visible-print">
			<span>
				Invoice Number: <?php echo $invoice_number; ?>
			</span>
		</div>
	<?php } else { ?>
		<p>There is not any purchase product yet!</p>
	<?php } ?>
</div>
