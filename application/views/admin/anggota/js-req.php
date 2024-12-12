<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<!-- jQuery -->
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

<!-- Main JS -->
<script src="<?php echo base_url(); ?>assets/admin/assets/js/main.js"></script>

<!-- Select2 JS -->

<!-- Page JS -->
<!-- <script src="<?php echo base_url(); ?>assets/admin/assets/js/form-basic-inputs.js"></script> -->

<!-- GitHub Buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>



<script>
	$(document).ready(function() {

		var table = $('#anggotaTable').DataTable({
			"responsive": true,
			"ajax": {
				"url": "<?php echo site_url('anggota/fetch_all'); ?>",
				"type": "GET",
				"dataSrc": ""
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
				$.each(data, function(index, user) {
					userSelect.append('<option value="' + user.id + '">' + user.username + '</option>');
				});
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
			var id = $(this).data('id');
			$.ajax({
				url: "<?php echo site_url('anggota/get_anggota_by_id/'); ?>" + id,
				method: 'GET',
				dataType: 'json',
				success: function(data) {
					$('#anggotaModalLabel').text('Edit Anggota');
					$('#anggotaForm').attr('action', '<?php echo site_url('anggota/edit/'); ?>' + id);
					$('#anggota_id').val(data.id);
					// Populate user select and set selected value 
					$.ajax({
						url: "<?php echo site_url('user/get_all_users'); ?>",
						method: 'GET',
						dataType: 'json',
						success: function(users) {
							var userSelect = $('#user_id');
							userSelect.empty();
							$.each(users, function(index, user) {
								var selected = user.id == data.user_id ? 'selected' : '';
								userSelect.append('<option value="' + user.id + '" ' + selected + '>' + user.username + '</option>');
							});
						}
					}); // Populate position select and set selected value 
					$.ajax({
						url: "<?php echo site_url('positions/get_all_positions'); ?>",
						method: 'GET',
						dataType: 'json',
						success: function(positions) {
							var positionSelect = $('#position_id');
							positionSelect.empty();
							$.each(positions, function(index, position) {
								var selected = position.id == data.position_id ? 'selected' : '';
								positionSelect.append('<option value="' + position.id + '" ' + selected + '>' + position.name + '</option>');
							});
						}
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