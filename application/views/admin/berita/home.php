<!-- Basic DataTable -->
<!-- <style>
	body {
		font-family: Arial, sans-serif;
		background-color: #f8f9fa;
		margin: 0;
		padding: 20px;
	}

	.modal {
		z-index: 1050;
	}

	.modal-backdrop {
		z-index: 1040;
	}

	.card {
		background-color: #fff;
		border: 1px solid #dee2e6;
		border-radius: 0.25rem;
		box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		padding: 20px;
		margin-bottom: 20px;
	}

	.card-datatable {
		overflow-x: auto;
	}

	.actions {
		display: flex;
		gap: 10px;
	}

	.dataTables_wrapper .dataTables_filter {
		float: right;
		text-align: right;
	}

	.dataTables_wrapper .dataTables_paginate {
		float: right;
		text-align: right;
	}

	.dataTables_wrapper .dataTables_info {
		float: left;
	}
</style> -->

<div class="card">
	<div class="modal fade" id="createCategory" tabindex="-2" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<form id="category-form" class="form-horizontal" id="submit" enctype='multipart/form-data'>
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel2">Tambah Kategori</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row mb-3">
							<div class="col mb-6">
								<label for="categoryName" class="form-label">Nama Kategori</label>
								<input type="text" id="categoryName" name="categoryName" class="form-control" placeholder="Masukan Nama Kategori">
								<input type="hidden" name="id" id="category-id">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col mb-6">
								<label for="categoryDescription" class="form-label">Deskripsi Kategori</label>
								<textarea name="categoryDescription" id="categoryDescription" class="form-control" placeholder="Masukan Deskripsi Kategori"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<table id="tabel-kategori" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>#</th>
											<th>Nama Kategori</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										<!-- Data will be populated by DataTables -->
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
						<button id="btn_simpan_kategori" type="submit" class="btn btn-primary">Simpan Kategori</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>







<div class="card">
	<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form id="item-form" class="form-horizontal" enctype='multipart/form-data'>
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<label for="judul" class="form-label">Judul</label>
								<input type="text" id="judul" name="judul" class="form-control" placeholder="Masukan Judul">
								<input type="hidden" name="id" id="item-id">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="isiBerita" class="form-label">Isi Berita</label>
								<textarea name="isiBerita" id="isiBerita" class="form-control"></textarea>
							</div>
						</div>
						<div id="preview" class="row">
							<div class="col-md-6"></div>
							<div class="col-md-6">
								<label for="kategori" class="form-label">Lihat Gambar</label>
								<img id="preview-gambar" class="img-thumbnail" data-magnify="gallery" data-src="" src="" width="80px">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label for="kategori" class="form-label">Pilih Kategori</label>
								<select class="form-control select2" name="kategori" id="kategori" aria-label="Multiple select example">
									<option value="" disabled selected>-- Pilih Kategori --</option>
									<!-- Options will be populated by JavaScript -->
								</select>
							</div>
							<div class="col-md-6">
								<label for="file" class="form-label">Unggah Gambar</label>
								<input class="form-control" type="file" name="file" id="file">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button id="btn_simpan" type="submit" class="btn btn-primary">Simpan Berita</button>
					</div>
				</div>
			</form>
		</div>
	</div>


	<div class="col-12">
		<div class="doc-example">
			<div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
				<div class="tab-pane fade show active" id="basic-datatable-preview" role="tabpanel" aria-labelledby="basic-datatable-preview-tab">
					<div class="card">
						<div class="card-datatable table-responsive pt-0">
							<table id="tabel-berita" class="display responsive nowrap">
								<thead>
									<tr>
										<th>no</th>
										<th>id</th>
										<th>judul</th>
										<th>kategori</th>
										<th>isi</th>
										<th>tanggal</th>
										<th>gambar</th>
										<th>Action</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>