<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly ?>

</div>
						<?php woohoo_below_content_box(); ?>
                        <?php woohoo_footer_ad(); ?>
                        <?php
                        $footer_class = "";
                        $footer_styling = woohoo_get_option( 'bdaia_footer_styling' );
                        if ( $footer_styling ==  "light" ) {
                            $footer_class = " woohoo-footer-light";
                        }
                        ?>
                        <div class="bdaia-footer<?php echo esc_attr( $footer_class ); ?>">
	                        <?php get_sidebar( 'footer' ); ?>
	                        <?php
	                        $sub_footer_bg                  = woohoo_get_option( 'bdaia_sub_footer_bg' );
	                        $sub_footer_text_color          = woohoo_get_option( 'bdaia_sub_footer_text_color' );
	                        $sub_footer_text_hover_color    = woohoo_get_option( 'bdaia_sub_footer_text_hover_color' );
	                        $sub_footer_css = "";
	                        if( !empty( $sub_footer_bg['color'] ) || !empty( $sub_footer_bg['img'] ) ) { $sub_footer_css  = ' style ="';
		                        if( !empty( $sub_footer_bg['color'] ) ) $sub_footer_css .= 'background-color:'.$sub_footer_bg['color'].';';
		                        if( !empty( $sub_footer_bg['img'] ) ) $sub_footer_css .= 'background-image: url('.$sub_footer_bg['img'].');';
		                        if( !empty( $sub_footer_bg['repeat'] ) ) $sub_footer_css .= 'background-repeat:'.$sub_footer_bg['repeat'].';';
		                        if( !empty( $sub_footer_bg['attachment'] ) ) $sub_footer_css .= 'background-attachment:'.$sub_footer_bg['attachment'].';';
		                        if( !empty( $sub_footer_bg['hor'] ) || !empty( $header_bg['ver'] ) ) $sub_footer_css .= 'background-position:'.$sub_footer_bg['hor'].' '.$sub_footer_bg['ver'].';';
		                        $sub_footer_css .= '"';
	                        }
	                        $sub_footer_sc = "";
	                        if( !empty( $sub_footer_text_color ) || !empty( $sub_footer_text_hover_color ) ) { $sub_footer_sc  = '<style type="text/css">';
		                        if( !empty( $sub_footer_text_color ) ) $sub_footer_sc .= 'div.bdaia-footer div.bdaia-footer-area, div.bdaia-footer div.bdaia-footer-area a{color: '.$sub_footer_text_color.';}';
		                        if( !empty( $sub_footer_text_hover_color ) ) $sub_footer_sc .= 'div.bdaia-footer div.bdaia-footer-area a:hover{color: '.$sub_footer_text_hover_color.';}';
		                        $sub_footer_sc .= '</style>';
	                        }
	                        echo $sub_footer_sc; ?>

	                        <?php
	                        $buffy = $woohoo_footer_logo_margin = '';

	                        $footer_menu                = woohoo_get_option( 'footer_menu' );
	                        $woohoo_footer_top_tags     = woohoo_get_option( 'woohoo_footer_top_tags' );
	                        $woohoo_footer_follow_us    = woohoo_get_option( 'woohoo_footer_follow_us' );
	                        $woohoo_footer_about_us     = woohoo_get_option( 'woohoo_footer_about_us' );
	                        $woohoo_footer_logo         = woohoo_get_option( 'woohoo_footer_logo' );
	                        $woohoo_footer_retina_logo  = woohoo_get_option( 'woohoo_footer_logo_retina' );
	                        $woohoo_footer_retina_logo_width    = woohoo_get_option( 'woohoo_footer_logo_retina_width' );
	                        $woohoo_footer_retina_logo_mtop     = woohoo_get_option( 'woohoo_footer_logo_mtop' );

	                        if( !empty( $woohoo_footer_retina_logo_mtop ) ){
		                        $woohoo_footer_logo_margin = ' style ="margin-top: '.$woohoo_footer_retina_logo_mtop.'px"';
	                        }
	                        if( $footer_menu || $woohoo_footer_logo || $woohoo_footer_about_us || $woohoo_footer_follow_us || $woohoo_footer_top_tags ) { ?>
		                        <div class="woohoo-footer-top-area"<?php echo $sub_footer_css; ?>>
			                        <?php
			                        // Top Tags
			                        if( !empty( $woohoo_footer_top_tags ) ){ ?>
			                        <div class="bd-container">
				                        <div class="tagcloud">
					                        <span><?php woohoo_tr( 'Top Tags' )?></span>
					                        <?php wp_tag_cloud( 'smallest=13&largest=13&unit=px&number=15&order=RAND' );?>
				                        </div>
			                        </div>
			                        <?php } ?>
			                        <?php if( $woohoo_footer_logo || $woohoo_footer_about_us || $woohoo_footer_follow_us ){ ?>
				                        <div class="bd-container">
					                        <div class="bdaia-row">
						                        <?php
						                        // Footer Logo.
						                        if( !empty( $woohoo_footer_logo ) ){ ?>
					                                <div class="footer-col3">
							                            <div class="footer-logo-inner"<?php echo $woohoo_footer_logo_margin; ?>>
								                            <?php
								                            if ( empty( $woohoo_footer_retina_logo ) ) {
									                            $buffy .= '<a href="' . esc_url(home_url( '/' )) . '"><img src="' . $woohoo_footer_logo . '" alt="" style="width : '.$woohoo_footer_retina_logo_width.'px" /></a>';
								                            }
								                            else {
									                            $buffy .= '<a href="' . esc_url(home_url( '/' )) . '"><img class="woohoo-retina-data" src="' . $woohoo_footer_logo . '" data-retina="' . esc_attr( $woohoo_footer_retina_logo ) . '" alt="" style="width : '.$woohoo_footer_retina_logo_width.'px" /></a>';
								                            }
								                            echo $buffy;
								                            ?>
							                            </div>
					                                </div>
						                        <?php } ?>
						                        <?php
						                        // Abput Us.
						                        if( !empty( $woohoo_footer_about_us ) ){ ?>
						                            <div class="footer-col6">
							                            <h4 class="block-title"><span><?php woohoo_tr( 'About us' )?></span></h4>
							                            <div class="footer-about-us-inner">
								                            <?php echo do_shortcode( htmlspecialchars_decode( stripslashes( $woohoo_footer_about_us ) ) );?>
							                            </div>
						                            </div>
						                        <?php } ?>
						                        <?php
						                        // Follow Us.
						                        if( !empty( $woohoo_footer_follow_us ) ){ ?>
						                            <div class="footer-col3">
							                            <h4 class="block-title"><span><?php woohoo_tr( 'Follow us' )?></span></h4>
							                            <div class="widget-social-links bdaia-social-io-colored">
								                            <?php echo woohoo_social( 'yes', 35, 'none' ); ?>
							                            </div>
						                            </div>
						                        <?php } ?>
					                        </div>
				                        </div>
			                        <?php } ?>
			                        <?php
			                        // Footer Menu.
			                        if( woohoo_get_option( 'footer_menu' ) ) { ?>
				                        <div class="bd-container">
					                        <div class="woohoo-footer-menu">
						                        <?php
						                        if ( has_nav_menu( 'footer_menu' ) ) {
							                        wp_nav_menu( array( 'menu_class' => 'footer-bottom-menu', 'theme_location' => 'footer_menu'));
						                        }
						                        ?>
					                        </div>
				                        </div>
			                        <?php } ?>
		                        </div>
	                        <?php } ?>

	                        <div class="bdaia-footer-area"<?php echo $sub_footer_css; ?>>
		                        <div class="bd-container">
			                        <div class="bdaia-footer-area-l">
				                        <?php if( woohoo_get_option( 'footer_copyright_text' ) ) { echo '<span class="copyright">'. stripslashes( woohoo_get_option( 'footer_copyright_text' ) ) .'</span>'; } ?>
			                        </div>
			                        <div class="bdaia-footer-area-r">
				                        <?php if( woohoo_get_option( 'bdayhFooterSocialLinks' ) ){ ?>
					                        <?php woohoo_social( 'yes', '32', '' ); ?>
				                        <?php } ?>
			                        </div>
		                        </div>
	                        </div>
                        </div><!--.bdaia-footer/-->
                    </div>
                </div>
            </div><!-- #page/-->
        </div><!-- .page-outer/-->

        <?php if( woohoo_get_option( 'bdaia_login_icon' ) == 1 ) : ?>
            <div id="woohoo-login-join">
                <div class="woohoo-login-join-wrapper woohoo-login-join-onlogin">
                    <div class="woohoo-login-join-inner">
                        <div class="woohoo-login-join-nav">
                            <p class="woohoo-login-join-nav-title"><?php woohoo_tr( 'Login' );?></p>
                            <p class="woohoo-login-join-nav-icon"><span class="bdaia-io bdaia-io-user"></span></p>
                        </div>
                        <div class="woohoo-login-join-contnet">
                            <div class="woohoo-login-join-container" id="woohoo-login" >
                                <div class="woohoo-loginform">
                                    <?php echo woohoo_login_popup(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif;?>

        <?php wp_footer(); ?>
    </body>
</html>