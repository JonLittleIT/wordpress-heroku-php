( function($) {
	$( document ).on( 'click', '#elementor-panel-footer-back-to-admin', function(e) {
		if ( $( window.parent ).length == 1 && window.parent.ekommart_menu_modal !== undefined ) {
			window.parent.ekommart_menu_modal.model.set( 'edit_submenu', false );
		}
	} );
} )(jQuery);
