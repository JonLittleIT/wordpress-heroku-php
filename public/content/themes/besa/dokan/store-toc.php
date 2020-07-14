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

<section id="main-container" class="main-container <?php echo apply_filters('besa_dokan_content_class', 'container');?>">

    <div class="row no-gutters <?php echo esc_attr($class_row); ?>">

        <?php if ( is_active_sidebar('sidebar-store') ) : ?>
        <div id="dokan-secondary" class="col-xl-3 col-12">
            <aside class="sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
                <?php dynamic_sidebar( 'sidebar-store'); ?>
            </aside>
        </div>
        <?php endif; ?>

        <div id="main-content" class="archive-shop <?php echo ( is_active_sidebar('sidebar-store') ) ? 'col-xl-9' : 'col-12'; ?>">
            <div id="dokan-primary" class="dokan-single-store">
                <div id="dokan-content" class="store-page-wrap woocommerce site-content" role="main">
            
                    <?php dokan_get_template_part( 'store-header' ); ?>

                    <div id="store-toc-wrapper">
                        <div id="store-toc">
                            <?php
                            if( isset( $store_info['store_tnc'] ) ):
                            ?>
                                <h2 class="headline"><?php esc_html_e( 'Terms And Conditions', 'besa' ); ?></h2>
                                <div>
                                    <?php
                                    echo nl2br($store_info['store_tnc']);
                                    ?>
                                </div>
                            <?php
                            endif;
                            ?>
                        </div><!-- #store-toc -->
                    </div><!-- #store-toc-wrap -->
                </div><!-- #content -->
            </div><!-- #primary -->
        </div><!-- #main-content -->

    </div>
</section>
<?php

get_footer();