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
	$.ajax({
		url: "/home/set_home_config", // Your API endpoint here
		method: "GET",
		success: function(response) {
			const parsedResponse = JSON.parse(response);

			// Since the response is an array, access the first element
			if (parsedResponse.length > 0) {
				const config = parsedResponse[0]; // Access the first object in the array
				const color1 = config.color_1;
				const color2 = config.color_2;

				if (color1 && color2) {
					$(":root").css("--theme-color", color1);
					$(":root").css("--theme-color2", color2);
					// console.log("Colors applied:", color1, color2);
				} else {
					console.error("Color values not found in the response.");
				}

				$('#logoImage').attr('src', '<?php echo base_url('/assets/images/logo/'); ?>' + config.logo);
				$('#title').text(config.config_profile_name);
				$('#url_alamat').attr('href', config.url_alamat).text(config.alamat);
				$('#url_kontak').attr('href', config.url_kontak).text(config.kontak);
				$('#url_email').attr('href', config.url_email).text(config.email);
			} else {
				console.error("Empty response array.");
			}
		},
		error: function(error) {
			console.error("Error fetching color:", error);
		},
	});
</script>