<?php

function farvis_site_menu($class = null) {
    if (function_exists('wp_nav_menu')) {
        wp_nav_menu(array(
            'theme_location' => 'primary_nav',
            'container' => false,
            'menu_class' => $class,
            'walker' => new farvis_Walker_Menu(),
        ));
    }
}

function farvis_no_notice($var) {
    if (isset($var) && $var != '')
        return 1;
    else
        return 0;
}

function farvis_show_breadcrumbs(){
    if ( class_exists( 'WooCommerce' ) && !is_page_template( 'page-home.php' ) && is_woocommerce()) {
        woocommerce_breadcrumb();
    } elseif ( function_exists( 'farvis_breadcrumbs' ) && !is_page_template( 'page-home.php' ) ){
        farvis_breadcrumbs();
    }
}

// numbered pagination
function farvis_num_pagination( $pages = '', $range = 2 ) {
	 $showitems = ( $range * 2 ) + 1;

	 global $paged;
	 if ( empty( $paged ) )  { $paged = 1; }

	 if ( $pages == '' )
	 {
		 global $wp_query;
		 $pages = $wp_query->max_num_pages;
		 if ( ! $pages ) { $pages = 1; }
	 }

	 if ( 1 != $pages )
	 {
		 echo wp_kses_post('<div class="b-pagination text-center"><ul>');

		 if ( $paged > 1 && $showitems < $pages ) echo '<li><a href="' . esc_url( get_pagenum_link( esc_html( $paged ) - 1 ) ) . '"><i class="fa-chevron-left"></i></a></li>';

		 for ( $i = 1; $i <= $pages; $i++ )
		 {
			 if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) )
			 {
				echo wp_kses_post( ( $paged == $i ) ) ? '<li class="pag-current	"><a href="#">' . $i . '</a></li>' : '<li><a href="' . esc_url( get_pagenum_link($i) ) . '">' . esc_html( $i ) . '</a></li>';
			 }
		 }

		 if ( $paged < $pages && $showitems < $pages ) echo '<li><a href="' . esc_url( get_pagenum_link( esc_html( $paged ) + 1 ) ) . '"><i class="fa-chevron-right"></i></a></li>';

		 echo wp_kses_post('</ul></div>');
	 }
    
    
    
}

function farvis_wp_get_attachment( $attachment_id ) {
	$attachment = get_post( $attachment_id );
	return array(
		'alt' => is_object($attachment) ? get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ) : '',
		'caption' => is_object($attachment) ? $attachment->post_excerpt : '',
		'description' => is_object($attachment) ? $attachment->post_content : '',
		'href' => is_object($attachment) ? get_permalink( $attachment->ID ) : '',
		'src' => is_object($attachment) ? $attachment->guid : '',
		'title' => is_object($attachment) ? $attachment->post_title : ''
	);
}

function farvis_post_read_more(){
    $btn_name = farvis_get_option('blog_settings_readmore');
    $name = ($btn_name) ? $btn_name : esc_html__('Read More','farvis');
    return esc_attr($name);
}

function farvis_show_sidebar($type, $layout, $sidebar, $is_woo = 0) {

	$layouts = array(
		1 => 'full',
		2 => 'right',
		3 => 'left',
	);

    $sticky_bar = farvis_get_option('blog_settings_sidebar', 'on') == 'on' && !$is_woo ? 'sticky-bar' : '';

	if ( isset($layouts[$layout]) && $type === $layouts[$layout] ) {
		echo '<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 '.esc_attr($sticky_bar).' "><aside class="sidebar">';
		if ( is_active_sidebar( $sidebar ) ) : dynamic_sidebar( $sidebar ); endif;
		echo '</aside></div>';
	} else {
		echo '';
	}

}

function farvis_limit_words($string, $word_limit) {
    if($word_limit > 0) {
        $words = explode(' ', $string);
        if ($string == "")
            return '';
        else
            return implode(' ', array_slice($words, 0, $word_limit)) . '...';
    } else {
        return $string;
    }
}

function farvis_get_post_terms( $args = array() ) {

	$html = '';

	$defaults = array(
		'post_id'    => get_the_ID(),
		'taxonomy'   => 'category',
		'text'       => '%s',
		'before'     => '',
		'after'      => '',
		'items_wrap' => '<span>%s</span>',
		'sep'        => _x( ', ', 'taxonomy terms separator', 'farvis' )
	);

	$args = wp_parse_args( $args, $defaults );

	$terms = get_the_term_list( $args['post_id'], $args['taxonomy'], '', $args['sep'], '' );

	if ( !empty( $terms ) ) {
		$html .= $args['before'];
		$html .= sprintf( $args['items_wrap'], sprintf( $args['text'], $terms ) );
		$html .= $args['after'];
	}

	return $html;
}

function farvis_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
  $rgb = array($r, $g, $b);
