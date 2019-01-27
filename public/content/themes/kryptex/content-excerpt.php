<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

$kryptex_post_format = get_post_format();
$kryptex_post_format = empty($kryptex_post_format) ? 'standard' : str_replace('post-format-', '', $kryptex_post_format);
$kryptex_animation = kryptex_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($kryptex_post_format) ); ?>
	<?php echo (!kryptex_is_off($kryptex_animation) ? ' data-animation="'.esc_attr(kryptex_get_animation_classes($kryptex_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	kryptex_show_post_featured(array( 'thumb_size' => kryptex_get_thumb_size( strpos(kryptex_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));

	// Title and post meta
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('kryptex_action_before_post_title');

			// Post title
			the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

			do_action('kryptex_action_before_post_meta');

			// Post meta
			$kryptex_components = kryptex_is_inherit(kryptex_get_theme_option_from_meta('meta_parts'))
										? 'categories,date,counters,edit'
										: kryptex_array_get_keys_by_value(kryptex_get_theme_option('meta_parts'));
			$kryptex_counters = kryptex_is_inherit(kryptex_get_theme_option_from_meta('counters'))
										? 'views,likes,comments'
										: kryptex_array_get_keys_by_value(kryptex_get_theme_option('counters'));

			if (!empty($kryptex_components))
				kryptex_show_post_meta(apply_filters('kryptex_filter_post_meta_args', array(
					'components' => $kryptex_components,
					'counters' => $kryptex_counters,
					'seo' => false
					), 'excerpt', 1)
				);
			?>
		</div><!-- .post_header --><?php
	}
	
	// Post content
	?><div class="post_content entry-content"><?php
		if (kryptex_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'kryptex' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'kryptex' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$kryptex_show_learn_more = !in_array($kryptex_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
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
			?></div><?php
			// More button
			if ( $kryptex_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'kryptex'); ?></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
</article>