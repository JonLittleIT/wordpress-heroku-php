<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class WOOHOO_WIDGET_LOGIN extends WP_Widget {

	function __construct() {
		parent::__construct (
			'bd-login', '.: Bdaia - Login',
			array( 'classname' => 'bd-login', 'description' => '' )
		);
	}

	function widget( $args, $instance )
	{
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo '<h4 class="block-title"><span>' . $title . '</span></h4>'."\n";
		}
		echo'<div class="widget-inner">'."\n";

		woohoo_login_form();

		echo $args['after_widget'];
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}
	function form( $instance ) {
		$defaults = array( 'title' => woohoo__tr( 'Login'  ));
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<?php
	}

}
function woohoo_widget_login() {
	register_widget( 'WOOHOO_WIDGET_LOGIN' );
}
add_action( 'widgets_init', 'woohoo_widget_login' );