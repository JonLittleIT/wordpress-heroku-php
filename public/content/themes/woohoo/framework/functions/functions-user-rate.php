<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

add_action('wp_ajax_nopriv_woohoo_rate_post', 'woohoo_rate_post');
add_action('wp_ajax_woohoo_rate_post', 'woohoo_rate_post');
function woohoo_rate_post()
{
	global $user_ID;

	$count      = $rating = $rate = 0;
	$postID     = $_REQUEST['post'];
	$rate       = abs($_REQUEST['value']);
	if( $rate > 5 ) $rate = 5;

	if( is_numeric( $postID ) )
	{
		$rating = get_post_meta( $postID, 'woohoo_user_rate' , true);
		$count  = get_post_meta( $postID, 'woohoo_users_num' , true);

		if( empty( $count ) || $count == '' ) $count = 0;

		$count++;
		$total_rate = $rating + $rate;
		$total = round($total_rate/$count , 2);

		if ( $user_ID )
		{
			$user_rated = get_the_author_meta( 'woohoo_rated', $user_ID  );

			if( empty($user_rated) )
			{
				$user_rated[$postID] = $rate;
				update_user_meta( $user_ID, 'woohoo_rated', $user_rated );
				update_post_meta( $postID, 'woohoo_user_rate', $total_rate );
				update_post_meta( $postID, 'woohoo_users_num', $count );
				echo $total;
			}
			else
			{
				if( !array_key_exists($postID , $user_rated) )
				{
					$user_rated[$postID] = $rate;
					update_user_meta( $user_ID, 'woohoo_rated', $user_rated );
					update_post_meta( $postID, 'woohoo_user_rate', $total_rate );
					update_post_meta( $postID, 'woohoo_users_num', $count );
					echo $total;
				}
			}
		}
		else
		{
			$user_rated = $_COOKIE["woohoo_rate_".$postID];

			if( empty($user_rated) )
			{
				setcookie( 'woohoo_rate_'.$postID , $rate , time()+31104000 , '/');
				update_post_meta( $postID, 'woohoo_user_rate', $total_rate );
				update_post_meta( $postID, 'woohoo_users_num', $count );
			}
		}
	}
	die;
}

/**
Get user rate result
 * ----------------------------------------------------------------------------- */
function woohoo_get_user_rate()
{
	global $post , $user_ID;
	$disable_rate = false ;

	if( !empty($disable_rate) ){
		$no_rate_text = woohoo__tr( 'No Ratings Yet !' );
		$rate_active = false ;
	}
	else{
		$no_rate_text = woohoo__tr( 'Be the first one !' );
		$rate_active = ' user-rate-active' ;
	}

	$rate   = get_post_meta( $post->ID , 'woohoo_user_rate', true );
	$count  = get_post_meta( $post->ID , 'woohoo_users_num', true );

	if( !empty($rate) && !empty($count))
	{
		$total = (($rate/$count)/5)*100;
		$totla_users_score = round($rate/$count,2);
	}
	else
	{
		$totla_users_score = $total = $count = 0;
	}

	if ( $user_ID )
	{
		$user_rated = get_the_author_meta( 'woohoo_rated' , $user_ID ) ;

		if( !empty($user_rated) && is_array($user_rated) && array_key_exists($post->ID , $user_rated) )
		{
			$user_rate = round( ($user_rated[$post->ID]*100)/5 , 2);
			return $output ='
<tr class="user-rate-wrap">
	<td class="user-rating-text">
		<strong>' . woohoo__tr( "Your Rating" ) . ' </strong>
		<span class="user-rating-score">'.$user_rated[$post->ID].'</span>
		<small>( <span class="user-rating-count">' . $count . '</span> ' . woohoo__tr( "votes" ) . ')</small>
	</td>
	<th>
		<div data-rate="'. $user_rate .'" class="rate-post-'.$post->ID.' user-rate rated-done" title="" >
			<div class="woohoo-star-rating">
				<span style="width:'. $user_rate .'%"></span>
			</div>
		</div>	
	</th>
</tr>';
		}
	}
	else
	{
		$user_rate = $_COOKIE["woohoo_rate_".$post->ID] ;
		if( !empty($user_rate) )
		{
			return $output ='
<tr class="user-rate-wrap">
	<td class="user-rating-text">
		<strong>' . woohoo__tr( "Your Rating" ) . ' </strong>
		<span class="user-rating-score">' . $user_rate . '</span>
		<small>( <span class="user-rating-count">' . $count . '</span> ' . woohoo__tr( "votes" ) . ')</small>
	</td>
	<th>
		<div class="rate-post-'.$post->ID.' user-rate rated-done" title="" >
			<div class="woohoo-star-rating">
				<span style="width:'. (($user_rate*100)/5) .'%"></span>
			</div>
		</div>	
	</th>
</tr>';
		}

	}
	if( $total == 0 && $count == 0 )
	{
		return $output ='
<tr class="user-rate-wrap">
	<td class="user-rating-text">
		<strong>' . woohoo__tr( "User Rating" ) . ' </strong>
		<span class="user-rating-score">' . $totla_users_score . '</span>
		<small>'. $no_rate_text .'</small>
	</td>
	<th>
		<div data-rate="' . $total . '" data-id="' . $post->ID . '" class="rate-post-' . $post->ID . ' user-rate' . $rate_active . '">
			<div class="woohoo-star-rating">
				<span style="width:' . $total . '%"></span>
			</div>
		</div>	
	</th>
</tr>';
	}
	else
	{
		return $output ='
<tr class="user-rate-wrap">
	<td class="user-rating-text">
		<strong>'. woohoo__tr( "User Rating" ) .' </strong>
		<span class="user-rating-score">' . $totla_users_score . '</span>
		<small>( <span class="user-rating-count">' . $count . '</span> '. woohoo__tr( "votes" ) .')</small>
	</td>
	<th>
		<div data-rate="' . $total . '" data-id="' . $post->ID . '" class="rate-post-' . $post->ID . ' user-rate' . $rate_active . '">
			<div class="woohoo-star-rating">
				<span style="width:' . $total . '%"></span>
			</div>
		</div>	
	</th>
</tr>';
	}
}

function woohoo_get_user_rating()
{
	$output = "";
	$users_rate = woohoo_get_user_rate();
	$output .= $users_rate;
	return $output;
}