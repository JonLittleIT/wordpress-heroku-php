<?php

if ( ! function_exists( 'ekommart_display_comments' ) ) {
	/**
	 * Ekommart display comments
	 *
	 * @since  1.0.0
	 */
	function ekommart_display_comments() {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || 0 !== intval( get_comments_number() ) ) :
			comments_template();
		endif;
	}
}

if ( ! function_exists( 'ekommart_comment' ) ) {
	/**
	 * Ekommart comment template
	 *
	 * @param array $comment the comment array.
	 * @param array $args the comment args.
	 * @param int $depth the comment depth.
	 *
	 * @since 1.0.0
	 */
	function ekommart_comment( $comment, $args, $depth ) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
        <<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-body">
        <div class="comment-meta commentmetadata">
            <div class="comment-author vcard">
				<?php echo get_avatar( $comment, 128 ); ?>
				<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
            </div>
			<?php if ( '0' === $comment->comment_approved ) : ?>
                <em class="comment-awaiting-moderation"><?php esc_attr_e( 'Your comment is awaiting moderation.', 'ekommart' ); ?></em>
                <br/>
			<?php endif; ?>

            <a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>" class="comment-date">
				<?php echo '<time datetime="' . get_comment_date( 'c' ) . '">' . get_comment_date() . '</time>'; ?>
            </a>
        </div>
		<?php if ( 'div' !== $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID(); ?>" class="comment-content">
	<?php endif; ?>
        <div class="comment-text">
			<?php comment_text(); ?>
        </div>
        <div class="reply">
			<?php
			comment_reply_link(
				array_merge(
					$args, array(
						'add_below' => $add_below,
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
					)
				)
			);
			?>
			<?php edit_comment_link( esc_html__( 'Edit', 'ekommart' ), '  ', '' ); ?>
        </div>
        </div>
		<?php if ( 'div' !== $args['style'] ) : ?>
            </div>
		<?php endif; ?>
		<?php
	}
}

