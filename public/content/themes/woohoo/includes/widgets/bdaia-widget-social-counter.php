<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class WOOHOO_SOCIAL_COUNTER
{
	private $allow_cash;
	private $moeny_format;

	function __construct() { /* nothing */ }

	public function woohoo_socail_counter()
	{
		$this->allow_cash   = true; // Disable it for disable cashing sys
		$this->moeny_format = true; // Allow comma in number
	}

	private function formatMoney($number, $fractional=false)
	{

		if( !is_numeric( $number ) ) return $number ;

		if($number >= 1000000)
			return round( ($number/1000)/1000 , 1) . " M";

        elseif($number >= 100000)
			return round( $number/1000, 0) . " k";

		else
			return @number_format( $number );
	}

	public function get_posts_count() {
		$count_posts 	= wp_count_posts();
		return $result 	= $count_posts->publish ;
	}

	public function get_comments_count() {
		$comments_count = wp_count_comments() ;
		return $result  = $comments_count->approved ;
	}

	public function get_members_count() {
		$members_count  = count_users() ;
		return $result  = $members_count['total_users'] ;
	}


    public function get_the_number( $pattern, $the_request ) {

		$counter = 0;

		preg_match( $pattern, $the_request, $matches );

		if ( is_array( $matches ) && ! empty( $matches[1] ) ) {

			$number  = strip_tags( $matches[1] );
			$counter = '';

			foreach ( str_split( $number ) as $char ) {
				if ( is_numeric( $char ) ){
					$counter .= $char;
				}
			}
		}

		return $counter;
	}

	public function get_twitter_count ( $id, $token )
	{
		if( $id != '' )
		{
			if( $this->allow_cash == true ){
				$social_cash = get_transient('bdaia_transient_twitter');

				if($social_cash != '' and !empty( $social_cash ) ){
					return($social_cash);
				}
			}

			$consumerKey 		= woohoo_get_option('twitter_consumer_key');
			$consumerSecret 	= woohoo_get_option('twitter_consumer_secret');
			$token 				= get_option( 'woohoo_twitter_token' );

			// getting new auth bearer only if we don't have one
			if( ! $token )
			{
				// preparing credentials
				$credentials 	= $consumerKey . ':' . $consumerSecret;
				$toSend 		= @base64_encode($credentials);

				// http post arguments
				$args = array(
					'method' 		=> 'POST',
					'httpversion' 	=> '1.1',
					'blocking' 		=> true,
					'headers'		=> array(
						'Authorization'	=> 'Basic ' . $toSend,
						'Content-Type' 	=> 'application/x-www-form-urlencoded;charset=UTF-8'
					),
					'body' 			=> array( 'grant_type' => 'client_credentials' )
				);

				add_filter('https_ssl_verify', '__return_false');
				$response   = wp_remote_post('https://api.twitter.com/oauth2/token', $args);
				$keys       = json_decode(wp_remote_retrieve_body($response));

				if($keys) {
					// saving token to wp_options table
					update_option('woohoo_twitter_token', $keys->access_token);
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
			$api_url 	= "https://api.twitter.com/1.1/users/show.json?screen_name=$id";
			$response 	= wp_remote_get($api_url, $args);

			if ( ! is_wp_error( $response ) ) {
				$followers 	= json_decode(wp_remote_retrieve_body($response));
				$result 	= $followers->followers_count;
			}
			else {
				$result = 0;
			}
			if( $this->allow_cash == true ){
				set_transient('bdaia_transient_twitter',$this->formatMoney($result),12*60*60);
			}
			return($this->formatMoney($result));
		}
		else {
			return(0);
		}
	}

	## Facebook Fans -------------------------(^.^)
	public function get_facebook_count( $fan_page )
	{
		if ( $fan_page != '' )
		{
			if ( $this->allow_cash == true )
			{
				$social_cash = get_transient('bdayh_soical_facebook' );

				if ( $social_cash != '' and !empty( $social_cash ) ) {
					return( $social_cash );
				}
			}

			$get_request = wp_remote_get( "https://www.facebook.com/plugins/likebox.php?href=https://facebook.com/$fan_page&show_faces=true&header=false&stream=false&show_border=false&locale=en_US", array( 'timeout' => 20 ) );
			$the_request = wp_remote_retrieve_body( $get_request );

			$pattern = '/_1drq[^>]+>(.*?)<\/a/s';
			$result = $this->get_the_number( $pattern, $the_request );


			if ( $this->allow_cash == true ) {
				set_transient('bdayh_soical_facebook',$this->formatMoney($result),12*60*60);
			}

			return( $this->formatMoney( $result ) );
		}
		else {
			return 0;
		}
	}

	## Instagram Followers -------------------------(^.^)
	public function get_instgram_count( $id )
	{
		if($id != '')
		{
			if($this->allow_cash == true) {
				$social_cash = get_transient('woohoo_instgram_count_trans');
				if($social_cash != '' and !empty($social_cash)){
					return($social_cash);
				}
			}

			try {

				// Make a new connection
				$api_url = 'https://www.instagram.com/'. $id;
				$request = wp_remote_get( $api_url, array( 'timeout' => 10 ) );

				// Error
				if( empty( $request ) || is_wp_error( $request ) ){
					return;
				}

				// Get the data from the HTNL
				$data = wp_remote_retrieve_body( $request );
				$pattern = '/window\._sharedData = (.*);<\/script>/';
				preg_match( $pattern, $data, $matches );

				// Is the json data available?
				if ( ! empty( $matches[1] ) ){

					// Check if there is an error with the JSON decoding
					$instagram_data = json_decode( $matches[1], true );

					if( ! empty( $instagram_data['entry_data']['ProfilePage'][0]['graphql']['user']['edge_followed_by']['count'] ) ){
						$result = $instagram_data['entry_data']['ProfilePage'][0]['graphql']['user']['edge_followed_by']['count'];
					}
				}

			} catch (Exception $e) {
				$result = 0;
			}


			if($this->allow_cash == true){
				set_transient('woohoo_instgram_count_trans',$this->formatMoney($result),12*60*60);
			}
			return($this->formatMoney($result));
		}
		else {
			return 0;
		}
	}


	## Youtube Subscribers -------------------------(^.^)
	public function get_youtube_count( $channel_name, $api_key, $youtube_type )
	{
		if ($channel_name != '' and $api_key != '')
		{

			if ($this->allow_cash == true) {
				$social_cash = get_transient('bdayh_soical_youtube');
				if ($social_cash != '' and !empty($social_cash) ){
					return ($social_cash);
				}
			}

			if( $youtube_type == 'user' ){
				$data = @woohoo_get_remote("https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=$channel_name&key=$api_key");
			}
			else{
				$data = @woohoo_get_remote("https://www.googleapis.com/youtube/v3/channels?part=statistics&id=$channel_name&key=$api_key");
			}
			$result = (int) $data['items'][0]['statistics']['subscriberCount'];

			if ($this->allow_cash == true) {
				set_transient('bdayh_soical_youtube', $this->formatMoney($result), 12*60*60);
			}
			return ($this->formatMoney($result));
		}
		else {
			return (0);
		}
	}


	/* Dribbble Followers */
	public function get_dribbble_count( $drbl_un, $access_token ) {

		if( $drbl_un !=''  ) {

			if ($this->allow_cash == true) {
				$social_cash = get_transient('bdayh_soical_dribbble');
				if ($social_cash != '' and !empty($social_cash)) {
					return ($social_cash);
				}
			}

			$data 	= @woohoo_get_remote("https://api.dribbble.com/v1/users/$drbl_un/?access_token=$access_token");
			$result = (int) $data['followers_count'];

			if ($this->allow_cash == true) {
				set_transient('bdayh_soical_dribbble', $this->formatMoney($result), 12*60*60);
			}
			return ($this->formatMoney($result));

		} else {
			return(0);
		}
	}

	public function get_forrst_count( $id ) {

		if( $id !=''  ) {

			if ($this->allow_cash == true) {
				$social_cash = get_transient('bdayh_soical_forrst');
				if ($social_cash != '' and !empty($social_cash)) {
					return ($social_cash);
				}
			}

			$data = @woohoo_get_remote( "http://forrst.com/api/v2/users/info?username=$id" );
			$result = (int) $data['resp']['typecast_followers'];

			if ($this->allow_cash == true) {
				set_transient('bdayh_soical_forrst', $this->formatMoney($result), 12*60*60);
			}
			return ($this->formatMoney($result));

		} else {
			return(0);
		}
	}

	/* Delicious Followers */
	public function get_delicious_count( $id ) {

		if( $id !=''  ) {

			if ($this->allow_cash == true) {
				$social_cash = get_transient('bdayh_soical_delicious');
				if ($social_cash != '' and !empty($social_cash)) {
					return ($social_cash);
				}
			}

			$data = @woohoo_get_remote("http://feeds.delicious.com/v2/json/userinfo/$id");
			$result = (int) $data[2]['n'];

			if ($this->allow_cash == true) {
				set_transient('bdayh_soical_delicious', $this->formatMoney($result), 12*60*60);
			}
			return ($this->formatMoney($result));

		} else {
			return(0);
		}
	}


	## Vimeo Subscribers -------------------------(^.^)
	public function get_vimo_count($channel_name)
	{
		if($channel_name != '')
		{
			if($this->allow_cash == true)
			{
				$social_cash = get_transient('bdayh_soical_vimo');
				if($social_cash != '' and !empty($social_cash))
				{
					return($social_cash);
				}
			}
			$data = @woohoo_get_remote( "http://vimeo.com/api/v2/channel/$channel_name/info.json" );
			$result = (int) $data['total_subscribers'];
			if ($result <= 0) return 0;
			if($this->allow_cash == true){
				set_transient('bdayh_soical_vimo',$this->formatMoney($result), 12*60*60);
			}
			return($this->formatMoney($result));
		}
		return 0;
	}

	## SoundCloud Followers -------------------------(^.^)
	public function get_soundcloud_count( $channel_name,$api )
	{

		if($channel_name != ''){

			if($this->allow_cash == true){
				$social_cash = get_transient('bdayh_soical_soundcloud');

				if($social_cash != '' and !empty($social_cash)){
					return($social_cash);
				}
			}

			$data = @woohoo_get_remote("http://api.soundcloud.com/users/$channel_name.json?consumer_key=$api");
			$result = (int) $data['followers_count'];

			if($this->allow_cash == true){
				set_transient('bdayh_soical_soundcloud',$this->formatMoney($result), 12*60*60);
			}
			return($this->formatMoney($result));

		} else { return 0; }
	}

	## vk Followers --- --- --- --- ---
	public function woohoo_get_vk_count( $id )
	{
		if( $id != '' )
		{
			if( $this->allow_cash == true )
			{
				$social_cash = get_transient('woohoo_vk_count_trans');
				if( $social_cash != '' and !empty( $social_cash ) ) return( $social_cash );
			}

			try {
				$data 	= @woohoo_get_remote( "http://api.vk.com/method/groups.getById?gid=$id&fields=members_count");
				$result = (int) $data['response'][0]['members_count'];
			} catch (Exception $e) {
				$result = 0;
			}

			if( $this->allow_cash == true )
			{
				set_transient( 'woohoo_vk_count_trans', $this->formatMoney( $result ), 12*60*60 );
			}
			return( $this->formatMoney( $result ) );
		}
		else {
			return(0);
		}
	}

	## envato Followers --- --- --- --- ---
	public function woohoo_get_envato_count( $id )
	{
		if( $id != '' )
		{
			if( $this->allow_cash == true )
			{
				$social_cash = get_transient('woohoo_envato_count_trans');
				if( $social_cash != '' and !empty( $social_cash ) ) return( $social_cash );
			}

			try {
				$data 	= @woohoo_get_remote("http://marketplace.envato.com/api/edge/user:$id.json");
				$result = (int) $data['user']['followers'];
			} catch (Exception $e) {
				$result = 0;
			}

			if( $this->allow_cash == true )
			{
				set_transient( 'woohoo_envato_count_trans', $this->formatMoney( $result ), 12*60*60 );
			}
			return( $this->formatMoney( $result ) );
		}
		else {
			return(0);
		}
	}


	static function remote_get( $url, $json = true, $args = array( 'sslverify' => false ) ){

		$get_request = preg_replace( '/\s+/', '', $url );
		$get_request = wp_remote_get( $url, $args );
		$the_request = wp_remote_retrieve_body( $get_request );

		if( $json ){
			$the_request = @json_decode( $the_request, true );
		}

		return $the_request;
	}
}

function woohoo_get_remote( $url , $json = true) {
	$get_request 	= wp_remote_get( $url , array( 'timeout' => 18 , 'sslverify' => false ) );
	$request 		= wp_remote_retrieve_body( $get_request );
	if( $json ) $request = @json_decode( $request , true );
	return $request;
}


class WOOHOO_WIDGET_SOCIAL_COUNTER extends WP_Widget
{
	function __construct()
	{
		parent::__construct
		(
		// Base ID of your widget
			'bdaia-widget-counter',

			// Widget name will appear in UI
			'.: Bdaia - Social Counter',

			// Widget description
			array( 'classname' => 'bdaia-widget-counter', 'description' => '' )
		);
	}

	public function widget( $args, $instance )
	{
		extract( $args );
		$title                      = $instance['title'];
		$count                      = new WOOHOO_SOCIAL_COUNTER();
		$rssurl                     = $instance['rssurl'];
		$drbl_un                    = $instance['drbl_un'];
		$access_token               = $instance['access_token'];
		$forrst_id                  = $instance['forrst_id'];
		$delicious                  = $instance['delicious'];
		$facebookn                  = $instance['facebookn'];
		$fb_access_token            = $instance['fb_access_token'];
		$gplusn                     = $instance['gplusn'];
		$gplusn_api                 = $instance['gplusn_api'];
		$youtubeun                  = $instance['youtubeun'];
		$youtube_api_key            = $instance['youtube_api_key'];
		$vimocn                     = $instance['vimocn'];
		$soundcloudun               = $instance['soundcloudun'];
		$socialstyle                = $instance['socialstyle'];
		$youtube_type               = $instance['youtube_type'];
		$instgram                   = $instance['instgram'];
		$instgram_token             = $instance['instgram_token'];
		$soundcloud_api             = $instance['soundcloud_api'];
		$get_posts_count            = $instance['get_posts_count'];
		$get_comments_count         = $instance['get_comments_count'];
		$get_members_count          = $instance['get_members_count'];
		$twitter_count              = $instance['twitter'];

		## vk.com --- --- --- --- ---
		$woohoo_get_vk_count                    = !empty( $instance['woohoo_get_vk_count'] );
		$social_count['woohoo_get_vk_count'] 	= $count->woohoo_get_vk_count( $woohoo_get_vk_count );

		## envato --- --- --- --- ---
		$woohoo_get_envato_count                 = !empty( $instance['woohoo_get_envato_count'] );
		$woohoo_get_envato_site                  = !empty( $instance['woohoo_get_envato_site'] );
		$social_count['woohoo_get_envato_count'] = $count->woohoo_get_envato_count( $woohoo_get_envato_count );

		$social_count['get_posts_count'] 	= $count->get_posts_count();
		$social_count['get_comments_count'] = $count->get_comments_count();
		$social_count['get_members_count'] 	= $count->get_members_count();

		$social_count['dribbble'] 	    = $count->get_dribbble_count( $drbl_un, $access_token );
		$social_count['forrst'] 	    = $count->get_forrst_count( $forrst_id );
		$social_count['delicious'] 	    = $count->get_delicious_count( $delicious );
		$social_count['facebook'] 	    = $count->get_facebook_count( $facebookn );

		$social_count['instgram'] 	    = $count->get_instgram_count( $instgram );
		$social_count['youtube'] 	    = $count->get_youtube_count( $youtubeun,$youtube_api_key, $youtube_type );
		$social_count['vimo'] 		    = $count->get_vimo_count( $vimocn );
		$social_count['soundcloud']     = $count->get_soundcloud_count( $soundcloudun, $soundcloud_api );

		/* Twitter */
		$bdaia_twitter_user			    = woohoo_get_option('twitter_username');
		$bdaia_twitter_token            = woohoo_get_option('twitter_access_token');
		$social_count['bdaia_twitter']  = $count->get_twitter_count( $bdaia_twitter_user, $bdaia_twitter_token );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo '<h4 class="block-title"><span>' . $title . '</span></h4>'."\n";
		}
		echo'<div class="widget-inner">'."\n" ?>

        <div class="bdaia-wc-inner bdaia-wc-<?php echo $instance['socialstyle']; ?>">
            <ul class="social-counter-widget">
				<?php
				/**
				 * Facebook
				 */
				if (trim($facebookn) != '') {
					echo '<li class="social-counter-facebook"><a href="http://www.facebook.com/'.$facebookn.'" target="_blank"><span class="bdaia-io bdaia-io-facebook"></span><span class="sc-num">'.$social_count['facebook'].'</span><small>'. woohoo__tr('Fans') .'</small></a></li> ';
				}
				/**
				 * Twitter
				 */
				if (trim($twitter_count) != '') {
					echo '<li class="social-counter-twitter"><a href="http://twitter.com/'.$bdaia_twitter_user.'" target="_blank"><span class="bdaia-io bdaia-io-twitter"></span><span class="sc-num">'. $social_count['bdaia_twitter'] .'</span><small>'. woohoo__tr('Followers') .'</small></a></li> ';
				}


				/**
				 * Youtube
				 */
				if (trim($youtubeun) != '') {

					$type = 'user';
					if( !empty($instance['youtube_type']) && $instance['youtube_type'] == 'channel' ) $type = 'channel';

					echo '<li class="social-counter-youtube"><a href="http://www.youtube.com/'.$type.'/'.$youtubeun.'" target="_blank"><span class="bdaia-io bdaia-io-youtube"></span><span class="sc-num">'.$social_count['youtube'].'</span><small>'. woohoo__tr('Subscribers') .'</small></a></li> ';
				}
				/**
				 * Vimeo
				 */
				if (trim($vimocn) != '') {
					echo '<li class="social-counter-vimo"><a href="http://vimeo.com/channels/'.$vimocn.'" target="_blank"><span class="bdaia-io bdaia-io-vimeo"></span><span class="sc-num">'.$social_count['vimo'].'</span><small>'. woohoo__tr('Subscribers') .'</small></a></li> ';
				}
				/**
				 * Souncloud
				 */
				if (trim($soundcloudun) != '') {
					echo '<li class="social-counter-soundcloud"><a href="http://soundcloud.com/'.$soundcloudun.'" target="_blank"><span class="bdaia-io bdaia-io-soundcloud"></span><span class="sc-num">'.$social_count['soundcloud'].'</span><small>'. woohoo__tr('Followers') .'</small></a></li> ';
				}

				/**
				 * Instgram
				 */
				if (trim($instgram) != '') {
					echo '<li class="social-counter-instgram"><a href="http://instagram.com/'.$instgram.'" target="_blank"><span class="bdaia-io bdaia-io-instagram"></span><span class="sc-num">'.$social_count['instgram'].'</span><small>'. woohoo__tr('Followers') .'</small></a></li> ';
				}

				/**
				 * dribbble
				 */
				if (trim($drbl_un) != '') {
					echo '<li class="social-counter-dribbble"><a href="http://dribbble.com/'.$drbl_un.'" target="_blank"><span class="bdaia-io bdaia-io-dribbble"></span><span class="sc-num">'.$social_count['dribbble'].'</span><small>'. woohoo__tr('Followers') .'</small></a></li> ';
				}

				/**
				 * forrst
				 */
				if (trim($forrst_id) != '') {
					echo '<li class="social-counter-forrst"><a href="http://forrst.com/people/'.$forrst_id.'" target="_blank"><span class="bdaia-io bdaia-io-forrst"></span><span class="sc-num">'.$social_count['forrst'].'</span><small>'. woohoo__tr('Followers') .'</small></a></li>';
				}

				## vk.com --- --- --- --- ---
				if( trim( $woohoo_get_vk_count ) != '') {
					echo '<li class="social-counter-vk"><a href="http://vk.com/'.$woohoo_get_vk_count.'" target="_blank"><span class="bdaia-io bdaia-io-vk"></span><span class="sc-num">'. $social_count['woohoo_get_vk_count'] .'</span><small>'. woohoo__tr('Members') .'</small></a></li>';
				}

				## envato --- --- --- --- ---
				if( trim( $woohoo_get_envato_count ) != '') {
					echo '<li class="social-counter-envato"><a href="http://'. $woohoo_get_envato_site .'.net/user/'.$woohoo_get_envato_count.'" target="_blank"><span class="bdaia-io bdaia-io-envato"></span><span class="sc-num">'. $social_count['woohoo_get_envato_count'] .'</span><small>'. woohoo__tr('Members') .'</small></a></li>';
				}

				## Post count --- --- --- --- ---
				if( trim($get_posts_count) !='' )
				{
					echo '<li class="social-counter-posts"><a><span class="bdaia-io bdaia-io-file-text2"></span><span class="sc-num">'.$social_count['get_posts_count'].'</span><small>'. woohoo__tr('Posts') .'</small></a></li> ';
				}

				/**
				 * $get_comments_count
				 */
				if( trim($get_comments_count) !='' ){
					echo '<li class="social-counter-comments"><a><span class="bdaia-io bdaia-io-bubbles4"></span><span class="sc-num">'.$social_count['get_comments_count'].'</span><small>'. woohoo__tr('Comments') .'</small></a></li> ';
				}

				/**
				 * $get_members_count
				 */
				if( trim($get_members_count) !='' ){
					echo '<li class="social-counter-members"><a><span class="bdaia-io bdaia-io-user"></span><span class="sc-num">'.$social_count['get_members_count'].'</span><small>'. woohoo__tr('Members') .'</small></a></li> ';
				}
				?>
            </ul>
        </div> <!-- End Social Counter/-->
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance )
	{
		$defaults = array('title' => 'Stay Connected');
		$instance = wp_parse_args((array) $instance, $defaults);
		?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'socialstyle' ); ?>">Style</label>
            <select id="<?php echo $this->get_field_id( 'socialstyle' ); ?>" name="<?php echo $this->get_field_name( 'socialstyle' ); ?>" class="widefat">
                <option <?php if ( !empty( $instance['socialstyle'] ) && 'style1' == $instance['socialstyle'] ) echo 'selected="selected"'; ?> value="style1">style1</option>
                <option <?php if ( !empty( $instance['socialstyle'] ) && 'style2' == $instance['socialstyle'] ) echo 'selected="selected"'; ?> value="style2">style2</option>
                <option <?php if ( !empty( $instance['socialstyle'] ) && 'style3' == $instance['socialstyle'] ) echo 'selected="selected"'; ?> value="style3">style3</option>
                <option <?php if ( !empty( $instance['socialstyle'] ) && 'style4' == $instance['socialstyle'] ) echo 'selected="selected"'; ?> value="style4">style4</option>
                <option <?php if ( !empty( $instance['socialstyle'] ) && 'style5' == $instance['socialstyle'] ) echo 'selected="selected"'; ?> value="style5">style5</option>
            </select>
        </p>

        <div class="bdayh-sc bdayh-sc-posts">
            <h3>Posts counter</h3>
            <p>
                <input id="<?php echo $this->get_field_id( 'get_posts_count' ); ?>" name="<?php echo $this->get_field_name( 'get_posts_count' ); ?>"  value="true" <?php if( !empty( $instance['get_posts_count'] ) && $instance['get_posts_count'] ) echo 'checked="checked"'; ?> type="checkbox"  />
            </p>
        </div><!-- .bdayh-sc-posts /-->

        <div class="bdayh-sc bdayh-sc-comments">
            <h3>Comments counter</h3>
            <p>
                <input id="<?php echo $this->get_field_id( 'get_comments_count' ); ?>" name="<?php echo $this->get_field_name( 'get_comments_count' ); ?>"  value="true" <?php if( !empty( $instance['get_comments_count'] ) && $instance['get_comments_count'] ) echo 'checked="checked"'; ?> type="checkbox"  />
            </p>
        </div><!-- .bdayh-sc-comments /-->

        <div class="bdayh-sc bdayh-sc-members">
            <h3>Members counter</h3>
            <p>
                <input id="<?php echo $this->get_field_id( 'get_members_count' ); ?>" name="<?php echo $this->get_field_name( 'get_members_count' ); ?>"  value="true" <?php if( !empty( $instance['get_members_count'] ) && $instance['get_members_count'] ) echo 'checked="checked"'; ?> type="checkbox"  />
            </p>
        </div><!-- .bdayh-sc-members /-->

        <div class="bdayh-sc bdayh-sc-twitter">
            <h3>Twitter</h3>
			<?php
			$consumer_key 			= woohoo_get_option('twitter_consumer_key');
			$consumer_secret 		= woohoo_get_option('twitter_consumer_secret');
			$twitter_id 			= woohoo_get_option('twitter_username');
			if( empty( $twitter_id ) && empty( $consumer_key ) && empty( $consumer_secret ) ){ ?>
                <p class="bdayh-sc-info">
                    Error : Setup Twitter API settings Go to Theme panel > Twitter API
                </p>
			<?php } ?>

            <p>
                <input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>"  value="true" <?php if( !empty( $instance['twitter'] ) && $instance['twitter'] ) echo 'checked="checked"'; ?> type="checkbox"  />
            </p>
        </div><!-- .bdayh-sc-twitter /-->

        <div class="bdayh-sc bdayh-sc-facebook">
            <h3>Facebook</h3>
            <p>
                <label for="<?php echo $this->get_field_id( 'facebookn' ); ?>"><strong>Page ID/Name</strong></label>
                <input id="<?php echo $this->get_field_id( 'facebookn' ); ?>" name="<?php echo $this->get_field_name( 'facebookn' ); ?>" value="<?php if( !empty( $instance['facebookn'] ) ) echo $instance['facebookn']; ?>" class="widefat" type="text" />
            </p>
        </div><!-- .bdayh-sc-facebook /-->

        <div class="bdayh-sc bdayh-sc-youtube">
            <h3>Youtube</h3>

            <p class="bdayh-sc-info">
                <strong>Need Help ?</strong>
                <br>
                <a target="_blank" href="https://console.developers.google.com/project">Get API Click here</a>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'youtube_api_key' ); ?>"><strong>Youtube API</strong></label>
                <input id="<?php echo $this->get_field_id( 'youtube_api_key' ); ?>" name="<?php echo $this->get_field_name( 'youtube_api_key' ); ?>" value="<?php if( !empty( $instance['youtube_api_key'] ) ) echo $instance['youtube_api_key']; ?>" class="widefat" type="text" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'youtube_type' ); ?>"><strong>YouTube Type</strong></label>
                <select id="<?php echo $this->get_field_id( 'youtube_type' ); ?>" name="<?php echo $this->get_field_name( 'youtube_type' ); ?>" class="widefat">
                    <option <?php if ( !empty( $instance['youtube_type'] ) && 'user' == $instance['youtube_type'] ) echo 'selected="selected"'; ?> value="user">User</option>
                    <option <?php if ( !empty( $instance['youtube_type'] ) && 'channel' == $instance['youtube_type'] ) echo 'selected="selected"'; ?> value="channel">Channel</option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'youtubeun' ); ?>"><strong>Username or Channel ID</strong></label>
                <input id="<?php echo $this->get_field_id( 'youtubeun' ); ?>" name="<?php echo $this->get_field_name( 'youtubeun' ); ?>" value="<?php if( !empty( $instance['youtubeun'] ) ) echo $instance['youtubeun']; ?>" class="widefat" type="text" />
            </p>
        </div><!-- .bdayh-sc-youtube /-->

        <div class="bdayh-sc bdayh-sc-vimeo">
            <h3>Vimeo</h3>
            <p>
                <label for="<?php echo $this->get_field_id( 'vimocn' ); ?>"><strong>Channel Name</strong></label>
                <input id="<?php echo $this->get_field_id( 'vimocn' ); ?>" name="<?php echo $this->get_field_name( 'vimocn' ); ?>" value="<?php if( !empty( $instance['vimocn'] ) ) echo $instance['vimocn']; ?>" class="widefat" type="text" />
            </p>
        </div><!-- .bdayh-sc-vimeo /-->

        <div class="bdayh-sc bdayh-sc-soundcloud">
            <h3>Soundcloud</h3>
            <p class="bdayh-sc-info">
                <strong>To Setup SoundCloud you need to get an API Key</strong>
                <br>
                Go To <a href="http://soundcloud.com/you/apps" target="_blank"> Your Applications</a>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'soundcloud_api' ); ?>"><strong>API Key</strong></label>
                <input id="<?php echo $this->get_field_id( 'soundcloud_api' ); ?>" name="<?php echo $this->get_field_name( 'soundcloud_api' ); ?>" value="<?php if( !empty( $instance['soundcloud_api'] ) ) echo $instance['soundcloud_api']; ?>" class="widefat" type="text" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'soundcloudun' ); ?>"><strong>UserName</strong></label>
                <input id="<?php echo $this->get_field_id( 'soundcloudun' ); ?>" name="<?php echo $this->get_field_name( 'soundcloudun' ); ?>" value="<?php if( !empty( $instance['soundcloudun'] ) ) echo $instance['soundcloudun']; ?>" class="widefat" type="text" />
            </p>
        </div><!-- .bdayh-sc-soundcloud /-->

        <div class="bdayh-sc bdayh-sc-instgram">
            <h3>Instgram</h3>
            <p>
                <label for="<?php echo $this->get_field_id( 'instgram' ); ?>"><strong>UserName</strong></label>
                <input id="<?php echo $this->get_field_id( 'instgram' ); ?>" name="<?php echo $this->get_field_name( 'instgram' ); ?>" value="<?php if( !empty( $instance['instgram'] ) ) echo $instance['instgram']; ?>" class="widefat" type="text" />
            </p>
        </div><!-- .bdayh-sc-instgram /-->

        <div class="bdayh-sc bdayh-sc-dribbble">
            <h3>Dribbble</h3>

            <p>
                <label for="<?php echo $this->get_field_id( 'access_token' ); ?>"><strong>Access Token</strong></label>
                <input id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" value="<?php if( !empty( $instance['access_token'] ) ) echo $instance['access_token']; ?>" class="widefat" type="text" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'drbl_un' ); ?>"><strong>UserName</strong></label>
                <input id="<?php echo $this->get_field_id( 'drbl_un' ); ?>" name="<?php echo $this->get_field_name( 'drbl_un' ); ?>" value="<?php if( !empty( $instance['drbl_un'] ) ) echo $instance['drbl_un']; ?>" class="widefat" type="text" />
            </p>
        </div><!-- .bdayh-sc-dribbble /-->

        <div class="bdayh-sc bdayh-sc-vk">
            <h3>vk.com</h3>

            <p>
                <label for="<?php echo $this->get_field_id( 'woohoo_get_vk_count' ); ?>"><strong>UserName</strong></label>
                <input id="<?php echo $this->get_field_id( 'woohoo_get_vk_count' ); ?>" name="<?php echo $this->get_field_name( 'woohoo_get_vk_count' ); ?>" value="<?php if( !empty( $instance['woohoo_get_vk_count'] ) ) echo $instance['woohoo_get_vk_count']; ?>" class="widefat" type="text" />
            </p>
        </div><!-- .bdayh-sc-vk /-->

        <div class="bdayh-sc bdayh-sc-envato">
            <h3>Envato</h3>

            <p>
                <label for="<?php echo $this->get_field_id( 'woohoo_get_envato_site' ); ?>"><strong>Marketplace</strong></label>
                <select id="<?php echo $this->get_field_id( 'woohoo_get_envato_site' ); ?>" name="<?php echo $this->get_field_name( 'woohoo_get_envato_site' ); ?>" class="widefat">
					<?php
					$envato_markets = array('3docean', 'activeden', 'audiojungle', 'codecanyon', 'graphicriver', 'photodune', 'themeforest', 'videohive');
					foreach ( $envato_markets as $market ){ ?>
                        <option <?php if( !empty( $instance['woohoo_get_envato_site'] ) && $instance['woohoo_get_envato_site'] == $market ) echo'selected="selected"' ?> value="<?php echo $market ?>"><?php echo $market ?></option>
					<?php } ?>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'woohoo_get_envato_count' ); ?>"><strong>UserName</strong></label>
                <input id="<?php echo $this->get_field_id( 'woohoo_get_envato_count' ); ?>" name="<?php echo $this->get_field_name( 'woohoo_get_envato_count' ); ?>" value="<?php if( !empty( $instance['woohoo_get_envato_count'] ) ) echo $instance['woohoo_get_envato_count']; ?>" class="widefat" type="text" />
            </p>
        </div><!-- .bdayh-sc-envato /-->

        <style type="text/css">
            /*
            .bdayh-sc {
                border-radius: 3px;
                margin: 6px 0;
                padding: 15px;
                background: #222;
                text-decoration: none !important;
            }
            .bdayh-sc a {
                text-decoration: none !important;

            }
            .bdayh-sc h3 {
                margin: 0 0 10px 0 !important;
                padding: 0 !important;
            }

            .bdayh-sc p {
                margin: 10px 0 0 0 !important;
                padding: 0 !important;
            }

            .bdayh-sc input {
                border: 0 none !important;
                border-radius: 3px;
                margin: 5px 0 0 0 !important;
            }

            .bdayh-sc h3,
            .bdayh-sc,
            .bdayh-sc a {
                color: #FFF;
            }
            .bdayh-sc a {font-weight: bold !important}

            .bdayh-sc .bdayh-sc-info {
                padding: 7px !important;
                margin: 15px 0;
                background: #fcf8e3 !important;


                clear: both;
                overflow: hidden;
                display: block;
                font-size: 12px;
                border-radius: 4px;
            }
            .bdayh-sc .bdayh-sc-info, .bdayh-sc .bdayh-sc-info a{
                color: #8a6d3b!important;
            }

            .bdayh-sc.bdayh-sc-facebook {background: #39599f !important}
            .bdayh-sc.bdayh-sc-twitter {background: #45b0e3 !important}
            .bdayh-sc.bdayh-sc-googlep {background: #fa0101 !important}
            .bdayh-sc.bdayh-sc-youtube {background: #cc181e !important}
            .bdayh-sc.bdayh-sc-vimeo {background: #44bbff !important}
            .bdayh-sc.bdayh-sc-soundcloud {background: #F76700 !important}
            .bdayh-sc.bdayh-sc-instgram {background: #3f729b !important}
            .bdayh-sc.bdayh-sc-dribbble {background: #d97aa5 !important}
            .bdayh-sc.bdayh-sc-delicious {background: #285da7 !important}
            .bdayh-sc.bdayh-sc-posts {background: #e29c04 !important}
            .bdayh-sc.bdayh-sc-comments {background: #4caf50 !important}
            .bdayh-sc.bdayh-sc-members {background: #e91e63 !important}

            .bdayh-sc.bdayh-sc-vk {background: #6A84A4 !important}
            .bdayh-sc.bdayh-sc-envato {background: #9BC467 !important}
            */
        </style>
		<?php
	}

	public function update( $new_instance, $old_instance )
	{
		$instance 						= $old_instance;
		$instance['title']              = strip_tags( $new_instance['title']);
		$instance['get_posts_count']    = $new_instance['get_posts_count'] ;
		$instance['get_comments_count'] = $new_instance['get_comments_count'] ;
		$instance['get_members_count']  = $new_instance['get_members_count'] ;
		$instance['rssurl']             = $new_instance['rssurl'] ;
		$instance['drbl_un']            = $new_instance['drbl_un'] ;
		$instance['access_token']       = $new_instance['access_token'] ;
		$instance['forrst_id']          = $new_instance['forrst_id'] ;
		$instance['delicious']          = $new_instance['delicious'] ;
		$instance['facebookn']          = $new_instance['facebookn'] ;
		$instance['fb_access_token']    = $new_instance['fb_access_token'] ;
		$instance['gplusn']             = $new_instance['gplusn'] ;
		$instance['gplusn_api']         = $new_instance['gplusn_api'] ;
		$instance['youtubeun']          = $new_instance['youtubeun'] ;
		$instance['youtube_api_key']    = $new_instance['youtube_api_key'] ;
		$instance['vimocn']             = $new_instance['vimocn'] ;
		$instance['soundcloudun']       = $new_instance['soundcloudun'] ;
		$instance['socialstyle']        = $new_instance['socialstyle'] ;
		$instance['youtube_type']       = $new_instance['youtube_type'] ;
		$instance['instgram']           = $new_instance['instgram'] ;
		$instance['instgram_token']     = $new_instance['instgram_token'] ;
		$instance['soundcloud_api']     = $new_instance['soundcloud_api'] ;
		$instance['twitter']        	= strip_tags($new_instance['twitter']);

		$instance['woohoo_get_vk_count']        = $new_instance['woohoo_get_vk_count'] ;
		$instance['woohoo_get_envato_count']    = $new_instance['woohoo_get_envato_count'] ;
		$instance['woohoo_get_envato_site']     = $new_instance['woohoo_get_envato_site'] ;

		delete_transient('bdTwitterFollowers');
		delete_transient('bdayh_soical_soundcloud');
		delete_transient('bdayh_soical_vimo');
		delete_transient('bdayh_soical_youtube');
		delete_transient('bdayh_soical_gplus');
		delete_transient('bdayh_soical_facebook');
		delete_transient('woohoo_instgram_count_trans');
		delete_transient('bdayh_soical_dribbble');
		delete_transient('bdayh_soical_forrst');
		delete_transient('bdayh_soical_delicious');
		delete_transient('woohoo_vk_count_trans');
		delete_transient('woohoo_envato_count_trans');

		return $instance;
	}
}
function woohoo_widget_social_conuter(){
	register_widget( 'WOOHOO_WIDGET_SOCIAL_COUNTER' );
}
add_action( 'widgets_init', 'woohoo_widget_social_conuter' );