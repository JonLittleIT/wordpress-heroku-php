<header class="header8">
  <!-- BOTTOM BAR -->
  <nav class="navbar navbar-default" id="modeltheme-main-head">
    <div class="container">
        <div class="row">

          <!-- LOGO -->
          <div class="navbar-header col-md-3">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

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

          <!-- NAV MENU -->
          <div id="navbar" class="navbar-collapse collapse col-md-9">

            <div class="header-nav-actions">

              <?php if(porfoliowp_redux('mt_header_fixed_sidebar_menu_status') == true){ ?>
                <!-- MT BURGER -->
                <div class="mt-nav-burger-holder">
                  <div id="mt-nav-burger" class="menu-item">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>
                </div>
              <?php } ?>

              <?php if(porfoliowp_redux('mt_header_is_search') == true){ ?>
                <a href="#" class="mt-search-icon menu-item">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </a>
              <?php } ?>
              
            </div>
            <ul class="menu nav navbar-nav pull-right nav-effect nav-menu">
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

                wp_nav_menu( $defaults );
              ?>
            </ul>

            

          </div>


        </div>
    </div>
  </nav>
</header>