<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$configs 			= besa_class_wrapper_start();
$sidebar_configs  	= besa_tbay_get_woocommerce_layout_configs();

$product_archive_layout  =   ( isset($_GET['product_archive_layout']) ) ? $_GET['product_archive_layout'] : besa_tbay_get_config('product_archive_layout', 'shop-left');
$product_single_layout  =   ( isset($_GET['product_single_layout']) )   ?   $_GET['product_single_layout'] :  besa_get_single_select_layout();
$class_row = 'no-gutters';

if( !is_singular( 'product' ) ) {
	
	$class_row .= ( $product_archive_layout === 'shop-right' ) ? ' flex-row-reverse' : '';
} else {
	$class_row .= ( $product_single_layout === 'main-right' ) ? ' flex-row-reverse' : '';
}

?>

	<div id="main-wrapper" class="<?php echo esc_attr( $configs['main'] ); ?>">
		<?php do_action( 'besa_woo_template_main_before' ); ?>

		<div id="main-container" class="container">
			<div class="row <?php echo esc_attr($class_row); ?>">
				<?php if ( !empty( $sidebar_configs['sidebar']['id'] ) ) {
					get_sidebar( 'shop' );
				} ?>
				<div id="main" class="<?php echo besa_wc_wrapper_class($configs['content']) ;?>"><!-- .content -->

				<?php if( (is_shop() && '' !== get_option('woocommerce_shop_page_display')) || (is_product_category() && 'subcategories' == get_option('woocommerce_category_archive_display')) || (is_product_category() && 'both' == get_option('woocommerce_category_archive_display'))) { ?>
					<ul class="all-subcategories"><?php besa_woocommerce_sub_categories(); ?></ul>
				<?php } ?>