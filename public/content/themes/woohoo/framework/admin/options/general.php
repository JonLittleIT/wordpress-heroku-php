<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) die( 'No direct script access allowed' );

$bd_options["general_options"]["bd_general"][] = array(
    "name" 		=> "General Options",
    "type"  	=> "subtitle"
);
$bd_options["general_options"]["bd_general"][] = array(
	"name" 		=> "Theme Layout",
	"id" 		=> "bdaia_theme_layout",
	"type"  	=> "radio",
	"options"   => array(
		"wide"      => "Wide" ,
		"boxed"     => "Boxed",
	)
);
$bd_options["general_options"]["bd_general"][] = array(
    "name" 		=> "Image Scroll Effect",
    "id"    	=> "bd_lazyload",
    "type"  	=> "checkbox"
);

$bd_options["general_options"]["bd_general"][] = array(
	"name" 		=> "Lazy Load For Images",
	"id"    	=> "bdaia_has_lazy_load",
	"type"  	=> "checkbox"
);

if ( WOOHOO_BWPMINIFY_IS_ACTIVE )
{
	$bd_options["general_options"]["bd_general"][] = array(
		"name" 		=> "Move CSS files to the footer",
		"id"    	=> "bdaia_css_to_footer",
		"type"  	=> "checkbox"
	);
}

$bd_options["general_options"]["bd_general"][] = array(
	"name" 		=> "JPEG compression quality",
	"id"  	    => "bdaia_jpeg_quality",
	"type"  	=> "sellist",
	"exp"       => 'When you do make these image quality changes, you want to make sure that you <a href="https://wordpress.org/plugins/force-regenerate-thumbnails/screenshots/" target="_blank">force regenerate thumbnails</a>',
	"options"   => array(
		"jpeg_quality_10"       => "10%",
		"jpeg_quality_20"       => "20%",
		"jpeg_quality_30"       => "30%",
		"jpeg_quality_40"       => "40%",
		"jpeg_quality_50"       => "50%",
		"jpeg_quality_60"       => "60%",
		"jpeg_quality_70"       => "70%",
		"jpeg_quality_80"       => "80%",
		"jpeg_quality_90"       => "90%",
		"jpeg_quality_100"      => "100%",
	),
);
$bd_options["general_options"]["bd_general"][] = array(
    "name" 		=> "Live Search Results",
    "id"    	=> "bd_LiveSearch",
    "type"  	=> "checkbox"
);
$bd_options["general_options"]["bd_general"][] = array(
    "name" 		=> "Responsive Design",
    "id"    	=> "responsive",
    "exp"		=> "Check this box to use the responsive design features. If left unchecked then the fixed layout is used.",
    "type"  	=> "checkbox"
);
$bd_options["general_options"]["bd_general"][] = array(
    "name" 		=> "Notify On Theme Updates",
    "id"    	=> "notify_theme",
    "exp"		=> "Check this box to receive Theme updates notifications.",
    "type"  	=> "checkbox"
);
$bd_options["general_options"]["bd_general"][] = array(

    "name" 		=> "Time Format",
    "id" 		=> "bdTimeFormat",
    "type"  	=> "radio",
    "options"   => array(
        "modern" => "Time Ago Format" ,
        "traditional" => "Traditional",
        "none" => " Disable all"
    )
);
$bd_options["general_options"]["general_cods"][] = array(
	"name" 		=> "Tracking Code",
	"id"    	=> "google_analytics",
	"exp"		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
	"type"  	=> "textarea"

);
$bd_options["general_options"]["general_cods"][] = array(
    "name" 		=> "Add code before the &lt;/head&gt; tag.",
    "id"    	=> "space_head",
    "type"  	=> "textarea"
);
$bd_options["general_options"]["general_cods"][] = array(
    "name" 		=> "Add code before the &lt;/body&gt; tag.",
    "id"    	=> "space_body",
    "type"  	=> "textarea"
);