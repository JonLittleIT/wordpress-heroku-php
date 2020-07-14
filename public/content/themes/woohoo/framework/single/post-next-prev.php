<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>
<div class="bdaia-post-next-prev">
	<div class="bdaia-post-prev-post">
		<?php previous_post_link( '%link', '<span>'. woohoo__tr( 'Previous article' ).'</span> %title' ); ?>
	</div>
	<div class="bdaia-post-next-post">
		<?php next_post_link( '%link', '<span>'. woohoo__tr( 'Next article' ).'</span> %title' ); ?>
	</div>
</div>
<!-- END Previous/Next article. -->