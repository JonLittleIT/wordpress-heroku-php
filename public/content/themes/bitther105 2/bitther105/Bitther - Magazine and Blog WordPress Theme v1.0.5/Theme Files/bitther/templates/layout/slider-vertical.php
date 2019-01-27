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
?>

    <article <?php post_class('post-item post-tran  clearfix post-vertical'); ?>>
        <div class="article-image">
                <?php if(has_post_thumbnail()) : ?>
                    <?php if(!get_theme_mod('sp_post_thumb')) : ?>
                        <div class="post-image">
                            <a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('bitther-blog-vertical'); ?></a>
                        </div>
                    <?php endif; ?>
                <?php else :
                    $add_class='full-width';
                endif; ?>
        </div>
        <div class="article-content <?php echo esc_attr($add_class);?>">
            <div class="entry-header clearfix">
                 <span class="post-cat"><?php echo bitther_category(' '); ?></span>
                <div class="entry-header-title">
                    <?php
                        the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                    ?>
                </div>
                <div class="article-meta clearfix">
                    <?php bitther_entry_meta(); ?>
                </div>
            </div>
        </div>
    </article><!-- #post-## -->
