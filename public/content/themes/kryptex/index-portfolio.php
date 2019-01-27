<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

kryptex_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	kryptex_show_layout(get_query_var('blog_archive_start'));

	$kryptex_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$kryptex_sticky_out = kryptex_get_theme_option('sticky_style')=='columns'
							&& is_array($kryptex_stickies) && count($kryptex_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$kryptex_cat = kryptex_get_theme_option('parent_cat');
	$kryptex_post_type = kryptex_get_theme_option('post_type');
	$kryptex_taxonomy = kryptex_get_post_type_taxonomy($kryptex_post_type);
	$kryptex_show_filters = kryptex_get_theme_option('show_filters');
	$kryptex_tabs = array();
	if (!kryptex_is_off($kryptex_show_filters)) {
		$kryptex_args = array(
			'type'			=> $kryptex_post_type,
			'child_of'		=> $kryptex_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'number'		=> '',
			'taxonomy'		=> $kryptex_taxonomy,
			'pad_counts'	=> false
		);
		$kryptex_portfolio_list = get_terms($kryptex_args);
		if (is_array($kryptex_portfolio_list) && count($kryptex_portfolio_list) > 0) {
			$kryptex_tabs[$kryptex_cat] = esc_html__('All', 'kryptex');
			foreach ($kryptex_portfolio_list as $kryptex_term) {
				if (isset($kryptex_term->term_id)) $kryptex_tabs[$kryptex_term->term_id] = $kryptex_term->name;
			}
		}
	}
	if (count($kryptex_tabs) > 0) {
		$kryptex_portfolio_filters_ajax = true;
		$kryptex_portfolio_filters_active = $kryptex_cat;
		$kryptex_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters kryptex_tabs kryptex_tabs_ajax">
			<ul class="portfolio_titles kryptex_tabs_titles">
				<?php
				foreach ($kryptex_tabs as $kryptex_id=>$kryptex_title) {
					?><li><a href="<?php echo esc_url(kryptex_get_hash_link(sprintf('#%s_%s_content', $kryptex_portfolio_filters_id, $kryptex_id))); ?>" data-tab="<?php echo esc_attr($kryptex_id); ?>"><?php echo esc_html($kryptex_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$kryptex_ppp = kryptex_get_theme_option('posts_per_page');
			if (kryptex_is_inherit($kryptex_ppp)) $kryptex_ppp = '';
			foreach ($kryptex_tabs as $kryptex_id=>$kryptex_title) {
				$kryptex_portfolio_need_content = $kryptex_id==$kryptex_portfolio_filters_active || !$kryptex_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $kryptex_portfolio_filters_id, $kryptex_id)); ?>"
					class="portfolio_content kryptex_tabs_content"
					data-blog-template="<?php echo esc_attr(kryptex_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(kryptex_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($kryptex_ppp); ?>"
					data-post-type="<?php echo esc_attr($kryptex_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($kryptex_taxonomy); ?>"
					data-cat="<?php echo esc_attr($kryptex_id); ?>"
					data-parent-cat="<?php echo esc_attr($kryptex_cat); ?>"
					data-need-content="<?php echo (false===$kryptex_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($kryptex_portfolio_need_content)
						kryptex_show_portfolio_posts(array(
							'cat' => $kryptex_id,
							'parent_cat' => $kryptex_cat,
							'taxonomy' => $kryptex_taxonomy,
							'post_type' => $kryptex_post_type,
							'page' => 1,
							'sticky' => $kryptex_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		kryptex_show_portfolio_posts(array(
			'cat' => $kryptex_cat,
			'parent_cat' => $kryptex_cat,
			'taxonomy' => $kryptex_taxonomy,
			'post_type' => $kryptex_post_type,
			'page' => 1,
			'sticky' => $kryptex_sticky_out
			)
		);
	}

	kryptex_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>