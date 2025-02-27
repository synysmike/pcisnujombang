<div class="card">
	<div class="modal fade" id="create" tabindex="-2" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form class="form-horizontal" id="item-form" enctype='multipart/form-data'>
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel1">Form Pendaftaran</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col mb-6">
								<label for="nama" class="form-label">Nama</label>
								<input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama" required>
								<input type="hidden" name="id" id="item-id">
							</div>
						</div>
						<div class="row">
							<div class="col mb-6">
								<label for="username" class="form-label">Username</label>
								<input type="text" id="username" name="username" class="form-control" placeholder="Masukan Username" required>
							</div>
						</div>
						<div class="row">
							<div class="col mb-6">
								<label for="password" class="form-label">Password</label>
								<input type="password" id="password" name="password" class="form-control" placeholder="Masukan Password" required>
							</div>
						</div>
						<div class="row">
							<div class="col mb-6">
								<label for="email" class="form-label">Email</label>
								<input type="email" id="email" name="email" class="form-control" placeholder="Masukan Email" required>
							</div>
						</div>
						<div class="row">
							<div class="col mb-6">
								<label class="form-label">Jenis Kelamin</label>
								<div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="Laki-laki" required>
										<label class="form-check-label" for="laki-laki">Laki-laki</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" required>
										<label class="form-check-label" for="perempuan">Perempuan</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col mb-6">
								<label for="kab_kota" class="form-label">Kabupaten/Kota Jawa Timur</label>
								<select class="form-select" id="kab_kota" name="kab_kota" required>
									<option>Pilih Kabupaten/Kota</option>
									<!-- Tambahkan opsi lainnya sesuai kebutuhan -->
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col mb-6">
								<label for="alamat" class="form-label">Alamat</label>
								<textarea name="alamat" id="alamat" class="form-control" rows="4" placeholder="Masukan Alamat" required></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col mb-6"> <label for="ktp" class="form-label">KTP</label> <input type="text" id="ktp" name="ktp" class="form-control" placeholder="Masukan KTP" required> </div>
						</div>
						<div class="row">
							<div class="col mb-6">
								<label for="strata" class="form-label">Strata</label>
								<select class="form-select" id="strata" name="strata" required>
									<option>Pilih Strata</option>
									<option>S1</option>
									<option>S2</option>
									<option>S3</option>
									<!-- Tambahkan opsi lainnya sesuai kebutuhan -->
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col mb-6"> <label for="bidang" class="form-label">Bidang</label>
								<input type="text" id="bidang" name="bidang" class="form-control" placeholder="Masukan Bidang" required>
							</div>
						</div>
						<div class="row">
							<div class="col mb-6"> <label for="hp" class="form-label">HP</label> <input type="text" id="hp" name="hp" class="form-control" placeholder="Masukan HP" required> </div>
						</div>
						<div class="row">
							<div class="col mb-6"> <label for="kec" class="form-label">Kecamatan</label> <input type="text" id="kec" name="kec" class="form-control" placeholder="Masukan Kecamatan" required> </div>
						</div>
						<div class="row">
							<div class="col mb-6"> <label for="kel" class="form-label">Kelurahan</label> <input type="text" id="kel" name="kel" class="form-control" placeholder="Masukan Kelurahan" required> </div>
						</div>
						<div class="row">
							<div class="col mb-6"> <label for="rtrw" class="form-label">RT/RW</label> <input type="text" id="rtrw" name="rtrw" class="form-control" placeholder="Masukan RT/RW" required> </div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
						<button id="btn_simpan" type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>

</div>
<section class="section">
	<div class="section-body">
		<div class="col-12">
			<div class="doc-example">
				<div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
					<div class="tab-pane fade show active" id="basic-datatable-preview" role="tabpanel" aria-labelledby="basic-datatable-preview-tab">
						<div class="card">
							<div class="card-header d-flex justify-content-center align-items-center">
								<h3>Manajemen User</h3>
							</div>
							<div class="card-body">
								<div class="card-datatable table-responsive pt-0 d-flex justify-content-center">
									<table id="tabel-user" class="display responsive nowrap">
										<thead>
											<tr>
												<th>No</th>
												<th>id</th>
												<th>Nama</th>
												<th>Username</th>
												<th>Email</th>
												<th>Jenis Kelamin</th>
												<th>Kabupaten/Kota</th>
												<th>Alamat</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<!-- Data akan diisi oleh DataTables -->
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
</section>