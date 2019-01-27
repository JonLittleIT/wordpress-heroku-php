<?php
/**
 * The default template for displaying content
 *
 * @author      Nanobitther
 * @link        http://nanobitther.co
 * @copyright   Copyright (c) 2015 Nanobitther
 * @license     GPL v2
 */
$format = get_post_format();
$add_class='';
$comments = get_theme_mod('bitther_post_cat_meta_comment', true);
$view = get_theme_mod('bitther_post_meta_view', true);
$layout = $atts['layout_types'];
?>

    <article <?php post_class('post-item   clearfix '); ?>>
        <div class="article-image post-half">
                <?php if(has_post_thumbnail()) : ?>
                    <?php if(!get_theme_mod('sp_post_thumb')) :
                        $bg_image= get_the_post_thumbnail_url( null, 'full-thumb' );
                        $background_image="background-image:url('$bg_image')";
                        ?>
                        <div class="post-image single-bgr-image"  style="<?php echo esc_attr($background_image);?>">
                        </div>
                        <div class="article-content">
                            <div class="entry-header clearfix">
                                <span class="post-cat"><?php echo bitther_category(', '); ?></span>
                                <div class="entry-header-title">
                                    <?php
                                    the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                                    ?>
                                </div>
                                <div class="article-meta clearfix">
                                    <?php bitther_entry_meta(); ?>
                                </div>
                            </div>
                            <div class="entry-content">
                                <?php
                                if ( has_excerpt() || is_search() ){
                                    bitther_excerpt();
                                }
                                else{
                                    echo bitther_content(50);
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
                    <?php endif; ?>
                <?php else :
                    $placeholder_image = get_template_directory_uri(). '/assets/images/placeholder-box.png';
                    ?>
                    <div class="post-image  placeholder-trans ">
                        <a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('buggy-blog-tran'); ?>
                            <img src="<?php echo esc_url($placeholder_image); ?>" class="wp-post-image" width="1170" height="500">
                        </a>
                    </div>
                <?php endif; ?>
        </div>
    </article><!-- #post-## -->
<!--<a href="--><?php //echo esc_url(comments_link());?><!--" class="text-comment">-->