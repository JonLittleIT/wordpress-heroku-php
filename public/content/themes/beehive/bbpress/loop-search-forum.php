<?php

/**
 * Search Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="bbp-forum-header animate-item slideInUp">

	<div class="bbp-meta">

		<span class="bbp-forum-post-date">
			<?php
				// translators: forum last updated text.
				echo wp_kses_post( sprintf( __( 'Last updated %s', 'bbpress' ), bbp_get_forum_last_active_time() ) );
			?>
		</span>

		<a href="<?php bbp_forum_permalink(); ?>" class="bbp-forum-permalink">#<?php bbp_forum_id(); ?></a>

	</div><!-- .bbp-meta -->

	<div class="bbp-forum-title">

		<?php do_action( 'bbp_theme_before_forum_title' ); ?>

		<h3>
			<?php esc_html_e( 'Forum: ', 'bbpress' ); ?>
			<a href="<?php bbp_forum_permalink(); ?>">
				<?php bbp_forum_title(); ?>
			</a>
		</h3>

		<?php do_action( 'bbp_theme_after_forum_title' ); ?>

	</div><!-- .bbp-forum-title -->

</div><!-- .bbp-forum-header -->

<div id="post-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>

	<div class="bbp-forum-content">

		<span class="bbp-title-icon forum-icon color-primary h4"><i class="uil-comments"></i></span>

		<?php do_action( 'bbp_theme_before_forum_content' ); ?>

		<?php bbp_forum_content(); ?>

		<?php do_action( 'bbp_theme_after_forum_content' ); ?>

	</div><!-- .bbp-forum-content -->

</div><!-- #post-<?php bbp_forum_id(); ?> -->
