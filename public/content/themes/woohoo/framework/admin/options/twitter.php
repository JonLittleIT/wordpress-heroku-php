<?php
/**
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Woohoo News Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$bd_options["twitter_API"]["wpbd_twitter_API"][] = array(
    "name" 		=> "Twitter API OAuth Options",
    "type"  	=> "subtitle"
);
$bd_options["twitter_API"]["wpbd_twitter_API"][] = array(
    "name" 		=> "Twitter Username",
    "id"    	=> "twitter_username",
    "exp"       => 'You need to create <a href="https://dev.twitter.com/apps" target="_blank">Twitter APP</a>',
    "type"  	=> "text"
);
$bd_options["twitter_API"]["wpbd_twitter_API"][] = array(
    "name" 		=> "Twitter Consumer Key",
    "id"    	=> "twitter_consumer_key",
    "type"  	=> "text"
);
$bd_options["twitter_API"]["wpbd_twitter_API"][] = array(
    "name" 		=> "Twitter Consumer Secret",
    "id"    	=> "twitter_consumer_secret",
    "type"  	=> "text"
);
$bd_options["twitter_API"]["wpbd_twitter_API"][] = array(
    "name" 		=> "Twitter Access Token",
    "id"    	=> "twitter_access_token",
    "type"  	=> "text"
);
$bd_options["twitter_API"]["wpbd_twitter_API"][] = array(
    "name" 		=> "Twitter Access Token Secret",
    "id"    	=> "twitter_access_token_secret",
    "type"  	=> "text"
);

?>