<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url(); ?>assets/admin/magnify-master/dist/jquery.magnify.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>


<script>
	$(document).ready(function() {
		// Initialize the DataTable and add the responsive class for config-home
		var table = $('#configTable').DataTable({
			ajax: {
				url: '<?php echo base_url("home/get_all_config"); ?>',
				dataSrc: function(json) {
					return json.data;
				},
				cache: false // Enable cache-busting parameter
			},
			columns: [{
					data: null,
					render: function(data, type, row, meta) {
						return meta.row + 1; // Return the row index
					}
				},
				{
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
					// Add action buttons
					render: function(data, type, row) {
						return `
						<button class="btn btn-sm btn-success apply-btn" data-id="${row.id}" ${row.apply == 1 ? 'disabled' : ''}>Apply</button>
						<button class="btn btn-sm btn-primary edit-btn" data-id="${row.id}">Edit</button>
						<button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">Delete</button>
					`;
					}
				}
			],
			responsive: true,
			dom: '<"top"f>rt<"bottom"lp><"clear">',
			// Add buttons to the DataTable header
			initComplete: function() {
				$("#configTable_wrapper .top").append('<button type="button" class="btn btn-success ml-3" data-bs-toggle="modal" data-bs-target="#contactModal">Tambah Profil Pengaturan</button> ');
				$("#configTable_wrapper .top").append('<button type="button" class="btn btn-warning ml-3" data-bs-toggle="modal" data-bs-target="#carouselModal">Tambar banner halaman utama</button> ');
				$("#configTable_wrapper .top").append('<button type="button" class="btn btn-primary ml-3" data-bs-toggle="modal" data-bs-target="#sectionModal">Tambah bagian halaman</button> ');
			},
			language: {
				search: "_INPUT_",
				searchPlaceholder: "Search..."
			}
		});
		table.buttons().container().appendTo('#configTable_wrapper .col-md-6:eq(0)');
		//function apply config-home
		$('#configTable').on('click', '.apply-btn', function() {
			var id = $(this).data('id');
			Swal.fire({
				title: 'Are you sure?',
				text: "You are about to apply this configuration!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, apply it!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '<?php echo base_url("home/apply_config"); ?>/' + id,
						type: 'POST',
						success: function(response) {
							table.ajax.reload(); // Reload the DataTable
							Swal.fire({
								icon: 'success',
								title: 'Applied!',
								text: 'Configuration has been applied.'
							});
						},
						error: function(response) {
							Swal.fire({
								icon: 'error',
								title: 'Error',
								text: 'Failed to apply configuration!'
							});
						}
					});
				}
			});
		});
		//function edit config-home
		$('#configTable').on('click', '.edit-btn', function() {
			var id = $(this).data('id');
			$.ajax({
				url: '<?php echo base_url("home/get_config"); ?>/' + id,
				method: 'GET',
				success: function(response) {
					// Parse the response as JSON
					var data = JSON.parse(response);
					// Populate the form fields with the response data
					$('#contactForm').append('<input type="hidden" name="id" value="' + data.id + '">');
					$('#contactForm').find('input[name="nama_config"]').val(data.config_profile_name);
					$('#contactForm').find('input[name="alamat"]').val(data.alamat);
					$('#contactForm').find('input[name="kontak"]').val(data.kontak);
					$('#contactForm').find('input[name="email"]').val(data.email);
					$('#contactForm').find('input[name="color_1"]').val(data.color_1);
					$('#contactForm').find('input[name="color_2"]').val(data.color_2);
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
		// function delete config-home
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
		$('#contactModal').on('hidden.bs.modal', function() {
			$('#contactForm')[0].reset(); // Clear the form fields
			$('#contactForm').find('input[name="id"]').remove(); // Remove the hidden ID field
		});

		$('#contactModal').on('shown.bs.modal', function() {
			var id = $('#contactForm').find('input[name="id"]').val();
			if (id) {
				// console.log('Edit mode');
				fetchSectionsForEdit(id);
				fetchCarouselsForEdit(id);
			} else {
				// console.log('create mode');
				fetchSectionsForCreate();
				fetchCarouselsForCreate();
			}
		});
		//function fetch Sections For Edit
		function fetchSectionsForEdit(configId) {
			$.ajax({
				url: '<?php echo base_url("home/get_all_sections"); ?>',
				method: 'GET',
				success: function(response) {
					// console.log("section edit got response");
					var data = JSON.parse(response);
					var options = '';
					if (Array.isArray(data.data)) {
						data.data.forEach(function(section) {
							options += `<option value="${section.id}">${section.name}</option>`;
						});
					} else {
						console.error('Expected an array but got:', data);
					}
					$('#section').html(options);
					initializeSelect2('#section');

					// Fetch the configuration data and set the selected values
					$.ajax({
						url: '<?php echo base_url("home/get_config"); ?>/' + configId,
						method: 'GET',
						success: function(response) {
							var configData = JSON.parse(response);
							setTimeout(function() {
								$('#section').val(configData.array_of_id_section ? configData.array_of_id_section.split(',') : []).trigger('change');
							}, 100); // Add a slight delay
						},
						error: function(response) {
							Swal.fire({
								icon: 'error',
								title: 'Error',
								text: 'Failed to fetch configuration data!'
							});
						}
					});
				},
				error: function(response) {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Failed to fetch sections!'
					});
				}
			});
		}
		//function fetch Sections For Create
		function fetchSectionsForCreate() {
			$.ajax({
				url: '<?php echo base_url("home/get_all_sections"); ?>',
				method: 'GET',
				success: function(response) {
					var data = JSON.parse(response);
					var options = '';
					if (Array.isArray(data.data)) {
						data.data.forEach(function(section) {
							options += `<option value="${section.id}">${section.name}</option>`;
						});
					} else {
						console.error('Expected an array but got:', data);
					}
					$('#section').html(options);
					initializeSelect2('#section');
				},
				error: function(response) {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Failed to fetch sections!'
					});
				}
			});
		}
		//function fetch Carousels For Edit
		function fetchCarouselsForEdit(configId) {
			$.ajax({
				url: '<?php echo base_url("home/get_all_carousels"); ?>',
				method: 'GET',
				success: function(response) {
					var data = JSON.parse(response);
					var options = '';
					if (Array.isArray(data.data)) {
						data.data.forEach(function(carousel) {
							options += `<option value="${carousel.id}">${carousel.title}</option>`;
						});
					} else {
						console.error('Expected an array but got:', data);
					}
					$('#carousel').html(options);
					initializeSelect2('#carousel');

					// Fetch the configuration data and set the selected values
					$.ajax({
						url: '<?php echo base_url("home/get_config"); ?>/' + configId,
						method: 'GET',
						success: function(response) {
							var configData = JSON.parse(response);
							setTimeout(function() {
								$('#carousel').val(configData.array_of_id_carousel ? configData.array_of_id_carousel.split(',') : []).trigger('change');
							}, 100); // Add a slight delay
							// console.log(response);
						},
						error: function(response) {
							Swal.fire({
								icon: 'error',
								title: 'Error',
								text: 'Failed to fetch configuration data!'
							});
						}
					});
				},
				error: function(response) {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Failed to fetch carousels!'
					});
				}
			});
		}


		//function fetch Carousels For Create
		function fetchCarouselsForCreate() {
			$.ajax({
				url: '<?php echo base_url("home/get_all_carousels"); ?>',
				method: 'GET',
				success: function(response) {
					var data = JSON.parse(response);
					var options = '';
					if (Array.isArray(data.data)) {
						data.data.forEach(function(carousel) {
							options += `<option value="${carousel.id}">${carousel.title}</option>`;
						});
					} else {
						console.error('Expected an array but got:', data);
					}
					$('#carousel').html(options);
					initializeSelect2('#carousel');
				},
				error: function(response) {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Failed to fetch carousels!'
					});
				}
			});
		}
		//function submit config home form
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



		// section modal
		$('#sectionModal').on('shown.bs.modal', function() {
			$('#section_content').summernote({
				height: 300, // Set the height of the editor
				toolbar: [
					['style', ['style']],
					['font', ['bold', 'italic', 'underline', 'clear']],
					['fontname', ['fontname']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['table', ['table']],
					['insert', ['link', 'picture', 'video']],
					['view', ['fullscreen', 'codeview', 'help']]
				]
			});

			//datatable for section
			if (!$.fn.DataTable.isDataTable('#sectionTable')) {
				var sectionTable = $('#sectionTable').DataTable({
					ajax: {
						url: '<?php echo site_url("home/get_all_sections"); ?>',
						dataSrc: function(json) {
							return json.data; // Adjusted to match the response structure
						},
						cache: false // Enable cache-busting parameter
					},
					columns: [{
							data: null,
							render: function(data, type, row, meta) {
								return meta.row + 1; // Return the row index
							}
						},
						{
							data: 'name'
						},
						{
							data: 'content'
						},
						{
							data: 'date_of_creation'
						},
						{
							data: null,
							render: function(data, type, row) {
								return `
							<button class="btn btn-sm btn-primary edit-section-btn" data-id="${row.id}">Edit</button>
							<button class="btn btn-sm btn-danger delete-section-btn" data-id="${row.id}">Delete</button>
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
			}
		});
		// section form submit
		$('#sectionForm').on('submit', function(e) {
			e.preventDefault();
			var formData = $(this).serialize();
			var id = $('#sectionForm').find('input[name="id"]').val();
			var url = id ? '<?php echo base_url("home/update_section"); ?>/' + id : '<?php echo base_url("home/store_section"); ?>';
			$.ajax({
				type: 'POST',
				url: url,
				data: formData,
				success: function(response) {
					// Handle success response
					$('#sectionForm')[0].reset(); // Clear the form fields
					$('#sectionForm').find('textarea[name="section_content"]').summernote('reset'); // Clear the Summernote editor
					$('#sectionForm').find('input[name="id"]').remove();

					var sectionTable = $('#sectionTable').DataTable();
					sectionTable.ajax.reload(); // Reload the DataTable
					Swal.fire({
						icon: 'success',
						title: 'Success',
						text: id ? 'Section updated successfully!' : 'Section added successfully!'
					});
				},
				error: function(response) {
					// Handle error response
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: id ? 'Failed to update section!' : 'Failed to add section!'
					});
				}
			});
		});

		//section edit function
		$('#sectionTable').on('click', '.edit-section-btn', function() {
			var id = $(this).data('id');
			$.ajax({
				url: '<?php echo base_url("home/edit_section"); ?>/' + id,
				method: 'GET',
				success: function(response) {
					// Parse the response as JSON
					var data = JSON.parse(response);
					// Populate the form fields with the response data
					$('#sectionForm').find('input[name="section_name"]').val(data.name);
					$('#sectionForm').find('textarea[name="section_content"]').summernote('code', data.content);
					$('#sectionForm').append('<input type="hidden" name="id" value="' + data.id + '">');

					$('#sectionModal').on('hidden.bs.modal', function() {
						$('#sectionForm').find('input[name="id"]').remove();
					});
					$('#sectionModal').modal('show');
				},
				error: function(response) {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Failed to fetch section details!'
					});
				}
			});
		});
		//section delete function
		$('#sectionTable').on('click', '.delete-section-btn', function() {
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
						url: '<?php echo base_url("home/delete_section"); ?>/' + id,
						type: 'DELETE',
						success: function(response) {
							var sectionTable = $('#sectionTable').DataTable();
							sectionTable.ajax.reload(); // Reload the DataTable
							Swal.fire({
								icon: 'success',
								title: 'Deleted!',
								text: 'Section has been deleted.'
							});
						},
						error: function(response) {
							Swal.fire({
								icon: 'error',
								title: 'Error',
								text: 'Failed to delete section!'
							});
						}
					});
				}
			});
		});
		// carousel modal function
		$('#carouselModal').on('shown.bs.modal', function() {
			if (!$.fn.DataTable.isDataTable('#carouselTable')) {
				var carouselTable = $('#carouselTable').DataTable({
					ajax: {
						url: '<?php echo base_url("home/get_all_carousels"); ?>',
						dataSrc: function(json) {
							return json.data;
						},
						cache: false // Enable cache-busting parameter
					},
					columns: [{
							data: null,
							render: function(data, type, row, meta) {
								return meta.row + 1; // Return the row index
							}
						},
						{
							data: 'title'
						},
						{
							data: 'description'
						},
						{
							data: 'picture',

							render: function(data, type, row) {
								if (data) {
									return '<img src="<?php echo base_url("./assets/images/carousel/"); ?>' + data + '" class="img-thumbnail" data-magnify="gallery" data-src="<?php echo base_url("./assets/images/carousel/"); ?>' + data + '" width="80px">';
								} else {
									return 'No Image';
								}
							}
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

				// Initialize the magnify plugin after the table is drawn
				$('#carouselTable').on('draw.dt', function() {
					$("[data-magnify=gallery]").magnify(
						[
							'zoomIn',
							'zoomOut',
							'prev',
							'fullscreen',
							'next',
							'actualSize',
							'rotateRight'
						]
					);
				});
			} else {
				var carouselTable = $('#carouselTable').DataTable();
				carouselTable.ajax.reload(); // Reload the DataTable
			}
		});
		//carousel edit function
		$('#carouselTable').on('click', '.edit-carousel-btn', function() {
			var id = $(this).data('id');
			$.ajax({
				url: '<?php echo base_url("home/edit_carousel"); ?>/' + id,
				method: 'GET',
				success: function(response) {
					// Parse the response as JSON
					var data = JSON.parse(response);
					// Populate the form fields with the response data
					$('#carouselForm').find('input[name="title"]').val(data.title);
					$('#carouselForm').find('textarea[name="description"]').val(data.description);
					if (data.picture) {
						$('#carouselForm').append('<input type="hidden" name="new_picture" value="' + data.picture + '">');
						$('#carouselForm').find('#carouselImage').attr('src', '<?php echo base_url("./assets/images/carousel/"); ?>' + data.picture).show();
						// $('#carouselForm').find('input[name="picture"]').prop('disabled', true);

						$('#carouselForm').find('input[name="picture"]').on('change', function() {
							if ($(this).val()) {
								$('#carouselForm').find('input[name="picture"]').prop('disabled', false);
							} else {
								$('#carouselForm').find('input[name="picture"]').prop('disabled', true);
							}
						});
						// $('#carouselForm').find('#carouselImage').attr('src', '<?php echo base_url("./assets/images/carousel/"); ?>' + data.picture).show();
					} else {
						$('#carouselForm').find('#carouselImage').hide();
					}
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
		//
		$('#carouselForm').on('submit', function(e) {
			e.preventDefault();

			// Validate image dimensions
			var fileInput = $('#carouselForm').find('input[name="picture"]')[0];
			if (fileInput.files && fileInput.files[0]) {
				var img = new Image();
				img.onload = function() {
					if (img.width !== 1920 || img.height !== 850) {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'Gambar yang anda unggah <strong>HARUS</strong> berukuran 1920x850 pixels!'
						});
					} else {
						submitForm();
					}
				};
				img.onerror = function() {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Invalid image file!'
					});
				};
				img.src = URL.createObjectURL(fileInput.files[0]);
			} else {
				submitForm();
			}

			function submitForm() {
				var formData = new FormData($('#carouselForm')[0]); // Use FormData to handle file uploads
				var id = $('#carouselForm').find('input[name="id"]').val();
				var url = id ? '<?php echo base_url("home/update_carousel"); ?>/' + id : '<?php echo base_url("home/store_carousel"); ?>';
				$.ajax({
					type: 'POST',
					url: url,
					data: formData,
					processData: false, // Prevent jQuery from automatically transforming the data into a query string
					contentType: false, // Set the content type to false to let the browser set it
					success: function(response) {
						// Handle success response
						var carouselTable = $('#carouselTable').DataTable();
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
							text: id ? 'Failed to update carousel!' : 'Failed to add carousel!',
							footer: response.responseText
						});
					}
				});
			}
		});
	});

	//
	$('#carouselTable').on('click', '.delete-carousel-btn', function() {
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
					url: '<?php echo base_url("home/delete_carousel"); ?>/' + id,
					type: 'DELETE',
					success: function(response) {
						var carouselTable = $('#carouselTable').DataTable();
						carouselTable.ajax.reload(); // Reload the DataTable
						Swal.fire({
							icon: 'success',
							title: 'Deleted!',
							text: 'Carousel has been deleted.'
						});
					},
					error: function(response) {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'Failed to delete carousel!'
						});
					}
				});
			}
		});
	});
	//function initialize select2
	function initializeSelect2(selector) {
		$(selector).select2({
			theme: 'bootstrap-5'
		});
	}
</script>