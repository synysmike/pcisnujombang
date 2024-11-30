<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap4.js"></script>

<!-- Popper.js -->
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/libs/popper/popper.js"></script>

<!-- Bootstrap JS (local) -->
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/js/bootstrap.js"></script>

<!-- Perfect Scrollbar -->
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<!-- Menu JS -->
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/js/menu.js"></script>

<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- jq-magnify JS -->
<script src="<?php echo base_url(); ?>assets/admin/magnify-master/dist/jquery.magnify.js"></script>

<!-- Main JS -->
<script src="<?php echo base_url(); ?>assets/admin/assets/js/main.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Page JS -->
<!-- <script src="<?php echo base_url(); ?>assets/admin/assets/js/form-basic-inputs.js"></script> -->

<!-- GitHub Buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>



<script>
	$(document).ready(function() {
		var table = $('#galeriTable').DataTable({
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
							return '<img src="<?php echo base_url("assets/images/"); ?>' + data + '" class="img-thumbnail" data-magnify="gallery" data-src="<?php echo base_url("assets/images/"); ?>' + data + '" width="80px">';
						} else {
							return 'No Image';
						}
					}
				},
				{
					"data": "ket"
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
					$('#preview-gambar').attr('src', '<?php echo base_url("assets/images/"); ?>' + data.file);
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