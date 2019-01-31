<?php  $amos_redata = amos_redata_variable(); ?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> class="css3transitions">
 
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />


    <!-- Responsive Meta -->
    <?php if($amos_redata['responsive_bool']): ?> <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> <?php endif; ?>

    <!-- Pingback URL -->
    <link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->

    <?php     
    // Loaded all others styles and scripts.
    wp_head(); 
  
    ?>
   
</head>

<!-- End of Header -->

<body  <?php body_class(); ?>>

<?php 

$show_extra_nav=false;

if( !empty($amos_redata['header_tools_two']['left']['extra_nav']) ||  !empty($amos_redata['header_tools_two']['right']['extra_nav']) || !empty($amos_redata['header_tools_two_extend']['left']['extra_nav']) || !empty($amos_redata['header_tools_two_extend']['right']['extra_nav']) ||  !empty($amos_redata['header_tools_extend']['enabled']['extra_nav']) ||  !empty($amos_redata['header_tools']['enabled']['extra_nav']))
$show_extra_nav=true;
else 
$show_extra_nav=false;
?>


<?php if( !empty($amos_redata['header_tools_two']['left']['search']) ||  !empty($amos_redata['header_tools_two']['right']['search']) ||  !empty($amos_redata['header_tools_two_extend']['left']['search']) ||  !empty($amos_redata['header_tools_two_extend']['right']['search']) ||  !empty($amos_redata['header_tools_extend']['enabled']['search']) ||  !empty($amos_redata['header_tools']['enabled']['search'])): ?>
    <div class="search_bar align_<?php if(!empty($amos_redata['search_content_align'])) echo esc_attr($amos_redata['search_content_align']);?>">
    <div class="overlay-close"><i class="lnr lnr-cross"></i></div>
    <div class="container"><?php get_search_form() ?>
    <?php if($amos_redata['search_widgets'] == 1):?>
    <div class="search_widgetized">
        <div class="row-fluid">
        <div class="left_widget">
            <?php if(is_active_sidebar('search-widget-left-area')) dynamic_sidebar('search-widget-left-area'); ?>
        </div>
        <div class="right_widget">
            <?php if(is_active_sidebar('search-widget-right-area')) dynamic_sidebar('search-widget-right-area'); ?>
        </div>
        </div>
    </div>
  <?php endif; ?>  
  </div>
</div>
<?php endif; ?>

<?php if($show_extra_nav): ?>
    <div class="extra_navigation <?php echo esc_attr($amos_redata['extra_navigation_position']) ?>">
        <a href="#" class="close"></a>

        <div class="content"><?php if(is_active_sidebar("sidenav")) dynamic_sidebar( "sidenav" ); ?></div>
    </div>
<?php endif; ?>

<?php if($amos_redata['outter_padding']): ?>
    <div class="top_space"></div>
    <div class="bottom_space"></div>
<?php endif; ?>



<?php if(isset($amos_redata['fixed_bar']) && $amos_redata['fixed_bar'] && class_exists('Elle_Shares')): ?>


   <?php $elle_shares = new Elle_Shares; ?>


    <div class="amos-bar fixed_bar ">


    <div class="content">
        <div class="separator"></div>
        <?php if(!empty($amos_redata['fixed_bar_text'])):
        echo esc_attr($amos_redata['fixed_bar_text']);
            endif;
        ?>

    </div>
    <div class="shares">
        <div class="title">
            <div class="icon"></div>
            
        </div>
        <div class="socials">
            
            <ul>
                <li class="facebook"><?php echo amos_output($elle_shares->facebook_shares); ?><i class="icon-facebook"></i></a></li>
                <li class="twitter"><?php echo amos_output($elle_shares->twitter_shares); ?><i class="icon-twitter"></i></a></li>
                <li class="google"><?php echo amos_output($elle_shares->google_plus_shares); ?><i class="icon-google-plus"></i></a></li>
                <li class="linkedin"><?php echo amos_output($elle_shares->tumblr_shares); ?><i class="icon-linkedin"></i></a></li> 
            </ul>
        </div>
           
    </div>
        
