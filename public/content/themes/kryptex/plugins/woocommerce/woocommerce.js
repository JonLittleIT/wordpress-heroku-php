/* global jQuery:false */
/* global KRYPTEX_STORAGE:false */

(function() {
	"use strict";

	jQuery(document).on('action.ready_kryptex', function() {
		
		// Change display mode
		jQuery('.woocommerce,.woocommerce-page').on('click', '.kryptex_shop_mode_buttons a', function(e) {
			var mode = jQuery(this).hasClass('woocommerce_thumbs') ? 'thumbs' : 'list';
			kryptex_set_cookie('kryptex_shop_mode', mode, 365);
			jQuery(this).siblings('input').val(mode).parents('form').get(0).submit();
			e.preventDefault();
			return false;
		});
		// Add buttons to quantity on first run
		if (jQuery('.woocommerce div.quantity .q_inc,.woocommerce-page div.quantity .q_inc').length == 0) {
			var woocomerce_inc_dec = '<span class="q_inc"></span><span class="q_dec"></span>';
			jQuery('.woocommerce div.quantity,.woocommerce-page div.quantity').append(woocomerce_inc_dec);
			jQuery('.woocommerce div.quantity,.woocommerce-page div.quantity').on('click', '>span', function(e) {
				woocomerce_inc_dec_click(jQuery(this));
				e.preventDefault();
				return false;
			});
		}
		// Add buttons to quantity after the cart is updated
		jQuery(document.body).on('updated_wc_div', function() {
			if (jQuery('.woocommerce div.quantity .q_inc,.woocommerce-page div.quantity .q_inc').length == 0) {
				jQuery('.woocommerce div.quantity,.woocommerce-page div.quantity').append(woocomerce_inc_dec);
				jQuery('.woocommerce div.quantity,.woocommerce-page div.quantity').on('click', '>span', function(e) {
					woocomerce_inc_dec_click(jQuery(this));
					e.preventDefault();
					return false;
				});
			}
		});
		// Inc/Dec quantity on buttons inc/dec
		function woocomerce_inc_dec_click(button) {
			var f = button.siblings('input');
			if (button.hasClass('q_inc')) {
				f.val(Math.max(0, parseInt(f.val()))+1).trigger('change');
			} else {
				f.val(Math.max(1, Math.max(0, parseInt(f.val()))-1)).trigger('change');
			}
		}
		
		// Make buttons from links
		var wishlist = jQuery('.woocommerce .product .yith-wcwl-add-to-wishlist');
		if (wishlist.length > 0) {
			wishlist.find('.add_to_wishlist').addClass('button');
			if (jQuery('.woocommerce .product .compare').length > 0) jQuery('.woocommerce .product .compare').insertBefore(wishlist);
		}
		
		// Wrap new select (created dynamically) with .select_container
		jQuery('select#calc_shipping_country:not(.inited)').addClass('inited').on('change', function() {
			setTimeout(function() {
				var state = jQuery('select#calc_shipping_state');
				if (state.length == 1 && !state.parent().hasClass('select_container'))
					state.wrap('<div class="select_container"></div>');
			}, 10);
		});
		jQuery(document.body).on('wc_fragments_refreshed updated_shipping_method update_checkout', function() {
			jQuery('div.cart_totals select').each(function() {
				if (!jQuery(this).parent().hasClass('select_container'))
					jQuery(this).wrap('<div class="select_container"></div>');
			});
		});
  	});
	
	// Generate 'scroll' event after the cart is filled
	jQuery( document.body ).on( 'wc_fragment_refresh', function() {
		jQuery(window).trigger('scroll');
	});
	
	// Add stretch behaviour to WooC tabs area
	jQuery(document).on('action.prepare_stretch_width', function() {
		if (KRYPTEX_STORAGE['stretch_tabs_area'] > 0)
			jQuery('.single-product .woocommerce-tabs').wrap('<div class="trx-stretch-width"></div>');
	});

})();