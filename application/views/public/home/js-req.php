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

</script>
<script>
	$(document).ready(function() {
		$.ajax({
			url: "/home/set_home_config", // Your API endpoint here
			method: "GET",
			success: function(response) {
				const parsedResponse = JSON.parse(response);
				const color1 = parsedResponse.color_1;
				const color2 = parsedResponse.color_2;

				if (color1 && color2) {
					$(":root").css("--theme-color", color1);
					$(":root").css("--theme-color2", color2);
					console.log("Colors applied:", color1, color2);
				} else {
					console.error("Color values not found in the response.");
				}
				$('#logoImage').attr('src', '<?php echo base_url('/assets/images/logo/'); ?>' + parsedResponse.logo);
				$('#title').text(parsedResponse.config_profile_name);
				$('#url_alamat').attr('href', parsedResponse.url_alamat).text(parsedResponse.alamat);
				$('#url_kontak').attr('href', parsedResponse.url_kontak).text(parsedResponse.kontak);
				$('#url_email').attr('href', parsedResponse.url_email).text(parsedResponse.email);
			},
			error: function(error) {
				console.error("Error fetching color:", error);
			},
		});
		<?php if ($this->session->flashdata('login_success')): ?> Swal.fire({
				icon: 'success',
				title: 'Success',
				text: '<?php echo $this->session->flashdata('login_success'); ?>'
			});
		<?php endif; ?>
		$('#register').on('click', function(e) {
			e.preventDefault();
			const form = document.getElementById('submit');
			const formData = new FormData(form);
			// var judul = $('#judul').val();
			// var isi = $('[name="isiBerita"]').val();
			// var kat = $('#kategori').val();
			// console.log(isi);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('home/simpan_berita') ?>",
				dataType: "JSON",
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					$('[id="judul"]').val("");
					$('#isiBerita').summernote('reset');
					$("#kategori").select2("val", "");
					Swal.fire({
						title: "Data tersimpan!",
						text: "Data anda telah tersimpan",
						icon: "success"
					});
					$('#basicModal').modal('hide');
					$('#tabel-berita').DataTable().ajax.reload();
				},
				error: function(xhr, textStatus, errorThrown) {
					Swal.fire({
						title: "Data tidak tersimpan!",
						text: "Data anda belum tersimpan",
						icon: "error"
					});
				}
			});
			return false;
		});

	});
</script>