<?php /*
	Plugin >> Name: WP-PageNavi
	Plugin URI: http://lesterchan.net/portfolio/programming/php/
	Description: Adds a more advanced paging navigation to your WordPress blog.
	Version: 2.50
	Author: Lester 'GaMerZ' Chan
	Author URI: http://lesterchan.net

	Copyright 2009  Lester Chan  (email : lesterchan@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

### Function: Page Navigation: Boxed Style Paging
function woohoo_get_pagenavi($query = false, $num = false , $before = '', $after = '')
{
	global $wpdb, $wp_query, $paged;
	$pagenavi_options = woohoo_pagenavi_init();

	if (!is_single()) {


		if( !empty($query) ){
			$request = $query->request;
			$numposts = $query->found_posts;
			$max_page = $query->max_num_pages;
			$posts_per_page = intval($num);
		}else{
			$request = $wp_query->request;
			$posts_per_page = intval(get_query_var('posts_per_page'));
			$paged = intval(get_query_var('paged'));
			$numposts = $wp_query->found_posts;
			$max_page = $wp_query->max_num_pages;
		}

		$paged = intval(get_query_var('paged'));
		$paged_2 = intval(get_query_var('page'));

		if( empty( $paged ) && !empty( $paged_2 )  ) {
			$paged = intval(get_query_var('page'));
		}

		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}

		$pages_to_show = intval($pagenavi_options['num_pages']);
		$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
		$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
		$pages_to_show_minus_1 = $pages_to_show - 1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}

		$larger_per_page = $larger_page_to_show*$larger_page_multiple;
		$larger_start_page_start = (woohoo_n_round($start_page, 10) + $larger_page_multiple) - $larger_per_page;
		$larger_start_page_end = woohoo_n_round($start_page, 10) + $larger_page_multiple;
		$larger_end_page_start = woohoo_n_round($end_page, 10) + $larger_page_multiple;
		$larger_end_page_end = woohoo_n_round($end_page, 10) + ($larger_per_page);
		if($larger_start_page_end - $larger_page_multiple == $start_page) {
			$larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
			$larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
		}
		if($larger_start_page_start <= 0) {
			$larger_start_page_start = $larger_page_multiple;
		}
		if($larger_start_page_end > $max_page) {
			$larger_start_page_end = $max_page;
		}
		if($larger_end_page_end > $max_page) {
			$larger_end_page_end = $max_page;
		}

		if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
			$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
			$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);

			previous_posts_link($pagenavi_options['prev_text']);
			if ($start_page >= 2 && $pages_to_show < $max_page) {
				$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
				echo '<a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">'.$first_page_text.'</a>';
				if(!empty($pagenavi_options['dotleft_text']) && ($start_page > 2)) {
					echo '<span class="extend">'.$pagenavi_options['dotleft_text'].'</span>';
				}
			}
//            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
//                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
//                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
//                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="page" title="'.$page_text.'">'.$page_text.'</a>';
//                }
//	            echo '<span class="extend">'.$pagenavi_options['dotleft_text'].'</span>';
//            }

			for($i = $start_page; $i  <= $end_page; $i++) {
				if($i == $paged) {
					$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
					echo '<span class="current">'.$current_page_text.'</span>';
				} else {
					$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
					echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="page" title="'.$page_text.'">'.$page_text.'</a>';
				}
			}

//            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
//	            echo '<span class="extend">'.$pagenavi_options['dotright_text'].'</span>';
//                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
//                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
//                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="page" title="'.$page_text.'">'.$page_text.'</a>';
//                }
//            }
			if ($end_page < $max_page) {
				if(!empty($pagenavi_options['dotright_text']) && ($end_page + 1 < $max_page)) {
					echo '<span class="extend">'.$pagenavi_options['dotright_text'].'</span>';
				}

				$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
				echo '<a href="'.esc_url(get_pagenum_link($max_page)).'" title="'.$last_page_text.'">'.$last_page_text.'</a>';
			}

			if( !empty($query) ){
				next_posts_link( $pagenavi_options['next_text'], $query->max_num_pages );
			}
			else {
				next_posts_link( $pagenavi_options['next_text'], $max_page );
            }

			if(!empty($pages_text)) {
				echo '<span class="pages">'.$pages_text.'</span>';
			}

		}

	}
}

### Function: Round To The Nearest Value
function woohoo_n_round($num, $tonearest) {
	return floor($num/$tonearest)*$tonearest;
}

### Function: Page Navigation Options
function woohoo_pagenavi_init() {
	$pagenavi_options = array();
	$pagenavi_options['pages_text'] = woohoo__tr( 'Page' ) . ' %CURRENT_PAGE% ' . woohoo__tr( 'of' ) . ' %TOTAL_PAGES%';
	$pagenavi_options['current_text'] = '%PAGE_NUMBER%';
	$pagenavi_options['page_text'] = '%PAGE_NUMBER%';
	$pagenavi_options['first_text'] = 1;
	$pagenavi_options['last_text'] = "%TOTAL_PAGES%";

	if( is_rtl() ) {
		$pagenavi_options['next_text'] = '<span class="bdaia-io bdaia-io-angle-left"></span>';
		$pagenavi_options['prev_text'] = '<span class="bdaia-io bdaia-io-angle-right"></span>';
	}
	else {
	    $pagenavi_options['next_text'] = '<span class="bdaia-io bdaia-io-angle-right"></span>';
	    $pagenavi_options['prev_text'] = '<span class="bdaia-io bdaia-io-angle-left"></span>';
	}

	$pagenavi_options['dotright_text'] = '...';
	$pagenavi_options['dotleft_text'] = '...';

	$pagenavi_options['num_pages'] = 3;
	$pagenavi_options['always_show'] = 0;
	$pagenavi_options['num_larger_page_numbers'] = 3;
	$pagenavi_options['larger_page_numbers_multiple'] = 1000;

	return $pagenavi_options;
}