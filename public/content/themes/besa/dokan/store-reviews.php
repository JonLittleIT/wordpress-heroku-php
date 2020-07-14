<?php
/**
 * The Template for displaying all reviews.
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$store_user = get_userdata( get_query_var( 'author' ) );
$store_info = dokan_get_store_info( $store_user->ID );
$map_location = isset( $store_info['location'] ) ? $store_info['location'] : '';

get_header();

$content_class = '';
if ( is_active_sidebar('sidebar-store') ) {
    $content_class  .= 'col-md-9';
    $content_class  .= ' pull-right';
} 

 if( is_shop() || is_product_category() ) {
    wp_enqueue_style('sumoselect');
    wp_enqueue_script('jquery-sumoselect'); 
 }

?>

<?php do_action( 'besa_woo_template_main_before' ); ?>

<section id="main-container" class="main-container <?php echo apply_filters('besa_dokan_content_class', 'container');?>">
    


    <div class="row">

    
        <div id="main-content" class="archive-shop col-12 <?php echo esc_attr($content_class); ?>">
            <div id="dokan-primary" class="dokan-single-store">
                <div id="dokan-content" class="store-page-wrap woocommerce site-content" role="main">
            
                    <div id="dokan-content" class="store-review-wrap woocommerce" role="main">

                        <?php dokan_get_template_part( 'store-header' ); ?>

                        <?php
                        $dokan_template_reviews = dokan_pro()->review;
                        $id                     = $store_user->ID;
                        $post_type              = 'product';
                        $limit                  = 20;
                        $status                 = '1';
                        $comments               = $dokan_template_reviews->comment_query( $id, $post_type, $limit, $status );
                        ?>

                        <div id="reviews">
                            <div id="comments">

                                <?php do_action( 'dokan_review_tab_before_comments' ); ?>

                                <h2 class="headline"><?php _e( 'Vendor Review', 'besa' ); ?></h2>

                                <ol class="commentlist">
                                    <?php echo trim($dokan_template_reviews->render_store_tab_comment_list( $comments , $store_user->ID)); ?>
                                </ol>
                            </div>
                        </div>

                        <?php
                        echo trim($dokan_template_reviews->review_pagination( $id, $post_type, $limit, $status ));
                        ?>

                    </div><!-- #content .site-content -->
                </div><!-- #content -->
            </div><!-- #primary -->
        </div><!-- #main-content -->
        
        <?php if ( is_active_sidebar('sidebar-store') ) : ?>
            <div id="dokan-secondary" class="col-md-3 col-12">
                <aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
                    <?php dynamic_sidebar( 'sidebar-store'); ?>
                </aside>
            </div>
        <?php endif; ?>

    </div>
</section>
<?php

get_footer();