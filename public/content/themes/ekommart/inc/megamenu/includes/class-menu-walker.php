<?php
defined('ABSPATH') || exit();

/**
 * Ekommart_Megamenu_Walker
 *
 * extends Walker_Nav_Menu
 */
class Ekommart_Megamenu_Walker extends Walker_Nav_Menu {


    /**
     * Starts the element output.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param WP_Post $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param stdClass $args An object of wp_nav_menu() arguments.
     * @param int $id Current item ID.
     * @see   Walker::start_el()
     *
     * @since 3.0.0
     * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
     *
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes   = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $extra_ouput = "";
        ///
        if ($this->is_megamenu($item, $depth) && $depth == 0) {
            //echo '<pre>' .print_r( $item ,1 );
            $args->has_children = true;
            if ($item->mega_data['customwidth'] == 0) {
                $classes[] = "has-mega-menu has-fullwidth";
            } elseif ($item->mega_data['customwidth'] == 2) {
                $classes[] = "has-mega-menu has-stretchwidth";
            } elseif ($item->mega_data['customwidth'] == 3) {
                $classes[] = "has-mega-menu has-containerwidth";
            } else {
                $classes[] = isset($item->mega_data['menuposition']) && $item->mega_data['menuposition'] == 1 ? "sub-menu-left has-mega-menu" : "has-mega-menu";
            }
            $extra_ouput = $this->render_megamenu_elementor($item, $args, $depth);
        }
        /**
         * Filters the arguments for a single nav menu item.
         *
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param WP_Post $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 4.4.0
         *
         */
        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        /**
         * Filters the CSS class(es) applied to a menu item's list item element.
         *
         * @param array $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param WP_Post $item The current menu item.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         */
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        /**
         * Filters the ID applied to a menu item's list item element.
         *
         * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param WP_Post $item The current menu item.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         */
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts           = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';

        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         *
         * @param array $atts {
         *                         The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         * @type string $title Title attribute.
         * @type string $target Target attribute.
         * @type string $rel The rel attribute.
         * @type string $href The href attribute.
         * }
         *
         * @param WP_Post $item The current menu item.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         */
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value      = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        /**
         * Megamenu info
         */
        $icon = '';

        if (isset($item->mega_data) && !empty($item->mega_data)) {
            if (!empty($item->mega_data['icon'])) {
                $icon_class = $item->mega_data['icon'];
                if($icon_class == 1) {
                    $icon_class = $item->mega_data['icon-custom'];
                }
                $icon = ekommart_megamenu_get_icon_html($icon_class, $item->mega_data);
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters('the_title', $item->title, $item->ID);

        $title = sprintf(
            '%1$s<span class="menu-title">%2$s</span>',
            $icon,
            $title
        );

        /**
         * Filters a menu item's title.
         *
         * @param string $title The menu item's title.
         * @param WP_Post $item The current menu item.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @param int $depth Depth of menu item. Used for padding.
         * @since 4.4.0
         *
         */
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $item_output .= $extra_ouput;
        /**
         * Filters a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @param string $item_output The menu item's starting HTML output.
         * @param WP_Post $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param stdClass $args An object of wp_nav_menu() arguments.
         * @since 3.0.0
         *
         */
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }


    /**
     * Traverse elements to create list from elements.
     *
     * Display one element if the element doesn't have any children otherwise,
     * display the element and its children. Will only traverse up to the max
     * depth and no ignore elements under that depth. It is possible to set the
     * max depth to include all depths, see walk() method.
     *
     * This method should not be called directly, use the walk() method instead.
     *
     * @param object $element Data object.
     * @param array $children_elements List of elements to continue traversing (passed by reference).
     * @param int $max_depth Max depth to traverse.
     * @param int $depth Depth of current element.
     * @param array $args An array of arguments.
     * @param string $output Used to append additional content (passed by reference).
     * @since 2.5.0
     *
     */
    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
        if (!$element) {
            return;
        }
        // echo '<pre>'.print_r( $element ,1 );die;
        $element->mega_data = ekommart_megamenu_get_item_data($element->ID);

        if ($this->is_megamenu($element, $depth) && $depth == 0) {
            $id_field = $this->db_fields['id'];
            if (isset($children_elements[$element->$id_field]) && is_array($children_elements[$element->$id_field])) {
                foreach ($children_elements[$element->$id_field] as $_item) {
                    $children_elements[$_item->ID] = array();
                }

                $children_elements[$element->$id_field] = array();
            }
        }
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    /**
     * Check megamenu for only item at depth = 0
     */
    public function is_megamenu($item, $depth) {
        if ($depth == 0) {
            return (isset($item->mega_data['enabled']) && !empty($item->mega_data['enabled']));
        }
        return false;
    }

    /**
     * Display megamenu content which was rendered elementor
     */
    public function render_megamenu_elementor($item, $args, $depth) {
        $output = "";
        if (class_exists('Elementor\Plugin')) {
            $post_id = ekommart_megamenu_get_post_related_menu($item->ID);

            $elementor = Elementor\Plugin::instance();
            $content   = $elementor->frontend->get_builder_content_for_display($post_id);


            // Default class.

            $style = "";

            if ($item->mega_data['subwidth'] && $item->mega_data['customwidth'] == 2) {
                $classes = array('sub-menu', 'mega-menu', 'mega-stretchwidth');
            } elseif ($item->mega_data['subwidth'] && $item->mega_data['customwidth'] == 0) {
                $classes = array('sub-menu', 'mega-menu', 'mega-fullwidth');
            } elseif ($item->mega_data['subwidth'] && $item->mega_data['customwidth'] == 3) {
                $classes = array('sub-menu', 'mega-menu', 'mega-fullwidth', 'mega-containerwidth');
            } else {
                $style   .= 'style="width:' . $item->mega_data['subwidth'] . 'px"';
                $classes = array('sub-menu', 'mega-menu', 'custom-subwidth');
            }

            /**
             * Filters the CSS class(es) applied to a menu list element.
             *
             * @param array $classes The CSS classes that are applied to the menu `<ul>` element.
             * @param stdClass $args An object of `wp_nav_menu()` arguments.
             * @param int $depth Depth of menu item. Used for padding.
             * @since 4.8.0
             *
             */

            $class_names = join(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            $output = "<ul $class_names " . $style . "><li class=\"mega-menu-item\">" . do_shortcode($content) . "</li></ul>";
        }

        return $output;
    }
}
