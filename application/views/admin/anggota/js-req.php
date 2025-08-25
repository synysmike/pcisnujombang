<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<!-- jQuery -->

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
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<!-- jq-magnify JS -->

<!-- Select2 JS -->

<!-- Page JS -->
<!-- <script src="<?php echo base_url(); ?>assets/admin/assets/js/form-basic-inputs.js"></script> -->

<!-- GitHub Buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<script>
	$(document).ready(function() {
		$.ajaxSetup({
			cache: false
		});

		function loadSelect2Dropdown({
			url,
			target,
			selectedId = null,
			placeholder = '',
			parent = '#anggotaModal'
		}) {
			const $select = $(target);

			// Only destroy if Select2 is already initialized
			if ($select.hasClass('select2-hidden-accessible')) {
				$select.select2('destroy');
			}

			$select.empty(); // Clear options

			$.ajax({
				url: url,
				method: 'GET',
				dataType: 'json',
				cache: true,
				success: function(data) {
					$.each(data, function(index, item) {
						const selected = item.id == selectedId ? 'selected' : '';
						const label = item.name || item.nama || item.label || item.text;
						$select.append(`<option value="${item.id}" ${selected}>${label}</option>`);
					});
					$select.select2({
						placeholder: placeholder,
						dropdownParent: $(parent),
						width: '100%'
					});
				}
			});
		}


		var table = $('#anggotaTable').DataTable({
			"responsive": true,
			"ajax": {
				"url": "<?php echo site_url('anggota/fetch_all'); ?>",
				"type": "GET",
				"dataSrc": "data",
				"cache": "true",
			},
			"columns": [{
				"data": null,
				"render": function(data, type, row, meta) {
					return meta.row + 1;
				}
			}, {
				"data": "username"
			}, {
				"data": "nama"
			}, {
				"data": "position_name"
			}, {
				"data": "membership_date"
			}, {
				"data": "status"
			}, {
				"data": null,
				"render": function(data, type, row) {
					return '<button class="edit-btn btn btn-warning btn-sm" data-id="' + row.id + '">Edit</button> ' + '<button class="delete-btn btn btn-danger btn-sm" data-id="' + row.id + '">Delete</button>';
				}
			}],
			"dom": 'Bfrtip',
			"buttons": [{
				text: 'Tambah Anggota',
				className: 'btn btn-success',
				action: function(e, node, config) {
					$('#anggotaModalLabel').text('Tambah Anggota');
					$('#anggotaForm').attr('action', '<?php echo site_url('anggota/add'); ?>');
					$('#anggotaForm')[0].reset();
					$('#anggota_id').val('');

					loadSelect2Dropdown({
						url: "<?php echo site_url('user/get_all_users'); ?>",
						target: '#user_id',
						placeholder: 'Pilih Pengguna'
					});

					loadSelect2Dropdown({
						url: "<?php echo site_url('jabatan/fetch_all'); ?>",
						target: '#position_id',
						placeholder: 'Pilih Jabatan'
					});

					$('#anggotaModal').modal('show');
				}

			}]
		});

		// Populate user and position options dynamically 
		$.ajax({
			url: "<?php echo site_url('user/get_all_users'); ?>",
			method: 'GET',
			dataType: 'json',
			success: function(data) {
				var userSelect = $('#user_id');
				userSelect.empty(); // clear existing options
				$.each(data, function(index, user) {
					userSelect.append('<option value="' + user.id + '">' + user.nama + '</option>');
				});
				userSelect.select2(); // initialize Select2 after options are loaded
			}
		});

		$.ajax({
			url: "<?php echo site_url('jabatan/fetch_all'); ?>",
			method: 'GET',
			dataType: 'json',
			success: function(data) {
				var positionSelect = $('#position_id');
				$.each(data, function(index, position) {
					positionSelect.append('<option value="' + position.id + '">' + position.name + '</option>');
				});
			}
		});
		// Handle form submission for adding/editing anggota 
		$('#anggotaForm').submit(function(e) {
			e.preventDefault();
			var actionUrl = $('#anggotaForm').attr('action');
			$.ajax({
				url: actionUrl,
				method: 'POST',
				data: $(this).serialize(),
				dataType: 'json',
				success: function(response) {
					if (response.status === 'success') {
						$('#anggotaModal').modal('hide');
						table.ajax.reload();
					} else {
						alert('Failed to save anggota.');
					}
				}
			});
		});
		// Handle edit button click
		$('#anggotaTable').on('click', '.edit-btn', function() {
			const id = $(this).data('id');

			$.ajax({
				url: "<?php echo site_url('anggota/get_anggota_by_id/'); ?>" + id,
				method: 'GET',
				dataType: 'json',
				success: function(data) {
					$('#anggotaModalLabel').text('Edit Anggota');
					$('#anggotaForm').attr('action', '<?php echo site_url('anggota/edit/'); ?>' + id);
					$('#anggota_id').val(data.id);

					loadSelect2Dropdown({
						url: "<?php echo site_url('user/get_all_users'); ?>",
						target: '#user_id',
						selectedId: data.user_id,
						placeholder: 'Pilih Pengguna'
					});

					loadSelect2Dropdown({
						url: "<?php echo site_url('positions/get_all_positions'); ?>",
						target: '#position_id',
						selectedId: data.position_id,
						placeholder: 'Pilih Jabatan'
					});

					$('#membership_date').val(data.membership_date);
					$('#status').val(data.status);
					$('#anggotaModal').modal('show');
				}
			});
		});




		// Handle delete button click 
		$('#anggotaTable').on('click', '.delete-btn', function() {
			var id = $(this).data('id');
			if (confirm('Are you sure you want to delete this anggota?')) {
				$.ajax({
					url: "<?php echo site_url('anggota/delete/'); ?>" + id,
					type: 'DELETE',
					success: function(response) {
						if (response.status === 'success') {
							table.ajax.reload();
						} else {
							alert('Failed to delete anggota.');
						}
					}
				});
			}
		});
	});
</script>
