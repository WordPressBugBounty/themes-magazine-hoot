<?php
/**
 * Woocommerce functions
 * This file is loaded at 'after_setup_theme' action @priority 10 ONLY IF woocommerce plugin is active
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/**
 * Woocommerce Template Setup
 *
 * @since 1.4
 * @access public
 * @return void
 */
function maghoot_woo_setup() {
	// Remove default woocommerce opening divs for the content
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );

	// Remove woocommerce breadcrumbs
	// if ( !is_product() )
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

	// Remove default woocommerce closing divs for the content
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

	/* Add theme support for WC Product Gallery slider and zoom */
	// Since this file is loaded using 'after_setup_theme' hook at priority 10, theme support can be added directly.
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'wp', 'maghoot_woo_setup' );

/**
 * Registers woocommerce sidebars.
 *
 * @since 1.0
 * @access public
 * @return void
 */
function maghoot_woo_register_sidebars() {
	hybrid_register_sidebar(
		array(
			'id'          => 'hoot-woocommerce-sidebar',
			'name'        => _x( 'Woocommerce Primary Sidebar', 'sidebar', 'magazine-hoot' ),
			'description' => __( 'The primary sidebar for woocommerce pages.', 'magazine-hoot' ),
			'before_title' => '<h3 class="widget-title"><span class="accent-typo">',
			'after_title'  => '</span></h3>',
		)
	);
	hybrid_register_sidebar(
		array(
			'id'          => 'hoot-woocommerce-sidebar-secondary',
			'name'        => _x( 'Woocommerce Secondary Sidebar', 'sidebar', 'magazine-hoot' ),
			'description' => __( 'The secondary sidebar for woocommerce pages (if you are using a 3 column layout with 2 sidebars).', 'magazine-hoot' ),
			'before_title' => '<h3 class="widget-title"><span class="accent-typo">',
			'after_title'  => '</span></h3>',
		)
	);
}
add_action( 'widgets_init', 'maghoot_woo_register_sidebars' );

/**
 * Add woocommerce sidebar class.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @param string $context
 * @return array
 */
function maghoot_theme_woo_attr_sidebar( $attr, $context ) {
	if ( !empty( $context ) && ( $context == 'primary' || $context == 'secondary' ) ) {
		if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
			$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
			$attr['class'] .= " woocommerce-sidebar woocommerce-sidebar-{$context}";
		}
	}
	return $attr;
}
add_filter( 'hybrid_attr_sidebar', 'maghoot_theme_woo_attr_sidebar', 11, 2 );

/**
 * Apply sidebar layout for woocommerce pages
 *
 * @since 1.0
 * @access public
 * @param string $sidebar
 * @return array
 */
function maghoot_woo_main_layout( $sidebar ) {

	// Check for pages which use WooCommerce templates (cart and checkout are standard 'Pages' with shortcodes and thus are not included)
	if ( is_woocommerce() ){
		if ( is_product() ) { // single product page. Wrapper for is_singular
			$sidebar = maghoot_get_mod( 'sidebar_wooproduct' );
		} else { // shop, category, tag archives etc
			$sidebar = maghoot_get_mod( 'sidebar_wooshop' );
		}
	}

	// Let developers edit default layout for Cart and Checkout which are standard 'Pages' with shortcodes
	$forcenosidebar = apply_filters( 'maghoot_woo_pages_force_nosidebar', true );
	if ( $forcenosidebar && ( is_cart() || is_checkout() || is_account_page() ) ) {
		$sidebar = 'none';
	}

	return $sidebar;
}
add_filter( 'maghoot_main_layout', 'maghoot_woo_main_layout' );


/**
 * Do not show meta info for Products or WooPages (Account, Cart, Checkout)
 *
 * @since 1.0
 * @access public
 * @param array $display
 * @param string $context
 */
if ( !function_exists('maghoot_woo_meta_info_blocks_display') ) {
function maghoot_woo_meta_info_blocks_display( $display, $context ) {
	if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() )
		$display = array();
	return $display;
}
}
add_filter( 'maghoot_meta_info_blocks_display', 'maghoot_woo_meta_info_blocks_display', 10, 2 );

/**
 * Hide title area on single product page
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'maghoot_hide_loop_meta_woo_product' ) ) :
function maghoot_hide_loop_meta_woo_product() {
	return ''; // return 'hide' to hide the title on single product pages
}
endif;