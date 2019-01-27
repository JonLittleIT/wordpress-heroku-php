<?php
/* Woocommerce template. */
$farvis_id = farvis_woo_get_page_id();
$farvis_isProduct = false;

if ( is_single() && get_post_type() == 'product' ) {
	$farvis_isProduct = true;
}

$farvis_custom = $farvis_id > 0 ? get_post_custom($farvis_id) : array();
$farvis_layout = isset ($farvis_custom['pix_page_layout']) ? reset($farvis_custom['pix_page_layout']) : '2';
$farvis_sidebar = isset ($farvis_custom['pix_selected_sidebar'][0]) ? reset($farvis_custom['pix_selected_sidebar']) : 'sidebar-1';

if ( $farvis_isProduct === true ) {
	$farvis_useSettingsGlobal = farvis_get_option( 'shop_settings_global_product', 'on' );
	if ( $farvis_useSettingsGlobal == 'on' ) {
		$farvis_layout = farvis_get_option( 'shop_settings_sidebar_type', '2');
		$farvis_sidebar = farvis_get_option( 'shop_settings_sidebar_content', 'product-sidebar-1' );
	}
}

if ( ! is_active_sidebar($farvis_sidebar) ) $farvis_layout = '1';

get_header(); ?>


<section class="page-section">
	<div class="container">
		<div class="row">
			<main class="main-content">

				<?php farvis_show_sidebar( 'left', $farvis_layout, $farvis_sidebar, 1 ); ?>

				<div class="rtd <?php if ( $farvis_layout == 1 ) : ?>col-lg-12 col-md-12<?php else : ?>col-lg-9 col-md-8<?php endif; ?> col-sm-12 col-xs-12 left-column sidebar-type-<?php echo esc_attr($farvis_layout == 2 ? 'right' : ($farvis_layout == 3 ? 'left' : 'hide')); ?>">

					<?php  woocommerce_content(); ?>

				</div>

				<?php farvis_show_sidebar( 'right', $farvis_layout, $farvis_sidebar, 1 ); ?>

			</main>

		</div>
	</div>
</section>

<?php get_footer();?>