//return $rgb; // returns an array with the rgb values
   return implode(",", $rgb); // returns the rgb values separated by commas
}

function farvis_breadcrumbs() {
	
	/* === Options === */
	$text['home'] = wp_kses_post(__('<i class="fa fa-home fa-lg"></i>', 'farvis'));
	$text['category'] = esc_html__('Archive "%s"', 'farvis');
	$text['search'] = esc_html__('Search results for "%s"', 'farvis');
	$text['tag'] = esc_html__('Posts with tag "%s"', 'farvis');
	$text['author'] = esc_html__('%s posts', 'farvis');
	$text['404'] = esc_html__('Error 404', 'farvis');
	$text['page'] = esc_html__('Page %s', 'farvis');
	$text['cpage'] = esc_html__('Comments page %s', 'farvis');
	
	$delimiter = '&nbsp;&nbsp;|&nbsp;&nbsp;';
	$delim_before = '';//'<span class="divider">';
	$delim_after = '';//'</span>'; 
	$show_home_link = 1;
	$show_on_home = 0;
	$show_title = 1;
	$show_current = 1;
	$before = '';
	$after = '';
	/* === End options === */
	
	global $post;
	$home_link = esc_url(home_url('/'));
	$link_before = '';
	$link_after = '';
	$link_attr = '';
	$link_in_before = '';
	$link_in_after = '';
	$link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
	$frontpage_id = get_option('page_on_front');
	$parent_id = isset($post) ? $post->post_parent : '';
	$delimiter = '&nbsp;&nbsp;|&nbsp;&nbsp;';// . $delim_before . $delimiter . $delim_after . ' ';
	
	if (is_home() || is_front_page()) {

		if ($show_on_home == 1) echo '<div class="breadcrumbsBox">' . wp_kses_post($text['home']) . '</div>';

	} else {

		echo '<div class="breadcrumbsBox path">';
		if ($show_home_link == 1) echo sprintf($link, $home_link, $text['home']);

		if ( is_category() ) {
            $cat = get_category(get_query_var('cat'), false);
            if ($cat->parent != 0) {
                $cats = get_category_parents($cat->parent, TRUE, $delimiter);
                $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
                if ($show_title == 0)
                    $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                if ($show_home_link == 1) echo wp_kses_post($delimiter);
                    echo wp_kses_post($cats);
            }
            if ( get_query_var('paged') ) {
                $cat = $cat->cat_ID;
                echo wp_kses_post($delimiter . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $delimiter . $before . sprintf($text['page'], get_query_var('paged')) . $after);
            } else {
                if ($show_current == 1) echo wp_kses_post($delimiter . $before . sprintf($text['category'], single_cat_title('', false)) . $after);
            }

        } elseif ( is_search() ) {
            if ($show_home_link == 1) echo wp_kses_post($delimiter);
            echo wp_kses_post($before . sprintf($text['search'], get_search_query()) . $after);

        } elseif ( is_day() ) {
            if ($show_home_link == 1) echo wp_kses_post($delimiter);
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;
            echo wp_kses_post($before . get_the_time('d') . $after);

        } elseif ( is_month() ) {
            if ($show_home_link == 1) echo wp_kses_post($delimiter);
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo wp_kses_post($before . get_the_time('F') . $after);

        } elseif ( is_year() ) {
            if ($show_home_link == 1) echo wp_kses_post($delimiter);
            echo wp_kses_post($before . get_the_time('Y') . $after);

        } elseif ( is_single() && !is_attachment() ) {
            if ($show_home_link == 1) echo wp_kses_post($delimiter);
            if ( get_post_type() == 'services'  ) {
                $cats = wp_get_object_terms($post->ID, 'services_category');
                if ($cats){
                    $cat_href = '';
                    foreach( $cats as $cat ){
                        $cat_href .= '<a href="'.get_term_link( $cat ).'"' . $link_attr . '>' . $link_in_before . $cat->name . $link_in_after . '</a>' . ", ";
                    }
                }
                echo wp_kses_post($cat_href != '' ? $link_before . substr($cat_href, 0, -2) . $link_after : '');
                if ($show_current == 1) echo wp_kses_post($delimiter . $before . get_the_title() . $after);
            } elseif ( get_post_type() == 'portfolio'  ) {
                $cats = wp_get_object_terms($post->ID, 'portfolio_category');
                if ($cats){
                    $cat_href = '';
                    foreach( $cats as $cat ){
                        $cat_href .= '<a href="'.get_term_link( $cat ).'"' . $link_attr . '>' . $link_in_before . $cat->name . $link_in_after . '</a>' . ", ";
                    }
                }
                echo wp_kses_post($cat_href != '' ? $link_before . substr($cat_href, 0, -2) . $link_after : '');
                if ($show_current == 1) echo wp_kses_post($delimiter . $before . get_the_title() . $after);
            } else {
                $cat = get_the_category();
                if(!empty($cat)) {
					$cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $delimiter);
					if ($show_current == 0 || get_query_var('cpage')) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					echo wp_kses_post($cats);
				} else {
					echo esc_html__('No Categories', 'farvis');
				}
                if ( get_query_var('cpage') ) {
                    echo wp_kses_post($delimiter . sprintf($link, get_permalink(), get_the_title()) . $delimiter . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after);
                } else {
                    if ($show_current == 1) echo wp_kses_post($before . get_the_title() . $after);
                }
            }

        // custom post type
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if ( get_query_var('paged') ) {
                echo wp_kses_post($delimiter . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $delimiter . $before . sprintf($text['page'], get_query_var('paged')) . $after);
            } else {
                if ($show_current == 1 && is_object($term))
                    echo wp_kses_post($delimiter . $before . $term->name . $after);
                else
                    echo wp_kses_post($delimiter . $before . $post_type->name . $after);
            }

        } elseif ( is_attachment() ) {
            if ($show_home_link == 1) echo wp_kses_post($delimiter);
            $parent = get_post($parent_id);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            if ($cat) {
                $cats = get_category_parents($cat, TRUE, $delimiter);
                $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
                echo wp_kses_post($cats);
            }
            printf($link, get_permalink($parent), $parent->post_title);
            if ($show_current == 1) echo wp_kses_post($delimiter . $before . get_the_title() . $after);

        } elseif ( is_page() && !$parent_id ) {

            if ($show_current == 1) echo wp_kses_post($delimiter . $before . get_the_title() . $after);

        } elseif ( is_page() && $parent_id ) {

            if ($show_home_link == 1) echo wp_kses_post($delimiter);
            if ($parent_id != $frontpage_id) {
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    if ($parent_id != $frontpage_id) {
                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    }
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo wp_kses_post($breadcrumbs[$i]);
                    if ($i != count($breadcrumbs)-1) echo wp_kses_post($delimiter);
                }
            }
            if ($show_current == 1) echo wp_kses_post($delimiter . $before . get_the_title() . $after);

        } elseif ( is_tag() ) {
            if ($show_current == 1) echo wp_kses_post($delimiter . $before . sprintf($text['tag'], single_tag_title('', false)) . $after);

        } elseif ( is_author() ) {
            if ($show_home_link == 1) echo wp_kses_post($delimiter);
            global $author;
            $author = get_userdata($author);
            echo wp_kses_post($before . sprintf($text['author'], $author->display_name) . $after);

        } elseif ( is_404() ) {
            if ($show_home_link == 1) echo wp_kses_post($delimiter);
            echo wp_kses_post($before . $text['404'] . $after);

        } elseif ( has_post_format() && !is_singular() ) {
            if ($show_home_link == 1) echo wp_kses_post($delimiter);
            echo get_post_format_string( get_post_format() );
        }

		echo '</div><!-- .breadcrumbs -->';

 	}
	
} // end farvis_breadcrumbs() 

