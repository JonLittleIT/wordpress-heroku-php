<?php
/**
 * Content Wrapper Before
 *
 * Used by all beehive templates
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<div id="primary" class="<?php echo esc_attr( apply_filters( 'beehive_content_area', 'content-area' ) ); ?>">
	<div class="layout <?php echo esc_attr( apply_filters( 'beehive_layout_wrapper', 'default' ) ); ?>"> 
		<div class="<?php echo esc_attr( apply_filters( 'beehive_container_class', 'container' ) ); ?>">
			<div class="row">

				<?php do_action( 'beehive_before_content_grid' ); ?>

				<div class="<?php echo esc_attr( trim( apply_filters( 'beehive_main_content_width', '' ) . ' col-main' ) ); ?>">
					<main id="main" class="main-content">

						<?php
						do_action( 'beehive_before_main_content' );
