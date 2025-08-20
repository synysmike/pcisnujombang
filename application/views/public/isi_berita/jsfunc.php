<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
	function addComment(postId) {
		// Extract form data
		const guestName = $('#guest_name').val().trim();
		const guestEmail = $('#guest_email').val().trim();
		const guestPhone = $('#guest_phone').val().trim();
		const commentText = $('#comment_text').val().trim();
		const parentCommentId = $('#parent_comment_id').val();

		// Basic format validation
		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		const phoneRegex = /^\+?\d{10,15}$/; // Accepts international format or local with 10–15 digits

		if (!guestName || !guestEmail || !guestPhone || !commentText) {
			Swal.fire({
				title: 'Missing Fields',
				text: 'Please fill in all required fields.',
				icon: 'warning',
			});
			return;
		}

		if (!emailRegex.test(guestEmail)) {
			Swal.fire({
				title: 'Invalid Email',
				text: 'Please enter a valid email address.',
				icon: 'warning',
			});
			return;
		}

		if (!phoneRegex.test(guestPhone)) {
			Swal.fire({
				title: 'Invalid Phone Number',
				text: 'Please enter a valid phone number (10–15 digits).',
				icon: 'warning',
			});
			return;
		}

		// Construct data for both guest and comment
		const commentData = {
			uname: guestName,
			email: guestEmail,
			phone_number: guestPhone,
			ip_address: null,
			country: null,
			region: null,
			post_id: postId,
			comment_text: commentText,
			parent_comment_id: parentCommentId || null,
		};

		// AJAX call to process both guest and comment
		$.ajax({
			url: `<?php echo base_url(); ?>home/process_comment`,
			method: 'POST',
			data: commentData,
			success: function(response) {
				let result;
				try {
					result = JSON.parse(response);
				} catch (e) {
					Swal.fire({
						title: 'Error!',
						text: 'Invalid server response. Please try again.',
						icon: 'error',
					});
					return;
				}

				if (result.success) {
					// Clear form fields
					$('#guest_name').val('');
					$('#guest_email').val('');
					$('#guest_phone').val('');
					$('#comment_text').val('');
					$('#parent_comment_id').val('');

					fetchComments(postId);

					Swal.fire({
						title: 'Success!',
						text: 'Comment added successfully!',
						icon: 'success',
					});
				} else {
					Swal.fire({
						title: 'Validation Error',
						text: result.message || 'Failed to process your comment.',
						icon: 'error',
					});
				}
			},
			error: function() {
				Swal.fire({
					title: 'Server Error',
					text: 'An unexpected error occurred. Please try again later.',
					icon: 'error',
				});
			},
		});
	}


	/**
	 * Format a date string into a human-readable format.
	 *
	 * @param {string} dateString The date string to format.
	 * @return {string} The formatted date string.
	 */
	function formatDate(dateString) {
		const options = {
			year: 'numeric',
			month: 'long',
			day: 'numeric',
			hour: '2-digit',
			minute: '2-digit'
		};
		return new Date(dateString).toLocaleDateString('en-US', options);
	}

	function fetchComments(postId) {
		if (postId) {
			return $.ajax({
				url: `<?php echo base_url(); ?>home/get_comment/${postId}`,
				method: 'GET',
				success: function(response) {
					const data = JSON.parse(response); // Parse JSON response
					// console.log(data);
					const comm = $('#count_cmnt');
					const commentList = $('.comment-list');
					const commentCount = $('#comment');

					if (Array.isArray(data) && data.length > 0) {
						// Update comment count
						comm.html(`<i class="far fa-comments"></i> Comments (${data.length})`);
						commentCount.html(`<i class="far fa-comments"></i> Comments (${data.length})`);

						// Clear previous comments
						commentList.html('');

						// Process each comment in the array
						data.forEach(comment => {
							let commentHtml = `
                            <li class="th-comment-item" data-comment-id="${comment.comment_id}">
                                <div class="th-post-comment">
                                    <div class="comment-avater">
                                        <div class="user-icon" data-username="${comment.uname || 'Anonymous'}"></div>
                                    </div>
                                    <div class="comment-content">
                                        <h3 class="name">${comment.uname || 'Anonymous'}</h3>
                                        <span class="commented-on">${formatDate(comment.created_at)}</span>
                                        <p class="text">${comment.comment_text}</p>
                                        <div class="reply_and_edit">
                                            <a href="#" class="reply-btn" onclick="replyToComment(${comment.comment_id})">
                                                <i class="fas fa-reply"></i>Reply
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        `;

							// Check if the comment has children and render nested comments
							if (comment.children && comment.children.length > 0) {
								commentHtml += `<ul class="children">`;
								comment.children.forEach(child => {
									commentHtml += `
                                    <li class="th-comment-item" data-comment-id="${child.comment_id}">
                                        <div class="th-post-comment">
                                            <div class="comment-avater">
                                                <div class="user-icon" data-username="${comment.uname || 'Anonymous'}"></div>
                                            </div>
                                            <div class="comment-content">
                                                <h3 class="name">${child.uname || 'Anonymous'}</h3>
                                                <span class="commented-on">${formatDate(child.created_at)}</span>
                                                <p class="text">${child.comment_text}</p>
                                                <div class="reply_and_edit">
                                                    <a href="#" class="reply-btn" onclick="replyToComment(${child.comment_id})">
                                                        <i class="fas fa-reply"></i>Reply
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                `;
								});
								commentHtml += `</ul>`;
							}

							// Append the comment HTML to the list
							commentList.append(commentHtml);
						});
					} else {
						// No comments found
						comm.html(`<i class="far fa-comments"></i> Comments (0)`);
						commentCount.html('<i class="far fa-comments"></i> Comments (0)');
						commentList.html('<p>No comments found.</p>');
					}
				}
			});
		} else {
			alert('Post ID is required to fetch comments.');
			return;
		}
	}

	function replyToComment(commentId) {
		// Find the comment item by its data-comment-id attribute
		const commentItem = $(`[data-comment-id="${commentId}"]`);
		const commentText = commentItem.find('.text').text(); // Extract comment text
		const commenterName = commentItem.find('.name').text(); // Extract commenter's name

		// Update the hidden input with the parent comment ID
		$('#parent_comment_id').val(commentId);

		// Display the quoted comment in the 'quote-comment' div
		$('#quote-comment').html(`
        <blockquote>
            <strong>${commenterName}:</strong> ${commentText}
        </blockquote>
    `).show();

		// Scroll to the form for better UX
		$('html, body').animate({
			scrollTop: $('.th-comment-form').offset().top - 20
		}, 500);
	}

	// Clear quote when form is submitted
	$('.th-btn.btn-fw').on('click', function() {
		$('#quote-comment').hide().html(''); // Clear the quoted comment
		$('#parent_comment_id').val(''); // Reset the parent comment ID
	});


	// Assuming 'postUrl' contains the URL of the current post
	const postUrl = window.location.href; // Get current page URL
	const postTitle = $('meta[name="title"]').attr('content') || document.title; // Optionally use the page title

	// Populate share links
	$('#facebook-share').attr('href', `https://www.facebook.com/sharer.php?u=${encodeURIComponent(postUrl)}`);
	$('#twitter-share').attr('href', `https://twitter.com/intent/tweet?url=${encodeURIComponent(postUrl)}&text=${encodeURIComponent(postTitle)}`);
	$('#linkedin-share').attr('href', `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(postUrl)}`);
	$('#whatsapp-share').attr('href', `https://api.whatsapp.com/send?text=${encodeURIComponent(postTitle)}%20${encodeURIComponent(postUrl)}`);

	$('.user-icon').each(function() {
		// Get the username from the data attribute
		const username = $(this).data('username');

		if (username) {
			// Extract the first letter and set it as the content
			const firstLetter = username.charAt(0).toUpperCase();
			$(this).text(firstLetter);

			// Optionally, set a dynamic background color
			const colors = ['#007bff', '#28a745', '#dc3545', '#ffc107', '#17a2b8'];
			const randomColor = colors[Math.floor(Math.random() * colors.length)];
			$(this).css('background-color', randomColor);
		}
	});

	$.ajax({
		url: "<?php echo base_url(); ?>home/get_berita_detail/",
		type: "POST",
		data: {
			"slug": "<?php echo $this->uri->segment(3); ?>"
		},
		dataType: "json",
		success: function(data) {
			if (data) {
				var berita = data;
				$("#blog-image").attr("src", "<?php echo base_url(); ?>assets/images/berita/" + berita.gambar);
				$('#breadcumb-bg').attr('data-bg-src', '<?php echo base_url(); ?>assets/images/berita/' + berita.gambar);
				$('#breadcumb-bg').attr('style', `
					position: relative;
					overflow: hidden;
					`);
				$('#breadcumb-bg').prepend(`
					<div class="bg-blur-layer" style="
						position: absolute;
						top: 0; left: 0;
						width: 100%; height: 100%;
						background-image: url('<?php echo base_url(); ?>assets/images/berita/${berita.gambar}');
						background-size: cover;
						background-position: center;
						filter: blur(4px);
						z-index: 0;
					"></div>
					`);
				$("#judul").text(berita.judul);
				$("#judul-detail").text(berita.judul);
				$("#kat").text(berita.kategori_nama);
				// Change <meta name="author">
				$('meta[name="author"]').attr('content', 'PC ISNU Kab. Jombang');

				// Change <meta name="description">
				const isi = berita.isi;
				const words = isi.split(' ');
				const limitedIsi = words.slice(0, 20).join(' ');
				$('meta[name="description"]').attr('content', limitedIsi + '...');

				// Change <meta name="keywords">
				const keywords = limitedIsi.split(' ').slice(0, 5).join(', ');
				$('meta[name="keywords"]').attr('content', keywords);

				// Change <meta property="og:title">
				$('meta[property="og:title"]').attr('content', berita.judul);

				// Change <meta property="og:description">
				$('meta[property="og:description"]').attr('content', 'Stay updated with local events, educational initiatives, and community news from PC ISNU Kab. Jombang.');

				// Change <meta property="og:url">
				$('meta[property="og:url"]').attr('content', window.location.href);

				// Change <meta property="og:image">
				$('meta[property="og:image"]').attr('content', '<?php echo base_url(); ?>assets/images/berita/' + berita.gambar);
				// Change <link rel="canonical" href="https://yourwebsite.com/news-page-url"> <!-- Preferred URL for SEO -->
				$('link[rel="canonical"]').attr('href', window.location.href);

				const $submitButton = $('.th-btn.btn-fw');
				$submitButton.attr('onclick', `addComment('${berita.id}')`);
				// Fetch comments again to refresh the list
				fetchComments(berita.id);

				var tgl = new Date(berita.tgl);
				var options = {
					year: 'numeric',
					month: 'long',
					day: 'numeric'
				};
				$("#tgl").text(tgl.toLocaleDateString('id-ID', options));
				$("#isi").html(berita.isi);
			}
		}
	});
</script>
