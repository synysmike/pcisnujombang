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
							<div class="card-header d-flex justify-content-center align-items-center">

								<h3>Manajemen Video Carousel</h3>
							</div>
							<div class="container">
								<div id="profile" class="mb-4">
									<div class="mb-3">										
										<form action="<?php echo base_url('home/jumbotron_update') ?>" method="post">
                                            <div class="form-group">
                                                <label for="">ID Video Youtube</label>
                                                <input type="text" name="youtube_id" id="youtube_id" class="form-control" required value="<?php echo $jumbotron->youtube_id ?>">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
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