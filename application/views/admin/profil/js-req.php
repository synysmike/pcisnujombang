<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/admin/magnify-master/dist/jquery.magnify.js"></script>


<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script><!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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