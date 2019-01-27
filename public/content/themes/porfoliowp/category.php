<?php
/**
 * The template for displaying categories results pages.
 *
 */

get_header(); 



$class = "";
if ( porfoliowp_redux('mt_blog_layout') == 'mt_blog_fullwidth' ) {
    $class = "row";
}elseif ( porfoliowp_redux('mt_blog_layout') == 'mt_blog_right_sidebar' or porfoliowp_redux('mt_blog_layout') == 'mt_blog_left_sidebar') {
    $class = "col-md-9";
}
$sidebar = porfoliowp_redux('mt_blog_layout_sidebar');
?>


<!-- HEADER TITLE BREADCRUBS SECTION -->
<?php echo porfoliowp_header_title_breadcrumbs(); ?>


<!-- Page content -->
<div class="high-padding">
    <!-- Blog content -->
    <div class="container blog-posts">
        <div class="row">

            <?php if ( porfoliowp_redux('mt_blog_layout') != '' && porfoliowp_redux('mt_blog_layout') == 'mt_blog_left_sidebar') { ?>
                <?php if (is_active_sidebar($sidebar)) { ?>
                    <div class="col-md-3 sidebar-content"><?php dynamic_sidebar( $sidebar ); ?></div>
                <?php } ?>
            <?php } ?>

            <div class="<?php echo esc_attr($class); ?> main-content">
            <?php if ( have_posts() ) : ?>
                <div class="row">
                    <?php /* Start the Loop */ ?>
                    
                    <?php $j = 0; ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                    <?php
                        $j++;
                        $class = "";

                        if ($j%2 == 0) {
                        $class = "even-post clear_both_class";
                    ?>
                        <div class='<?php echo esc_attr($class); ?>'>
                            <?php get_template_part( 'content', 'right' ); ?>
                            <?php if (porfoliowp_redux('mt_blog_grid_columns') == 2 AND $j%2 == 0) { ?>
                                <div class="clearfix"></div>
                            <?php } elseif (porfoliowp_redux('mt_blog_grid_columns') == 3 AND $j%3 == 0) { ?>
                                <div class="clearfix"></div>
                            <?php } ?>
                        </div>

                    <?php } else { 
                        $class = "odd-post clear_both_class";
                    ?>
                        <div class='<?php echo esc_attr($class); ?>'>
                            <?php get_template_part( 'content', 'left' ); ?>
                            <?php if (porfoliowp_redux('mt_blog_grid_columns') == 2 AND $j%2 == 0) { ?>
                                <div class="clearfix"></div>
                            <?php } elseif (porfoliowp_redux('mt_blog_grid_columns') == 3 AND $j%3 == 0) { ?>
                                <div class="clearfix"></div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                    <?php endwhile; ?>
                    <div class="modeltheme-pagination-holder col-md-12">             
                        <div class="modeltheme-pagination pagination">             
                            <?php porfoliowp_pagination(); ?>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <?php get_template_part( 'content', 'none' ); ?>
            <?php endif; ?>
            </div>

            <?php if ( porfoliowp_redux('mt_blog_layout') != '' && porfoliowp_redux('mt_blog_layout') == 'mt_blog_right_sidebar') { ?>
                <?php if (is_active_sidebar($sidebar)) { ?>
                    <div class="col-md-3 sidebar-content"><?php  dynamic_sidebar( $sidebar ); ?></div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>