if ( ! function_exists( 'ekommart_footer_widgets' ) ) {
	/**
	 * Display the footer widget regions.
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function ekommart_footer_widgets() {
		$rows    = intval( apply_filters( 'ekommart_footer_widget_rows', 1 ) );
		$regions = intval( apply_filters( 'ekommart_footer_widget_columns', 5 ) );
		for ( $row = 1; $row <= $rows; $row ++ ) :

			// Defines the number of active columns in this footer row.
			for ( $region = $regions; 0 < $region; $region -- ) {
				if ( is_active_sidebar( 'footer-' . esc_attr( $region + $regions * ( $row - 1 ) ) ) ) {
					$columns = $region;
					break;
				}
			}

			if ( isset( $columns ) ) :
				?>
                <div class="col-full">
                    <div class=<?php echo '"footer-widgets row-' . esc_attr( $row ) . ' col-' . esc_attr( $columns ) . ' fix"'; ?>>
						<?php
						for ( $column = 1; $column <= $columns; $column ++ ) :
							$footer_n = $column + $regions * ( $row - 1 );

							if ( is_active_sidebar( 'footer-' . esc_attr( $footer_n ) ) ) :
								?>
                                <div class="block footer-widget-<?php echo esc_attr( $column ); ?>">
									<?php dynamic_sidebar( 'footer-' . esc_attr( $footer_n ) ); ?>
                                </div>
							<?php
							endif;
						endfor;
						?>
                    </div><!-- .footer-widgets.row-<?php echo esc_attr( $row ); ?> -->
                </div>
				<?php
				unset( $columns );
			endif;
		endfor;
	}
}

if ( ! function_exists( 'ekommart_credit' ) ) {
	/**
	 * Display the theme credit
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function ekommart_credit() {
		?>
        <div class="site-info">
			<?php echo apply_filters( 'ekommart_copyright_text', $content = esc_html__( 'Coppyright', 'ekommart' ) . ' &copy; ' . date( 'Y' ) . ' ' . '<a class="site-url" href="' . site_url() . '">' . get_bloginfo( 'name' ) . '</a>' . esc_html__( '. All Rights Reserved.', 'ekommart' ) ); ?>
        </div><!-- .site-info -->
		<?php
	}
}

if ( ! function_exists( 'ekommart_social' ) ) {
	function ekommart_social() {
		$social_list = ekommart_get_theme_option( 'social_text', [] );
		if ( count( $social_list ) < 0 ) {
			return;
		}
		?>
        <div class="ekommart-social">
            <ul>
				<?php

				foreach ( $social_list as $social_item ) {
					?>
                    <li><a href="<?php echo esc_url( $social_item ); ?>"></a></li>
					<?php
				}
				?>

            </ul>
        </div>
		<?php
	}
}

if ( ! function_exists( 'ekommart_site_welcome' ) ) {
	/**
	 * Site branding wrapper and display
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function ekommart_site_welcome() {
		?>
        <div class="site-welcome">
			<?php
			echo ekommart_get_theme_option( 'welcome-message', 'Welcome to our online store!' );
			?>
        </div>
		<?php
	}
}

if ( ! function_exists( 'ekommart_site_branding' ) ) {
	/**
	 * Site branding wrapper and display
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function ekommart_site_branding() {
		?>
        <div class="site-branding">
			<?php echo ekommart_site_title_or_logo(); ?>
        </div>
		<?php
	}
}

if ( ! function_exists( 'ekommart_site_title_or_logo' ) ) {
	/**
	 * Display the site title or logo
	 *
	 * @param bool $echo Echo the string or return it.
	 *
	 * @return string
	 * @since 2.1.0
	 */
	function ekommart_site_title_or_logo() {
		$logo       = ekommart_get_theme_option( 'site_mode' ) == 'light' ? ekommart_get_theme_option( 'logo_light', [ 'url' => '' ] ) : ekommart_get_theme_option( 'logo_dark', [ 'url' => '' ] );
		$logo_light = ekommart_get_theme_option( 'logo_light', [ 'url' => '' ] );
		$logo_dark  = ekommart_get_theme_option( 'logo_dark', [ 'url' => '' ] );
		if ( $logo['url'] ) {
			$logo = sprintf(
				'<a href="%1$s" class="custom-logo-link" rel="home"><img src="%2$s" class="logo-light" alt="Logo"/><img src="%3$s" class="logo-dark" alt="Logo"/></a>',
				esc_url( home_url( '/' ) ),
				esc_url( $logo_light['url'] ),
				esc_url( $logo_dark['url'] )
			);;
			$html = is_home() ? '<h1 class="logo">' . $logo . '</h1>' : $logo;
		} else {
			$tag = is_home() ? 'h1' : 'div';

			$html = '<' . esc_attr( $tag ) . ' class="beta site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></' . esc_attr( $tag ) . '>';

			if ( '' !== get_bloginfo( 'description' ) ) {
				$html .= '<p class="site-description">' . esc_html( get_bloginfo( 'description', 'display' ) ) . '</p>';
			}
		}

		return $html;
	}
}

if ( ! function_exists( 'ekommart_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function ekommart_primary_navigation() {
		?>
        <nav class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'ekommart' ); ?>">
			<?php
			$args = apply_filters( 'ekommart_nav_menu_args', [
				'fallback_cb'     => '__return_empty_string',
				'theme_location'  => 'primary',
				'container_class' => 'primary-navigation',
			] );
			wp_nav_menu( $args );
			?>
        </nav>
		<?php
	}
}

