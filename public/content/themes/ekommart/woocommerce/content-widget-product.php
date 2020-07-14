<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * @var $product WC_Product
 */
global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

?>
<li class="product-item">
	<div class="product-list-inner">
		<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>

		<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
			<?php echo ekommart_product_get_image( $product ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>

		<div class="product-content">
			<?php do_action( 'ekommart_product_list_content_before' ); ?>
			<?php if ( ! empty( $show_rating ) ) : ?>
				<?php echo wc_get_rating_html( $product->get_average_rating() ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php endif; ?>

			<a class="product-title" href="<?php echo esc_url( $product->get_permalink() ); ?>"><span><?php echo wp_kses_post( $product->get_name() ); ?></span></a>
			<span class="price">
            <?php echo ekommart_product_get_price_html( $product ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</span>
			<?php do_action( 'ekommart_product_list_content_after' ); ?>
		</div>

		<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
	</div>
</li>
