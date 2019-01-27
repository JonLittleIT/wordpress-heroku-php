<?php
//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////
/**
 * Enqueues front-end CSS for the page Font.
 *
 * @since nanoagency
 *
 * @see wp_add_inline_style()
 */
add_action( 'wp_enqueue_scripts', 'bitther_font_google');
function bitther_font_google()
{
    $font_family = get_theme_mod('bitther_body_font_google', 'Roboto');
    if ($font_family != 'Poppins') {
        $query_args = array(
            'family' => urlencode($font_family),
            'subset' => urlencode('latin,latin-ext'),
        );
        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
        $bitther_google_font = esc_url_raw($fonts_url);
        wp_enqueue_style('bitther-fonts-customize', $bitther_google_font, array(), null);
    }
}

function bitther_title_font_google() {
    $font_title_font         = 'Poppins';
    $font_title   = get_theme_mod('bitther_title_font_google',$font_title_font);

    // Don't do anything if the current color is the default.
    if ( $font_title === $font_title_font ) {
        return;
    }

    $css = '
		/* Custom  Font size */
		.entry-title,.widgettitle,.title-left{
            font-family: %1$s;
		}
	';

    wp_add_inline_style( 'bitther-css', sprintf( $css, $font_title ) );
}
add_action( 'wp_enqueue_scripts', 'bitther_title_font_google', 109 );

function bitther_menu_font_google() {
    $font_menu_font         = 'Poppins';
    $font_menu   = get_theme_mod('bitther_menu_font_google',$font_menu_font);

    // Don't do anything if the current color is the default.
    if ( $font_menu === $font_menu_font ) {
        return;
    }

    $css = '
		/* Custom  Font size */
		#na-menu-primary ul > li > a{
            font-family: %1$s;
		}
	';

    wp_add_inline_style( 'bitther-css', sprintf( $css, $font_menu ) );
}
add_action( 'wp_enqueue_scripts', 'bitther_menu_font_google', 10 );

function bitther_body_font_family() {
    $default_font         = 'Poppins';
    $font_family   = get_theme_mod('bitther_body_font_google',$default_font);

    // Don't do anything if the current color is the default.
    if ( $font_family === $default_font ) {
        return;
    }

    $css = '
		/* Custom  Font size */
		body {
            font-family: %1$s;
		}
	';

    wp_add_inline_style( 'bitther-css', sprintf( $css, $font_family ) );
}
add_action( 'wp_enqueue_scripts', 'bitther_body_font_family', 11 );

	function bitther_main_font_family() {
		$default_font         = 'Poppins';
		$font_family   = get_theme_mod('bitther_main_font_family',$default_font);

		// Don't do anything if the current color is the default.
		if ( $font_family === $default_font ) {
			return;
		}

		$css = '
			/* Custom  Font size */
			body {
				font-family: %1$s;
			}
		';

		wp_add_inline_style( 'bitther-css-poppin', sprintf( $css, $font_family ) );
	}
add_action( 'wp_enqueue_scripts', 'bitther_main_font_family', 100 );



function bitther_body_font_size() {
    $default_font         = '14';
    $bitther_body_font_size   = get_theme_mod('bitther_body_font_size',$default_font);
    // Don't do anything if the current color is the default.
    if ( $bitther_body_font_size === $default_font ) {
        return;
    }

    $css = '
		/* Custom  Font size */
		body ,.entry-content {
            font-size: %1$spx;
		}
	';

    wp_add_inline_style( 'bitther-css', sprintf( $css, $bitther_body_font_size ) );
}
add_action( 'wp_enqueue_scripts', 'bitther_body_font_size', 12 );

function bitther_menu_font_size() {
    $default_font         = '14';
    $bitther_menu_font_size   = get_theme_mod('bitther_menu_font_size',$default_font);
    // Don't do anything if the current color is the default.
    if ( $bitther_menu_font_size === $default_font ) {
        return;
    }

    $css = '
		/* Custom  Font size */
		#na-menu-primary .na-menu > li a {
            font-size: %1$spx;
		}
	';

    wp_add_inline_style( 'bitther-css', sprintf( $css, $bitther_menu_font_size ) );
}
add_action( 'wp_enqueue_scripts', 'bitther_menu_font_size', 13 );

