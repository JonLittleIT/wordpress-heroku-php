<?php

class Ekommart_WP_Widget_Recent_Posts extends WP_Widget_Recent_Posts {
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts', 'ekommart' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 * @since 4.9.0 Added the `$instance` parameter.
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 * @param array $instance Array of settings for the current widget.
		 */
		$r = new WP_Query(
			apply_filters(
				'widget_posts_args',
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				),
				$instance
			)
		);

		if ( ! $r->have_posts() ) {
			return;
		}
		?>
		<?php echo wp_kses_post($args['before_widget']); ?>
		<?php
		if ( $title ) {
			echo wp_kses_post($args['before_title'] . $title . $args['after_title']); 
		}
		?>
		<ul>
			<?php foreach ( $r->posts as $recent_post ) : ?>
				<?php
				$post_title   = get_the_title( $recent_post->ID );
				$title        = ( ! empty( $post_title ) ) ? $post_title : esc_html__( '(no title)', 'ekommart' );
				?>
				<li>
					<div class="recent-posts-thumbnail">
						<a href="<?php the_permalink( $recent_post->ID ); ?>">
							<?php echo get_the_post_thumbnail( $recent_post->ID, 'ekommart-recent-post' ) ?>
						</a>
					</div>
					<div class="recent-posts-info">
						<a class="post-title" href="<?php the_permalink( $recent_post->ID ); ?>"<?php if ( get_queried_object_id() === $recent_post->ID ) { echo ' aria-current="page"'; } ?>><span><?php echo wp_kses_post($title); ?></span></a>
						<?php if ( $show_date ) : ?>
							<span class="post-date"><?php echo get_the_date( '', $recent_post->ID ); ?> &mdash;</span>
						<?php endif; ?>
						<?php
						$comments_number = get_comments_number_text( esc_html__( 'Leave a comment', 'ekommart' ), esc_html__( '1 Comment', 'ekommart' ), esc_html__( '% Comments', 'ekommart' ) );
						printf( // WPCS: XSS OK.
							'<span class="post-comments"><a href="%1$s">%2$s</a></span>',
							esc_url( get_comments_link() ),
							$comments_number
						);
						?>
					</div>

				</li>
			<?php endforeach; ?>
		</ul>
		<?php
		echo $args['after_widget']; // WPCS: XSS ok.
	}
}
