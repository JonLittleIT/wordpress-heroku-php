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
$placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-sidebar.jpg';
?>

<article <?php post_class('post-item post-sidebar  clearfix'); ?>>
    <div class="article-image">
            <?php if(has_post_thumbnail()) : ?>
                <?php if(!get_theme_mod('sp_post_thumb')) : ?>
                    <?php $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "bitther-sidebar" ); ?>
                    <div class="post-image">
                        <a href=" <?php echo get_permalink() ?>">
                            <img  class="lazy" src="<?php echo esc_url($placeholder_image);?>"  data-original="<?php echo esc_attr($thumbnail_src[0]);?>" data-src="<?php echo esc_attr($thumbnail_src[0]);?>" alt="<?php echo esc_attr('post-image'); ?>"/>
                        </a>
                    </div>
                <?php endif; ?>
                <?php else :
                    $add_class='full-width';
            endif; ?>
    </div>
    <div class="article-content side-item-text <?php echo esc_attr($add_class);?>">
        <div class="entry-header sidebar_recent_post clearfix">
            <div class="entry-header-title info_post">
				<div class="category-view">
					<?php echo the_category(); ?>
					<span class="post_view">
						<span class="icon ti-eye"></span>
						<?php echo bitther_get_PostViews(get_the_ID()) ?>
					</span>
				</div>
				<h3 class="entry-title"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark"><?php the_title();  ?></a></h3>
            </div>
        </div>
    </div>
</article><!-- #post-## -->