if ( ! function_exists( 'ekommart_mobile_navigation' ) ) {
	/**
	 * Display Handheld Navigation
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function ekommart_mobile_navigation() {
		?>
        <nav class="mobile-navigation" aria-label="<?php esc_html_e( 'Mobile Navigation', 'ekommart' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'handheld',
					'container_class' => 'handheld-navigation',
				)
			);
			?>
        </nav>
		<?php
	}
}

if ( ! function_exists( 'ekommart_vertical_navigation' ) ) {
	/**
	 * Display Vertical Navigation
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function ekommart_vertical_navigation() {

		if ( isset( get_nav_menu_locations()['vertical'] ) ) {
			$string = get_term( get_nav_menu_locations()['vertical'], 'nav_menu' )->name;
			?>
            <nav class="vertical-navigation" aria-label="<?php esc_html_e( 'Vertiacl Navigation', 'ekommart' ); ?>">
                <div class="vertical-navigation-header">
                    <i class="ekommart-icon-bars"></i>
                    <span class="vertical-navigation-title"><?php echo esc_html( $string ); ?></span>
                </div>
				<?php

				$args = apply_filters( 'ekommart_nav_menu_args', [
					'fallback_cb'     => '__return_empty_string',
					'theme_location'  => 'vertical',
					'container_class' => 'vertical-menu',
				] );

				wp_nav_menu( $args );
				?>
            </nav>
			<?php
		}
	}
}

if ( ! function_exists( 'ekommart_homepage_header' ) ) {
	/**
	 * Display the page header without the featured image
	 *
	 * @since 1.0.0
	 */
	function ekommart_homepage_header() {
		edit_post_link( esc_html__( 'Edit this section', 'ekommart' ), '', '', '', 'button ekommart-hero__button-edit' );
		?>
        <header class="entry-header">
			<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
			?>
        </header><!-- .entry-header -->
		<?php
	}
}

if ( ! function_exists( 'ekommart_page_header' ) ) {
	/**
	 * Display the page header
	 *
	 * @since 1.0.0
	 */
	function ekommart_page_header() {

		if ( ekommart_is_woocommerce_activated() || ekommart_is_bcn_nav_activated() ) {
			return;
		}

		if ( is_front_page() && is_page_template( 'template-fullwidth.php' ) ) {
			return;
		}

		?>
        <header class="entry-header">
			<?php
			ekommart_post_thumbnail( 'full' );
			the_title( '<h1 class="entry-title">', '</h1>' );
			?>
        </header><!-- .entry-header -->
		<?php
	}
}

if ( ! function_exists( 'ekommart_page_content' ) ) {
	/**
	 * Display the post content
	 *
	 * @since 1.0.0
	 */
	function ekommart_page_content() {
		?>
        <div class="entry-content">
			<?php the_content(); ?>
			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ekommart' ),
					'after'  => '</div>',
				)
			);
			?>
        </div><!-- .entry-content -->
		<?php
	}
}

if ( ! function_exists( 'ekommart_breadcrumb_header' ) ) {
	/**
	 * Display the breadcrumb header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function ekommart_get_breadcrumb_header() {
		ob_start();

		if ( is_page() || is_single() ) {
			the_title( '<h1 class="breadcrumb-heading">', '</h1>' );
		} elseif ( is_archive() ) {
			if ( ekommart_is_woocommerce_activated() ) {
				echo '<h1 class="breadcrumb-heading"> ' . woocommerce_page_title( false ) . '</h1>';
			} else {
				the_archive_title( '<h1 class="breadcrumb-heading">', '</h1>' );
			}
		}

		return ob_get_clean();
	}
}

if ( ! function_exists( 'ekommart_post_header' ) ) {
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function ekommart_post_header() {
		?>
        <header class="entry-header">
			<?php

			/**
			 * Functions hooked in to ekommart_post_header_before action.
			 */
			do_action( 'ekommart_post_header_before' );
			?>
            <div class="entry-meta">
				<?php
				ekommart_categories_link();
				ekommart_post_meta();
				?>
            </div>
			<?php
			if ( is_single() ) {
				if ( ! ( ekommart_is_bcn_nav_activated() || ekommart_is_woocommerce_activated() ) ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				}
			} else {
				the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			}

			do_action( 'ekommart_post_header_after' );
			?>
        </header><!-- .entry-header -->
		<?php
	}
}

if ( ! function_exists( 'ekommart_post_content' ) ) {
	/**
	 * Display the post content with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function ekommart_post_content() {
		?>
        <div class="entry-content">
			<?php

			/**
			 * Functions hooked in to ekommart_post_content_before action.
			 *
			 */
			do_action( 'ekommart_post_content_before' );


			the_content(
				sprintf(
				/* translators: %s: post title */
					__( 'Read More %s', 'ekommart' ),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				)
			);

			/**
			 * Functions hooked in to ekommart_post_content_after action.
			 *
			 */
			do_action( 'ekommart_post_content_after' );

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ekommart' ),
					'after'  => '</div>',
				)
			);
			?>
        </div><!-- .entry-content -->
		<?php
	}
}

