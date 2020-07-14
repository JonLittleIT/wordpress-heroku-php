<?php 
/**
 * The template Image layout normal
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Besa
 * @since Besa 1.0
 */

global $product;

$social_share 			= 	( besa_tbay_get_config('enable_code_share',false)  && besa_tbay_get_config('enable_product_social_share', false) );

//check Enough number image thumbnail
$attachment_ids 		= $product->get_gallery_image_ids();

$class_thumbnail 		= (empty($attachment_ids)) ? 'no-gallery-image' : '';
$class_social_share 	= ( $social_share ) ? 'col-xl-7' : '';

?>
<div class="single-main-content">
	<div class="row">
		<div class="top-main-content col-12">
			<div class="row">
				<div class="col-12 <?php echo esc_attr($class_social_share); ?>">
				<?php
					/**
					* woocommerce_before_left_main_single_product hook
					*
					* @hooked woocommerce_template_single_title - 5
					* @hooked woocommerce_template_single_rating - 10
					*/
					do_action( 'woocommerce_before_left_main_single_product' );
				?>
				</div>
				<?php 
					if ( besa_tbay_get_config('enable_code_share',false)  && besa_tbay_get_config('enable_product_social_share', false) ) { ?>

						<div class="col-12 col-xl-5">
						<?php
							/**
							* woocommerce_before_right_main_single_product hook
							*
							* @hooked share_box_html - 5
							*/
							do_action( 'woocommerce_before_right_main_single_product' );
						?>
						</div>

					<?php }
				?>
			</div>
		</div>
		<div class="image-mains col-lg-6 <?php echo esc_attr( $class_thumbnail ); ?>">
			<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
		</div>
		<div class="information col-lg-6">
			<div class="summary entry-summary ">

				<?php
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked besa_woocommerce_template_single_price_wrapper - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>

			</div><!-- .summary -->
		</div>

	</div>
</div>
<?php
/**
 * woocommerce_after_single_product_summary hook
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */
do_action( 'woocommerce_after_single_product_summary' );