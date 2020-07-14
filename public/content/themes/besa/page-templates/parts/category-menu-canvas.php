<?php if ( has_nav_menu( 'nav-category-menu' ) ):

$open =   apply_filters( 'besa_category_inside_class', '');

?>
<div class="category-inside vertical-menu <?php echo esc_attr($open); ?>">
    <a href="javascript:void(0);" class="category-inside-title"><i class="tb-icon tb-icon-menu"></i><?php echo apply_filters( 'besa_category_inside_title', esc_html__( 'All Departments', 'besa' ) ); ?></a>
    <div class="category-inside-content">
        <nav role="navigation">
            <?php
                $args = array(
                    'theme_location' => 'nav-category-menu',
                    'menu_class'      => 'tbay-menu-category tbay-vertical',
                    'fallback_cb'     => '',
                    'menu_id' => 'nav-category-menu',
                );
                if( class_exists("Besa_Tbay_Custom_Nav_Menu") ){

                    $args['walker'] = new Besa_Tbay_Custom_Nav_Menu();
                }
                wp_nav_menu($args);
            ?>
        </nav>
    </div>
</div>
<?php endif;?>