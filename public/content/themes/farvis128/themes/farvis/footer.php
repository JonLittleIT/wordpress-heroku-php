<?php

	$post_ID = isset ($wp_query) ? $wp_query->get_queried_object_id() : (get_the_ID()>0 ? get_the_ID() : '');
    if( class_exists( 'WooCommerce' ) && farvis_is_woo_page() && farvis_get_option('woo_header_global','1') ){
		$post_ID = get_option( 'woocommerce_shop_page_id' ) ? get_option( 'woocommerce_shop_page_id' ) : $post_ID;
	} elseif (!is_page_template('page-home.php') && get_option('page_for_posts') != ''){
		$post_ID = get_option('page_for_posts') ? get_option('page_for_posts') : 0;
	}

	$farvis_header = apply_filters('farvis_header_settings', $post_ID);


	$blogname = get_option('blogname');
	$tagline = get_option('blogdescription');
	$logo = farvis_get_option('general_settings_logo');
	$logo_text = farvis_get_option('general_settings_logo_text');

	$footer_fixed_class = get_post_meta($post_ID, 'pix_fixed_footer', 1) != '' ? get_post_meta($post_ID, 'pix_fixed_footer', 1) : farvis_get_option('footer_fixed', '0');
	$footer_fixed_class = $footer_fixed_class ? 'fixed-footer' : '';

	$topFooterBlockId = false;
	$bottomFooterBlockId = false;

	$topFooterBlockId = in_array(get_post_meta(get_the_ID(), 'pix_page_top_footer_staticblock', true), array('global', '')) || get_the_ID() == '' ? farvis_get_option('footer_block_top') : get_post_meta(get_the_ID(), 'pix_page_top_footer_staticblock', true);
	$bottomFooterBlockId = in_array(get_post_meta(get_the_ID(), 'pix_page_footer_staticblock', true), array('global', '')) || get_the_ID() == '' ? farvis_get_option('footer_block') : get_post_meta(get_the_ID(), 'pix_page_footer_staticblock', true);

	if(function_exists('icl_object_id')) {
		$topFooterBlockId = icl_object_id ($topFooterBlockId,'staticblocks',true);
		$bottomFooterBlockId = icl_object_id ($bottomFooterBlockId,'staticblocks',true);
	}

    $bottomBlock = html_entity_decode(farvis_get_option('footer_settings_copyright'));
