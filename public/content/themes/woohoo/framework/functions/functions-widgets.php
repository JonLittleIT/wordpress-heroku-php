<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

include ( get_template_directory().'/includes/widgets/bdaia-widget-social-counter.php'  );
include ( get_template_directory().'/includes/widgets/bdaia-widget-social-links.php'    );
include ( get_template_directory().'/includes/widgets/bdaia-widget-box1.php'        );
include ( get_template_directory().'/includes/widgets/bdaia-widget-box2.php'        );
include ( get_template_directory().'/includes/widgets/bdaia-widget-box3.php'        );
include ( get_template_directory().'/includes/widgets/bdaia-widget-box4.php'        );
include ( get_template_directory().'/includes/widgets/bdaia-widget-box5.php'        );
include ( get_template_directory().'/includes/widgets/bdaia-widget-box6.php'        );
include ( get_template_directory().'/includes/widgets/bdaia-widget-box7.php'        );
include ( get_template_directory().'/includes/widgets/bdaia-widget-box8.php'        );
include ( get_template_directory().'/includes/widgets/bdaia-widget-tabs.php'        );
include ( get_template_directory().'/includes/widgets/bdaia-widget-timeline.php'    );
include ( get_template_directory().'/includes/widgets/bdaia-widget-facebook.php'    );
include ( get_template_directory().'/includes/widgets/bdaia-widget-google.php'      );
include ( get_template_directory().'/includes/widgets/bdaia-widget-login.php'       );
include ( get_template_directory().'/includes/widgets/bdaia-widget-twittes.php'     );
include ( get_template_directory().'/includes/widgets/bdaia-widget-e3.php'          );
include ( get_template_directory().'/includes/widgets/bdaia-widget-comments.php'    );
include ( get_template_directory().'/includes/widgets/bdaia-widget-html.php'        );


/**
 * Sidebars
 * ----------------------------------------------------------------------------- *
 */
function woohoo_widget_title($title)
{
    if( empty( $title ) )
        return ' ';
    else return $title;
}
add_filter('widget_title', 'woohoo_widget_title');

function woohoo_widgets()
{
    $before_widget                  =  '<div id="%1$s" class="widget bdaia-widget %2$s">'."\n";
    $after_widget                   =  '</div>'."\n".'</div>';
    $before_title                   =  '<h4 class="block-title"><span>';
    $after_title                    =  '</span></h4>'."\n".'<div class="widget-inner">'."\n";

    register_sidebar(
        array(
            'name'                  =>  woohoo__tr('Primary Normal Widget Area'),
            'id'                    => 'primary-widget',
            'description'           => woohoo__tr('The Primary Normal widget area appears in all pages .'),
            'before_widget'         => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
        )
    );

    register_sidebar(
        array(
            'name'                  =>  woohoo__tr('Post Sidebar'),
            'id'                    => 'post-widget',
            'description'           => woohoo__tr('This sidebar will be used by all of your posts .'),
            'before_widget'         => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
        )
    );

    register_sidebar(
        array(
            'name'                  =>  woohoo__tr('Page Sidebar'),
            'id'                    => 'page-widget',
            'description'           => woohoo__tr('This sidebar will be used by all of your standard pages .'),
            'before_widget'         => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
        )
    );

    register_sidebar(
        array(
            'name'                  =>  woohoo__tr('Categories Sidebar'),
            'id'                    => 'categories-widget',
            'description'           => woohoo__tr('This sidebar will be used by all of your standard categories .'),
            'before_widget'         => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
        )
    );

    /* Woocommerce */
    if (class_exists('Woocommerce'))
    {
        register_sidebar(
            array(
                'name'                  =>  woohoo__tr('Shop'),
                'id'                    => 'woocommerce-widget',
                'description'           => woohoo__tr('This sidebar will be used by all of your standard Woocommerce .'),
                'before_widget'         => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
            )
        );
    }

	$footer_widgets_col = woohoo_get_option( 'footerWidgetsColumns' );
	$footer_widgets     = woohoo_get_option( 'footerWidgets' );

	if( $footer_widgets ) {

		register_sidebar( array(
			'name'              => woohoo__tr( 'First Footer Widget Area' ),
			'id'                => 'first-footer-widget-area',
			'description'       => woohoo__tr( 'The first footer widget area' ),
			'before_widget'     => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
		) );

		if( $footer_widgets_col == 'col_two' || $footer_widgets_col == 'col_three' || $footer_widgets_col == 'col_four' ) {
			register_sidebar( array(
				'name'          => woohoo__tr( 'Second Footer Widget Area' ),
				'id'            => 'second-footer-widget-area',
				'description'   => woohoo__tr( 'The Second footer widget area' ),
				'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
			) );
		}

		if( $footer_widgets_col == 'col_three' || $footer_widgets_col == 'col_four' ) {
			register_sidebar( array(
				'name'          =>  woohoo__tr( 'Third Footer Widget Area' ),
				'id'            => 'third-footer-widget-area',
				'description'   => woohoo__tr( 'The Third footer widget area' ),
				'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
			) );
		}

		if( $footer_widgets_col == 'col_four' ) {
			register_sidebar( array(
				'name'          => woohoo__tr( 'Fourth Footer Widget Area' ),
				'id'            => 'fourth-footer-widget-area',
				'description'   => woohoo__tr( 'The Fourth footer widget area' ),
				'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
			) );
		}
	}

}
add_action( 'widgets_init', 'woohoo_widgets' );


