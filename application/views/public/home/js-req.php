<script src="<?php echo base_url(); ?>assets/public/assets/js/vendor/jquery-3.7.1.min.js"></script>
<!-- Swiper Js -->
<script src="<?php echo base_url(); ?>assets/public/assets/js/swiper-bundle.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>assets/public/assets/js/bootstrap.min.js"></script>
<!-- Magnific Popup -->
<script src="<?php echo base_url(); ?>assets/public/assets/js/jquery.magnific-popup.min.js"></script>
<!-- Counter Up -->
<script src="<?php echo base_url(); ?>assets/public/assets/js/jquery.counterup.min.js"></script>
<!-- Range Slider -->
<script src="<?php echo base_url(); ?>assets/public/assets/js/jquery-ui.min.js"></script>
<!-- Isotope Filter -->
<script src="<?php echo base_url(); ?>assets/public/assets/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>assets/public/assets/js/isotope.pkgd.min.js"></script>



<!-- Main Js File -->
<script src="<?php echo base_url(); ?>assets/public/assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
	// 	<!-- <?php $this->load->view($cta2); ?> -->
	// <!-- <?php $this->load->view($about); ?> -->
	// <!-- <?php $this->load->view($cta1); ?> -->
	// <!-- <?php $this->load->view($donation); ?> -->
	// <!-- <?php $this->load->view($story); ?> -->
	// <!-- <?php $this->load->view($team); ?> -->
	// <!-- <?php $this->load->view($video); ?> -->
	// <!-- <?php $this->load->view($brand); ?> -->

	// <!-- <?php $this->load->view($faq); ?> -->
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true // Enables gallery mode
		},
		callbacks: {
			open: function() {
				console.log("Magnific Popup is working!"); // Optional for debugging
			}
		}
	});

	// Prevent default link behavior
	$('.popup-image').on('click', function(event) {
		event.preventDefault(); // Stops the link from opening in a new tab
	});
</script>
