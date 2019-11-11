<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div class="col-sm-3">
	<div <?php post_class(); ?>>
		<?php $aqura_product_main_link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product ); ?>
		<?php remove_action( 'woocommerce_after_shop_loop_item' , 'woocommerce_template_loop_product_link_close' , 5 );
		do_action( 'woocommerce_after_shop_loop_item' ); ?>
		<a href="<?php echo esc_url( $aqura_product_main_link ); ?>">
			<?php $aqura_product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'single-post-thumbnail' ); ?>
    		<img src="<?php  echo esc_url($aqura_product_image[0]); ?>">
		</a>
		<a href="<?php echo esc_url( $aqura_product_main_link ); ?>">
			<div class="name"><?php echo get_the_title(); ?></div>
		</a>
		<div class="price">
		<?php if ( '' === $product->get_price() ) { ?>
			<?php echo apply_filters( 'woocommerce_empty_price_html', '', $product ); ?>
		<?php } elseif ( $product->is_on_sale() ) { ?>
			<?php echo wc_format_sale_price( wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) ), wc_get_price_to_display( $product ) ) . $product->get_price_suffix(); ?>
			<!-- </span> -->
		<?php } else { ?>
			<?php echo esc_html( wc_get_price_to_display( $product ) . get_woocommerce_currency_symbol() ); ?>
		<?php } ?>
		</div>
	</div>
</div>