/**
 * Widget Ajax ========================================================= */

function woohoo_wboxs_ajax_init()
{
	wp_localize_script( 'jquery', 'bd_w_blocks',
		array(
			'bdaia_w_ajax_url'       => admin_url( 'admin-ajax.php' ),
			'bdaia_w_ajax_nonce'     => wp_create_nonce( 'ajax-nonce' ),
		)
	);
	add_action( "wp_ajax_bdaia_wboxs", "woohoo_wboxs_ajax" );
	add_action( "wp_ajax_nopriv_bdaia_wboxs", "woohoo_wboxs_ajax" );
}
add_action( 'init', 'woohoo_wboxs_ajax_init' );

function woohoo_wboxs_ajax()
{
	$paged      = 1;
	$box_nu     = $nonce = $sort_order = $num_posts = $tag_slug = $cat_uid = $cat_uids = $posts = "";

	if ( isset ( $_POST['nonce'] )      ) $nonce        = $_POST['nonce'];
	if ( isset ( $_POST['box_nu'] )     ) $box_nu       = $_POST['box_nu'];
	if ( isset ( $_POST['sort_order'] ) ) $sort_order   = $_POST['sort_order'];
	if ( isset ( $_POST['num_posts'] )  ) $num_posts    = $_POST['num_posts'];
	if ( isset ( $_POST['tag_slug'] )   ) $tag_slug     = $_POST['tag_slug'];
	if ( isset ( $_POST['cat_uid'] )    ) $cat_uid      = $_POST['cat_uid'];
	if ( isset ( $_POST['cat_uids'] )   ) $cat_uids     = $_POST['cat_uids'];
	if ( isset ( $_POST['paged'] )      ) $paged        = $_POST['paged'];
	if ( isset ( $_POST['posts'] )      ) $posts        = $_POST['posts'];
	if ( isset ( $_POST['thumbnail'] )  ) $thumbnail    = $_POST['thumbnail'];
	if ( isset ( $_POST['review'] )     ) $review       = $_POST['review'];
	if ( isset ( $_POST['author_meta'] )) $author_meta  = $_POST['author_meta'];
	if ( isset ( $_POST['date_meta'] )  ) $date_meta    = $_POST['date_meta'];
	if ( isset ( $_POST['com_meta'] )   ) $com_meta     = $_POST['com_meta'];

	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
		die ( 'Nope!' );
	}

	if ( $box_nu == 'wb1' )
	{
		$get_class1     = new WOOHOO_WIDGET_BOX1();

		$bdaia_wcq1     = $get_class1->widget_query( $sort_order, $num_posts, $tag_slug, $cat_uid, $cat_uids, $paged, $posts );

			if ( $bdaia_wcq1->have_posts() ) :
			while ( $bdaia_wcq1->have_posts() ) : $bdaia_wcq1->the_post();
				echo $get_class1->widget_loop( $thumbnail, $review, $author_meta, $date_meta, $com_meta );
			endwhile;
			wp_reset_postdata();
		endif;
	}
	elseif ( $box_nu == 'wb2' )
	{
		$get_class2     = new WOOHOO_WIDGET_BOX2();
		$bdaia_wcq2     = $get_class2->widget_query( $sort_order, $num_posts, $tag_slug, $cat_uid, $cat_uids, $paged, $posts );

		if ( $bdaia_wcq2->have_posts() ) :
			while ( $bdaia_wcq2->have_posts() ) : $bdaia_wcq2->the_post();
				echo $get_class2->widget_loop( $thumbnail, $review, $author_meta, $date_meta, $com_meta );
			endwhile;
			wp_reset_postdata();
		endif;
	}
	elseif ( $box_nu == 'wb3' )
	{
		$get_class3     = new WOOHOO_WIDGET_BOX3();
		$bdaia_wcq3     = $get_class3->widget_query( $sort_order, $num_posts, $tag_slug, $cat_uid, $cat_uids, $paged, $posts );

		if ( $bdaia_wcq3->have_posts() ) :
			while ( $bdaia_wcq3->have_posts() ) : $bdaia_wcq3->the_post();
				if( $GLOBALS['bdaia_wbc_1'] % 2 == 1 ) echo '<div class="bdaia-box-row">';
				echo $get_class3->widget_loop( $thumbnail, $review, $author_meta, $date_meta, $com_meta );
				if( $GLOBALS['bdaia_wbc_1'] % 2 == 0 ) echo "</div>\n"; $GLOBALS['bdaia_wbc_1']++;
			endwhile;
			wp_reset_postdata();
		endif;
		if ( $GLOBALS['bdaia_wbc_1'] % 2 != 1 ) echo "</div>";
	}
	elseif ( $box_nu == 'wb4' )
	{
		$get_class4     = new WOOHOO_WIDGET_BOX4();
		$bdaia_wcq4     = $get_class4->widget_query( $sort_order, $num_posts, $tag_slug, $cat_uid, $cat_uids, $paged, $posts );

		if ( $bdaia_wcq4->have_posts() ) :
			while ( $bdaia_wcq4->have_posts() ) : $bdaia_wcq4->the_post();
				echo $get_class4->widget_loop( $thumbnail, $review, $author_meta, $date_meta, $com_meta );
			endwhile;
			wp_reset_postdata();
		endif;
	}
	elseif ( $box_nu == 'wb5' )
	{
		$get_class5     = new WOOHOO_WIDGET_BOX5();
		$bdaia_wcq5     = $get_class5->widget_query( $sort_order, $num_posts, $tag_slug, $cat_uid, $cat_uids, $paged, $posts );

		if ( $bdaia_wcq5->have_posts() ) :
			while ( $bdaia_wcq5->have_posts() ) : $bdaia_wcq5->the_post();
				echo $get_class5->widget_loop( $thumbnail, $review, $author_meta, $date_meta, $com_meta );
			endwhile;
			wp_reset_postdata();
		endif;
	}
	elseif ( $box_nu == 'wb6' )
	{
		$get_class6     = new WOOHOO_WIDGET_BOX6();
		$bdaia_wcq6     = $get_class6->widget_query( $sort_order, $num_posts, $tag_slug, $cat_uid, $cat_uids, $paged, $posts );

		if ( $bdaia_wcq6->have_posts() ) :
			while ( $bdaia_wcq6->have_posts() ) : $bdaia_wcq6->the_post();
				echo $get_class6->widget_loop( $thumbnail, $review, $author_meta, $date_meta, $com_meta );
			endwhile;
			wp_reset_postdata();
		endif;
	}
	elseif ( $box_nu == 'wb7' )
	{
		$get_class7     = new WOOHOO_WIDGET_BOX7();
		$bdaia_wcq7     = $get_class7->widget_query( $sort_order, $num_posts, $tag_slug, $cat_uid, $cat_uids, $paged, $posts );

		if ( $bdaia_wcq7->have_posts() ) :
			while ( $bdaia_wcq7->have_posts() ) : $bdaia_wcq7->the_post();
				echo $get_class7->widget_loop( $thumbnail, $review, $author_meta, $date_meta, $com_meta );
			endwhile;
			wp_reset_postdata();
		endif;
	}
	elseif ( $box_nu == 'wb8' )
	{
		$get_class8     = new WOOHOO_WIDGET_BOX8();
		$bdaia_wcq8     = $get_class8->widget_query( $sort_order, $num_posts, $tag_slug, $cat_uid, $cat_uids, $paged, $posts );

		if ( $bdaia_wcq8->have_posts() ) :
			while ( $bdaia_wcq8->have_posts() ) : $bdaia_wcq8->the_post();
				echo $get_class8->widget_loop( $thumbnail, $review, $author_meta, $date_meta, $com_meta );
			endwhile;
			wp_reset_postdata();
		endif;
	}
}