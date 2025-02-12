<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/libs/popper/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/js/menu.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url(); ?>assets/admin/magnify-master/dist/jquery.magnify.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/assets/js/main.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script>
	$(document).ready(function() {
		var table = $('#configTable').DataTable({
			ajax: {
				url: '<?php echo base_url("home/get_all_config"); ?>',
				dataSrc: function(json) {
					return json.data;
				},
				cache: false // Enable cache-busting parameter
			},
			columns: [{
					data: 'config_profile_name'
				},
				{
					data: 'color_1',
					render: function(data, type, row) {
						return `<div style="width: 40px; height: 40px; background-color: ${data};"></div>`;
					}
				},
				{
					data: 'color_2',
					render: function(data, type, row) {
						return `<div style="width: 40px; height: 40px; background-color: ${data};"></div>`;
					}
				},
				{
					data: 'array_of_id_section'
				},
				{
					data: 'array_of_id_carousel'
				},
				{
					data: 'date_of_creation'
				},
				{
					data: 'alamat'
				},
				{
					data: 'kontak'
				},
				{
					data: 'email'
				},
				{
					data: null,
					render: function(data, type, row) {
						return `
                        <button class="btn btn-sm btn-primary edit-btn" data-id="${row.id}">Edit</button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">Delete</button>
                    `;
					}
				}
			],
			responsive: true,
			dom: '<"top"f>rt<"bottom"lp><"clear">',
			initComplete: function() {
				$("#configTable_wrapper .top").append('<button type="button" class="btn btn-primary ml-3" data-bs-toggle="modal" data-bs-target="#contactModal">Add Contact</button>');
				$("#configTable_wrapper .top").append('<button type="button" class="btn btn-secondary ml-3" data-bs-toggle="modal" data-bs-target="#carouselModal">Add Carousel</button>');
			},
			language: {
				search: "_INPUT_",
				searchPlaceholder: "Search..."
			},
			buttons: [{
					extend: 'copy',
					className: 'btn btn-secondary'
				},
				{
					extend: 'csv',
					className: 'btn btn-secondary'
				},
				{
					extend: 'excel',
					className: 'btn btn-secondary'
				},
				{
					extend: 'pdf',
					className: 'btn btn-secondary'
				},
				{
					extend: 'print',
					className: 'btn btn-secondary'
				}
			]
		});
		table.buttons().container().appendTo('#configTable_wrapper .col-md-6:eq(0)');

		$('#configTable').on('click', '.edit-btn', function() {
			var id = $(this).data('id');
			$.ajax({
				url: '<?php echo base_url("home/get_config"); ?>/' + id,
				type: 'GET',
				success: function(response) {
					// Parse the response as JSON
					var data = JSON.parse(response);
					// Populate the form fields with the response data
					$('#contactForm').find('input[name="id"]').val(data.id);
					$('#contactForm').find('input[name="nama_config"]').val(data.config_profile_name);
					$('#contactForm').find('input[name="alamat"]').val(data.alamat);
					$('#contactForm').find('input[name="kontak"]').val(data.kontak);
					$('#contactForm').find('input[name="email"]').val(data.email);
					$('#contactForm').find('input[name="color_1"]').val(data.color_1);
					$('#contactForm').find('input[name="color_2"]').val(data.color_2);
					$('#contactForm').find('select[name="section[]"]').val(data.array_of_id_section).trigger('change');
					$('#contactForm').find('select[name="carousel[]"]').val(data.array_of_id_carousel).trigger('change');
					$('#contactModal').modal('show');
				},
				error: function(response) {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Failed to fetch contact details!'
					});
				}
			});
		});

		$('#configTable').on('click', '.delete-btn', function() {
			var id = $(this).data('id');
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?php echo base_url("home/delete"); ?>/' + id,
						type: 'DELETE',
						success: function(response) {
							table.ajax.reload(); // Reload the DataTable
							Swal.fire({
								icon: 'success',
								title: 'Deleted!',
								text: 'Contact has been deleted.'
							});
						},
						error: function(response) {
							Swal.fire({
								icon: 'error',
								title: 'Error',
								text: 'Failed to delete contact!'
							});
						}
					});
				}
			});
		});

		initializeSelect2('#section');
		initializeSelect2('#carousel');
		$('#contactForm').on('submit', function(e) {
			e.preventDefault();
			var formData = $(this).serialize();
			var id = $('#contactForm').find('input[name="id"]').val();
			var url = id ? '<?php echo base_url("home/edit"); ?>/' + id : '<?php echo base_url("home/create"); ?>';
			$.ajax({
				type: 'POST',
				url: url,
				data: formData,
				success: function(response) {
					// Handle success response
					$('#contactModal').modal('hide');
					table.ajax.reload(); // Reload the DataTable
					Swal.fire({
						icon: 'success',
						title: 'Success',
						text: id ? 'Contact updated successfully!' : 'Contact added successfully!'
					});
				},
				error: function(response) {
					// Handle error response
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: id ? 'Failed to update contact!' : 'Failed to add contact!'
					});
				}
			});
		});

		$('#carouselModal').on('show.bs.modal', function() {
			$.ajax({
				url: '<?php echo base_url("home/get_all_carousels"); ?>',
				type: 'GET',
				success: function(response) {
					// Handle the response data
					var data = JSON.parse(response);
					// Populate the carousel table with the response data
					carouselTable.clear().rows.add(data.data).draw();
				},
				error: function(response) {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Failed to fetch carousel data!'
					});
				}
			});
		});

		var carouselTable = $('#carouselTable').DataTable({
			ajax: {
				url: '<?php echo base_url("home/get_all_carousels"); ?>',
				type: 'GET',
				dataSrc: function(json) {
					return json.data;
				},
				cache: false // Enable cache-busting parameter
			},
			columns: [{
					data: 'title'
				},
				{
					data: 'description'
				},
				{
					data: 'picture'
				},
				{
					data: 'created_at'
				},
				{
					data: null,
					render: function(data, type, row) {
						return `
                        <button class="btn btn-sm btn-primary edit-carousel-btn" data-id="${row.id}">Edit</button>
                        <button class="btn btn-sm btn-danger delete-carousel-btn" data-id="${row.id}">Delete</button>
                    `;
					}
				}
			],
			responsive: true,
			dom: '<"top"f>rt<"bottom"lp><"clear">',
			language: {
				search: "_INPUT_",
				searchPlaceholder: "Search..."
			}
		});

		$('#carouselTable').on('click', '.edit-carousel-btn', function() {
			var id = $(this).data('id');
			$.ajax({
				url: '<?php echo base_url("home/get_carousel"); ?>/' + id,
				type: 'GET',
				success: function(response) {
					// Parse the response as JSON
					var data = JSON.parse(response);
					// Populate the form fields with the response data
					$('#carouselForm').find('input[name="title"]').val(data.title);
					$('#carouselForm').find('textarea[name="description"]').val(data.description);
					$('#carouselForm').find('input[name="picture"]').val(data.picture);
					$('#carouselForm').append('<input type="hidden" name="id" value="' + data.id + '">');

					$('#carouselModal').on('hidden.bs.modal', function() {
						$('#carouselForm').find('input[name="id"]').remove();
					});
					$('#carouselModal').modal('show');
				},
				error: function(response) {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Failed to fetch carousel details!'
					});
				}
			});
		});

		$('#carouselForm').on('submit', function(e) {
			e.preventDefault();
			console.log('submit');
			var formData = new FormData(this); // Use FormData to handle file uploads
			var id = $('#carouselForm').find('input[name="id"]').val();
			var url = id ? '<?php echo base_url("home/edit_carousel"); ?>/' + id : '<?php echo base_url("home/store_carousel"); ?>';
			$.ajax({
				type: 'POST',
				url: url,
				data: formData,
				processData: false, // Prevent jQuery from automatically transforming the data into a query string
				contentType: false, // Set the content type to false to let the browser set it
				success: function(response) {
					// Handle success response
					$('#carouselModal').modal('hide');
					carouselTable.ajax.reload(); // Reload the DataTable
					Swal.fire({
						icon: 'success',
						title: 'Success',
						text: id ? 'Carousel updated successfully!' : 'Carousel added successfully!'
					});
				},
				error: function(response) {
					// Handle error response
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: id ? 'Failed to update carousel!' : 'Failed to add carousel!'
					});
				}
			});
		});
	});

	function initializeSelect2(selector) {
		$(selector).select2({
			theme: 'bootstrap-5'
		});
	}
</script>