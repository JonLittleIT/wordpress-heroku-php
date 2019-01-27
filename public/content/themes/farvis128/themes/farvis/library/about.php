<?php
function pix_add_adminpanel() {
  add_theme_page('About Theme', 'About farvis', 'administrator', 'adminpanel', 'adminpanel');
}


if (current_user_can('switch_themes')) {
    add_action('admin_menu', 'pix_add_adminpanel');
}

function adminpanel() {

  global $theme_name, $shortname, $options;

  $phpv = phpversion();
  $res_phpv = ( (float)$phpv < 5.6 ) ? "fa-close" : "fa-check";

  $max_execution_time = ini_get('max_execution_time');
  $res_max_execution_time = ( (int)$max_execution_time < 360 ) ? "fa-close" : "fa-check";

  $memory_limit = ini_get('memory_limit');
  $res_memory_limit = ( (int)$memory_limit < 128 ) ? "fa-close" : "fa-check";

  $post_max_size = ini_get('post_max_size');
  $res_post_max_size = ( (int)$post_max_size < 32 ) ? "fa-close" : "fa-check";

  $upload_max_filesize = ini_get('upload_max_filesize');
  $res_upload_max_filesize = ( (int)$upload_max_filesize < 32 ) ? "fa-close" : "fa-check";

  $envatoCode = get_theme_mod('pixtheme_licence_settings_code') ? get_theme_mod('pixtheme_licence_settings_code') : '' ;
  $option_name = 'pixtheme_licence_is_activated';
  $option_name_code = 'pixtheme_licence_code';
  $html_support = "<div class='pix_about_block_description desc_renew_support'>" . esc_html__("Your support has expired. ", "farvis") . "</div>
  
  
   <p>" . esc_html__("Unfortunately, your support period is expired but you can renew your support period  ", "farvis") . "</p>
   
  <a href='" . esc_url('https://help.market.envato.com/hc/en-us/articles/207886473-Extending-and-Renewing-Item-Support') . "' target='_blank' class='pix_about_block_link button button-primary'>" . esc_html__("Renew Support", "farvis") . "</a>
  
  
  ";

  
  if ($envatoCode){
    if ( get_option( $option_name ) != false ){
      if (get_option( $option_name_code ) == $envatoCode){
        $expiredTime = strtotime(get_option( $option_name )); 
        if ($expiredTime > time()){
          $html_support = "<div class='pix_about_block_description'>" . esc_html__("This theme comes with 6 months of free support for every license you purchase. Support can be extended through subscriptions via ThemeForest. Envato Elements does not provide technical support for this theme.", "farvis") . "</div>
          
          <a href='" . esc_url('http://support.templines.com/') . "' target='_blank' class='pix_about_block_link button button-primary'>" . esc_html__("Get Support", "farvis") . "</a>
          
          ";
        }
      }
    }
  }
  echo wp_kses_post("<div class='pix_about'>
      <div class='pix_about_header'>
          <h1 class='pix_about_title'>" . esc_html__("Welcome to Farvis", "farvis") . "</h1>
          <div class='pix_about_description'>
              <p>" . esc_html__("Thank you for purchasing our theme.", "farvis") . "</p>
             
          </div>
      </div>
      <div id='pix_about_tabs' class='pix_tabs pix_about_tabs'>
          <ul class='ui-tabs-nav pix-tabs'>
              <li class='ui-state-active'>
                  <a href='#pix_theme_about' class='ui-tabs-anchor' >" . esc_html__("Getting started", "farvis") . "</a>
              </li>
              <li>
                  <a href='#pix_theme_requirements' class='ui-tabs-anchor'>" . esc_html__("Requirements", "farvis") . "</a>
              </li>
              <li>
                  <a href='#pix_theme_changelog' class='ui-tabs-anchor'>" . esc_html__("Changelog", "farvis") . "</a>
              </li>
          </ul>
          <div id='pix_theme_about' class='pix_tabs_section pix_about_section'>
              <div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-admin-network'></i>
                          " . esc_html__("Theme activation", "farvis") . "
                      </h2>
                      <div class='pix_about_block_description'>");
                          echo esc_attr(get_option('pix_theme_code'));

                         
                          if (function_exists( 'pixtheme_check_is_activated' )  ) {
                            if(pixtheme_check_is_activated() ){
        
                                
                                 echo wp_kses_post("<p class='pixtheme_check_is_activated'>" . esc_html__("Theme activated", "farvis") . "</p>");
                                
                                
                                echo wp_kses_post("<p>Reminder ! One registration per Website. If registered elsewhere please remove purchased code that registration first.</p>");
                                
                                 echo "<p><div style='display:flex'><input class='activation-input'  type='text' name='pix_code' data-activationtheme='1' value='{$envatoCode}'><a data-activationtheme='1' class='button button-primary activation-theme re-activation-theme'>" . esc_html__(' Save', 'farvis') . "</a></div></p><p class='activated' style='display:none'>" . esc_html__("Theme activated", "farvis") . "</p>";
                                
                            }
                            else{
                                
                                echo wp_kses_post("<p class='pixtheme_check_is_not_activated'>" . esc_html__("Theme not activated", "farvis") . "</p>");
                                
                                echo wp_kses_post("<p>You can learn how to find your purchase code <a target='_blank href='http://support.templines.com/knowledge-base/where-can-i-find-my-purchase-code/'>here</a></p><p>If you download this theme on Envato Element then you do not need to enter anything here . You should license this file for a specified project on Envato elements .</p>");
                                
                                
                                
                                
                                
                               echo "<p><div style='display:flex'><input class='activation-input' type='text' name='pix_code' data-activationtheme='1' value='{$envatoCode}'><a data-activationtheme='1' class='button button-primary activation-theme'>" . esc_html__('Save', 'farvis') . "</a></div></p><p class='activated' style='display:none'>" . esc_html__("Theme activated", "farvis") . "</p>";
                            }
                          }else{
                            echo esc_html__('Add Plugins', 'farvis');
                          }
                      echo wp_kses_post("</div>
                  </div>
              </div>
              <div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-backup'></i>
                          " . esc_html__("Theme Update", "farvis") . "
                      </h2>
                      <div class='pix_about_block_description'>");
                          echo esc_attr(get_option('pix_theme_code'));
                          if ( class_exists( 'Envato_Market' ) ) {
                              echo wp_kses_post("<p>" . esc_html__("Envato Market plugin can install or update WordPress themes and plugins purchased from ThemeForest . Please use this plugin and he will periodically check for updates. ", "farvis") . "</p>");
                              echo wp_kses_post("<a href='" . esc_url(admin_url('admin.php?page=envato-market')) . "' class='pix_about_block_link button button-primary'>" . esc_html__("Get it Now", "farvis") . "</a>");
                          } else {
                              
                              echo wp_kses_post("<p>" . esc_html__("Please install a plugin Envato Market and get all the premium features and theme auto-update.", "farvis") . "</p>
                              
                              
                              <a href='" . admin_url('themes.php?page=tgmpa-install-plugins') . "' class='pix_about_block_link button button-primary'>" . esc_html__("Install plugins", "farvis") . "</a>");
                          }
                      echo wp_kses_post("</div>
                  </div>
              </div>
              <div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-book'></i>
                          " . esc_html__("Read full documentation", "farvis") . "
                      </h2>
                      <div class='pix_about_block_description'>
                          " . esc_html__("Need more details? Please check our full online documentation for detailed information on how to use farvis.", "farvis") . "
                      </div>
                      <a href='" . esc_url('http://farvis.templines.org/documentation') . "' target='_blank' class='pix_about_block_link button button-primary'>" . esc_html__("Documentation", "farvis") . "</a>
                  </div>
              </div>");
          if ( !TGM_Plugin_Activation::get_instance()->is_tgmpa_complete() ) {
              echo wp_kses_post("<div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-admin-plugins'></i>
                          " . esc_html__("Required plugins", "farvis") . "
                      </h2>
                      <div class='pix_about_block_description'>
                          " . esc_html__("Theme farvis is compatible with a large number of popular plugins. You can install only those that are going to use in the near future.", "farvis") . "
                      </div>
<a href='" . esc_url(admin_url('themes.php?page=tgmpa-install-plugins')) . "' class='pix_about_block_link button button-primary'>" . esc_html__("Install plugins", "farvis") . "</a>
                  </div>
              </div>");            
          }
              echo wp_kses_post("<div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-admin-customizer'></i>
                          " . esc_html__("Demo import", "farvis") . "
                      </h2>
                      <div class='pix_about_block_description'>
                          " . esc_html__("Importing demo data (post, pages, images, theme settings, ...) is the easiest way to setup your theme.  It will allow you to quickly edit everything instead of creating content from scratch.", "farvis") . "
                      </div>
                      <a href='" . esc_url(admin_url('themes.php?page=pt-one-click-demo-import')) . "' class='pix_about_block_link button button-primary'>" . esc_html__("Import", "farvis") . "</a>
                  </div>
              </div>
              
              <div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-admin-appearance'></i>
                          " . esc_html__("Setup Theme options", "farvis") . "
                      </h2>
                      <div class='pix_about_block_description'>
                          " . esc_html__("Using the WordPress Customizer you can easily customize every aspect of the theme. ", "farvis") . "
                      </div>
                      <a href='" . esc_url(admin_url('customize.php')) . "' class='pix_about_block_link button button-primary'>" . esc_html__("Customizer", "farvis") . "</a>
                  </div>
              </div>
              
              <div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-admin-appearance'></i>
                          " . esc_html__("Kawara addons", "farvis") . "
                      </h2>
                      <div class='pix_about_block_description'>
                          " . esc_html__("For the construction of our theme, we use Kaswara addons . This add-on for WPBakery Page Builder (formerly Visual Composer) . With this module you can create different pages without any limits .  ", "farvis") . "
                      </div>
                      <a href='" . esc_url(admin_url('admin.php?page=kaswara-framework')) . "' class='pix_about_block_link button button-primary'>" . esc_html__("Kaswara Addons", "farvis") . "</a>
                  </div>
              </div>
              
              <div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-sos'></i>
                          " . esc_html__("Support", "farvis") . "
                      </h2>" . $html_support . "
                  </div>
              </div>
              <div class='pix_about_block'>
                  <div class='pix_about_block_inner'>
                      <h2 class='pix_about_block_title'>
                          <i class='dashicons dashicons-images-alt2'></i>
                          " . esc_html__("On-line demo", "farvis") . "
                      </h2>
                      <div class='pix_about_block_description'>
                          " . esc_html__("Visit the Demo Version of farvis to check out all the features it has", "farvis") . "
                      </div>
                      <a href='" . esc_url('http://farvis.templines.org/welcome') . "' target='_blank' class='pix_about_block_link button button-primary'>" . esc_html__("View demo", "farvis") . "</a>
                  </div>
              </div>
          </div>
          <div id='pix_theme_changelog' class='pix_tabs_section pix_about_section' style='display: none;'>
              <div class='pix_about_block_inner'>
              
             

 <h2 class='pix_about_block_title'>" . esc_html__("Version 1.1.5 (16.07.2018)", "farvis") . "</h2>      
                 <ul>
                      <li>" . esc_html__("Departments icon bugs   ","farvis") ."</li>
                  </ul> 
                  <code>" . esc_html__(" plugins/theme-plugins/theme-plugins.php ","farvis") ."</code><br>
                   <code>" . esc_html__(" plugins/theme-plugins/vc_templates/common_services_cat.php ","farvis") ."</code><br>

                  
                  <hr>
              
              <h2 class='pix_about_block_title'>" . esc_html__("Version 1.1.4 (15.07.2018)", "farvis") . "</h2>      
                 <ul>
                      <li>" . esc_html__("Minor css bugs   ","farvis") ."</li>
                  </ul> 
                  <code>" . esc_html__(" style.css ","farvis") ."</code><br>
                   <code>" . esc_html__(" assets/minify ","farvis") ."</code><br>

                  
                  <hr>
              
              
      
               <h2 class='pix_about_block_title'>" . esc_html__("Version 1.1.3 (14.07.2018)", "farvis") . "</h2>      
                 <ul>
                      <li>" . esc_html__("Minor css bugs   ","farvis") ."</li>
                       <li>" . esc_html__("Business demo import problem  ","farvis") ."</li>
                  </ul> 
                  <code>" . esc_html__(" style.css ","farvis") ."</code><br>
                   <code>" . esc_html__(" library/* ","farvis") ."</code><br>
                  <code>" . esc_html__(" plugins/theme-plugins/* ","farvis") ."</code><br>

                  
                  <hr>
              
              
              <h2 class='pix_about_block_title'>" . esc_html__("Version 1.1.2 (12.07.2018)", "farvis") . "</h2>      
                 <ul>
                      <li>" . esc_html__("Backend Scripts problem  ","farvis") ."</li>
                  </ul> 
                  <code>" . esc_html__(" js/custom-admin.js ","farvis") ."</code><br>

                  
                  <hr>
                  
                  
              
                 <h2 class='pix_about_block_title'>" . esc_html__("Version 1.1 (10.07.2018)", "farvis") . "</h2>      
                 <ul>
                      <li>" . esc_html__("Plugins update ","farvis") ."</li>
                  </ul> 
                  <code>" . esc_html__(" library/plugins.php ","farvis") ."</code><br>

                  
                  <hr>
                  
                  
                  
              </div>
          </div>
          <div id='pix_theme_requirements' class='pix_tabs_section pix_about_section' style='display: none;'>
              <div class='pix_about_block_inner requirements_inner'>
                  <h2>" . esc_html__("Theme requirements","farvis") ."</h2>
                  <p>" . esc_html__("All of our server requirements are minimal and are recommended by WordPress team .","farvis") ."</p>
<p>" . wp_kses_post("

Contact your web host and ask them to increase those limits to a minimum as follows:","farvis") ."</p>
                  <ul class='theme-requirement-list'>
                      <li>
                      
                          <code>PHP 5.6</code>
                          <i class='fa " . esc_attr($res_phpv) . "'></i>
                          <p>Currently: " . esc_attr($phpv) . "</p>
                      </li>
                      <li>
                      
                          <code>max_execution_time 360</code>
                          <i class='fa " . esc_attr($res_max_execution_time) . "'></i>
                          <p>Currently: " . esc_attr($max_execution_time) . "</p>
                      </li>
                      <li>
                       
                          <code>memory_limit 128M</code>
                         <i class='fa " . esc_attr($res_memory_limit) . "'></i>
                          <p>Currently: " . esc_attr($memory_limit) . "</p>
                      </li>
                      <li>
                     
                          <code>post_max_size 32M</code>
                           <i class='fa " . esc_attr($res_post_max_size) . "'></i>
                          <p>Currently: " . esc_attr($post_max_size) . "</p>
                      </li>
                      <li>
                     
                          <code>upload_max_filesize 32M</code>
                           <i class='fa " . esc_attr($res_upload_max_filesize) . "'></i>
                          <p>Currently: " . esc_attr($upload_max_filesize) . "</p>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div> ");

}
