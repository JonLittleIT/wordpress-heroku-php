<?php
/**
 * Shop Filters
 *
 * Renders filters on shop page
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<div class="shop-filters beehive-filters">
	<div class="filter-wrapper">
		<div class="search beehive-shop-search">
			<?php if ( class_exists( 'DGWT_WC_Ajax_Search' ) ) : ?>
				<?php echo do_shortcode( '[wcas-search-form]' ); ?>
			<?php else : ?>
				<?php get_product_search_form(); ?>
			<?php endif; ?>
		</div>
		<?php if ( is_active_sidebar( beehive()->sidebars->get_sidebar_id( 'Shop Filters' ) ) ) : ?>
			<div class="wrap-collapse-button">
				<button class="button button-filter" type="button" data-toggle="collapse" data-target="#shop_filter_widgets" aria-expanded="false" aria-controls="shop_filter_widgets">
					<i class=" uil-sliders-v"></i>
					<?php esc_html_e( 'Filter', 'beehive' ); ?>
				</button>
			</div>
		<?php endif; ?>
	</div>
	<?php if ( is_active_sidebar( beehive()->sidebars->get_sidebar_id( 'Shop Filters' ) ) ) : ?>
		<div id="shop_filter_widgets" class="collapse">
			<div class="widget-wrapper">
				<?php dynamic_sidebar( beehive()->sidebars->get_sidebar_id( 'Shop Filters' ) ); ?>
			</div>
		</div>
	<?php endif; ?>
</div>
