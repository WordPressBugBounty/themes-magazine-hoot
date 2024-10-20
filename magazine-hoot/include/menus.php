<?php
/**
 * Register custom theme menus
 * This file is loaded via the 'after_setup_theme' hook at priority '10'
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/* Register custom menus. */
add_action( 'init', 'maghoot_base_register_menus', 5 );

/**
 * Registers nav menu locations.
 *
 * @since 1.0
 * @access public
 * @return void
 */
function maghoot_base_register_menus() {
	register_nav_menu( 'hoot-primary', _x( 'Header Area (right of logo)', 'nav menu location', 'magazine-hoot' ) );
	register_nav_menu( 'hoot-secondary', _x( 'Full width Menu Area (below logo)', 'nav menu location', 'magazine-hoot' ) );
}

/**
 * Display Menu Nav Item Description
 *
 * @since 1.6
 * @param string   $title The menu item's title.
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item. Used for padding.
 * @return string
 */
if ( !function_exists( 'maghoot_theme_menu_description' ) ):
function maghoot_theme_menu_description( $title, $item, $args, $depth ) {

	$return = '';
	$return .= '<span class="menu-title">' . $title . '</span>';
	if ( !empty( $item->description ) )
		$return .= '<span class="menu-description">' . $item->description . '</span>';

	return $return;
}
endif;
add_filter( 'nav_menu_item_title', 'maghoot_theme_menu_description', 5, 4 );

/**
 * Get the top level menu items array
 *
 * @since 1.0
 * @access public
 * @return void
 */
function maghoot_nav_menu_toplevel_items( $theme_location = 'hoot-primary' ) {
	static $location_items;
	if ( !isset( $location_items[$theme_location] ) && ($theme_locations = get_nav_menu_locations()) && isset( $theme_locations[$theme_location] ) ) {
		$menu_obj = get_term( $theme_locations[$theme_location], 'nav_menu' );
		if ( !empty( $menu_obj->term_id ) ) {
			$menu_items = wp_get_nav_menu_items($menu_obj->term_id);
			if ( $menu_items )
				foreach( $menu_items as $menu_item )
					if ( empty( $menu_item->menu_item_parent ) )
						$location_items[$theme_location][] = $menu_item;
		}
	}
	if ( !empty( $location_items[$theme_location] ) )
		return $location_items[$theme_location];
	else
		return array();
}

/** BuddyPress **/

// Fix for adding buddypress menu items to secondary menu theme location
// Issue: 'maghoot_nav_menu_toplevel_items' fn (used in customizer-options.php) calls 'wp_get_nav_menu_items' fn
// this causes error in BP Uncaught Error: Call to a member function get_primary() on null in bp-core-functions.php on line 2568
// $bp_menu_items = $bp->members->nav->get_primary();  ::=> 'nav' is no yet defined
// Hence we remove fn 'bp_setup_nav_menu_item' on filter 'wp_setup_nav_menu_item' since this fn uses 'bp_nav_menu_get_item_url' which in turn calls 'bp_nav_menu_get_loggedin_pages' fn which is where the above code line is.
// Reintroduce this filter at a later hook when BP has finished setting up 'nav' for $bp->members
// NOTE: even though this file is 'loaded' after customizer-options.php, this does not matter since it actually ends up running on init@0
if ( class_exists('BuddyPress') ) {
	remove_filter( 'wp_setup_nav_menu_item', 'bp_setup_nav_menu_item', 10, 1 );
	add_action( 'init', 'hybridtheme_bp_menuitemfix', 11 ); // default @10 als0 works. We add @11 for brevity
	function hybridtheme_bp_menuitemfix(){
		add_filter( 'wp_setup_nav_menu_item', 'bp_setup_nav_menu_item', 10, 1 );
	}
}