if ( ! function_exists( 'ekommart_post_meta' ) ) {
	/**
	 * Display the post meta
	 *
	 * @since 1.0.0
	 */
	function ekommart_post_meta() {
		if ( 'post' !== get_post_type() ) {
			return;
		}

		// Posted on.
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<span class="posted-on">' . sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>', esc_url( get_permalink() ), $time_string ) . '</span>';

		// Author.
		$author = sprintf(
			'<span class="post-author">%1$s <a href="%2$s" class="url fn" rel="author">%3$s</a></span>',
			__( 'by', 'ekommart' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);


		echo wp_kses(
			sprintf( '%1$s %2$s', $posted_on, $author ), array(
				'span' => array(
					'class' => array(),
				),
				'a'    => array(
					'href'  => array(),
					'title' => array(),
					'rel'   => array(),
				),
				'time' => array(
					'datetime' => array(),
					'class'    => array(),
				),
			)
		);
	}
}

if ( ! function_exists( 'ekommart_edit_post_link' ) ) {
	/**
	 * Display the edit link
	 *
	 * @since 2.5.0
	 */
	function ekommart_edit_post_link() {
		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'ekommart' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<div class="edit-link">',
			'</div>'
		);
	}
}

if ( ! function_exists( 'ekommart_categories_link' ) ) {
	/**
	 * Prints HTML with meta information for the current cateogries
	 */
	function ekommart_categories_link() {

		// Get Categories for posts.
		$categories_list = get_the_category_list( ', ' );

		if ( 'post' === get_post_type() && $categories_list ) {
			// Make sure there's more than one category before displaying.
			echo '<span class="categories-link"><span class="screen-reader-text">' . esc_html__( 'Categories', 'ekommart' ) . '</span>' . $categories_list . '</span>';
		}
	}
}

if ( ! function_exists( 'ekommart_post_taxonomy' ) ) {
	/**
	 * Display the post taxonomies
	 *
	 * @since 2.4.0
	 */
	function ekommart_post_taxonomy() {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list(__(', ', 'ekommart'));

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list('', __(', ', 'ekommart'));
		?>
        <aside class="entry-taxonomy">
			<?php if ( $categories_list ) : ?>
                <div class="cat-links">
                    <strong><?php echo esc_html( _n( 'Category:', 'Categories:', count( get_the_category() ), 'ekommart' ) ); ?></strong><?php echo get_the_category_list( esc_html__( ', ', 'ekommart' ) ); ?>
                </div>
			<?php endif; ?>

			<?php if ( $tags_list ) : ?>
                <div class="tags-links">
                    <strong><?php echo esc_html( _n( 'Tag:', 'Tags:', count( get_the_tags() ), 'ekommart' ) ); ?></strong><?php echo get_the_tag_list( '', esc_html__( ', ', 'ekommart' ) ); ?>
                </div>
			<?php endif; ?>
        </aside>

		<?php
	}
}

if ( ! function_exists( 'ekommart_paging_nav' ) ) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function ekommart_paging_nav() {
		global $wp_query;

		$args = array(
			'type'      => 'list',
			'next_text' => _x( 'Next', 'Next post', 'ekommart' ),
			'prev_text' => _x( 'Previous', 'Previous post', 'ekommart' ),
		);

		the_posts_pagination( $args );
	}
}

if ( ! function_exists( 'ekommart_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function ekommart_post_nav() {
		$args = array(
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'ekommart' ) . ' </span>%title',
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'ekommart' ) . ' </span>%title',
		);
		the_post_navigation( $args );
	}
}

