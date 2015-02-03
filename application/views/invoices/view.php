<div class="panel-heading">
	<h2 class="panel-title">Invoice Number: <?php echo $this->uri->segment(3); ?></h2>
</div>
<div class="panel-body">
	<div class="content">
		<div class="btn-toolbar">
			<a href="http://local.ows.itservices.com/invoices/" class="btn btn-sm btn-danger" title=""
			   data-original-title=""><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
		</div>
		<table class="table table-hover table-bordered table-striped">
			<thead>
			<tr>
				<th>N&ordm;</th>
				<th>Description</th>
				<th>Quality</th>
				<th>Unit Price</th>
				<th>Amount</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$i = 1;
			if ($invoices) {
				foreach ($invoices->result() as $invoice) {
					echo '<tr>'
						. '<td>' . $i++ . '</td>'
						. '<td>' . $invoice->product_name . '</td>'
						. '<td>' . $invoice->quality . '</td>'
						. '<td>$' . $invoice->unit_price . ' </td>'
						. '<td>$' . $invoice->sub_total . '</td>'
						. '</tr>';
				}
			}
			?>
			</tbody>
		</table>
	</div>
</div>