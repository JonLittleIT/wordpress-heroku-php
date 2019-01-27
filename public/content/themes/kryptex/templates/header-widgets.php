<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

// Header sidebar
$kryptex_header_name = kryptex_get_theme_option('header_widgets');
$kryptex_header_present = !kryptex_is_off($kryptex_header_name) && is_active_sidebar($kryptex_header_name);
if ($kryptex_header_present) {
	kryptex_storage_set('current_sidebar', 'header');
	$kryptex_header_wide = kryptex_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($kryptex_header_name) ) {
		dynamic_sidebar($kryptex_header_name);
	}
	$kryptex_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($kryptex_widgets_output)) {
		$kryptex_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $kryptex_widgets_output);
		$kryptex_need_columns = strpos($kryptex_widgets_output, 'columns_wrap')===false;
		if ($kryptex_need_columns) {
			$kryptex_columns = max(0, (int) kryptex_get_theme_option('header_columns'));
			if ($kryptex_columns == 0) $kryptex_columns = min(6, max(1, substr_count($kryptex_widgets_output, '<aside ')));
			if ($kryptex_columns > 1)
				$kryptex_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($kryptex_columns).' widget ', $kryptex_widgets_output);
			else
				$kryptex_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($kryptex_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$kryptex_header_wide) {
					?><div class="content_wrap"><?php
				}
				if ($kryptex_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'kryptex_action_before_sidebar' );
				kryptex_show_layout($kryptex_widgets_output);
				do_action( 'kryptex_action_after_sidebar' );
				if ($kryptex_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$kryptex_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>