<?php
/**
 * The template for displaying the footer.
 *
*/
?>

    <!-- FOOTER -->
    <footer>
        <!-- FOOTER TOP -->
        <?php if ( !class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
            <?php if(porfoliowp_redux('mt_footer_row_1') == true || porfoliowp_redux('mt_footer_row_2') == true || porfoliowp_redux('mt_footer_row_3') == true){ ?>
                <div class="row footer-top">
                    <div class="container">
                    <?php      
                        //FOOTER ROW #1
                        echo porfoliowp_footer_row1();
                        //FOOTER ROW #2
                        echo porfoliowp_footer_row2();
                        //FOOTER ROW #3
                        echo porfoliowp_footer_row3();
                     ?>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>

        <!-- FOOTER BOTTOM -->
        <div class="footer row">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                    	<p class="copyright text-center"><?php echo porfoliowp_redux('mt_footer_text'); ?></p>
                    </div>
                    <div class="col-md-2">
                        <?php if ( !class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
    				        <!-- BACK TO TOP BUTTON -->
    				        <a class="back-to-top modeltheme-is-visible modeltheme-fade-out" href="#0">
    				            <span>
                                    <i class="fa fa-chevron-up" aria-hidden="true"></i>            
                                </span>
    				        </a>
    				    <?php } else { ?>
    				        <?php if (porfoliowp_redux('mt_backtotop_status') == true) { ?>
    				            <!-- BACK TO TOP BUTTON -->
    				            <a class="back-to-top modeltheme-is-visible modeltheme-fade-out" href="#0">
                                    <span>
                                        <i class="fa fa-chevron-up" aria-hidden="true"></i>            
                                    </span>
    				            </a>
    				        <?php } ?>
    				    <?php } ?>
                    </div>
                    <div class="col-md-5"> 
                        <ul class="social-links">
                            <?php if ( porfoliowp_redux('mt_social_fb') && porfoliowp_redux('mt_social_fb') != '' ) { ?>
                                <li><a href="<?php echo esc_url( porfoliowp_redux('mt_social_fb') ) ?>"><i class="fa fa-facebook"></i></a></li>
                            <?php } ?>
                            <?php if ( porfoliowp_redux('mt_social_tw') && porfoliowp_redux('mt_social_tw') != '' ) { ?>
                                <li><a href="https://twitter.com/<?php echo esc_attr( porfoliowp_redux('mt_social_tw') ) ?>"><i class="fa fa-twitter"></i></a></li>
                            <?php } ?>
                            <?php if ( porfoliowp_redux('mt_social_gplus') && porfoliowp_redux('mt_social_gplus') != '' ) { ?>
                                <li><a href="<?php echo esc_url( porfoliowp_redux('mt_social_gplus') ) ?>"><i class="fa fa-google-plus"></i></a></li>
                            <?php } ?>
                            <?php if ( porfoliowp_redux('mt_social_youtube') && porfoliowp_redux('mt_social_youtube') != '' ) { ?>
                                <li><a href="<?php echo esc_url( porfoliowp_redux('mt_social_youtube') ) ?>"><i class="fa fa-youtube"></i></a></li>
                            <?php } ?>
                            <?php if ( porfoliowp_redux('mt_social_pinterest') && porfoliowp_redux('mt_social_pinterest') != '' ) { ?>
                                <li><a href="<?php echo esc_url( porfoliowp_redux('mt_social_pinterest') ) ?>"><i class="fa fa-pinterest"></i></a></li>
                            <?php } ?>
                            <?php if ( porfoliowp_redux('mt_social_linkedin') && porfoliowp_redux('mt_social_linkedin') != '' ) { ?>
                                <li><a href="<?php echo esc_url( porfoliowp_redux('mt_social_linkedin') ) ?>"><i class="fa fa-linkedin"></i></a></li>
                            <?php } ?>
                            <?php if ( porfoliowp_redux('mt_social_skype') && porfoliowp_redux('mt_social_skype') != '' ) { ?>
                                <li><a href="<?php echo esc_url( porfoliowp_redux('mt_social_skype') ) ?>"><i class="fa fa-skype"></i></a></li>
                            <?php } ?>
                            <?php if ( porfoliowp_redux('mt_social_instagram') && porfoliowp_redux('mt_social_instagram') != '' ) { ?>
                                <li><a href="<?php echo esc_url( porfoliowp_redux('mt_social_instagram') ) ?>"><i class="fa fa-instagram"></i></a></li>
                            <?php } ?>
                            <?php if ( porfoliowp_redux('mt_social_dribbble') && porfoliowp_redux('mt_social_dribbble') != '' ) { ?>
                                <li><a href="<?php echo esc_url( porfoliowp_redux('mt_social_dribbble') ) ?>"><i class="fa fa-dribbble"></i></a></li>
                            <?php } ?>
                            <?php if ( porfoliowp_redux('mt_social_deviantart') && porfoliowp_redux('mt_social_deviantart') != '' ) { ?>
                                <li><a href="<?php echo esc_url( porfoliowp_redux('mt_social_deviantart') ) ?>"><i class="fa fa-deviantart"></i></a></li>
                            <?php } ?>
                            <?php if ( porfoliowp_redux('mt_social_digg') && porfoliowp_redux('mt_social_digg') != '' ) { ?>
                                <li><a href="<?php echo esc_url( porfoliowp_redux('mt_social_digg') ) ?>"><i class="fa fa-digg"></i></a></li>
                            <?php } ?>
                            <?php if ( porfoliowp_redux('mt_social_flickr') && porfoliowp_redux('mt_social_flickr') != '' ) { ?>
                                <li><a href="<?php echo esc_url( porfoliowp_redux('mt_social_flickr') ) ?>"><i class="fa fa-flickr"></i></a></li>
                            <?php } ?>
                            <?php if ( porfoliowp_redux('mt_social_stumbleupon') && porfoliowp_redux('mt_social_stumbleupon') != '' ) { ?>
                                <li><a href="<?php echo esc_url( porfoliowp_redux('mt_social_stumbleupon') ) ?>"><i class="fa fa-stumbleupon"></i></a></li>
                            <?php } ?>
                            <?php if ( porfoliowp_redux('mt_social_tumblr') && porfoliowp_redux('mt_social_tumblr') != '' ) { ?>
                                <li><a href="<?php echo esc_url( porfoliowp_redux('mt_social_tumblr') ) ?>"><i class="fa fa-tumblr"></i></a></li>
                            <?php } ?>
                            <?php if ( porfoliowp_redux('mt_social_vimeo') && porfoliowp_redux('mt_social_vimeo') != '' ) { ?>
                                <li><a href="<?php echo esc_url( porfoliowp_redux('mt_social_vimeo') ) ?>"><i class="fa fa-vimeo-square"></i></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>



<?php wp_footer(); ?>
</body>
</html>