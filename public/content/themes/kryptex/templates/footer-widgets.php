<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0.10
 */

// Footer sidebar
$kryptex_footer_name = kryptex_get_theme_option('footer_widgets');
$kryptex_footer_present = !kryptex_is_off($kryptex_footer_name) && is_active_sidebar($kryptex_footer_name);
if ($kryptex_footer_present) {
	kryptex_storage_set('current_sidebar', 'footer');
	$kryptex_footer_wide = kryptex_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($kryptex_footer_name) ) {
		dynamic_sidebar($kryptex_footer_name);
	}
	$kryptex_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($kryptex_out)) {
		$kryptex_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $kryptex_out);
		$kryptex_need_columns = true;	//or check: strpos($kryptex_out, 'columns_wrap')===false;
		if ($kryptex_need_columns) {
			$kryptex_columns = max(0, (int) kryptex_get_theme_option('footer_columns'));
			if ($kryptex_columns == 0) $kryptex_columns = min(4, max(1, substr_count($kryptex_out, '<aside ')));
			if ($kryptex_columns > 1)
				$kryptex_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($kryptex_columns).' widget ', $kryptex_out);
			else
				$kryptex_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($kryptex_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$kryptex_footer_wide) {
					?><div class="content_wrap"><?php
				}
				if ($kryptex_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'kryptex_action_before_sidebar' );
				kryptex_show_layout($kryptex_out);
				do_action( 'kryptex_action_after_sidebar' );
				if ($kryptex_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$kryptex_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>