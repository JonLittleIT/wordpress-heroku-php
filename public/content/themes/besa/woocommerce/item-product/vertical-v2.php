<?php 
global $product;

$product_style = isset($product_style) ? $product_style : '';

?>
<div class="product-block product <?php echo esc_attr($product_style); ?> <?php besa_is_product_variable_sale(); ?>" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
	<div class="product-top">
		<?php
			/**
			* tbay_woocommerce_before_content_product hook
			*
			* @hooked woocommerce_show_product_loop_sale_flash - 10
			*/
			do_action( 'tbay_woocommerce_before_content_product' );
		?>
	</div>
	<div class="product-content">
		<div class="block-inner">
			<figure class="image ">
				<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
					<?php echo trim($product->get_image()); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			</figure>
		</div>
		<div class="caption">
			<?php 
				do_action('besa_woo_before_shop_loop_item_caption');
			?>
			<?php besa_the_product_name(); ?>
			<?php
				/**
				* besa_woocommerce_loop_item_rating hook
				*
				* @hooked woocommerce_template_loop_rating - 10
				*/
				do_action( 'besa_woocommerce_loop_item_rating');
			?>
			
			<div class="price-wrapper">
				<?php
					/**
					* woocommerce_after_shop_loop_item_title hook
					*
					* @hooked woocommerce_template_loop_price - 10
					*/
					
					do_action( 'woocommerce_after_shop_loop_item_title');
				?>
			</div>
		</div>
    </div>
</div>
