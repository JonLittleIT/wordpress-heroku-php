<?php
/**
 * The default template for displaying content
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

$format = get_post_format();
$add_class='';
$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "bitther-blog-video" );
$placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-blog-video.jpg';
?>

<article <?php post_class('post-item video-trans clearfix'); ?>>
    <div class="article-image">
            <?php if(has_post_thumbnail()) : ?>
                <?php if(!get_theme_mod('sp_post_thumb')) : ?>
                    <div class="post-image">
                        <a href="<?php echo get_permalink() ?>">
                            <img  class="lazy" src="<?php echo esc_url($placeholder_image);?>"  data-src="<?php echo esc_attr($thumbnail_src[0]);?>" alt="<?php echo esc_attr('post-image'); ?>"/>
                        </a>
                    </div>
                <?php endif; ?>
            <?php else :
                $add_class='full-width';
                $placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-video.jpg';
                ?>
                <div class="post-image  <?php echo esc_attr($add_class);?>">
                    <a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('bitther-blog-tran'); ?>
                        <img src="<?php echo esc_url($placeholder_image); ?>" class="wp-post-image" width="1170" height="500">
                    </a>
                </div>
            <?php endif; ?>
            <a  href="<?php echo get_permalink() ?>" class="post-format"><i class="fa fa-play"></i></a>
        <span class="bg-rgb"></span>
    </div>

    <div class="article-content <?php echo esc_attr($add_class);?>">
        <div class="entry-header clearfix">
            <div class="entry-header-title">
                <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
            </div>
        </div>
    </div>
</article><!-- #post-## -->
