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
		href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
		rel="stylesheet" />

	<?php
	$css = $css;
	$this->load->view($css); ?>
</head>




<body>
	<!-- Layout wrapper -->
	<div class="layout-wrapper layout-content-navbar">
		<div class="layout-container">
			<!-- Menu -->

			<?php $this->load->view('admin/sidebar'); ?>
			<!-- / Menu -->

			<!-- Layout container -->
			<div class="layout-page">
				<!-- Navbar -->

				<?php $this->load->view('admin/nav'); ?>

				<!-- / Navbar -->
				<div class="content-wrapper">

					<!-- Content -->

					<div class="container-xxl flex-grow-1 container-p-y">


						<div class="row flex-xl-nowrap">
							<div class="DocSearch-content col-12 col-xl-12 container-p-y">

								<!-- Content wrapper -->
								<hr class="my-12" />

								<?php $ct = $ct;
								$this->load->view($ct); ?>


							</div>
						</div>
					</div>
					<!-- Content -->

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



	<?php $js = $js;
	$this->load->view($js); ?>
</body>

</html>