<!doctype html>

<html
	lang="en"
	class="light-style layout-menu-fixed layout-compact"
	dir="ltr"
	data-theme="theme-default"
	data-assets-path="<?php echo base_url(); ?>assets/admin/assets/"
	data-template="vertical-menu-template-free"
	data-style="light">

<head>
	<meta charset="utf-8" />
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

	<title>CRUD PCisnuJombang | Ir.Teguh</title>

	<meta name="description" content="" />

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/admin/assets/img/favicon/favicon.ico" />

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap"
		rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/modules/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/modules/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/components.css">

	<?php
	$css = $css;
	$this->load->view($css); ?>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/custom.css">
</head>

<body class="sidebar-mini">
	<!-- Layout wrapper -->
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<div class="navbar-bg"></div>
			<?php $this->load->view('admin/nav'); ?>
			<div class="main-sidebar">
				<?php $this->load->view('admin/sidebar'); ?>
			</div>
			<!-- / Menu -->

			<!-- Layout container -->
			<div class="layout-page">
				<div class="main-content">
					<section class="section">
						<div class="section-body">
							<?php $ct = $ct;
							$this->load->view($ct); ?>
						</div>
					</section>
				</div>

				<!-- / Content -->



				<!-- Footer -->
				<footer class="content-footer footer bg-footer-theme">
					<div class="container-xxl">
						<div
							class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
							<div class="text-body">
								©
								<script>
									document.write(new Date().getFullYear());
								</script>
								, made with ❤️ by
								<a href="https://github.com/synysmike/" target="_blank" class="footer-link">Ir.Teguh</a>
							</div>
						</div>
					</div>
				</footer>
				<!-- / Footer -->

				<div class="content-backdrop fade"></div>
			</div>
			<!-- Content wrapper -->
		</div>
		<!-- / Layout page -->
	</div>

	<!-- Overlay -->
	<div class="layout-overlay layout-menu-toggle"></div>
	</div>
	<!-- / Layout wrapper -->


	<script src="<?php echo base_url(); ?>assets/admin/modules/jquery.min.js"></script>

	<script src="<?php echo base_url(); ?>assets/admin/modules/popper.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/modules/tooltip.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/modules/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/modules/nicescroll/jquery.nicescroll.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/modules/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/js/stisla.js"></script>
	<!-- Template JS File -->
	<?php $js = $js;
	$this->load->view($js); ?>
	<script src="<?php echo base_url(); ?>assets/admin/js/scripts.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/js/custom.js"></script>
</body>

</html>