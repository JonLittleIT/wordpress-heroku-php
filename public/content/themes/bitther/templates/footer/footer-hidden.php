<?php if(get_theme_mod('bitther_enable_footer', 'hidden')) { ?>
    <footer id="na-footer" class="na-footer  footer-hidden">
        <div class="footer-center clearfix">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <?php if(is_active_sidebar( 'footer-center')){
                        dynamic_sidebar('footer-center');
                    }?>
                </div>
            </div>
            <div id="scrollup" class="scrollup"><i class="ti-angle-up"></i></div>
        </div>
        <!--    Footer bottom-->
        <div class="footer-bottom clearfix">
            <div class="container">
                <div class="container-inner">
                    <div class="row">

                        <div class="col-md-12 col-sm-12">
                                <div class="coppy-right">
                                    <?php if(get_theme_mod('bitther_copyright_text')) {?>
                                        <span><?php echo  wp_kses_post(get_theme_mod('bitther_copyright_text'));?></span>
                                    <?php } else {
                                        echo '<span>'.esc_html__('@ All Right Reserved ','bitther').' '.date("Y").' '.esc_html__('bitther . Made by ','bitther').'<i class="fa fa-heart" aria-hidden="true"></i><a href="'.esc_url('http://nanoagency.co').'">'.esc_html__(' NanoAgency','bitther').'</a></span>';
                                    } ?>
                                </div><!-- .site-info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer><!-- .site-footer -->

<?php } ?>