<?php
/**
 * Theme Setup
 * This file is loaded using 'after_setup_theme' hook at priority 10
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/** Misc **/

// Enable Font Icons
// Disable this (remove this line) if the theme doesnt use font icons,
// or if the font-awesome library is being enqueued by some other plugin using
// a handle other than 'font-awesome' or 'fontawesome' (to avoid loading the
// library twice)
if ( apply_filters( 'maghoot_load_font_awesome', true ) )
	add_theme_support( 'font-awesome' );

// Enable google fonts (fixed fonts, or entire library)
add_theme_support( 'maghoot-google-fonts' );


/** WordPress **/

// Add theme support for WordPress Custom Logo
add_theme_support( 'custom-logo' );

// Adds theme support for WordPress 'featured images'.
add_theme_support( 'post-thumbnails' );

// Automatically add feed links to <head>.
add_theme_support( 'automatic-feed-links' );


/** WordPress Jetpack **/

add_theme_support( 'infinite-scroll', array(
	'type' => apply_filters( 'maghoot_theme_jetpack_infinitescroll_type', 'click' ), // scroll or click
	'container' => apply_filters( 'maghoot_theme_jetpack_infinitescroll_container', 'content-wrap' ),
	'footer' => false,
	'wrapper' => true,
	'render' => apply_filters( 'maghoot_theme_jetpack_infinitescroll_render', 'maghoot_jetpack_infinitescroll_render' ),
) );
add_filter( 'jetpack_lazy_images_blacklisted_classes', 'maghoot_theme_jetpack_lazy_load_exclude' ); // deprecated
add_filter( 'jetpack_lazy_images_blocked_classes', 'maghoot_theme_jetpack_lazy_load_exclude' );
function maghoot_theme_jetpack_lazy_load_exclude( $classes ) {
	if ( !is_array( $classes ) ) $classes = array();
	$classes[] = 'hootslider-html-slide-img';
	$classes[] = 'hootslider-html-slide-image';
	$classes[] = 'hootslider-image-slide-img';
	$classes[] = 'hootslider-carousel-slide-img';
	return $classes;
}


/** Extensions **/

// Enable custom widgets
add_theme_support( 'hybridextend-widgets' );

// Bug fix for transition on empty ids
// (no need to apply filter 'hybridextend_load_widgets' for adding HYBRIDEXTEND_PREMIUM_INC . 'admin/widget-*.php' to the locations)
foreach ( glob( HYBRIDEXTEND_INC . 'admin/widget-*.php' ) as $filename ) {
	add_filter( 'maghoot_' . str_replace( '-', '_', str_replace( 'widget-', '', basename( $filename, '.php' ) ) ) . '_widget_settings', 'maghoot_filter_wdgid' );
}
function maghoot_filter_wdgid( $id ) {
	if ( isset ( $id['id'] ) && isset( $id['form_options'] ) ) {
		$id['id'] = str_replace( 'maghoot-', 'hoot' . '-', $id['id'] );
		foreach ( $id['form_options'] as $key => $fields ) {
			if ( isset( $fields['id'] ) && $fields['id'] == 'customcss' ) {
				foreach ( $fields['fields'] as $subkey => $field ) {
					if ( isset( $field['id'] ) && $field['id'] == 'widgetid' ) {
						$id['form_options'][$key]['fields'][$subkey]['type'] = str_replace( 'maghoot-', 'hoot' . '-', $field['type'] );
	}	}	}	}	}
	return $id;
}
add_filter( 'hybridextend_custom_image_sizes', 'maghoot_filter_imgid', 99 );
function maghoot_filter_imgid( $cimg ) {
	if ( is_array( $cimg ) ) {
		$cim = array();
		foreach ( $cimg as $key => $value ) {
			$id = str_replace( 'maghoot-', 'hoot' . '-', $key );
			$cim[ $id ] = $value;
		}
		$cimg = $cim;
	}
	return $cimg;
}

// Nicer [gallery] shortcode implementation when Jetpack tiled-gallery is not active
if ( !class_exists( 'Jetpack' ) || !Jetpack::is_module_active( 'tiled-gallery' ) ) 
	add_theme_support( 'cleaner-gallery' );


/** WooCommerce **/

