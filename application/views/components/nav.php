<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<nav class="navbar-collapse collapse">
			<ul class="nav navbar-nav pull-left">
				<?php
				$isSelling = '';
				if ($this->msales->check_purchase() || $this->session->userdata('returnable')) {
					$isSelling = 'disabled';
				}
				if ($this->musers->has_login('mul_sales')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'sales' ? 'active' : '' ?>">
						<?php
						echo anchor('sales/', '<i class="fa fa-shopping-cart fa-3x"></i>Sales', 'title="Sales"');
						?>
					</li>
					<?php
				endif;
				if ($this->musers->has_login('mul_deposits')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'deposits' ? 'active' : '' ?>">
						<?php
						echo anchor('deposits/', '<i class="fa fa-history fa-3x"></i>Deposits', 'title="Deposits" class="' . $isSelling . '"');
						?>
					</li>
					<?php
				endif;
				if ($this->musers->has_login('mul_products')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'products' ? 'active' : '' ?>">
						<?php
						echo anchor('products/', '<i class="fa fa-database fa-3x"></i>Products', 'title="Products" class="' . $isSelling . '"');
						?>
					</li>
					<?php
				endif;
				if ($this->musers->has_login('mul_categories')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'categories' ? 'active' : '' ?>">
						<?php
						echo anchor('categories/', '<i class="fa fa-cubes fa-3x"></i>Categories', 'title="Categories" class="' . $isSelling . '"');
						?>
					</li>
					<?php
				endif;
				if ($this->musers->has_login('mul_invoices')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'invoices' ? 'active' : '' ?>">
						<?php
						echo anchor('invoices/', '<i class="fa fa-file-text-o fa-3x"></i>Invoices', 'title="Invoices" class="' . $isSelling . '"');
						?>
					</li>
					<?php
				endif;
				if ($this->musers->has_login('mul_reports')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'reports' ? 'active' : '' ?>">
						<?php
						echo anchor('reports/', '<i class="fa fa-bar-chart-o fa-3x"></i>Reports', 'title="Reports" class="' . $isSelling . '"');
						?>
					</li>
					<?php
				endif;
				if ($this->musers->has_login('mul_users')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'users' ? 'active' : '' ?>">
						<?php
						echo anchor('users/', '<i class="fa fa-users fa-3x"></i>Users', 'title="Users" class="' . $isSelling . '"');
						?>
					</li>
					<?php
				endif;
				if ($this->musers->has_login('mul_settings')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'settings' ? 'active' : '' ?>">
						<?php
						echo anchor('settings/', '<i class="fa fa-gear fa-3x"></i>Settings', 'title="Settings" class="' . $isSelling . '"');
						?>
					</li>
				<?php endif; ?>
			</ul>
			<ul class="nav navbar-nav pull-right">
				<li><?php echo anchor('login/logout/', '<i class="fa fa-sign-out fa-3x"></i>Sign Out', 'title = "Sign Out" class="' . $isSelling . '"'); ?></li>
			</ul>
		</nav>
	</div>
</div>
