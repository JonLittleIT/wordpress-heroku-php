<?php
/**
 * The default template for displaying content
 *
 * @author      Nanobither
 * @link        http://nanobither.co
 * @copyright   Copyright (c) 2015 Nanobither
 * @license     GPL v2
 */
$format = get_post_format();
$placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-single.jpg';
?>

<article <?php post_class('post-item post-full clearfix'); ?>>
    <div class="article-full hover-share-item">
            <div class="entry-header entry-header-single clearfix">
                <span class="post-cat"><?php echo bitther_category(' '); ?></span>
                <div class="article-meta clearfix">
                    <?php bitther_entry_meta(); ?>
                </div>
                <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            </div>
            <div class="single_author">
                <?php if(get_theme_mod('bitther_avatar_meta')):?>
                    <div class="entry-avatar clearfix">
                        <?php
                        $author_bio_avatar_size = apply_filters( 'bitther_author_bio_avatar_size', 50 );
                        echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
                        ?>

                        <div class="avatar-meta">
                            <span class="author-title">
                                <span class="by"><span class="ti-minus"></span><?php echo esc_html__('BY','bitther'); ?></span>
                                <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                                    <?php echo esc_attr(get_the_author()); ?>
                                </a>
                            </span>
                        </div>
                    </div>
                    <div class="share-social">
                        <?php get_template_part('templates/share-social'); ?>
                    </div>
                <?php endif;?>
            </div>
            <?php if(has_post_thumbnail() ) : ?>
                <?php if(!get_theme_mod('sp_post_thumb')) : ?>
                    <div class="post-image single-image">
                        <?php $thumbnail_full = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" ); ?>
                        <?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "bitther-single" ); ?>
                        <figure class="wp-single-image">
                            <a href="<?php echo esc_attr($thumbnail_full[0]);?>" data-size="<?php echo esc_attr($thumbnail_full[1]); ?>x<?php echo esc_attr($thumbnail_full[2]); ?>">
                                <img  class="wp-post-image" src="<?php echo esc_attr($thumbnail_src[0]);?>" alt="<?php echo esc_attr('single-image'); ?>"/>
                            </a>
                        </figure>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <div class="article-content ">
                <div class="entry-content clearfix">
                    <?php echo bitther_closetags(bitther_excerpt_content(150)); ?>
                </div>
                <span class="btn-rgb"></span>
            </div>
            <a  class="btn view_more" href="<?php echo esc_url(get_permalink()); ?>">
                <?php esc_html_e('View More Article','bitther')?>
            </a>
    </div>
</article><!-- #post-## -->
