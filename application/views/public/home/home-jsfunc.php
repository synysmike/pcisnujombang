<script>
	$(document).ready(function() {
		// fetch galeri
		loadGallery('gallery-container');




		// Fetch carousel data
		$.ajax({
			url: "/home/set_home_config", // Your API endpoint here
			method: "GET",
			success: function(response) {
				const parsedResponse = JSON.parse(response);

				if (parsedResponse.length > 0) {
					let carouselHTML = '';

					// Loop through all carousel objects in the response
					parsedResponse.forEach(config => {
						if (config.carousel_title && config.carousel_picture) {
							carouselHTML += `
                    <div class="swiper-slide">
                        <div class="hero-inner" data-bg-src="<?php echo base_url(); ?>assets/images/carousel/${config.carousel_picture}" data-overlay="black4" data-opacity="5">
                            <div class="hero-bg-shape1-1">
                                <img width="1430" src="<?php echo base_url(); ?>assets/images/carousel/${config.carousel_picture}" alt="Carousel Image">
                            </div>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xl-12">
                                        <div class="hero-style1 text-center">
                                            <span class="sub-title justify-content-center" data-ani="slideinup" data-ani-delay="0.2s">${config.carousel_title}</span>
                                            <h1 class="hero-title text-white">
                                                <span class="title1" data-ani="slideinup" data-ani-delay="0.4s">${config.carousel_description}</span>
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
						}
					});

					// Append the generated HTML to the Swiper container
					$('#swiperWrapper').html(carouselHTML);
				} else {
					console.error("Empty response array.");
				}
			},
			error: function(error) {
				console.error("Error fetching carousel data:", error);
			},
		});

		<?php if ($this->session->flashdata('login_success')): ?> Swal.fire({
				icon: 'success',
				title: 'Success',
				text: '<?php echo $this->session->flashdata('login_success'); ?>'
			});
		<?php endif; ?>


		//fetch berita
		const endpoint = '<?php echo base_url(); ?>Home/get_all_berita';

		fetch(endpoint)
			.then(response => response.json())
			.then(data => {
				// Select the <div class="swiper-wrapper"> directly under slider-area
				const sliderWrapper = document.querySelector('.slider-area .swiper-wrapper');

				// Clear any existing slides (if any)
				sliderWrapper.innerHTML = '';

				// Dynamically build the slides
				data.forEach(berita => {
					const slideHTML = `
        <div class="swiper-slide">
            <div class="blog-card">
                <div class="blog-img" style="width: 400px; height: 200px; overflow: hidden;">
                    <a href="javascript:void(0);" id="blog_${berita.url}">
                        <img src="${berita.image}" alt="blog image">
                    </a>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <a href="javascript:void(0);" id="blog_${berita.url}">
                            <i class="fas fa-calendar"></i>${berita.date}
                        </a>
                        <a href="javascript:void(0);" id="blog_${berita.url}">
                            <i class="fas fa-tags"></i>${berita.category}
                        </a>
                    </div>
                    <h3 class="box-title">
                        <a href="javascript:void(0);" id="blog_${berita.url}">${berita.title}</a>
                    </h3>
                    <a href="javascript:void(0);" id="blog_${berita.url}" class="th-btn">
                        Read More <i class="fas fa-arrow-up-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    `;
					// Append each slide to the slider wrapper
					sliderWrapper.innerHTML += slideHTML;
				});

				// Reinitialize Swiper after slides are injected
				new Swiper('#blogSlider1', {
					breakpoints: {
						0: {
							slidesPerView: 1
						},
						576: {
							slidesPerView: 1
						},
						768: {
							slidesPerView: 2
						},
						992: {
							slidesPerView: 2
						},
						1200: {
							slidesPerView: 3
						}
					},
					autoHeight: true,
					loop: true,
					navigation: {
						nextEl: '.slider-next',
						prevEl: '.slider-prev'
					}
				});
			})
			.catch(error => {
				console.error('Error fetching data:', error);
			});



		$(document).ready(function() {
			// Attach click event listener to all <a> elements with id starting with "blog_"
			$(document).on('click', '[id^="blog_"]', function(e) {
				e.preventDefault(); // Prevent default navigation

				// Get the blog ID from the clicked element
				const fullId = $(this).attr('id'); // Example: "blog_123"
				const id = fullId.split('_')[1]; // Extract the numeric part (e.g., 123)

				console.log('Blog clicked, ID:', id);

				// Redirect to the blog page with the ID
				window.location.href = "<?php echo base_url(); ?>Home/blog_detail/" + id;
			});
		});


		const swiper = new Swiper('#ProjectSlider1', {
			slidesPerView: 1,
			spaceBetween: 24,
			breakpoints: {
				576: {
					slidesPerView: 1
				},
				768: {
					slidesPerView: 2
				},
				992: {
					slidesPerView: 2
				},
				1200: {
					slidesPerView: 3
				},
			},
		});

		loadGallery('projectGalleryContainer');
		$('.popup-image').magnificPopup({
			type: 'image',
			gallery: {
				enabled: true // Enables gallery mode
			},
			callbacks: {
				open: function() {
					console.log("Magnific Popup is working!"); // Optional for debugging
				}
			}
		});

		// Prevent default link behavior
		$('.popup-image').on('click', function(event) {
			event.preventDefault(); // Stops the link from opening in a new tab
		});

		function loadGallery(containerId) {
			$.ajax({
				url: "<?php echo base_url(); ?>/Galeri/get_galeri", // Adjust the path to match your controller setup
				type: "GET",
				dataType: "json",
				success: function(response) {
					let galleryHTML = '';
					const items = response.data; // Access the data from the response
					items.forEach((item, index) => {
						const isActive = index === 0 ? 'swiper-slide-active' : index === 1 ? 'swiper-slide-next' : ''; // Determine slide class
						const ariaLabel = `${index + 1} / ${items.length}`; // Create aria-label for accessibility

						galleryHTML += `
            <div class="swiper-slide ${isActive}" role="group" aria-label="${ariaLabel}" data-swiper-slide-index="${index}" style="width: 414px; margin-right: 24px;">
                <div class="project-card">
                    <div class="project-img">
                        <img src="<?php echo base_url("assets/images/galeri/"); ?>${item.file}" alt="project image">
						</div>
						
						<div class="project-content">
                        <div class="project-card-bg-shape bg-mask" style="mask-image: url('<?php echo base_url(); ?>assets/public/assets/img/shape/project-card-bg-shape1-1.png');" ></div>
                        <h3 class="project-title"><a href="#" target:"_blank">${item.judul}</a></h3>
                        <p class="project-subtitle">${item.ket}</p>
						<a href="<?= base_url('assets/images/galeri/') ?>${item.file}" class="icon-btn popup-image">
								<i class="fas fa-eye">
								</i>
							</a>
                    </div>
                </div>
            </div>
        `;
					});
					$(`#${containerId}`).html(galleryHTML); // Populate the container
				},
				error: function() {
					alert("Failed to load gallery data!");
				}
			});
		}

	});
</script>
