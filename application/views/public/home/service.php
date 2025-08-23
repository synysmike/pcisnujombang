<style>
	.modal {
		display: none;
		position: fixed;
		z-index: 9999;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.6);
		overflow: auto;
		/* Enables scrolling if modal content is tall */
		padding-top: 80px;
		/* Pushes modal down from top to avoid nav overlap */
		box-sizing: border-box;
		scroll-behavior: smooth;
	}

	.modal-content {
		background: #fff;
		margin: auto;
		padding: 30px;
		border-radius: 8px;
		max-width: 600px;
		width: 90%;
		max-height: calc(100vh - 160px);
		/* Prevents modal from exceeding viewport */
		overflow-y: auto;
		/* Enables internal scroll */
		position: relative;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
	}



	.modal .close {
		position: absolute;
		top: 15px;
		right: 20px;
		font-size: 24px;
		cursor: pointer;
	}
</style>
<?php
function limitText($text, $limit = 150)
{
	return strlen($text) > $limit ? substr($text, 0, $limit) . '...' : $text;
}
?>
<section class="overflow-hidden space" id="service-sec" data-bg-src="<?php echo base_url(); ?>assets/public/assets/img/bg/gray-bg1.png" data-overlay="gray" data-opacity="6">
	<div class="shape-mockup service-bg-shape1-1 d-xxl-inline-block d-none" data-top="15%" data-left="0">
		<div class="color-masking">
			<div class="masking-src" data-mask-src="<?php echo base_url(); ?>assets/public/assets/img/shape/hand-shape1.png"></div>
			<img src="<?php echo base_url(); ?>assets/public/assets/img/shape/hand-shape1.png" alt="img">
		</div>
	</div>
	<div class="shape-mockup service-bg-shape1-2 d-xxl-inline-block d-none" data-top="35%" data-left="0">
		<div class="color-masking">
			<div class="masking-src" data-mask-src="<?php echo base_url(); ?>assets/public/assets/img/shape/hand-shape2.png"></div>
			<img src="<?php echo base_url(); ?>assets/public/assets/img/shape/hand-shape2.png" alt="img">
		</div>
	</div>


	<div class="service-bg-shape1-3 d-xxl-inline-block d-none"></div>
	<div class="service-bg-shape1-4 d-xxl-inline-block d-none"></div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7">
				<div class="title-area text-center">
					<span class="sub-title">Tentang PC ISNU JOMBANG</span>
					<h2 class="sec-title">Visi,Misi, Dan Sejarah PC ISNU JOMBANG</h2>
				</div>
			</div>
		</div>

		<div class="row gy-30 gx-30 justify-content-center">
			<div class="col-xl-4 col-md-6">
				<div class="service-card">
					<div class="box-icon">
						<img src="<?php echo base_url(); ?>assets/public/assets/img/icon/visi.svg" alt="Icon">
					</div>
					<div class="box-content">
						<h3 class="box-title"><a data-target="#visiModal">VISI</a></h3>
						<p class="box-text"><?= htmlspecialchars(limitText($profile->visi)) ?></p>
						<button class="read-more-btn th-btn" data-target="#visiModal">Read More</button>
						<!-- <a href="about.html" class="th-btn">Learn More<i class="fas fa-arrow-up-right ms-2"></i></a> -->
					</div>
				</div>
			</div>

			<div class="col-xl-4 col-md-6">
				<div class="service-card">
					<div class="box-icon">
						<img src="<?php echo base_url(); ?>assets/public/assets/img/icon/misi.svg" alt="Icon">
					</div>
					<div class="box-content">
						<h3 class="box-title"><a data-target="#misiModal">MISI</a></h3>
						<p class="box-text"><?= htmlspecialchars(limitText($profile->misi)) ?></p>
						<button class="read-more-btn th-btn" data-target="#misiModal">Read More</button>
						<!-- <a href="about.html" class="th-btn">Learn More<i class="fas fa-arrow-up-right ms-2"></i></a> -->
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-6">
				<div class="service-card">
					<div class="box-icon">
						<img src="<?php echo base_url(); ?>assets/public/assets/img/icon/sejarah.svg" alt="Icon">
					</div>
					<div class="box-content">
						<h3 class="box-title"><a data-target="#sejarahModal">Sejarah</a></h3>
						<p class="box-text"><?= htmlspecialchars(limitText($profile->sejarah)) ?></p>
						<button class="read-more-btn th-btn" data-target="#sejarahModal">Read More</button>
						<!-- <a href="about.html" class="th-btn">Learn More<i class="fas fa-arrow-up-right ms-2"></i></a> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- VISI Modal -->
<div id="visiModal" class="modal">
	<div class="modal-content">
		<span class="close" data-target="#visiModal">&times;</span>
		<h3>VISI</h3>
		<p><?= $profile->visi ?></p>
	</div>
</div>

<!-- MISI Modal -->
<div id="misiModal" class="modal">
	<div class="modal-content">
		<span class="close" data-target="#misiModal">&times;</span>
		<h3>MISI</h3>
		<p><?= $profile->misi ?></p>
	</div>
</div>

<!-- SEJARAH Modal -->
<div id="sejarahModal" class="modal">
	<div class="modal-content">
		<span class="close" data-target="#sejarahModal">&times;</span>
		<h3>SEJARAH</h3>
		<p><?= $profile->sejarah ?></p>
	</div>
</div>
<script>
	document.querySelectorAll('.read-more-btn').forEach(btn => {
		btn.addEventListener('click', () => {
			const target = document.querySelector(btn.dataset.target);
			if (target) target.style.display = 'flex';
		});
	});

	document.querySelectorAll('.modal .close').forEach(closeBtn => {
		closeBtn.addEventListener('click', () => {
			const target = document.querySelector(closeBtn.dataset.target);
			if (target) target.style.display = 'none';
		});
	});

	// Optional: close modal on outside click
	window.addEventListener('click', e => {
		document.querySelectorAll('.modal').forEach(modal => {
			if (e.target === modal) modal.style.display = 'none';
		});
	});
</script>
