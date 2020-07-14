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

$bd_options["template_settings"]["blog_settings"][] = array(
	"name" 		=> "Blog Template",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle",
);
$bd_options["template_settings"]["blog_settings"][] = array(
	"name" 		=> "Post Display View",
	"id"    	=> "bdaia_blog_display",
	"type"  	=> "cat_block",
	"class"     => "fadeToggle"
);

// Author Template.
$bd_options["template_settings"]["author_settings"][] = array(
	"name" 		=> "Author Template",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle",
);
$bd_options["template_settings"]["author_settings"][] = array(
	"name" 		=> "Post Display View",
	"id"    	=> "author_blog_display",
	"type"  	=> "cat_block",
	"class"     => "fadeToggle"
);
$bd_options["template_settings"]["author_settings"][] = array(
	"name" 		=> "Sidebar Position",
	"id"    	=> "author_sidebar_pos",
	"type"  	=> "post_sidebars",
	"class"     => "fadeToggle"
);

// Tag Template.
$bd_options["template_settings"]["tag_settings"][] = array(
	"name" 		=> "Tag Template",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle",
);
$bd_options["template_settings"]["tag_settings"][] = array(
	"name" 		=> "Post Display View",
	"id"    	=> "tag_blog_display",
	"type"  	=> "cat_block",
	"class"     => "fadeToggle"
);
$bd_options["template_settings"]["tag_settings"][] = array(
	"name" 		=> "Sidebar Position",
	"id"    	=> "tag_sidebar_pos",
	"type"  	=> "post_sidebars",
	"class"     => "fadeToggle"
);

// Archive Template.
$bd_options["template_settings"]["archive_settings"][] = array(
	"name" 		=> "Archive Template",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle",
);
$bd_options["template_settings"]["archive_settings"][] = array(
	"name" 		=> "Post Display View",
	"id"    	=> "archive_blog_display",
	"type"  	=> "cat_block",
	"class"     => "fadeToggle"
);
$bd_options["template_settings"]["archive_settings"][] = array(
	"name" 		=> "Sidebar Position",
	"id"    	=> "archive_sidebar_pos",
	"type"  	=> "post_sidebars",
	"class"     => "fadeToggle"
);

// Search Template.
$bd_options["template_settings"]["search_settings"][] = array(
	"name" 		=> "Search Template",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle",
);
$bd_options["template_settings"]["search_settings"][] = array(
	"name" 		=> "Post Display View",
	"id"    	=> "search_blog_display",
	"type"  	=> "cat_block",
	"class"     => "fadeToggle"
);
$bd_options["template_settings"]["search_settings"][] = array(
	"name" 		=> "Sidebar Position",
	"id"    	=> "search_sidebar_pos",
	"type"  	=> "post_sidebars",
	"class"     => "fadeToggle"
);