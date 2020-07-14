<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class WOOHOO_WIDGET_FACEBOOK extends WP_Widget {

	function __construct() {
		parent::__construct (
			'bdaia-widget-facebook', '.: Bdaia - Facebook',
			array( 'classname' => 'bdaia-widget-facebook', 'description' => '' )
		);
	}

	public function widget( $args, $instance )
	{
		extract( $args );
		$title      = $instance['title'];
		$page_url 	= $instance['page_url'];
		$protocol 	= is_ssl() ? 'https' : 'http';

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo '<h4 class="block-title"><span>' . $title . '</span></h4>'."\n";
		}
		echo'<div class="widget-inner">'."\n" ?>
		<div class="bdaia-facebook-box">
            <iframe src="<?php echo $protocol; ?>://www.facebook.com/plugins/likebox.php?href=<?php echo $page_url ?>&amp;width=320&amp;height=250&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:250px;" allowTransparency="true"></iframe>
        </div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance )
	{
		$defaults = array(
			'title'     => '',
			'page_url'  => ''
			);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_url' ); ?>">Page URL</label>
			<input id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php echo $instance['page_url']; ?>" class="widefat" type="text" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_url'] = strip_tags( $new_instance['page_url'] );
		return $instance;
	}
}
function woohoo_widget_facebook(){
	register_widget( 'WOOHOO_WIDGET_FACEBOOK' );
}
add_action( 'widgets_init', 'woohoo_widget_facebook' );