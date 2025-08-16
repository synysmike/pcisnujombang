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

<script>
	$(document).ready(function() {
		$('#isiBerita').summernote();

		$('#kategori').select2({
			placeholder: 'Pilih Kategori',
			allowClear: true,
			width: '100%',
			dropdownParent: $('#item-form'), // Ensure dropdown is appended to the modal

		});
		// Fetch kategori data and populate the Select2 dropdown 
		$.ajax({
			url: '<?php echo base_url("kategori/get_all_kategori") ?>',
			type: 'post',
			dataType: 'json', // 👈 forces auto-parsing
			success: function(data) {
				// console.log("Raw data:", data);
				// console.log("Type:", typeof data);
				var categories = data;
				categories.forEach(function(category) {
					var option = new Option(category.kategori, category.id, false, false);
					$('#kategori').append(option).trigger('change');
				});
			},
			error: function(xhr, status, error) {
				console.error("AJAX Error:", status, error);
			}
		});

		// Datatables AJAX button 
		$('<style>')
			.prop('type', 'text/css')
			.html('.custom-dropdown { z-index: 1060 !important; }')
			.appendTo('head');
		DataTable.ext.buttons.alert = {
			className: 'buttons-info',
			action: function(e, dt, node, config) {
				$('#basicModal').show()
			}
		};

		// Datatables AJAX Kategori
		var tableKategori = $('#tabel-kategori').DataTable({
			ajax: {
				url: '<?php echo base_url("kategori/get_all_kategori") ?>',
				type: 'post',
				dataSrc: '',
			},
			columns: [{
					data: null,
					// Use null data to create a row number column 
					render: function(data, type, row, meta) {
						return meta.row + 1;
						// Return the row number 
					}
				}, {
					data: 'kategori',
				},
				{
					data: 'description',
				},
				{
					data: 'id',
					render: function(data, type, row) {
						return '<button class="btn btn-warning edit-category" type="button" data-id="' + data + '">' + "Edit" + '</button> ' + '<button class="btn btn-danger delete-category ml-3" type="button" data-id="' + data + '">' + "Delete" + '</button>';
					}
				},
			]
		});

		// Handle edit and delete actions 
		$('#tabel-kategori').on('click', '.edit-category', function() {
			var id = $(this).data('id');
			// Fetch category data and populate the form fields
			$.ajax({
				url: '<?php echo base_url("kategori/get_kategori_by_id") ?>/' + id,
				type: 'get',
				success: function(data) {
					if (data) {
						$('#category-id').val(data.id);
						$('#categoryName').val(data.kategori);
						// Ensure this matches the key in your response
						$('#categoryDescription').val(data.description);
						console.log("Form fields updated");
						// Log form field updates
					} else {
						console.error("No data received");
					}
				},
				error: function(xhr, status, error) {
					console.error("AJAX Error:", status, error);
					// Log any AJAX errors 
				}
			});
		});

		$('#tabel-kategori').on('click', '.delete-category', function() {
			var id = $(this).data('id');
			if (confirm('Anda yakin ingin menghapus kategori ini?')) {
				$.ajax({
					url: '<?php echo base_url("kategori/delete") ?>/' + id,
					type: 'post',
					success: function(response) {
						var data = JSON.parse(response);
						if (data.status === 'success') {
							swal({
								title: "Success!",
								text: data.message,
								icon: "success",
								button: "OK",
							}).then(() => {
								tableKategori.ajax.reload();
							});
						} else {
							swal({
								title: "Error!",
								text: data.message,
								icon: "error",
								button: "OK",
							});
						}
					},
					error: function(xhr, status, error) {
						console.error("AJAX Error:", status, error);
						// Log any AJAX errors 
						swal({
							title: "Error!",
							text: "An error occurred while processing your request.",
							icon: "error",
							button: "OK",
						});
					}
				});
			}
		});

		// Handle form submission for creating categories 
		$('#category-form').on('submit', function(e) {
			e.preventDefault();
			$.ajax({
				url: '<?php echo base_url("kategori/store") ?>',
				type: 'post',
				data: $(this).serialize(),
				success: function() {
					$('#createCategory').modal('hide');
					tableKategori.ajax.reload();
				}
			});
		});

		// Handle form submission for editing categories 
		$('#edit-category-form').on('submit', function(e) {
			e.preventDefault();
			var id = $('#edit-category-id').val();
			$.ajax({
				url: '<?php echo base_url("kategori/update") ?>/' + id,
				type: 'post',
				data: $(this).serialize(),
				success: function() {
					$('#editCategory').modal('hide');
					tableKategori.ajax.reload();
				}
			});
		});

		// ///////////////////////////***###<--PEMROSES BERITA-->###***\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
		// Datatables AJAX Berita
		var table = $('#tabel-berita').DataTable({
			responsive: true,
			ajax: {
				url: '<?php echo base_url("berita/get_all_berita") ?>',
				type: 'post',
				dataSrc: '',
			},
			dom: 'Bfrtip',
			buttons: [{
				text: 'Tambah Berita',
				className: 'btn btn-success',
				action: function(e, dt, node, config) {
					$('#create').modal('show');
					$('[id="judul"]').val("");
					$('#isiBerita').summernote('reset');
					$("#kategori").select2("val", "");
					$("#preview").hide();
					$(".modal-title").text("Tambah Data");
				}
			}, {
				text: 'Tambah Kategori',
				className: 'btn btn-info ml-3',
				action: function(e, dt, node, config) {
					$('#createCategory').modal('show');
					$('[id="categoryName"]').val("");
					$('[id="categoryDescription"]').val("");
					$(".modal-title").text("Tambah Kategori");
				}
			}],
			columnDefs: [{
					targets: 3,
					className: 'isi-column'
				} // Assuming "isi" is the first column
			],
			columns: [{
					data: null, // Use null data to create a row number column
					render: function(data, type, row, meta) {
						return meta.row + 1; // Return the row number
					}
				},
				{
					data: 'judul',
				},
				{
					data: 'kategori_nama',
				},
				{
					data: 'isi',
					render: function(data, type, row) {
						if (type === 'display') {
							data = data.replace(/<\/?p>/g, '');
							if (data.length > 25) { // Limit to 25 characters
								return '<span class="short-text" style="display: inline;">' + data.substr(0, 25) + '...   </span><span class="full-text" style="display:none;">' + data + ' </span> <a href="#" class="toggle-text btn btn-outline-primary btn-sm">Read more</a>';
							} else {
								return data;
							}
						}
						return data;
					},

				},
				{
					data: 'tgl',
				},
				{
					// proses gambar pada datatables
					data: 'gambar',
					render: function(data) {
						return "<img class='img-thumbnail' data-magnify='gallery' data-src='<?php echo base_url(); ?>assets/images/berita/" + data + "' src='<?php echo base_url(); ?>assets/images/berita/" + data + "' width='80px'>";
					}
				},
				{
					// button aksi(refrensi :https://stackoverflow.com/questions/54930978/datatables-show-column-data-in-modal)
					data: 'id',
					render: function(data) {
						return '<button class="btn btn-info edit" type="button" data-id="' + data + '">Edit</button> ' +
							'<button class="btn btn-danger hapus" type="button" data-id="' + data + '">Hapus</button>';
					}

				},
			],

		});
		$('#tabel-berita').on('click', 'a.toggle-text', function(e) {
			e.preventDefault();
			var $this = $(this);
			var $shortText = $this.siblings('.short-text');
			var $fullText = $this.siblings('.full-text');

			if ($shortText.is(':visible')) {
				$shortText.hide();
				$fullText.show();
				$this.text('Read less');
			} else {
				$shortText.show();
				$fullText.hide();
				$this.text('Read more');
			}
		});
		$('#tabel-berita tbody').on('click', '.edit', function() {
			$(".modal-title").text("Edit Data");
			var id = $(this).data('id'); // Get the ID from the data-id attribute
			console.log("Editing ID:", id); // Log the ID being edited
			$.ajax({
				url: "<?php echo base_url('berita/get_berita') ?>",
				dataType: "JSON",
				data: {
					'id': id
				}, // change this to send js object
				type: "post",
				success: function(data) {
					// console.log("Response Data:", data); // Log the response data
					if (data && data.length > 0) {
						var item = data[0];
						$('#create').modal('show');
						$('#item-id').val(item.id);
						$("#judul").val(item.judul);
						$('#isiBerita').summernote('code', item.isi);
						$("#kategori").val(item.id_kat).trigger('change');
						if (item.gambar) {
							$("#preview").show();
							$("#preview-gambar").attr("src", "<?php echo base_url('assets/images/berita/') ?>" + item.gambar);
							$("#preview-gambar").attr("data-src", "<?php echo base_url('assets/images/berita/') ?>" + item.gambar);
						} else {
							$("#preview").hide();
							$("#preview-gambar").attr("src", "");
						}
					} else {
						console.warn("No data received or data is empty");
					}
				},
				error: function(xhr, status, error) {
					console.error("AJAX Error:", status, error); // Log any AJAX errors
				}
			});
			return false;
		});





		// Simpan Berita
		$('#item-form').submit(function(e) {
			e.preventDefault();
			// Create a FormData object 
			var formData = new FormData(this);
			// Add Select2 data 
			formData.append('kategori', $('#kategori').val());
			// Add Summernote data 
			var id = $('#carouselForm').find('input[name="id"]').val();
			formData.append('isiBerita', $('#isiBerita').summernote('code'));
			var url = id ? '<?php echo base_url("berita/simpan_berita"); ?>/' + id : '<?php echo base_url("berita/simpan_berita"); ?>';

			$.ajax({
				type: "POST",
				url: url,
				dataType: "JSON",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function(data) {
					$('[id="judul"]').val("");
					$('#isiBerita').summernote('reset');
					$("#kategori").select2("val", "");
					Swal.fire({
						title: "Data tersimpan!",
						text: "Data anda telah tersimpan",
						icon: "success"
					});
					$('#create').modal('hide');
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
		// HAPUS DATA
		// set button dan fungsi hapus
		$('#tabel-berita tbody').on('click', '.hapus', function() {
			var row = $(this).closest('tr');
			var id = $(this).data('id'); // Move id outside Swal.fire for proper scope

			Swal.fire({
				title: "Apakah anda yakin menghapus data ini?",
				showDenyButton: true,
				confirmButtonText: "Yakin",
				denyButtonText: `Batal`
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('berita/delete_berita'); ?>",
						dataType: "JSON",
						data: {
							id: id
						},
						success: function(data) {
							Swal.fire("Data Terhapus", "", "success");
							$('#tabel-berita').DataTable().ajax.reload();
						},
						error: function(xhr, status, error) {
							Swal.fire("Error!", "Data gagal dihapus.", "error");
						}
					});
				} else if (result.isDenied) {
					Swal.fire("Batal Hapus!", "", "info");
				}
			});
		});


		//GET HAPUS
		$('#show_data').on('click', '.item_hapus', function() {
			var id = $(this).attr('data');
			$('#ModalHapus').modal('show');
			$('[name="kode"]').val(id);
		});

	})
</script>
