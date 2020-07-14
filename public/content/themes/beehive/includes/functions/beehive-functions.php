<?php
/**
 * Theme Functions
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

// Actions
// Ping back url.
add_action( 'wp_head', 'beehive_pingback_header' );
// Content width.
add_action( 'template_redirect', 'beehive_content_width', 0 );
// Sidebar menu template.
add_action( 'beehive_after_sidebar', 'beehive_get_sidebar_navmenu_template' );
// Process ajax search request.
add_action( 'wp_ajax_beehive_ajax_search', 'beehive_ajax_search' );
add_action( 'wp_ajax_nopriv_beehive_ajax_search', 'beehive_ajax_search' );

// Fiters
// Add body classes.
add_filter( 'body_class', 'beehive_body_classes' );
// Add post classes.
add_filter( 'post_class', 'beehive_post_classes' );

if ( ! function_exists( '_wp_render_title_tag' ) ) :
	/**
	 * Generate head title tag
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function svq_slug_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'svq_slug_render_title' );
endif;

if ( ! function_exists( 'beehive_body_classes' ) ) :
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 * @since 1.0.0
	 */
	function beehive_body_classes( $classes ) {

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Add theme class.
		$classes[] = 'beehive';

		// User classes.
		if ( is_user_logged_in() ) {
			$classes[] = 'beehive-user';
		} else {
			$classes[] = 'beehive-guest-user';
		}

		// Return classes.
		return $classes;
	}
endif;

if ( ! function_exists( 'beehive_header_classes' ) ) :
	/**
	 * Beehive header classes
	 *
	 * @return array
	 * @since 1.0.0
	 */
	function beehive_header_classes() {

		// Classes array.
		$classes = array();

		// Common class.
		$classes[] = 'site-header';

		// Add header type class.
		if ( 'social' === beehive()->navigation->get() ) {
			$classes[] = 'social-header';
		} else {
			$classes[] = 'default-header';
		}

		// Add overlay class.
		if ( beehive()->options->get( 'key=overlay-header&meta=1&options=0' ) ) {
			$classes[] = 'overlay-header';
		}

		// Add white menu class.
		if ( beehive()->options->get( 'key=navbar-color&meta=1&options=0' ) ) {
			$classes[] = 'menu-color-white';
		}

		// Return classes.
		return apply_filters( 'beehive_header_classes', $classes );
	}
endif;

if ( ! function_exists( 'beehive_pingback_header' ) ) :
	/**
	 * Ping back url
	 * Add a pingback url auto-discovery header for singularly identifiable posts.
	 *
	 * @return void
	 */
	function beehive_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}
endif;

if ( ! function_exists( 'beehive_get_logo_url' ) ) {
	/**
	 * Get theme logo url
	 *
	 * @return string
	 * @since 1.0.0
	 */
	function beehive_get_logo_url() {

		// Default logo path.
		$logo_url = BEEHIVE_URI . '/assets/images/logo.svg';

		// Page/post logo.
		if ( beehive()->options->get( 'key=logo&meta=1&options=0' ) ) {
			$logo_url = beehive()->options->get( 'key=logo&meta=1&options=0' );
		} else {
			if ( in_array( beehive()->layout->get(), array( 'social', 'social-12', 'social-collapsed' ), true ) && beehive()->options->get( 'key=logo-vertical&nested=url&default=' . BEEHIVE_URI . '/assets/images/logo-vertical.svg' ) ) {
				$logo_url = beehive()->options->get( 'key=logo-vertical&nested=url&default=' . BEEHIVE_URI . '/assets/images/logo-vertical.svg' );
			} else {
				if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo           = wp_get_attachment_image_src( $custom_logo_id, 'full' );
					if ( isset( $logo[0] ) ) {
						$logo_url = $logo[0];
					}
				}
			}
		}

		// Return url.
		return apply_filters( 'beehive_logo_url', $logo_url );
	}
}

