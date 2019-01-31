<?php
    global $amos_redata;

    $id = amos_get_post_id();
    $replaced = array();
    if((int) $id != 0 && function_exists('redux_post_meta'))
        $replaced = redux_post_meta('amos_redata',(int) $id);
    

    if(isset($replaced) && !empty($replaced))
        foreach($replaced as $key => $value){
            $amos_redata[$key] = $value;
        }

    $title = get_the_title($id);
    if(is_search())
        $title = __('Search Results', 'amos');
    if(is_404()) 
        $title = __('404 Not Found', 'amos');
    if(class_exists( 'woocommerce' ) && is_shop()) 
        $title = __('Shop', 'amos');

    $page_parents = amos_page_parents();
    $extra_class = '';

    if(function_exists('is_product_category') && is_product_category()){
        global $wp_query;
        // get the query object
        $cat_obj = $wp_query->get_queried_object();   
        if($cat_obj)
            $title = $cat_obj->name;
    }

    if($amos_redata['page_header_bool']):   
        $extra_class .= $amos_redata['page_header_style'];

    if(isset($amos_redata['page_header_background']['background-image']) && $amos_redata['page_header_background']['background-image'] != '')
        $extra_class .= ' without_shadow';

    if(isset($amos_redata['page_header_background']['background-attachment']) && $amos_redata['page_header_background']['background-attachment'] != 'fixed')
        $extra_class .= ' no_parallax'; 


        $extra_class .= ' with_subtitle'; 

    if($amos_redata['page_header_design_style'] == 'padd')
        $extra_class .= ' with_padding_style';


    if($amos_redata['page_header_background'] == '' && $amos_redata['page_header_style'] == 'centered'){
      if($amos_redata['page_header_menu_color'] == 'dark'){
        $extra_class .= ' default_dark';
      }
      if($amos_redata['page_header_menu_color'] == 'light'){
        $extra_class .= ' default_light';
      }
    }

    if( isset($amos_redata['page_header_fullscreen']) && $amos_redata['page_header_fullscreen'] == 1){
      $extra_class .= ' fullscreen_height';
    }

    ?>

    <!-- Page Head -->
    <div class="header_page <?php echo esc_attr($extra_class) ?>">
             <?php 

             if(isset($amos_redata['page_header_background']['background-image']) && $amos_redata['page_header_background']['background-image'] != '' && isset($amos_redata['page_header_background']['background-color']) && $amos_redata['page_header_background']['background-color'] != ''): ?>
                <?php $rgb_color = amos_hexToRgb($amos_redata['page_header_background']['background-color']);  ?>
                <div class="overlay" style="background:rgba(<?php echo esc_attr($rgb_color['r']) ?>, <?php echo esc_attr($rgb_color['g']) ?>, <?php echo esc_attr($rgb_color['b']) ?>, 0.7)"></div>
             <?php endif; ?> 
             <div class="container">
                    
                   
                    <div class="titles">
              

                         <?php if(is_page($id)): ?>
                             <h1><?php echo esc_html($title) ?></h1> 


                         <?php endif; ?>

                         <?php if (is_single() && function_exists('is_product') && is_product() || is_singular( array( 'portfolio', 'staff', 'testimonial', 'faq' ) )){ ?>
                                            <h1><?php echo esc_html($title) ?></h1> 
                       
                         <?php } ?>

                         <?php  if(is_home($id) || is_single()){ ?>
                             <h1><?php echo __('Blog', 'amos') ?></h1> 
                        <?php } else if(is_home($id) && is_front_page()){ ?>
                             <h1><?php echo __('Home', 'amos') ?></h1>
                        <?php } else if(class_exists( 'woocommerce' ) && is_shop($id)){ ?>
                             <h1><?php echo __('Shop', 'amos') ?></h1>     
                         <?php } else if(is_archive($id)){ ?>
                                <h1><?php the_archive_title() ?></h1> 
                         <?php } else if(is_search($id)){?> 
                              <h1><?php echo __('Search Results', 'amos') ?></h1> 
                          <?php } ?>
                         

                        <?php if(isset($amos_redata['subtitle_bool']) && $amos_redata['subtitle_bool']): ?>
                            <span class="divider">
                            <span class="line"></span>
                            <span class="line right"></span>
                            </span>
                            <h3><?php echo esc_html($amos_redata['subtitle']) ?></h3>
                        <?php endif; ?>

                    </div>
              

                    <?php if($amos_redata['page_header_style'] == 'normal'): ?>
                    <div class="breadcrumbss">
                        
                        <ul class="page_parents pull-right">
                            <li><?php esc_html_e('You are here:', 'amos'); ?> </li>
                            <li class="home"><a href="<?php echo esc_url(home_url('/')) ?>"><?php esc_html_e('Home', 'amos'); ?></a></li>
                            
                            <?php for($i = count($page_parents) - 1; $i >= 0; $i-- ){ ?>

                            <li><a href="<?php echo esc_url(get_permalink($page_parents[$i])) ?>"><?php echo esc_html(get_the_title($page_parents[$i])) ?> </a></li>

                            <?php }  ?>
                           
                            <?php if(is_archive($id)){ ?>
                           
                                <li class="active"><a href="<?php echo esc_url(get_category_link($id)) ?>"> <?php the_archive_title() ?></a></li>

                            <?php }elseif(is_single($id) || is_page($id) ){ ?>

                                <li class="active"><a href="<?php echo esc_url(get_permalink()) ?>"><?php 
                            
                                echo esc_html($title); ?></a></li>
                            
                            <?php  }elseif(is_home() && is_front_page()){ 

                                    //Show Nothing if is home and front page
                              ?>
                                      

                             <?php }elseif(is_home()){ ?>
                                      <li class="active"><?php esc_html_e('Blog', 'amos' );  
                                     ?></li> 

                            <?php }elseif(class_exists( 'woocommerce' ) && is_shop()){ ?>
                                      <li class="active"><?php esc_html_e('Shop', 'amos' );  
                                     ?></li> 

                            <?php }elseif(is_search()){ ?>

                                    <li class="active"><?php esc_html_e('Search Results', 'amos' );   ?>

                              <?php  } ?>
           

                         </ul>
                    </div>
                    <?php endif; ?>
                </div>
            
    </div> 
   
    
    <?php endif; ?>