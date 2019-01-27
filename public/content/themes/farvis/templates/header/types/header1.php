<?php /* Header Type 1 */
	$post_ID = isset ($wp_query) ? $wp_query->get_queried_object_id() : get_the_ID();
	if( class_exists( 'WooCommerce' ) && farvis_is_woo_page() && farvis_get_option('woo_header_global','1') ){
		$post_ID = get_option( 'woocommerce_shop_page_id' ) ? get_option( 'woocommerce_shop_page_id' ) : $post_ID;
	}

	$blogname = get_option('blogname');
	$tagline = get_option('blogdescription');
	$farvis_header = apply_filters('farvis_header_settings', $post_ID);
	$farvis_header['header_background'] = $farvis_header['header_background'] == '' ? 'white' : $farvis_header['header_background'];
	$hover_effect = $farvis_header['header_hover_effect'] > 0 ? 'cl-effect-'.$farvis_header['header_hover_effect'] : '';

    $farvis_logo_stl = farvis_get_option('general_settings_logo_width') != '' ? 'max-width:'.esc_attr(farvis_get_option('general_settings_logo_width')).'px;' : '';
    $farvis_logo_stl .= farvis_get_option('general_settings_logo_vertical_pos') != '' ? 'top:'.esc_attr(farvis_get_option('general_settings_logo_vertical_pos')).'px;' : '';
    $farvis_logo_stl .= farvis_get_option('general_settings_logo_horizontal_pos') != '' ? 'left:'.esc_attr(farvis_get_option('general_settings_logo_horizontal_pos')).'px;' : '';
    $farvis_logo_stl = $farvis_logo_stl != '' ? 'style="'.($farvis_logo_stl).'"' : '';

	$farvis_logo_text = farvis_get_option('general_settings_logo_text') != '' ? '<div class="logo-text">'.wp_kses_post(farvis_get_option('general_settings_logo_text')).'</div>' : '';
	
	$farvis_plugin_installed = class_exists( 'TmplCustom' );
