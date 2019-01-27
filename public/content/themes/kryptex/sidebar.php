<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

if (kryptex_sidebar_present()) {
	ob_start();
	$kryptex_sidebar_name = kryptex_get_theme_option('sidebar_widgets');
	kryptex_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($kryptex_sidebar_name) ) {
		dynamic_sidebar($kryptex_sidebar_name);
	}
	$kryptex_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($kryptex_out)) {
		$kryptex_sidebar_position = kryptex_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($kryptex_sidebar_position); ?> widget_area<?php if (!kryptex_is_inherit(kryptex_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(kryptex_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'kryptex_action_before_sidebar' );
				kryptex_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $kryptex_out));
				do_action( 'kryptex_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>