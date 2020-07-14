<?php if ( ! defined('BESA_THEME_DIR')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------------------------------
 * Get Icon Mobile Menu
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_tbay_get_button_mobile_menu' ) ) {
	function besa_tbay_get_button_mobile_menu() {

		$output 	= '';
		$output 	.= '<a href="#tbay-mobile-menu-navbar" class="btn btn-sm">';
		$output  .= '<i class="tb-icon tb-icon-menu"></i>';
		$output  .= '</a>';			

		$output 	.= '<a href="#page" class="btn btn-sm">';
		$output  .= '<i class="tb-icon tb-icon-cross"></i>';
		$output  .= '</a>';

		
		return apply_filters( 'besa_tbay_get_button_mobile_menu', '<div class="active-mobile">'. $output . '</div>', 10 );

	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Icon Mobile Menu
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'besa_the_button_mobile_menu' ) ) {
	function besa_the_button_mobile_menu() {
		wp_enqueue_script( 'jquery-mmenu' );
		$ouput = besa_tbay_get_button_mobile_menu();
		
		echo trim($ouput);
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * Get Logo Mobile
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_tbay_get_logo_mobile' ) ) {
	function besa_tbay_get_logo_mobile() {
		$mobilelogo 			= besa_tbay_get_config('mobile-logo');

		$output 	= '<div class="mobile-logo">';
			if( isset($mobilelogo['url']) && !empty($mobilelogo['url']) ) { 
				$url    	= $mobilelogo['url'];
				$output 	.= '<a href="'. esc_url( home_url( '/' ) ) .'">'; 

				if( isset($mobilelogo['width']) && !empty($mobilelogo['width']) ) {
					$output 		.= '<img src="'. esc_url( $url ) .'" width="'. esc_attr($mobilelogo['width']) .'" height="'. esc_attr($mobilelogo['height']) .'" alt="'. get_bloginfo( 'name' ) .'">';
				} else {
					$output 		.= '<img src="'. esc_url( $url ) .'" alt="'. get_bloginfo( 'name' ) .'">';
				}

				
				$output 		.= '</a>';

			} else {
				$output 		.= '<div class="logo-theme">';
					$output 	.= '<a href="'. esc_url( home_url( '/' ) ) .'">';
					$output 	.= '<img src="'. esc_url_raw( BESA_IMAGES.'/mobile-logo.png') .'" alt="'. get_bloginfo( 'name' ) .'">';
					$output 	.= '</a>';
				$output 		.= '</div>';
			}
		$output 	.= '</div>';
		
		return apply_filters( 'besa_tbay_get_logo_mobile', $output, 10 );

	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Logo Mobile Menu
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'besa_the_logo_mobile' ) ) {
	function besa_the_logo_mobile() {
		$ouput = besa_tbay_get_logo_mobile();
		
		echo trim($ouput);
	}
}


/**
 * ------------------------------------------------------------------------------------------------
 * The Mini cart mobile
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_the_icon_mini_cart_mobile' ) ) {
	function besa_the_icon_mini_cart_mobile() {

		global $woocommerce; 
		$icon = besa_tbay_get_config('woo_mini_cart_icon', 'tb-icon tb-icon-cart');
		$_id 	= besa_tbay_random_key();
		if( !defined('BESA_WOOCOMMERCE_ACTIVED') || defined('BESA_WOOCOMMERCE_CATALOG_MODE_ACTIVED') ) return;
		?>

        <div class="device-mini_cart top-cart tbay-element-mini-cart">
        	<?php besa_tbay_get_page_templates_parts('offcanvas-cart','right'); ?>
            <div class="tbay-topcart">
				<div id="cart-<?php echo esc_attr($_id); ?>" class="cart-dropdown dropdown">
					<a class="dropdown-toggle mini-cart v2" data-offcanvas="offcanvas-right" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" href="#">
						<?php if( !empty($icon) ) : ?>
							<i class="<?php echo esc_attr( $icon ); ?>"></i>
						
						<?php else: ?>
							<i class="tb-icon tb-icon-cart"></i>
						<?php endif;  ?>
							<span class="mini-cart-items">
							   <?php echo sprintf( '%d', $woocommerce->cart->cart_contents_count );?>
							</span>
						<span><?php esc_html_e('Cart', 'besa'); ?></span>
					</a>   
					<div class="dropdown-menu"></div>    
				</div>
			</div> 
		</div>

		<?php
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Mini cart header mobile
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_the_icon_mini_cart_header_mobile' ) ) {
	function besa_the_icon_mini_cart_header_mobile() {
		if( !defined('BESA_WOOCOMMERCE_CATALOG_MODE_ACTIVED') && defined('BESA_WOOCOMMERCE_ACTIVED') && (is_product() || is_cart() || is_checkout()) ) {
			besa_the_icon_mini_cart_mobile();
		} 
	}
}


/**
 * ------------------------------------------------------------------------------------------------
 * The Mini cart footer mobile
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_the_icon_mini_cart_footer_mobile' ) ) {
	function besa_the_icon_mini_cart_footer_mobile() {
		besa_the_icon_mini_cart_mobile();
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * The search header mobile
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_the_search_header_mobile' ) ) {
	function besa_the_search_header_mobile() {
		?>
			<div class="search-device">
				<a id="search-icon" class="search-icon" href="javascript:;"><?php echo apply_filters( 'besa_get_icon_search_mobile', '<i class="tb-icon tb-icon-magnifier"></i>', 2 ); ?></a>
				<?php besa_tbay_get_page_templates_parts('device/productsearchform', 'mobileheader');  ?>
			</div>

		<?php
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Mini cart mobile
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_the_mini_cart_header_mobile' ) ) {
	function besa_the_mini_cart_header_mobile() {
		besa_tbay_get_page_templates_parts('offcanvas-cart','right');
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * Top right header mobile
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_top_header_mobile' ) ) {
	function besa_top_header_mobile() { ?>
		<div class="top-right-mobile">
			<?php 
				/**
				* Hook: besa_top_header_mobile.
				*
				* @hooked besa_the_mini_cart_header_mobile - 5
				* @hooked besa_the_search_header_mobile - 10
				*/
				add_action('besa_top_header_mobile', 'besa_the_search_header_mobile', 5);
				do_action( 'besa_top_header_mobile' );
			?>
		</div>
	<?php }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Get Icon Back on Header Mobile
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_tbay_get_back_mobile' ) ) {
	function besa_tbay_get_back_mobile() {

		$output 	= '<div class="topbar-mobile-history">';
		$output 	.= '<a href="javascript:history.back()">';
		$output  	.= apply_filters( 'besa_get_mobile_history_icon', '<i class="tb-icon tb-icon-chevron-left"></i>', 2 );
		$output  	.= '</a>';
		$output  	.= '</div>';
		
		return apply_filters( 'besa_tbay_get_back_mobile', $output , 10 );

	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * The icon Back On Header Mobile
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'besa_the_back_mobile' ) ) {
	function besa_the_back_mobile() {
		$ouput = besa_tbay_get_back_mobile();
		
		echo trim($ouput);
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * Get Title Page Header Mobile
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_tbay_get_title_page_mobile' ) ) {
	function besa_tbay_get_title_page_mobile() {
		$output = '';

		if( class_exists('WooCommerce') && !is_product_category() ) {
			$output 	.= '<div class="topbar-title">';
			$output  	.= apply_filters( 'besa_get_filter_title_mobile', 10,2 );
			$output  	.= '</div>';
		} else {
			$output  	.= apply_filters( 'besa_get_filter_title_mobile', 10,2 );
		}

		
		return apply_filters( 'besa_tbay_get_title_page_mobile', $output , 10 );
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * The icon Back On Header Mobile
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'besa_the_title_page_mobile' ) ) {
	function besa_the_title_page_mobile() {
		$ouput = besa_tbay_get_title_page_mobile();
		echo trim($ouput);
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * Get Icon Home Page On Header Mobile
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_tbay_get_icon_home_page_mobile' ) ) {
	function besa_tbay_get_icon_home_page_mobile() {
		$output 	= '<div class="topbar-icon-home">';
		$output 	.= '<a href="'. esc_url( home_url( '/' ) ) .'">';
		$output  	.= apply_filters( 'besa_get_mobile_home_icon', '<i class="tb-icon tb-icon-home3"></i>', 2 );
		$output  	.= '</a>';
		$output  	.= '</div>';
		
		return apply_filters( 'besa_tbay_get_icon_home_page_mobile', $output , 10 );
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Icon Home Page On Header Mobile
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'besa_the_icon_home_page_mobile' ) ) {
	function besa_the_icon_home_page_mobile() {

		if( !defined('BESA_WOOCOMMERCE_CATALOG_MODE_ACTIVED') && defined('BESA_WOOCOMMERCE_ACTIVED') && (is_product() || is_cart() || is_checkout()) ) {
			$ouput = besa_tbay_get_icon_home_page_mobile();
		
			echo trim($ouput);
		}	 

	}
}


/**
 * ------------------------------------------------------------------------------------------------
 * The Hook Config Header Mobile
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'besa_the_hook_header_mobile_all_page' ) ) {
	function besa_the_hook_header_mobile_all_page() {
		$always_display_logo 			= besa_tbay_get_config('always_display_logo', false);
		
		if( $always_display_logo || besa_tbay_is_home_page() ) return;

		remove_action( 'besa_header_mobile_content', 'besa_the_logo_mobile', 15 );
		add_action( 'besa_header_mobile_content', 'besa_the_title_page_mobile', 15 );

	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Hook Menu Mobile All page Header Mobile
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'besa_the_hook_header_mobile_menu_all_page' ) ) {
	function besa_the_hook_header_mobile_menu_all_page() {
		$menu_mobile_all_page 	= besa_tbay_get_config('menu_mobile_all_page', false);
		
		if( $menu_mobile_all_page || besa_tbay_is_home_page() )  return;
		remove_action( 'besa_header_mobile_content', 'besa_the_button_mobile_menu', 5 );
		add_action( 'besa_header_mobile_content', 'besa_the_back_mobile', 5 );	
	}
}


/**
 * ------------------------------------------------------------------------------------------------
 * Get Icon Home Page On Footer Mobile
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_tbay_get_icon_home_footer_mobile' ) ) {
	function besa_tbay_get_icon_home_footer_mobile() {

		$active = (is_front_page()) ? 'active' : '';

		$output	 = '<div class="device-home '. $active .' ">';
		$output  .= '<a href="'. esc_url( home_url( '/' ) ) .'" >';
		$output  .= apply_filters( 'besa_get_mobile_home_icon', '<i class="tb-icon tb-icon-home3"></i>', 2 );
		$output  .= '<span>'. esc_html__('Home','besa'). '</span>';
		$output  .='</a>';
		$output  .='</div>';
		
		return apply_filters( 'besa_tbay_get_icon_home_footer_mobile', $output , 10 );
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Icon Home Page On Footer Mobile
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'besa_the_icon_home_footer_mobile' ) ) {
	function besa_the_icon_home_footer_mobile() {
		$ouput = besa_tbay_get_icon_home_footer_mobile();
		
		echo trim($ouput);
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * Get Icon Wishlist On Footer Mobile
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_tbay_get_icon_wishlist_footer_mobile' ) ) {
	function besa_tbay_get_icon_wishlist_footer_mobile() {
		$output = '';
		
		if( !class_exists( 'YITH_WCWL' ) ) return $output;

		$wishlist_url 	= YITH_WCWL()->get_wishlist_url();
		$wishlist_count = YITH_WCWL()->count_products();

		$output	 .= '<div class="device-wishlist">';
		$output  .= '<a class="text-skin wishlist-icon" href="'. esc_url($wishlist_url) .'" >';
		$output  .= apply_filters( 'besa_get_mobile_wishlist_icon', '<i class="tb-icon tb-icon-heart"></i>', 2 );
		$output  .= '<span class="count count_wishlist">'. esc_html($wishlist_count) .'</span>';
		$output  .= '<span>'. esc_html__('Wishlist','besa'). '</span>';
		$output  .='</a>';
		$output  .='</div>';
		
		return apply_filters( 'besa_tbay_get_icon_wishlist_footer_mobile', $output , 10 );
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Icon Wishlist On Footer Mobile
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'besa_the_icon_wishlist_footer_mobile' ) ) {
	function besa_the_icon_wishlist_footer_mobile() {
		$ouput = besa_tbay_get_icon_wishlist_footer_mobile();
		
		echo trim($ouput);
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * Get Icon Recent On Footer Mobile
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_tbay_get_icon_recent_footer_mobile' ) ) {
	function besa_tbay_get_icon_recent_footer_mobile() {
		$enable 	=  besa_tbay_get_config('mobile_footer_menu_recent', true);

		$output = '';

		if ( !$enable || !defined('BESA_WOOCOMMERCE_ACTIVED') ) return $output;
		$title 		=  besa_tbay_get_config('mobile_footer_menu_recent_title', esc_html__( 'Viewed', 'besa' ));
		$icon 		=  besa_tbay_get_config('mobile_footer_menu_recent_icon', 'tb-icon tb-icon-history');
		$page_id 	=  besa_tbay_get_config('mobile_footer_menu_recent_page');
		
		$active 	= (is_page() && (get_the_ID() == $page_id) ) ? 'active' : '';

		if( !empty($page_id) ) {
            $url = get_permalink($page_id);
        } else {
			return;
		}


		$output	 .= '<div class="device-recent '. esc_attr( $active ) .'">';

		if( isset($url) && !empty($url) ) {
			$output  .= '<a class="mobile-recent" href="'. esc_url( $url ) .'" >';
		}

		$output  .= '<i class="'. esc_attr($icon) .'"></i>';
		$output  .= '<span>'. $title .'</span>';
		$output  .='</a>';
		$output  .='</div>';
		
		return apply_filters( 'besa_tbay_get_icon_recent_footer_mobile', $output , 10 );
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Icon Recent On Footer Mobile
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'besa_the_icon_recent_footer_mobile' ) ) {
	function besa_the_icon_recent_footer_mobile() {
		$ouput = besa_tbay_get_icon_recent_footer_mobile();
		
		echo trim($ouput);
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * Get Icon Account On Footer Mobile
 * ------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'besa_tbay_get_icon_account_footer_mobile' ) ) {
	function besa_tbay_get_icon_account_footer_mobile() {
		$output = '';

		if ( defined('BESA_WOOCOMMERCE_CATALOG_MODE_ACTIVED') || !defined('BESA_WOOCOMMERCE_ACTIVED') ) return $output;

		$icon_text 	= apply_filters( 'besa_get_mobile_user_icon', '<i class="tb-icon tb-icon-user"></i>', 2 );
		$icon_text .= '<span>'.esc_html__('Account','besa').'</span>';

		$active 	= ( is_account_page() ) ? 'active' : '';

		$output	 .= '<div class="device-account '. esc_attr( $active ) .'">';
		if (is_user_logged_in() ) {
			$output .= '<a class="logged-in" href="'. esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) .'"  title="'. esc_attr__('Login','besa') .'">';
		}
		else {
			$output .= '<a class="popup-login" href="javascript:void(0);"  title="'. esc_attr__('Login','besa') .'">';
		}
		$output .= $icon_text;
		$output .= '</a>';

		$output  .='</div>';
		
		return apply_filters( 'besa_tbay_get_icon_account_footer_mobile', $output , 10 );
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * The Icon Account On Footer Mobile
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'besa_the_icon_account_footer_mobile' ) ) {
	function besa_the_icon_account_footer_mobile() {
		$ouput = besa_tbay_get_icon_account_footer_mobile();
		
		echo trim($ouput);
	}
}