function bitther_color_footer() {
    $default         = '';
    $bitther_color_footer       = get_theme_mod('bitther_color_footer',$default);

    // Don't do anything if the current color is the default.
    if ( $bitther_color_footer === $default ) {
        return;
    }

    $css = '
		/* Custom  color title  */
        #na-footer .widgettitle,#na-footer ul li,#na-footer ul li a,#na-footer ul li b,[class*="ion-social-"],#na-footer,#na-footer .footer-bottom .coppy-right a
		{
		    color:%1$s;
		}
		[class*="ion-social-"]{
		    border-color:%1$s;
		}

	';

    wp_add_inline_style( 'bitther-css', sprintf( $css, $bitther_color_footer ) );
}
add_action( 'wp_enqueue_scripts', 'bitther_color_footer', 23 );

function bitther_bg_footer() {
    $default         = '';
    $bitther_bg_footer       = get_theme_mod('bitther_bg_footer',$default);

    // Don't do anything if the current color is the default.
    if ( $bitther_bg_footer === $default ) {
        return;
    }

    $css = '
		/* Custom  color title  */
        #na-footer,#na-footer .footer-bottom,#na-footer .footer-center
		{
		    background:%1$s;
		}

	';

    wp_add_inline_style( 'bitther-css', sprintf( $css, $bitther_bg_footer ) );
}
add_action( 'wp_enqueue_scripts', 'bitther_bg_footer', 24 );

function bitther_color_topbar() {
    $default         = '';
    $bitther_color_topbar       = get_theme_mod('bitther_color_topbar',$default);

    // Don't do anything if the current color is the default.
    if ( $bitther_color_topbar === $default ) {
        return;
    }

    $css = '
		/* Custom  color title  */
        .wrap-select-currency::after,
        .wrap-select-country::after,
        #bitther-top-navbar,
        #bitther-top-navbar .topbar-left a,
        #bitther-top-navbar a,
        .currency_switcher .woocommerce-currency-switcher-form .dd-selected-text,
        .currency_switcher .woocommerce-currency-switcher-form .dd-option-text
		{
		    color:%1$s;
		}

	';

    wp_add_inline_style( 'bitther-css', sprintf( $css, $bitther_color_topbar ) );
}
add_action( 'wp_enqueue_scripts', 'bitther_color_topbar', 25 );

function bitther_bg_topbar() {
    $default         = '';
    $bitther_bg_topbar       = get_theme_mod('bitther_bg_topbar',$default);

    // Don't do anything if the current color is the default.
    if ( $bitther_bg_topbar === $default ) {
        return;
    }

    $css = '
		/* Custom  color title  */
		#bitther-top-navbar{
		    background:%1$s;
		}

	';

    wp_add_inline_style( 'bitther-css', sprintf( $css, $bitther_bg_topbar ) );
}
add_action( 'wp_enqueue_scripts', 'bitther_bg_topbar', 25 );

function bitther_bg_header() {
    $default         = '';
    $bitther_bg_header       = get_theme_mod('bitther_bg_header',$default);

    // Don't do anything if the current color is the default.
    if ( $bitther_bg_header === $default ) {
        return;
    }

    $css = '
		/* Custom  color title  */
		#bitther-header,.header-drawer #bitther-header,.header-content-menu{
		    background:%1$s;
		}

	';

    wp_add_inline_style( 'bitther-css', sprintf( $css, $bitther_bg_header ) );
}
add_action( 'wp_enqueue_scripts', 'bitther_bg_header', 26 );

function bitther_color_menu() {
    $default         = '';
    $bitther_color_menu       = get_theme_mod('bitther_color_menu',$default);

    // Don't do anything if the current color is the default.
    if ( $bitther_color_menu === $default ) {
        return;
    }

    $css = '
		/* Custom  color title  */
		.menu-drawer #na-menu-primary ul.mega-menu > li > a,
		#na-menu-primary ul > li[class*="-has-children"] > a::before,
		.menu-drawer #na-menu-primary ul > li[class*="-has-children"] > a::before,
		.btn-mini-search, .na-cart .icon-cart,
		.bitther_icon-bar,
        #na-menu-primary ul.mega-menu > li > a
		{
		    color:%1$s;
		}

	';

    wp_add_inline_style( 'bitther-css', sprintf( $css, $bitther_color_menu ) );
}
add_action( 'wp_enqueue_scripts', 'bitther_color_menu', 27 );


