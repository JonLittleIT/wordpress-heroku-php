<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly

add_action( 'show_user_profile', 'woohoo_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'woohoo_show_extra_profile_fields' );
function woohoo_show_extra_profile_fields( $user )
{
    ?>
    <h3>User Social Networking</h3>
    <table class="form-table">
        <tr>
            <th><label for="facebook">Facebook URL</label></th>
            <td>
                <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
            </td>
        </tr>
        <tr>
            <th><label for="twitter">Twitter Username</label></th>
            <td>
                <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
            </td>
        </tr>
        <tr>
            <th><label for="google">Google + URL</label></th>
            <td>
                <input type="text" name="google" id="google" value="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text" /><br />
            </td>
        </tr>
	    <tr>
		    <th><label for="instagram">Instagram URL</label></th>
		    <td>
			    <input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
		    </td>
	    </tr>
        <tr>
            <th><label for="linkedin">linkedIn URL</label></th>
            <td>
                <input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
            </td>
        </tr>
        <tr>
            <th><label for="pinterest">Pinterest URL</label></th>
            <td>
                <input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
            </td>
        </tr>
        <tr>
            <th><label for="youtube">YouTube URL</label></th>
            <td>
                <input type="text" name="youtube" id="youtube" value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text" /><br />
            </td>
        </tr>
        <tr>
            <th><label for="flickr">Flickr URL</label></th>
            <td>
                <input type="text" name="flickr" id="flickr" value="<?php echo esc_attr( get_the_author_meta( 'flickr', $user->ID ) ); ?>" class="regular-text" /><br />
            </td>
        </tr>
    </table>
<?php
}

// Save user's social accounts
add_action( 'personal_options_update', 'woohoo_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'woohoo_save_extra_profile_fields' );
function woohoo_save_extra_profile_fields( $user_id )
{
    if ( ! current_user_can( 'edit_user', $user_id ) ) {
    	return false;
    }

    update_user_meta( $user_id, 'google', $_POST['google']          );
    update_user_meta( $user_id, 'pinterest', $_POST['pinterest']    );
    update_user_meta( $user_id, 'twitter', $_POST['twitter']        );
    update_user_meta( $user_id, 'facebook', $_POST['facebook']      );
    update_user_meta( $user_id, 'linkedin', $_POST['linkedin']      );
    update_user_meta( $user_id, 'flickr', $_POST['flickr']          );
    update_user_meta( $user_id, 'youtube', $_POST['youtube']        );
    update_user_meta( $user_id, 'instagram', $_POST['instagram']    );
}


/**
 * Social Sharing Links
 * ----------------------------------------------------------------------------- *
 */
if ( ! function_exists( 'woohoo_social' ) )
{
    function woohoo_social( $newtab ='yes', $icon_size=' ', $tooltip='ttip' )
    {
        if ( $newtab == 'yes' ){
            $newtab = "target=\"_blank\"";
        } else {
            $newtab = '';
        }
        echo '<div class="bdaia-social-io bdaia-social-io-size-'. $icon_size .'">' ."\n";

        // Facebook
        $social_facebook_url = woohoo_get_option( 'social_facebook_url' );
        if ( $social_facebook_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-facebook" title="Facebook" href="'. esc_url( $social_facebook_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-facebook"></span></a>'."\n"; }

        // Twitter
        $social_twitter_url = woohoo_get_option( 'social_twitter_url' );
        if ( $social_twitter_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-twitter" title="Twitter" href="'. esc_url( $social_twitter_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-twitter"></span></a>'."\n"; }

        // Google+
        $social_google_plus_url = woohoo_get_option( 'social_google_plus_url' );
        if ( $social_google_plus_url ) { echo '<a class="'. $tooltip .' bdaia-io-url-google-plus" title="Google+" href="'. esc_url( $social_google_plus_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-google-plus"></span></a>'."\n"; }

        // Pinterest
        $social_pinterest_url = woohoo_get_option( 'social_pinterest_url' );
        if ( $social_pinterest_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-pinterest" title="Pinterest" href="'. esc_url( $social_pinterest_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-social-pinterest"></span></a>'."\n"; }

        // dribbble
        $social_dribbble_url = woohoo_get_option( 'social_dribbble_url' );
        if ( $social_dribbble_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-dribbble" title="Dribbble" href="'. esc_url( $social_dribbble_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-dribbble"></span></a>'."\n"; }

        // LinkedIN
        $social_linkedin_url = woohoo_get_option( 'social_linkedin_url' );
        if ( $social_linkedin_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-linkedin" title="LinkedIn" href="'. esc_url( $social_linkedin_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-linkedin2"></span></a>'."\n"; }

        // Flickr
        $social_flickr_url = woohoo_get_option( 'social_flickr_url' );
        if ( $social_flickr_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-flickr" title="Flickr" href="'. esc_url( $social_flickr_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-flickr2"></span></a>'."\n"; }

        // YouTube
        $social_youtube_url = woohoo_get_option( 'social_youtube_url' );
        if ( $social_youtube_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-youtube" title="Youtube" href="'. esc_url( $social_youtube_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-youtube"></span></a>'."\n"; }

        // Skype
        $social_skype_url = woohoo_get_option( 'social_skype_url' );
        if ( $social_skype_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-skype" title="Skype" href="'. esc_url( $social_skype_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-skype"></span></a>'."\n"; }

        // Digg
        $social_digg_url = woohoo_get_option( 'social_digg_url' );
        if ( $social_digg_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-digg" title="Digg" href="'. esc_url( $social_digg_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-digg"></span></a>'."\n"; }

        // Reddit
        $social_reddit_url = woohoo_get_option( 'social_reddit_url' );
        if ( $social_reddit_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-reddit" title="Reddit" href="'. esc_url( $social_reddit_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-reddit"></span></a>'."\n"; }

        // Delicious
        $social_delicious_url = woohoo_get_option( 'social_delicious_url' );
        if ( $social_delicious_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-delicious" title="Delicious" href="'. esc_url( $social_delicious_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-delicious"></span></a>'."\n"; }

        // stumbleuponUpon
        $social_stumbleupon_url = woohoo_get_option( 'social_stumbleupon_url' );
        if ( $social_stumbleupon_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-stumbleupon" title="StumbleUpon" href="'. esc_url( $social_stumbleupon_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-stumbleupon"></span></a>'."\n"; }

        // Tumblr
        $social_tumblr_url = woohoo_get_option( 'social_tumblr_url' );
        if ( $social_tumblr_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-tumblr" title="Tumblr" href="'. esc_url( $social_tumblr_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-tumblr"></span></a>'."\n"; }

        // Vimeo
        $social_vimeo_url = woohoo_get_option( 'social_vimeo_url' );
        if ( $social_vimeo_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-vimeo-square" title="Vimeo" href="'. esc_url( $social_vimeo_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-vimeo"></span></a>'."\n"; }

        // Wordpress
        $social_wordpress_url = woohoo_get_option( 'social_wordpress_url' );
        if ( $social_wordpress_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-wordpress" title="WordPress" href="'. esc_url( $social_wordpress_url ) .'"  '. $newtab .'><span class="bdaia-io bdaia-io-wordpress"></span></a>'."\n"; }

        // Yelp
        $social_yelp_url = woohoo_get_option( 'social_yelp_url' );
        if ( $social_yelp_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-yelp" title="Yelp" href="'. esc_url( $social_yelp_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-yelp"></span></a>'."\n"; }

        // Last.fm
        $social_lastfm_url = woohoo_get_option( 'social_lastfm_url' );
        if ( $social_lastfm_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-lastfm" title="Last.fm" href="'. esc_url( $social_lastfm_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-lastfm"></span></a>'."\n"; }

        // xing.me
        $social_xing_url = woohoo_get_option( 'social_xing_url' );
        if ( $social_xing_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-xing" title="Xing" href="'. esc_url( $social_xing_url ) .'"  '. $newtab .' ><span class="bdaia-io bdaia-io-xing2"></span></a>'."\n"; }

        // DeviantArt
        $social_deviantart_url = woohoo_get_option( 'social_deviantart_url' );
        if ( $social_deviantart_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-deviantart" title="DeviantArt" href="'. esc_url( $social_deviantart_url ) .'"  '. $newtab .' ><span class="bdaia-io bdaia-io-deviantart"></span></a>'."\n"; }

        // openid
        $social_openid_url = woohoo_get_option( 'social_openid_url' );
        if ( $social_openid_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-openid" title="OpenID" href="'. esc_url( $social_openid_url ) .'"  '. $newtab .' ><span class="bdaia-io bdaia-io-openid"></span></a>'."\n"; }

        // behance
        $social_behance_url = woohoo_get_option( 'social_behance_url' );
        if ( $social_behance_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-behance" title="Behance" href="'. esc_url( $social_behance_url ) .'"  '. $newtab .' ><span class="bdaia-io bdaia-io-behance"></span></a>'."\n"; }

        // instagram
        $social_instagram_url = woohoo_get_option( 'social_instagram_url' );
        if ( $social_instagram_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-instagram" title="instagram" href="'. esc_url( $social_instagram_url ) .'"  '. $newtab .' ><span class="bdaia-io bdaia-io-instagram"></span></a>'."\n"; }

        // paypal
        $social_paypal_url = woohoo_get_option( 'social_paypal_url' );
        if ( $social_paypal_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-paypal" title="paypal" href="'. esc_url( $social_paypal_url ) .'"  '. $newtab .' ><span class="bdaia-io bdaia-io-paypal"></span></a>'."\n"; }

        // spotify
        $social_spotify_url = woohoo_get_option( 'social_spotify_url' );
        if ( $social_spotify_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-spotify" title="spotify" href="'. esc_url( $social_spotify_url ) .'"  '. $newtab .' ><span class="bdaia-io bdaia-io-spotify"></span></a>'."\n"; }

        // Google Play
        $social_google_play_url = woohoo_get_option( 'social_google_play_url' );
        if ( $social_google_play_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-google" title="Google Play" href="'. esc_url( $social_google_play_url ) .'"  '. $newtab .' ><span class="bdaia-io bdaia-io-google"></span></a>'."\n"; }

        // VK
        $social_vk_url = woohoo_get_option( 'social_vk_url' );
        if ( $social_vk_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-vk" title="vk.com" href="'. esc_url( $social_vk_url ) .'"  '. $newtab .' ><span class="bdaia-io bdaia-io-vk"></span></a>'."\n"; }

        // Apple
        $social_apple_url = woohoo_get_option( 'social_apple_url' );
        if ( $social_apple_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-apple" title="Apple" href="'. esc_url( $social_apple_url ) .'"  '. $newtab .' ><span class="bdaia-io bdaia-io-appleinc"></span></a>'."\n"; }

        // soundcloud
        $social_soundcloud_url = woohoo_get_option( 'social_soundcloud_url' );
        if ( $social_soundcloud_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-soundcloud" title="soundcloud" href="'. esc_url( $social_soundcloud_url ) .'"  '. $newtab .' ><span class="bdaia-io bdaia-io-soundcloud"></span></a>'."\n"; }

	    // okru
	    $social_okru_url = woohoo_get_option( 'social_okru_url' );
	    if ( $social_okru_url ) { echo'<a class="'. $tooltip .' bdaia-io-url-okru" title="ok.ru" href="'. esc_url( $social_okru_url ) .'"  '. $newtab .' ><span class="bdaia-io bdaia-io-okru"></span></a>'."\n"; }

        // Rss
        $rss_url = woohoo_get_option( 'rss_url' );
        if ( $rss_url ){ echo '<a class="'. $tooltip .' bdaia-io-url-rss" title="Rss" href="'. esc_url( $rss_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-rss"></span></a>'."\n"; }

	    // Telegram
	    $telegram_url = woohoo_get_option( 'social_telegram_url' );
	    if ( $telegram_url ){ echo '<a class="'. $tooltip .' bdaia-io-url-telegram" title="Telegram" href="'. esc_url( $telegram_url ) .'" '. $newtab .'><span class="bdaia-io bdaia-io-telegram"></span></a>'."\n"; }

        echo '</div>';
    }
}