<div class="container mt-4">
	<h2 class="text-center mb-5">Struktur Organisasi PC ISNU JOMBANG</h2>

	<div class="row">
		<?php foreach ($struktur as $level => $roles): ?>
			<div class="col-4 mb-5">
				<div class="d-flex flex-wrap justify-content-start gap-4">
					<?php foreach ($roles as $role => $members): ?>
						<div class="card shadow-sm h-100" style="flex: 1 1 300px; max-width: 100%;">
							<div class="card-header bg-gradient bg-primary text-white">
								<div class="d-flex justify-content-between align-items-center">
									<h5 class="mb-0"><?= $role ?></h5>
									<span class="badge bg-light text-dark"><?= count($members) ?> anggota</span>
								</div>
							</div>
							<div class="card-body">
								<ul class="list-unstyled">
									<?php foreach ($members as $name): ?>
										<li class="mb-2">
											<i class="bi bi-person-circle me-2 text-primary"></i>
											<?= $name ?>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
