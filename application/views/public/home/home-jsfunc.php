<script>
	$(document).ready(function() {
		// Fetch color data

		// Attach a click event to all <a> tags with an id that starts with "blog_"
		$('a[id^="blog_"]').click(function(e) {
			e.preventDefault(); // Prevent the default anchor navigation

			// Get the full id of the clicked element
			var fullId = $(this).attr('id'); // Example: "blog_123"
			var id = fullId.split('_')[1]; // Extract the ID part (e.g., 123)

			console.log('Action triggered for blog ID:', id); // Perform your custom action here
		});

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
                    <a href="javascript:void(0);" id="blog_${berita.id}">
                        <img src="${berita.image}" alt="blog image">
                    </a>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <a href="javascript:void(0);" id="blog_${berita.id}">
                            <i class="fas fa-calendar"></i>${berita.date}
                        </a>
                        <a href="javascript:void(0);" id="blog_${berita.id}">
                            <i class="fas fa-tags"></i>${berita.category}
                        </a>
                    </div>
                    <h3 class="box-title">
                        <a href="javascript:void(0);" id="blog_${berita.id}">${berita.title}</a>
                    </h3>
                    <a href="javascript:void(0);" id="blog_${berita.id}" class="th-btn">
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

				// Set session and redirect (or do whatever custom logic you need)
				$.ajax({
					url: '/home/setBlogSession',
					type: 'POST',
					contentType: 'application/json',
					data: JSON.stringify({
						id: id
					}),
					success: function(response) {
						swal.fire({
							icon: 'success',
							title: 'Success',
							text: 'Server Response:' + response
						});
						window.location.href = '/home/blog_detail';
					},
					error: function(xhr, status, error) {
						console.error('Error setting session:', error);
					}
				});
			});
		});
	});
</script>