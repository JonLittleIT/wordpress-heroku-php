<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

add_action('widgets_init', 'woohoo_widget_tweets');
function woohoo_widget_tweets() {
	register_widget('WOOHOO_WIDGET_TWEETS');
}

class WOOHOO_WIDGET_TWEETS extends WP_Widget
{
	function __construct()
	{
		parent::__construct(
			'bd-tweets', '.: Bdaia - Twitter',
			array( 'classname' => 'bd-tweets', 'description' => 'The most recent tweet' )
		);
	}

	function widget( $args, $instance )
	{
		extract( $args );
		$title              = apply_filters('widget_title', $instance['title'] );
		$count 		        = $instance['count'];
		$consumer_key 	    = woohoo_get_option( 'twitter_consumer_key' );
		$consumer_secret    = woohoo_get_option( 'twitter_consumer_secret' );
		$twitter_username 	= woohoo_get_option( 'twitter_username' );
		$widget_id 			= $args['widget_id'];
		$cacheTime			= 30;

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo '<h4 class="block-title"><span><a href="http://twitter.com/'. $twitter_username .'" target="_blank">'.$title.'</a></span></h4>'."\n";
		}

		echo'<div class="widget-inner">'."\n";
		echo '<ul class="tweet_list">';

		if( !empty($twitter_username) && !empty($consumer_key) && !empty($consumer_secret) )
		{
			$token 			= get_option( 'woohoo_TwitterToken'.$widget_id );
			$twitter_data 	= get_transient( 'list_tweets'.$widget_id );

			if( empty( $twitter_data ) )
			{

				if( !$token )
				{
					// preparing credentials
					$credentials = $consumer_key . ':' . $consumer_secret;
					$toSend = @base64_encode($credentials);

					// http post arguments
					$args = array(
						'method' 		=> 'POST',
						'httpversion' 	=> '1.1',
						'blocking' 		=> true,
						'headers' 		=> array(
							'Authorization' => 'Basic ' . $toSend,
							'Content-Type' 	=> 'application/x-www-form-urlencoded;charset=UTF-8'
						),
						'body' => array( 'grant_type' => 'client_credentials' )
					);

					add_filter('https_ssl_verify', '__return_false');
					$response 	= wp_remote_post('https://api.twitter.com/oauth2/token', $args);
					$keys 		= json_decode(wp_remote_retrieve_body($response));

					if($keys)
					{
						// saving token to wp_options table
						update_option( 'woohoo_TwitterToken'.$widget_id , $keys->access_token);
						$token = $keys->access_token;
					}
				}

				// we have bearer token wether we obtained it from API or from options
				$args = array(
					'httpversion' 	=> '1.1',
					'blocking' 		=> true,
					'headers' 		=> array(
						'Authorization' => "Bearer $token"
					)
				);

				add_filter('https_ssl_verify', '__return_false');
				$api_url 	= "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$twitter_username&count=$count";
				$response 	= wp_remote_get($api_url, $args);

				if (!is_wp_error($response)) {
					$twitter_data = json_decode(wp_remote_retrieve_body($response));
					set_transient( 'list_tweets'.$widget_id  , $twitter_data, 60 * $cacheTime);
				}
			}

			if( is_array( $twitter_data ) )
			{
				$i=0;
				$hyperlinks 	= true;
				$twitter_users 	= true;
				$update 		= true;
				foreach( $twitter_data as $item )
				{
					$msg 		= $item->text;
					$permalink 	= 'http://twitter.com/#!/'. $twitter_username .'/status/'. $item->id_str;
					$link 		= $permalink;

					echo '<li class="twitter-item"><p><span class="bdaia-io bdaia-io-twitter"></span>';
					if ($hyperlinks){    $msg = $this->hyperlinks($msg); }
					if ($twitter_users){ $msg = $this->twitter_users($msg); }
					echo $msg;

					if( $update )
					{
						$time = strtotime($item->created_at);
						if ( ( abs( time() - $time) ) < 86400 ){
							$h_time = sprintf( '%s', human_time_diff( $time ) );

						}

						else{
							$h_time = date( 'Y/m/d' , $time);
						}
						echo '<small class="jtwt_date"><abbr title="' . date( 'Y/m/d H:i:s' , $time ) . '">' . $h_time . '</abbr></small>';
					}
					echo '</p></li>';

					$i++;
					if ( $i >= $count ) break;
				}
			}
		}
		echo '</ul>';
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance )
	{
		$id = explode("-", $this->get_field_id("widget_id"));
		$widget_id =  $id[1] . "-" . $id[2];
		$instance 						= $old_instance;
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['count'] 		= strip_tags( $new_instance['count'] );

		delete_option('woohoo_TwitterToken'.$widget_id);
		delete_transient('list_tweets'.$widget_id);
		return $instance;
	}

	function form( $instance )
	{
		$defaults = array(
			'title' => '@Follow Me',
			'count' => 3
		);

		$instance = wp_parse_args((array) $instance, $defaults);
		$consumer_key 			= woohoo_get_option( 'twitter_consumer_key' );
		$consumer_secret 		= woohoo_get_option( 'twitter_consumer_secret' );
		$twitter_username 			= woohoo_get_option( 'twitter_username' );

		if( empty( $twitter_username ) && empty( $consumer_key ) && empty( $consumer_secret ) ) {
			echo '<p style="display:block; padding: 5px; font-weight:bold; clear:both; color: #990000;">Error : Setup Twitter API settings Go to Theme panel > Twitter API</p>';
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">Number of Tweets</label>
			<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>" />
		</p>
		<?php
	}

	private function hyperlinks($text)
	{
		$text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
		$text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
		// match name@address
		$text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
		//mach #trendingtopics. Props to Michael Voigt
		$text = preg_replace('/([\.|\,|\:|\?|\?|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
		return $text;
	}

	private function twitter_users($text)
	{
		$text = preg_replace('/([\.|\,|\:|\?|\?|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
		return $text;
	}
}