<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0.10
 */

// Footer menu
$kryptex_menu_footer = kryptex_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($kryptex_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php kryptex_show_layout($kryptex_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>