<div class="col-12">
	<div class="doc-example">
		<div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
			<div class="tab-pane fade show active" id="basic-datatable-preview" role="tabpanel" aria-labelledby="basic-datatable-preview-tab">
				<div class="card">
					<div class="card-datatable table-responsive pt-0">
						<table id="positionsTable" class="table table-striped table-bordered display responsive nowrap">
							<thead>
								<tr>
									<th>Nama Config</th>
									<th>Alamat</th>
									<th>Kontak</th>
									<th>Email</th>
									<th>Section</th>
									<th>Carousel</th>
									<th>color 1</th>
									<th>color 2</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody> </tbody>
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
				<h5 class="modal-title" id="contactModalLabel">Contact Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="contactForm">
					<div class="form-group">
						<label for="nama_config">Nama Config</label>
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
						<label for="section">Section</label>
						<select class="form-control select2" id="section" name="section" required>
							<option value="section1">Section 1</option>
							<option value="section2">Section 2</option>
							<option value="section3">Section 3</option>
						</select>
					</div>
					<div class="form-group">
						<label for="carousel">Carousel</label>
						<select class="form-control select2" id="carousel" name="carousel" required>
							<option value="carousel1">Carousel 1</option>
							<option value="carousel2">Carousel 2</option>
							<option value="carousel3">Carousel 3</option>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary" form="contactForm">Save changes</button>
			</div>
		</div>
	</div>
</div>