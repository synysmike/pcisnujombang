<!-- Basic DataTable -->
<div class="card">
	<div class="modal fade" id="basicModal" tabindex="-2" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form class="form-horizontal" id="submit">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col mb-6">
								<label for="judul" class="form-label">Judul</label>
								<input type="text" id="judul" name="judul" class="form-control" placeholder="Masukan Judul">
							</div>
						</div>
						<div class="row">
							<div class="col mb-6">
								<label for="isiBerita" class="form-label">Isi Berita</label>
								<textarea name="isiBerita" id="isiBerita"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col md-6">
								<label for="kategori" class="form-label">Pilih Kategori</label>
								<select class="form-select" id="kategori" aria-label="Multiple select example">
									<option selected="">Open this select menu</option>
									<option value="1">One</option>
									<option value="2">Two</option>
									<option value="3">Three</option>
								</select>
							</div>
							<div class="col md-6">
								<label for="kategori" class="form-label">unggah gambar</label>
								<input class="form-control" type="file" name="file" id="gambar">
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
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
							<table id="tabel-berita" class="datatables-basic table border-top">
								<thead>
									<tr>
										<th>no</th>
										<th>judul</th>
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
				<div class="tab-pane fade" id="basic-datatable-html" role="tabpanel" aria-labelledby="basic-datatable-html-tab">
					<div class="doc-clipboard">
						<button type="button" class="btn-clipboard" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard">
							Copy
						</button>
					</div>
				</div>
				<div class="tab-pane fade" id="basic-datatable-js" role="tabpanel" aria-labelledby="basic-datatable-js-tab">
					<div class="doc-clipboard">
						<button type="button" class="btn-clipboard" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard">
							Copy
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>