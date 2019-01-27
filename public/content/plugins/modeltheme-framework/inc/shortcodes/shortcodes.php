<?php 
/* ------------------------------------------------------------------
[Modeltheme - SHORTCODES]

[Table of contents]
    Recent Tweets
    Contact Form
    Recent Posts
    Featured Post with thumbnail
    Subscribe form
    Skill
    Pricing tables
    Jumbot
    Alert
    Progress bars
    Custom content
    Responsive video (YouTube)
    Heading With Border
    Testimonials
    List group
    Thumbnails custom content
    Section heading with title and subtitle
    Section heading with title
    Heading with bottom border
    Call to action
    Blog posts
    Social Media
    Quotes
    Banner
    Our Services
    Quotes Slider
    Courses
------------------------------------------------------------------ */



include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


include_once( 'mt-members/mt-members-slider.php' ); # Members 01
include_once( 'mt-services/mt_custom_service.php' ); # Services 03
include_once( 'mt-contact/mt-contact01.php' );
include_once( 'mt-blog-posts/mt-blogpost01.php' ); # Blog Post
include_once( 'mt-testimonials/mt-testimonials01.php' ); # Testimonials 01
include_once( 'mt-testimonials/mt-testimonials02.php' ); # Testimonials 02
include_once( 'mt-clients/mt-clients.php' ); # Clients
include_once( 'mt-title-subtitle/mt-title-subtitle.php' ); # Title Subtitle
include_once( 'mt-social-icons/mt-social-icons.php' ); # Social Icons
include_once( 'mt-featured-post/mt-featured-post.php' ); # Featured Post
include_once( 'mt-skills/mt-skills.php' ); # Skills
include_once( 'mt-skills-circle/mt-skills-circle.php' ); # Skills Cricle
include_once( 'mt-pricing-tables/mt-pricing-tables.php' ); # Pricing Tables
include_once( 'mt-countdown/mt-countdown.php' ); # Countdown
include_once( 'mt-icon-list-item/mt-icon-list-item.php' ); # Mailchimp Subscribe Form
include_once( 'mt-typed-text/mt-typed-text.php' ); # Typed text
include_once( 'mt-video/mt-video.php' ); # Video
include_once( 'mt-segment-background/mt-segment-background.php' ); # Video
include_once( 'mt-mailchimp-subscribe-form/mt-mailchimp-subscribe-form.php' ); # Mailchimp Subscribe Form
include_once( 'mt-featured-product/mt-featured-product.php' ); # Featured Product
include_once( 'mt-portfolio-grid/mt-portfolio-grid.php' ); # Porfolio Grid
include_once( 'mt-featured-portfolio/mt-featured-portfolio.php' ); # Featured Porfolio





// BOOTSTRAP ELEMENTS
include_once( 'mt-bootstrap-alert/mt-bootstrap-alert.php' ); # Bootstrap Alerts
include_once( 'mt-bootstrap-jumbotron/mt-bootstrap-jumbotron.php' ); # Bootstrap Jumbotron
include_once( 'mt-bootstrap-panel/mt-bootstrap-panel.php' ); # Bootstrap Panel
include_once( 'mt-bootstrap-thumbnails-custom-content/mt-bootstrap-thumbnails-custom-content.php' ); # Bootstrap Thumbnails Custom Content
include_once( 'mt-bootstrap-listgroup/mt-bootstrap-listgroup.php' ); # Bootstrap List Group
include_once( 'mt-bootstrap-progress-bars/mt-bootstrap-progress-bars.php' ); # Bootstrap List Group
include_once( 'mt-bootstrap-button/mt-bootstrap-button.php' ); # Bootstrap Buttons
include_once( 'mt-bubble-box/mt-bubble-box.php' ); # Bootstrap Buttons








/**

||-> JS_COMPOSER Register Shortcodes

*/
// check for plugin using plugin name
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    // REMOVE CV Shortcodes
    // vc_remove_element( "vc_progress_bar" );

} 







?>