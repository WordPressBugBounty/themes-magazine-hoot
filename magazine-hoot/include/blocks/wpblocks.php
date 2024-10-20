<?php
/**
 * Blocks Setup
 * This file is loaded using 'after_setup_theme' hook at priority 10
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/* === WordPress Blocks === */


/** Add Gutenberg Wide Align support **/

add_theme_support( 'align-wide' );


/** Temporarily remove Gutenberg Widgets Screen **/

if ( apply_filters( 'maghoot_disable_widgets_block_editor', true ) ) {
	remove_theme_support( 'widgets-block-editor' );
}


/** Add slightly more opinionated styles for the front end **/

add_theme_support( 'wp-block-styles' );


/** Custom spacing option for blocks like cover and group **/

add_theme_support( 'custom-spacing' );


/** Add accent colors to Block Pallete - hook to init to have default vals for accent via maghoot_get_mod **/

if ( apply_filters( 'maghoot_editor_color_palette', true ) )
	add_action( 'init', 'maghoot_wpblock_color_palette' );
function maghoot_wpblock_color_palette(){
	$defaults = array(
		'#000000' => array( 'black',                 __( 'Black', 'magazine-hoot' ) ),
		'#abb8c3' => array( 'cyan-bluish-gray',      __( 'Cyan bluish gray', 'magazine-hoot' ) ),
		'#ffffff' => array( 'white',                 __( 'White', 'magazine-hoot' ) ),
		'#f78da7' => array( 'pale-pink',             __( 'Pale pink', 'magazine-hoot' ) ),
		'#cf2e2e' => array( 'vivid-red',             __( 'Vivid red', 'magazine-hoot' ) ),
		'#ff6900' => array( 'luminous-vivid-orange', __( 'Luminous vivid orange', 'magazine-hoot' ) ),
		'#fcb900' => array( 'luminous-vivid-amber',  __( 'Luminous vivid amber', 'magazine-hoot' ) ),
		'#7bdcb5' => array( 'light-green-cyan',      __( 'Light green cyan', 'magazine-hoot' ) ),
		'#00d084' => array( 'vivid-green-cyan',      __( 'Vivid green cyan', 'magazine-hoot' ) ),
		'#8ed1fc' => array( 'pale-cyan-blue',        __( 'Pale cyan blue', 'magazine-hoot' ) ),
		'#0693e3' => array( 'vivid-cyan-blue',       __( 'Vivid cyan blue', 'magazine-hoot' ) ),
		'#9b51e0' => array( 'vivid-purple',          __( 'Vivid purple', 'magazine-hoot' ) ),
	);
	$load = false;
	$palette = array();
	$accent = maghoot_get_mod( 'accent_color' );
		$load = true;
		$palette[] = array(
			'name' => __( 'Theme Accent Color', 'magazine-hoot' ),
			'slug' => 'accent',
			'color' => $accent
		);
	$accentfont = maghoot_get_mod( 'accent_font' );
		$load = true;
		$palette[] = array(
			'name' => __( 'Theme Accent Font Color', 'magazine-hoot' ),
			'slug' => 'accent-font',
			'color' => $accentfont
		);
	if ( $load ) {
		foreach ( $defaults as $key => $value )
			if ( $key != $accent && $key != $accentfont )
				$palette[] = array(
					'name' => $value[1],
					'slug' => $value[0],
					'color' => $key
				);
		add_theme_support( 'editor-color-palette', $palette );
	}
}


/** Add Stylesheets **/

// This is loaded in both Frontend and Backend (HBS loads @10)
// add_action( 'enqueue_block_assets', 'maghoot_wpblock_assets', 12 );

// Load after main stylesheet (and hootkit if available), but before child theme's stylesheet (and child hootkit)
add_action( 'wp_enqueue_scripts', 'maghoot_wpblock_assets', 16 );
function maghoot_wpblock_assets(){
	$style_uri = hybridextend_locate_style( 'include/blocks/wpblocks' );
	wp_enqueue_style( 'maghoot-wpblocks', $style_uri, array(), HYBRIDEXTEND_THEME_VERSION );
}

