<?php   
	$class_top_bar 	=  '';

	$always_display_logo 			= besa_tbay_get_config('always_display_logo', false);
	if( !$always_display_logo && !defined('BESA_WOOCOMMERCE_CATALOG_MODE_ACTIVED') && defined('BESA_WOOCOMMERCE_ACTIVED') && (is_product() || is_cart() || is_checkout()) ) {
		$class_top_bar .= ' active-home-icon';
	}
?>
<div class="topbar-device-mobile d-xl-none clearfix <?php echo esc_attr( $class_top_bar ); ?>">

	<?php
		/**
		* besa_before_header_mobile hook
		*/
		do_action( 'besa_before_header_mobile' );

		/**
		* Hook: besa_header_mobile_content.
		*
		* @hooked besa_the_button_mobile_menu - 5
		* @hooked besa_the_icon_home_page_mobile - 10
		* @hooked besa_the_logo_mobile - 15
		* @hooked besa_the_icon_mini_cart_header_mobile - 20
		* @hooked besa_top_header_mobile - 25
		*/

		do_action( 'besa_header_mobile_content' );

		/**
		* besa_after_header_mobile hook
		*/
		do_action( 'besa_after_header_mobile' );
	?>
</div>