?>


	<header class="header

    <?php if ($farvis_header['header_bar']) : ?>
	    header-topbar-view
	    header-topbarbox-1-<?php echo esc_attr($farvis_header['header_topbarbox_1_position']) ?>
        header-topbarbox-2-<?php echo esc_attr($farvis_header['header_topbarbox_2_position']) ?>
    <?php endif; ?>

        header-<?php echo esc_attr($farvis_header['header_layout']) ?>-width
 <?php if ($farvis_header['header_sticky'] == 'fixed') : ?>
        navbar-fixed-top
        navbar-fixed-js
    <?php elseif ($farvis_header['header_sticky'] == 'sticky') : ?>
        navbar-fixed-top
        navbar-sticky-top
    <?php elseif ($farvis_header['header_sticky'] == 'scroll') : ?> 
        navbar-fixed-top
        navbar-fixed-js
        navbar-sticky-scroll
    <?php endif; ?>
                   
                   
                   
		header-background-<?php echo esc_attr( $farvis_header['header_background'] ) ?><?php echo esc_attr( in_array($farvis_header['header_background'], array('trans-white', 'trans-black')) ? '-rgba0' . $farvis_header['header_transparent'] : '' ) ?>

	<?php if ( in_array($farvis_header['header_background'], array('trans-white', 'white')) ) : ?>
        header-color-black
        header-logo-black
	<?php else : ?>
        header-color-white
        header-logo-white
	<?php endif; ?>

        header-navibox-1-<?php echo esc_attr($farvis_header['header_navibox_1_position']) ?>
        header-navibox-2-<?php echo esc_attr($farvis_header['header_navibox_2_position']) ?>
        header-navibox-3-<?php echo esc_attr($farvis_header['header_navibox_3_position']) ?>
        header-navibox-4-<?php echo esc_attr($farvis_header['header_navibox_4_position']) ?>

	<?php echo esc_attr($farvis_header['mobile_sticky']) ?>
	<?php echo esc_attr($farvis_header['mobile_topbar']) ?>
	<?php echo esc_attr($farvis_header['tablet_minicart']) ?>
	<?php echo esc_attr($farvis_header['tablet_search']) ?>
	<?php echo esc_attr($farvis_header['tablet_phone']) ?>
	<?php echo esc_attr($farvis_header['tablet_socials']) ?> 

	<?php echo esc_attr($farvis_header['header_uniq_class']) ?>

       ">
		<div class="container container-boxed-width">
		<?php if ($farvis_header['header_bar']) : ?>
			<div class="top-bar">
				<div class="container">
					<div class="header-topbarbox-1">
						<ul>
							<?php if ($farvis_header['header_phone']) : ?>
								<li class="no-hover header-phone"><?php echo wp_kses_post(farvis_get_option('header_phone', '')) ?> </li>
							<?php endif; ?>

							<?php if ($farvis_header['header_email']) : ?>
								<li><?php echo wp_kses_post(farvis_get_option('header_email', '')) ?></li>
							<?php endif; ?>
						</ul>
					</div>
					<div class="header-topbarbox-2">
		                <?php
			            if ( has_nav_menu( 'top_nav' ) ) {
							wp_nav_menu(array(
								'theme_location'  => 'top_nav',
			        			'container'       => false,
			        			'menu_id'		  => 'top-menu',
			        			'menu_class'      => '',
			        			'depth'           => 1
							));
						}
						?>

						<?php if ( $farvis_header['header_socials'] ) : ?>
                        
                        
                         <div class="header-follow-title"><?php esc_attr_e('Follow Us:', 'farvis'); ?></div>
                        
                        
						<ul class="nav navbar-nav hidden-xs">
							<?php if (farvis_get_option('social_facebook', '')) { ?>
								<li class="header-social-link"><a href="<?php echo esc_url(farvis_get_option('social_facebook', '')); ?>"
								       target="_blank"><i class="fa fa-facebook"></i></a></li>
							<?php } ?>
							<?php if (farvis_get_option('social_twitter', '')) { ?>
								<li class="header-social-link"><a href="<?php echo esc_url(farvis_get_option('social_twitter', '')); ?>"
								       target="_blank"><i class="fa fa-twitter"></i></a></li>
							<?php } ?>
							<?php if (farvis_get_option('social_google', '')) { ?>
								<li class="header-social-link"><a href="<?php echo esc_url(farvis_get_option('social_google', '')); ?>"
								       target="_blank"><i class="fa fa-google-plus"></i></a></li>
							<?php } ?>
							<?php if (farvis_get_option('social_instagram', '')) { ?>
								<li class="header-social-link"><a href="<?php echo esc_url(farvis_get_option('social_instagram', '')); ?>"
								       target="_blank"><i class="fa fa-instagram"></i></a></li>
							<?php } ?>
							<?php if (farvis_get_option('social_pinterest', '')) { ?>
								<li class="header-social-link"><a href="<?php echo esc_url(farvis_get_option('social_pinterest', '')); ?>"
								       target="_blank"><i class="fa fa-pinterest"></i></a></li>
							<?php } ?>
							<?php if (farvis_get_option('social_custom_url_1', '')) { ?>
								<li class="header-social-link"><a href="<?php echo esc_url(farvis_get_option('social_custom_url_1', '')); ?>"
								       target="_blank"><i
												class="fa <?php echo esc_attr(farvis_get_option('social_custom_icon_1', '')); ?>"></i></a>
								</li>
							<?php } ?>
							<?php if (farvis_get_option('social_custom_url_2', '')) { ?>
								<li class="header-social-link"><a href="<?php echo esc_url(farvis_get_option('social_custom_url_2', '')); ?>"
								       target="_blank"><i
												class="fa <?php echo esc_attr(farvis_get_option('social_custom_icon_2', '')); ?>"></i></a>
								</li>
							<?php } ?>
							<?php if (farvis_get_option('social_custom_url_3', '')) { ?>
								<li class="header-social-link"><a href="<?php echo esc_url(farvis_get_option('social_custom_url_3', '')); ?>"
								       target="_blank"><i
												class="fa <?php echo esc_attr(farvis_get_option('social_custom_icon_3', '')); ?>"></i></a>
								</li>
							<?php } ?>
						</ul>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
			<nav id="nav" class="navbar">
				<div class="container ">
					<div class="header-navibox-1">
						<button class="menu-mobile-button visible-xs-block js-toggle-mobile-slidebar toggle-menu-button ">
							<span class="toggle-menu-button-icon"><span></span> <span></span> <span></span> <span></span>
								<span></span> <span></span></span>
						</button>
						<a class="navbar-brand scroll" href="<?php echo esc_url(home_url('/')) ?>" <?php echo wp_kses_post($farvis_logo_stl)?>>
							<?php if ($farvis_header['logo']): ?>
								<img class="normal-logo"
								     src="<?php echo esc_url($farvis_header['logo']) ?>"
								     alt="<?php echo esc_attr($tagline)?>"/>
							<?php elseif ($farvis_plugin_installed):?>		 
								<img class="normal-logo"
								     src="<?php echo esc_url(get_template_directory_uri() . '/images/your-logo.png') ?>"
								     alt="<?php echo esc_attr($tagline)?>"/>		 
							<?php else: ?>
								<?php echo esc_attr($blogname)?>
							<?php endif ?>
							<?php if ($farvis_header['logo_inverse']): ?>
								<img class="scroll-logo hidden-xs"
								     src="<?php echo esc_url($farvis_header['logo_inverse']) ?>"
								     alt="<?php echo esc_attr($tagline)?>"/>
							<?php endif ?>
						</a>
						<?php echo wp_kses_post($farvis_logo_text); ?>
					</div>
					<?php if (class_exists('WooCommerce') && $farvis_header['header_minicart']) : ?>
						<div class="header-navibox-4">
							<div class="header-cart">
								<a href="<?php echo esc_url(wc_get_cart_url()); ?>"><i class="theme-fonts-icon_bag_alt"
								                                                       aria-hidden="true"></i></a>
								<span class="header-cart-count"><?php echo WC()->cart->cart_contents_count; ?></span>
							</div>
						</div>
					<?php endif; ?>
					<div class="header-navibox-3">
						<ul class="nav navbar-nav hidden-xs">

							<?php if ( farvis_get_option('header_search') ) : ?>
							<li class="header-search-icon"><a class="btn_header_search" href="#"><i class="fa fa-search"></i></a></li>
						    <?php endif; ?>

							<?php if ( $farvis_header['header_menu_add_position'] != 'disable' ) : ?>
							<li>
                                <?php if ( $farvis_header['header_menu_add_position'] == 'fly' ) : ?>
                                    <button  id="toggle-fly-menu" class="toggle-menu-button">
                                        <span class="toggle-menu-button-icon">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </span>
                                    </button>
                                <?php else: ?>
                                    <button  id="toggle-theme-menu"  class=" js-toggle-<?php echo esc_attr($farvis_header['header_menu_add_position'] == 'screen' ? 'screen' : $farvis_header['header_menu_add_position'].'-slidebar') ?> toggle-menu-button ">
                                        <span class="toggle-menu-button-icon">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </span>
                                    </button>
                                <?php endif; ?>
							</li>
							<?php endif; ?>

						</ul>
					</div>
					<?php if ( $farvis_header['header_menu'] ) : ?>
					<div class="header-navibox-2">
						<?php echo farvis_site_menu('yamm main-menu nav navbar-nav ' . esc_attr($hover_effect). ' ' .esc_attr($farvis_header['header_marker']) ); ?>
					</div>
					<?php endif; ?>
				</div>
			</nav>
		</div>
        
        <div class="header-decore-bottom">
            
            <?php 
           
            
            if (farvis_get_option('header_decore', '') == 'style_1') { ?>
            
            
               <svg width="100%" height="32px" >
					<defs>
			            <pattern id="tmpl-header-decore-bottom01" patternUnits="userSpaceOnUse" x="0" y="0" width="528" height="32">
							<g>
								<path id="path1488" d="M0,25 Q24,19 48,25 Q72,32 120,19 Q168,32 216,19 Q264,32 312,19 Q360,32 408,19 Q456,32 
								480,25 Q504,19 528,25 L528,0 L0,0 L0,19" style="fill:#2d363e"/>
							</g>
		                </pattern>
		            </defs>
		            <rect x="0" y="0" width="100%" height="32px" fill="url(#tmpl-header-decore-bottom01)"></rect>
				</svg>
            
           	<?php } ?> 
            <?php if (farvis_get_option('farvis_header_decore', '') == 'style_2') { ?>
            <svg width="100%" height="68px" style="margin-bottom: 20px">
					<defs>
			            <pattern id="tmpl-header-decore-bottom02" patternUnits="userSpaceOnUse" x="0" y="0" width="238" height="68">
							<g>
								<path id="path88" d="M0,58 Q20,48 40,58 Q58,68 76,58 Q96,48 116,58 Q134,68 152,58 Q172,48 192,58 
								Q210,68 238,58 Q258,44 278,58 L278,0 L0,0 L0,58" style="fill:#3f8beb"/>
							</g>
		                </pattern>
		            </defs>
		            <rect x="0" y="0" width="100%" height="68px" fill="url(#tmpl-header-decore-bottom02)"></rect>
				</svg> 
            	<?php } ?> 
            
            
         </div>
        
        
        
	</header>


