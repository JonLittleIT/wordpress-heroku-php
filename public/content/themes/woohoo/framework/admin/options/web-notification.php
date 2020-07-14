<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) die( 'No direct script access allowed' );

$bd_options["web_notification"]["web_notification_options"][] = array(
	"name" 		            => "Web Notification",
	"id"    	            => "web_notification",
	"foxpush_domain"        => "foxpush_domain",
	"foxpush_api"           => "foxpush_api",
	"type"  	            => "web_notification"
);