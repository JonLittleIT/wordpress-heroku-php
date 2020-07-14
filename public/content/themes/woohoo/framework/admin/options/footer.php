<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) die( 'No direct script access allowed' );

$bd_options["footer"]["footer_options"][] = array(
	"name" 		=> "Footer Options",
	"type"  	=> "subtitle"
);

$bd_options["footer"]["footer_options"][] = array(
	"name" 		=> "Footer Styling",
	"id" 		=> "bdaia_footer_styling",
	"type"  	=> "radio",

	"options"   => array(
		"light"         => "Light",
		"dark"          => "Dark",
	)
);

/**
 * Footer Widgets Area Options
 * ----------------------------------------------------------------------------- *
 */
$bd_options["footer"]["footer_wa"][] = array(
    "name" 		=> "Footer Widgets Area Options",
    "type"  	=> "subtitle"
);

## Footer Widgets
$bd_options["footer"]["footer_wa"][] = array(
    "name" 		=> "Footer Widgets",
    "id"    	=> "footerWidgets",
    "exp" 		=> "Check the box to display footer widgets.",
    "type"  	=> "checkbox"
);

## Number of Footer Columns
$bd_options["footer"]["footer_wa"][] = array(
    "name" 		=> "Number of Footer Columns",
    "id"    	=> "footerWidgetsColumns",
    "exp"		=> "Select the number of columns to display in the footer.",
    "type"  	=> "column"
);

/**
 * Copyright Area / Social Icons Options
 * ----------------------------------------------------------------------------- *
 */
$bd_options["footer"]["footer_logo"][] = array(
	"name" 		=> "Footer Logo",
	"type"  	=> "subtitle"
);
$bd_options["footer"]["footer_logo"][] = array(
	"name" 		=> "Footer logo",
	"id"    	=> "woohoo_footer_logo",
	"type"  	=> "upload"
);
$bd_options["footer"]["footer_logo"][] = array(
	"name" 		=> "Footer logo (Retina Version @2x)",
	"id"    	=> "woohoo_footer_logo_retina",
	"type"  	=> "upload"
);
$bd_options["footer"]["footer_logo"][] = array(
	"name" 		=> "Standard Logo Width for Retina Logo",
	"id"    	=> "woohoo_footer_logo_retina_width",
	"exp"       =>  "If retina logo is uploaded, please enter the standard logo (1x) version width, do not enter the retina logo width.",
	"type"  	=> "ui_slider",
	"unit" 		=> "(pixels)",
	"max" 		=> 1240,
	"min" 		=> 0
);
$bd_options["footer"]["footer_logo"][] = array(
	"name" 		=> "Footer logo Top Margin",
	"id"    	=> "woohoo_footer_logo_mtop",
	"type"  	=> "ui_slider",
	"unit" 		=> "(in pixels)",
	"max" 		=> 300,
	"min" 		=> 0
);
$bd_options["footer"]["footer_logo"][] = array(
	"name" 		=> "Footer About us",
	"type"  	=> "subtitle"
);
$bd_options["footer"]["footer_logo"][] = array(
	"name" 		=> "Footer About us",
	"id"    	=> "woohoo_footer_about_us",
	"exp"    	=> "HTML markup can be used.",
	"type"  	=> "textarea"
);
$bd_options["footer"]["footer_logo"][] = array(
	"name" 		=> "Top Tags",
	"id"    	=> "woohoo_footer_top_tags",
	"type"  	=> "checkbox"
);
$bd_options["footer"]["footer_logo"][] = array(
	"name" 		=> "Follow Us",
	"id"    	=> "woohoo_footer_follow_us",
	"type"  	=> "checkbox"
);
$bd_options["footer"]["footer_op"][] = array(
	"name" 		=> "Footer Menu",
	"id"    	=> "footer_menu",
	"type"  	=> "checkbox"
);
$bd_options["footer"]["footer_op"][] = array(
    "name" 		=> "Back to Top",
    "id"    	=> "bdayhGoTop",
    "type"  	=> "checkbox"
);
$bd_options["footer"]["footer_op"][] = array(
    "name" 		=> "Display social icons",
    "id"    	=> "bdayhFooterSocialLinks",
    "exp" 		=> "Select the checkbox to show social media icons on the footer.",
    "type"  	=> "checkbox"
);
$bd_options["footer"]["footer_op"][] = array(
    "name" 		=> "Copyright Text",
    "id"    	=> "footer_copyright_text",
    "exp"    	=> "Enter the text that displays in the copyright bar. HTML markup can be used.",
    "type"  	=> "textarea"
);