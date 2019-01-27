<?php
/**
 * The template for displaying Archive pages
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

get_header();

$title              = get_theme_mod('bitther_post_title_heading',true);
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

//get
if(isset($_GET['col'])){
    $class=$_GET['col'];
}
if(isset($_GET['content'])){
    $layout_content=$_GET['content'];
}

?>
    <div class="wrap-content container" role="main">
        <?php if ($title): ?>
            <h1 class="title-page">
                <?php the_archive_title();?>
            </h1>
            <div class="description-page <?php echo esc_attr($title);?>">
                <?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
            </div>
        <?php endif;?>
        <div class="row content-category">
            <?php do_action('archive-sidebar-left'); ?>
            <?php do_action('archive-content-before'); ?>
            <?php if ( have_posts() ) : ?>
            <div class="archive-blog  row ">
                <div class="rows affect-isotopes">
                    <?php
                    // Start the Loop.
                    $n = 1;
                    while ( have_posts() ) : the_post(); ?>
						<?php if($n==1):?>
								<div class="item-post col-item col-xs-12">
									<?php get_template_part( 'templates/layout/content-list'); ?>
								</div>
							<?php else:?>
                            <div class="item-post col-item <?php echo esc_attr($class);?>">
                                <?php get_template_part( 'templates/layout/content' ,$layout_content); ?>
                            </div>
                         <?php endif;?>
                        <?php $n++; endwhile;

                    else :
                        // If no content, include the "No posts found" template.
                        get_template_part( 'content', 'none' );
                    endif;

                    ?>
                </div>
            </div>
            <?php
            the_posts_pagination( array(
                'prev_text'          => '<i class="fa fa-angle-left"></i>',
                'next_text'          => '<i class="fa fa-angle-right"></i>',
                'before_page_number' => '<span class="meta-nav screen-reader-text"></span>',
            ) );
            ?>
            <?php do_action('archive-content-after'); ?>

            <?php do_action('archive-sidebar-right'); ?>
        </div><!-- .content-area -->
    </div>
<?php
get_footer();


