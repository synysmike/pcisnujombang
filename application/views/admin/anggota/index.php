<style>
	body {
		font-family: Arial, sans-serif;
		background-color: #f8f9fa;
		margin: 0;
		padding: 20px;
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
</style>
<section class="section">
	<div class="section-body">
		<div class="col-12">
			<div class="doc-example">
				<div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
					<div class="tab-pane fade show active" id="basic-datatable-preview" role="tabpanel" aria-labelledby="basic-datatable-preview-tab">
						<div class="card">
							<div class="card-datatable table-responsive pt-0 d-flex justify-content-center">
								<table id="anggotaTable" class="display responsive nowrap">
									<thead>
										<tr>
											<th>No.</th>
											<th>Username</th>
											<th>Nama</th>
											<th>Position</th>
											<th>Membership Date</th>
											<th>Status</th>
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
	</div>
</section>

<!-- Modal -->
<div class="modal fade" id="anggotaModal" tabindex="-1" aria-labelledby="anggotaModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="anggotaModalLabel">Tambah Anggota</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="anggotaForm"> <input type="hidden" id="anggota_id" name="anggota_id">
					<div class="mb-3"> <label for="user_id" class="form-label">User</label> <select id="user_id" name="user_id" class="form-select"> <!-- Options will be populated dynamically --> </select> </div>
					<div class="mb-3"> <label for="position_id" class="form-label">Position</label> <select id="position_id" name="position_id" class="form-select"> <!-- Options will be populated dynamically --> </select> </div>
					<div class="mb-3"> <label for="membership_date" class="form-label">Membership Date</label> <input type="date" id="membership_date" name="membership_date" class="form-control"> </div>
					<div class="mb-3"> <label for="status" class="form-label">Status</label> <input type="text" id="status" name="status" class="form-control"> </div> <button type="submit" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>