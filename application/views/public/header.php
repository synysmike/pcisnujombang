<header class="th-header header-default onepage-nav">
	<div class="menu-top">
		<div class="container">
			<div class="row justify-content-center justify-content-lg-between align-items-center gy-2">
				<div class="col-auto d-none d-lg-block">
					<div class="header-logo">
						<a href="<?php echo base_url(); ?>" class="php">
							<h5>PC ISNU Jombang</h5>
						</a>
						<!-- <a href="index.html"><img src="<?php echo base_url(); ?>assets/public/assets/img/logo.svg" alt="Donat"></a> -->
					</div>
				</div>
				<div class="col-auto d-none d-md-block">
					<div class="info-card-wrap">
						<div class="info-card">
							<div class="box-icon">
								<i class="fal fa-map-marker-alt"></i>
								<div class="bg-shape1" data-mask-src="<?php echo base_url(); ?>assets/public/assets/img/shape/info_card_icon_bg_shape_1_1.png"></div>
								<div class="bg-shape2" data-mask-src="<?php echo base_url(); ?>assets/public/assets/img/shape/info_card_icon_bg_shape_1_1.png"></div>
							</div>
							<div class="box-content">
								<p class="box-text">Alamat Kantor :</p>
								<h4 class="box-title"><a href="https://www.google.com/maps">Jombang, Indonesia</a></h4>
							</div>
						</div>
						<div class="info-card">
							<div class="box-icon">
								<i class="fal fa-phone"></i>
								<div class="bg-shape1" data-mask-src="<?php echo base_url(); ?>assets/public/assets/img/shape/info_card_icon_bg_shape_1_1.png"></div>
								<div class="bg-shape2" data-mask-src="<?php echo base_url(); ?>assets/public/assets/img/shape/info_card_icon_bg_shape_1_1.png"></div>
							</div>
							<div class="box-content">
								<p class="box-text">Kontak Admin:</p>
								<h4 class="box-title"><a href="https://wa.me/6281332444088">Teguh : 081332444088</a></h4>
							</div>
						</div>
						<div class="info-card">
							<div class="box-icon">
								<i class="fal fa-envelope-open"></i>
								<div class="bg-shape1" data-mask-src="<?php echo base_url(); ?>assets/public/assets/img/shape/info_card_icon_bg_shape_1_1.png"></div>
								<div class="bg-shape2" data-mask-src="<?php echo base_url(); ?>assets/public/assets/img/shape/info_card_icon_bg_shape_1_1.png"></div>
							</div>
							<div class="box-content">
								<p class="box-text">Email Kantor:</p>
								<h4 class="box-title"><a href="mailto:irteguh95@hmail.com">irteguh95@hmail.com</a></h4>
							</div>
						</div>
					</div>
				</div>
				<div class="col-auto header-social-col">
					<div class="th-social">
						<a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
						<a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
						<a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
						<a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="sticky-wrapper">
		<!-- Main Menu Area -->
		<div class="container">
			<div class="menu-area">
				<div class="menu-area-wrap">
					<div class="col-auto d-inline-block d-lg-none">
						<div class="header-logo">
							<a href="<?php echo base_url(); ?>" class="php">PC ISNU Jombang</a>
							<!-- <a href="index.html"><img src="<?php echo base_url() . ""; ?>assets/public/assets/img/logo-white.svg" alt="Donat"></a> -->
						</div>
					</div>
					<nav class="main-menu d-none d-lg-block">
						<ul>
							<li class="menu-item-has-children">
								<a href="<?php echo base_url() . 'home' ?>">Home</a>
								<ul class="mega-menu mega-menu-content">

								</ul>

								<?php $seg =  $this->uri->segment(1);
								// echo $seg;
								if ($seg == "" or $seg == "home") {
								?>
							<li><a href="#about-sec">About Us</a></li>
							<li><a href="#donation-sec">Donations</a></li>
							<li><a href="#service-sec">Service</a></li>
							<li><a href="#blog-sec">Blog</a></li>
						<?php
								} else {
									echo "";
								}
						?>
						</li>


						<li>
							<a href="<?php echo base_url() . 'registrasi' ?>">Registrasi Anggota</a>
						</li>
						</ul>
					</nav>
					<p class="header-notice"><img class="me-1" src="<?php echo base_url(); ?>assets/public/assets/img/icon/heart-icon.svg" alt="img">Are you ready to help them? Let’s become a volunteers...</p>
				</div>
				<div class="header-button">
					<button type="button" class="icon-btn style2 searchBoxToggler d-lg-block d-none"><i class="far fa-search"></i></button>
					<!-- <button type="button" class="icon-btn sideMenuToggler">
						<span class="badge">5</span>
						<i class="fa-regular fa-cart-shopping"></i>
					</button> -->
					<!-- <a href="contact.html" class="th-btn style3 d-lg-block d-none"><i class="fas fa-heart me-2"></i> Donate Now</a>
					<button type="button" class="icon-btn th-menu-toggle d-lg-none"><i class="far fa-bars"></i></button> -->
				</div>
			</div>
		</div>
	</div>
</header>