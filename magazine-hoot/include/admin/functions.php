<?php
/**
 * Helper Functions
 */

/**
 * Set Theme About Page Tags
 * @access public
 * @return mixed
 */
function maghoot_abouttag( $index = 'slug' ) {
	static $tags;
	if ( empty( $tags ) ) {
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
		$tags = $is_official_child ? array() : array(
			'slug' => 'magazine-hoot',
			'name' => __( 'Magazine Hoot', 'magazine-hoot' ),
			'label' => __( 'Magazine Hoot Options', 'magazine-hoot' ),
			'vers' => HYBRIDEXTEND_THEME_VERSION,
			'shot' => ( file_exists( trailingslashit( HYBRID_PARENT ) . 'screenshot.jpg' ) ) ? trailingslashit( HYBRID_PARENT_URI ) . 'screenshot.jpg' : (
						( file_exists( trailingslashit( HYBRID_PARENT ) . 'screenshot.png' ) ) ? trailingslashit( HYBRID_PARENT_URI ) . 'screenshot.png' : ''
						),
			'fullshot' => ( file_exists( trailingslashit( HYBRIDEXTEND_INC ) . 'admin/images/screenshot.jpg' ) ) ? trailingslashit( HYBRIDEXTEND_INCURI ) . 'admin/images/screenshot.jpg' : (
				( file_exists( trailingslashit( HYBRIDEXTEND_INC ) . 'admin/images/screenshot.png' ) ) ? trailingslashit( HYBRIDEXTEND_INCURI ) . 'admin/images/screenshot.png' : ''
				)
		);
		$tags = apply_filters( 'maghoot_abouttags', $tags );
		if ( ! is_array( $tags ) ) $tags = array();
		if ( !empty( $tags['name'] ) ) $tags['name'] = esc_html( $tags['name'] );
		if ( !empty( $tags['slug'] ) ) $tags['slug'] = sanitize_html_class( $tags['slug'] );
		if ( !empty( $tags['vers'] ) ) $tags['vers'] = sanitize_text_field( $tags['vers'] );
		if ( !empty( $tags['shot'] ) ) $tags['shot'] = esc_url( $tags['shot'] );
		if ( !empty( $tags['fullshot'] ) ) $tags['fullshot'] = esc_url( $tags['fullshot'] );
		elseif ( !empty( $tags['shot'] ) ) $tags['fullshot'] = $tags['shot'];
	}
	return ( ( isset( $tags[ $index ] ) ) ? $tags[ $index ] : '' );
}