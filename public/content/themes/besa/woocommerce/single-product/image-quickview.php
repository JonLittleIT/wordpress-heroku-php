<?php

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_image_ids();
$_images =array();
if(has_post_thumbnail()){
	$_images[] = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'woocommerce_single' ));
}else{
	$_images[] = '<img src="'.wc_placeholder_img_src().'" alt="Placeholder" />';
}
foreach ($attachment_ids as $attachment_id) {
	$_images[]       = wp_get_attachment_image( $attachment_id, 'woocommerce_single' );
}

?>

<?php do_action('besa_before_image_quickview'); ?>

<?php 
$rows = 1; 
$nav_type = 'no';
$pagi_type = $loop_type = 'yes'; 
$auto_type = $autospeed_type = $disable_mobile = '';

$columns = $screen_desktop = $screen_desktopsmall = $screen_tablet = $screen_landscape_mobile = $screen_mobile = 1;

$data_carousel = besa_tbay_data_carousel($rows, $nav_type, $pagi_type, $loop_type, $auto_type, $autospeed_type, $disable_mobile); 
$responsive_carousel  = besa_tbay_check_data_responsive_carousel($columns, $screen_desktop, $screen_desktopsmall, $screen_tablet, $screen_landscape_mobile, $screen_mobile);
?>

<div id="quickview-carousel" class="owl-carousel quickview-carousel" data-carousel='owl' <?php echo trim($responsive_carousel); ?>  <?php echo trim($data_carousel); ?>>
	<?php foreach ($_images as $key => $image) { ?>
		<div class="item">
			<?php echo trim($image); ?>
		</div>
	<?php } ?>
</div>

<?php do_action('besa_woo_quickview_js'); ?>