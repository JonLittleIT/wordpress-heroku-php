<?php
/**
 * Page Title Bar (Default)
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

<div class="beehive-title-bar default">
	<div class="title-bar-wrapper">
	<?php if ( beehive()->options->get_meta_option( 'page-title' ) !== '0' || is_archive() ) : ?>
		<div class="title-wrapper<?php echo ( ! beehive()->titlebar->get_the_title() ) ? ' no-title' : ''; ?>">
			<div class="container">
				<?php if ( is_single() ) : ?>
					<h2 class="title h2"><?php echo wp_kses_post( beehive()->titlebar->get_the_title() ); ?></h2>
				<?php else : ?>
					<h1 class="title h2"><?php echo wp_kses_post( beehive()->titlebar->get_the_title() ); ?></h1>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ( beehive()->options->get_meta_option( 'breadcrumb' ) !== '0' || is_archive() ) : ?>
		<div class="breadcrumb-wrapper">
			<div class="container">
				<?php echo beehive()->titlebar->get_breadcrumb(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</div>
	<?php endif; ?>
	</div>
</div>
