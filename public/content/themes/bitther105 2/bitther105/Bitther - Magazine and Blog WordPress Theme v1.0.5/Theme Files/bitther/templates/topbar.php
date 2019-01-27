<?php
/**
 * @package     NA Core
 * @version     2.0
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */
?>
<div id="bitther-top-navbar" class="top-navbar">
    <div class="container">
        <div class="row">
            <div class="topbar-left col-xs-12 col-sm-8 col-md-8">
                <div class="na-topbar clearfix">
                    <?php
                    if(is_active_sidebar( 'topbar-left' )){
                        dynamic_sidebar('topbar-left');
                    }else{?>
                        <nav id="na-top-navigation" class="collapse navbar-collapse">
                            <?php
                            if (has_nav_menu('top_navigation')) :
                                // Main Menu
                                wp_nav_menu( array(
                                    'theme_location' => 'top_navigation',
                                    'menu_class'     => 'nav navbar-nav na-menu',
                                    'container'      => '',
                                ) );
                            endif;
                            ?>
                        </nav>
                    <?php }
                    ?>

                </div>
            </div>
            <div class="topbar-right hidden-xs col-sm-4 col-md-4 clearfix">
                <?php
                if(is_active_sidebar( 'topbar-right' )){
                    dynamic_sidebar('topbar-right');
                }?>
            </div>

        </div>
    </div>
</div>