if ( ! function_exists( 'ekommart_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @deprecated 2.4.0
	 */
	function ekommart_posted_on() {
		_deprecated_function( 'ekommart_posted_on', '2.4.0' );
	}
}

if ( ! function_exists( 'ekommart_homepage_content' ) ) {
	/**
	 * Display homepage content
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @return  void
	 * @since  1.0.0
	 */
	function ekommart_homepage_content() {
		while ( have_posts() ) {
			the_post();

			get_template_part( 'content', 'homepage' );

		} // end of the loop.
	}
}

if ( ! function_exists( 'ekommart_social_icons' ) ) {
	/**
	 * Display social icons
	 * If the subscribe and connect plugin is active, display the icons.
	 *
	 * @link http://wordpress.org/plugins/subscribe-and-connect/
	 * @since 1.0.0
	 */
	function ekommart_social_icons() {
		if ( class_exists( 'Subscribe_And_Connect' ) ) {
			echo '<div class="subscribe-and-connect-connect">';
			subscribe_and_connect_connect();
			echo '</div>';
		}
	}
}

if ( ! function_exists( 'ekommart_get_sidebar' ) ) {
	/**
	 * Display ekommart sidebar
	 *
	 * @uses get_sidebar()
	 * @since 1.0.0
	 */
	function ekommart_get_sidebar() {
		get_sidebar();
	}
}

if ( ! function_exists( 'ekommart_post_thumbnail' ) ) {
	/**
	 * Display post thumbnail
	 *
	 * @param string $size the post thumbnail size.
	 *
	 * @uses has_post_thumbnail()
	 * @uses the_post_thumbnail
	 * @var $size thumbnail size. thumbnail|medium|large|full|$custom
	 * @since 1.5.0
	 */
	function ekommart_post_thumbnail( $size = 'post-thumbnail' ) {
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( $size ? $size : 'post-thumbnail' );
		}
	}
}

if ( ! function_exists( 'ekommart_primary_navigation_wrapper' ) ) {
	/**
	 * The primary navigation wrapper
	 */
	function ekommart_primary_navigation_wrapper() {
		echo '<div class="ekommart-primary-navigation"><div class="col-full">';
	}
}

if ( ! function_exists( 'ekommart_primary_navigation_wrapper_close' ) ) {
	/**
	 * The primary navigation wrapper close
	 */
	function ekommart_primary_navigation_wrapper_close() {
		echo '</div></div>';
	}
}

if ( ! function_exists( 'ekommart_header_container' ) ) {
	/**
	 * The header container
	 */
	function ekommart_header_container() {
		echo '<div class="col-full">';
	}
}

if ( ! function_exists( 'ekommart_header_container_close' ) ) {
	/**
	 * The header container close
	 */
	function ekommart_header_container_close() {
		echo '</div>';
	}
}


if ( ! function_exists( 'ekommart_breadcrumb' ) ) {
	function ekommart_breadcrumb() {
		if ( ! is_page_template( 'template-homepage.php' ) ) {
			get_template_part( 'template-parts/breadcrumb' );
		}
	}
}

if ( ! function_exists( 'ekommart_header_contact_info' ) ) {
	function ekommart_header_contact_info() {
		echo ekommart_get_theme_option( 'contact-info', '' );
	}

}

if ( ! function_exists( 'ekommart_header_account' ) ) {
	function ekommart_header_account() {

		if ( ! ekommart_get_theme_option( 'show-header-account', true ) ) {
			return;
		}

		if ( ekommart_is_woocommerce_activated() ) {
			$account_link = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
		} else {
			$account_link = wp_login_url();
		}
		?>
        <div class="site-header-account">
            <a href="<?php echo esc_html( $account_link ); ?>"><i class="ekommart-icon-user"></i></a>
            <div class="account-dropdown">

            </div>
        </div>
		<?php
	}
}

if ( ! function_exists( 'ekommart_template_account_dropdown' ) ) {
	function ekommart_template_account_dropdown() {
		if ( ! ekommart_get_theme_option( 'show-header-account', true ) ) {
			return;
		}
		?>
        <div class="account-wrap" style="display: none;">
            <div class="account-inner <?php if ( is_user_logged_in() ): echo "dashboard"; endif; ?>">
				<?php if ( ! is_user_logged_in() ) {
					ekommart_form_login();
				} else {
					ekommart_account_dropdown();
				}
				?>
            </div>
        </div>
		<?php
	}
}

