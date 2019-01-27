<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

$kryptex_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$kryptex_post_format = get_post_format();
$kryptex_post_format = empty($kryptex_post_format) ? 'standard' : str_replace('post-format-', '', $kryptex_post_format);
$kryptex_animation = kryptex_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($kryptex_columns); ?>"><article id="post-<?php the_ID(); ?>"
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($kryptex_post_format) ); ?>
	<?php echo (!kryptex_is_off($kryptex_animation) ? ' data-animation="'.esc_attr(kryptex_get_animation_classes($kryptex_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	kryptex_show_post_featured(array(
		'thumb_size' => kryptex_get_thumb_size($kryptex_columns==1 ? 'big' : ($kryptex_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($kryptex_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			kryptex_show_post_meta(apply_filters('kryptex_filter_post_meta_args', array(), 'sticky', $kryptex_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>