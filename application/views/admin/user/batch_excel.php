<!-- application/views/import_excel_view.php -->
<div class="container mt-5">
	<div class="card">
		<div class="card-header bg-primary text-white">
			<h5 class="card-title mb-0">Import Users from Excel</h5>
		</div>
		<div class="card-body">
			<form action="<?= base_url('registrasi/import_excel') ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="excelFile">Select Excel File (.xlsx)</label>
					<div class="custom-file">
						<input type="file" name="excelFile" class="custom-file-input" id="excelFile" accept=".xlsx" required>
						<label class="custom-file-label" for="excelFile">Choose file</label>
					</div>
					<small class="form-text text-muted">
						Ensure your file includes columns: <code>email</code>, <code>password</code>, <code>nama_lengkap</code>
					</small>
				</div>

				<button type="submit" class="btn btn-success">
					<i class="fas fa-upload"></i> Import
				</button>
			</form>
		</div>
	</div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const fileInput = document.querySelector('.custom-file-input');
		if (fileInput) {
			fileInput.addEventListener('change', function(e) {
				const fileName = e.target.files[0]?.name || 'Choose file';
				const label = e.target.nextElementSibling;
				if (label) {
					label.textContent = fileName;
				}
			});
		}
	});
</script>