// Show admin notice
if ( !function_exists( 'pix_admin_notice' ) ) {
    function pix_admin_notice() {
      $message  = "<p>" . esc_html__("Thank you for purchasing our theme.  Please install required Plugins and import demo content. ", "farvis") . "</p>";
      if(pixtheme_check_is_activated()){
         $message  = "<p>" . esc_html__("Thank you for purchasing our theme.", "farvis") . "</p>";
      }
        add_option('pix_admin_notice', '1');
        $screen = get_current_screen();
        if ( $screen->id != 'appearance_page_adminpanel' ) {
            if ( get_option('pix_admin_notice') ) {
                echo "
                    <div class='update-nag' id='pix_admin_notice'>
                        <h3 class='pix_notice_title'>" . esc_html__("Welcome to farvis", "farvis") . "</h3>" .
                        $message . 
                        "<p>
                            <a href='" . admin_url('themes.php?page=adminpanel') . "' class='button button-primary'><i class='dashicons dashicons-nametag'></i>" . esc_html__("Read more", "farvis") . "</a>
                            <a href='#' class='button pix_hide_notice'><i class='dashicons dashicons-dismiss'></i> " . esc_html__("Hide notice", "farvis") . "</a>
                        </p>
                    </div>
                ";
            }
        }
    }
}
if (current_user_can('switch_themes')) {
    add_action('admin_notices', 'pix_admin_notice', 2);
}

// Hide admin notice
if ( !function_exists( 'pix_callback_hide_admin_notice' ) ) {
    function pix_callback_hide_admin_notice() {
        update_option('pix_admin_notice', '0');
        exit;
    }
}
add_action('wp_ajax_pix_hide_admin_notice', 'pix_callback_hide_admin_notice');

// Update admin notice status 
if ( !function_exists( 'pix_admin_notice_update' ) ) {
    function pix_admin_notice_update() {
        update_option('pix_admin_notice', '1');
    }
}
add_action('after_switch_theme', 'pix_admin_notice_update');
