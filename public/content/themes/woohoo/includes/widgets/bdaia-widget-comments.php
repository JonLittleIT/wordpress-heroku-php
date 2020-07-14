<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class WOOHOO_WIDGET_RECENT_COMMENTS extends WP_Widget {
	function __construct() {
		parent::__construct (
			'bdaia-widget-comments', '.: Bdaia - Comments With Avatar',
			array( 'classname' => 'bdaia-widget-comments', 'description' => '' )
		);
	}

	public function widget( $args, $instance )
	{
		extract( $args );
		$avatar_size    = "55";
		$title          = $instance['title'];
		$num_posts      = $instance['num_posts'];

		echo '<div id="'.$args['widget_id'].'" class="widget bdaia-widget bdaia-widget-comments">';
		if ( ! empty( $title ) ) {
			echo '<h4 class="block-title"><span>' . esc_attr( $title ) . '</span></h4>'."\n";
		}
		echo'<div class="widget-inner">'."\n" ?>

			<?php
			$comments = get_comments( 'status=approve&number='.$num_posts );
			foreach ( $comments as $comment) { ?>
				<div class="bdaia-wb-comments">
					<div class="bdaia-wbc-inner">
						<div class="bdaia-wbc-avatar">
							<?php echo get_avatar( $comment, $avatar_size ); ?>
						</div>
						<div class="bdaia-wbc-comment">
							<h3 class="entry-title">
								<a href="<?php echo esc_url( get_permalink( $comment->comment_post_ID ) ); ?>#comment-<?php echo $comment->comment_ID; ?>">
									<span><?php echo esc_attr( strip_tags( $comment->comment_author ) ); ?>: <?php echo wp_html_excerpt( $comment->comment_content, 80 ); ?>...</span>
								</a>
							</h3>
						</div>
					</div>
				</div>
			<?php } ?>

		<?php
		echo $args['after_widget'];
	}

	public function form( $instance )
	{
		$title = $num_posts = "";
		if( isset( $instance['title'] ) ) $title = $instance['title'];
		if( isset( $instance['num_posts'] ) ) $num_posts = $instance['num_posts']; ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'num_posts' ); ?>">Limit post comments</label>
			<input id="<?php echo $this->get_field_id( 'num_posts' ); ?>" name="<?php echo $this->get_field_name( 'num_posts' ); ?>" value="<?php echo esc_attr( $num_posts ); ?>" class="widefat" type="text" />
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance )
	{
		$updated_instance['title']          = strip_tags( $new_instance['title']    );
		$updated_instance['num_posts']      = strip_tags( $new_instance['num_posts']);

		$updated_instance = $new_instance;
		return $updated_instance;
	}
}

function woohoo_widget_recent_comments(){
	register_widget( 'WOOHOO_WIDGET_RECENT_COMMENTS' );
}
add_action( 'widgets_init', 'woohoo_widget_recent_comments' );