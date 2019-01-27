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
$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
$bg_image="background-image:url('$thumbnail_src[0]')";
?>
<article <?php post_class('post-item post-tran  clearfix'); ?>>
    <div class="article-tran hover-share-item">
        <?php if(has_post_thumbnail()) : ?>
            <?php if(!get_theme_mod('sp_post_thumb')) : ?>
                <?php if(has_post_thumbnail()) : ?>
                    <div class="post-image lazy" style = "<?php echo esc_attr($bg_image);?>">
                        <a href="<?php echo get_permalink() ?>"></a>
                    </div>
                <?php endif;?>
                <span class="bg-rgb"></span>
				<span class="post-cat"><?php echo bitther_category(', '); ?></span>
                <div class="article-content  <?php bitther_meta_class(); ?>">
					<div class="article-content-inner">
						<div class="entry-header clearfix">
							<div class="entry-header-title">
                                <div class="article-meta clearfix">
                                    <?php bitther_entry_meta(); ?>
                                </div>
                                <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
							</div>
						</div>

					</div>
                </div>
            <?php endif; ?>
        <?php else :
            $placeholder_image = get_template_directory_uri(). '/assets/images/placeholder-trans.png';
            ?>
            <div class="post-image  placeholder-trans ">
                <a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('buggy-blog-tran'); ?>
                    <img src="<?php echo esc_url($placeholder_image); ?>" class="wp-post-image" width="1170" height="500">
                </a>
            </div>
        <?php endif; ?>
    </div>

</article><!-- #post-## -->
