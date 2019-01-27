<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

// Page (category, tag, archive, author) title

if ( kryptex_need_page_title() ) {
	kryptex_sc_layouts_showed('title', true);
	kryptex_sc_layouts_showed('postmeta', false);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_left">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_left">
						<?php
						// Post meta on the single post
						if ( false && is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								kryptex_show_post_meta(apply_filters('kryptex_filter_post_meta_args', array(
									'components' => 'categories,date,counters,edit',
									'counters' => 'views,comments,likes',
									'seo' => true
									), 'header', 1)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$kryptex_blog_title = kryptex_get_blog_title();
							$kryptex_blog_title_text = $kryptex_blog_title_class = $kryptex_blog_title_link = $kryptex_blog_title_link_text = '';
							if (is_array($kryptex_blog_title)) {
								$kryptex_blog_title_text = $kryptex_blog_title['text'];
								$kryptex_blog_title_class = !empty($kryptex_blog_title['class']) ? ' '.$kryptex_blog_title['class'] : '';
								$kryptex_blog_title_link = !empty($kryptex_blog_title['link']) ? $kryptex_blog_title['link'] : '';
								$kryptex_blog_title_link_text = !empty($kryptex_blog_title['link_text']) ? $kryptex_blog_title['link_text'] : '';
							} else
								$kryptex_blog_title_text = $kryptex_blog_title;
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr($kryptex_blog_title_class); ?>"><?php
								$kryptex_top_icon = kryptex_get_category_icon();
								if (!empty($kryptex_top_icon)) {
									$kryptex_attr = kryptex_getimagesize($kryptex_top_icon);
                                    $alt = basename($kryptex_top_icon);
                                    $alt = substr($alt,0,strlen($alt) - 4);
									?><img src="<?php echo esc_url($kryptex_top_icon); ?>" alt="<?php echo esc_html($alt); ?>" <?php if (!empty($kryptex_attr[3])) kryptex_show_layout($kryptex_attr[3]);?>><?php
								}
								echo wp_kses_data($kryptex_blog_title_text);
							?></h1>
							<?php
							if (!empty($kryptex_blog_title_link) && !empty($kryptex_blog_title_link_text)) {
								?><a href="<?php echo esc_url($kryptex_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($kryptex_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'kryptex_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>