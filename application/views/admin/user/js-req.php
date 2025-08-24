<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/admin/magnify-master/dist/jquery.magnify.js"></script>


<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- jq-magnify JS -->
<!-- GitHub Buttons -->
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



		var levelsOptions = ''; // Example options, replace with actual options
		<?php foreach ($levels as $level): ?> levelsOptions += '<option value="<?php echo $level->id; ?>"><?php echo $level->nama_level; ?></option>';
		<?php endforeach; ?>
		var table = $('#tabel-user').DataTable({
			responsive: true,
			ajax: {
				url: '<?php echo base_url("user/get_all_users") ?>',
				type: 'post',
				dataSrc: '',
			},

			columns: [{
					data: null, // Use null data to create a row number column
					render: function(data, type, row, meta) {
						return meta.row + 1; // Return the row number
					}
				},
				// Hide the ID column
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
						var id_row = data.id
						var selectedLevel = row.id_level;
						var approveButton = row.status === 'Approved' ? '' : '<button class="btn btn-success approve-status" type="button">Approve</button>';
						var options = levelsOptions.replace(new RegExp('value="' + selectedLevel + '"'), 'value="' + selectedLevel + '" selected');
						return ` <div class="dropdown"> 
						<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Actions 
						</button> <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
						<button class="dropdown-item edit" data-id="${id_row}" type="button">Edit</button>
						<button class="dropdown-item hapus" type="button">Hapus</button> <div class="dropdown-divider"></div> <label class="dropdown-item unclickable-label">Level user:</label> <select class="dropdown-item level-dropdown bg-default"> ${options} </select> ${approveButton} </div> </div> `;
					}
				}
			],
			dom: 'Bfrtip',
			"buttons": [{
				text: 'Tambah User',
				className: 'btn btn-success',
				action: function(e, node, config) {
					$('#create').modal('show');
					loadKabKota();
					$('[id="judul"]').val("");
					$('#isiBerita').summernote('reset');
					$("#kategori").select2("val", "");
					$("#preview").hide();
					$(".modal-title").text("Tambah Data");
				}
			}],

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

		function loadKabKota(selectedId = null) {
			// Clear and show loading placeholder
			$('#kab_kota').empty().append(
				new Option('Loading...', '', false, false)
			);

			// Fetch kab/kota list via AJAX
			$.ajax({
				url: "<?php echo base_url('user/get_kab_kota'); ?>",
				dataType: 'json',
				success: function(data) {
					$('#kab_kota').empty(); // Remove loading option
					const kabkotOptions = $.map(data, function(item) {
						return {
							id: item.id,
							text: item.kabkot
						};
					});

					// Inject all options
					kabkotOptions.forEach(function(opt) {
						const isSelected = selectedId !== null && opt.id == selectedId;
						$('#kab_kota').append(new Option(opt.text, opt.id, isSelected, isSelected));
					});

					// Initialize Select2 (or re-init if already applied)
					$('#kab_kota').select2({
						theme: 'bootstrap-5'
					});
				}
			});
		}



		// Event listeners for the dropdown actions 
		$('#tabel-user').on('click', '.edit', function() {
			const userId = $(this).data('id'); // ← This grabs the injected ID
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
					loadKabKota(data.id_kabkot);

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
		$('#tabel-user').on('click', '.hapus', function() {
			var rowIndex = table.row($(this).closest('tr')).index();
			var rowData = table.rows(rowIndex).data()[0];
			if (confirm('Are you sure you want to delete this user?')) {
				$.ajax({
					url: "<?php echo site_url('user/delete'); ?>/" + rowData.id,
					type: "DELETE",
					success: function(response) {
						$('#tabel-user').DataTable().ajax.reload();
					}
				});
			}
		});
		$('#tabel-user').on('change', '.level-dropdown', function(e) {
			e.stopPropagation();
			$(this).removeClass('bg-info').addClass('bg-white');
			var rowIndex = table.row($(this).closest('tr')).index();
			var rowData = table.rows(rowIndex).data()[0];
			if (rowData && rowData.id) {
				var userId = rowData.id; // Handle edit action with userId 
			} else {
				console.error('ID not found in rowData');
				// Handle the case where ID is not found
			}
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
		$('#tabel-user').on('click', '.approve-status', function() {
			var rowIndex = table.row($(this).closest('tr')).index();
			var rowData = table.rows(rowIndex).data()[0];
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

	})
</script>
