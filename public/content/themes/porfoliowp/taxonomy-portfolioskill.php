<?php
/**
 * The template for displaying search results pages.
 */

get_header(); ?>


<!-- HEADER TITLE BREADCRUBS SECTION -->
<?php echo porfoliowp_header_title_breadcrumbs(); ?>


<!-- Page content -->
<div class="high-padding">
    <!-- Blog content -->
    <div class="container blog-posts">
        <div class="row">
            <div class="col-md-12 main-content">
        		<?php if ( have_posts() ) : ?>
                    <div class="row">
            			<?php /* Start the Loop */ ?>

                        <div class="grid grid--loading mt-grid-portfolio-shortcode mt-portfolio-grid-archive grid_overlay_fancybox_holder">
                            <img class="grid__loader" src="<?php echo esc_url(get_template_directory_uri() . '/images/svg/grid.svg'); ?>" width="60" alt="<?php echo esc_attr__('Grid', 'porfoliowp')?>" />
                            <div class="grid__sizer"></div>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'content', 'portfolio' ); ?>
                            <?php endwhile; ?>
                        </div>

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
	   </div>
    </div>
</div>

<?php get_footer(); ?>