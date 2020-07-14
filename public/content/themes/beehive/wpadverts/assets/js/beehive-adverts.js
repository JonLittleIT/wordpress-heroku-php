'use strict';

(function($) {
	let advertTimer;
	$(window).on('load resize', function() {
		clearTimeout(advertTimer);
		advertTimer = setTimeout( function() {
			$('.grid-list.masonry').masonry({
				itemSelector: '.advert-item'
			});
		}, 500);
	});
})( jQuery );
