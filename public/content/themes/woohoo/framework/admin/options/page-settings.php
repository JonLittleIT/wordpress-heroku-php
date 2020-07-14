<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) die( 'No direct script access allowed' );

$bd_options["page_settings"]["bdaia_page_settings"][] = array(
	"name" 		=> "Page Settings",
	"type"  	=> "subtitle"
);

$bd_options["page_settings"]["bdaia_page_settings"][] = array(
	"name" 		=> "Disable Page Builder",
	"id"    	=> "bdaia_disable_builder_page",
	"type"  	=> "checkbox"
);

$bd_options["page_settings"]["bdaia_page_settings"][] = array(
	"name" 		=> "Breadcrumb",
	"id"    	=> "bdaia_page_breadcrumbs",
	"type"  	=> "checkbox"
);

$bd_options["page_settings"]["bdaia_page_settings"][] = array(
	"name" 		=> "Disable Comments",
	"id"    	=> "bdaia_page_commetns_posts",
	"type"  	=> "checkbox"
);

$bd_options["page_settings"]["bdaia_page_settings"][] = array(
	"name" 		=> "Bottom page social sharing",
	"id"    	=> "bdaia_page_bottom_sharing",
	"type"  	=> "checkbox"
);