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
<script src="<?php echo base_url(); ?>/assets/js/cropperLibrary.js"></script>


<script>
	$(document).ready(function() {


		const cropperLib = {

			img: null,
			result: null,
			img_result: null,
			img_w: null,
			img_h: null,
			options: null,
			crop: null,
			save: null,
			cropped: null,
			dwn: null,
			upload: null,
			cropper: null,
			croppedImage: null, // Declared globally within the class
			reset: null,

			initialize() {
				this.result = document.querySelector('.result');
				this.img_result = document.querySelector('.img-result');
				this.img_w = document.querySelector('.img-w');
				this.img_h = document.querySelector('.img-h');
				this.options = document.querySelector('.options');
				this.crop = document.querySelector('.crop');
				this.save = document.querySelector('.save');
				this.cropped = document.querySelector('.cropped');
				this.dwn = document.querySelector('.download');
				this.upload = document.querySelector('#file-input');
				this.reset = document.querySelector('.reset');
				this.img = document.querySelector('#image');

				if (this.img) this.setupCropper();
				this.bindEvents();
			},

			setupCropper() {
				if (!this.img || !document.body.contains(this.img)) return;

				if (this.cropper) this.cropper.destroy();

				this.cropper = new Cropper(this.img, {
					viewMode: 1,
					autoCrop: true,
					aspectRatio: 2.07,
					crop: () => {
						const cropBox = this.cropper.getCropBoxData();
						const imageData = this.cropper.getImageData();
						const scaleX = imageData.naturalWidth / imageData.width;
						const scaleY = imageData.naturalHeight / imageData.height;
						const w = Math.round(cropBox.width * scaleX);
						const h = Math.round(cropBox.height * scaleY);
						if (w > 0 && h > 0) {
							this.img_w.value = w;
							this.img_h.value = h;
						}
						this.reset.classList.remove('hide');
					}
				});

				this.options.classList.remove('hide');
				this.save.classList.remove('hide');
			},

			bindEvents() {
				this.upload.addEventListener('change', (e) => {
					const file = e.target.files[0];
					if (!file) return;

					const reader = new FileReader();
					reader.onload = (e) => {
						this.img = document.createElement('img');
						this.img.id = 'image';
						this.img.src = e.target.result;
						this.img.onload = () => {
							this.result.innerHTML = '';
							this.result.appendChild(this.img);
							this.crop.classList.remove('hide');
							this.setupCropper();
						};
					};
					reader.readAsDataURL(file);
				});

				this.crop.addEventListener('click', (e) => {
					e.preventDefault();
					if (this.img) this.setupCropper();
				});

				this.save.addEventListener('click', (e) => {
					e.preventDefault();
					const w = parseInt(this.img_w.value);
					const h = parseInt(this.img_h.value);
					if (!w || !h || isNaN(w) || isNaN(h)) return alert("Invalid dimensions");

					const canvas = this.cropper.getCroppedCanvas({
						width: w,
						height: h
					});
					if (!canvas) return alert("Failed to crop");

					const imgSrc = canvas.toDataURL();
					this.cropped.src = imgSrc;
					this.cropped.classList.remove('hide');
					this.img_result.classList.remove('hide');
					this.dwn.href = imgSrc;
					this.dwn.download = 'cropped-image.png';
					this.dwn.classList.remove('hide');
					this.croppedImage = imgSrc;
				});

				this.reset.addEventListener('click', (e) => {
					e.preventDefault();
					this.resetCropper();
				});
			},

			resetCropper() {
				if (this.cropper) this.cropper.destroy();
				this.cropper = null;
				this.result.innerHTML = '';
				this.img = null;
				this.img_w.value = '';
				this.img_h.value = '';
				this.options.classList.add('hide');
				this.save.classList.add('hide');
				this.crop.classList.add('hide');
				this.cropped.classList.add('hide');
				this.img_result.classList.add('hide');
				this.dwn.classList.add('hide');
				this.croppedImage = null;
				this.reset.classList.add('hide');
			},

			getCroppedImage() {
				return this.croppedImage || null;
			},


			base64ToBlob(base64, mime = 'image/png') {
				const byteString = atob(base64.split(',')[1]);
				const arrayBuffer = new ArrayBuffer(byteString.length);
				const intArray = new Uint8Array(arrayBuffer);
				for (let i = 0; i < byteString.length; i++) {
					intArray[i] = byteString.charCodeAt(i);
				}
				return new Blob([intArray], {
					type: mime
				});
			}

		};


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


		// Ensure the element exists before initializing the cropper
		if ($('#image').length) {
			cropperLib.initialize();
		}

		// Initialize the upload change event
		$('#file-input').on('change', function() {
			cropperLib.initialize();
		});

		// Initialize cropper variables and event listeners when the modal is shown
		$('#carouselModal').on('shown.bs.modal', function() {
			// Ensure cropperLib is defined
			cropperLib.initialize();


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
					$('#carouselForm').find('input[name="id"]').remove(); // Remove existing
					$('#carouselForm').append('<input type="hidden" name="id" value="' + data.id + '">');

					if (data.picture) {
						$('#carouselForm').find('input[name="picture"]').remove();
						$('#carouselForm').append('<input type="hidden" name="picture" value="' + data.picture + '">');
						$('#carouselForm').find('#carouselImage').attr('src', '<?php echo base_url("./assets/images/carousel/"); ?>' + data.picture).show();
						// Create new image element with recent image
						let img = document.createElement('img');
						img.id = 'image';
						img.src = '<?php echo base_url("./assets/images/carousel/"); ?>' + data.picture;
						document.querySelector('.result').innerHTML = ''; // Clear the previous cropper canvas
						document.querySelector('.result').appendChild(img); // Append the new image
						cropperLib.initializeHandlers(); // Initialize cropper with new image
					} else {
						$('#carouselForm').find('#carouselImage').hide();
					}

					// Optional: Reset cropper when modal closes
					$('#carouselModal').on('hidden.bs.modal', function() {
						cropperLib.resetCropper();
						$('#carouselForm')[0].reset();
						$('#carouselImage').hide();
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


		// Submit form with cropped image
		$('#carouselForm').on('submit', function(e) {
			e.preventDefault();

			const base64 = cropperLib.getCroppedImage();
			if (!base64) {
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'No cropped image found.'
				});
				return;
			}

			const blob = cropperLib.base64ToBlob(base64, 'image/png');
			const formData = new FormData(this);
			formData.append('picture', blob, 'cropped-image.png');

			const id = $('input[name="id"]').val();
			const url = id ?
				'<?php echo base_url("home/store_carousel"); ?>/' + id :
				'<?php echo base_url("home/store_carousel"); ?>';

			$.ajax({
				url,
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function(res) {
					Swal.fire({
						icon: 'success',
						title: 'Saved successfully.'
					});
					$('#carouselModal').modal('hide');
					$('#carouselTable').DataTable().ajax.reload();
					cropperLib.resetCropper();
				},
				error: function(xhr) {
					Swal.fire({
						icon: 'error',
						title: 'Upload failed.',
						text: xhr.responseText
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
	});
	//function initialize select2
	function initializeSelect2(selector) {
		$(selector).select2({
			theme: 'bootstrap-5'
		});
	}
</script>
