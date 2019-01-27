<?php

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


/* ========= TWEETS ===================================== */
if (is_plugin_active('modeltheme-framework/modeltheme-framework.php') && is_plugin_active('redux-framework/redux-framework.php')){
	class MT_Tweets_Widget extends WP_Widget {



	    function __construct() {
	        parent::__construct('MT_Tweets_Widget', esc_attr__('MT - Recent Tweets', 'modeltheme'),array( 'description' => esc_attr__( 'Recent tweets widget', 'modeltheme' ), ) );
	    }


	    public function widget( $args, $instance ) {
	        $recent_tweets_pol_title = esc_attr( $instance[ 'recent_tweets_pol_title' ] );
	        $recent_tweets_pol_number = esc_attr( $instance[ 'mt_tweets_number' ] );
	        echo  $args['before_widget'];

	        global $smartowl_redux;
	        global $plugin_dir;

	        include_once( $plugin_dir . 'inc/shortcodes/mt-tweets/twitter/twitteroauth/twitteroauth.php' );

	        # Get Theme Options Twitter Details
	        $tw_username            = $smartowl_redux['mt_social_tw'];
	        $consumer_key           = $smartowl_redux['mt_tw_consumer_key'];
	        $consumer_secret        = $smartowl_redux['mt_tw_consumer_secret'];
	        $access_token           = $smartowl_redux['mt_tw_access_token'];
	        $access_token_secret    = $smartowl_redux['mt_tw_access_token_secret'];
	        $no = $recent_tweets_pol_number+1;
	        # Create the connection
	        $twitter = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
	        # Migrate over to SSL/TLS
	        $twitter->ssl_verifypeer = true;
	        # Load the Tweets
	        $tweets = $twitter->get('statuses/user_timeline', array('screen_name' => $tw_username, 'exclude_replies' => 'true', 'include_rts' => 'false', 'count' => $no));
	        if(!empty($tweets)) {


	            echo '<h3 class="widget-title">'. $recent_tweets_pol_title.'</h3>';
	            echo '<div class="tweets">';

	                foreach($tweets as $tweet) {

	                    //print_r($tweet);

	                    # Access as an object
	                    $tweetText = $tweet->text;
	                    $created_at = $tweet->created_at;

	                    $tweet_link = preg_match("/(http:\/\/|(www.))(([^s<]{4,68})[^s<]*)/", $tweetText, $matches);

	                    # Make links active
	                    $tweetText = preg_replace("/(http:\/\/|(www.))(([^s<]{4,68})[^s<]*)/", '', $tweetText);
	                    # Linkify user mentions
	                    $tweetText = preg_replace("/@(w+)/", '', $tweetText);
	                    # Linkify tags
	                    $tweetText = preg_replace("/#(w+)/", '', $tweetText);

	                    echo '<div class="tweet">';
	                        echo '<div class="tweet-title">';
	                            echo '<div class="rotate45 col-md-2">';
	                                echo '<i class="fa fa-twitter rotate45_back"></i>';
	                            echo '</div>';
	                            echo '<div class="col-md-10 tweeter-profile">@'.$tw_username.'</div>';
	                        echo '</div>';
	                        echo '<div class="clearfix"></div>';
	                        echo '<div class="tweet-body">'.$tweetText.'</div>';
	                        echo '<div class="tweet-date">'.twitter_time($created_at).'</div>';
	                    echo '</div>';

	                }

	            echo '</div>';
	        }
	        echo  $args['after_widget'];
	    }


	    public function form( $instance ) {

	        if ( isset( $instance[ 'recent_tweets_pol_title' ] ) ) {
	            $recent_tweets_pol_title = esc_attr( $instance[ 'recent_tweets_pol_title' ] );
	        }
	        else {
	            $recent_tweets_pol_title = esc_attr__( 'Recent Tweets', 'modeltheme' );
	        }

	        if ( isset( $instance[ 'mt_tweets_number' ] ) ) {
	            $recent_tweets_pol_number = esc_attr( $instance[ 'mt_tweets_number' ] );
	        }
	        else {
	            $recent_tweets_pol_number = 2;
	        }

	        ?>
	        <p>
	            <label for="<?php echo esc_attr($this->get_field_id( 'recent_tweets_pol_title' )); ?>"><?php esc_attr_e( 'Widget title:','modeltheme' ); ?></label> 
	            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'recent_tweets_pol_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'recent_tweets_pol_title' )); ?>" type="text" value="<?php echo esc_attr( $recent_tweets_pol_title ); ?>">
	        </p>
	        <p>
	            <label for="<?php echo esc_attr($this->get_field_id( 'mt_tweets_number' )); ?>"><?php esc_attr_e( 'Tweets number:','modeltheme' ); ?></label> 
	            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'mt_tweets_number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'mt_tweets_number' )); ?>" type="text" value="<?php echo esc_attr( $recent_tweets_pol_number ); ?>">
	        </p>
	        <?php 
	    }


	    public function update( $new_instance, $old_instance ) {
	        $instance = array();
	        $instance['recent_tweets_pol_title'] = ( ! empty( $new_instance['recent_tweets_pol_title'] ) ) ?  $new_instance['recent_tweets_pol_title']  : '';
	        $instance['mt_tweets_number'] = ( ! empty( $new_instance['mt_tweets_number'] ) ) ?  $new_instance['mt_tweets_number']  : 2;
	        return $instance;
	    }

	} 


	// Register Widgets
	function register_widgets() {
	    register_widget( 'MT_Tweets_Widget' );

	}
	add_action( 'widgets_init', 'register_widgets' );
}
?>