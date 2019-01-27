<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

$kryptex_blog_style = explode('_', kryptex_get_theme_option('blog_style'));
$kryptex_columns = empty($kryptex_blog_style[1]) ? 2 : max(2, $kryptex_blog_style[1]);
$kryptex_expanded = !kryptex_sidebar_present() && kryptex_is_on(kryptex_get_theme_option('expand_content'));
$kryptex_post_format = get_post_format();
$kryptex_post_format = empty($kryptex_post_format) ? 'standard' : str_replace('post-format-', '', $kryptex_post_format);
$kryptex_animation = kryptex_get_theme_option('blog_animation');
$kryptex_components = kryptex_is_inherit(kryptex_get_theme_option_from_meta('meta_parts'))
							? 'categories,date,counters'.($kryptex_columns < 3 ? ',edit' : '')
							: kryptex_array_get_keys_by_value(kryptex_get_theme_option('meta_parts'));
$kryptex_counters = kryptex_is_inherit(kryptex_get_theme_option_from_meta('counters'))
							? 'comments'
							: kryptex_array_get_keys_by_value(kryptex_get_theme_option('counters'));

?><div class="<?php echo trim($kryptex_blog_style[0]) == 'classic' ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($kryptex_columns); ?>"><article id="post-<?php the_ID(); ?>"
	<?php post_class( 'post_item post_format_'.esc_attr($kryptex_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($kryptex_columns)
					. ' post_layout_'.esc_attr($kryptex_blog_style[0])
					. ' post_layout_'.esc_attr($kryptex_blog_style[0]).'_'.esc_attr($kryptex_columns)
					); ?>
	<?php echo (!kryptex_is_off($kryptex_animation) ? ' data-animation="'.esc_attr(kryptex_get_animation_classes($kryptex_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	kryptex_show_post_featured( array( 'thumb_size' => kryptex_get_thumb_size($kryptex_blog_style[0] == 'classic'
													? (strpos(kryptex_get_theme_option('body_style'), 'full')!==false
															? ( $kryptex_columns > 2 ? 'big' : 'huge' )
															: (	$kryptex_columns > 2
																? ($kryptex_expanded ? 'med' : 'small')
																: ($kryptex_expanded ? 'big' : 'med')
																)
														)
													: (strpos(kryptex_get_theme_option('body_style'), 'full')!==false
															? ( $kryptex_columns > 2 ? 'masonry-big' : 'full' )
															: (	$kryptex_columns <= 2 && $kryptex_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($kryptex_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('kryptex_action_before_post_title');

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('kryptex_action_before_post_meta');

			// Post meta
			if (!empty($kryptex_components))
				kryptex_show_post_meta(apply_filters('kryptex_filter_post_meta_args', array(
					'components' => $kryptex_components,
					'counters' => $kryptex_counters,
					'seo' => false
					), $kryptex_blog_style[0], $kryptex_columns)
				);

			do_action('kryptex_action_after_post_meta');
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$kryptex_show_learn_more = false; //!in_array($kryptex_post_format, array('link', 'aside', 'status', 'quote'));
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($kryptex_post_format, array('link', 'aside', 'status'))) {
				the_content();
			} else if ($kryptex_post_format == 'quote') {
				if (($quote = kryptex_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
					kryptex_show_layout(wpautop($quote));
				else
					the_excerpt();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($kryptex_post_format, array('link', 'aside', 'status', 'quote'))) {
			if (!empty($kryptex_components))
				kryptex_show_post_meta(apply_filters('kryptex_filter_post_meta_args', array(
					'components' => $kryptex_components,
					'counters' => $kryptex_counters
					), $kryptex_blog_style[0], $kryptex_columns)
				);
		}
		// More button
		if ( $kryptex_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'kryptex'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>