if ( ! function_exists( 'beehive_get_icon_logo_url' ) ) :
	/**
	 * Get icon logo url
	 *
	 * @return string
	 * @since 1.0.0
	 */
	function beehive_get_icon_logo_url() {
		if ( beehive()->options->get( 'key=logo&meta=1&options=0' ) ) {
			$logo_url = beehive()->options->get( 'key=logo&meta=1&options=0' );
		} else {
			$logo_url = beehive()->options->get( 'key=logo-icon&nested=url' );
		}
		return $logo_url;
	}
endif;

add_action( 'wp_head', 'beehive_get_icon_logo_url' );

if ( ! function_exists( 'beehive_get_font_url' ) ) :
	/**
	 * Get font url
	 *
	 * @return string
	 * @since 1.0.0
	 */
	function beehive_get_font_url() {
		require_once BEEHIVE_INC . '/class-beehive-google-fonts.php';
		$fonts = new Beehive_Fonts();
		return $fonts->get_url();
	}
endif;

if ( ! function_exists( 'beehive_post_classes' ) ) :
	/**
	 * Get the blog layout style
	 *
	 * @param array $classes body classes.
	 * @return array
	 * @since 1.0.0
	 */
	function beehive_post_classes( $classes ) {

		// Add theme post class.
		$classes[] = 'beehive-post';

		// Add animate classes.
		if ( 'post' === get_post_type() && ! is_singular() ) {
			$classes[] = 'animate-item';
			$classes[] = 'slideInUp';
		}

		// Return classes.
		return $classes;
	}
endif;

if ( ! function_exists( 'beehive_blog_layout' ) ) :
	/**
	 * Get the blog layout style
	 *
	 * @return string
	 * @since 1.0.0
	 */
	function beehive_blog_layout() {

		// Set blog layout.
		$layout_style = 'right';
		if ( 'post' === get_post_type() ) {
			if ( is_single() ) {
				$layout_style = 'full';
			} else {
				if ( beehive()->options->get( 'key=display-blog-sidebar&default=1' ) ) {
					if ( 'left' === beehive()->options->get( 'key=blog-sidebar-alignment' ) ) {
						$layout_style = 'left';
					} else {
						$layout_style = 'right';
					}
				} else {
					$layout_style = 'full';
				}
			}
		}

		// Return value.
		return apply_filters( 'beehive_blog_layout_style', $layout_style );
	}
endif;

if ( ! function_exists( 'beehive_post_container_classes' ) ) :
	/**
	 * Get blog post container classes
	 *
	 * @return array
	 * @since 1.0.0
	 */
	function beehive_post_container_classes() {

		// Container class.
		$classes = array( 'beehive-post-container' );
		if ( 'classic' === beehive()->options->get( 'key=blog-style' ) || is_search() ) {
			$classes[] = 'blog-layout-classic';
		} else {
			$classes[] = 'blog-layout-grid';
			$classes[] = 'masonry';
			if ( true === beehive()->sidebars->show && true === beehive()->sidebars->active ) {
				$classes[] = 'grid-columns-2';
			} else {
				$classes[] = 'grid-columns-3';
			}
		}

		// Return classes.
		return apply_filters( 'beehive_post_container_classes', $classes );
	}
endif;

if ( ! function_exists( 'beehive_get_blog_template' ) ) :
	/**
	 * Get the blog template.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_get_blog_template() {
		if ( 'classic' === beehive()->options->get( 'key=blog-style' ) ) {
			get_template_part( 'template-parts/content', 'classic' );
		} else {
			get_template_part( 'template-parts/content', 'grid' );
		}
	}
endif;

if ( ! function_exists( 'beehive_content_width' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * @global int $content_width
	 * @since 1.0.0
	 */
	function beehive_content_width() {
		$content_width = $GLOBALS['content_width'];
		if ( 'social' === beehive()->layout->get() ) {
			$content_width = 1000;
		} else {
			$content_width = 1110;
		}
		$GLOBALS['content_width'] = apply_filters( 'beehive_content_width', $content_width );
	}
endif;

