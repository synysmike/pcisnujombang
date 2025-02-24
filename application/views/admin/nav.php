<!-- <style>
	.page-title {
		font-size: 24px;
		font-weight: bold;
		margin: 0;
		margin-left: auto;
		/* Align to the right */
	}
</style> -->
<nav class="navbar navbar-expand-lg main-navbar">
	<form class="form-inline mr-auto">
		<ul class="navbar-nav mr-3">
			<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
		</ul>
	</form>
	<ul class="navbar-nav navbar-right">
		<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
				<img alt="image" src="<?php echo base_url(); ?>assets/admin/img/avatar/avatar-1.png" class="rounded-circle mr-1">
				<div class="d-sm-none d-lg-inline-block">Hi, <?php echo $this->session->userdata('username'); ?></div>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<div class="dropdown-title">Logged in 5 min ago</div>
				<!-- <a href="<?php echo base_url(); ?>dist/features_profile" class="dropdown-item has-icon">
					<i class="far fa-user"></i> Profile
				</a>
				<a href="<?php echo base_url(); ?>dist/features_activities" class="dropdown-item has-icon">
					<i class="fas fa-bolt"></i> Activities
				</a>
				<a href="<?php echo base_url(); ?>dist/features_settings" class="dropdown-item has-icon">
					<i class="fas fa-cog"></i> Settings
				</a> -->
				<div class="dropdown-divider"></div>
				<a href="<?php echo base_url(); ?>logout" class="dropdown-item has-icon text-danger">
					<i class="fas fa-sign-out-alt"></i> Logout
				</a>
			</div>
		</li>
	</ul>
</nav>