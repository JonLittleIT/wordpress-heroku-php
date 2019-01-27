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


	<header class="header  header-tmplhalf-menu

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
		<div class="container">
		<?php if ($farvis_header['header_bar']) : ?>
            
			
            
		<?php endif; ?>
            
    <?php if ( !empty( farvis_get_option('header_type4_lmenu', '') ) ) { ?>
    <div class="tmpl-half-menu-left  tmplhalf-menu">
        <nav  class="navbar">
			<?php if ( $farvis_header['header_menu'] ) : ?>
			<div class="header-navibox-2">
				<?php
					wp_nav_menu(array(
	                    'container' => false,
	                    'menu' => farvis_get_option('header_type4_lmenu', ''),
	                    'menu_class' => 'yamm main-menu nav navbar-nav',
					));
				?>
			</div>
			<?php endif; ?>
	   </nav>
	</div>
	<?php } ?>
    
    
    <div class="tmpl-half-menu-middle  tmplhalf-menu">
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
								     src="<?php echo esc_url(get_template_directory_uri().'/images/your-logo.png') ?>"
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
    
    <?php if ( !empty( farvis_get_option('header_type4_rmenu', '') ) ) { ?>
    <div class="tmpl-half-menu-right tmplhalf-menu">
       <nav  class="navbar">
			<?php if ( $farvis_header['header_menu'] ) : ?>
			<div class="header-navibox-2">
				<?php
					wp_nav_menu(array(
	                    'container' => false,
	                    'menu' => farvis_get_option('header_type4_rmenu', ''),
	                    'menu_class' => 'yamm main-menu nav navbar-nav',
					));
				?>
			</div>
			<?php endif; ?>
	   </nav>
    </div>
    <?php } ?>
            
            
            
		
            
            
		</div>
        
        
        
        
        <div class="header-decore-bottom">
            
            <?php 
           
            
            if (farvis_get_option('header_decore', '') == 'style_1') { ?>
               <div class="header-decore-style-1">
            
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
            </div>
            
           	<?php } ?> 
            <?php if (farvis_get_option('header_decore', '') == 'style_2') { ?>
            
            <div class="header-decore-style-2">
            <svg width="100%" height="68px">
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
            </div>
            
            	<?php } ?> 
            
            
         </div>
        
        
        
	</header>


