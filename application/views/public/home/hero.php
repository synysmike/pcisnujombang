<!--======== Hero Section ========-->

<style>
	.hero-3 {
		position: relative;
		width: 100%;
		height: 100vh;
		overflow: hidden;
	}

	.video-bg-wrapper {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: -1;
	}

	.video-bg-wrapper iframe {
		width: 100%;
		height: 100%;
		object-fit: cover;
		pointer-events: none;
	}

	.video-overlay {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.7);
	}

	.hero-3 .container {
		position: relative;
		z-index: 2;
		padding: 4rem 2rem;
		/* color: white; */
		text-align: center;
	}

	/* .hero-bg-3-1 {
		display: none;
	} */
</style>


<div class="th-hero-wrapper hero-3" id="hero">
	<div class="video-bg-wrapper">
		<div class="video-overlay">
			<iframe
				src="https://www.youtube.com/embed/DjduqOyDKik?autoplay=1&mute=1&controls=0&loop=1&playlist=DjduqOyDKik&modestbranding=1&showinfo=0"
				frameborder="0"
				allow="autoplay; encrypted-media"
				allowfullscreen></iframe>
		</div>
		<div class="video-overlay"></div>

	</div>

	<!-- <div class="shape-mockup hero-shape-3-1 d-lg-block d-none" data-top="20%" data-left="50%">
		<div class="color-masking shake">
			<div class="masking-src" data-mask-src="assets/img/hero/hero-bg-shape2-3.png"></div>
			<img src="assets/img/hero/hero-bg-shape2-3.png" alt="shape">
		</div>
	</div>
	<div class="shape-mockup hero-shape-3-2 jump" data-top="25%" data-left="5%">
		<div class="color-masking">
			<div class="masking-src" data-mask-src="assets/img/hero/hero-bg-shape2-1.png"></div>
			<img src="assets/img/hero/hero-bg-shape2-1.png" alt="shape">
		</div>
	</div>
	<div class="shape-mockup hero-shape-3-3 jump" data-bottom="0" data-left="-2%">
		<div class="color-masking2">
			<div class="masking-src" data-mask-src="assets/img/shape/hand-shape3.png"></div>
			<img src="assets/img/shape/hand-shape3.png" alt="shape">
		</div>
	</div> -->
	<!-- <div class="hero-bg-3-1" data-bg-src="https://images.pexels.com/photos/842711/pexels-photo-842711.jpeg" data-mask-src="https://images.pexels.com/photos/842711/pexels-photo-842711.jpeg"></div> -->
	<div class="container">
		<div class="row gx-40 align-items-center">
			<div class="col-lg-6">
				<div class="hero-style3">
					<span class="sub-title after-none">Selamat Datang di Website</span>
					<h1 class="hero-title">
						<span style="color: white;" class="title1">PC ISNU JOMBANG</span>
						<!-- <span class="title2">Better <span class="text-theme2 d-inline-block">World</span></span> -->
					</h1>
					<!-- <p class="hero-text">Explore the variety of volunteer opportunities available. From event planning and fundraising to fieldwork and administrative support</p> -->
					<!-- <div class="btn-wrap">
						<a href="about.html" class="th-btn">Discover Now<i class="fa-solid fa-arrow-up-right ms-2"></i></a>
						<a href="https://www.youtube.com/watch?v=_sI_Ps7JSEk" class="play-btn style3 popup-video"><i class="fas fa-play"></i></a>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</div>