// Woocommerce support and init load theme woo functions
if ( class_exists( 'WooCommerce' ) ) {
	add_theme_support( 'woocommerce' );
	include_once( HYBRID_PARENT . 'woocommerce/functions.php' );
}


/** Hoot Import plugin **/

// theme config
if ( ! function_exists( 'maghoot_hootimport_theme_config' ) ) {
	function maghoot_hootimport_theme_config( $config ) {
		$child = defined( 'HYBRIDEXTEND_CHILDTHEME_NAME' ) ? HYBRIDEXTEND_CHILDTHEME_NAME : '';
		$is_official_child = false;
		if ( $child ) {
			$checks = apply_filters( 'maghoot_hootimport_theme_config_childtheme_array', array() );
			foreach ( $checks as $check ) {
				if ( stripos( $child, $check ) !== false ) {
					$is_official_child = true;
					break;
				}
			}
		}
		return ( $is_official_child ) ? $config : array_merge( $config, array(
			'id' => 'magazine-hoot', // *required // used for parent and unofficial child themes
			'menu_title' => __( 'Import Magazine Hoot Demo', 'magazine-hoot' ),
			'theme_name' => HYBRIDEXTEND_THEME_NAME,
			'theme_version' => HYBRIDEXTEND_THEME_VERSION,
			'theme_img' => function_exists( 'maghoot_abouttag' ) ? (  maghoot_abouttag( 'fullshot' ) !==  maghoot_abouttag( 'shot' ) ?  maghoot_abouttag( 'fullshot' ) : '' ) : '',
		) );
	}
}
add_filter( 'hootimport_theme_config', 'maghoot_hootimport_theme_config', 5 );


/* === Tribe The Events Calendar Plugin === */

// Load support if plugin active
if ( class_exists( 'Tribe__Events__Main' ) ) {

	// Hook into 'wp' to use conditional hooks
	add_action( 'wp', 'maghoot_tribeevent', 10 );

	// Add hooks based on view
	// @since 1.7.3
	function maghoot_tribeevent() {
		if ( is_post_type_archive( 'tribe_events' ) || ( function_exists( 'tribe_is_events_home' ) && tribe_is_events_home() ) ) {
			add_action( 'maghoot_display_loop_meta', 'maghoot_tribeevent_loopmeta', 5 );
		}
		if ( is_singular( 'tribe_events' ) ) {
			add_action( 'maghoot_display_loop_meta', 'maghoot_tribeevent_loopmeta_single', 5 );
		}
	}

	// Modify theme options and displays
	// @since 1.7.3
	function maghoot_tribeevent_loopmeta( $display ) { return false; }
	function maghoot_tribeevent_loopmeta_single( $display ) {
		the_post(); rewind_posts(); // Bug Fix
		return false;
	}

}


/* === AMP Plugin ===
 * @ref https://wordpress.org/plugins/amp/
 * @ref https://www.hostinger.in/tutorials/wordpress-amp/
 * @ref https://validator.ampproject.org/
 * @ref https://amp.dev/documentation/guides-and-tutorials/learn/validation-workflow/validation_errors/
 * @credit https://amp-wp.org/documentation/developing-wordpress-amp-sites/how-to-develop-with-the-amp-plugin/
 * @credit https://amp-wp.org/documentation/how-the-plugin-works/amp-plugin-serving-strategies/
*/
// Call 'is_amp_endpoint' after 'parse_query' hook
add_action( 'wp', 'hoottheme_amp', 5 );
function hoottheme_amp(){
	if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
		add_action( 'wp_enqueue_scripts', 'hoottheme_amp_remove_scripts', 999 );
		add_filter( 'hybrid_attr_body', 'hoottheme_amp_attr_body' );
		add_filter( 'theme_mod_mobile_submenu_click', 'hoottheme_amp_emptymod' );
		// add_filter( 'theme_mod_custom_js', 'hoottheme_amp_emptymod' );
	}
}
function hoottheme_amp_remove_scripts(){
	$dequeue = array_map( 'wp_dequeue_script', array(
		'comment-reply', 'jquery', 'maghoot-modernizr', 'hoverIntent', 'jquery-superfish', 'jquery-lightSlider', 'jquery-fitvids', 'jquery-parallax',
		'maghoot', 'maghoot-theme-premium',
		'lightGallery', 'isotope', 'jquery.circliful',
		'waypoints', 'waypoints-sticky', 'hybridextend-scrollpoints', 'hybridextend-scroller',
	) );
}
function hoottheme_amp_attr_body( $attr ) {
	$attr['class'] = ( empty( $attr['class'] ) ) ? ' hootamp' : $attr['class'] . ' hootamp';
	return $attr;
}
function hoottheme_amp_emptymod(){
	return 0;
}


