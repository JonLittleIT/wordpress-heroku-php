<header class="header2">

  <!-- BOTTOM BAR -->
  <nav class="navbar navbar-default" id="modeltheme-main-head">
    <div class="container">
      <div class="row">

        <!-- NAV MENU -->
        <div class="navbar-header header-top-search col-md-4 vc_col-sm-4 vc_col-xs-4">
          <!-- NAV ACTIONS -->
          <div class="header-nav-actions search-action">
            <?php if ( !class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
              <a href="#" class="mt-search-icon">
                <i class="fa fa-search" aria-hidden="true"></i>
                <span class="button_actions_label"><?php echo esc_html__('Search', 'porfoliowp'); ?></span>
              </a>
            <?php }else{ ?>
              <?php if(porfoliowp_redux('mt_header_is_search') == true){ ?>
                <a href="#" class="mt-search-icon">
                  <i class="fa fa-search" aria-hidden="true"></i>
                  <span class="button_actions_label"><?php echo esc_html__('Search', 'porfoliowp'); ?></span>
                </a>
              <?php } ?>
            <?php } ?>
          </div>
        </div>

        <!-- LOGO -->
        <div class="navbar-header header-top-logo col-md-4 vc_col-sm-4 vc_col-xs-4">

          <?php if(porfoliowp_redux('mt_logo','url')){ ?>
            <h1 class="logo">
              <a href="<?php echo get_site_url(); ?>">
                <img src="<?php echo esc_attr(porfoliowp_redux('mt_logo','url')); ?>" alt="<?php echo esc_attr(get_bloginfo()); ?>" />
              </a>
            </h1>
          <?php }else{ ?>
            <h1 class="logo no-logo">
              <a href="<?php echo esc_url(get_site_url()); ?>">
                <?php echo esc_attr(get_bloginfo()); ?>
              </a>
            </h1>
          <?php } ?>
        </div>

        <!-- SEARCH -->
        <div class="navbar-header header-nav-menu col-md-4 vc_col-sm-4 vc_col-xs-4">
          <!-- NAV ACTIONS -->
          <div class="header-nav-actions menu-icon-action">
            <?php if ( !class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
              <!-- MT BURGER -->
              <div id="mt-nav-burger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </div>
              <span class="button_actions_label button_actions_label_open"><?php echo esc_html__('Menu', 'porfoliowp'); ?></span>
            <?php }else{ ?>
              <?php if(porfoliowp_redux('mt_header_fixed_sidebar_menu_status') == true) { ?>
                <!-- MT BURGER -->
                <div id="mt-nav-burger">
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
                <span class="button_actions_label button_actions_label_open"><?php echo esc_html__('Menu', 'porfoliowp'); ?></span>
              <?php } ?>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>
