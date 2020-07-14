'use strict';

(function($) {
	
	const body       = $('body'),
		  profileNav = $('.nav-container .profile-nav'),
		  subNav     = $('.bp-navs:not(.single-screen-navs) > ul');
	
	// Initiate flex menu on profile nav
	if(profileNav.length) {
		profileNav.flexMenu({
			showOnHover: false,
			cutoff: 0,
			popupClass: "dropdown-menu-right",
			linkText: '<span class="nav-link-text">'+ beehive_data.more_text +'<text>',
			showCount: true,
			hOverflow: true,
		});
	}

	// Flex menu for bp navs
	if(subNav.has("li").length) {
		subNav.flexMenu({
			showOnHover: false,
			cutoff: 0,
			popupClass: "dropdown-menu-right",
			linkText: '<i class="uil-ellipsis-h"></i>',
			hOverflow: true,
			shouldApply: function () {
				if(subNav.closest('#buddypress').hasClass('bp-dir-vert-nav')) {
					if(window.innerWidth > 991.98) {
						return false;
					} else {
						return true;
					}
				} else {
					return true;
				}
			},
		});
	}

	// Move bp template notices
	if($('#item-header .bp-feedback').length) {
		$('#item-header .bp-feedback').prependTo('.profile-col-main').css({'margin-top': '0'});
	}

	// Init select2 on multiselectbox
	if(body.hasClass('registration') || body.hasClass('profile-edit')) {
		$('#signup-form select[multiple=multiple], #profile-edit-form select[multiple=multiple]').select2();
	}

	// Truncate about group text
	if(body.hasClass('groups')) {
		$('.about-group').shorten({
			showChars: 75,
			moreText: beehive_data.read_more,
			lessText: beehive_data.read_close
		});	
	}

	// Load activity on scroll
	if(body.hasClass('activity') || body.hasClass('group-home')) {

		// Check the window scroll event.
		$(window).scroll( function () {
			// Find the visible "load more" button.
			// since BP does not remove the "load more" button, we need to find the last one that is visible.
			const load_more_btn = $( 'li.load-more' );
			// If there is no visible "load more" button, we've reached the last page of the activity stream.
			// If data attribute is set, we already triggered request for ths specific button.
			if ( ! load_more_btn.get( 0 ) || load_more_btn.data( 'bpaa-autoloaded' ) ) {
				return;
			}

			// Find the offset of the button.
			const pos = load_more_btn.offset();
			const offset = pos.top - 50;// 50 px before we reach the button.

			// If the window height+scrollTop is greater than the top offset of the "load more" button,
			// we have scrolled to the button's position. Let us load more activity.
			if ($(window).scrollTop() + $(window).height() > offset) {
				load_more_btn.data( 'bpaa-autoloaded', 1 );
				load_more_btn.find( 'a' )[0].click();
			}
		});
	}
	
})( jQuery );
