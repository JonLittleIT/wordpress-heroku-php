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

$bd_options["sidebars"]["sidebar"][] = array(
    "name" => "Sidebar Options",
    "type"=> "subtitle"
);
$bd_options["sidebars"]["sidebar"][] = array(
    "name" 		=> "Default Site Sidebar position",
    "id"    	=> "bdaia_s_sidebar_pos",
    "type"  	=> "post_sidebars"
);
$bd_options["sidebars"]["sidebar"][] = array(
    "name" 		=> "Default Post Sidebar Position",
    "id"    	=> "bdaia_p_sidebar_pos",
    "type"  	=> "post_sidebars"
);
$bd_options["sidebars"]["sidebar"][] = array(
    "name" 		=> "Sticky Sidebar",
    "id"    	=> "sticky_sidebar",
    "exp"    	=> "Check to enable the Sticky Sidebar, uncheck to disable.",
    "type"  	=> "checkbox"
);
$bd_options["sidebars"]["sidebar"][] = array(
    "name" 		=> "Disable on the homepage",
    "id"    	=> "ss_homepage",
    "type"  	=> "checkbox"
);
$bd_options["sidebars"]["sidebar"][] = array(
    "name" 		=> "Disable on pages",
    "id"    	=> "ss_pages",
    "type"  	=> "checkbox"
);
$bd_options["sidebars"]["sidebar"][] = array(
    "name" 		=> "Disable on category",
    "id"    	=> "ss_cat",
    "type"  	=> "checkbox"
);
$bd_options["sidebars"]["sidebar"][] = array(
    "name" 		=> "Disable on posts",
    "id"    	=> "ss_posts",
    "type"  	=> "checkbox"
);
$bd_options["sidebars"]["sidebar"][] = array(
    "name" 		=> "Disable on tag pages",
    "id"    	=> "ss_disable_tag",
    "type"  	=> "checkbox"
);