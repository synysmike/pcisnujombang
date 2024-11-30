<style>
	.page-title {
		font-size: 24px;
		font-weight: bold;
		margin: 0;
		margin-left: auto;
		/* Align to the right */
	}
</style>
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
	<div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
		<a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
			<i class="bx bx-menu bx-md"></i>
		</a>
	</div>
	<div class="navbar-nav-right d-flex align-items-center justify-content-between w-100" id="navbar-collapse">
		<div class="navbar-nav align-items-center">
			<div class="nav-item d-flex align-items-center">
				<h1 class="page-title"><?php echo $this->session->userdata('username'); ?></h1>
			</div>
		</div>
	</div>
</nav>