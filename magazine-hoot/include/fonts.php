<?php
/**
 * Functions for sending list of fonts available.
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/**
 * Build URL for loading Google Fonts
 * @credit http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 *
 * @since 1.0
 * @access public
 * @return void
 */
function maghoot_google_fonts_enqueue_url() {
	$fonts_url = '';
	$fonts = apply_filters( 'maghoot_google_fonts_preparearray', array() );
	$args = array();

	if ( !is_array( $fonts ) || empty( $fonts ) ):
 
		/* Translators: If there are characters in your language that are not
		* supported by this font, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$oswald = ( 'display' == maghoot_get_mod( 'logo_fontface' ) || 'display' == maghoot_get_mod( 'headings_fontface' ) ) ? _x( 'on', 'Oswald font: on or off', 'magazine-hoot' ) : 'off';
		$roboto = ( 'heading' == maghoot_get_mod( 'logo_fontface' ) || 'heading' == maghoot_get_mod( 'headings_fontface' ) ) ? _x( 'on', 'Roboto font: on or off', 'magazine-hoot' ) : 'off';

		/* Translators: If there are characters in your language that are not
		* supported by this font, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$open_sans = _x( 'on', 'Open Sans font: on or off', 'magazine-hoot' );

		if ( 'off' !== $oswald || 'off' !== $roboto || 'off' !== $open_sans ) {
			$font_families = array();

			if ( 'off' !== $roboto ) {
				$fonts[ 'Roboto' ] = array(
					'normal' => array( '400','500','700' ),
				);
			}

			if ( 'off' !== $oswald ) {
				$fonts[ 'Oswald' ] = array(
					'normal' => array( '400' ),
				);
			}

			if ( 'off' !== $open_sans ) {
				$fonts[ 'Open Sans' ] = array(
					'normal' => array( '300','400','500','600','700','800' ),
					'italic' => array( '400','700' ),
				);
			}

		}

	endif;
	$fonts = apply_filters( 'maghoot_google_fonts_array', $fonts );

	foreach ( $fonts as $key => $value ) {
		if ( is_array( $value ) && ( !empty( $value['normal'] ) || !empty( $value['italic'] ) ) && ( is_array( $value['normal'] ) || is_array( $value['italic'] ) ) ) {
			$arg = array( 'family' => $key . ':ital,wght@' );
			if ( !empty( $value['normal'] ) && is_array( $value['normal'] ) ) foreach ( $value['normal'] as $wght ) $arg['family'] .= "0,{$wght};";
			if ( !empty( $value['italic'] ) && is_array( $value['italic'] ) ) foreach ( $value['italic'] as $wght ) $arg['family'] .= "1,{$wght};";
			$arg['family'] = substr( $arg['family'], 0, -1 );
			$args[] = substr( add_query_arg( $arg, '' ), 1 );
		}
	}

	if ( !empty( $args ) ) {
		$fonts_url = 'https://fonts.googleapis.com/css2?' . implode( '&', $args ) . '&display=swap';
		if ( function_exists( 'maghoot_wptt_get_webfont_url' ) ) {
			if ( maghoot_get_mod( 'load_local_fonts' ) ) {
				$fonts_url = maghoot_wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
			} elseif( class_exists( 'Maghoot_WPTT_WebFont_Loader' ) ) {
				$font_possible_cleanup = new Maghoot_WPTT_WebFont_Loader( $fonts_url );
			}
		}
	}

	return $fonts_url;
}

/**
 * Modify the font (websafe) list
 * Font list should always have the form:
 * {css style} => {font name}
 *
 * @since 1.0
 * @access public
 * @return array
 */
function maghoot_theme_fonts_list( $fonts ) {
	// Add Open Sans (google font) to the available font list
	// Even though the list isn't currently used in customizer options,
	// this is still needed so that sanitization functions recognize the font.
	$fonts['"Open Sans", sans-serif'] = 'Open Sans';
	$fonts['"Roboto", sans-serif'] = 'Roboto';
	$fonts['"Oswald", sans-serif'] = 'Oswald';
	return $fonts;
}
add_filter( 'hybridextend_fonts_list', 'maghoot_theme_fonts_list' );