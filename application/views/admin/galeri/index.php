<div class="card">
	<div class="modal fade" id="create" tabindex="-2" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form id="galeri-form" class="form-horizontal" enctype='multipart/form-data'>
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel1">Tambah Galeri</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col mb-6">
								<label for="judul" class="form-label">Judul</label>
								<input type="text" id="judul" name="judul" class="form-control" placeholder="Masukan Judul">
								<input type="hidden" name="id" id="item-id">
							</div>
						</div>
						<div class="row">
							<div class="col mb-6">
								<label for="ket" class="form-label">Keterangan</label>
								<textarea name="ket" id="ket" class="form-control" placeholder="Masukan Keterangan"></textarea>
							</div>
						</div>
						<div id="preview" class="row">
							<div class="col md-6"></div>
							<div class="col md-6">
								<label for="preview-gambar" class="form-label">Lihat Gambar</label>
								<img id="preview-gambar" class='img-thumbnail' data-magnify='gallery' data-src='' src='' width='80px'>
							</div>
						</div>
						<div class="row">
							<div class="col md-6">
								<label for="file" class="form-label">Unggah Gambar</label>
								<input class="form-control" type="file" name="file" id="file">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
						<button id="btn_simpan" type="submit" class="btn btn-primary">Simpan Galeri</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<div class="col-12">
	<div class="doc-example">
		<div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
			<div class="tab-pane fade show active" id="basic-datatable-preview" role="tabpanel" aria-labelledby="basic-datatable-preview-tab">
				<div class="card">
					<div class="card-datatable table-responsive pt-0">
						<table id="galeriTable" class="datatables-basic table border-top">
							<thead>
								<tr>
									<th>No.</th>
									<th>Judul</th>
									<th>File</th>
									<th>Keterangan</th>
									<th>Tanggal</th>
									<th>Uploader</th>
									<th>Aksi</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>