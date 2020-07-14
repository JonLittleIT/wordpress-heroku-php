<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_action('elementor/theme/before_do_header', function () {
    wp_body_open();
    do_action('ekommart_before_site'); ?>
    <div id="page" class="hfeed site">
    <?php
});

add_action('elementor/theme/after_do_header', function () {
    do_action('ekommart_before_content');
    ?>
    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
    <?php
    do_action('ekommart_content_top');
});

add_action('elementor/theme/before_do_footer', function () {
    ?>
		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'ekommart_before_footer' );
});

add_action('elementor/theme/after_do_footer', function () {
    ekommart_handheld_footer_bar();
    do_action( 'ekommart_after_footer' );
    ?>

    </div><!-- #page -->
        <?php
});