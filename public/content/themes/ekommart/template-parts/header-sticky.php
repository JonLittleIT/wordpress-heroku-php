<?php
$show_sticky      = ekommart_get_theme_option( 'show-header-sticky', true );
$sticky_animation = ekommart_get_theme_option( 'header-sticky-animation', true );
$class            = $sticky_animation ? 'header-sticky hide-scroll-down' : 'header-sticky';
if ( $show_sticky == true ) {
	wp_enqueue_script( 'ekommart-sticky-header' );
	?>
    <div class="<?php echo esc_attr( $class ); ?>">
        <div class="col-full">
            <div class="header-group-layout">
				<?php

				ekommart_site_branding();
				ekommart_primary_navigation();
				?>
                <div class="header-group-action desktop-hide-down">
					<?php
					ekommart_header_search_button();
					ekommart_header_account();
					if ( ekommart_is_woocommerce_activated() ) {
						ekommart_header_wishlist();
						ekommart_header_cart();
					}
					?>
                </div>
				<?php
				if ( ekommart_is_woocommerce_activated() ) {
					?>
                    <div class="site-header-cart header-cart-mobile">
						<?php ekommart_cart_link(); ?>
                    </div>
					<?php
				}
				ekommart_mobile_nav_button();
				?>

            </div>
        </div>
    </div>
	<?php
}
?>
