<?php

defined('ABSPATH') || exit();


class Ekommart_Admin_MegaMenu {

    public function __construct() {
        $this->includes();
        add_action('admin_init', array($this, 'process_create_related'), 1);
        add_filter("theme_elementor_library_templates", [$this, 'add_page_templates'], 10, 4);

    }

    private function includes() {
        include_once get_template_directory() . '/inc/megamenu/includes/admin/class-admin-assets.php';
    }

    public function add_page_templates($page_templates, $wp_theme, $post) {
        $page_templates['inc/megamenu/templates/single-menu.php'] = 'Single Mega Menu';
        return $page_templates;
    }

    public function process_create_related($post_id) {
        if (isset($_GET['ekommart-menu-createable']) && isset($_GET['menu_id']) && absint($_GET['menu_id'])) {
            $menu_id = (int)$_GET['menu_id'];


            $related_id = ekommart_megamenu_get_post_related_menu($menu_id);

            if (!$related_id) {
                ekommart_megamenu_create_related_post($menu_id);
                $related_id = ekommart_megamenu_get_post_related_menu($menu_id);
            }

            if ($related_id && isset($_REQUEST['menu_id']) && is_admin()) {
                $url    = Elementor\Plugin::instance()->documents->get($related_id)->get_edit_url();
                $action = add_query_arg(array('ekommart-menu-editable' => 1), $url);

                wp_redirect($action);
                die;
            }
            exit();
        }
    }
}

new Ekommart_Admin_MegaMenu();
