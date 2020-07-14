<?php

if ( !defined( 'TBAY_ELEMENTOR_ACTIVED' ) ) return;

//convert hex to rgb
if ( !function_exists ('besa_tbay_getbowtied_hex2rgb') ) {
	function besa_tbay_getbowtied_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); // returns the rgb values separated by commas
		//return $rgb; // returns an array with the rgb values
	}
}


if ( !function_exists ('besa_tbay_color_lightens_darkens') ) {
	/**
	 * Lightens/darkens a given colour (hex format), returning the altered colour in hex format.7
	 * @param str $hex Colour as hexadecimal (with or without hash);
	 * @percent float $percent Decimal ( 0.2 = lighten by 20%(), -0.4 = darken by 40%() )
	 * @return str Lightened/Darkend colour as hexadecimal (with hash);
	 */
	function besa_tbay_color_lightens_darkens( $hex, $percent ) {
		
		// validate hex string
		
		$hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
		$new_hex = '#';
		
		if ( strlen( $hex ) < 6 ) {
			$hex = $hex[0] + $hex[0] + $hex[1] + $hex[1] + $hex[2] + $hex[2];
		}
		
		// convert to decimal and change luminosity
		for ($i = 0; $i < 3; $i++) {
			$dec = hexdec( substr( $hex, $i*2, 2 ) );
			$dec = min( max( 0, $dec + $dec * $percent ), 255 ); 
			$new_hex .= str_pad( dechex( $dec ) , 2, 0, STR_PAD_LEFT );
		}		
		
		return $new_hex;
	}
}

if ( !function_exists ('besa_tbay_default_theme_primary_color') ) {
	function besa_tbay_default_theme_primary_color() {

		$active_theme = besa_tbay_get_theme();

		$theme_color = array();

		$theme_color['main_color'] 			= '#fa4f26';
		$theme_color['main_color_second'] 	= '#fcd537';

		return apply_filters( 'besa_get_default_theme_color', $theme_color);
	}
}

