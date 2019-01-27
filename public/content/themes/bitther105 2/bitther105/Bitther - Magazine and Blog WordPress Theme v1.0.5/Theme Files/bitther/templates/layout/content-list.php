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

//number word content
$number_word = get_theme_mod('bitther_number_content_post','25');
$placeholder_image = get_template_directory_uri(). '/assets/images/layzyload_list_latest.jpg';
$add_class ='';
?>
<article  <?php post_class('post-item post-list clearfix'); ?>>
    <div class="article-image">
        <?php if(has_post_thumbnail()) : ?>
            <?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "bitther-blog-list" ); ?>
            <div class="post-image">
                <span class="bgr-item"></span>
                <a href="<?php echo get_permalink();?>">
                    <img  class="lazy" src="<?php echo esc_url($placeholder_image);?>"  data-src="<?php echo esc_attr($thumbnail_src[0]);?>" alt="<?php echo esc_attr('post-image'); ?>"/>
                </a>
            </div>

        <?php else :
            $add_class='full-width';
        endif; ?>
        <?php if(has_post_format('gallery')) : ?>
            <?php $images = get_post_meta( get_the_ID(), '_format_gallery_images', true );?>
            <?php if($images) : ?>
                <div class="post-gallery post-format">
                    <a  href="<?php echo get_post_format_link( $format ); ?>" class="post-format"><i class="ti-image"></i></a>
                </div>
            <?php endif; ?>

        <?php elseif(has_post_format('video')) : ?>
            <div class="post-video post-format <?php echo esc_attr($add_class);?>">
                <a  href="<?php echo get_post_format_link( $format ); ?>" class="post-format"><i class="ti-control-play"></i></a>
            </div>
        <?php elseif(has_post_format('audio')) : ?>
            <div class="post-audio post-format asdasd">
                <a  href="<?php echo get_post_format_link( $format ); ?>" class="post-format"><i class="ti-headphone"></i></a>
            </div>
        <?php elseif(has_post_format('quote')) :?>
            <div class="post-quote post-format <?php echo esc_attr($add_class);?>">
                <?php $sp_quote = get_post_meta( get_the_ID(), '_format_quote_source_name', true ); ?>
                <a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('bitther-blog-list'); ?></a>
                <a  href="<?php echo get_post_format_link( $format ); ?>" class="post-format"><i class="ti-quote-left"></i></a>
            </div>
        <?php endif; ?>
        <span class="post-cat"><?php echo bitther_category(' '); ?></span>
    </div>
    <div class="article-content <?php bitther_meta_class(); ?> <?php echo esc_attr($add_class);?>">

        <div class="entry-header clearfix">
            <div class="article-meta clearfix">
                <?php bitther_entry_meta(); ?>
            </div>
            <div class="entry-header-title">
                <?php
                the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                ?>
            </div>

        </div>
        <div class="entry-content">
            <?php
            if ( has_excerpt() || is_search() ){
                bitther_excerpt();
            }
            else{
                echo bitther_content($number_word);
            }

            wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'bitther' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span class="page-numbers">',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'bitther' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            ) );
            ?>

        </div>

    </div>
</article><!-- #post-## -->
