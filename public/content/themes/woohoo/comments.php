<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() )
{
	?><p class="no-comments"><?php echo woohoo__tr('This post is password protected. Enter the password to view comments.'); ?></p><?php
	return;
}

if ( have_comments() ) :
	?>
	<div id="comments" class="comments-container">
		<h4 class="block-title"><span><?php comments_number( woohoo__tr( 'No Comments' ), woohoo__tr( 'One Comment' ), '% ' . woohoo__tr( 'Comments' ) ); ?></span></h4>
		<ol class="commentlist">
			<?php wp_list_comments('callback=woohoo_comment'); ?>
		</ol>
		<div class="comments-navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
	</div>
	<?php
else :
	if ( comments_open() ) :
	else :
		?><p class="no-comments"><?php echo woohoo__tr( 'Comments are closed.' ); ?></p><?php
	endif;
endif;

comment_form();