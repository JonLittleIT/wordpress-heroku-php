<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

if ( comments_open() || get_comments_number() )
{
	if( ! woohoo_get_option( 'bdaia_p_commetns_posts_click_btn' ) ) {
		echo "<div class='bdaia-load-comments-btn'>"; comments_popup_link( woohoo__tr( 'Click To Comment' ), '1 ' . woohoo__tr( 'Comment' ), '% ' . woohoo__tr( 'Comments' ) ); echo "</div>";
	}
	
	comments_template();
}
else
{
	echo "<div class='woohoo-comments-closed'>".woohoo__tr( 'Comments are closed.' )."</div>";
}