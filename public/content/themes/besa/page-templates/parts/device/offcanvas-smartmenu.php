<?php 
    $location = 'mobile-menu';
    $tbay_location  = '';
    if ( has_nav_menu( $location ) ) { 
        $tbay_location = $location;
    }

    $menu_attribute         = '';
    $menu_title             = besa_tbay_get_config('menu_mobile_title', 'Menu mobile');

    $search_items           = besa_tbay_get_config('menu_mobile_search_items', 'Search for products');
    $menu_search_category   = besa_tbay_get_config('enable_menu_mobile_search_category', false); 

    $menu_third             = besa_tbay_get_config('enable_menu_third', false);  
    $menu_third_id          =  besa_tbay_get_config('menu_mobile_third_select');

    $menu_counters          = besa_tbay_get_config('enable_menu_mobile_counters', false);  

    $menu_second            = besa_tbay_get_config('enable_menu_second', false);  


    /*Socials*/
    $enable_menu_social           = besa_tbay_get_config('enable_menu_social', false); 

    if( $enable_menu_social ||  $menu_third) {
        $menu_attribute    .= 'data-enablebottom="true" '; 
    }

    if( $enable_menu_social ) {
        $social_slides            = besa_tbay_get_config('menu_social_slides');  

        $social_array = array();

        if(count($social_slides) == 1 && empty($social_slides['0']['title']) && empty($social_slides['0']['url']) ) {
             $menu_attribute           .= 'data-enablesocial="false" '; 
        } else {
            $menu_attribute    .= 'data-enablesocial="true" ';
            foreach ($social_slides as $index => $val) {

                $social_array[$index]['icon']     =   $val['title'];
                $social_array[$index]['url']      =   $val['url'];
            }

            $social_json = str_replace('"', "'", json_encode($social_array));

            $menu_attribute         .= 'data-socialjsons="' . $social_json . '" ';
        }

    }

    /*tabs icon*/
    if( $menu_second ) {

        $menu_second_id         =  besa_tbay_get_config('menu_mobile_second_select');

        $menu_tab_one           = besa_tbay_get_config('menu_mobile_tab_one', 'Menu');
        $menu_tab_one_icon      = besa_tbay_get_config('menu_mobile_tab_one_icon', 'fa fa-bars');            

        $menu_tab_second        = besa_tbay_get_config('menu_mobile_tab_scond', 'Categories');
        $menu_tab_second_icon   = besa_tbay_get_config('menu_mobile_tab_second_icon', 'fa fa-th');


        $menu_attribute         .= 'data-enabletabs="' . $menu_second . '" ';


        $menu_attribute         .= 'data-tabone="' . $menu_tab_one . '" ';
        $menu_attribute         .= 'data-taboneicon="' . $menu_tab_one_icon . '" ';            

        $menu_attribute         .= 'data-tabsecond="' . $menu_tab_second . '" ';
        $menu_attribute         .= 'data-tabsecondicon="' . $menu_tab_second_icon . '" ';

    }

    /*Effect */
    $enable_effects            = besa_tbay_get_config('enable_menu_mobile_effects', false);  
    $menu_attribute           .= 'data-enableeffects="' . $enable_effects . '" '; 

    if($enable_effects) {
        $effects_panels        =  besa_tbay_get_config('menu_mobile_effects_panels', '');
        $effects_listitems     =  besa_tbay_get_config('menu_mobile_effects_listitems', '');

        $menu_attribute         .= 'data-effectspanels="' . $effects_panels . '" ';
        $menu_attribute         .= 'data-effectslistitems="' . $effects_listitems . '" ';
    }


    $menu_attribute         .= 'data-counters="' . $menu_counters . '" ';
    $menu_attribute         .= 'data-title="' . $menu_title . '" ';

    $menu_one_id    =  besa_tbay_get_config('menu_mobile_one_select');

?>
  
<div id="tbay-mobile-smartmenu" <?php echo trim($menu_attribute); ?> class="tbay-mmenu d-xl-none"> 

    <?php if( $menu_third ) : ?>
        <div id="mm-searchfield" class="mm-searchfield__input" >

            <?php if( isset($menu_third) && $menu_third ) : ?>
            <div class="mmenu-account">
                <?php 
                    $args_third = array(
                        'menu'    => $menu_third_id,
                        'fallback_cb' => '',
                    );

                    $args_third['container_id']       =   'mobile-menu-third-mmenu';
                    $args_third['menu_id']            =   'main-mobile-third-mmenu-wrapper';
                    $args_third['walker']             =   new Besa_Tbay_mmenu_menu();
               

                    wp_nav_menu($args_third);
                ?>
            </div>
            <?php endif; ?>

        </div>

    <?php endif; ?>

    <div class="tbay-offcanvas-body">

        <nav id="tbay-mobile-menu-navbar" class="navbar navbar-offcanvas navbar-static">
            <?php


                $args = array(
                    'fallback_cb' => '',
                );

                if( empty($menu_one_id) ) {
                    $args['theme_location']     = $tbay_location;
                } else {
                    $args['menu']               = $menu_one_id;
                }

                $args['container_id']       =   'main-mobile-menu-mmenu';
                $args['menu_id']            =   'main-mobile-menu-mmenu-wrapper';
                $args['walker']             =   new Besa_Tbay_mmenu_menu();

                wp_nav_menu($args);


                if( isset($menu_second) && $menu_second ) {

                    $args_second = array(
                        'menu'    => $menu_second_id,
                        'fallback_cb' => '',
                    );

                    $args_second['container_id']       =   'mobile-menu-second-mmenu';
                    $args_second['menu_id']            =   'main-mobile-second-mmenu-wrapper';
                    $args_second['walker']             =   new Besa_Tbay_mmenu_menu();
               

                    wp_nav_menu($args_second);

                }


            ?>
        </nav>


    </div>
</div>