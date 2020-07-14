<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

/**
 * Custom Menus
 */

if( basename( $_SERVER['PHP_SELF']) == "nav-menus.php" ) {
	add_action( 'admin_menu', 'woohoo_custom_menu_style' );
}


add_action("wp_ajax_getlisticon", "woohoo_getlisticon");
function woohoo_getlisticon()
{
	$file = include ( get_template_directory(). '/framework/admin/html/icon.html' );
	echo $file;
	exit();
}

function woohoo_custom_menu_style() {
	wp_register_script( 'bd-mega', get_template_directory_uri().'/framework/admin/js/bd.js', array( 'jquery' ), false, false);
	wp_enqueue_script( 'bd-mega' );
	wp_enqueue_media();
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
}

/*
 * Saves new field to postmeta for navigation
 */
add_action('wp_update_nav_menu_item', 'woohoo_custom_nav_update',10, 3);
function woohoo_custom_nav_update($menu_id, $menu_item_db_id, $args ) {

	if ( isset( $_REQUEST['menu-itemDisplay'] ) ) {

		if ( is_array($_REQUEST['menu-itemDisplay']) ) {

			$itemDisplay = $_REQUEST['menu-itemDisplay'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_itemDisplay', $itemDisplay );
		}
	}

	if ( isset( $_REQUEST['menu-item-color'] ) ) {

		if ( is_array( $_REQUEST['menu-item-color'] ) ) {

			$color_value = $_REQUEST['menu-item-color'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_color', $color_value );
		}
	}

	if ( isset( $_REQUEST['menu-itemIcon'] ) ) {

		if ( is_array( $_REQUEST['menu-itemIcon'] ) ) {

			$itemIcon = $_REQUEST['menu-itemIcon'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_itemIcon', $itemIcon );
		}
	}

	if ( isset( $_REQUEST['menu-itemType'] ) ) {

		if ( is_array($_REQUEST['menu-itemType'] ) ) {

			$itemType = $_REQUEST['menu-itemType'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_itemType', $itemType );
		}
	}
}

/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_Custom
 */
add_filter( 'wp_setup_nav_menu_item','woohoo_custom_nav_item' );
function woohoo_custom_nav_item( $menu_item ) {

	$menu_item->bdayhColor          = get_post_meta( $menu_item->ID, '_menu_item_color', true );
	$menu_item->bdayhDisplay        = get_post_meta( $menu_item->ID, '_menu_itemDisplay', true );
	$menu_item->bdayhIcon           = get_post_meta( $menu_item->ID, '_menu_itemIcon', true );
	$menu_item->bdayhType           = get_post_meta( $menu_item->ID, '_menu_itemType', true );
	return $menu_item;
}

add_filter( 'wp_edit_nav_menu_walker', 'woohoo_custom_nav_edit_walker',10,2 );
function woohoo_custom_nav_edit_walker( $walker,$menu_id ) {

	return 'Woohoo_Walker_Nav_Menu_Edit_Custom';
}

/**
 * Copied from Walker_Nav_Menu_Edit class in core
 *
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Woohoo_Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() )
	{}

	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = $original_object->post_title;
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( '%s (Invalid)', $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( '%s (Pending)', $item->title );
		}

		$title = empty( $item->label ) ? $title : $item->label;

		?>
    <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
        <dl class="menu-item-bar">
            <dt class="menu-item-handle">
                <span class="item-title"><?php echo esc_html( $title ); ?></span>
                <span class="item-controls">
                    <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                    <span class="item-order hide-if-js">
                        <a href="<?php
                        echo wp_nonce_url(
	                        add_query_arg(
		                        array(
			                        'action' => 'move-up-menu-item',
			                        'menu-item' => $item_id,
		                        ),
		                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                        ),
	                        'move-menu_item'
                        );
                        ?>" class="item-move-up"><abbr title="Move up">&#8593;</abbr></a>
                        |
                        <a href="<?php
                        echo wp_nonce_url(
	                        add_query_arg(
		                        array(
			                        'action' => 'move-down-menu-item',
			                        'menu-item' => $item_id,
		                        ),
		                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
	                        ),
	                        'move-menu_item'
                        );
                        ?>" class="item-move-down"><abbr title="Move down">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="Edit Menu Item" href="<?php
                    echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                    ?>">Edit Menu Item</a>
                </span>
            </dt>
        </dl>

        <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
			<?php if( 'custom' == $item->type ) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                        URL<br />
                        <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                    </label>
                </p>
			<?php endif; ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                    Navigation Label<br />
                    <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
                    Title Attribute<br />
                    <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                </label>
            </p>
            <p class="field-link-target description">
                <label for="edit-menu-item-target-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
                    Open link in a new window/tab
                </label>
            </p>
            <p class="field-css-classes description description-thin">
                <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
                    CSS Classes (optional)<br />
                    <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                </label>
            </p>
            <p class="field-xfn description description-thin">
                <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
                    Link Relationship (XFN)<br />
                    <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                </label>
            </p>
            <p class="field-description description description-wide">
                <label for="edit-menu-item-description-<?php echo $item_id; ?>">
                    Description<br />
                    <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                    <span class="description">The description will be displayed in the menu if the current theme supports it.</span>
                </label>
            </p>
			<?php
			/*
			 * This is the added field
			 */
			?>

			<?php /* START Custom icon */ ?>
            <p class="fieldIcon description description-wide">
                <label for="edit-menu-itemIcon-<?php echo $item_id; ?>">
                    <strong>Menu Item Icon</strong>
                    <br />

                    <div class="iconSelector">

                        <a class="selectIconMenu button" data-id="<?php echo $item_id; ?>">
                            Select Icon
                        </a>

                        <span class="iconsView">
                            <i id="icon-preview-<?php echo $item_id; ?>" class="fa <?php echo esc_attr( $item->bdayhIcon ); ?>"></i>
                            <a href="#" data-id="<?php echo $item_id; ?>" class="removeIcon" title="Remove Icon">x</a>
                        </span>

                        <input type="hidden" id="edit-menu-itemIcon-<?php echo $item_id; ?>" class="widefat code edit-menu-itemIcon iconHolder" name="menu-itemIcon[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->bdayhIcon ); ?>" \>
                    </div>
                </label>
            </p>

			<?php /* START Custom li Display */ ?>
            <p class="fieldDisplay description description-wide">
                <label for="edit-menu-itemDisplay-<?php echo $item_id; ?>">
                    <strong>Display</strong>
                    <br />

                    <select id="edit-menu-itemDisplay-<?php echo $item_id; ?>" class="widefat code edit-menu-itemDisplay" name="menu-itemDisplay[<?php echo $item_id; ?>]">
                        <option value="" <?php selected( $item->bdayhDisplay, '' ); ?>>Label And Icon</option>
                        <option value="icon" <?php selected( $item->bdayhDisplay, 'icon' ); ?>>Just Icon</option>
                        <option value="none" <?php selected( $item->bdayhDisplay, 'none' ); ?>>None</option>
                    </select>
                </label>
            </p>

			<?php /* START Custom Type Menus */ ?>
            <p class="fieldType description description-wide">
                <label for="edit-menu-itemType-<?php echo $item_id; ?>">
                    <strong>Dropdown Menu Type</strong>
                    <br />

                    <select id="edit-menu-itemType-<?php echo $item_id; ?>" class="widefat code edit-menu-itemType" name="menu-itemType[<?php echo $item_id; ?>]">
                        <option value="none" <?php selected( $item->bdayhType, 'none' ); ?>>Default</option>
                        <option value="mega1col" <?php selected( $item->bdayhType, 'mega1col' ); ?>>Mega Menu 1 columns</option>
                        <option value="mega2col" <?php selected( $item->bdayhType, 'mega2col' ); ?>>Mega Menu 2 columns</option>
                        <option value="mega3col" <?php selected( $item->bdayhType, 'mega3col' ); ?>>Mega Menu 3 columns</option>
                        <option value="mega" <?php selected( $item->bdayhType, 'mega' ); ?>>Mega Menu 4 columns</option>
                        <option value="mega5col" <?php selected( $item->bdayhType, 'mega5col' ); ?>>Mega Menu 5 columns</option>
                        <option value="cats" <?php selected( $item->bdayhType, 'cats' ); ?>>Category Menu</option>
                    </select>
                </label>
            </p>

			<?php /* START Custom Color */ ?>
            <p class="field-color description description-wide" style="display: none">
                <label for="edit-menu-item-color-<?php echo $item_id; ?>">
                    <strong>Menu item Color</strong>
                    <br />

                    <input type="text" id="edit-menu-item-color-<?php echo $item_id; ?>" class="widefat bdayh-color-field edit-menu-item-color" name="menu-item-color[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->bdayhColor ); ?>" />
                    <br><span style="display: none" class="description cat_only">don't use this field if you select main color from "category" or "page".</span>

                </label>
            </p>

			<?php
			/*
			 * end added field
			 */
			?>
            <div class="menu-item-actions description-wide submitbox">
				<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                    <p class="link-to-original">
						<?php printf( 'Original: %s', '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                    </p>
				<?php endif; ?>
                <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
				echo wp_nonce_url(
					add_query_arg(
						array(
							'action' => 'delete-menu-item',
							'menu-item' => $item_id,
						),
						remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
					),
					'delete-menu_item_' . $item_id
				); ?>">Remove</a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
				?>#menu-item-settings-<?php echo $item_id; ?>">Cancel</a>
            </div>

            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
        </div><!-- .menu-item-settings-->
        <ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}
}


class WOOHOO_Walker extends Walker_Nav_Menu {

	private $bdayh_menu = '';
	private $bdayh_class = '';
	private $bd_post_id;
	private $bdayh_warp = false;
	private $th_item;

	/* START lvl --------------------------------------------------------------*/
	function start_lvl( &$output, $depth = 0, $args = array() )
	{
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"{{bdayh_start}} sub-menu\">\n";
	}

	/* END lvl --------------------------------------------------------------*/
	function end_lvl( &$output, $depth = 0, $args = array() )
	{
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>  \n";


		if($depth === 0)
		{
			if($this->bdayh_class == 'mega')
			{
				$output = str_replace("{{bdayh_start}}", 'bd_mega', $output);
			}
            elseif($this->bdayh_class == 'mega1col')
			{
				$output = str_replace("{{bdayh_start}}", 'bd_mega', $output);
			}
            elseif($this->bdayh_class == 'mega2col')
			{
				$output = str_replace("{{bdayh_start}}", 'bd_mega', $output);
			}
            elseif($this->bdayh_class == 'mega3col')
			{
				$output = str_replace("{{bdayh_start}}", 'bd_mega', $output);
			}
            elseif($this->bdayh_class == 'mega4col')
			{
				$output = str_replace("{{bdayh_start}}", 'bd_mega', $output);
			}
            elseif($this->bdayh_class == 'mega5col')
			{
				$output = str_replace("{{bdayh_start}}", 'bd_mega', $output);
			}
            elseif($this->bdayh_class == 'none')
			{
				$output = str_replace("{{bdayh_start}}", 'bd_none', $output);

			}
            elseif($this->bdayh_class == 'cats')
			{
				$output = str_replace("{{bdayh_start}}", 'bd_cats', $output);

			}
			else
			{
				$output = str_replace("{{bdayh_start}}", '', $output);

			}
		}

	}


	function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
		$id_field = $this->db_fields['id'];

		// check whether there are children for the given ID
		$element->hasChildren = isset($children_elements[$element->$id_field]) && !empty($children_elements[$element->$id_field]);

		if ( ! empty($children_elements[$element->$id_field])) {
			$element->classes[] = 'menu-item--parent';
		}

		Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}


	/* START el --------------------------------------------------------------*/
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;

		$mega_menu = '';
		if($depth == 0)
		{
			if($item->bdayhType == 'mega' )
			{
				$this->bdayh_class = 'mega';
				$mega_menu = 'bd_mega_menu mega-columns-4';
			}
            elseif($item->bdayhType == 'mega1col' )
			{
				$this->bdayh_class = 'mega1col';
				$mega_menu = 'bd_mega_menu mega-columns-1';
			}
            elseif($item->bdayhType == 'mega2col' )
			{
				$this->bdayh_class = 'mega2col';
				$mega_menu = 'bd_mega_menu mega-columns-2';
			}
            elseif($item->bdayhType == 'mega3col' )
			{
				$this->bdayh_class = 'mega3col';
				$mega_menu = 'bd_mega_menu mega-columns-3';
			}
            elseif($item->bdayhType == 'mega5col' )
			{
				$this->bdayh_class = 'mega5col';
				$mega_menu = 'bd_mega_menu mega-columns-5';
			}
            elseif($item->bdayhType == 'none')
			{
				$this->bdayh_class = 'none';
				$mega_menu = 'bd_menu_item';
			}
            elseif( $item->bdayhType == 'cats' ) {
				$this->bdayh_class = 'cats';
				$mega_menu = 'bd_cats_menu';
			}
		}

		// GET list a classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes = in_array( 'current-menu-item', $classes ) ? array( 'current-menu-item' ) : array();
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
		// GET a id
		$id = '';
		$id = apply_filters( 'nav_menu_item_id', '', $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$this->bd_post_id = $item->object_id;

		// GET a attr
		$attributes = '';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$icon_class ='';
		if( $item->bdayhDisplay == 'icon' ) {
			$icon_class = ' fa-icon ';
		}
		$depth_var ='';
		//$implode = implode('',$item->classes);
		$implode = '';
		if($item->classes){
			$implode = implode(' ',$item->classes);
		}

		$output .= '<li id="menu-item-'. $item->ID .'" class="'.$implode.' bd_depth-'.$depth_var.' '.$mega_menu.' '.$icon_class.'" >';

		if( $item->bdayhColor ) {

			$label_color = 'color:'.$item->bdayhColor;
		}

		if( $item->bdayhDisplay != 'none' ) {

			$item_icon = ($item->bdayhIcon != '') ? '<i class="fa '.$item->bdayhIcon.'"></i>':'';
		}

		$item_display = ($item->bdayhDisplay == 'icon') ? ' display:none; ':'';

		$output .= '<a'. $attributes . $id  . $class_names . '> '.$item_icon.' <span class="menu-label" style="'.$item_display.'" >';

		//$output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID). $args->link_after;

		if( is_object($args) ){
			$output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		}

		$output .= "</span></a>\n";
		//$output .= $args->after;

		if( is_object($args) ){
			$output .= $args->after;
		}


		if( $depth == 0 && $item->object == 'category' ) {
			if ($item->bdayhType =='cats')
			{
				$output .= "<div class=\"sub_cats_posts cats-mega-wrap\">\n";
			}
		}

		if ( $item->bdayhType =='mega' || $item->bdayhType == 'mega1col' || $item->bdayhType == 'mega2col' || $item->bdayhType == 'mega3col' || $item->bdayhType == 'mega5col' ) {
			$output .= "<div class='bd_mega sub-menu'>\n";
		}
	}

	/* END el --------------------------------------------------------------*/
	function end_el( &$output, $item, $depth = 0, $args = array() )
	{
		/**
		 * Start depth 0
		 * ========================================================= */

		if( $depth === 0 )
		{
			$output .="\n<div class=\"mega-menu-content\">\n";

			if( $item->bdayhType == 'cats' && $item->object == 'category' )
			{
				$no_sub_categories = $sub_categories_exists = $sub_categories = '';

				$query_args = array(
					'child_of'                 => $item->object_id,
				);
				$sub_categories = get_categories($query_args);

				if( count($sub_categories) == 0 )
				{
					$sub_categories     = array( $item->object_id );
					$no_sub_categories  = true;
					$nu = 5;
				}
				else {
					$sub_categories_exists = ' mega-cat-sub-exists';
					$nu = 4;
				}

				$output .= '<div class="mega-cat-wrapper">';

				if( !$no_sub_categories ){
					$output .= '<div class="mega-cat-sub-categories"><ul class="mega-cat-sub-categories"> ';
					foreach( $sub_categories as $category )
					{
						$category_link = get_category_link( $category->term_id );
						$output .= '<li><a href="'.$category_link.'" id="#mega-cat-'.$item->ID.'-'.$category->term_id.'">'.$category->name.'</a></li>';
					}
					$output .=  '</ul></div>';
				}

				$output .= ' <div class="mega-cat-content'. $sub_categories_exists.'">';

				foreach( $sub_categories as $category )
				{

					if( !$no_sub_categories ) {
						$cat_id = $category->term_id;
					}
					else {
						$cat_id = $category;
					}

					$output .=  '<div id="mega-cat-'.$item->ID.'-'.$cat_id.'" class="mega-cat-content-tab"><div class="mega-cat-content-tab-inner">';

					$args = array(
						'posts_per_page'		 => $nu,
						'cat'          			 => $cat_id,
						'no_found_rows'          => true,
						'ignore_sticky_posts'	 => true
					);
					$cat_query = new WP_Query( $args );

					while ( $cat_query->have_posts() ) :
						$cat_query->the_post();
						$category   = get_the_category();
						$title      = get_the_title();
						$link       = get_permalink();
						$image      = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $GLOBALS['bdaia-widget'] );
						$image_url  = $image[0];

						$thumb_bg = '';
						if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) )
						{
							$thumb_bg = $background = woohoo_get_option( 'bdaia_has_lazy_load' ) ? 'data-src="'. esc_attr( woohoo_get_src( $GLOBALS['bdaia-widget'] ) ) .'"' : 'style="'. esc_attr( woohoo_get_src_bg( $GLOBALS['bdaia-widget'] ) ) .'"';
						}

						$output .= "<div class='bd-block-mega-menu-post'>";
						$output .= "<div class='bd-block-mega-menu-thumb'>";
						$output .= woohoo_icon_video_play();
						$output .= "<a href='" .$link. "' rel='bookmark' title='" .$title. "'>";
						$output .= "<span class='mm-img' " . $thumb_bg . " title='".$title."'></span>";
						$output .= "</a>";
						$output .= "</div>";
						$output .= "<div class='bd-block-mega-menu-details'>";
						$output .= "<h4 class='entry-title'>";
						$output .= "<a href='" .$link. "' title='" .$title. "'>" .$title. "</a>";
						$output .= "</h4>";

						$post_reviews               = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true                );
						$bd_brief_summary           = get_post_meta( get_the_ID(), 'bdaia_taqyeem_brief', true          );
						$bdaia_taqyeem_final_score  = get_post_meta( get_the_ID(), 'bdaia_taqyeem_final_score', true    );

						if( $post_reviews ) {
							if ( $bdaia_taqyeem_final_score ) {
								$output .= '<span class="woohoo-star-rating" title="' . $bd_brief_summary . '"><span style="width: ' . round( $bdaia_taqyeem_final_score ) . '%"></span></span>';
							}
						}

						$output .= "</div>";
						$output .= "</div>";
					endwhile;
					wp_reset_query();
					$output .=  '</div></div>';
				}
				$output .= '</div><div class="cfix"></div></div>';
			}
			$output .= "</div>";
		}

		/**
		 * End depth 0
		 * ========================================================= */


		/*
		if ( $depth==0 &&  $item->object == 'category' ) {

			if ( $item->bdayhType == 'cats' ) {

				$post_args = array(
					'post__not_in'      => array($post->ID),
					'post_type'         => 'post',
					'post_status'       => 'publish',
					'posts_per_page'    => 5,
					'cat'               => $item->object_id
				);

				$output .= '<div class="ff">';
				$output .= "<div class='bd-block-mega-menu' data-id='cat-" . $item->object_id . "'><div class='bd-block-mega-menu-inner'>";
				$post_args['posts_per_page'] = 5;
				$menuposts = new wp_query($post_args);

				while ( $menuposts->have_posts())  : $menuposts->the_post();

					$category   = get_the_category();
					$title      = get_the_title();
					$link       = get_permalink();
					$image      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $GLOBALS['bdaia-widget'] );
					$image_url  = $image[0];

					// GET Video Link.
					$bdaia_p_video = get_post_meta( get_the_ID(),'post_video_bd', true );
					$video_id = $video_type = $bdaia_video_url = $post_menu_video_io = '';
					if( isset( $bdaia_p_video['video'] ) ) $video_id = $bdaia_p_video['video'];
					if( isset( $bdaia_p_video['video_type'] ) ) $video_type = $bdaia_p_video['video_type'];
					$protocol = is_ssl() ? 'https' : 'http';

					if( $video_type == "youtube" ) $bdaia_video_url = $protocol.'://www.youtube.com/embed/'.$video_id.'?autoplay=0&amp;autohide=1&amp;fs=1&amp;rel=0&amp;hd=1&amp;wmode=opaque&amp;enablejsapi=1';
					elseif( $video_type == "vimeo" ) $bdaia_video_url = $protocol.'://player.vimeo.com/video/'.$video_id.'?autoplay=0';
					elseif( $video_type == "daily" ) $bdaia_video_url = $protocol.'://www.dailymotion.com/embed/video/'.$video_id;

					if( $video_id ) {
						$post_menu_video_io =  ' <div class="vid-play"><a href="'.$bdaia_video_url.'" class="lightbox-enabled" title="Play Video" data-options="width:800, height:480"><span class="bdaia-io bdaia-io-controller-play"></span></a></div>';
					}

					$output .= "<div class='bd-block-mega-menu-post'>";
					$output .= "<div class='bd-block-mega-menu-thumb'>";
					$output .= " . $post_menu_video_io . ";
					$output .= "<a href='" .$link. "' rel='bookmark' title='" .$title. "'>";
					$output .= "<span class='mm-img' title='".$title."' style='background-image: url( ".$image_url." )'></span>";
					$output .= "</a>";
					$output .= "</div>";
					$output .= "<div class='bd-block-mega-menu-details'>";
					$output .= "<h4 class='entry-title'>";
					$output .= "<a href='" .$link. "' title='" .$title. "'>" .$title. "</a>";
					$output .= "</h4>";
					$output .= "</div>";
					$output .= "</div>";

				endwhile;
				wp_reset_postdata();

				$output .= "</div></div>";
				$output .= '</div></div>';
			}
		}
		*/

		if ( $depth == 0 && $item->bdayhType =='mega' || $item->bdayhType == 'mega1col' || $item->bdayhType == 'mega2col' || $item->bdayhType == 'mega3col' || $item->bdayhType == 'mega5col' ) {
			$output .= "</div>\n";
		}
	}
} //end of walker class

add_filter( 'wp_nav_menu_objects', 'woohoo_add_menu_child_items' );
function woohoo_add_menu_child_items( $items ) {

	$parents = array();
	foreach ( $items as $item ) {
		$item->children = array();
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}

	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item';

			foreach ( $items as $citem ) {
				if ( $citem->menu_item_parent && $citem->menu_item_parent == $item->ID ) {
					$item->children[] = $citem;
				}
			}
		}
	}

	return $items;
}