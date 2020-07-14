<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php
		if ( function_exists( 'bp_is_active' ) ) {
			bp_head();}
		?>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<?php
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
		?>

		<?php if ( beehive()->options->get( 'key=remove-preloader&meta=1&options=0' ) !== 'on' ) : ?>
			<div class="beehive-preloader">
				<span></span>
			</div>
		<?php endif; ?>

		<?php do_action( 'beehive_before_page_starts' ); ?>

		<div id="beehive-page" class="site">

			<?php do_action( 'beehive_before_page' ); ?>

			<div id="content" class="site-content">

				<?php
				do_action( 'beehive_before_content' );
