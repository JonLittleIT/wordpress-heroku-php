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
$kryptex_columns = empty($kryptex_blog_style[1]) ? 1 : max(1, $kryptex_blog_style[1]);
$kryptex_expanded = !kryptex_sidebar_present() && kryptex_is_on(kryptex_get_theme_option('expand_content'));
$kryptex_post_format = get_post_format();
$kryptex_post_format = empty($kryptex_post_format) ? 'standard' : str_replace('post-format-', '', $kryptex_post_format);
$kryptex_animation = kryptex_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($kryptex_columns).' post_format_'.esc_attr($kryptex_post_format) ); ?>
	<?php echo (!kryptex_is_off($kryptex_animation) ? ' data-animation="'.esc_attr(kryptex_get_animation_classes($kryptex_animation)).'"' : ''); ?>>

	<?php
	// Add anchor
	if ($kryptex_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	kryptex_show_post_featured( array(
											'class' => $kryptex_columns == 1 ? 'kryptex-full-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => kryptex_get_thumb_size(
																	strpos(kryptex_get_theme_option('body_style'), 'full')!==false
																		? ( $kryptex_columns > 1 ? 'huge' : 'original' )
																		: (	$kryptex_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('kryptex_action_before_post_title');

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('kryptex_action_before_post_meta');

			// Post meta
			$kryptex_components = kryptex_is_inherit(kryptex_get_theme_option_from_meta('meta_parts'))
										? 'categories,date'.($kryptex_columns < 3 ? ',counters' : '').($kryptex_columns == 1 ? ',edit' : '')
										: kryptex_array_get_keys_by_value(kryptex_get_theme_option('meta_parts'));
			$kryptex_counters = kryptex_is_inherit(kryptex_get_theme_option_from_meta('counters'))
										? 'comments'
										: kryptex_array_get_keys_by_value(kryptex_get_theme_option('counters'));
			$kryptex_post_meta = empty($kryptex_components)
										? '' 
										: kryptex_show_post_meta(apply_filters('kryptex_filter_post_meta_args', array(
												'components' => $kryptex_components,
												'counters' => $kryptex_counters,
												'seo' => false,
												'echo' => false
												), $kryptex_blog_style[0], $kryptex_columns)
											);
			kryptex_show_layout($kryptex_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$kryptex_show_learn_more = !in_array($kryptex_post_format, array('link', 'aside', 'status', 'quote'));
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
				kryptex_show_layout($kryptex_post_meta);
			}
			// More button
			if ( $kryptex_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'kryptex'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>