// Set dynamic css handle to maghoot-wpblocks
add_filter( 'hybridextend_style_builder_inline_style_handle', 'maghoot_dynamic_css_wpblock_handle', 4 );
function maghoot_dynamic_css_wpblock_handle(){ return 'maghoot-wpblocks'; }

// Editor stylesheet (HBS loads @10)
add_action( 'enqueue_block_editor_assets', 'maghoot_wpblock_editor_assets', 12 );
function maghoot_wpblock_editor_assets(){
	// This is loaded in only Backend...
	$style_uri = hybridextend_locate_style( 'include/blocks/wpblocks-editor' );
	wp_enqueue_style( 'maghoot-wpblocks-editor', $style_uri, array(), HYBRIDEXTEND_THEME_VERSION );

	$settings = array();
	$settings['accent_color']         = maghoot_get_mod( 'accent_color' );
	$settings['accent_font']          = maghoot_get_mod( 'accent_font' );
	extract( apply_filters( 'maghoot_custom_css_settings', $settings, 'blocks-editor' ) );
	$dynamic_css = '';
	$dynamic_css .= ':root .has-accent-color' . ',' . '.is-style-outline>.wp-block-button__link:not(.has-text-color), .wp-block-button__link.is-style-outline:not(.has-text-color)'
					. '{ color: ' . $accent_color . '; } ';
	$dynamic_css .= ':root .has-accent-background-color' . ',' . '.wp-block-button__link' . ',' . '.wp-block-search__button, .wp-block-file__button'
					. '{ background: ' . $accent_color . '; } ';
	$dynamic_css .= ':root .has-accent-font-color' . ',' . '.wp-block-button__link' . ',' . '.wp-block-search__button, .wp-block-file__button'
					. '{ color: ' . $accent_font . '; } ';
	$dynamic_css .= ':root .has-accent-font-background-color'
					. '{ background: ' . $accent_font . '; } ';
	wp_add_inline_style( 'maghoot-wpblocks-editor', $dynamic_css );
}


/** Add Dynamic CSS **/

add_action( 'hybridextend_dynamic_cssrules', 'maghoot_dynamic_wpblockcss', 8 );
function maghoot_dynamic_wpblockcss() {
	$settings = array();
	$settings['accent_color']         = maghoot_get_mod( 'accent_color' );
	$settings['accent_font']          = maghoot_get_mod( 'accent_font' );
	extract( apply_filters( 'maghoot_custom_css_settings', $settings, 'blocks' ) );

	hybridextend_add_css_rule( array(
						'selector'  => ':root .has-accent-color' . ',' . '.is-style-outline>.wp-block-button__link:not(.has-text-color), .wp-block-button__link.is-style-outline:not(.has-text-color)',
						'property'  => 'color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );
	hybridextend_add_css_rule( array(
						'selector'  => ':root .has-accent-background-color' . ',' . '.wp-block-button__link,.wp-block-button__link:hover' . ',' . '.wp-block-search__button,.wp-block-search__button:hover, .wp-block-file__button,.wp-block-file__button:hover',
						'property'  => 'background',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );
	hybridextend_add_css_rule( array(
						'selector'  => ':root .has-accent-font-color' . ',' . '.wp-block-button__link,.wp-block-button__link:hover' . ',' . '.wp-block-search__button,.wp-block-search__button:hover, .wp-block-file__button,.wp-block-file__button:hover',
						'property'  => 'color',
						'value'     => $accent_font,
						'idtag'     => 'accent_font',
					) );
	hybridextend_add_css_rule( array(
						'selector'  => ':root .has-accent-font-background-color',
						'property'  => 'background',
						'value'     => $accent_font,
						'idtag'     => 'accent_font',
					) );

}