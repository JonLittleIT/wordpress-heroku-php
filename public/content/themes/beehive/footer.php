<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); }
?>

				<?php do_action( 'beehive_after_content' ); ?>

			</div><!-- #content -->

			<?php do_action( 'beehive_after_page' ); ?>

		</div><!-- #beehive-page -->

		<?php do_action( 'beehive_after_page_ends' ); ?>

		<?php wp_footer(); ?>

	</body>
</html>
