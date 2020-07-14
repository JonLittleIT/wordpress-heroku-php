<?php
$class_shop = '';
$sidebar_configs = besa_tbay_get_woocommerce_layout_configs();
$sidebar_id = $sidebar_configs['sidebar']['id'];

if( empty($sidebar_id) )  return;

if( besa_woo_is_vendor_page() ) {
	$class_shop .= ' vendor_sidebar';
}

if( besa_woo_is_wcmp_vendor_store() ) {
	$sidebar_id = 'wc-marketplace-store';
}

?> 
<?php  if (  isset($sidebar_configs['sidebar']) && is_active_sidebar($sidebar_id) ) : ?>

	<aside id="sidebar-shop" class="sidebar d-none d-xl-block <?php echo esc_attr($sidebar_configs['sidebar']['class']); ?> <?php echo esc_attr($class_shop); ?>">
		<?php dynamic_sidebar($sidebar_id); ?>
	</aside>

<?php endif; ?>