if ( ! function_exists( 'beehive_get_related_posts' ) ) :
	/**
	 * Get the related posts
	 *
	 * @param int $post_id    ID of the post.
	 * @param int $post_count number of post to show.
	 * @return object
	 * @since 1.0.0
	 */
	function beehive_get_related_posts( $post_id = false, $post_count = 5 ) {

		// post id.
		if ( empty( $post_id ) && get_the_ID() ) {
			$post_id = get_the_ID();
		}

		// return if post id not available.
		if ( empty( $post_id ) ) {
			return;
		}

		$args      = '';
		$post_type = get_post_type();

		if ( 'post' === $post_type ) {
			$args = wp_parse_args(
				$args,
				array(
					'category__in'        => wp_get_post_categories( $post_id ),
					'ignore_sticky_posts' => 0,
					'posts_per_page'      => $post_count,
					'post__not_in'        => array( $post_id ),
				)
			);
		} else {
			$taxonomy = $post_type . '_category';
			if ( ! taxonomy_exists( $taxonomy ) ) {
				return;
			}
			$categories = get_the_terms( $post_id, $taxonomy );
			$items      = array();
			if ( $categories ) {
				foreach ( $categories as $category ) {
					if ( isset( $category->term_id ) ) {
						$items[] = $category->term_id;
					}
				}
			}
			if ( ! empty( $items ) ) {
				$args = wp_parse_args(
					$args,
					array(
						'ignore_sticky_posts' => 0,
						'post_status'         => 'publish',
						'posts_per_page'      => $post_count,
						'post__not_in'        => array( $post_id ),
						'post_type'           => $post_type,
						'tax_query'           => array(
							array(
								'field'    => 'id',
								'taxonomy' => $taxonomy,
								'terms'    => $items,
							),
						),
					)
				);
			}
		}

		// Query.
		$query = new WP_Query( $args );

		// Return query.
		return $query;
	}
endif;

