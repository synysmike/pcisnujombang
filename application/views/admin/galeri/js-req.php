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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/admin/magnify-master/dist/jquery.magnify.js"></script>

<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- GitHub Buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script>
	$(document).ready(function() {
		var table = $('#galeriTable').DataTable({
			"responsive": true,
			"ajax": "<?php echo site_url('galeri/get_galeri'); ?>",
			"columns": [{
					"data": null,
					"render": function(data, type, row, meta) {
						return meta.row + 1; // Return the row index + 1 
					}
				},
				{
					"data": "judul"
				},
				{
					"data": "file",
					"render": function(data, type, row) {
						if (data) {
							return '<img src="<?php echo base_url("assets/images/galeri/"); ?>' + data + '" class="img-thumbnail" data-magnify="gallery" data-src="<?php echo base_url("assets/images/galeri/"); ?>' + data + '" width="80px">';
						} else {
							return 'No Image';
						}
					}
				},
				{
					"data": "ket",
					"render": function(data, type, row) {
						return '<div style="white-space: normal; word-break: break-word;">' + data + '</div>';
					}
				},

				{
					"data": "tgl"
				},
				{
					"data": "user_name"
				}, // Display user name instead of user ID
				{
					"data": null,
					"render": function(data, type, row) {
						return '<button class="btn btn-warning btn-edit" data-id="' + row.id + '">Edit</button> ' +
							'<button class="btn btn-danger btn-delete" data-id="' + row.id + '">Hapus</button>';
					}
				}
			],
			"dom": 'Bfrtip',
			"buttons": [{
				text: 'Tambah Galeri',
				action: function(e, dt, node, config) {
					$('#exampleModalLabel1').text('Tambah Galeri');
					$('#galeri-form')[0].reset();
					$('#create').modal('show');
				}
			}]
		});
		// Initialize Magnify.js 
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
		// Handle form submission
		$('#galeri-form').on('submit', function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: "<?php echo site_url('galeri/create'); ?>",
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				success: function(response) {
					Swal.fire({
						icon: 'success',
						title: 'Success',
						text: 'Galeri saved successfully'
					});
					$('#create').modal('hide');
					table.ajax.reload();
				}
			});
		});

		// Handle edit button click
		$('#galeriTable').on('click', '.btn-edit', function() {
			var id = $(this).data('id');
			$.ajax({
				url: "<?php echo site_url('galeri/get_edit/'); ?>" + id,
				type: "GET",
				success: function(response) {
					var data = JSON.parse(response);
					$('#exampleModalLabel1').text('Edit Galeri');
					$('#item-id').val(data.id); // Populate hidden input with ID 
					$('#judul').val(data.judul);
					$('#ket').val(data.ket);
					$('#tgl').val(data.tgl);
					$('#preview-gambar').attr({
						'src': '<?php echo base_url("assets/images/galeri/"); ?>' + data.file,
						'data-src': '<?php echo base_url("assets/images/galeri/"); ?>' + data.file
					});
					$('#create').modal('show');
				}
			});
		});

		// Handle delete button click
		$('#galeriTable').on('click', '.btn-delete', function() {
			var id = $(this).data('id');
			if (confirm('Are you sure you want to delete this record?')) {
				$.ajax({
					url: "<?php echo site_url('galeri/delete/'); ?>" + id,
					type: "POST",
					success: function(response) {
						table.ajax.reload();
					}
				});
			}
		});
	});
</script>
