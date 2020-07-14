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

$bd_options["ads_options"]["bdaia_desktop_ad"][] = array(
	"name" 		=> "Banners Settings",
	"type"  	=> "subtitle"
);

/*
$bd_options["ads_options"]["bdaia_desktop_ad"][] = array(
	"name" 		=> "Important: You have to customize Header and Mobile Ads Settings if you want to display your Ads in the Desktop and Mobile/Tablet view.",
	"type"  	=> "msginfo"
);
*/

$bd_options["ads_options"]["bdaia_desktop_ad"][] = array(
	"name" 		=> "Above Header Banner Area",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_above_header_ad",
	"type"  	=> "textarea"
);

$bd_options["ads_options"]["bdaia_desktop_ad"][] = array(
	"name" 		=> "Bellow Header Banner Area",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_bellow_header_ad",
	"type"  	=> "textarea"
);

$bd_options["ads_options"]["bdaia_desktop_ad"][] = array(
	"name" 		=> "Header Banner Area",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_header_ad",
	"type"  	=> "textarea"
);
$bd_options["ads_options"]["bdaia_desktop_ad"][] = array(
	"name" 		=> "Footer Banner Area",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_footer_ad",
	"type"  	=> "textarea"
);
$bd_options["ads_options"]["bdaia_desktop_ad"][] = array(
	"name" 		=> "Article Banner Top Area",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_p_top_ad",
	"type"  	=> "textarea"
);

/*$bd_options["ads_options"]["bdaia_desktop_ad"][] = array(
	"name" 		=> "Article Banner Inline",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_p_inline_ad",
	"type"  	=> "textarea"
);
$bd_options["ads_options"]["bdaia_desktop_ad"][] = array(
	"name" 		=> "Article Banner Inline After Paragraph",
	"id"    	=> "bdaia_p_inline_ad_after_p",
	"exp"       => "After how many paragraphs the ad will display. The theme will analyze the content of each post and it will inject an ad after the selected number of paragraphs.",
	"type"  	=> "ui_slider",
	"max" 		=> 100,
	"min" 		=> 0
);*/

$bd_options["ads_options"]["bdaia_desktop_ad"][] = array(
	"name" 		=> "Article Banner Bottom Area",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_p_bottom_ad",
	"type"  	=> "textarea"
);
$bd_options["ads_options"]["bdaia_desktop_ad"][] = array(
	"name" 		=> "Post Template Style 3 Banner",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_p_temp_s3_ad",
	"type"  	=> "textarea"
);
$bd_options["ads_options"]["bdaia_desktop_ad"][] = array(
	"name" 		=> "Post Template Style 4 Banner",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_p_temp_s4_ad",
	"type"  	=> "textarea"
);

// Mobile Ad.
/*$bd_options["ads_options"]["bdaia_mobile_ad"][] = array(
	"class"     => "fadeToggle",
	"name" 		=> "Mobile Ads Settings",
	"type"  	=> "subtitle"
);
$bd_options["ads_options"]["bdaia_mobile_ad"][] = array(
	"class"     => "fadeToggle",
	"name" 		=> "Header Area",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_header_mob_ad",
	"type"  	=> "textarea"
);
$bd_options["ads_options"]["bdaia_mobile_ad"][] = array(
	"class"     => "fadeToggle",
	"name" 		=> "Footer Area",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_footer_mob_ad",
	"type"  	=> "textarea"
);
$bd_options["ads_options"]["bdaia_mobile_ad"][] = array(
	"class"     => "fadeToggle",
	"name" 		=> "Article Top Area",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_p_top_mob_ad",
	"type"  	=> "textarea"
);


$bd_options["ads_options"]["bdaia_mobile_ad"][] = array(
	"class"     => "fadeToggle",
	"name" 		=> "Article Inline Ad",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_p_inline_mob_ad",
	"type"  	=> "textarea"
);


$bd_options["ads_options"]["bdaia_mobile_ad"][] = array(
	"class"     => "fadeToggle",
	"name" 		=> "Article Bottom Area",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_p_bottom_mob_ad",
	"type"  	=> "textarea"
);
$bd_options["ads_options"]["bdaia_mobile_ad"][] = array(
	"class"     => "fadeToggle",
	"name" 		=> "Post Template Style 3 Ad",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_p_temp_s3_mob_ad",
	"type"  	=> "textarea"
);
$bd_options["ads_options"]["bdaia_mobile_ad"][] = array(
	"class"     => "fadeToggle",
	"name" 		=> "Post Template Style 4 Ad",
	"exp" 		=> "Paste your ad code here. Google AdSense will be made responsive automatically.",
	"id"    	=> "bdaia_p_temp_s4_mob_ad",
	"type"  	=> "textarea"
);*/