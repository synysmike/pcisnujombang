<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/libs/popper/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/js/menu.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- endbuild -->

<!-- jq-magnify JS -->
<script src="<?php echo base_url(); ?>assets/admin/magnify-master/dist/jquery.magnify.js"></script>

<!-- Main JS -->
<script src="<?php echo base_url(); ?>assets/admin/assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Page JS -->


<!-- <script src="<?php echo base_url(); ?>assets/admin/assets/js/form-basic-inputs.js"></script> -->

<!-- Place this tag before closing body tag for github widget button. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<script>
	$(document).ready(function() {

		$('#isiBerita').summernote();
		$('#kategori').select2({
			dropdownParent: $("#create")
		});

		DataTable.ext.buttons.alert = {
			className: 'buttons-info',
			action: function(e, dt, node, config) {
				$('#basicModal').show()
			}
		};

		// Datatables AJAX
		var table = $('#tabel-berita').DataTable({
			ajax: {
				url: '<?php echo base_url("home/get_all_berita") ?>',
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
							$(".modal-title").text("Tambah Data");
						}
					}]
				}
			},
			columns: [


				{
					data: 'id',
				},
				{
					data: 'judul',
				},
				{
					data: 'id_kat',
				},
				{
					data: 'isi',
				},
				{
					data: 'tgl',
				},
				{
					// proses gambar pada datatables
					data: 'gambar',
					render: function(data) {
						// return '<img width="80px" class="img-thumbnail" data-magnify="gallery" data-src="<?php echo base_url(); ?>assets/images/' + data ' src="images/1716811639.png" alt="">';
						return "<img class='img-thumbnail' data-magnify='gallery' data-src='<?php echo base_url(); ?>assets/images/" + data + "' src='<?php echo base_url(); ?>assets/images/" + data + "' width='80px'>";
					}
				},

				{
					// button aksi(refrensi :https://stackoverflow.com/questions/54930978/datatables-show-column-data-in-modal)
					render: function(data, type, row) {
						return '<button class="btn btn-info edit" type="button" >' + "Edit" + '</button> <button class="btn btn-danger hapus" type="button" >' + "Hapus" + '</button>'
					}


				},
			]
		});


		//gallery_Magnify.js
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
		// set button dan fungsi edit
		$('#tabel-berita tbody').on('click', '.edit', function() {
			$('#create').modal('show');
			$(".modal-title").text("Edit Data");
			var row = $(this).closest('tr');
			var id = table.row(row).data().id;
			$.get("home/get_berita/" + id, function(data) {
				console.log(data);

			});
			return false;
		});


		// set button dan fungsi hapus
		$('#tabel-berita tbody').on('click', '.hapus', function() {
			var row = $(this).closest('tr');
			Swal.fire({
				title: "Apakah anda yakin menghapus data ini?",
				showDenyButton: true,
				confirmButtonText: "Yakin",
				denyButtonText: `Batal`
			}).then((result) => {
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {
					var id = table.row(row).data().id;
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('home/hapus_berita') ?>",
						dataType: "JSON",
						data: {
							id: id
						},
						success: function(data) {
							Swal.fire("Data Terhapus", "", "success");
							$('#tabel-berita').DataTable().ajax.reload();
						}
					});
					return false;

				} else if (result.isDenied) {
					Swal.fire("Batal Hapus!", "", "info");
				}
			});

		});




		// Simpan Barang
		$('#btn_simpan').on('click', function(e) {
			e.preventDefault();
			const formData = new FormData($('#submit')[0]);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('home/simpan_berita') ?>",
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

		//GET HAPUS
		$('#show_data').on('click', '.item_hapus', function() {
			var id = $(this).attr('data');
			$('#ModalHapus').modal('show');
			$('[name="kode"]').val(id);
		});







	})
</script>