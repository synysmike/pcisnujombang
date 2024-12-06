<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/libs/popper/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/assets/vendor/js/menu.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- endbuild -->

<!-- jq-magnify JS -->
<script src="<?php echo base_url(); ?>assets/admin/magnify-master/dist/jquery.magnify.js"></script>

<!-- Main JS -->
<script src="<?php echo base_url(); ?>assets/admin/assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Page JS -->


<!-- <script src="<?php echo base_url(); ?>assets/admin/assets/js/form-basic-inputs.js"></script> -->

<!-- Place this tag before closing body tag for github widget button. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<script>
	$(document).ready(function() {
		// Initialize Summernote 
		$('.summernote').summernote({
			height: 200
		});
		// Fetch profile data 
		$.ajax({
			url: 'profil/get_profile_data',
			method: 'GET',
			dataType: 'json',
			success: function(data) {
				$('#visi').html(truncateText(data.visi)).data('full-text', data.visi);
				$('#misi').html(truncateText(data.misi)).data('full-text', data.misi);
				$('#sejarah').html(truncateText(data.sejarah)).data('full-text', data.sejarah);
			}
		});
		// Open modal and set content based on button clicked 
		$('#editModal').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget);
			var field = button.data('field');
			var modal = $(this);
			var content = $('#' + field).html();
			modal.find('.modal-title').text('Edit ' + field.charAt(0).toUpperCase() + field.slice(1));
			$('#editor').summernote('code', content);
			$('#saveChanges').data('field', field);
		});
		// Save changes 
		$('#saveChanges').click(function() {
			var field = $(this).data('field');
			var newContent = $('#editor').summernote('code');
			$.ajax({
				url: 'profil/update_' + field,
				method: 'POST',
				data: {
					[field]: newContent
				},
				dataType: 'json',
				success: function(response) {
					if (response.status === 'success') {
						$('#' + field).html(newContent);
						$('#editModal').modal('hide');
					}
				}
			});
		});
		// Read More functionality 
		$('#read-more-visi').click(function() {
			toggleReadMore('visi', $(this));
		});
		$('#read-more-misi').click(function() {
			toggleReadMore('misi', $(this));
		});
		$('#read-more-sejarah').click(function() {
			toggleReadMore('sejarah', $(this));
		});
		// Function to truncate text 
		function truncateText(text) {
			var maxLength = 100;
			// Maximum number of characters to show 
			if (text && text.length > maxLength) {
				return text.substring(0, maxLength) + '...';
			} else {
				return text;
			}
		}
		// Function to toggle Read More 
		function toggleReadMore(field, button) {
			var span = $('#' + field);
			if (span.hasClass('preview')) {
				span.removeClass('preview').addClass('full-text').html(span.data('full-text'));
				button.text('Read Less');
			} else {
				span.removeClass('full-text').addClass('preview').html(truncateText(span.data('full-text')));
				button.text('Read More');
			}
		}

	});
</script>