if ( ! function_exists( 'beehive_related_post' ) ) {
	/**
	 * Render related post.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_related_post() {
		get_template_part( 'template-parts/related', 'posts' );
	}
}

if ( ! function_exists( 'beehive_get_post_thumbnail' ) ) :
	/**
	 * Featured image or first embeded image
	 * if featured image is not available
	 *
	 * @return string || false
	 * @since 1.0.0
	 */
	function beehive_get_post_thumbnail() {

		/** Find the image */
		if ( has_post_thumbnail() ) {
			$image = get_the_post_thumbnail_url();
		} else {
			if ( ! is_single() ) {
				global $post;
				preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', $post->post_content, $matches );
				if ( isset( $matches[1][0] ) ) {
					$image = $matches[1][0];
				}
			}
		}

		/** Return the image */
		if ( isset( $image ) && ! empty( $image ) ) {
			return $image;
		}

		return false;
	}
endif;

if ( ! function_exists( 'beehive_post_meta' ) ) :
	/**
	 * Prints the post entry meta
	 *
	 * Date
	 * Categories
	 *
	 * @return void
	 */
	function beehive_post_meta() {

		// Before post meta action.
		do_action( 'beehive_before_post_meta' );

		// Post date.
		printf( '<span class="link date-links"><i class="uil-calender"></i><a href="%s">%s</a></span>', esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), get_the_date() );

		// translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( esc_html__( ', ', 'beehive' ) );
		if ( $categories_list ) {
			printf( '<span class="link cat-links"><i class="uil-folder"></i>%1$s</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		// translators: used between list items, there is a space after the comma.
		if ( is_single() ) {
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'beehive' ) );
			if ( $tags_list ) {
				printf( '<span class="link tags-links"><i class="uil-tag-alt"></i>%1$s</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		// After post meta action.
		do_action( 'beehive_after_post_meta' );
	}
endif;

if ( ! function_exists( 'beehive_post_slider' ) ) :
	/**
	 * Render post slider
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_post_slider() {
		$photos = beehive_get_post_slider_images();
		if ( ! empty( $photos ) ) {
			include locate_template( 'template-parts/post-slider.php' );
		}
	}
endif;

if ( ! function_exists( 'beehive_get_post_slider_images' ) ) :
	/**
	 * Get post slider images
	 *
	 * @return array || false
	 * @since 1.0.0
	 */
	function beehive_get_post_slider_images() {

		// Photos Array.
		$photos = array();

		// Get the post thumbnails.
		if ( ! ( is_single() && '0' === beehive()->options->get_meta_option( 'post-thumb' ) ) && has_post_thumbnail() ) {
			array_push( $photos, get_the_post_thumbnail_url() );
		}

		// Get the meta thumbnails.
		if ( beehive()->options->get( 'key=post-slider&meta=0&options=1&default=1' ) && beehive()->options->get( 'key=post-slider&meta=1&options=0' ) ) {
			$photos = array_merge( $photos, array_values( beehive()->options->get( 'key=post-slider&meta=1&options=0' ) ) );
		}

		// Return photos.
		if ( ! empty( $photos ) ) {
			return $photos;
		}

		return false;
	}
endif;

if ( ! function_exists( 'beehive_get_sidebar_navmenu_template' ) ) :
	/**
	 * Conditionally get the sidebar nav menu
	 * for social page template
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_get_sidebar_navmenu_template() {
		if ( 'social' === beehive()->layout->get() ) {
			get_template_part( 'template-parts/sidebar-navmenu' );
		}
	}
endif;

if ( ! function_exists( 'beehive_get_other_networks' ) ) :
	/**
	 * Get the social icons html output
	 *
	 * @return string or false
	 * @since 1.0.0
	 */
	function beehive_get_other_networks() {

		// Networks array.
		$networks = array();

		// Facebook.
		if ( beehive()->options->get( 'key=facebook' ) ) {
			$networks['Facebook'] = array(
				'url'  => beehive()->options->get( 'key=facebook' ),
				'icon' => 'ion-social-facebook',
			);
		}

		// Twitter.
		if ( beehive()->options->get( 'key=twitter' ) ) {
			$networks['Twitter'] = array(
				'url'  => beehive()->options->get( 'key=twitter' ),
				'icon' => 'ion-social-twitter',
			);
		}

		// Google.
		if ( beehive()->options->get( 'key=g-plus' ) ) {
			$networks['Google'] = array(
				'url'  => beehive()->options->get( 'key=g-plus' ),
				'icon' => 'ion-social-googleplus',
			);
		}

		// Pinterest.
		if ( beehive()->options->get( 'key=pinterest' ) ) {
			$networks['Pinterest'] = array(
				'url'  => beehive()->options->get( 'key=pinterest' ),
				'icon' => 'ion-social-pinterest',
			);
		}

		// Linkedin.
		if ( beehive()->options->get( 'key=linkedin' ) ) {
			$networks['Linkedin'] = array(
				'url'  => beehive()->options->get( 'key=linkedin' ),
				'icon' => 'ion-social-linkedin',
			);
		}

		// Instagram.
		if ( beehive()->options->get( 'key=instagram' ) ) {
			$networks['Instagram'] = array(
				'url'  => beehive()->options->get( 'key=instagram' ),
				'icon' => 'ion-social-instagram-outline',
			);
		}

		// Dribbble.
		if ( beehive()->options->get( 'key=dribbble' ) ) {
			$networks['Dribbble'] = array(
				'url'  => beehive()->options->get( 'key=dribbble' ),
				'icon' => 'ion-social-dribbble-outline',
			);
		}

		// Tumblr.
		if ( beehive()->options->get( 'key=tumblr' ) ) {
			$networks['Tumblr'] = array(
				'url'  => beehive()->options->get( 'key=tumblr' ),
				'icon' => 'ion-social-tumblr',
			);
		}

		// Github.
		if ( beehive()->options->get( 'key=github' ) ) {
			$networks['Github'] = array(
				'url'  => beehive()->options->get( 'key=github' ),
				'icon' => 'ion-social-github',
			);
		}

		// Youtube.
		if ( beehive()->options->get( 'key=youtube' ) ) {
			$networks['Youtube'] = array(
				'url'  => beehive()->options->get( 'key=youtube' ),
				'icon' => 'ion-social-youtube',
			);
		}

		// Vimeo.
		if ( beehive()->options->get( 'key=vimeo' ) ) {
			$networks['Vimeo'] = array(
				'url'  => beehive()->options->get( 'key=vimeo' ),
				'icon' => 'ion-social-vimeo',
			);
		}

		// Prepare the social icons.
		$item = '';
		foreach ( $networks as $network => $attr ) {
			$item .= sprintf( '<li class="item"><a href="%1$s" title="%2$s" target="_blank"><i class="icon %3$s"></i></a></li>', esc_url( $attr['url'] ), esc_attr( $network ), esc_attr( $attr['icon'] ) );
		}

		// Return html output for social icons.
		if ( ! empty( $item ) ) {
			return sprintf( '<ul class="social-links">%s</ul>', $item );
		}

		// False.
		return false;

	}
endif;

if ( ! function_exists( 'beehive_pagination' ) ) :
	/**
	 * Renders pagination
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_pagination() {
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) {
			get_template_part( 'template-parts/pagination' );
		}
	}
endif;

if ( ! function_exists( 'beehive_page_links' ) ) :
	/**
	 * Page links
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_page_links() {
		wp_link_pages(
			array(
				'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'beehive' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
				'pagelink'    => '%',
			)
		);
	}
endif;

if ( ! function_exists( 'beehive_get_current_user_display_name' ) ) :
	/**
	 * Get current user display name
	 *
	 * @return string
	 * @since 1.0.0
	 */
	function beehive_get_current_user_display_name() {

		// get the curret user.
		$current_user = wp_get_current_user();

		// return display name.
		if ( ! empty( $current_user->display_name ) ) {
			return $current_user->display_name;
		}

		// False.
		return false;
	}
endif;

if ( ! function_exists( 'beehive_ajax_search' ) ) :
	/**
	 * Catch ajax request and send back data
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_ajax_search() {

		// Verify nonce.
		if ( isset( $_POST['search_nonce'] ) && wp_verify_nonce( $_POST['search_nonce'], 'beehive_search_nonce' ) ) { // @codingStandardsIgnoreLine

			// Die if search string is empty.
			if ( empty( $_POST['search'] ) ) {
				die();
			}

			// Search string.
			$search_str = sanitize_text_field( wp_unslash( $_POST['search'] ) );

			// Output.
			$output = '';

			// Queried objects.
			$post    = array();
			$members = array();
			$groups  = array();

			// Post query.
			$query = new WP_Query(
				array(
					'post_type'      => 'post',
					'posts_per_page' => 5,
					'post_status'    => 'publish',
					's'              => trim( $search_str ),
				)
			);

			// Posts.
			$posts = $query->get_posts();

			// Members and groups.
			if ( function_exists( 'bp_is_active' ) ) {

				// Members query.
				$members = bp_core_get_users(
					array(
						'per_page'        => 5,
						'search_terms'    => $search_str,
						'populate_extras' => false,
					)
				);

				// Groups query.
				if ( bp_is_active( 'groups' ) ) {
					$groups = groups_get_groups(
						array(
							'per_page'        => 5,
							'search_terms'    => $search_str,
							'populate_extras' => false,
						)
					);
				}
			}

			// Queried members.
			if ( ! empty( $members ) && ( isset( $members['total'] ) && $members['total'] > 0 ) ) {

				$output .= '<div class="search-type members">';
				$output .= '<div class="search-type-title"><h5>' . esc_html__( 'Members', 'beehive' ) . '</h5></div>';
				$output .= '<ul class="members">';
				foreach ( (array) $members['users'] as $member ) {
					$output .= '<li class="item">';
					$output .= '<a href="' . esc_url( bp_core_get_user_domain( $member->ID ) ) . '">';
					$output .= '<div class="thumbnail"><img src="' . esc_url(
						bp_core_fetch_avatar(
							array(
								'item_id' => $member->ID,
								'width'   => 40,
								'height'  => 40,
								'html'    => false,
							)
						)
					) . '" class="avatar" /></div>';
					$output .= '<div class="item-info">';
					$output .= '<span class="title ellipsis"><strong>' . esc_html( $member->display_name ) . '</strong></span>';
					$output .= '</div>';
					$output .= '</a>';
					$output .= '</li>';
				}
				$output .= '</ul>';
				$output .= '<a href="' . esc_url( bp_get_members_directory_permalink() ) . '" class="view-all color-primary">' . esc_html__( 'View all', 'beehive' ) . '<i class="uil-arrow-circle-right"></i></a>';
				$output .= '</div>';
			}

			// Queried groups.
			if ( ! empty( $groups ) && ( isset( $groups['total'] ) && $groups['total'] > 0 ) ) {
				$output .= '<div class="search-type groups">';
				$output .= '<div class="search-type-title"><h5>' . esc_html__( 'Groups', 'beehive' ) . '</h5></div>';
				$output .= '<ul class="groups">';
				foreach ( (array) $groups['groups'] as $group ) {
					$output .= '<li class="item">';
					$output .= '<a href="' . esc_url( bp_get_group_permalink( $group ) ) . '">';
					$output .= '<div class="thumbnail"><img src="' . esc_url(
						bp_core_fetch_avatar(
							array(
								'item_id' => $group->id,
								'width'   => 40,
								'height'  => 40,
								'object'  => 'group',
								'html'    => false,
							)
						)
					) . '" class="avatar" /></div>';
					$output .= '<div class="item-info">';
					$output .= '<span class="title ellipsis"><strong>' . esc_html( $group->name ) . '</strong></span>';
					$output .= '</div>';
					$output .= '</a>';
					$output .= '</li>';
				}
				$output .= '</ul>';
				$output .= '<a href="' . esc_url( bp_get_groups_directory_permalink() ) . '" class="view-all color-primary">' . esc_html__( 'View all', 'beehive' ) . '<i class="uil-arrow-circle-right"></i></a>';
				$output .= '</div>';
			}

			// Queried posts.
			if ( ! empty( $posts ) ) {
				$output .= '<div class="search-type post">';
				$output .= '<div class="search-type-title"><h5>' . esc_html__( 'Posts', 'beehive' ) . '</h5></div>';
				$output .= '<ul class="blogposts">';
				foreach ( (array) $posts as $post ) {
					$output .= '<li class="item">';
					$output .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">';
					$output .= '<div class="thumbnail"><i class="uil-file-edit-alt"></i></div>';
					$output .= '<div class="item-info">';
					$output .= '<span class="title ellipsis"><strong>' . esc_html( get_the_title( $post->ID ) ) . '</strong></span>';
					$output .= '</div>';
					$output .= '</a>';
					$output .= '</li>';
				}
				$output .= '</ul>';
				$output .= '<a href="' . esc_url( home_url( '/' ) ) . '" class="view-all color-primary">' . esc_html__( 'View all', 'beehive' ) . '<i class="uil-arrow-circle-right"></i></a>';
				$output .= '</div>';
				wp_reset_postdata();
			}

			// If output is still empty add the empty html string.
			if ( '' === $output ) {
				$output .= '<div class="nothing-found">' . esc_html__( 'Nothing found!', 'beehive' ) . '</div>';
			}

			// Print output.
			echo wp_kses_post( $output );

		}

		// Kill it.
		die();
	}
endif;

if ( ! function_exists( 'beehive_file_get_contents' ) ) :
	/**
	 * Get file contents.
	 * Using WP File system API.
	 *
	 * @param string $file_path path of the file to read.
	 * @return bool
	 * @since 1.0.0
	 */
	function beehive_file_get_contents( $file_path ) {
		if ( ! function_exists( 'get_filesystem_method' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}
		$context                      = dirname( $file_path );
		$allow_relaxed_file_ownership = true;
		if ( function_exists( 'get_filesystem_method' ) && 'direct' === get_filesystem_method( array(), $context, $allow_relaxed_file_ownership ) ) {
			$creds = request_filesystem_credentials( site_url() . '/wp-admin/', '', false, $context, null, $allow_relaxed_file_ownership );
			if ( WP_Filesystem( $creds, $context, $allow_relaxed_file_ownership ) ) {
				global $wp_filesystem;
				return $wp_filesystem->get_contents( $file_path );
			}
		}
		return false;
	}
endif;

if ( ! function_exists( 'beehive_file_put_contents' ) ) :
	/**
	 * Write files.
	 * Using WP File system API.
	 *
	 * @param string $file_path path of the file to write.
	 * @param string $contents  contents that will be written.
	 * @param string $mode      mode.
	 * @return bool
	 * @since 1.0.0
	 */
	function beehive_file_put_contents( $file_path, $contents, $mode = '' ) {
		if ( ! function_exists( 'get_filesystem_method' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}
		if ( '' === $mode ) {
			if ( defined( 'FS_CHMOD_FILE' ) ) {
				$mode = FS_CHMOD_FILE;
			} else {
				$mode = 0644;
			}
		}
		$context                      = dirname( $file_path );
		$allow_relaxed_file_ownership = true;
		if ( function_exists( 'get_filesystem_method' ) && 'direct' === get_filesystem_method( array(), $context, $allow_relaxed_file_ownership ) ) {
			$creds = request_filesystem_credentials( site_url() . '/wp-admin/', '', false, $context, null, $allow_relaxed_file_ownership );
			if ( WP_Filesystem( $creds, $context, $allow_relaxed_file_ownership ) ) {
				global $wp_filesystem;
				return $wp_filesystem->put_contents( $file_path, $contents, $mode );
			}
		}
		return false;
	}
endif;

if ( ! function_exists( 'beehive_footer_has_menu' ) ) :
	/**
	 * Check if footer has wp menu
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	function beehive_footer_has_menu() {
		if ( has_nav_menu( 'company-menu' ) ) {
			return true;
		} elseif ( has_nav_menu( 'community-menu' ) ) {
			return true;
		} elseif ( has_nav_menu( 'usefull-menu' ) ) {
			return true;
		} elseif ( has_nav_menu( 'legal-menu' ) ) {
			return true;
		} else {
			return false;
		}
	}
endif;

if ( ! function_exists( 'beehive_get_pages' ) ) :
	/**
	 * Get page list in array
	 *
	 * @return array
	 * @since 1.0.0
	 */
	function beehive_get_pages() {
		$pages = get_pages(
			array(
				'post_type'   => 'page',
				'post_status' => 'publish',
			)
		);
		$items = array();
		if ( is_array( $pages ) ) {
			foreach ( $pages as $page ) {
				$items[ $page->ID ] = $page->post_title;
			}
		}
		return $items;
	}
endif;

if ( ! function_exists( 'beehive_get_menus' ) ) :
	/**
	 * Get menus
	 *
	 * @return array
	 * @since 1.0.0
	 */
	function beehive_get_menus() {
		$menus = wp_get_nav_menus();
		$items = array();
		$i     = 0;
		foreach ( $menus as $menu ) {
			if ( $i == 0 ) { // @codingStandardsIgnoreLine
				$default = $menu->slug;
				$i ++;
			}
			$items[ $menu->slug ] = $menu->name;
		}
		return $items;
	}
endif;

if ( ! function_exists( 'beehive_trim_str' ) ) {
	/**
	 * Trim string with char number
	 *
	 * @param string $string         string to be trimmed.
	 * @param int    $max_length     maximun length.
	 * @param string $trim_indicator indicator.
	 * @return string
	 * @since 1.0.0
	 */
	function beehive_trim_str( $string, $max_length = 100, $trim_indicator = '...' ) {
		if ( ! is_string( $string ) || '' === $string ) {
			return;
		}
		if ( strlen( $string ) > $max_length ) {
			$shown_length = $max_length;
			if ( $shown_length < 1 ) {
				throw new \InvalidArgumentException( 'Second argument for ' . __METHOD__ . '() is too small.' );
			}
			preg_match( '/^(.{0,' . ( $shown_length - 1 ) . '}\w\b)/su', $string, $matches );
			return ( isset( $matches[1] ) ? $matches[1] : substr( $string, 0, $shown_length ) ) . $trim_indicator;
		}
		return $string;
	}
}
