<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly

function woohoo_breadcrumbs() {
	global $post;

	if( is_rtl() ) $bd_delimiter = '<span class="bdaia-io bdaia-io-angle-double-left"></span>';
	else $bd_delimiter = '<span class="bdaia-io bdaia-io-angle-double-right"></span>';

	$delimiter  = '<span class="delimiter">';
	$delimiter .= $bd_delimiter;
	$delimiter .= '</span>';
	$before     = '<span class="current">';
	$after      = '</span>';

	if ( !is_home() && !is_front_page() || is_paged() ) {

		echo '<div class="bdaia-crumb-container">';
		
		$homeLink = esc_url(home_url());
		echo '<span><a class="crumbs-home" href="' . $homeLink . '">' . woohoo__tr( 'Home' ) . '</a></span> ' . $delimiter . ' ';

		if ( is_category() ) {

			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);

			if ( $thisCat->parent != 0 )
			{
				if( !is_wp_error( $cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ') ) )
				{
					$cat_code = str_replace ('<a','<span><a', $cat_code );
					echo $cat_code = str_replace ('</a>','</a></span>', $cat_code );
				}
			}
			echo $before . '' . single_cat_title('', false) . '' . $after;

		}
		elseif ( is_day() ) {

			echo '<span ><a  href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></span> ' . $delimiter . ' ';
			echo '<span ><a  href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></span> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;

		}
		elseif ( is_month() ) {

			echo '<span ><a  href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></span> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;

		}
		elseif ( is_year() ) {

			echo $before . get_the_time('Y') . $after;

		}
		elseif ( is_single() && !is_attachment() ) {

			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<span ><a  href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></span> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				if( !empty( $cat ) ){
					if( !is_wp_error( $cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ') ) ){
						$cat_code = str_replace ('<a','<span ><a ', $cat_code );
						echo $cat_code = str_replace ('</a>','</a></span>', $cat_code );
					}
				}
				echo $before . get_the_title() . $after;
			}

		}
		elseif ( ( is_page() && ! $post->post_parent ) || ( function_exists('bp_current_component') && bp_current_component() ) ) {
			echo $before . get_the_title() . $after;
		}
		elseif ( is_search() ) {

			echo $before ;
			printf( woohoo__tr( 'Search Results for:' ) . ' %s',  get_search_query() );
			echo  $after;

		}
		elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {

			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {

			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo '<span ><a  href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></span> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;

		}
		elseif ( is_page() && $post->post_parent ) {

			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<span ><a  href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></span>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;

		}
		elseif ( is_tag() ) {

			echo $before ;
			printf( woohoo__tr( 'Tag Archives:' ) . ' %s', single_tag_title( '', false ) );
			echo  $after;

		} elseif ( is_author() ) {

			global $author;
			$userdata = get_userdata($author);
			echo $before ;
			echo $userdata->display_name;
			echo  $after;

		} elseif ( is_404() ) {
			echo $before;
			woohoo_tr( 'Not Found' );
			echo  $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo woohoo__tr( 'page' ) . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div><div class="bdayh-clearfix"></div><!-- END breadcrumbs. -->';

	}
	wp_reset_query();

}