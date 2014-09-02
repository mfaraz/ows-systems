<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<nav class="navbar-collapse collapse">
			<ul class="nav navbar-nav pull-left">
				<?php if ($this->session->userdata('mul_welcome')): ?>
					<li class="<?php echo $this->uri->segment(1) == 'welcome' ? 'active' : '' ?>">
						<?php
						echo anchor('welcome/', '<i class="fa fa-home fa-3x"></i>Home', 'title="Dashboard"');
						?>
					</li>
					<?php
				endif;
				if ($this->session->userdata('mul_sales')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'sales' ? 'active' : '' ?>">
						<?php
						echo anchor('sales/', '<i class="fa fa-shopping-cart fa-3x"></i>Sales', 'title="Sales"');
						?>
					</li>
					<?php
				endif;
				if ($this->session->userdata('mul_deposits')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'deposits' ? 'active' : '' ?>">
						<?php
						echo anchor('deposits/', '<i class="fa fa-history fa-3x"></i>Deposits', 'title="Deposits"');
						?>
					</li>
				<?php
				endif;
				if ($this->session->userdata('mul_products')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'products' ? 'active' : '' ?>">
						<?php
						echo anchor('products/', '<i class="fa fa-database fa-3x"></i>Products', 'title="Products"');
						?>
					</li>
					<?php
				endif;
				if ($this->session->userdata('mul_categories')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'categories' ? 'active' : '' ?>">
						<?php
						echo anchor('categories/', '<i class="fa fa-cubes fa-3x"></i>Categories', 'title="Categories"');
						?>
					</li>
					<?php
				endif;
				if ($this->session->userdata('mul_reports')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'reports' ? 'active' : '' ?>">
						<?php
						echo anchor('reports/', '<i class="fa fa-bar-chart-o fa-3x"></i>Reports', 'title="Reports"');
						?>
					</li>
					<?php
				endif;
				if ($this->session->userdata('mul_users')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'users' ? 'active' : '' ?>">
						<?php
						echo anchor('users/', '<i class="fa fa-users fa-3x"></i>Users', 'title="Users"');
						?>
					</li>
					<?php
				endif;
				if ($this->session->userdata('mul_settings')):
					?>
					<li class="<?php echo $this->uri->segment(1) == 'settings' ? 'active' : '' ?>">
						<?php
						echo anchor('settings/', '<i class="fa fa-gear fa-3x"></i>Settings', 'title="Settings"');
						?>
					</li>
				<?php endif; ?>
			</ul>
			<ul class="nav navbar-nav pull-right">
				<li>
					<a>
						<?php
						echo $this->session->userdata('username') ? $this->session->userdata('fullname') . '(' . $this->session->userdata('role') . ')' : NULL;
						?>
					</a>
				</li>
				<li><?php echo anchor('login/logout/', '<i class="fa fa-sign-out fa-3x"></i>Sign Out', 'title = "Sign Out"'); ?></li>
			</ul>
		</nav>
	</div>
</div>
