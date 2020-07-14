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

$bd_options["post_settings"]["woohoo_posts_in_news_boxes"][] = array(
	"name" 		=> "Posts In News Boxes",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle",
);

$bd_options["post_settings"]["woohoo_posts_in_news_boxes"][] = array(
	"name" 		=> "Disable Duplicated Posts",
	"id"    	=> "woohoo_do_not_duplicate_boxes",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["woohoo_posts_in_news_boxes"][] = array(
	"name" 		=> "This will not work with pagination, load more and post offset.",
	"type"  	=> "msginfo",
	"class"     => "fadeToggle"
);

$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Post Settings",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle",
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Breadcrumbs",
	"id"    	=> "bdaia_p_breadcrumbs",
	"exp"		=> "Enable or disable the Breadcrumbs (on single post page)",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Categories tags",
	"id"    	=> "bdaia_p_categories_tags",
	"exp"		=> "Enable or disable the categories tags (on single post page)",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Author name",
	"id"    	=> "bdaia_p_author_name",
	"exp"		=> "Enable or disable the author name (on single post page)",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Post date",
	"id"    	=> "bdaia_p_date",
	"exp"		=> "Enable or disable the post date (on single post page)",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Post time read",
	"id"    	=> "bdaia_p_time_read",
	"exp"		=> "Enable or disable the post time read (on single post page)",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Post views",
	"id"    	=> "bdaia_p_post_views",
	"exp"		=> "Enable or disable the post views (on single post page)",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Post like",
	"id"    	=> "bdaia_p_post_like",
	"exp"		=> "Enable or disable the post like (on single post page)",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Comments count",
	"id"    	=> "bdaia_p_comment_count",
	"exp"		=> "Enable or disable the comments count (on single post page)",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Post tags",
	"id"    	=> "bdaia_p_post_tags",
	"exp"		=> "Enable or disable the post tags (bottom of single post pages)",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "MailChimp form",
	"id"    	=> "bdaia_p_mailchimp",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "NEXT and PREVIOUS posts",
	"id"    	=> "bdaia_p_next_prev",
	"exp"		=> "Show or hide NEXT and PREVIOUS posts (bottom of single post pages)",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Author box",
	"id"    	=> "bdaia_p_author_box",
	"exp"		=> "Show or hide author box (bottom of single post pages)",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Disable Comments box on posts",
	"id"    	=> "bdaia_p_commetns_posts",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Disable (Click to comment) button to show comments box",
	"id"    	=> "bdaia_p_commetns_posts_click_btn",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Reading Position Indicator",
	"id"    	=> "post_reading_position_indicator",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Post Reading Time",
	"id"    	=> "words_per_minute",
	"exp"       => "Words per minute",
	"type"  	=> "text",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Lightbox in Post",
	"id"    	=> "bdaia_all_lightbox",
	"exp"    	=> "Enable Lightbox automatically for all images linked to an image file in the post content area",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Post video auto play",
	"id"    	=> "bdaia_video_auto_play",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["bdaia_post_settings"][] = array(
	"name" 		=> "Enable/Disable User Rating in Review Box",
	"id"    	=> "bdaia_user_taqyeem",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);

// Post Template.
$bd_options["post_settings"]['bdaia_post_template'][] = array(
	"name" 		=> "Post Template",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]['bdaia_post_template'][] = array(
	"name" 		=> "Post template",
	"id"    	=> "bdaia_post_template",
	"type"  	=> "post_layouts",
	"class"     => "fadeToggle"
);

// Featured Images.
$bd_options["post_settings"]['bdaia_featured_images'][] = array(
	"name" 		=> "Featured Images",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]['bdaia_featured_images'][] = array(
	"name" 		=> "Show Featured Image",
	"id"    	=> "bdaia_p_featured_image",
	"exp"       => "Show or hide featured image",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]['bdaia_featured_images'][] = array(
	"name" 		=> "Featured Image Lightbox",
	"id" 		=> "bdaia_p_featured_lightbox",
	"type"  	=> "radio",
	"class"     => "fadeToggle",
	"options"   => array(
		"nolightbox"    => "No Lightbox",
		"lightbox"      => "Use Lightbox"
	),
);

// Sharing.
$bd_options["post_settings"]['social_sharing'][] = array(
	"name" 		=> "Social Sharing",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]['social_sharing'][] = array(
	"name" 		=> "Top post Sharing",
	"id"    	=> "bdaia_p_top_sharing",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]['social_sharing'][] = array(
	"name" 		=> "Bottom post Sharing",
	"id"    	=> "bdaia_p_bottom_sharing",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]['social_sharing'][] = array(
	"name" 		=> "Twitter UserName",
	"id"    	=> "share_twitter_username",
	"exp"       => 'Do not include the @',
	"type"  	=> "text",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]['social_sharing'][] = array(
	"name" 		=> "Social Language",
	"id"    	=> "social_lang_type",
	"exp"       => 'Default Language (en-US)',
	"type"  	=> "text",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]['social_sharing'][] = array(
	"name" 		=> "Facebook",
	"id"    	=> "sharing_facebook",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]['social_sharing'][] = array(
	"name" 		=> "Twitter",
	"id"    	=> "sharing_twitter",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]['social_sharing'][] = array(
	"name" 		=> "Linkedin",
	"id"    	=> "sharing_linkedin",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]['social_sharing'][] = array(
	"name" 		=> "Reddit",
	"id"    	=> "sharing_reddit",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]['social_sharing'][] = array(
	"name" 		=> "Tumblr",
	"id"    	=> "sharing_tumblr",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]['social_sharing'][] = array(
	"name" 		=> "Google",
	"id"    	=> "sharing_google",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]['social_sharing'][] = array(
	"name" 		=> "Pinterest",
	"id"    	=> "sharing_pinterest",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);

// Related Posts.
$bd_options["post_settings"]["related_posts"][] = array(
	"name" 		=> "Related Articles",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["related_posts"][] = array(
	"name" 		=> "Related Articles",
	"id"    	=> "bdaia_related",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["related_posts"][] = array(
	"name" 		=> "More By Author",
	"id"    	=> "bdaia_related_author",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["related_posts"][] = array(
	"name" 		=> "More In Category",
	"id"    	=> "bdaia_related_cat",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["related_posts"][] = array(
	"name" 		=> "Limit the number of related articles",
	"id"    	=> "article_related_numb",
	"type"  	=> "ui_slider",
	"class"     => "fadeToggle",
	"unit" 		=> "(post)",
	"max" 		=> 100,
	"min" 		=> 0
);
$bd_options["post_settings"]["related_posts"][] = array(
	"name" 		=> "Disable Load more posts",
	"id"    	=> "bdaia_related_no_load_more",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle"
);

// Check Also.
$bd_options["post_settings"]["check_slso"][] = array(
	"name" 		=> "Fly Check Also Box",
	"type"  	=> "subtitle",
	"class"     => "fadeToggle"
);
$bd_options["post_settings"]["check_slso"][] = array(
	"name"    	=> "Check Also Box",
	"id"    	=> "check_also",
	"type"  	=> "checkbox",
	"class"     => "fadeToggle",
);
$bd_options["post_settings"]["check_slso"][] = array(
	"name" 		=> "Check Also Box Position",
	"id" 		=> "check_also_position",
	"type"  	=> "radio",
	"class"     => "fadeToggle",
	"options"   => array(
		"left"        => "Left",
		"right"       => "Right"
	),
);
$bd_options["post_settings"]["check_slso"][] = array(
	"name" 		=> "Query Type",
	"id" 		=> "check_also_query",
	"type"  	=> "radio",
	"class"     => "fadeToggle",
	"options"   => array(
		"categories"        => "Posts from the same Category",
		"tags"              => "Posts from the same Tag",
		"author"            => "Posts by the same Author",
		"posts_filter"      => "Multiple Posts filter",
	),
);
$bd_options["post_settings"]["check_slso"][] = array(
	"name" 		=> "Multiple Posts filter",
	"id"    	=> "check_also_query_posts_filter",
	"exp"       => "Filter multiple posts by ID( ex: 41, 352 ).",
	"type"  	=> "text",
	"class"     => "fadeToggle"
);