if ( ! function_exists( 'ekommart_form_login' ) ) {
	function ekommart_form_login() { ?>

        <div class="login-form-head">
            <span class="login-form-title"><?php esc_attr_e( 'Sign in', 'ekommart' ) ?></span>
            <span class="pull-right">
                <a class="register-link" href="<?php echo esc_url( wp_registration_url() ); ?>"
                   title="<?php esc_attr_e( 'Register', 'ekommart' ); ?>"><?php esc_attr_e( 'Create an Account', 'ekommart' ); ?></a>
            </span>
        </div>
        <form class="ekommart-login-form-ajax" data-toggle="validator">
            <p>
                <label><?php esc_attr_e( 'Username or email', 'ekommart' ); ?> <span class="required">*</span></label>
                <input name="username" type="text" required placeholder="<?php esc_attr_e( 'Username', 'ekommart' ) ?>">
            </p>
            <p>
                <label><?php esc_attr_e( 'Password', 'ekommart' ); ?> <span class="required">*</span></label>
                <input name="password" type="password" required placeholder="<?php esc_attr_e( 'Password', 'ekommart' ) ?>">
            </p>
            <button type="submit" data-button-action class="btn btn-primary btn-block w-100 mt-1"><?php esc_html_e( 'Login', 'ekommart' ) ?></button>
            <input type="hidden" name="action" value="ekommart_login">
			<?php wp_nonce_field( 'ajax-ekommart-login-nonce', 'security-login' ); ?>
        </form>
        <div class="login-form-bottom">
            <a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" class="lostpass-link" title="<?php esc_attr_e( 'Lost your password?', 'ekommart' ); ?>"><?php esc_attr_e( 'Lost your password?', 'ekommart' ); ?></a>
        </div>
		<?php
	}
}

if ( ! function_exists( '' ) ) {
	function ekommart_account_dropdown() { ?>
		<?php if ( has_nav_menu( 'my-account' ) ) : ?>
            <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Dashboard', 'ekommart' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'my-account',
					'menu_class'     => 'account-links-menu',
					'depth'          => 1,
				) );
				?>
            </nav><!-- .social-navigation -->
		<?php else: ?>
            <ul class="account-dashboard">

				<?php if ( ekommart_is_woocommerce_activated() ): ?>
                    <li>
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" title="<?php esc_html_e( 'Dashboard', 'ekommart' ); ?>"><?php esc_html_e( 'Dashboard', 'ekommart' ); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>" title="<?php esc_html_e( 'Orders', 'ekommart' ); ?>"><?php esc_html_e( 'Orders', 'ekommart' ); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'downloads' ) ); ?>" title="<?php esc_html_e( 'Downloads', 'ekommart' ); ?>"><?php esc_html_e( 'Downloads', 'ekommart' ); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>" title="<?php esc_html_e( 'Edit Address', 'ekommart' ); ?>"><?php esc_html_e( 'Edit Address', 'ekommart' ); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>" title="<?php esc_html_e( 'Account Details', 'ekommart' ); ?>"><?php esc_html_e( 'Account Details', 'ekommart' ); ?></a>
                    </li>
				<?php else: ?>
                    <li>
                        <a href="<?php echo esc_url( get_dashboard_url( get_current_user_id() ) ); ?>" title="<?php esc_html_e( 'Dashboard', 'ekommart' ); ?>"><?php esc_html_e( 'Dashboard', 'ekommart' ); ?></a>
                    </li>
				<?php endif; ?>
                <li>
                    <a title="<?php esc_html_e( 'Log out', 'ekommart' ); ?>" class="tips" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>"><?php esc_html_e( 'Log Out', 'ekommart' ); ?></a>
                </li>
            </ul>
		<?php endif;

	}
}

if ( ! function_exists( 'ekommart_header_search_popup' ) ) {
	function ekommart_header_search_popup() {
		?>
        <div class="site-search-popup">
            <div class="site-search-popup-wrap">
                <a href="#" class="site-search-popup-close"><i class="ekommart-icon-times-circle"></i></a>
				<?php
				if ( ekommart_is_woocommerce_activated() ) {
					ekommart_product_search();
				} else {
					?>
                    <div class="site-search">
						<?php get_search_form(); ?>
                    </div>
					<?php
				}
				?>
            </div>
        </div>
		<?php
	}
}

