<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

$timebeforerevote = 1;

if( ! function_exists( 'woohoo_post_like' ) )
{
	add_action('wp_ajax_nopriv_woohoo_post_like', 'woohoo_post_like');
	add_action('wp_ajax_woohoo_post_like', 'woohoo_post_like');

	function woohoo_post_like()
	{
		$nonce = $_POST['nonce'];

		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
			die ( 'Busted!');

		if(isset($_POST['bdaia_post_like']))
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			$post_id = $_POST['post_id'];

			$meta_IP = get_post_meta($post_id, "voted_IP");

			$voted_IP = isset( $meta_IP[0] );
			if(!is_array($voted_IP))
				$voted_IP = array();

			$meta_count = get_post_meta( $post_id, "votes_count", true );

			if( ! woohoo_hasAlreadyVoted( $post_id ) )
			{
				$voted_IP[$ip] = time();

				update_post_meta($post_id, "voted_IP", $voted_IP);
				update_post_meta($post_id, "votes_count", ++$meta_count);

				echo $meta_count;
			}
			else
				echo "already";
		}
		exit;
	}
}

if( ! function_exists( 'woohoo_hasAlreadyVoted' ) )
{
	function woohoo_hasAlreadyVoted( $post_id )
	{
		global $timebeforerevote;

		$meta_IP = get_post_meta( $post_id, "voted_IP" );

		$voted_IP = "";
		if( isset($meta_IP[0]) ){
			$voted_IP = $meta_IP[0];
		}

		if(!is_array($voted_IP)) {
			$voted_IP = array();
		}

		$ip = $_SERVER['REMOTE_ADDR'];

		if(in_array($ip, array_keys($voted_IP)))
		{
			$time = $voted_IP[$ip];
			$now = time();

			if(round(($now - $time) / 60) > $timebeforerevote)
				return false;

			return true;
		}
		return false;
	}

}

if( ! function_exists( 'woohoo_getPostLikeLink' ) )
{
	function woohoo_getPostLikeLink($post_id)
	{

		$vote_count = get_post_meta($post_id, "votes_count", true);

		$output = '<span class="post-like">';
		if( woohoo_hasAlreadyVoted( $post_id ) )
			$output .= ' <span title="'.woohoo__tr('I like this article').'" class="qtip like alreadyvoted"><span class="bdaia-io bdaia-io-heart"></span></span>';
		else
			$output .= '<a href="#" data-post_id="'.$post_id.'">
					<span  title="'.woohoo__tr('I like this article').'"class="qtip like"><span class="bdaia-io bdaia-io-heart"></span></span>
				</a>';
		if($vote_count)
			$output .= '<em class="count">'.$vote_count.'</em></span>';
		else
			$output .= '<em class="count">0</em></span>';
		return $output;
	}
}