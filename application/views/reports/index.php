<div class="panel-heading">
	<h3 class="panel-title"><?php echo $title; ?></h3>
</div>
<div class="panel-body">
	<div class="content">
		<div class="filter">
			<?php
			echo form_open('reports/', 'class="form-inline" role="form"');
			?>
			<div class="form-group">
				<input type="text" class="form-control input-sm" id="date" name="date" value="<?php
				echo
				set_value('date', mdate('%d-%m-%Y'));
				?>" pattern=".{10}" />
			</div>
			<div class="form-group">
				<?php echo form_dropdown('type', array('daily' => 'Daily', 'monthly' => 'Monthly', 'yearly' => 'Yearly'), set_value('type'), 'class="form-control input-sm"') ?>
			</div>
			<div class="form-group">
				<?php
				if ($cashiers) {
					?>
					<select name="cashier" class="form-control input-sm">
						<option value="">--cashier--</option>
						<?php
						foreach ($cashiers as $cashier) {
							echo '<option value="' . $cashier->firstname . '" ' . set_select('cashier', $cashier->firstname) . '>' . $cashier->firstname . '</option>';
						}
						?>
					</select>
					<?php
				}
				?>
			</div>
			<div class="form-group">
				<?php
				if ($categories) {
					echo form_dropdown('category', array('' => '--category--') + $categories, set_value('category'), 'class="form-control input-sm" id="category"');
				}
				?>
			</div>
			<div class="form-group">
				<?php
				if ($brands) {
					echo form_dropdown('brand', array('' => '--brand--') + $brands, set_value('brand'), 'class="form-control input-sm" id="brand"');
				}
				?>
			</div>
			<button type="submit" class="btn btn-primary btn-sm" value="submit" name="submit"><i class="glyphicon glyphicon-filter"></i> Filter</button>
			</form>
		</div>
		<?php
		if ($this->session->userdata('type') == 'daily' || !$this->session->userdata('type')) {
			$this->load->view('reports/partials/daily');
		} elseif ($this->session->userdata('type') == 'monthly') {
			$this->load->view('reports/partials/monthly');
		} elseif ($this->session->userdata('type') == 'yearly') {
			$this->load->view('reports/partials/yearly');
		}
		?>
	</div>
	<?php
	echo $this->pagination->create_links();
	?>
</div>
