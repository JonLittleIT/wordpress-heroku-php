<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$store_user   = get_userdata( get_query_var( 'author' ) );
$store_info   = dokan_get_store_info( $store_user->ID );
$map_location = isset( $store_info['location'] ) ? $store_info['location'] : '';

get_header();

$class_row = ( get_post_meta( $post->ID, 'tbay_page_layout', true ) === 'main-right' ) ? 'flex-row-reverse' : '';

if( is_shop() || is_product_category() ) {
    wp_enqueue_style('sumoselect');
    wp_enqueue_script('jquery-sumoselect'); 
}

?>

<?php do_action( 'besa_woo_template_main_before' ); ?>
<section id="main-container" class="main-content <?php echo apply_filters('besa_dokan_content_class', 'container');?>">
    
    <div class="row no-gutters <?php echo esc_attr($class_row); ?>">

        <?php if ( is_active_sidebar('sidebar-store') ) : ?>
        <div id="dokan-secondary" class="col-12 col-xl-3">
            <aside class="sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
                <?php dynamic_sidebar( 'sidebar-store'); ?>
            </aside>
        </div>
        <?php endif; ?>
        <div id="main" class="archive-shop <?php echo ( is_active_sidebar('sidebar-store') ) ? 'col-xl-9' : 'col-12'; ?>">
            <div id="dokan-primary" class="dokan-single-store" >
                <div id="dokan-content" class="store-page-wrap woocommerce site-content" role="main">
            
                    <div id="dokan-content" class="store-page-wrap woocommerce" role="main">
                        <?php dokan_get_template_part( 'store-header' ); ?>

                        <?php do_action( 'dokan_store_profile_frame_after', $store_user, $store_info ); ?>

                        <?php if ( have_posts() ) { ?>

                            <?php do_action( 'woocommerce_before_shop_loop' ); ?>

                                <?php woocommerce_product_loop_start(); ?>
                                    <?php while ( have_posts() ) : the_post(); ?>

                                        <?php wc_get_template_part( 'content', 'product' ); ?>

                                    <?php endwhile; // end of the loop. ?>
                                <?php woocommerce_product_loop_end(); ?>

                            <?php dokan_content_nav( 'nav-below' ); ?>

                        <?php } else { ?>

                            <p class="dokan-info"><?php esc_html_e( 'No products were found of this vendor!', 'besa' ); ?></p>

                        <?php } ?>
                    </div>
                </div><!-- #content -->
            </div><!-- #primary -->
        </div><!-- #main-content -->
    
    </div>
    <?php do_action('woocommerce_after_main_container') ?>
</section>
<?php

get_footer();