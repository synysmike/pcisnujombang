<style>
	.preview {
		max-height: 100px;
		overflow: hidden;
	}

	.full-text {
		display: block;
	}
</style>
<section class="section">
	<div class="section-body">
		<div class="col-12">
			<div class="doc-example">
				<div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
					<div class="tab-pane fade show active" id="basic-datatable-preview" role="tabpanel" aria-labelledby="basic-datatable-preview-tab">
						<div class="card">
							<div class="container mt-5">
								<h1 class="mb-4">Profil</h1>
								<div id="profile" class="mb-4">
									<div class="mb-3">
										<h3><strong>Visi:</strong></h3> <span id="visi" class="preview"></span>
										<button id="edit-visi" class="btn btn-primary btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#editModal" data-field="visi">Edit Visi</button>
										<button id="read-more-visi" class="btn btn-link btn-sm">Read More</button>
									</div>
									<hr>
									<div class="mb-3">
										<h3><strong>Misi:</strong></h3> <span id="misi" class="preview"></span>
										<button id="edit-misi" class="btn btn-primary btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#editModal" data-field="misi">Edit Misi</button>
										<button id="read-more-misi" class="btn btn-link btn-sm">Read More</button>
									</div>
									<hr>
									<div class="mb-3">
										<h3><strong>Sejarah:</strong></h3> <span id="sejarah" class="preview"></span>
										<button id="edit-sejarah" class="btn btn-primary btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#editModal" data-field="sejarah">Edit Sejarah</button>
										<button id="read-more-sejarah" class="btn btn-link btn-sm">Read More</button>
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

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editModalLabel">Edit</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body"> <textarea id="editor" class="summernote"></textarea> </div>
			<div class="modal-footer"> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button> </div>
		</div>
	</div>
</div>