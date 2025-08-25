<style>
	/* Video Carousel Styles */
	.video-carousel {
		background: white;
		border-radius: 8px;
		box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
		padding: 20px;
		margin-bottom: 20px;
	}

	.video-carousel h2 {
		color: #2e7d32;
		margin-bottom: 20px;
		padding-bottom: 10px;
		border-bottom: 2px solid #e0e0e0;
	}

	.swiper {
		width: 100%;
		height: 720px;
		border-radius: 8px;
		overflow: hidden;
	}

	.swiper-slide {
		display: flex;
		flex-direction: column;
		background: #000;
		border-radius: 8px;
		overflow: hidden;
	}

	.video-container {
		position: relative;
		width: 100%;
		height: 0;
		padding-bottom: 56.25%;
		/* 16:9 aspect ratio */
	}

	.video-container iframe {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		border: none;
	}

	.video-info {
		padding: 15px;
		background: white;
	}

	.video-info h3 {
		color: #2e7d32;
		margin-bottom: 10px;
	}

	.video-info p {
		color: #666;
		font-size: 0.9rem;
	}

	.swiper-button-next,
	.swiper-button-prev {
		color: white;
		background: rgba(46, 125, 50, 0.8);
		width: 40px;
		height: 40px;
		border-radius: 50%;
	}

	.swiper-button-next:after,
	.swiper-button-prev:after {
		font-size: 1.2rem;
	}

	.swiper-pagination-bullet-active {
		background: #2e7d32;
	}

	/* Content Sections */
	.content-section {
		background: white;
		border-radius: 8px;
		box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
		padding: 20px;
		margin-bottom: 20px;
	}

	.content-section h2 {
		color: #2e7d32;
		margin-bottom: 15px;
		padding-bottom: 10px;
		border-bottom: 2px solid #e0e0e0;
	}

	.news-grid,
	.gallery-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
		gap: 20px;
	}

	.news-item,
	.gallery-item {
		background: #f9f9f9;
		border-radius: 8px;
		overflow: hidden;
		transition: transform 0.3s;
	}

	.news-item:hover,
	.gallery-item:hover {
		transform: translateY(-5px);
	}

	.news-item img,
	.gallery-item img {
		width: 100%;
		height: 160px;
		object-fit: cover;
	}

	.news-content,
	.gallery-content {
		padding: 15px;
	}

	.news-content h3,
	.gallery-content h3 {
		color: #2e7d32;
		margin-bottom: 10px;
	}

	#player {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: -1;
		pointer-events: none;
	}

	.th-hero-wrapper.hero-1 {
		position: relative;
		width: 100%;
		height: 100vh;
		overflow: hidden;
	}

	/* Footer */
	footer {
		text-align: center;
		padding: 20px;
		background: #2e7d32;
		color: white;
		border-radius: 8px;
		margin-top: 20px;
	}

	/* Responsive Design */
	@media (max-width: 992px) {
		.container {
			grid-template-columns: 1fr;
		}

		.sidebar {
			display: none;
		}

		.news-grid,
		.gallery-grid {
			grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
		}
	}

	@media (max-width: 768px) {
		header {
			flex-direction: column;
			text-align: center;
		}

		nav ul {
			margin-top: 15px;
			flex-wrap: wrap;
			justify-content: center;
		}

		nav ul li {
			margin: 5px 10px;
		}

		.swiper {
			height: 400px;
		}
	}

	@media (max-width: 576px) {

		.news-grid,
		.gallery-grid {
			grid-template-columns: 1fr;
		}

		.swiper {
			height: 300px;
		}
	}
</style>
<section class="video-carousel">
	<div class="th-hero-wrapper hero-1" id="hero">
		<div class="swiper th-slider hero-slider1" id="heroSlide1">
			<div class="swiper-wrapper" id="swiperWrappers">
				<!-- Slide 1 -->
				<div id="player"></div>

			</div>
		</div>

		<!-- Navigation buttons -->
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>

		<!-- Pagination -->
		<div class="swiper-pagination"></div>
	</div>
	</div>
</section>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
	// Load YouTube IFrame API
	var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	// Global player reference
	var player;

	// Called when YouTube API is ready
	function onYouTubeIframeAPIReady() {
		player = new YT.Player('player', {
			height: '100%',
			width: '100%',
			videoId: 'LGFdLMY93Xg', // First YouTube video ID
			playerVars: {
				'autoplay': 1,
				'controls': 0,
				'rel': 0,
				'modestbranding': 1
			},
			events: {
				'onReady': onPlayerReady,
				'onStateChange': onPlayerStateChange
			}
		});
	}

	// Called when player is ready
	function onPlayerReady(event) {
		// Set initial volume
		// player.setVolume(80);
		player.mute(); // Required for autoplay to work
		player.playVideo();

		// Update UI elements
		updateButtonStates();

		// Add event listeners to custom controls
		document.getElementById('play-btn').addEventListener('click', function() {
			player.playVideo();
		});

		document.getElementById('pause-btn').addEventListener('click', function() {
			player.pauseVideo();
		});

		document.getElementById('mute-btn').addEventListener('click', function() {
			if (player.isMuted()) {
				player.unMute();
			} else {
				player.mute();
			}
			updateButtonStates();
		});

		document.getElementById('volume').addEventListener('input', function() {
			player.setVolume(this.value);
		});
	}

	// Called when player state changes
	function onPlayerStateChange(event) {
		updateButtonStates();
	}

	// Update button states based on player status
	function updateButtonStates() {
		const playBtn = document.getElementById('play-btn');
		const muteBtn = document.getElementById('mute-btn');

		// Update play/pause button
		if (player.getPlayerState() === YT.PlayerState.PLAYING) {
			playBtn.innerHTML = '<i class="fas fa-pause"></i> Pause';
			playBtn.onclick = function() {
				player.pauseVideo();
			};
		} else {
			playBtn.innerHTML = '<i class="fas fa-play"></i> Play';
			playBtn.onclick = function() {
				player.playVideo();
			};
		}

		// Update mute button
		if (player.isMuted()) {
			muteBtn.innerHTML = '<i class="fas fa-volume-up"></i> Unmute';
		} else {
			muteBtn.innerHTML = '<i class="fas fa-volume-mute"></i> Mute';
		}
	}
</script>
