<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

						// Widgets area inside page content
						kryptex_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					kryptex_create_widgets_area('widgets_below_page');

					$kryptex_body_style = kryptex_get_theme_option('body_style');
					if ($kryptex_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$kryptex_footer_type = kryptex_get_theme_option("footer_type");
			if ($kryptex_footer_type == 'custom' && !kryptex_is_layouts_available())
				$kryptex_footer_type = 'default';
			get_template_part( "templates/footer-{$kryptex_footer_type}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (kryptex_is_on(kryptex_get_theme_option('debug_mode')) && kryptex_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(kryptex_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php }
	?>

	<?php wp_footer(); ?>

</body>
</html>