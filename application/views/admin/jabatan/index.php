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
<div class="col-12">
	<div class="doc-example">
		<div class="tab-content doc-example-content" id="tab-tabContent" data-label="Example">
			<div class="tab-pane fade show active" id="basic-datatable-preview" role="tabpanel" aria-labelledby="basic-datatable-preview-tab">
				<div class="card">
					<div class="card-datatable table-responsive pt-0">
						<table id="positionsTable" class="display responsive nowrap">
							<thead>
								<tr>
									<th>Index</th>
									<th>Name</th>
									<th>Parent Position</th>
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


<!-- Modal for Adding/Editing Position -->
<div class="modal fade" id="positionModal" tabindex="-1" aria-labelledby="positionModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="positionModalLabel">Tambah Position</h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="positionForm"> <input type="hidden" id="position_id" name="position_id">
					<div class="mb-3"> <label for="name" class="form-label">Name</label> <input type="text" id="name" name="name" class="form-control"> </div>
					<div class="mb-3"> <label for="parent_id" class="form-label">Parent Position</label> <select id="parent_id" name="parent_id" class="form-select">
							<option value="">None</option> <!-- Options will be populated dynamically -->
						</select> </div> <button type="submit" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>