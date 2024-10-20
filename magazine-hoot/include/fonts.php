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
	$query_args = apply_filters( 'maghoot_google_fonts_enqueue_url_args', array() );

	/** If no google font loaded, load the default ones **/
	if ( !is_array( $query_args ) || empty( $query_args ) ):
 
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
				$font_families[] = 'Roboto:400,500,700';
			}

			if ( 'off' !== $oswald ) {
				$font_families[] = 'Oswald:400';
			}

			if ( 'off' !== $open_sans ) {
				$font_families[] = 'Open+Sans:300,400,400i,500,600,700,700i,800';
			}

			if ( !empty( $font_families ) )
				$query_args = array(
					'family' => urlencode( implode( '|', $font_families ) ),
					//'subset' => urlencode( 'latin,latin-ext' ),
					'subset' => urlencode( 'latin' ),
				);

			$query_args = apply_filters( 'maghoot_google_fonts_query_args', $query_args, $font_families );

		}

	endif;

	if ( !empty( $query_args ) && !empty( $query_args['family'] ) )
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

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