if ( ! function_exists( 'ekommart_header_search_button' ) ) {
	function ekommart_header_search_button() {
		if ( ! ekommart_get_theme_option( 'show-header-search', true ) ) {
			return;
		}

		add_action( 'wp_footer', 'ekommart_header_search_popup', 1 );
		wp_enqueue_script( 'ekommart-search-popup' );
		?>
        <div class="site-header-search">
            <a href="#" class="button-search-popup"><i class="ekommart-icon-search"></i></a>
        </div>
		<?php
	}
}


if ( ! function_exists( 'ekommart_header_sticky' ) ) {
	function ekommart_header_sticky() {
		get_template_part( 'template-parts/header', 'sticky' );
	}
}

if ( ! function_exists( 'ekommart_mobile_nav' ) ) {
	function ekommart_mobile_nav() {
		if ( isset( get_nav_menu_locations()['handheld'] ) ) {
			?>
            <div class="ekommart-mobile-nav">
                <a href="#" class="mobile-nav-close"><i class="ekommart-icon-times"></i></a>
				<?php
				ekommart_language_switcher_mobile();
				ekommart_mobile_navigation();
				ekommart_social();
				?>
            </div>
            <div class="ekommart-overlay"></div>
			<?php
		}
	}
}

if ( ! function_exists( 'ekommart_mobile_nav_button' ) ) {
	function ekommart_mobile_nav_button() {
		if ( isset( get_nav_menu_locations()['handheld'] ) ) {
			wp_enqueue_script( 'ekommart-nav-mobile' );
			?>
            <a href="#" class="menu-mobile-nav-button">
                <span class="toggle-text screen-reader-text"><?php echo esc_attr( apply_filters( 'ekommart_menu_toggle_text', esc_html__( 'Menu', 'ekommart' ) ) ); ?></span>
                <i class="ekommart-icon-bars"></i>
            </a>
			<?php
		}
	}
}

if ( ! function_exists( 'ekommart_language_switcher' ) ) {
	function ekommart_language_switcher() {
		$languages = apply_filters( 'wpml_active_languages', [] );
		if ( ! ekommart_is_wpml_activated() || count( $languages ) <= 0 ) {
			return;
		}
		?>
        <div class="ekommart-language-switcher">
            <ul class="menu">
                <li class="item">
					<span>
						<img width="18" height="12" src="<?php echo esc_url( $languages[ ICL_LANGUAGE_CODE ]['country_flag_url'] ) ?>" alt="<?php esc_attr( $languages[ ICL_LANGUAGE_CODE ]['default_locale'] ) ?>">
						<?php
						echo esc_html( $languages[ ICL_LANGUAGE_CODE ]['translated_name'] );
						?>
					</span>
                    <ul class="sub-item">
						<?php
						foreach ( $languages as $key => $language ) {
							if ( ICL_LANGUAGE_CODE === $key ) {
								continue;
							}
							?>
                            <li>
                                <a href="<?php echo esc_url( $language['url'] ) ?>">
                                    <img width="18" height="12" src="<?php echo esc_url( $language['country_flag_url'] ) ?>" alt="<?php esc_attr( $language['default_locale'] ) ?>">
									<?php echo esc_html( $language['translated_name'] ); ?>
                                </a>
                            </li>
							<?php
						}
						?>
                    </ul>
                </li>
            </ul>
        </div>
		<?php
	}
}

