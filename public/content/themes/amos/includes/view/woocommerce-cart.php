<?php global $amos_redata; ?>

<div class="cart">

		<?php if(!WC()->cart->get_cart_contents_count()): ?>

		<a class="cart_icon" href="<?php echo esc_url(wc_get_cart_url()); ?>"><i class="lnr lnr-cart"></i><span class="nr"><?php echo esc_attr(WC()->cart->get_cart_contents_count()) ?></span></a>
		
		<div class="content">
			<span class="empty"><?php esc_html_e('Cart is empty', 'amos'); ?></span>
			<div class="checkout">

                <div class="subtotal"> 
                           <span class="subtotal_title"><?php esc_html_e('Subtotal:', 'amos'); ?> </span>
                           <span class="pricing"><?php $cart_subtotal = WC()->cart->get_cart_subtotal(); 
                              echo wp_kses($cart_subtotal, array('span'));?></span>
                </div>

                <div class="view_cart  <?php echo esc_attr($amos_redata['cart_dropdown_button']) ?>"><a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart_button btn-bt <?php echo esc_attr($amos_redata['overall_button_style'][0]) ?>"><?php esc_html_e('View Cart', 'amos'); ?></a></div>

				

			</div>
		</div>

		<?php else: ?> 

		<a class="cart_icon cart_icon_active" href="<?php echo esc_url(wc_get_cart_url()); ?>"><i class="lnr lnr-cart"></i><span class="nr"><?php echo esc_attr(WC()->cart->get_cart_contents_count()) ?></span></a>

		<div class="content">

			<div class="items">

			<?php foreach(WC()->cart->get_cart_contents() as $key => $cart_item): ?>

			

				<div class="cart_item">

					<a href="<?php echo esc_url(get_permalink($cart_item['product_id'])); ?>">

					<?php echo get_the_post_thumbnail($cart_item['product_id'], 'post_thumbnail'); ?>

					<div class="description">

						<span class="title"><?php echo esc_html($cart_item['data']->get_title()); ?></span>

						<span class="price"><?php echo esc_html($cart_item['quantity']); ?> x <?php echo esc_attr(WC()->cart->get_product_subtotal($cart_item['data'], $cart_item['quantity'])); ?></span>

					</div>

					</a>

					<a class="remove" href="<?php echo esc_url(wc_get_cart_remove_url($key)) ?>"></a>

				</div>

			<?php endforeach; ?>

			</div>

			<div class="checkout">

				<div class="subtotal"> 
                           <span class="subtotal_title"><?php esc_html_e('Subtotal:', 'amos'); ?> </span>
                           <?php $cart_subtotal = WC()->cart->get_cart_subtotal(); 
                              echo wp_kses($cart_subtotal, array('span'));?>
                </div>
				
                <div class="view_cart <?php echo esc_attr($amos_redata['cart_dropdown_button']) ?>"><a href="<?php echo wc_get_cart_url(); ?>" class="cart_button btn-bt <?php echo esc_attr($amos_redata['overall_button_style'][0]) ?>"><?php esc_html_e('View Cart', 'amos'); ?></a></div>

				

			</div>

		</div>

		<?php endif; ?>

</div>