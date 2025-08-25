<div class="overflow-hidden space">
	<div class="container">
		<div class="row gy-30 gx-30 filter-active">
			<?php foreach ($galeri as $item): ?>
				<div class="col-md-6 col-xxl-auto col-lg-4 filter-item">
					<div class="gallery-card">
						<div class="gallery-img">
							<img src="<?= base_url('assets/images/galeri/' . $item->file) ?>" alt="<?= htmlspecialchars($item->judul) ?>">
							<a href="<?= base_url('assets/images/galeri/' . $item->file) ?>" class="icon-btn popup-image">
								<i class="fas fa-eye">
								</i>
							</a>
						</div>
					</div>
					<h3><?= $item->judul; ?></h3>
					<p><?= $item->ket; ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
