<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version 5.0.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( has_post_thumbnail() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
$aqura_single_shopattachment_ids 	= $product->get_gallery_image_ids();
$aqura_thumbnails_index 			= 0;
$aqura_images_index 				= 0;
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="product-tab">
		<div class="shop-single-thumbnails">
			<ul class="clearfix au-img">
				<?php foreach ( $aqura_single_shopattachment_ids as $attachment_id ) { ?>
					<?php if ( $aqura_thumbnails_index == 0 ): ?>
					<li class="active">
					<?php else: ?>
					<li>
					<?php endif ?>
						<a data-index="<?php echo esc_attr( $aqura_thumbnails_index ); ?>">
							<img src="<?php echo esc_url( wp_get_attachment_url( $attachment_id , 'thumbnail' ) ); ?>" alt="<?php echo get_the_title(); ?>">
						</a>
					</li>
					<?php $aqura_thumbnails_index++;
				} ?>
			</ul>
		</div><!-- end bio-years -->
	</div><!-- end product-tab -->
	<div class="big-images">
		<div class="bio-description">
			<?php foreach ( $aqura_single_shopattachment_ids as $attachment_id ) { ?>
				<?php if ( $aqura_images_index == 0 ): ?>
				<div data-index="<?php echo esc_attr( $aqura_images_index ); ?>">
				<?php else: ?>
				<div class="hide-content" data-index="<?php echo esc_attr( $aqura_images_index ); ?>">
				<?php endif ?>
					<a class="slideshow"><img src="<?php echo esc_url( wp_get_attachment_url( $attachment_id , 'full' ) ); ?>" alt="<?php echo get_the_title(); ?>"></a>
				</div><!-- end about-yearOne -->
				<?php $aqura_images_index++; ?>
			<?php } ?>
		</div><!-- end  biodescription -->
	</div><!-- end big-images -->
</div>
