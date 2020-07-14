<?php 
global $product;

$product_style = isset($product_style) ? $product_style : '';

?>
<div class="product-block product <?php echo esc_attr($product_style); ?> <?php besa_is_product_variable_sale(); ?>" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
	<div class="product-content">
		<div class="block-inner">
			<figure class="image ">
				<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
					<?php echo trim($product->get_image()); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			</figure>
		</div>
		<div class="caption">

		<?php besa_the_product_name(); ?>

		<?php do_action( 'woocommerce_after_shop_loop_item_vertical_title'); ?>
		
		</div>
    </div>
</div>
