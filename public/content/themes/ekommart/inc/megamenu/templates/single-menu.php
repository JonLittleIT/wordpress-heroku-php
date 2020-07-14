<?php
/**
 * Template name: Megamenu Single
 * Template Post Type: post, page, product
*/

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="ekommart-wrapper">
    <div id="page" class="site-builder">
        <div class="site-content-contain-builder">
            <div id="content" class="site-content-builder">
                <div class="wrap">
                    <div id="primary-builder" class="content-area-builder">
                        <main id="main" class="site-main">
                            <?php
                            /* Start the Loop */
                            while (have_posts()) : the_post();
                                the_content();
                            endwhile; // End of the loop.
                            ?>

                        </main><!-- #main -->
                    </div><!-- #primary -->
                    <?php // get_sidebar(); ?>
                </div><!-- .wrap -->

            </div><!-- #content -->
        </div><!-- .site-content-contain -->
    </div><!-- #page -->
</div><!-- end.ekommart-wrapper-->
<?php wp_footer(); ?>
</body>
</html>
