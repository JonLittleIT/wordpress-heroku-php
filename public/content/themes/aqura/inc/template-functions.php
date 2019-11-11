<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Aqura
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function aqura_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'aqura_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function aqura_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'aqura_pingback_header' );

add_action('wp_footer', 'aqura_last_function', 999999999);

/**
 * Display dynamic generated data while running dJax requests :
 *
 * a script which will load others scripts on the run
 */
function aqura_last_function(){
	/**
	 * Display dynamic generated data while runing d-jax requests :
	 *
	 * a script which will load others scripts on the run
	 */
	// let's try a crazy thing
	$dynamic_scripts = aqura_controller::get_instance()->get_queued_scripts();
	$dynamic_styles  = aqura_controller::get_instance()->get_queued_styles(); ?>
	<div id="ajax-updatable-content">
		<div class="aqura_ajax-update-content ajax_bottom">
			<script>
				(function ($) {
					// wait for all dom elements
					$(document).ready(function () {
						// run this only if we have resources
						if (!window.hasOwnProperty('aqura_static_resources')) return;
						window.aqura_dynamic_loaded_scripts = <?php echo json_encode( $dynamic_scripts ); ?>;
						window.aqura_dynamic_loaded_styles = <?php echo json_encode( $dynamic_styles ); ?>;

						// run this only if we have resources
						if (!window.hasOwnProperty('aqura_static_resources')) return;

						// pile_dynamic_loaded_scripts is generated in footer when all the scripts should be already enqueued
						$.each( window.aqura_dynamic_loaded_scripts, function (key, url) {

							if (key in aqura_static_resources.scripts) return;

							// add this script to our global stack so we don't enqueue it again
							aqura_static_resources.scripts[key] = url;

							$.ajaxSetup({
								cache: true,
								async: false
							});

							$.getScript(url)
								.done(function (script, textStatus) {

								})
								.fail(function (jqxhr, settings, exception) {

								});

						});

						$.each( window.aqura_dynamic_loaded_styles, function (key, url) {

							if (key in aqura_static_resources.styles) return;

							// add this style to our global stack so we don't enqueue it again
							aqura_static_resources.styles[key] = url;

							// sorry no cache this time
							$.ajax({
								cache: true,
								async: false,
								url: url,
								dataType: 'html',
								success: function (data) {
									$('<style type="text/css">\n' + data + '</style>').appendTo("head");
								}
							});

						});
					});
				})(jQuery);
			</script>
		</div>
	</div>
	<?php
}

function setAndViewPostViews($postID) {
    $count_key = 'views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
    return $count; /* so you can show it */
}