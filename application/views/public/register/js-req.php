<!-- Jquery -->
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

<script>
	$(document).ready(function() {
		// Fetch Kab./Kota options from the server 
		$.ajax({
			url: '<?php echo site_url('registrasi/get_kabkota'); ?>',
			type: 'GET',
			dataType: 'json',
			// Ensure the response is parsed as JSON 
			success: function(response) {
				// console.log(response);
				// Debugging: log the response 
				var kabkotaSelect = $('#kab_kota');
				kabkotaSelect.append('<option>--Pilih Kab./Kota--</option>')
				response.forEach(function(kabkota) {
					kabkotaSelect.append('<option value="' + kabkota.id + '">' + kabkota.kabkot + '</option>');
				});
			},
			error: function(xhr, status, error) {
				console.error('Error fetching Kab./Kota:', status, error); // Debugging: log the error 
			}
		});




		$('#registerForm').on('submit', function(e) {
			e.preventDefault(); // Prevent the default form submission

			$.ajax({
				url: '<?php echo site_url('registrasi/save'); ?>',
				type: 'POST',
				data: $(this).serialize(),
				success: function(response) {
					Swal.fire({
						icon: 'success',
						title: 'Success',
						text: 'Registration successful!'
					}).then(function() {
						window.location.href = '<?php echo site_url('home'); ?>';
					});
				},
				error: function() {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Registration failed. Please try again.'
					});
				}
			});
		});
	});
</script>