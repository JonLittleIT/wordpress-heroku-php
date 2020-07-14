<?php   
	global $woocommerce; 
	$_id = besa_tbay_random_key();

	extract($args);
?>
<div class="tbay-topcart popup">
 <div id="cart-<?php echo esc_attr($_id); ?>" class="cart-dropdown cart-popup dropdown">
        <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" href="javascript:void(0);" title="<?php esc_attr_e('View your shopping cart', 'besa'); ?>">
			<?php  besa_tbay_minicart_button( $icon_mini_cart, $show_title_mini_cart, $title_mini_cart, $price_mini_cart ); ?>
        </a>            
        <div class="dropdown-menu">
        	<div class="widget-header-cart">
				<?php if($show_title_mini_cart === 'true' && !empty($title_dropdown_mini_cart) ) {
					?><h3 class="widget-title heading-title"><?php echo trim($title_dropdown_mini_cart); ?></h3><?php
				} ?>
				
				<a href="javascript:;" class="offcanvas-close"><i class="tb-icon tb-icon-cross"></i></a>
			</div> 
        	<div class="widget_shopping_cart_content">
            	<?php woocommerce_mini_cart(); ?>
       		</div>
    	</div>
    </div>
</div>     