if ( ! function_exists( 'ekommart_language_switcher_mobile' ) ) {
	function ekommart_language_switcher_mobile() {
		$languages = apply_filters( 'wpml_active_languages', [] );
		if ( ! ekommart_is_wpml_activated() || count( $languages ) <= 0 ) {
			return;
		}
		?>
        <div class="ekommart-language-switcher-mobile">
            <span>
                <img width="18" height="12" src="<?php echo esc_url( $languages[ ICL_LANGUAGE_CODE ]['country_flag_url'] ) ?>" alt="<?php esc_attr( $languages[ ICL_LANGUAGE_CODE ]['default_locale'] ) ?>">
            </span>
			<?php
			foreach ( $languages as $key => $language ) {
				if ( ICL_LANGUAGE_CODE === $key ) {
					continue;
				}
				?>
                <a href="<?php echo esc_url( $language['url'] ) ?>">
                    <img width="18" height="12" src="<?php echo esc_url( $language['country_flag_url'] ) ?>" alt="<?php esc_attr( $language['default_locale'] ) ?>">
                </a>
				<?php
			}
			?>
        </div>
		<?php
	}
}

if ( ! function_exists( 'ekommart_deal_topbar' ) ) {
	function ekommart_deal_topbar() {

		$cookie = isset( $_COOKIE['deal-topbar-hide'] ) ? $_COOKIE['deal-topbar-hide'] : true;

		if ( ( ekommart_get_theme_option( 'show-deal-topbar', true ) == true ) && ( $cookie !== 'false' ) ) {
			$deal_link      = ekommart_get_theme_option( 'deal-topbar-button-link', '#' );
			$deal_link_text = ekommart_get_theme_option( 'deal-topbar-time-text', 'Learn More' );
			$date           = ekommart_get_theme_option( 'deal-topbar-time' );
			$data_date      = 0;
			if ( $date ) {
				$data_date = strtotime( $date );
			}
			if ( $data_date != 0 && $data_date > current_time('timestamp')) {

				wp_enqueue_script( 'ekommart-countdown' );
				wp_enqueue_script( 'ekommart-deal-topbar' );

				?>
                <div class="ekommart-deal-topbar desktop-hide-down" style="display: none;">
                    <div class="deal-topbar-wrap">
                        <div class="deal-topbar-text"><?php echo ekommart_get_theme_option( 'deal-topbar-header', 'Black Friday. <strong>Save up to 50%!</strong>' ); ?></div>
                        <div class="deal-topbar-time">
                            <div class="deal-time-label"><?php echo esc_html( ekommart_get_theme_option( 'deal-topbar-countdown-text', 'Deal Ends:' ) ); ?></div>
                            <div class="deal-time-count" data-countdown="true" data-date="<?php echo esc_html( $data_date ); ?>">
                                <div class="countdown-item">
                                    <span class="countdown-digits countdown-days">00</span>
                                    <span class="countdown-label"><?php echo esc_html__( 'D', 'ekommart' ) ?></span>
                                </div>
                                <div class="countdown-item">
                                    <span class="countdown-digits countdown-hours">00</span>
                                    <span class="countdown-label"><?php echo esc_html__( 'H', 'ekommart' ) ?></span>
                                </div>
                                <div class="countdown-item">
                                    <span class="countdown-digits countdown-minutes">00</span>
                                    <span class="countdown-label"><?php echo esc_html__( 'M', 'ekommart' ) ?></span>
                                </div>
                                <div class="countdown-item">
                                    <span class="countdown-digits countdown-seconds">00</span>
                                    <span class="countdown-label"><?php echo esc_html__( 'S', 'ekommart' ) ?></span>
                                </div>
                            </div>
                        </div>
						<?php if ( $deal_link !== '' ): ?>
                            <div class="deal-topbar-button">
                                <a class="deal-button" href="<?php echo esc_url( $deal_link ); ?>"><?php echo esc_html( $deal_link_text ); ?></a>
                            </div>
						<?php endif; ?>
                    </div>
                    <a class="deal-topbar-close" title="close" href="#"><i class="ekommart-icon-times-circle"></i></a>
                </div>
				<?php
			}
		}
	}
}

if ( ! function_exists( 'ekommart_footer_default' ) ) {
	function ekommart_footer_default() {
		ekommart_footer_widgets();
		get_template_part( 'template-parts/copyright' );
	}
}


if ( ! function_exists( 'ekommart_social_share' ) ) {
	function ekommart_social_share() {
		get_template_part( 'template-parts/socials' );
	}
}