if ( !function_exists ('besa_tbay_custom_styles') ) {
	function besa_tbay_custom_styles() {
		global $reduxConfig;	

		$ouput = $reduxConfig->output;

		$main_color  		= $main_bg_color =  $main_border_color  = besa_tbay_get_config('main_color');
		$main_color_2    	= besa_tbay_get_config('main_color_second');

		$logo_img_width        		= besa_tbay_get_config( 'logo_img_width' );
		$logo_padding        		= besa_tbay_get_config( 'logo_padding' );	

		$logo_img_width_mobile 		= besa_tbay_get_config( 'logo_img_width_mobile' );
		$logo_mobile_padding 		= besa_tbay_get_config( 'logo_mobile_padding' );

		$custom_css 			= besa_tbay_get_config( 'custom_css' );
		$css_desktop 			= besa_tbay_get_config( 'css_desktop' );
		$css_tablet 			= besa_tbay_get_config( 'css_tablet' );
		$css_wide_mobile 		= besa_tbay_get_config( 'css_wide_mobile' );
		$css_mobile         	= besa_tbay_get_config( 'css_mobile' );

		$show_typography        = (bool) besa_tbay_get_config( 'show_typography', false );

		$main_bg_color_mobile = '';

		$bg_buy_now 		  = besa_tbay_get_config( 'bg_buy_now' );

		ob_start();	
		?>
		
		/* Theme Options Styles */
		
		<?php if( $show_typography ) : ?>	
			/* Typography */
			/* Main Font */
			<?php
				$font_source = besa_tbay_get_config('font_source');
				$main_font = besa_tbay_get_config('main_font');
				$main_font = isset($main_font['font-family']) ? $main_font['font-family'] : false;
				$main_google_font_face = besa_tbay_get_config('main_google_font_face');
				$main_custom_font_face = besa_tbay_get_config('main_custom_font_face');
			?>
			<?php if ( ($font_source == "1" && $main_font) || ($font_source == "2" && $main_google_font_face) || ($font_source == "3" && $main_custom_font_face) ): ?>
				<?php  echo trim($ouput['primary-font'][0]); ?>
				{font-family: 
					<?php 
						switch ($font_source) {
							case '3':
								echo trim($main_custom_font_face);
								break;								
							case '2':
								echo trim($main_google_font_face);
								break;							
							case '1':
								echo trim($main_font);
								break;
							
							default:
								echo trim($main_google_font_face);
								break;
						}
					?>
				}
			<?php endif; ?>
			/* Second Font */
			<?php
				$secondary_font = besa_tbay_get_config('secondary_font');
				$secondary_font = isset($secondary_font['font-family']) ? $secondary_font['font-family'] : false;
				$secondary_google_font_face = besa_tbay_get_config('secondary_google_font_face');
				$secondary_custom_font_face = besa_tbay_get_config('secondary_custom_font_face');
			?>
			<?php if ( ($font_source == "1" && $secondary_font) || ($font_source == "2" && $secondary_google_font_face)  || ($font_source == "3" && $secondary_custom_font_face) ): ?>
					<?php  echo trim($ouput['secondary-font'][0]); ?>
				{font-family: 
					<?php 
						switch ($font_source) {
							case '3':
								echo trim($secondary_custom_font_face);
								break;								
							case '2':
								echo trim($secondary_google_font_face);
								break;							
							case '1':
								echo trim($secondary_font);
								break;
							
							default:
								echo trim($secondary_google_font_face);
								break;
						}
					?>
				}		
			<?php endif; ?>

		<?php endif; ?>


			/* Custom Color (skin) */ 


			/* check main color */ 
			<?php if ( $main_color != "" ) : ?>

				/*color*/

				/*background*/
				<?php if( isset($ouput['background_hover']) && !empty($ouput['background_hover']) ) : ?>
				<?php echo trim($ouput['background_hover']); ?> {
					background: <?php echo esc_html( besa_tbay_color_lightens_darkens( $main_bg_color, -0.1) ); ?>;
				}
				<?php endif; ?>

			<?php endif; ?> 

			<?php if( !empty($bg_buy_now) ) : ?>
        		#shop-now.has-buy-now .tbay-buy-now.button, #shop-now.has-buy-now .tbay-buy-now.button.disabled {
					background-color: <?php echo esc_html( $bg_buy_now ) ?>;
				}
				#shop-now.has-buy-now .tbay-buy-now.button:not(.disabled):hover, #shop-now.has-buy-now .tbay-buy-now.button:not(.disabled):focus {
					background: <?php echo esc_html( besa_tbay_color_lightens_darkens( $bg_buy_now, -0.1) ); ?>;
				}
			<?php endif; ?>

			/* check main color second */ 
			<?php if ( $main_color_2 != "" ) : ?>
				/*background*/
				.footer-device-mobile > * a span.count, .singular-shop div.product.product-type-external .single_add_to_cart_button {
					background-color: <?php echo esc_html( $main_color_2 ) ?>;
				}
				.singular-shop div.product.product-type-external .single_add_to_cart_button:hover {
					background: <?php echo esc_html( besa_tbay_color_lightens_darkens( $main_color_2, -0.1) ); ?>;
				}

			<?php endif; ?>

			<?php if ( $logo_img_width != "" ) : ?>
			.site-header .logo img {
	            max-width: <?php echo esc_html( $logo_img_width ); ?>px;
	        } 
	        <?php endif; ?>

	        <?php if ( $logo_padding != "" ) : ?>
	        .site-header .logo img {

	            <?php if( !empty($logo_padding['padding-top'] ) ) : ?>
					padding-top: <?php echo esc_html( $logo_padding['padding-top'] ); ?>;
	        	<?php endif; ?>

	        	<?php if( !empty($logo_padding['padding-right'] ) ) : ?>
					padding-right: <?php echo esc_html( $logo_padding['padding-right'] ); ?>;
	        	<?php endif; ?>
	        	
	        	<?php if( !empty($logo_padding['padding-bottom'] ) ) : ?>
					padding-bottom: <?php echo esc_html( $logo_padding['padding-bottom'] ); ?>;
	        	<?php endif; ?>

	        	<?php if( !empty($logo_padding['padding-left'] ) ) : ?>
					 padding-left: <?php echo esc_html( $logo_padding['padding-left'] ); ?>;
	        	<?php endif; ?>

	        }
	        <?php endif; ?> 

	        <?php if ( $main_color != "" ) : ?>

        	/*Tablet*/
	        @media (max-width: 1199px)  and (min-width: 768px) {
				/*color*/
				<?php if( isset($ouput['tablet_color']) && !empty($ouput['tablet_color']) ) : ?>
					<?php echo trim($ouput['tablet_color']); ?> {
						color: <?php echo esc_html( $main_color ) ?>;
					}
				<?php endif; ?>


				/*background*/
				<?php if( isset($ouput['tablet_background']) && !empty($ouput['tablet_background']) ) : ?>
					<?php echo trim($ouput['tablet_background']); ?> {
						background-color: <?php echo esc_html( $main_bg_color ) ?>;
					}
				<?php endif; ?>

				/*Border*/
				<?php if( isset($ouput['tablet_border']) && !empty($ouput['tablet_border']) ) : ?>
				<?php echo trim($ouput['tablet_border']); ?> {
					border-color: <?php echo esc_html( $main_border_color ) ?>;
				}
				<?php endif; ?>
		    }

		    /*Mobile*/
		    @media (max-width: 767px) {
				/*color*/
				<?php if( isset($ouput['mobile_color']) && !empty($ouput['mobile_color']) ) : ?>
					<?php echo trim($ouput['mobile_color']); ?> {
						color: <?php echo esc_html( $main_color ) ?>;
					}
				<?php endif; ?>

				/*background*/
				<?php if( isset($ouput['mobile_background']) && !empty($ouput['mobile_background']) ) : ?>
					<?php echo trim($ouput['mobile_background']); ?> {
						background-color: <?php echo esc_html( $main_bg_color ) ?>;
					}
				<?php endif; ?>

				/*Border*/
				<?php if( isset($ouput['mobile_border']) && !empty($ouput['mobile_border']) ) : ?>
				<?php echo trim($ouput['mobile_border']); ?> {
					border-color: <?php echo esc_html( $main_border_color ) ?>;
				}
				<?php endif; ?>
		    }

		    /*No edit code customize*/	
		    @media (max-width: 1199px)  and (min-width: 768px) {	       
		    	/*color*/
				.footer-device-mobile > * a:hover,.footer-device-mobile > *.active a,.footer-device-mobile > *.active a i , body.woocommerce-wishlist .footer-device-mobile > .device-wishlist a,body.woocommerce-wishlist .footer-device-mobile > .device-wishlist a i,.vc_tta-container .vc_tta-panel.vc_active .vc_tta-panel-title > a span,.cart_totals table .order-total .woocs_special_price_code {
					color: <?php echo esc_html( $main_color ) ?>;
				}

				/*background*/
				.topbar-device-mobile .top-cart a.wc-continue,.topbar-device-mobile .cart-dropdown .cart-icon .mini-cart-items,.footer-device-mobile > * a .mini-cart-items,.tbay-addon-newletter .input-group-btn input {
					background-color: <?php echo esc_html( $main_bg_color ) ?>;
				}

				/*Border*/
				.topbar-device-mobile .top-cart a.wc-continue {
					border-color: <?php echo esc_html( $main_border_color ) ?>;
				}
			}


		   <?php endif; ?>

	        @media (max-width: 1199px) {

	        	<?php if ( $logo_img_width_mobile != "" ) : ?>
	            /* Limit logo image height for mobile according to mobile header height */
	            .mobile-logo a img {
	               	max-width: <?php echo esc_html( $logo_img_width_mobile ); ?>px;
	            }     
	            <?php endif; ?>       

	            <?php if ( $logo_mobile_padding != "" ) : ?>
	            .mobile-logo a img {

		            <?php if( !empty($logo_mobile_padding['padding-top'] ) ) : ?>
						padding-top: <?php echo esc_html( $logo_mobile_padding['padding-top'] ); ?>;
		        	<?php endif; ?>

		        	<?php if( !empty($logo_mobile_padding['padding-right'] ) ) : ?>
						padding-right: <?php echo esc_html( $logo_mobile_padding['padding-right'] ); ?>;
		        	<?php endif; ?>

		        	<?php if( !empty($logo_mobile_padding['padding-bottom'] ) ) : ?>
						padding-bottom: <?php echo esc_html( $logo_mobile_padding['padding-bottom'] ); ?>;
		        	<?php endif; ?>

		        	<?php if( !empty($logo_mobile_padding['padding-left'] ) ) : ?>
						 padding-left: <?php echo esc_html( $logo_mobile_padding['padding-left'] ); ?>;
		        	<?php endif; ?>
		           
	            }
	            <?php endif; ?>
			}

			@media screen and (max-width: 782px) {
				html body.admin-bar{
					top: -46px !important;
					position: relative;
				}
			}

			/* Custom CSS */
	        <?php 
	        if( $custom_css != '' ) {
	            echo trim($custom_css);
	        }
	        if( $css_desktop != '' ) {
	            echo '@media (min-width: 1024px) { ' . ($css_desktop) . ' }'; 
	        }
	        if( $css_tablet != '' ) {
	            echo '@media (min-width: 768px) and (max-width: 1023px) {' . ($css_tablet) . ' }'; 
	        }
	        if( $css_wide_mobile != '' ) {
	            echo '@media (min-width: 481px) and (max-width: 767px) { ' . ($css_wide_mobile) . ' }'; 
	        }
	        if( $css_mobile != '' ) {
	            echo '@media (max-width: 480px) { ' . ($css_mobile) . ' }'; 
	        }
	        ?>


	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			} 
		}

		$custom_css = implode($new_lines);

		wp_enqueue_style( 'besa-style', BESA_THEME_DIR . '/style.css', array(), '1.0' );

		wp_add_inline_style( 'besa-style', $custom_css );

		if( class_exists( 'WooCommerce' ) && class_exists( 'YITH_Woocompare' ) ) {
			wp_add_inline_style( 'besa-woocommerce', $custom_css );
		}  
	}
}

add_action( 'wp_enqueue_scripts', 'besa_tbay_custom_styles', 600 ); 