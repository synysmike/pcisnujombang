<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/admin/assets/vendor/libs/popper/popper.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap4.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/admin/assets/vendor/js/bootstrap.js"></script> -->
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/js/menu.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- jq-magnify JS -->
<script src="<?php echo base_url(); ?>assets/admin/magnify-master/dist/jquery.magnify.js"></script>

<!-- Main JS -->
<script src="<?php echo base_url(); ?>assets/admin/assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Page JS -->


<!-- <script src="<?php echo base_url(); ?>assets/admin/assets/js/form-basic-inputs.js"></script> -->

<!-- Place this tag before closing body tag for github widget button. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<style>
	.action-column {
		width: 150px;
		/* Adjust the width as needed */
	}

	.unclickable-label {
		pointer-events: none;
		/* Make the label unclickable */
	}
</style>
<script>
	$(document).ready(function() {
		$('#kab_kota').select2({
			ajax: {
				url: "<?php echo site_url('user/get_kab_kota'); ?>",
				dataType: 'json',
				processResults: function(data) {
					return {
						results: $.map(data, function(item) {
							return {
								id: item.id,
								text: item.kabkot
							};
						})
					};
				}
			}
		});
		var levelsOptions = '';
		<?php foreach ($levels as $level): ?> levelsOptions += '<option value="<?php echo $level->id; ?>"><?php echo $level->nama_level; ?></option>';
		<?php endforeach; ?>
		var table = $('#tabel-user').DataTable({
			ajax: {
				url: '<?php echo base_url("user/get_all_users") ?>',
				type: 'post',
				dataSrc: '',
			},
			layout: {
				topStart: {
					buttons: [{
						text: 'Tambah Berita',
						className: 'btn btn-success',
						action: function(e, node, config) {
							$('#create').modal('show');
							$('[id="judul"]').val("");
							$('#isiBerita').summernote('reset');
							$("#kategori").select2("val", "");
							$("#preview").hide();
							$(".modal-title").text("Tambah Data");
						}
					}]
				}
			},
			columns: [{
					data: null, // Use null data to create a row number column
					render: function(data, type, row, meta) {
						return meta.row + 1; // Return the row number
					}
				},
				{
					"data": "id",
					"visible": false
				}, // Hide the ID column
				{
					data: 'nama',
				},
				{
					data: 'username',
				},
				{
					data: 'email',
				},
				{
					data: 'jk',
				},
				{
					data: 'm_kabkot',
				},
				{
					data: 'alamat',
				},


				// {
				// 	// proses gambar pada datatables
				// 	data: 'gambar',
				// 	render: function(data) {
				// 		return "<img class='img-thumbnail' data-magnify='gallery' data-src='<?php echo base_url(); ?>assets/images/" + data + "' src='<?php echo base_url(); ?>assets/images/" + data + "' width='80px'>";
				// 	}
				// },
				{
					"data": null,
					"className": "dt-center action-column",
					"render": function(data, type, row) {
						var selectedLevel = row.id_level;
						var approveButton = row.status === 'Approved' ? '' : '<button class="btn btn-success approve-status" type="button">Approve</button>';
						var options = levelsOptions.replace(new RegExp('value="' + selectedLevel + '"'), 'value="' + selectedLevel + '" selected');
						return ` <div class="dropdown"> <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions </button> <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <button class="dropdown-item edit" type="button">Edit</button> <button class="dropdown-item hapus" type="button">Hapus</button> <div class="dropdown-divider"></div> <label class="dropdown-item unclickable-label">Level user:</label><select class="dropdown-item level-dropdown bg-info"> ${options} </select> ${approveButton} </div> </div> `;
					}
				}

			]
		});

		// Prevent dropdown from closing when selecting a level 
		$('#tabel-user').on('click', '.level-dropdown', function(e) {
			e.stopPropagation();
			$(this).removeClass('bg-info').addClass('bg-white');
		});
		// Handle level change
		$('#tabel-user').on('change', '.level-dropdown', function() {
			var rowData = table.row($(this).parents('tr')).data();
			var userId = rowData.id;
			var level = $(this).val();
			$.ajax({
				url: "<?php echo site_url('user/update_level'); ?>",
				type: "POST",
				data: {
					id: userId,
					id_level: level
				},
				success: function(response) {
					var result = JSON.parse(response);
					if (result.status === 'success') {
						Swal.fire({
							icon: 'success',
							title: 'Success',
							text: 'Level updated successfully'
						});
						$('#tabel-user').DataTable().ajax.reload();
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'Failed to update level'
						});
						$('#tabel-user').DataTable().ajax.reload();
					}
				}
			});
		});
		// Handle status approval 
		$('#tabel-user').on('click', '.approve-status', function() {
			var rowData = table.row($(this).parents('tr')).data();
			var userId = rowData.id;
			$.ajax({
				url: "<?php echo site_url('user/update_status'); ?>",
				type: "POST",
				data: {
					id: userId,
					status: 'Approved'
				},
				success: function(response) {
					var result = JSON.parse(response);
					if (result.status === 'success') {
						Swal.fire({
							icon: 'success',
							title: 'Success',
							text: 'Approve updated successfully'
						});
						$('#tabel-user').DataTable().ajax.reload();
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'Failed to update Approve'
						});
						$('#tabel-user').DataTable().ajax.reload();
					}
				}
			});
		});
		// Handle form submission 
		$('#item-form').on('submit', function(e) {
			e.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: "<?php echo base_url('user/save'); ?>",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function(response) {
					$('#create').modal('hide');
					$('#tabel-user').DataTable().ajax.reload();
				}
			});
		});
		$('#create').on('hidden.bs.modal', function() {
			$('#item-form')[0].reset();
			$('#item-id').val('');
		});
		// Handle edit button click 
		$('#tabel-user').on('click', '.edit', function() {
			var rowData = table.row($(this).parents('tr')).data();
			var userId = rowData.id;
			$.ajax({
				url: "<?php echo site_url('user/get_user'); ?>/" + userId,
				type: "GET",
				dataType: "json",
				success: function(data) {
					$('#item-id').val(data.id);
					$('#nama').val(data.nama);
					$('#username').val(data.username);
					$('#email').val(data.email);
					$('input[name="jenis_kelamin"][value="' + data.jk + '"]').prop('checked', true);
					$('#kab_kota').val(data.id_kabkot);
					$('#alamat').val(data.alamat);
					$('#ktp').val(data.ktp);
					$('#strata').val(data.strata).trigger('change');
					$('#bidang').val(data.bidang);
					$('#hp').val(data.hp);
					$('#kec').val(data.kec);
					$('#kel').val(data.kel);
					$('#rtrw').val(data.rtrw);
					$('#create').modal('show');
				}
			});
		});
		// Handle delete button click 
		$('#tabel-user').on('click', '.hapus', function() {
			var data = $('#tabel-user').DataTable().row($(this).parents('tr')).data();
			if (confirm('Are you sure you want to delete this user?')) {
				$.ajax({
					url: "<?php echo site_url('user/delete'); ?>/" + data.id,
					type: "DELETE",
					success: function(response) {
						$('#tabel-user').DataTable().ajax.reload();
					}
				});
			}
		});

	})
</script>