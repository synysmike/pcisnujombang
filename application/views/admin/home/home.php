<section class="section">
	<div class="section-body">
		<div class="col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-center align-items-center">
					<h3>Manajemen Konfigurasi</h3>
				</div>
				<div class="card-body">
					<div class="doc-example">
						<div class="tab-content doc-example-content" id="tab-tabContent" data-label="Contoh">
							<div class="tab-pane fade show active" id="basic-datatable-preview" role="tabpanel" aria-labelledby="basic-datatable-preview-tab">
								<div class="card">
									<div class="card-datatable table-responsive pt-0 d-flex justify-content-center">
										<table id="configTable" class="table table-striped table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>No.</th>
													<th>Nama Profil Konfigurasi</th>
													<th>Warna 1</th>
													<th>Warna 2</th>
													<th>Array ID Seksi</th>
													<th>Array ID Karusel</th>
													<th>Tanggal Pembuatan</th>
													<!-- <th>Tanggal Penghapusan Lunak</th> -->
													<th>Alamat</th>
													<th>Kontak</th>
													<th>Email</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
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
</section>
<!-- Modal -->
<div class="modal fade" id="sectionModal" tabindex="-1" role="dialog" aria-labelledby="sectionModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="sectionModalLabel">Informasi Seksi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="sectionForm">
					<div class="form-group">
						<label for="section_name">Nama Seksi</label>
						<input type="text" class="form-control" id="section_name" name="section_name" required>
					</div>
					<div class="form-group">
						<label for="section_content">Konten Seksi</label>
						<textarea class="form-control summernote" id="section_content" name="section_content" required></textarea>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" form="sectionForm">Simpan Perubahan</button>
					</div>
				</form>

				<div class="card mt-4">
					<div class="card-datatable table-responsive pt-0">
						<table id="sectionTable" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama Seksi</th>
									<th>Konten Seksi</th>
									<th>Dibuat Pada</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="carouselModal" tabindex="-1" role="dialog" aria-labelledby="carouselModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="carouselModalLabel">Informasi Karusel</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="carouselForm" enctype="multipart/form-data">
					<div class="form-group">
						<label for="title">Nama Karusel</label>
						<input type="text" class="form-control" id="title" name="title" required>
					</div>
					<div class="form-group">
						<label for="description">Deskripsi</label>
						<textarea class="form-control" id="description" name="description" required></textarea>
					</div>
					<div class="form-group">
						<label for="picture">Gambar</label>
						<input type="file" class="form-control" id="picture" name="picture" required>
						<img id="carouselImage" src="#" alt="Gambar Karusel" style="display:none; width: 100px; height: auto; margin-top: 10px;">
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" form="carouselForm">Simpan Perubahan</button>
					</div>
				</form>

				<div class="card mt-4">
					<div class="card-datatable table-responsive pt-0">
						<table id="carouselTable" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama Karusel</th>
									<th>Deskripsi</th>
									<th>Gambar</th>
									<th>Dibuat Pada</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="contactModalLabel">Informasi Kontak</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="contactForm">
					<div class="form-group">
						<label for="nama_config">Nama Konfigurasi</label>
						<input type="text" class="form-control" id="nama_config" name="nama_config" required>
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<input type="text" class="form-control" id="alamat" name="alamat" required>
					</div>
					<div class="form-group">
						<label for="kontak">Kontak</label>
						<input type="text" class="form-control" id="kontak" name="kontak" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" required>
					</div>
					<div class="form-group">
						<label for="color_1">Pilih Warna 1</label>
						<input type="color" class="form-control" id="color_1" name="color_1" required>
					</div>
					<div class="form-group">
						<label for="color_2">Pilih Warna 2</label>
						<input type="color" class="form-control" id="color_2" name="color_2" required>
					</div>
					<div class="form-group">
						<label for="section">Seksi</label>
						<select class="form-control select2" id="section" name="section[]" multiple="multiple" required>

						</select>
					</div>
					<div class="form-group">
						<label for="carousel">Karusel</label>
						<select class="form-control select2" id="carousel" name="carousel[]" multiple="multiple" required>
							<option value="carousel1">Karusel 1</option>
							<option value="carousel2">Karusel 2</option>
							<option value="carousel3">Karusel 3</option>
						</select>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary" form="contactForm">Simpan Perubahan</button>
			</div>
		</div>
	</div>
</div>