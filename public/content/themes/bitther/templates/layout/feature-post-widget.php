<?php
/**
 * The default template for displaying content
 *
 * @author      Nanobitther
 * @link        http://nanobitther.co
 * @copyright   Copyright (c) 2015 Nanobitther
 * @license     GPL v2
 */
?>
<article <?php post_class('post-item clearfix'); ?>>
    <div class="article-tran hover-share-item top_storie">
		<div class="feature_post_widget bitther-tb">
			<div class="number bitther-cell left">
				<?php if($ai<10){ echo '0'.$ai; }else{ echo esc_attr($ai); } ?>
			</div>
			<div class="caption bitther-cell">
				<div class="entry-header clearfix">
                        <div class="entry-header-title">
                            <?php
								$text = wp_trim_words(get_the_title(),8,'...');
							?>
							<h3 class="entry-title"><a href="<?php echo esc_url( get_permalink()); ?>" rel="bookmark"><?php echo do_shortcode($text)  ?></a></h3>
                        </div>
                </div>
				<div class="post_date">
						<?php echo get_the_date(get_option('date_format')); ?>
				</div>
			</div>
		</div>
    </div>

</article><!-- #post-## -->