/** Conditional Theme Setup */

/* Theme setup on the 'wp' hook. Only used for special scenarios (like enqueueing scripts/styles) based on conditional tags. */
add_action( 'wp', 'maghoot_load_wt_lightslider', 10 );

/**
 * Load lightslider (scripts/styles) on frontpage
 *
 * @since 1.0
 * @access public
 * @return void
 */
function maghoot_load_wt_lightslider() {
	if ( is_front_page() ) {
		add_theme_support( 'maghoot-light-slider' );
	}
}


/** Theme Setup Hooks */

/* Handle content width for embeds and images. Hooked into 'init' so that we can pull custom content width from theme options */
add_action( 'init', 'maghoot_set_content_width', 10 );

/**
 * Handle content width for embeds and images.
 *
 * @since 1.0
 * @access public
 * @return void
 */
function maghoot_set_content_width() {
	$width = intval( maghoot_get_mod( 'site_width' ) );
	$width = !empty( $width ) ? $width : 1260;
	hybrid_set_content_width( $width );
}

/* Modify the '[...]' Read More Text */
add_filter( 'the_content_more_link', 'maghoot_modify_read_more_link' );
if ( apply_filters( 'maghoot_force_excerpt_readmore', true ) ) {
	add_filter( 'excerpt_more', 'maghoot_insert_excerpt_readmore_quicktag', 11 );
	add_filter( 'wp_trim_excerpt', 'maghoot_replace_excerpt_readmore_quicktag', 11, 2 );
} else {
	add_filter( 'excerpt_more', 'maghoot_modify_read_more_link' );
}

/**
 * Modify the '[...]' Read More Text
 *
 * @since 1.0
 * @access public
 * @return string
 */
function maghoot_modify_read_more_link( $more = '[&hellip;]' ) {
	if ( is_admin() )
		return $more;
	elseif ( is_feed() )
		return apply_filters( 'maghoot_rssreadmoretext', '' );

	$read_more = esc_html( maghoot_get_mod('read_more') );
	$read_more = ( empty( $read_more ) ) ? sprintf( __( 'Read More %s', 'magazine-hoot' ), '&rarr;' ) : $read_more;
	global $post;
	$read_more = '<span class="more-link"><a href="' . esc_url( get_permalink( $post->ID ) ) . '">' . $read_more . '</a></span>';
	return apply_filters( 'maghoot_readmore', $read_more ) ;
}

/**
 * Always display the 'Read More' link in Excerpts.
 * Insert quicktag to be replaced later in 'wp_trim_excerpt()'
 *
 * @since 1.0
 * @access public
 * @return string
 */
function maghoot_insert_excerpt_readmore_quicktag( $more = '' ) {
	if ( is_admin() )
		return $more;
	return '<!--maghoot-read-more-quicktag-->';
}

/**
 * Always display the 'Read More' link in Excerpts.
 * Replace quicktag with read more link
 *
 * @since 1.0
 * @access public
 * @return string
 */
function maghoot_replace_excerpt_readmore_quicktag( $text, $raw_excerpt ) {
	if ( is_admin() )
		return $text;
	$read_more = maghoot_modify_read_more_link();
	$text = str_replace( '<!--maghoot-read-more-quicktag-->', '', $text );
	return $text . $read_more;
}

/* Modify the exceprt length. Make sure to set the priority correctly such as 999, else the default WordPress filter on this function will run last and override settng here.  */
add_filter( 'excerpt_length', 'maghoot_custom_excerpt_length', 999 );

/**
 * Modify the exceprt length.
 *
 * @since 1.0
 * @access public
 * @return void
 */
function maghoot_custom_excerpt_length( $length ) {
	if ( is_admin() )
		return $length;

	$excerpt_length = intval( maghoot_get_mod('excerpt_length') );
	if ( !empty( $excerpt_length ) )
		return $excerpt_length;
	return 50;
}