<div class="col-12">
	<div class="doc-example">
		<div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
			<div class="tab-pane fade show active" id="basic-datatable-preview" role="tabpanel" aria-labelledby="basic-datatable-preview-tab">
				<div class="card">
					<div class="card-datatable table-responsive pt-0">
						<table id="configTable" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Config Profile Name</th>
									<th>Color 1</th>
									<th>Color 2</th>
									<th>Array of ID Section</th>
									<th>Array of ID Carousel</th>
									<th>Date of Creation</th>
									<!-- <th>Soft Deletes Date</th> -->
									<th>Alamat</th>
									<th>Kontak</th>
									<th>Email</th>
									<th>Action</th>
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
<div class="modal fade" id="sectionModal" tabindex="-1" role="dialog" aria-labelledby="sectionModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="sectionModalLabel">Section Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="sectionForm">
					<div class="form-group">
						<label for="section_name">Section Name</label>
						<input type="text" class="form-control" id="section_name" name="section_name" required>
					</div>
					<div class="form-group">
						<label for="section_content">Section Content</label>
						<textarea class="form-control summernote" id="section_content" name="section_content" required></textarea>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" form="sectionForm">Save changes</button>
					</div>
				</form>

				<div class="card mt-4">
					<div class="card-datatable table-responsive pt-0">
						<table id="sectionTable" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No.</th>
									<th>Section Name</th>
									<th>Section Content</th>
									<th>Created_at</th>
									<th>Action</th>
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
				<h5 class="modal-title" id="carouselModalLabel">Carousel Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="carouselForm" enctype="multipart/form-data">
					<div class="form-group">
						<label for="title">Carousel Name</label>
						<input type="text" class="form-control" id="title" name="title" required>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea class="form-control" id="description" name="description" required></textarea>
					</div>
					<div class="form-group">
						<label for="picture">Images</label>
						<input type="file" class="form-control" id="picture" name="picture" required>
						<img id="carouselImage" src="#" alt="Carousel Image" style="display:none; width: 100px; height: auto; margin-top: 10px;">
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" form="carouselForm">Save changes</button>
					</div>
				</form>

				<div class="card mt-4">
					<div class="card-datatable table-responsive pt-0">
						<table id="carouselTable" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>No.</th>
									<th>Carousel Name</th>
									<th>Description</th>
									<th>Images</th>
									<th>Created_at</th>
									<th>Action</th>
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
						<label for="color_1">Pilih Warna 1</label>
						<input type="color" class="form-control" id="color_1" name="color_1" required>
					</div>
					<div class="form-group">
						<label for="color_2">Pilih Warna 2</label>
						<input type="color" class="form-control" id="color_2" name="color_2" required>
					</div>
					<div class="form-group">
						<label for="section">Section</label>
						<select class="form-control select2" id="section" name="section[]" multiple="multiple" required>

						</select>
					</div>
					<div class="form-group">
						<label for="carousel">Carousel</label>
						<select class="form-control select2" id="carousel" name="carousel[]" multiple="multiple" required>
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