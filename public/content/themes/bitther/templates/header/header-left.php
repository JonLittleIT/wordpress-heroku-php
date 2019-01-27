<?php
/**
 * The default template for displaying content
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

$keepMenu                   = str_replace('','',bitther_keep_menu());
$styleMenu                  = str_replace('','',bitther_header_style());
?>

<header id="masthead" class="site-header header-left <?php echo esc_attr($styleMenu);?> ">
    <div id="bitther-header">
		<?php if(get_theme_mod('bitther_header_ads',false)){ ?>
			<div class="top_ads">
				<div class="container">
					<div class="row">
						<?php
                            if(is_active_sidebar( 'custom-header-ads' )){
                                dynamic_sidebar('custom-header-ads');
                            }
                        ?>
					</div>
				</div>
			</div>
			<?php } ?>
        <?php if(get_theme_mod('bitther_topbar')):?>
            <div class="header-topbar">
                <?php get_template_part('templates/topbar'); ?>
            </div>
        <?php endif;?>

        <div class="header-content-logo container">
                <?php
                    get_template_part('templates/logo');
                ?>
                <div class="main-header">
                    <?php
                    if(is_active_sidebar( 'custom-header-middle' )){
                        dynamic_sidebar('custom-header-middle');
                    }?>
                </div>
                <div class="header-content-right">
                        <div class="searchform-mini">
                            <button class="btn-mini-search"><i class="ti-search"></i></button>
                        </div>
                        <div class="searchform-wrap search-transition-wrap bitther-hidden">
                            <div class="search-transition-inner">
                                <?php
                                    get_search_form();
                                ?>
                                <button class="btn-mini-close pull-right"><i class="ti-close"></i></button>
                            </div>
                        </div>
                </div>
        </div>

        <div class="header-content bar <?php echo esc_attr($keepMenu);?>">
                <div class="bitther-header-content container">
                    <!-- Menu-->
                    <div id="na-menu-primary" class="nav-menu clearfix">
                        <nav class="text-center na-menu-primary clearfix">
                            <?php
                            if (has_nav_menu('primary_navigation')) :
                                // Main Menu
                                wp_nav_menu( array(
                                    'theme_location' => 'primary_navigation',
                                    'menu_class'     => 'nav navbar-nav na-menu mega-menu',
                                    'container'      => '',
                                ) );
                            endif;
                            ?>
                        </nav>
                    </div>
                    <!--Seacrch & Cart-->
                </div>
        </div>
    </div>
</header><!-- .site-header -->