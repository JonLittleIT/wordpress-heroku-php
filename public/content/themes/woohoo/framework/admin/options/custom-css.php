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

$bd_options["custom_css"]["custom_css"][] = array (
	"name" 		=> "Add Body Custom Class",
	"id"    	=> "woohoo_add_body_class",
	"type"  	=> "text"
);
$bd_options["custom_css"]["custom_css"][] = array (
	"name" 		=> "Global CSS",
	"id"    	=> "custom_css",
	"exp"       => "Any custom CSS from the user should go in this field, it will override the theme CSS",
	"type"  	=> "textarea"
);
$bd_options["custom_css"]["custom_css"][] = array (
	"name" 		=> "Desktop 1170",
	"id"    	=> "css_desktop",
	"exp"       => "Any custom CSS from the user should go in this field, it will override the theme CSS",
	"type"  	=> "textarea"
);
$bd_options["custom_css"]["custom_css"][] = array (
	"name" 		=> "Ipad Landscape 1024 to 1170",
	"id"    	=> "css_tablets",
	"exp"       => "Any custom CSS from the user should go in this field, it will override the theme CSS",
	"type"  	=> "textarea"
);
$bd_options["custom_css"]["custom_css"][] = array (
	"name" 		=> "Ipad Portrait 768 to 1170",
	"id"    	=> "css_wide_phones",
	"exp"       => "Any custom CSS from the user should go in this field, it will override the theme CSS",
	"type"  	=> "textarea"
);
$bd_options["custom_css"]["custom_css"][] = array (
	"name" 		=> "Phones 0 to 760",
	"id"    	=> "css_phones",
	"exp"       => "Any custom CSS from the user should go in this field, it will override the theme CSS",
	"type"  	=> "textarea"
);