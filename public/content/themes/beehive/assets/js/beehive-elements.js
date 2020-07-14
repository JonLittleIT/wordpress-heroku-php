'use strict';

//On document ready
(function($) {

    // Init swiper slider
	new Swiper('.swiper-slider-container', {
		effect: 'fade',
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
	});

})( jQuery );