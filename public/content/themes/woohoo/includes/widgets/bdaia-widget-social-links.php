<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class WOOHOO_WIDGET_SOCIAL_MEIDA extends WP_Widget
{
	function __construct() {
		parent::__construct (
			'bdaia-social-links', '.: Bdaia - Social Links',
			array( 'classname' => 'bdaia-social-links', 'description' => '' )
		);
	}

	public function widget( $args, $instance )
	{
		extract( $args );
		$title = $instance['title'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo '<h4 class="block-title"><span>' . $title . '</span></h4>'."\n";
		}
		echo'<div class="widget-inner">'."\n" ?>
			<div class="widget-social-links bdaia-social-io-colored">
				<?php echo woohoo_social( 'yes', 35, 'none' ); ?>
			</div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance )
	{
		$defaults = array('title' => 'Follow Me');
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}
}
function woohoo_widget_social_media(){
	register_widget( 'WOOHOO_WIDGET_SOCIAL_MEIDA' );
}
add_action( 'widgets_init', 'woohoo_widget_social_media' );