<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/admin/magnify-master/dist/jquery.magnify.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js'></script>



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
					data: 'logo',
					render: function(data) {
						if (data) {
							return "<img class='img-thumbnail' data-magnify='gallery' data-src='<?php echo base_url(); ?>assets/images/logo/" + data + "' src='<?php echo base_url(); ?>assets/images/logo/" + data + "' width='80px'>";
						} else {
							return 'No Image';
						}
					}
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
					data: 'url_alamat'
				},
				{
					data: 'kontak'
				},
				{
					data: 'url_kontak'
				},
				{
					data: 'email'
				},
				{
					data: 'url_email'
				},
				{
					data: null,
					render: function(data, type, row) {
						return `
                    <button class="btn btn-sm btn-success apply-btn" data-id="${row.id}" ${row.apply == 1 ? 'disabled' : ''}>Apply</button>
                    <button class="btn btn-sm btn-primary edit-btn" data-id="${row.id}">Edit</button>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">Delete</button>
                `;
					}
				}
			],
			responsive: {
				details: {
					type: 'column',
					target: 'tr'
				}
			},
			columnDefs: [{
				className: 'control',
				orderable: false,
				targets: 0
			}],
			order: [1, 'asc'],
			dom: 'Bfrtip', // Adjusted to remove buttons
			initComplete: function() {
				var $filter = $("#configTable_wrapper .dataTables_filter");
				$filter.addClass('d-flex align-items-center'); // Add Bootstrap classes to align items
				$filter.prepend('<div class="btn-group me-3" role="group"></div>'); // Add a wrapper for the buttons

				setTimeout(function() {
					$filter.find('.btn-group').append('<button type="button" class="btn btn-success ms-3" data-bs-toggle="modal" data-bs-target="#contactModal">Tambah Profil Pengaturan</button>');
					$filter.find('.btn-group').append('<button type="button" class="btn btn-warning ms-3" data-bs-toggle="modal" data-bs-target="#carouselModal">Tambar banner halaman utama</button>');
					$filter.find('.btn-group').append('<button type="button" class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#sectionModal">Tambah bagian halaman</button>');
				}, 200); // Slight delay to ensure DataTables initialization is complete
			},

			language: {
				search: "_INPUT_",
				searchPlaceholder: "Cari ..."
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
					$('#contactModalLabel').text('Form edit pengaturan beranda');
					$('#configForm').append('<input type="hidden" name="id" value="' + data.id + '">');
					$('#configForm').find('input[name="config_profile_name"]').val(data.config_profile_name);
					$('#configForm').find('input[name="alamat"]').val(data.alamat);
					$('#configForm').find('input[name="url_alamat"]').val(data.url_alamat);
					$('#configForm').find('input[name="kontak"]').val(data.kontak);
					$('#configForm').find('input[name="url_kontak"]').val(data.url_kontak);
					$('#configForm').find('input[name="email"]').val(data.email);
					$('#configForm').find('input[name="url_email"]').val(data.url_email);
					$('#configForm').find('input[name="color_1"]').val(data.color_1);
					$('#configForm').find('input[name="color_2"]').val(data.color_2);
					$('#contactModal').modal('show');
					if (data.logo) {
						$('#configForm').append('<input type="hidden" name="logo" value="' + data.logo + '">');
						$('#configForm').find('#logoImage').attr('src', '<?php echo base_url("./assets/images/logo/"); ?>' + data.logo).show();
						// $('#carouselForm').find('input[name="picture"]').prop('disabled', true);

						$('#configForm').find('input[name="logo"]').on('change', function() {
							if ($(this).val()) {
								$('#configForm').find('input[name="logo"]').prop('disabled', false);
							} else {
								$('#configForm').find('input[name="logo"]').prop('disabled', true);
							}
						});
						// $('#carouselForm').find('#carouselImage').attr('src', '<?php echo base_url("./assets/images/carousel/"); ?>' + data.picture).show();
					} else {
						$('#configForm').find('#logoImage').hide();
					}
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
			$('#contactModalLabel').text('Form tambah pengaturan beranda');
			$('#configForm')[0].reset(); // Clear the form fields
			$('#configForm').find('input[name="id"]').remove(); // Remove the hidden ID field
		});

		$('#contactModal').on('shown.bs.modal', function() {

			var id = $('#configForm').find('input[name="id"]').val();
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
					$('#array_of_id_section').html(options);
					initializeSelect2('#array_of_id_section');

					// Fetch the configuration data and set the selected values
					$.ajax({
						url: '<?php echo base_url("home/get_config"); ?>/' + configId,
						method: 'GET',
						success: function(response) {
							var configData = JSON.parse(response);
							setTimeout(function() {
								$('#array_of_id_section').val(configData.array_of_id_section ? configData.array_of_id_section.split(',') : []).trigger('change');
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
					$('#array_of_id_section').html(options);
					initializeSelect2('#array_of_id_section');
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
					$('#array_of_id_carousel').html(options);
					initializeSelect2('#array_of_id_carousel');

					// Fetch the configuration data and set the selected values
					$.ajax({
						url: '<?php echo base_url("home/get_config"); ?>/' + configId,
						method: 'GET',
						success: function(response) {
							var configData = JSON.parse(response);
							setTimeout(function() {
								$('#array_of_id_carousel').val(configData.array_of_id_carousel ? configData.array_of_id_carousel.split(',') : []).trigger('change');
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
					$('#array_of_id_carousel').html(options);
					initializeSelect2('#array_of_id_carousel');
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
		$('#configForm').on('submit', function(e) {
			e.preventDefault();

			var formData = new FormData(this); // Use FormData for file upload
			var id = $('#configForm').find('input[name="id"]').val();
			var url = id ? '<?php echo base_url("home/save_config"); ?>/' + id : '<?php echo base_url("home/save_config"); ?>';

			$.ajax({
				type: 'POST',
				url: url,
				data: formData,
				contentType: false, // Required for file upload
				processData: false, // Required for file upload
				success: function(response) {
					// Handle success response
					$('#contactModal').modal('hide');
					table.ajax.reload(); // Reload the DataTable
					Swal.fire({
						icon: 'success',
						title: 'Success',
						text: id ? 'Configuration updated successfully!' : 'Configuration added successfully!'
					});
				},
				error: function(response) {
					// Handle error response
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: id ? 'Failed to update configuration!' : 'Failed to add configuration!'
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


		// Global variables for cropper
		// Global variables
		let img, result, img_result, img_w, img_h, options, crop, save, cropped, dwn, upload, cropper, croppedImage;

		// Function to set up Cropper
		function setupCropper() {
			if (!img) {
				console.error("No image available to crop.");
				return;
			}

			// Destroy existing Cropper instance if it exists
			if (cropper) {
				cropper.destroy();
				cropper = null;
			}

			// Initialize the Cropper instance
			cropper = new Cropper(img, {
				viewMode: 1, // Ensure the crop box stays within the image boundaries
				autoCrop: true, // Automatically display the crop box
				aspectRatio: 2.07, // Set the aspect ratio
				crop(event) {
					const cropBoxData = cropper.getCropBoxData(); // Get current crop box dimensions
					const imageData = cropper.getImageData(); // Get original image dimensions (natural size)

					// Calculate scaling factors
					const scaleX = imageData.naturalWidth / imageData.width;
					const scaleY = imageData.naturalHeight / imageData.height;

					// Convert crop box dimensions to original resolution
					const originalWidth = Math.round(cropBoxData.width * scaleX);
					const originalHeight = Math.round(cropBoxData.height * scaleY);

					// Update the input fields with the original dimensions
					if (originalWidth && originalHeight) {
						img_w.value = originalWidth; // Update width
						img_h.value = originalHeight; // Update height
					} else {
						console.error("Failed to retrieve valid crop box dimensions.");
					}

					reset.classList.remove('hide'); // Show the "Reset" button
				},
			});

			options.classList.remove('hide'); // Show cropping options
			save.classList.remove('hide'); // Show "Save" button
		}


		// Initialize main functionality
		function initializeHandlers() {
			// Initialize DOM elements
			result = document.querySelector('.result');
			img_result = document.querySelector('.img-result');
			img_w = document.querySelector('.img-w');
			img_h = document.querySelector('.img-h');
			options = document.querySelector('.options');
			crop = document.querySelector('.crop');
			save = document.querySelector('.save');
			cropped = document.querySelector('.cropped');
			dwn = document.querySelector('.download');
			upload = document.querySelector('#file-input');

			// Handle file upload and preview the image
			upload.addEventListener('change', (e) => {
				if (e.target.files.length) {
					const reader = new FileReader();
					reader.onload = (e) => {
						if (e.target.result) {
							img = document.createElement('img');
							img.id = 'image';
							img.src = e.target.result;

							img.onload = () => {
								result.innerHTML = ''; // Clear previous image
								result.appendChild(img); // Append the new image
								crop.classList.remove('hide'); // Show "Crop" button
							};
						}
					};
					reader.readAsDataURL(e.target.files[0]);
				}
			});

			// Handle "Crop" button click
			crop.addEventListener('click', (e) => {
				e.preventDefault();
				setupCropper(); // Call the Cropper setup function
			});

			// Handle width and height input changes to resize the crop box
			img_w.addEventListener('input', () => {
				if (cropper) {
					const width = parseInt(img_w.value);
					const height = parseInt(img_h.value);

					if (!isNaN(width) && !isNaN(height) && width > 0 && height > 0) {
						cropper.setCropBoxData({
							width,
							height
						});
					} else {
						console.error("Invalid width or height inputs.");
					}
				}
			});

			img_h.addEventListener('input', () => {
				if (cropper) {
					const width = parseInt(img_w.value);
					const height = parseInt(img_h.value);

					if (!isNaN(width) && !isNaN(height) && width > 0 && height > 0) {
						cropper.setCropBoxData({
							width,
							height
						});
					} else {
						console.error("Invalid width or height inputs.");
					}
				}
			});

			// Handle "Save" button click to crop the image
			save.addEventListener('click', (e) => {
				e.preventDefault();
				if (cropper) {
					try {
						const width = parseInt(img_w.value);
						const height = parseInt(img_h.value);

						// Validate width and height inputs
						if (!width || !height || isNaN(width) || isNaN(height)) {
							console.error("Invalid width or height inputs");
							alert("Please enter valid width and height.");
							return;
						}

						// Get the cropped canvas
						const canvas = cropper.getCroppedCanvas({
							width,
							height
						});

						if (!canvas) {
							console.error("Failed to create canvas");
							alert("Unable to crop the image. Please try again.");
							return;
						}

						// Convert the canvas to an image data URL
						const imgSrc = canvas.toDataURL();
						cropped.classList.remove('hide');
						img_result.classList.remove('hide');
						cropped.src = imgSrc; // Display cropped image
						dwn.classList.remove('hide');
						dwn.download = 'cropped-image.png'; // Set download link
						dwn.setAttribute('href', imgSrc);
						croppedImage = imgSrc; // Store cropped image
					} catch (error) {
						console.error("Error cropping the image:", error);
					}
				}
			});
		}

		// Function to return the cropped image
		function getCroppedImage() {
			return croppedImage;
		}

		function resetCropper() {
			// Destroy existing Cropper instance if it exists
			if (cropper) {
				cropper.destroy();
				cropper = null;
			}

			// Clear the result container and inputs
			result.innerHTML = ''; // Remove the image from the DOM
			img = null; // Reset the image variable
			img_w.value = ''; // Clear the width input
			img_h.value = ''; // Clear the height input

			// Hide options and buttons
			options.classList.add('hide'); // Hide the cropping options
			save.classList.add('hide'); // Hide the "Save" button
			crop.classList.add('hide'); // Hide the "Crop" button
			cropped.classList.add('hide'); // Hide the cropped image
			img_result.classList.add('hide'); // Hide the result container
			dwn.classList.add('hide'); // Hide the download button

			// Reset the global croppedImage variable
			croppedImage = null;
			reset.classList.add('hide'); // Hide the "Reset" button


			console.log("Cropper has been reset.");
		}

		// Initialize everything when the script loads

		const reset = document.querySelector('.reset'); // Get the "Reset" button

		reset.addEventListener('click', (e) => {
			e.preventDefault();
			resetCropper(); // Call the resetCropper function
		});



		// Function to convert base64 to Blob
		function base64ToBlob(base64, mime) {
			var byteString = atob(base64.split(',')[1]);
			var ab = new ArrayBuffer(byteString.length);
			var ia = new Uint8Array(ab);
			for (var i = 0; i < byteString.length; i++) {
				ia[i] = byteString.charCodeAt(i);
			}
			return new Blob([ab], {
				type: mime
			});
		}
		$('#carouselForm').on('submit', function(e) {
			e.preventDefault();

			// Get the cropped image
			var croppedImgSrc = getCroppedImage();

			if (croppedImgSrc) {
				// Convert base64 to Blob
				var mime = croppedImgSrc.split(',')[0].split(':')[1].split(';')[0];
				var croppedBlob = base64ToBlob(croppedImgSrc, mime);

				// Append the Blob to the FormData
				var formData = new FormData($('#carouselForm')[0]);
				formData.append('picture', croppedBlob, 'cropped-image.png');

				var id = $('#carouselForm').find('input[name="id"]').val();
				var url = id ? '<?php echo base_url("home/store_carousel"); ?>/' + id : '<?php echo base_url("home/store_carousel"); ?>';
				console.log(formData);
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
						// Reset the cropper and canvas
						resetCropper();
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
			} else {
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'No image selected or cropped image is not available!'
				});
			}
		});



		// Initialize cropper variables and event listeners when the modal is shown
		$('#carouselModal').on('shown.bs.modal', function() {
			// initializeCropper();
			initializeHandlers();

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
					$("[data-magnify=gallery]").magnify(['zoomIn', 'zoomOut', 'prev', 'fullscreen', 'next', 'actualSize', 'rotateRight']);
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
						// Create new image element with recent image
						let img = document.createElement('img');
						img.id = 'image';
						img.src = '<?php echo base_url("./assets/images/carousel/"); ?>' + data.picture;
						result.innerHTML = ''; // Clear the previous cropper canvas
						result.appendChild(img); // Append the new image
						setupCropper(); // Initialize cropper with new image
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
	});
	//function initialize select2
	function initializeSelect2(selector) {
		$(selector).select2({
			theme: 'bootstrap-5'
		});
	}
</script>