<?php
/**
 * The template for displaying archive pages
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */
get_header();

$layout_content     = get_theme_mod('bitther_layout_cat_content', 'list');

$content_col   = get_theme_mod('bitther_number_post_cat', '1');
if ($content_col==='2'){
    $class='col-md-6 col-xs-12';
}
elseif ($content_col==='3'){
    $class='col-md-4 col-xs-12';
}
elseif ($content_col==='4'){
    $class='col-md-3 col-xs-12';
}else{
    $class='col-md-12';
}

?>

<div class="container">
    <div class="row">
        <div class="main-content col-sm-12 col-md-9 col-lg-9 content-right " role="main">
            <?php if ( have_posts() ) : ?>
            <div class="archive-blog row">
                <?php
                // Start the Loop.
                $n=1;
                while ( have_posts() ) : the_post(); ?>
                        <div class="item-post post-default-index col-item <?php echo esc_attr($class);?>">
                            <?php get_template_part( 'templates/layout/content' ,$layout_content); ?>
                        </div>
                <?php  endwhile;

                else :
                    // If no content, include the "No posts found" template.
                    get_template_part( 'content', 'none' );

                endif;
                the_posts_pagination( array(
                    'prev_text'          => '<i class="fa fa-angle-left"></i>',
                    'next_text'          => '<i class="fa fa-angle-right"></i>',
                    'before_page_number' => '<span class="meta-nav screen-reader-text"></span>',

                ) );
                ?>
            </div>

        </div><!-- .site-main -->

        <div id="archive-sidebar" class="sidebar sidebar-right  hidden-sx hidden-sm col-sx-12 col-sm-12 col-md-3 col-lg-3 archive-sidebar">
            <div class="content-inner">
                <?php if(is_active_sidebar( 'archive')){
                    dynamic_sidebar('archive');
                }?>
            </div>
        </div>

    </div><!-- .content-area -->
</div>
<?php get_footer(); ?>
