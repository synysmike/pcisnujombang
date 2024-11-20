<!doctype html>
<html class="no-js" lang="zxx" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>PC ISNU Kab. Jombang</title>
	<meta name="author" content="Donat">
	<meta name="description" content="Donat - Charity & Donation HTML Template">
	<meta name="keywords" content="Donat - Charity & Donation HTML Template">
	<meta name="robots" content="INDEX,FOLLOW">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Favicons - Place favicon.ico in the root directory -->
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>assets/public/assets/img/favicons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>assets/public/assets/img/favicons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/public/assets/img/favicons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/public/assets/img/favicons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/public/assets/img/favicons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets/public/assets/img/favicons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>assets/public/assets/img/favicons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assets/public/assets/img/favicons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/public/assets/img/favicons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url(); ?>assets/public/assets/img/favicons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/public/assets/img/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assets/public/assets/img/favicons/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/public/assets/img/favicons/favicon-16x16.png">
	<link rel="manifest" href="<?php echo base_url(); ?>assets/public/assets/img/favicons/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo base_url(); ?>assets/public/assets/img/favicons/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<!--==============================
	  Google Fonts
	============================== -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

	<!--==============================
	    All CSS File
	============================== -->

</head>

<body>

	<!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->


	<!--********************************
   		Code Start From Here 
	******************************** -->
	<?php $this->load->view($css); ?>
	<!--==============================
     Preloader
  ==============================-->
	<div class="preloader ">
		<button class="th-btn style2 preloaderCls">Cancel Preloader </button>
		<div class="preloader-inner">
			<span class="loader">
				PC ISNU Jombang
				<span class="loading-text">PC ISNU Jombang</span>
			</span>
		</div>
	</div>
	<?php $this->load->view($mobile_menu); ?>
	<!--==============================
	<div class="color-scheme-wrap active">
		<button class="switchIcon"><i class="fa-solid fa-palette"></i></button>
		<h3 class="color-scheme-wrap-title text-center">Color Switcher</h3>
		<h4 class="color-scheme-wrap-subtitle text-center">Theme Color</h4>
		<div class="color-switch-btns">
			<button data-color="#1A685B"><i class="fa-solid fa-droplet"></i></button>
			<button data-color="#f34e3a"><i class="fa-solid fa-droplet"></i></button>
			<button data-color="#FF4857"><i class="fa-solid fa-droplet"></i></button>
			<button data-color="#3843C1"><i class="fa-solid fa-droplet"></i></button>
			<button data-color="#FF7E02"><i class="fa-solid fa-droplet"></i></button>
		</div>
		<h4 class="color-scheme-wrap-subtitle mt-20 text-center">Secondary Color</h4>
		<div class="secondary-color-switch-btns">
			<button data-secondary-color="#FFAC00"><i class="fa-solid fa-droplet"></i></button>
			<button data-secondary-color="#F41E1E"><i class="fa-solid fa-droplet"></i></button>
			<button data-secondary-color="#f34e3a"><i class="fa-solid fa-droplet"></i></button>
			<button data-secondary-color="#FF4857"><i class="fa-solid fa-droplet"></i></button>
			<button data-secondary-color="#3843C1"><i class="fa-solid fa-droplet"></i></button>
		</div>
	</div> -->

	<?php $this->load->view($header); ?>
	<?php $this->load->view($page); ?>

	<?php $this->load->view($footer); ?>


	<!-- Scroll To Top -->
	<div class="scroll-top">
		<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
			<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
		</svg>
	</div>

	<!--==============================
All Js File
============================== -->
	<?php $this->load->view($js); ?>
</body>

</html>