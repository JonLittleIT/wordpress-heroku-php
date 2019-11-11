<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

$aqura_tabs_index 	= 0;
$aqura_tab_index 	= 0;

if ( ! empty( $tabs ) ) : ?>

	<div class="col-sm-12">
		<div class="single-woo-tabs">
			<ul class="nav nav-pills" role="tablist">
				<?php foreach ( $tabs as $key => $tab ) : ?>
					<li class="<?php echo esc_attr( $key ); ?>_tab <?php if ($aqura_tabs_index == 0) echo esc_attr('active'); ?>" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
						<a href="#tab-<?php echo esc_attr( $key ); ?>" data-toggle="pill"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
					</li>
					<?php $aqura_tabs_index++; ?>
				<?php endforeach; ?>
			</ul>
			<div class="tab-content">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<div class="tab-pane fade <?php if ($aqura_tab_index == 0) echo esc_attr('in active'); ?>" id="tab-<?php echo esc_attr( $key ); ?>">
					<?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
				</div>
				<?php $aqura_tab_index++; ?>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>

<?php endif; ?>