</div>

<?php endif; ?>    

<!-- check if siden menu in responsive is selected-->
<?php if($amos_redata['responsive_menu_dropdown'] && $amos_redata['responsive_menu_style'] == 'sidemenu'): ?>
    
    <?php get_template_part('includes/view/menu', 'small-side'); ?>

    <div id="snapcontent" class="">

<?php endif; ?>
<!-- end check if siden menu in responsive is selected-->

<div class="viewport  <?php echo esc_attr( amos_header_transitions('class') ) ?>" <?php echo amos_header_transitions('attr') ?> >

<!-- Used for boxed layout -->
<?php if($amos_redata['site_layout'] == 'boxed'): ?>
<!-- Boxed Layout Wrapper -->
<div class="boxed_layout">
<?php endif; ?>
    

<!-- Start Top Navigation -->
    <?php if($amos_redata['top_navigation'] && !$amos_redata['top_navigation_transparency']): ?>
    <div class="top_nav">
            <?php if(!$amos_redata['header_container_full']): ?>
            <div class="container">
            <?php endif; ?>

            <div class="row-fluid">
                <div class="span6">
                    <div class="pull-left">
                        <?php if(is_active_sidebar("top-header-left")) dynamic_sidebar( "top-header-left" ); ?>
                    </div>
                </div>
                <div class="span6">
                    <div class="pull-right">
                        <?php if(is_active_sidebar("top-header-right")) dynamic_sidebar( "top-header-right" ); ?>
                    </div>
                </div>
               
            </div>
            <?php if(!$amos_redata['header_container_full']): ?>
            </div>
            <?php endif; ?>

    </div>
    <?php endif; ?>

    <!-- End of Top Navigation -->

        
    <?php $header_class = $amos_redata['menu_presets'];?>
    <?php $bgCheck = esc_attr(amos_header_bgCheck()); ?>
    <?php 

        if(!empty($amos_redata['header_shapes']))
            $header_shapes = $amos_redata['header_shapes']; ?>

    <?php if($amos_redata['menu_presets'] == 'h1' || $amos_redata['menu_presets'] == 'h2' || $amos_redata['menu_presets'] == 'h3' || $amos_redata['menu_presets'] == 'h4' || $amos_redata['menu_presets'] == 'h5' || $amos_redata['menu_presets'] == 'h6' || $amos_redata['menu_presets'] == 'h7' || $amos_redata['menu_presets'] == 'h8' || $amos_redata['menu_presets'] == 'h9' || $amos_redata['menu_presets'] == 'h10' || $amos_redata['menu_presets'] == 'h11' || $amos_redata['menu_presets'] == 'h12'){
        if((int) amos_get_post_id() != 0 && function_exists('redux_post_meta'))
            $page_header_menu_color = redux_post_meta('amos_redata',(int) amos_get_post_id(), 'page_header_menu_color');
        else
            $page_header_menu_color = 'light';

        if(isset($page_header_menu_color) && !empty($page_header_menu_color))
            $bgCheck = ($page_header_menu_color =='auto') ? '' : 'background--'.$page_header_menu_color; 
        else
            $bgCheck = 'background--light';
    } 
    ?>

    


    <?php 
            $header_gradient='';
        if(!empty($amos_redata['header_gradient_transparency']) && $amos_redata['header_gradient_transparency'] == 1): 
             $header_gradient = ' header_gradient';
          endif;
    ?>

    <?php if(!empty($amos_redata['header_border_bottom']) && $amos_redata['header_border_bottom'] == 1 ){
             $header_border = ' header_borders';
         }
          else $header_border = '';

          if(!empty($amos_redata['header_border_bottom_content']) && $amos_redata['header_border_bottom_content'] == 1){
             $header_border_bottom = ' header_borders_bottom';
         }
          else $header_border_bottom = '';
