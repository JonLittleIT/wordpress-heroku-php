<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php esc_html(bloginfo( 'charset' )); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
        <link rel="shortcut icon" href="<?php echo esc_attr(porfoliowp_redux('mt_favicon', 'url')); ?>">
    <?php } ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


    <?php
       
        if (porfoliowp_redux('mt_preloader_status')) {
            echo  '<div class="porfoliowp_preloader_holder '.porfoliowp_redux('mt_preloader_animation').'">'.porfoliowp_loader_animation().'</div>';
        } 

    ?>


    <?php 
    $below_slider_headers = array('header8', 'header9');
    $normal_headers = array('header1', 'header2', 'header5',);
    $custom_header_options_status = get_post_meta( get_the_ID(), 'smartowl_custom_header_options_status', true );
    $header_custom_variant = get_post_meta( get_the_ID(), 'smartowl_header_custom_variant', true );
    $header_layout = porfoliowp_redux('mt_header_layout');
    if (isset($custom_header_options_status) && $custom_header_options_status == 'yes') {
        $header_layout = $header_custom_variant;
    }
    ?>

    <?php if ( !class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
        <!-- Fixed Search Form -->
        <div class="fixed-search-overlay">
            <!-- Close Sidebar Menu + Close Overlay -->
            <i class="icon-close icons"></i>
            <!-- INSIDE SEARCH OVERLAY -->
            <div class="fixed-search-inside">
                <?php echo porfoliowp_custom_search_form(); ?>
            </div>
        </div>
    <?php }else{ ?>
        <?php if(porfoliowp_redux('mt_header_is_search') == true){ ?>
        <!-- Fixed Search Form -->
        <div class="fixed-search-overlay">
            <!-- Close Sidebar Menu + Close Overlay -->
            <i class="icon-close icons"></i>
            <!-- INSIDE SEARCH OVERLAY -->
            <div class="fixed-search-inside">
                <?php echo porfoliowp_custom_search_form(); ?>
            </div>
        </div>
        <?php } ?>
    <?php } ?>


        <!-- Fixed Sidebar Menu -->
        <div class="relative fixed-sidebar-menu-holder header7">
            <div class="fixed-sidebar-menu">
                <!-- Close Sidebar Menu + Close Overlay -->
                <i class="icon-close icons"></i>
                <!-- Sidebar Menu Holder -->
                <div class="header7">
                    <!-- RIGHT SIDE -->
                    <div class="left-side">

                      <!-- NAV MENU -->
                      <div id="navbar" class="navbar-collapse collapse col-md-12">
                        <ul class="menu nav navbar-nav nav-effect nav-menu">
                          <?php
                            $defaults = array(
                              'menu'            => '',
                              'container'       => false,
                              'container_class' => '',
                              'container_id'    => '',
                              'menu_class'      => 'menu',
                              'menu_id'         => '',
                              'echo'            => true,
                              'fallback_cb'     => false,
                              'before'          => '',
                              'after'           => '',
                              'link_before'     => '',
                              'link_after'      => '',
                              'items_wrap'      => '%3$s',
                              'depth'           => 0,
                              'walker'          => ''
                            );

                            $defaults['theme_location'] = 'primary';


                            if ( has_nav_menu( 'primary' ) ) {
                                wp_nav_menu( $defaults );
                            } else {
                                echo '<p class="no-menu text-right">'.esc_attr__('Primary navigation menu is missing. Add one from "Appearance" -> "Menus"','porfoliowp').'<p>';
                            }
                            
                          ?>
                        </ul>
                      </div>

                    </div>
                </div>
            </div>
        </div>

    <!-- PAGE #page -->
    <div id="page" class="hfeed site">
        <?php
            $page_slider = get_post_meta( get_the_ID(), 'select_revslider_shortcode', true );
            if (in_array($header_layout, $below_slider_headers)){
                // Revolution slider
                if (!empty($page_slider)) {
                    echo '<div class="theme_header_slider">';
                    echo do_shortcode('[rev_slider '.esc_attr($page_slider).']');
                    echo '</div>';
                }

                // Header template variant
                echo porfoliowp_current_header_template();
            }elseif (in_array($header_layout, $normal_headers)){
                // Header template variant
                echo porfoliowp_current_header_template();
                // Revolution slider
                if (!empty($page_slider)) {
                    echo '<div class="theme_header_slider">';
                    echo do_shortcode('[rev_slider '.esc_attr($page_slider).']');
                    echo '</div>';
                }
            }else{
                echo porfoliowp_current_header_template();
            }
        ?>