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
$placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-mini-list.jpg';
?>

<article <?php post_class('post-item slider-sidebar  clearfix'); ?>>
    <div class="article-content side-item-text <?php echo esc_attr($add_class);?>">
	<span class="post-cat"><?php echo bitther_category(', '); ?></span>
	<div class="article-meta clearfix">
		<?php bitther_entry_meta(); ?>
	</div>
        <div class="entry-header clearfix">
            <div class="entry-header-title">
                <h3 class="entry-title">
                    <?php the_title(); ?>
                </h3>
            </div>
        </div>
    </div>
</article><!-- #post-## -->
