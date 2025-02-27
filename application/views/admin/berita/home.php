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
<style>
	.select2-container {
		width: 100% !important;
		/* Adjust the width as needed */
		z-index: 1060 !important;
		/* Set the desired z-index */
	}

	.isi-column {
		word-wrap: break-word;
		white-space: normal;
		vertical-align: top;
	}
</style>

<div class="modal fade" id="createCategory" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document"> <!-- Add modal-lg class here -->
		<form id="category-form" class="form-horizontal" enctype='multipart/form-data'>
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
					<div class="container mt-5">
						<div class="card-datatable table-responsive pt-0 justify-content-center">
							<table id="tabel-kategori" class="display responsive nowrap">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama Kategori</th>
										<th>Deskripsi</th>
										<th>Actions</th>
									</tr>
								</thead>
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
						<div class="form-group row">
							<label for="judul" class="col-md-4 col-form-label">Judul</label>
							<div class="col-md-8">
								<input type="text" id="judul" name="judul" class="form-control" placeholder="Masukan Judul">
								<input type="hidden" name="id" id="item-id">
							</div>
						</div>
						<div class="form-group row">
							<label for="isiBerita" class="col-md-4 col-form-label">Isi Berita</label>
							<div class="col-md-8">
								<textarea name="isiBerita" id="isiBerita" class="form-control"></textarea>
							</div>
						</div>
						<div id="preview" class="form-group row">
							<label for="kategori" class="col-md-4 col-form-label">Lihat Gambar</label>
							<div class="col-md-8">
								<img id="preview-gambar" class="img-thumbnail" data-magnify="gallery" data-src="" src="" width="80px">
							</div>
						</div>
						<div class="form-group row">
							<label for="kategori" class="col-md-4 col-form-label">Pilih Kategori</label>
							<div class="col-md-8">
								<select class="form-control select2" name="kategori" id="kategori" aria-label="Multiple select example">
									<option value="" disabled selected>-- Pilih Kategori --</option>
									<!-- Options will be populated by JavaScript -->
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="file" class="col-md-4 col-form-label">Unggah Gambar</label>
							<div class="col-md-8">
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
</div>
<section class="section">
	<div class="section-body">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-center align-items-center">
					<h3>Manajemen Berita</h3>
				</div>
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">Tambah Berita</button>
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategory">Tambah Kategori</button>
					</div>
					<div class="doc-example">
						<div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
							<div class="tab-pane fade show active" id="basic-datatable-preview" role="tabpanel" aria-labelledby="basic-datatable-preview-tab">
								<div class="card">
									<div class="container mt-5">
										<div class="card-datatable table-responsive pt-0 justify-content-center">
											<table id="tabel-berita" class="display responsive">
												<thead>
													<tr>
														<th>no</th>
														<!-- <th>id</th> -->
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
			</div>
		</div>
	</div>
</section>