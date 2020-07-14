<?php
/**
 * Post Navigation
 *
 * @link https://codex.wordpress.org/Next_and_Previous_Links
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<div class="post-navigation animate-item slideInUp">
	<div class="wrapper">
		<div class="previous-post">
			<?php if ( get_previous_post() ) : ?>
				<div class="prev">
					<?php previous_post_link( '%link', '<span class="nav-icon"><i class="icon ion-ios-arrow-back"></i></span><h5 class="post-nav-label">' . esc_html__( 'Prev post', 'beehive' ) . '</h5>' ); ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="next-post">
			<?php if ( get_next_post() ) : ?>
				<div class="next">
					<?php next_post_link( '%link', '<span class="nav-icon"><i class="icon ion-ios-arrow-forward"></i></span><h5 class="post-nav-label">' . esc_html__( 'Next post', 'beehive' ) . '</h5>' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
