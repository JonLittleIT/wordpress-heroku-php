<header class="header5">
  <!-- BOTTOM BAR -->
  <nav class="navbar navbar-default" id="modeltheme-main-head">
    <div class="container">
        <div class="row">

          <!-- LOGO -->
          <div class="navbar-header col-md-12">
            <?php if ( !class_exists( 'mega_main_init' ) ) { ?>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <?php } ?>

            <h1 class="logo text-center">
              <a href="<?php echo get_site_url(); ?>">
                <?php if(porfoliowp_redux('mt_logo','url')){ ?>
                  <img src="<?php echo esc_attr(porfoliowp_redux('mt_logo','url')); ?>" alt="<?php echo get_bloginfo(); ?>" />
                <?php }else{ 
                  echo get_bloginfo();
                } ?>
              </a>
            </h1>
          </div>

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

                wp_nav_menu( $defaults );
              ?>
            </ul>
          </div>

        </div>
    </div>
  </nav>
</header>