function bitther_body_background() {
    $default         = '';
    $bitther_bg_body       = get_theme_mod('bitther_bg_body',$default);

    // Don't do anything if the current color is the default.
    if ( $bitther_bg_body === $default ) {
        return;
    }

    $css = '
		/* Custom  color title  */
		body{
		    background:%1$s;
		}

	';
    wp_add_inline_style( 'bitther-css', sprintf( $css, $bitther_bg_body ) );
}
add_action( 'wp_enqueue_scripts', 'bitther_body_background', 28 );

/**
 * Enqueues front-end CSS for the Primary  Color .
 *
 * @since bitther
 *
 * @see wp_add_inline_style()
 */

function bitther_primary_body() {
    $default         = '';
    $bitther_primary_color       = get_theme_mod('bitther_primary_body',$default);

    // Don't do anything if the current color is the default.
    if ( $bitther_primary_color === $default ) {
        return;
    }

    $css = '
        .btn-outline .badge,
        .btn-inverse,
        .btn-inverse:hover, .btn-inverse:focus, .btn-inverse:active, .btn-inverse.active,
        .open .btn-inverse.dropdown-toggle,
        .btn-inverse.disabled, .btn-inverse.disabled:hover, .btn-inverse.disabled:focus, .btn-inverse.disabled:active, .btn-inverse.disabled.active, .btn-inverse[disabled], .btn-inverse[disabled]:hover, .btn-inverse[disabled]:focus, .btn-inverse[disabled]:active, .btn-inverse[disabled].active, fieldset[disabled] .btn-inverse, fieldset[disabled] .btn-inverse:hover, fieldset[disabled] .btn-inverse:focus, fieldset[disabled] .btn-inverse:active, fieldset[disabled] .btn-inverse.active,
        .btn-varian,
        .button:hover, .button:focus, .button:active, .button.active ,
        .open .button.dropdown-toggle,
        .button.single_add_to_cart_button:hover, .button.single_add_to_cart_button:focus, .button.single_add_to_cart_button:active, .button.single_add_to_cart_button.active ,
        .page-content .vc_btn3.vc_btn3-style-custom ,
        .page-content .vc_btn3.vc_btn3-style-custom:hover, .page-content .vc_btn3.vc_btn3-style-custom:focus, .page-content .vc_btn3.vc_btn3-style-custom:active, .page-content .vc_btn3.vc_btn3-style-custom.active ,
        .add_to_cart_button .badge, .button.product_type_simple .badge ,
        .added_to_cart .badge,
        #loadmore-button:hover,
        .yith-wcwl-wishlistexistsbrowse a:after ,
        .quick-view a ,
        .btn-checkout ,
        .btn-order,
        .slick-prev:hover,
        .slick-next:hover,
        .na-cart .icon-cart .mini-cart-items,
        #cart-panel-loader > *:before,
        #calendar_wrap #today ,
        .expand-icon:hover::after, .expand-icon:hover::before,
        .bitther_icon:hover .bitther_icon-bar,
        .scrollup:hover,
        .product-image.loading::before,
        .widget_layered_nav ul li.chosen > a:before, .widget_layered_nav_filters ul li.chosen > a:before,
        .widget_layered_nav ul li a:hover:before, .widget_layered_nav_filters ul li a:hover:before,
        .onsale,
        .list-view .add_to_cart_button,
        .list-view .add_to_cart_button:hover, .list-view .add_to_cart_button:focus,
        .product-detail-wrap .product-nav .fa:hover,
        .variations_form.cart .att_label:hover, .variations_form.cart .att_label.selected,
        .blog-recent-post .na-grid .bg_gradients > a ,
        .box-list .link-more a:hover,
        .post-format .ti-control-play:hover, .post-format .ti-camera:hover, .post-format .ti-headphone:hover, .post-format .ti-quote-left:hover,
        .tags a:hover,
        div.affect-border:before, div.affect-border:after,
        div.affect-border-inner:before,
        div.affect-border-inner:after,
        .nano > .nano-pane > .nano-slider,
        .btn-primary,.btn-primary:hover,
        .entry_pagination .page-numbers:hover i,
        .btn-variant:hover, .btn-variant:focus, .btn-variant:active, .btn-variant.active,
        .post-cat a,
        .box-title::after,.widgettitle::after
        {
            background-color: %1$s;
        }

        .link:hover,
        a:hover, a:focus,
        .tags-list a:hover, .tagcloud a:hover,
        .btn-outline,
        .btn-outline:hover, .btn-outline:focus, .btn-outline:active, .btn-outline.active,
        .open .btn-outline.dropdown-toggle,
        .btn-inverse .badge,
        .btn-variant .badge,
        .add_to_cart_button, .button.product_type_simple,
        .add_to_cart_button:hover, .add_to_cart_button:focus, .add_to_cart_button:active, .add_to_cart_button.active, .button.product_type_simple:hover, .button.product_type_simple:focus, .button.product_type_simple:active, .button.product_type_simple.active,
        .open .add_to_cart_button.dropdown-toggle, .open .button.product_type_simple.dropdown-toggle,
        .added_to_cart,
        .added_to_cart:hover, .added_to_cart:focus, .added_to_cart:active, .added_to_cart.active,
        .open .added_to_cart.dropdown-toggle,
        .nav-tabs > li.active > a ,
        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus,
        .na-filter-wrap #na-filter .widget .na-ajax-load a:hover ,
        .na-filter-wrap .chosen,
        .na-filter-wrap .na-remove-attribute,
        .btn-mini-search:hover,
        #na-top-navbar #language-switch ul > li span:hover,
        .currency_switcher .woocommerce-currency-switcher-form .dd-selected-text:hover, .currency_switcher .woocommerce-currency-switcher-form .dd-option-text:hover,
        #cart-panel-loader > *:before,
        .cart-header .close:hover ,
        .woocommerce-tabs li.resp-tab-item.active,
        .woocommerce-tabs li.resp-tab-item.active a ,
        .woocommerce-tabs .resp-tabs-list li a:hover,
        .alert a,
        .share-links .count-share:hover ,
        .share-links .count-share i,
        #sb_instagram #sbi_load .fa, #sb_instagram .sbi_follow_btn .fa,
        .sidebar a:hover,
        .sidebar ul li.current-cat > a,
        .sidebar #recentcomments li > a,
        #na-footer .footer-bottom .coppy-right a:hover ,
        .page-cart .product-name a,
        .contact .fa,
        .woocommerce-thankyou-order-received:before,
        .woocommerce #content table.wishlist_table.cart a.remove:hover,
        #bitther-quickview .price,
        .product-image.loading::after,
        .product-image.loading::before ,
        .is-active > a,
        #bitther-top-navbar a:hover, #bitther-top-navbar a:focus ,
        #bitther-top-navbar .topbar-left a:hover,
        #na-footer ul li a:hover ,
        .widget_layered_nav ul li.chosen, .widget_layered_nav_filters ul li.chosen,
        .widget_layered_nav ul li.chosen > a, .widget_layered_nav_filters ul li.chosen > a,
        .widget_layered_nav ul li:hover .count, .widget_layered_nav_filters ul li:hover .count ,
        .widget.recent_blog .entry-title a:hover,
        .name a:hover ,
        .price,
        .price ins,
        .list-view .price,
        .product-detail-wrap .price,
        .product-detail-wrap .product_meta > * span:hover, .product-detail-wrap .product_meta > * a:hover,
        .cart .quantity .input-group-addon:hover ,
        .woocommerce-tabs #reviews .bypostauthor .comment-text .meta > strong,
        .sidebar .widget_tabs_post .widget-title li.active a,
        .sidebar .widget_tabs_post .widget-title li a:hover, .sidebar .widget_tabs_post .widget-title li a:focus, .sidebar .widget_tabs_post .widget-title li a:active ,
        .widget.about .bitther-social-icon a:hover,
        .widget-product .group-title .link-cat:hover,
        .post-list .entry-header .posted-on a:hover,
        .post-list .author strong:hover,
        .box-list .name-category,
        .box-list .name-category > a,
        .post-cat ,
        .entry-title > a:hover,
        .entry-avatar .author-title,
        .entry-avatar .author-link,
        .post-comment .fa,
        #comments .text-user > a,
        .post-related .author-link:hover,
        .item-related .post-title > a:hover ,
        .entry_pagination .pagination .fa,
        .entry_pagination .pagination .page-numbers:hover .fa ,
        .entry_pagination .page-numbers i,
        .entry_pagination .page-numbers:hover ,
        .entry_pagination .page-numbers .btn-prev,
        .entry_pagination .page-numbers .btn-next,
        .entry-content a,
        .pagination .current,.post-list .article-meta a:hover,.pagination .nav-links a:hover,
        .post-grid .article-meta a:hover,
        #na-menu-primary ul > li.current-menu-item:hover > a, #na-menu-primary ul > li.current-menu-item:focus > a,
        #na-menu-primary ul > li.current-menu-item > a,
        #na-menu-primary ul > li > a:hover, #na-menu-primary ul > li > a:focus,
        #na-menu-primary ul > li.current-menu-item,
        #na-menu-primary ul.mega-menu > li > a:hover, #na-menu-primary ul.mega-menu > li > a:focus,
        #na-menu-primary ul > li:hover[class*="-has-children"] > a:before,
        #na-menu-primary ul > li > ul li[class*="-has-children"]:hover:after,
        .post-tran .entry-title a:hover,
        .post-tran .article-meta a:hover, .post-tran .article-meta .fa:hover,
        .box-videos .video-carousel .post-item:hover .entry-title > a,
        .byline:hover i,
        .posted-on:hover i,
        .slick-dots li button:hover, .slick-dots li button:focus,
        .box-videos .video-carousel .slick-dots li.slick-active button::before, .box-videos .video-carousel .slick-dots li:hover button::before,
        .slider-sidebar .entry-title:hover,.slider-sidebar:hover .entry-title,.article-meta a:hover
        {
          color: %1$s;
        }

       .btn-outline,
        .btn-outline:hover, .btn-outline:focus, .btn-outline:active, .btn-outline.active,
        .open .btn-outline.dropdown-toggle,
        .btn-outline.disabled, .btn-outline.disabled:hover, .btn-outline.disabled:focus, .btn-outline.disabled:active, .btn-outline.disabled.active, .btn-outline[disabled], .btn-outline[disabled]:hover, .btn-outline[disabled]:focus, .btn-outline[disabled]:active, .btn-outline[disabled].active, fieldset[disabled] .btn-outline, fieldset[disabled] .btn-outline:hover, fieldset[disabled] .btn-outline:focus, fieldset[disabled] .btn-outline:active, fieldset[disabled] .btn-outline.active,
        .btn-inverse,
        .btn-inverse:hover, .btn-inverse:focus, .btn-inverse:active, .btn-inverse.active,
        .open .btn-inverse.dropdown-toggle,
        .button:hover, .button:focus, .button:active, .button.active ,
        .open .button.dropdown-toggle,
        .form-control:focus,
        .searchform .form-control:focus, .woocommerce-product-search .form-control:focus,
        .page-links span.page-numbers:hover ,
        .list-view .add_to_cart_button,
        .list-view .add_to_cart_button:hover, .list-view .add_to_cart_button:focus,
        #loadmore-button:hover,
        .button.single_add_to_cart_button:hover, .button.single_add_to_cart_button:focus, .button.single_add_to_cart_button:active, .button.single_add_to_cart_button.active,
        .page-content .vc_btn3.vc_btn3-style-custom,
        .page-content .vc_btn3.vc_btn3-style-custom:hover, .page-content .vc_btn3.vc_btn3-style-custom:focus, .page-content .vc_btn3.vc_btn3-style-custom:active, .page-content .vc_btn3.vc_btn3-style-custom.active,
        .btn-checkout ,
        .btn-order,
        .woocommerce-tabs li.resp-tab-item.active,
        .product-block.border:hover ,
        .variations_form.cart .att_img:hover > img, .variations_form.cart .att_img.selected > img,
        .post-format .ti-control-play:hover, .post-format .ti-camera:hover, .post-format .ti-headphone:hover, .post-format .ti-quote-left:hover,
        blockquote,.btn-primary,
        .btn-variant:hover, .btn-variant:focus, .btn-variant:active, .btn-variant.active
        {
          border-color: %1$s;
        }
        .entry-content a{
                box-shadow: 0 -2px 0 %1$s inset;
        }
        .post-cat a:hover{
            color:white;
        }


	';

    wp_add_inline_style( 'bitther-css', sprintf( $css, $bitther_primary_color ) );
}
add_action( 'wp_enqueue_scripts', 'bitther_primary_body', 29 );
?>