/*footer reveal effect add clas in header*/
          if(isset($amos_redata['reveal_footer']) && $amos_redata['reveal_footer'] == 1) 
                   $footer_effect= ' fixed_footer';
            else $footer_effect = '';

    ?>

    <!-- Header BEGIN -->
    
    <div  class="header_wrapper <?php echo esc_attr($header_border) ?> <?php echo esc_attr($header_border_bottom) ?> <?php echo esc_attr($header_class) ?> <?php if($amos_redata['menu_presets'] == 'h9') echo 'hidden_header'; ?> <?php  if (!empty($header_shapes)) echo esc_attr($header_shapes); ?> <?php echo esc_attr($header_gradient) ?> <?php echo esc_attr($bgCheck) ?> <?php if($header_class == 'h8' || $header_class == 'h9') echo 'pos--'.esc_attr($amos_redata['h_vertical_position']).' align_'.$amos_redata['h_vertical_content_align'] ?> <?php if($header_class == 'h8' && esc_attr($amos_redata['h8_transparent_padding'])) echo 'transparent_padding'?> ">        
        <!-- Start Top Navigation -->
        <?php amos_header_topnav_transparent(); ?>
        <!-- End of Top Navigation -->

        <header id="header" class="">
            <?php if(!$amos_redata['header_container_full']): ?>
            <div class="container">
            <?php endif; ?>
        	   <div class="row-fluid">
                    <div class="span12">

                        <!-- Header 1, 2,3 preset -->

                        <?php if($header_class == 'h1' || $header_class == 'h2' || $header_class == 'h3' ): ?>
                        <!-- Logo -->
                        <?php if(!isset($css_class)) $css_class=''; ?>

                        <?php if($amos_redata['header_tools_position'] == 'right' && !empty($amos_redata['header_tools']['enabled'])):?>
                        <div id="logo" class="<?php echo esc_attr($css_class) ?> left_align">
                            <?php echo amos_logo() ?>  
                        </div>
                         <!-- #logo END -->
                         
                        <?php elseif($amos_redata['header_tools_position'] == 'left' && !empty($amos_redata['header_tools']['enabled'])):?>
                            <!-- header tools -->
                        <?php amos_header_tools(); ?>
                            <!-- end header tools -->
                        <?php endif;?>
                         <!-- navigation menu-->
                        <div class="nav_menu <?php echo esc_attr($amos_redata['menu_style']);?>">
                        <nav>
                            <?php 
                                $args = array("theme_location" => "main", "container" => false, "fallback_cb" => 'amos_default_menu');
                                wp_nav_menu($args);  
                            ?> 
                        </nav>
                        </div>
                        <!-- end navigation menu-->

                        <!-- Logo -->
                        <?php if(!isset($css_class)) $css_class=''; ?>

                        <?php if($amos_redata['header_tools_position'] == 'left' && !empty($amos_redata['header_tools']['enabled'])):?>
                        <div id="logo" class="<?php echo esc_attr($css_class) ?> right_align">
                            <?php echo amos_logo() ?>  
                        </div>
                         <!-- #logo END -->
                         
                        <?php elseif($amos_redata['header_tools_position'] == 'right' && !empty($amos_redata['header_tools']['enabled'])):?>
                            <!-- header tools -->
                        <?php amos_header_tools(); ?>
                            <!-- end header tools -->
                        <?php endif;?>

                     
                       


                        <?php endif;?>
                         <!-- End Header 1 preset -->

                         <!-- Header 4 preset -->

                        <?php if($header_class == 'h4' || $header_class == 'h5'): ?>
                           
                        <?php if(!empty($amos_redata['header_tools_two']['left'])):?>
                            <!-- header tools -->
                        <?php amos_header_tools('left'); ?>
                            <!-- end header tools -->
                        <?php endif;?>


                         <?php if($header_class == 'h5'): ?>
                            <div class="centered_menu_logo">
                                <div class="centered_container">
                                    <div class="left_menu">
                                        <nav class="">
                                            <?php 
                                                $args = array("theme_location" => "left", "container" => false, "fallback_cb" => 'amos_default_menu');
                                                wp_nav_menu($args);  
                                            ?> 
                                        </nav>
                                        </div>
                                <?php endif; ?>


                        <div class="centered_logo">

                            <?php if(!isset($css_class)) $css_class=''; ?>
                            <div id="logo" class="<?php echo esc_attr($css_class) ?> ">
                                <?php echo amos_logo() ?>  
                            </div>

                         
                        </div>

                        <?php if($header_class == 'h5'): ?>
                            <div class="right_menu">
                            <nav class="">
                                <?php 
                                    $args = array("theme_location" => "right", "container" => false, "fallback_cb" => 'amos_default_menu');
                                    wp_nav_menu($args);  
                                ?> 
                            </nav>
                        </div>
                        </div>
                        </div>
                        <?php endif; ?>

                        <?php if(!empty($amos_redata['header_tools_two']['right'])):?>
                            <!-- header tools -->
                        <?php amos_header_tools('right'); ?>
                            <!-- end header tools -->
                        <?php endif;?>
                        

                        <?php endif;?>

                        

                        
                         <!-- End Header 4 preset -->


                         <!-- Header 6 preset -->
                          <?php if($header_class == 'h6' || $header_class == 'h7' || $header_class == 'h8'): ?>
                            <?php if(!isset($css_class)) $css_class=''; ?>
                            <div id="logo" class="<?php echo esc_attr($css_class) ?> ">
                                <?php echo amos_logo() ?>  
                            </div>

                            <?php if($header_class == 'h7'):?>
                                <?php if(!empty($amos_redata['header_tools']['enabled'])):?>
                                    <!-- header tools -->
                                    <?php amos_header_tools(); ?>
                                    <!-- end header tools -->
                                <?php endif;?>
                            <?php endif;?>

                            <?php if($header_class == 'h6'):?>
                            <div class="after_navigation_widgetized">
                                <?php if(is_active_sidebar('after-navigation-area')) dynamic_sidebar('after-navigation-area'); ?>
                            </div>
                            <?php endif;?>
                        <?php endif;?>

                         <!-- End Header 6 preset -->

                       


                        <!-- vertical header hidden style button-->

                        <?php if($amos_redata['menu_presets'] == 'h9'): ?>
                        <div class="wrapper-menu" id="trigger-overlay1" >
                                      <div class="line-menu half start"></div>
                                      <div class="line-menu"></div>
                                      <div class="line-menu half end"></div>
                                    </div> 
                        <div class="vertical_header_background"></div>
                        <?php endif;?>

                        <?php if($header_class == 'h9'): ?>
                            <?php if(!isset($css_class)) $css_class=''; ?>
                            <div id="logo" class="<?php echo esc_attr($css_class) ?> ">
                                <?php echo amos_logo() ?>  
                            </div>
                        <?php endif;?>


                        <?php if($header_class == 'h10'): ?>
                           
                        <?php if(!empty($amos_redata['header_tools_two_extend']['left'])):?>
                            <!-- header tools -->
                        <?php amos_header_tools('left', 'menu'); ?>
                            <!-- end header tools -->
                        <?php endif;?>

                        <div class="centered_logo">
                        <?php if(!isset($css_class)) $css_class=''; ?>
                            <div id="logo" class="<?php echo esc_attr($css_class) ?> ">
                                <?php echo amos_logo() ?>  
                            </div>
                        </div>
                        <?php endif;?>

                        <?php if($header_class == 'h10' || $header_class == 'h11'): ?>
                        <div class="header_fullwrapper overlay_menu overlay-hugeinc dl-menuwrapper"  id='dl-menu'>
                               
                                <nav>
                                        <?php 
                                            $args = array("theme_location" => "main", "container" => false, "fallback_cb" => 'amos_default_menu');
                                            wp_nav_menu($args);  
                                        ?> 
                                </nav>
                            </div>
                        <?php endif;?>

                        <?php if($header_class == 'h10'): ?>
                        <?php if(!empty($amos_redata['header_tools_two_extend']['right'])):?>
                            <!-- header tools -->
                        <?php amos_header_tools('right', 'menu'); ?>
                            <!-- end header tools -->
                        <?php endif;?>

                        <?php endif;?>

                        <!-- Header 1, 2,3 preset -->
                        
                        <?php if($header_class == 'h11'): ?>
                        <!-- Logo -->
                        <?php if(!isset($css_class)) $css_class=''; ?>

                        <?php if($amos_redata['header_tools_position'] == 'right' && !empty($amos_redata['header_tools_extend']['enabled'])):?>
                        <div class="logo_container">
                            <div id="logo" class="<?php echo esc_attr($css_class) ?> left_align">
                                <?php echo amos_logo() ?>  
                            </div>
                        </div>
                         <!-- #logo END -->
                         
                        <?php elseif($amos_redata['header_tools_position'] == 'left' && !empty($amos_redata['header_tools_extend']['enabled'])):?>
                            <!-- header tools -->
                        <?php amos_header_tools('', 'menu'); ?>
                            <!-- end header tools -->
                        <?php endif;?>
                         
                        <!-- Logo -->
                        <?php if(!isset($css_class)) $css_class=''; ?>

                        <?php if($amos_redata['header_tools_position'] == 'left' && !empty($amos_redata['header_tools_extend']['enabled'])):?>
                            <div class="logo_container">
                                <div id="logo" class="<?php echo esc_attr($css_class) ?> right_align">
                                    <?php echo amos_logo() ?>  
                                </div>
                            </div>
                         <!-- #logo END -->
                         
                        <?php elseif($amos_redata['header_tools_position'] == 'right' && !empty($amos_redata['header_tools_extend']['enabled'])):?>
                            <!-- header tools -->
                        <?php amos_header_tools('', 'menu'); ?>
                            <!-- end header tools -->
                        <?php endif;?>
                        <?php endif;?>

                        <!-- Navigation -->

                        
                        <?php if($header_class == 'h8' || $header_class == 'h9'): ?>	
                        
                        <?php  $css_class .= ' pos_'.$amos_redata['h_vertical_position'].' ' ?>
                        <div id="navigation" class="nav_top pull-right  <?php echo esc_attr($css_class) ?>">
                            <nav>
                            <?php 
                                $args = array("theme_location" => "main", "container" => false, "fallback_cb" => 'amos_default_menu');
                                wp_nav_menu($args);  
                            ?> 
                            </nav>
                        </div>
                        <?php endif; ?> 

                        <!-- #navigation -->

                         <!-- End custom menu here -->

                        
                        <?php if($header_class == 'h9' || $header_class == 'h8'): ?>
                            <div class="header_widgetized">
                                <?php if(is_active_sidebar('header-widgetized-area')) dynamic_sidebar('header-widgetized-area'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if($amos_redata['menu_presets'] == 'h9'): ?>
                            <div class="vertical_header_logo_bottom">
                                <!-- Logo -->
                                <?php if(!isset($css_class)) $css_class=''; ?>
                                <div id="logo" class="<?php echo esc_attr($css_class) ?>">
                                    <?php echo amos_vertical_logo() ?>  
                                </div>
                                <!-- #logo END -->
                            </div>
                        <?php endif;?>


                    </div>
                     
                </div>
                    
                
            <?php if(!$amos_redata['header_container_full']): ?>
            </div>  
            <?php endif; ?>


                <?php if($header_class == 'h4' || $header_class == 'h6' || $header_class == 'h7'): ?>
                    <!-- header 4 preset-->
                    <div class="header_second">
                        <?php if(!$amos_redata['header_container_full']): ?>
                            <div class="container">
                        <?php endif; ?>
                    <div class="row-fluid">
                    <div class="span12">
                        <?php if($header_class == 'h4' ):?>
                    <div class="centered_menu">
                    <?php endif;?>
                               <!-- navigation menu-->
                        <div class="nav_menu <?php echo esc_attr($amos_redata['menu_style']);?>">
                        <nav>
                            <?php 
                                $args = array("theme_location" => "main", "container" => false, "fallback_cb" => 'amos_default_menu');
                                wp_nav_menu($args);  
                            ?> 
                        </nav>
                        </div>
                        <!-- end navigation menu-->
                        <?php if($header_class == 'h4' ):?>
                        </div>
                        <?php endif;?>

                        <?php if($header_class == 'h6' ):?>

                        <?php if(!empty($amos_redata['header_tools'])):?>
                            <!-- header tools -->
                        <?php amos_header_tools(); ?>
                            <!-- end header tools -->
                        <?php endif;?>

                        <?php endif;?>

                        <?php if($header_class == 'h7' ):?>
                            <div class="after_navigation_widgetized">
                                <?php if(is_active_sidebar('after-navigation-area')) dynamic_sidebar('after-navigation-area'); ?>
                            </div>
                        <?php endif;?>
                        </div>
                        </div>
                         <?php if(!$amos_redata['header_container_full']): ?>
                            </div>
                        <?php endif;?>
                        </div>
                        <!-- end header 4 preset-->
                    <?php endif;?>


                    <?php if($amos_redata['responsive_menu_dropdown'] && $amos_redata['responsive_menu_style']=='normal'): ?>
                    <!-- Responsive Menu -->
                    <div class="responsive_header">
                        <?php if($amos_redata['menu_presets_responsive'] =='center') :?>
                            <!--centered responsive header-->
                        <?php if(!empty($amos_redata['header_tools_responsive']['left'])):?>
                            <!-- header tools -->
                        <?php amos_header_tools('left','','true'); ?>
                            <!-- end header tools -->
                        <?php endif;?>


                        <?php if(!isset($css_class)) $css_class=''; ?>
                            <div id="logo_responsive" class="<?php echo esc_attr($css_class) ?> ">
                                <?php echo amos_logo() ?>  
                            </div>


                        <?php if(!empty($amos_redata['header_tools_responsive']['right'])):?>
                            <!-- header tools -->
                        <?php amos_header_tools('right','','true'); ?>
                            <!-- end header tools -->
                        <?php endif;?>

                        <?php endif;?>

                        <?php if($amos_redata['menu_presets_responsive'] =='lateral') :?>
                         <!--lateral responsive header-->
                         <?php if($amos_redata['menu_responsive_position'] == 'right'):?>
                         <?php if(!isset($css_class)) $css_class=''; ?>
                            <div id="logo" class="<?php echo esc_attr($css_class) ?> align_left">
                                <?php echo amos_logo() ?>  
                            </div>
                        <?php endif;?>


                         <div class="header_tools <?php echo esc_attr($amos_redata['menu_responsive_position']);?> ">
                        <ul>
                        <li>
                            <div class = 'wrapper-menu mobile_small_menu' id="responsive_menu" >
                               <div class="line-menu half start"></div>
                               <div class="line-menu"></div>
                               <div class="line-menu half end"></div>
                            </div>
                        </li>
                        </ul>
                        </div>

                        <?php if($amos_redata['menu_responsive_position'] == 'left'):?>
                         <?php if(!isset($css_class)) $css_class=''; ?>
                            <div id="logo" class="<?php echo esc_attr($css_class) ?> align_right ">
                                <?php echo amos_logo() ?>  
                            </div>
                        <?php endif;?>


                        <?php endif;?>

                    <div class="row-fluid">
                        <?php get_template_part('includes/view/menu', 'small'); ?> 
                    </div>

                    </div>
                    <!-- End Responsive Menu -->
                    <?php endif; ?>
            
        </header>

    </div>
    

   

    <?php if(!function_exists('redux_post_meta'))

            $fullscreen_post_style = 0;

          else  

            $fullscreen_post_style = redux_post_meta('amos_redata',(int) amos_get_post_id(), 'fullscreen_post_style');  ?>

    <?php if( (int) amos_get_post_id() != 0 && !$fullscreen_post_style): ?>
    
  
    <div class="top_wrapper  <?php echo esc_attr($footer_effect);?>">
    <?php endif; ?>
        <?php get_template_part('includes/view/sliders_output'); ?>

<!-- .header -->