<?php
/**
 * Content Wrapper After
 *
 * Used by all beehive templates
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

						<?php do_action( 'beehive_after_main_content' ); ?>

					</main><!-- #main -->
				</div><!-- .col-main -->

				<?php do_action( 'beehive_after_content_grid' ); ?>

			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .layout -->
</div><!-- #primary -->
