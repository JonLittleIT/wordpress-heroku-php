<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( sizeof( $cross_sells ) == 0 ) {
	return;
}


$woocommerce_loop['columns'] = 4;
$columns_desktopsmall = 3;
$columns_tablet = 3;
$columns_mobile = 2;

$rows = 1;

if ( $cross_sells ) : ?>

	<div class="cross-sells related products tbay-addon tbay-addon-products">
		<h3 class="tbay-addon-title"><span><?php esc_html_e( 'You may be like', 'besa' ) ?></h3>
		<div class="tbay-addon-content woocommerce">
		<?php  wc_get_template( 'layout-products/carousel-related.php' , array( 'loops'=>$cross_sells,'rows' => $rows, 'pagi_type' => 'no', 'nav_type' => 'yes','columns'=>$woocommerce_loop['columns'],'screen_desktop'=>$woocommerce_loop['columns'],'screen_desktopsmall'=>$columns_desktopsmall,'screen_tablet'=>$columns_tablet,'screen_mobile'=>$columns_mobile ) ); ?>
		</div>
	</div>

<?php endif;

wp_reset_query();