?>

    <?php if ( $topFooterBlockId != 'nofooter' || $bottomFooterBlockId != 'nofooter' ) : ?>

        <!-- Footer section -->
        <footer class="footer <?php echo esc_attr($footer_fixed_class); ?>">
            <div class="container">
                <div class="row">

                    <?php if ( $topFooterBlockId && $topFooterBlockId !='nofooter' )  { farvis_get_staticblock_content($topFooterBlockId); } ?>
                        <?php if ( $bottomFooterBlockId && $bottomFooterBlockId !='nofooter' ) { farvis_get_staticblock_content($bottomFooterBlockId); } ?>

                            <?php if ( !$topFooterBlockId && !$bottomFooterBlockId ):?>
                                <div class="col-md-12 text-center common-footer">
                                    <div class="footer-logo">
                                        <?php if($logo):?>
                                            <img class="normal-logo" src="<?php echo esc_url($logo) ?>" alt="<?php echo esc_attr($tagline)?>" />
                                            <?php else:?>
                                                <a href="<?php echo esc_url(home_url('/')) ?>">
                                                    <?php echo esc_attr($blogname)?>
                                                </a>
                                                <?php endif?>
                                    </div>
                                    <?php if( farvis_get_option('footer_socials', '1') ):?>
                                        <div class="list-social">
                                            <ul>
                                                <?php if (farvis_get_option('social_facebook', '')) { ?>
                                                    <li><a href="<?php echo esc_url(farvis_get_option('social_facebook', '')); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                                    <?php } ?>
                                                        <?php if (farvis_get_option('social_vk', '')) { ?>
                                                            <li><a href="<?php echo esc_url(farvis_get_option('social_vk', '')); ?>" target="_blank"><i class="fa fa-vk"></i></a></li>
                                                            <?php } ?>
                                                                <?php if (farvis_get_option('social_youtube', '')) { ?>
                                                                    <li><a href="<?php echo esc_url(farvis_get_option('social_youtube', '')); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                                                    <?php } ?>
                                                                        <?php if (farvis_get_option('social_vimeo', '')) { ?>
                                                                            <li><a href="<?php echo esc_url(farvis_get_option('social_vimeo', '')); ?>" target="_blank"><i class="fa fa-vimeo"></i></a></li>
                                                                            <?php } ?>
                                                                                <?php if (farvis_get_option('social_twitter', '')) { ?>
                                                                                    <li><a href="<?php echo esc_url(farvis_get_option('social_twitter', '')); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                                                                    <?php } ?>
                                                                                        <?php if (farvis_get_option('social_google', '')) { ?>
                                                                                            <li><a href="<?php echo esc_url(farvis_get_option('social_google', '')); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                                                                            <?php } ?>
                                                                                                <?php if (farvis_get_option('social_tumblr', '')) { ?>
                                                                                                    <li><a href="<?php echo esc_url(farvis_get_option('social_tumblr', '')); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
                                                                                                    <?php } ?>
                                                                                                        <?php if (farvis_get_option('social_instagram', '')) { ?>
                                                                                                            <li><a href="<?php echo esc_url(farvis_get_option('social_instagram', '')); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                                                                                            <?php } ?>
                                                                                                                <?php if (farvis_get_option('social_pinterest', '')) { ?>
                                                                                                                    <li><a href="<?php echo esc_url(farvis_get_option('social_pinterest', '')); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                                                                                                    <?php } ?>
                                                                                                                        <?php if (farvis_get_option('social_linkedin', '')) { ?>
                                                                                                                            <li><a href="<?php echo esc_url(farvis_get_option('social_linkedin', '')); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                                                                                                            <?php } ?>
                                                                                                                                <?php if (farvis_get_option('social_custom1_link', '')) { ?>
                                                                                                                                    <li><a href="<?php echo esc_url(farvis_get_option('social_custom1_link', '')); ?>" target="_blank"><i
												class="fa <?php echo esc_attr(farvis_get_option('social_custom1_icon', '')); ?>"></i></a>
                                                                                                                                    </li>
                                                                                                                                    <?php } ?>
                                                                                                                                        <?php if (farvis_get_option('social_custom2_link', '')) { ?>
                                                                                                                                            <li><a href="<?php echo esc_url(farvis_get_option('social_custom2_link', '')); ?>" target="_blank"><i
												class="fa <?php echo esc_attr(farvis_get_option('social_custom2_icon', '')); ?>"></i></a>
                                                                                                                                            </li>
                                                                                                                                            <?php } ?>
                                                                                                                                                <?php if (farvis_get_option('social_custom3_link', '')) { ?>
                                                                                                                                                    <li><a href="<?php echo esc_url(farvis_get_option('social_custom3_link', '')); ?>" target="_blank"><i
												class="fa <?php echo esc_attr(farvis_get_option('social_custom3_icon', '')); ?>"></i></a>
                                                                                                                                                    </li>
                                                                                                                                                    <?php } ?>
                                            </ul>
                                        </div>
                                        <?php endif; ?>

                                            <?php if(farvis_get_option('footer_settings_copyright', '')) : ?>
                                                <div class="copyright">
                                                    <?php echo wp_kses_post(farvis_get_option('footer_settings_copyright'))?>
                                                </div>
                                                <?php endif; ?>

                                </div>
                                <?php endif; ?>

                </div>
            </div>

        </footer>

        <?php endif; ?>

            <?php if($farvis_header['header_menu_animation'] == 'reveal') : ?>
                <!-- ========================== -->
                <!-- END CONTAINER SLIDE MENU -->
                <!-- ========================== -->
                </div>
                <?php endif; ?>

                    <?php if($farvis_header['header_sidebar_view'] == 'fixed') : ?>
                        <!-- END FIXED SIDEBAR MENU  -->
                        </div>
                        <?php endif; ?>

                            </div>


                            <?php if( (farvis_get_option('page_loader_settings_use','off') == 'usemain' && is_front_page()) || farvis_get_option('page_loader_settings_use','off') == 'useall' ) : ?>

                                </div>
                                <!-- animsition end div -->
                                <?php endif; ?>


                                    <?php
    wp_footer();
?>

                                        </body>

                                        </html>