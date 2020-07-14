<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class WOOHOO_WIDGET_E3 extends WP_Widget {
	function __construct() {
		parent::__construct (
			'bdaia-widget-e3', '.: Bdaia - Ads',
			array( 'classname' => 'bdaia-widget-e3', 'description' => '' )
		);
		add_action('admin_enqueue_scripts', array( $this, 'upload_scripts' ) );
	}

	public function upload_scripts()
	{
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
		wp_register_script( 'bdaia-upload-media', get_template_directory_uri().'/js/upload-media.js', array( 'jquery' ), false, false );
		wp_enqueue_script( 'bdaia-upload-media' );
		wp_enqueue_style( 'thickbox' );
	}

	public function widget( $args, $instance )
	{
		extract( $args );

		$title = $ad_image = $ad_image_url = $new_window = $nofollow = $ad_code = $trans_bg = "";

		if( isset( $instance['title'] )         ) $title          = $instance['title'];
		if( isset( $instance['image'] )         ) $ad_image       = $instance['image'];
		if( isset( $instance['ad_image_url'] )  ) $ad_image_url   = $instance['ad_image_url'];
		if( isset( $instance['new_window'] )    ) $new_window     = $instance['new_window'];
		if( isset( $instance['nofollow'] )      ) $nofollow       = $instance['nofollow'];
		if( isset( $instance['ad_code'] )       ) $ad_code        = $instance['ad_code'];
		if( isset( $instance['trans_bg'] )      ) $trans_bg       = $instance['trans_bg'];

		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window = "";

		if( $nofollow ) $nofollow='rel="nofollow"';
		else $nofollow = "";

		if( $trans_bg ) $trans_class = "e3-trans";
		else $trans_class = "";

		echo '<div id="'.$args['widget_id'].'" class="widget bdaia-widget bdaia-widget-e3 '.$trans_class.'">';
		if ( ! empty( $title ) ) {
			echo '<h4 class="block-title"><span>' . esc_attr( $title ) . '</span></h4>'."\n";
		}
		echo'<div class="widget-inner">'."\n";

		if( !empty( $ad_code ) )
		{
			echo '<div class="e3-inner">';
			echo do_shortcode( htmlspecialchars_decode(stripslashes( $ad_code ) ));
			echo '</div>';
		}
		elseif( !empty( $ad_image ) )
		{
			echo '<div class="e3-inner">';
			if( $ad_image_url ) echo '<a href="'. esc_url( $ad_image_url ) .'" '.$new_window, $nofollow.'>';
			echo '<img src="'. esc_url( $ad_image ) .'" alt="" />';
			if( $ad_image_url ) echo '</a>';
			echo '</div>';
		}

		echo $args['after_widget'];
	}

	public function form( $instance )
	{
		$title = $ad_image_url = $image = $new_window = $nofollow = $ad_code = $trans_bg = "";
		if( isset( $instance['title'] ) ) $title = $instance['title'];
		if( isset( $instance['ad_image_url'] ) ) $ad_image_url = $instance['ad_image_url'];
		if( isset( $instance['new_window'] ) ) $new_window = $instance['new_window'];
		if( isset( $instance['nofollow'] ) ) $nofollow = $instance['nofollow'];
		if( isset( $instance['ad_code'] ) ) $ad_code = $instance['ad_code'];
		if( isset( $instance['trans_bg'] ) ) $trans_bg = $instance['trans_bg'];
		if( isset( $instance['image'] ) ) $image = $instance['image']; ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat" type="text" />
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'trans_bg' ); ?>" name="<?php echo $this->get_field_name( 'trans_bg' ); ?>" value="true" <?php if( !empty( $trans_bg ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<label for="<?php echo $this->get_field_id( 'trans_bg' ); ?>">Background Transparent</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_name( 'image' ); ?>">Upload Ad Image</label>
			<input style="margin-bottom: 10px; clear: both" name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_url( $image ); ?>" />
			<input class="upload_image_button button button-primary" type="button" value="Upload Image" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ad_image_url' ); ?>">Ad Image URL</label>
			<input id="<?php echo $this->get_field_id( 'ad_image_url' ); ?>" name="<?php echo $this->get_field_name( 'ad_image_url' ); ?>" value="<?php echo esc_url( $ad_image_url ); ?>" class="widefat" type="text" />
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( !empty( $new_window ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window</label>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'nofollow' ); ?>" name="<?php echo $this->get_field_name( 'nofollow' ); ?>" value="true" <?php if( !empty( $nofollow ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<label for="<?php echo $this->get_field_id( 'nofollow' ); ?>">Nofollow</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ad_code' ); ?>">OR Adsense code</label>
			<textarea id="<?php echo $this->get_field_id( 'ad_code' ); ?>" name="<?php echo $this->get_field_name( 'ad_code' ); ?>" class="widefat" ><?php if( !empty( $ad_code ) ) echo stripcslashes( $ad_code ); ?></textarea>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance )
	{
		$updated_instance['title']          = strip_tags( $new_instance['title'] );
		$updated_instance['image']          = strip_tags( $new_instance['image'] );
		$updated_instance['ad_image_url']   = strip_tags( $new_instance['ad_image_url'] );
		$updated_instance['new_window']     = strip_tags( $new_instance['new_window'] );
		$updated_instance['ad_code']        = strip_tags( $new_instance['ad_code'] );
		$updated_instance['nofollow']       = strip_tags( $new_instance['nofollow'] );
		$updated_instance['trans_bg']       = strip_tags( $new_instance['trans_bg'] );

		$updated_instance = $new_instance;
		return $updated_instance;
	}
}
function woohoo_widget_e3(){
	register_widget( 'WOOHOO_WIDGET_E3' );
}
add_action( 'widgets_init', 'woohoo_widget_e3' );