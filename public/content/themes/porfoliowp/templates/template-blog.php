<?php
/*
* Template Name: Blog
*/


get_header(); 


$class = "";

if ( porfoliowp_redux('mt_blog_layout') == 'mt_blog_fullwidth' ) {
    $class = "col-md-12";
}elseif ( porfoliowp_redux('mt_blog_layout') == 'mt_blog_right_sidebar' or porfoliowp_redux('mt_blog_layout') == 'mt_blog_left_sidebar') {
    $class = "col-md-9";
}
$breadcrumbs_on_off = get_post_meta( get_the_ID(), 'breadcrumbs_on_off', true );
$blog_page_header = get_post_meta( get_the_ID(), 'blog_page_header', true );

$sidebar = $porfoliowp_redux['mt_blog_layout_sidebar'];
?>



<!-- HEADER TITLE BREADCRUBS SECTION -->
<?php echo porfoliowp_header_title_breadcrumbs(); ?>


<!-- Page content -->

    <!-- ///////////////////// Start Grid/List Layout ///////////////////// -->
    <?php
    wp_reset_postdata();
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    $args = array(
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'paged'            => $paged,
    );
    $posts = new WP_Query( $args );
    ?>
    <!-- Blog content -->
    <div class="container blog-posts high-padding">
        
        <h2 class="blog_heading heading-bottom ">
            <?php echo porfoliowp_redux('mt_blog_post_title'); ?>
        </h2>
        <div class="row">

            <?php if ( porfoliowp_redux('mt_blog_layout') != '' && porfoliowp_redux('mt_blog_layout') == 'mt_blog_left_sidebar') { ?>
                    <div class="col-md-3 sidebar-content"><?php  dynamic_sidebar( $sidebar ); ?></div>
            <?php } ?>

            <div class="<?php echo esc_attr($class); ?> main-content">
                <div class="row">

                <?php if ( $posts->have_posts() ) : ?>
                    <?php /* Start the Loop */ ?>
                    <?php
                    $j = 0;
                    while ( $posts->have_posts() ) : $posts->the_post(); 
                    $j++;

                    $class = "";
                    if ($j%2 == 0) {
                        $class = "even-post clear_both_class";
                    ?>
                        <div class='<?php echo esc_attr($class); ?>'>
                            <?php get_template_part( 'content', 'right' ); ?>
                        </div>
                    <?php }else{ 
                    $class = "odd-post clear_both_class";
                    ?>
                        <div class='<?php echo esc_attr($class); ?>'>
                            <?php get_template_part( 'content', 'left' ); ?>
                        </div>
                    <?php } ?>

                    <?php endwhile; ?>
                    <?php echo '<div class="clearfix"></div>'; ?>
                <?php else : ?>
                    <?php get_template_part( 'content', 'none' ); ?>
                <?php endif; ?>
                
                <div class="clearfix"></div>

                <?php 
                query_posts($args);
                global  $wp_query;
                if ($wp_query->max_num_pages != 1) { ?>                
                <div class="modeltheme-pagination-holder col-md-12">           
                    <div class="modeltheme-pagination pagination">           
                        <?php porfoliowp_pagination(); ?>
                    </div>
                </div>
                <?php } ?>
                </div>
            </div>

            <?php if ( porfoliowp_redux('mt_blog_layout') != '' && porfoliowp_redux('mt_blog_layout') == 'mt_blog_right_sidebar') { ?>
                <div class="col-md-3 sidebar-content"><?php  dynamic_sidebar( $sidebar ); ?></div>
            <?php } ?>

        </div>
    </div>


<?php
get_footer();
?>