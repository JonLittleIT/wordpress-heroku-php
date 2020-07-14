<?php
/**
 * Page Title Bar (Social Template)
 *
 * Displays the title section
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<div class="beehive-title-bar social<?php echo ( beehive()->options->get( 'key=page-title&meta=1&options=0' ) || beehive()->options->get( 'key=breadcrumb&meta=1&options=0' ) ) ? esc_attr( ' visible' ) : ''; ?>">
	<div class="title-bar-wrapper">
		<?php if ( beehive()->options->get_meta_option( 'page-title' ) !== '0' || is_archive() ) : ?>
			<div class="title-wrapper<?php echo ( beehive()->options->get_meta_option( 'page-title' ) !== '1' ) ? esc_attr( ' screen-reader-text' ) : ''; ?>">
				<?php if ( is_single() ) : ?>
					<h2 class="title h3"><?php echo wp_kses_post( beehive()->titlebar->get_the_title() ); ?></h2>
				<?php else : ?>
					<h1 class="title h3"><?php echo wp_kses_post( beehive()->titlebar->get_the_title() ); ?></h1>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php if ( beehive()->options->get_meta_option( 'breadcrumb' ) === '1' ) : ?>
			<?php echo beehive()->titlebar->get_breadcrumb(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php endif; ?>
	</div>
</div>
