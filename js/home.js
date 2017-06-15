jQuery(document).ready(function($) {

	// To replace IMG inside carousel with background image
	$('.home-slide-container > img').each(function() {
		var imgSrc = $(this).attr('src');
		$(this).parent().css({
			'background-image': 'url('+imgSrc+')'
		});
		$(this).remove();
	});

	$('.announcement-container').each(function() {
		var self = $(this);
		if( self.html().trim().length === 0 ) {
			$('.announcement').hide();
		}
	});

});