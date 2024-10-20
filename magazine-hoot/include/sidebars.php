<?php
/**
 * Register sidebar widget areas for the theme
 * This file is loaded via the 'after_setup_theme' hook at priority '10'
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/* Register sidebars. */
add_action( 'widgets_init', 'maghoot_base_register_sidebars', 5 );
add_action( 'widgets_init', 'maghoot_frontpage_register_sidebars' );

/**
 * Registers sidebars.
 *
 * @since 1.0
 * @access public
 * @return void
 */
function maghoot_base_register_sidebars() {

	global $wp_version;
		if ( version_compare( $wp_version, '4.9.7', '>=' ) ) {
			$emstart = '<strong><em>'; $emend = '</strong></em>';
		} else $emstart = $emend = '';

	// Primary Sidebar
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-primary-sidebar',
			'name'         => _x( 'Primary Sidebar', 'sidebar', 'magazine-hoot' ),
			'description'  => __( 'The main sidebar used throughout the site.', 'magazine-hoot' ),
			'before_title' => '<h3 class="widget-title"><span class="accent-typo">',
			'after_title'  => '</span></h3>',
		)
	);

	// Secondary Sidebar
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-secondary-sidebar',
			'name'         => _x( 'Secondary Sidebar', 'sidebar', 'magazine-hoot' ),
			'description'  => __( 'The secondary sidebar used throughout the site (if you are using a 3 column layout with 2 sidebars).', 'magazine-hoot' ),
			'before_title' => '<h3 class="widget-title"><span class="accent-typo">',
			'after_title'  => '</span></h3>',
		)
	);

	// Topbar Left Widget Area
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-topbar-left',
			'name'         => _x( 'Topbar Left', 'sidebar', 'magazine-hoot' ),
			'description'  => __( 'Leave empty if you dont want to show topbar.', 'magazine-hoot' ),
			'before_title' => '<h3 class="widget-title"><span class="accent-typo">',
			'after_title'  => '</span></h3>',
		)
	);

	// Topbar Right Widget Area
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-topbar-right',
			'name'         => _x( 'Topbar Right', 'sidebar', 'magazine-hoot' ),
			'description'  => __( 'Leave empty if you dont want to show topbar.', 'magazine-hoot' ),
			'before_title' => '<h3 class="widget-title"><span class="accent-typo">',
			'after_title'  => '</span></h3>',
		)
	);

	// Header Side Widget Area
	$extramsg = ( maghoot_get_mod( 'primary_menuarea' ) == 'widget-area' ) ? '' : ' ' . $emstart . __( "This widget area is currently NOT VISIBLE on your site. To activate it, go to Appearance &gt; Customize &gt; Header &gt; 'Header Area' option &gt; Select 'Header Side Widget Area'", 'magazine-hoot' ) . $emend;
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-header',
			'name'         => _x( 'Header Side', 'sidebar', 'magazine-hoot' ),
			'description'  => __( 'Appears in Header on right of logo', 'magazine-hoot' ) . $extramsg,
			'before_title' => '<h3 class="widget-title"><span class="accent-typo">',
			'after_title'  => '</span></h3>',
		)
	);

	// Menu Side Widget Area
	$extramsg = ( maghoot_get_mod( 'secondary_menu_location' ) != 'none' ) ? '' : ' ' . $emstart . __( "This widget area is currently NOT VISIBLE on your site. To activate it, go to Appearance &gt; Customize &gt; Header &gt; 'Full Width Menu' option &gt; Select 'Top' or 'Bottom'", 'magazine-hoot' ) . $emend;
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-menu-side',
			'name'         => _x( 'Full Width Menu - Side', 'sidebar', 'magazine-hoot' ),
			'description'  => __( 'This is the tiny area next to menu (often used for displaying search, social icons or breadcrumbs)', 'magazine-hoot' ) . $extramsg,
			'before_title' => '<h3 class="widget-title"><span class="accent-typo">',
			'after_title'  => '</span></h3>',
		)
	);

	// Below Header Widget Area
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-below-header',
			'name'         => _x( 'Below Header', 'sidebar', 'magazine-hoot' ),
			'description'  => __( 'This area is often used for displaying context specific menus, advertisements, and third party breadcrumb plugins.', 'magazine-hoot' ),
			'before_title' => '<h3 class="widget-title"><span class="accent-typo">',
			'after_title'  => '</span></h3>',
		)
	);

	// Subfooter Widget Area
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-sub-footer',
			'name'         => _x( 'Sub Footer', 'sidebar', 'magazine-hoot' ),
			'description'  => __( 'Leave empty if you dont want to show subfooter.', 'magazine-hoot' ),
			'before_title' => '<h3 class="widget-title"><span class="accent-typo">',
			'after_title'  => '</span></h3>',
		)
	);

	// Footer Columns
	$footercols = maghoot_get_footer_columns();

	if( $footercols ) :
		$alphas = range('a', 'z');
		for ( $i=0; $i < 4; $i++ ) :
			if ( isset( $alphas[ $i ] ) ) :
				hybrid_register_sidebar(
					array(
						'id'           => 'hoot-footer-' . $alphas[ $i ],
						'name'         => sprintf( _x( 'Footer %s Column', 'sidebar', 'magazine-hoot' ), strtoupper( $alphas[ $i ] ) ),
						'description'  => ( $i < $footercols ) ? '' : ' ' . $emstart . sprintf( __( 'This column is currently NOT VISIBLE on your site. To activate it, go to Appearance &gt; Customize &gt; Footer &gt; Select a layout with more than %1$s columns', 'magazine-hoot' ), $i ) . $emend,
						'before_title' => '<h3 class="widget-title"><span class="accent-typo">',
						'after_title'  => '</span></h3>',
					)
				);
			endif;
		endfor;
	endif;

}

/**
 * Registers frontpage widget areas.
 *
 * @since 1.0
 * @access public
 * @return void
 */
function maghoot_frontpage_register_sidebars() {

	$areas = array();
	global $wp_version;
	if ( version_compare( $wp_version, '4.9.7', '>=' ) ) {
		$emstart = '<strong><em>'; $emend = '</strong></em>';
	} else $emstart = $emend = '';

	/* Set up defaults */
	$defaults = apply_filters( 'maghoot_frontpage_widget_areas', array( 'a', 'b', 'c', 'd', 'e', 'f' ) );
	$locations = apply_filters( 'maghoot_frontpage_widget_area_names', array(
		__( 'Left', 'magazine-hoot' ),
		__( 'Center Left', 'magazine-hoot' ),
		__( 'Center', 'magazine-hoot' ),
		__( 'Center Right', 'magazine-hoot' ),
		__( 'Right', 'magazine-hoot' ),
	) );

	// Get user settings
	$sections = hybridextend_sortlist( maghoot_get_mod( 'frontpage_sections' ) );

	foreach ( $defaults as $key ) {
		$id = "area_{$key}";
		if ( empty( $sections[$id]['sortitem_hide'] ) ) {

			$columns = ( isset( $sections[$id]['columns'] ) ) ? $sections[$id]['columns'] : '';
			$count = count( explode( '-', $columns ) ); // empty $columns still returns array of length 1
			$location = '';

			for ( $c = 1; $c <= $count ; $c++ ) {
				switch ( $count ) {
					case 2: $location = ($c == 1) ? $locations[0] : $locations[4];
							break;
					case 3: $location = ($c == 1) ? $locations[0] : (
								($c == 2) ? $locations[2] : $locations[4]
							);
							break;
					case 4: $location = ($c == 1) ? $locations[0] : (
								($c == 2) ? $locations[1] : (
									($c == 3) ? $locations[3] : $locations[4]
								)
							);
				}
				$areas[ $id . '_' . $c ] = sprintf( __( 'Frontpage - Widget Area %1$s %2$s', 'magazine-hoot' ), strtoupper( $key ), $location );
			}

		}
	}

	foreach ( $areas as $key => $name ) {
		hybrid_register_sidebar(
			array(
				'id'           => 'hoot-frontpage-' . $key,
				'name'         => $name,
				'description'  => __( 'You can reorder and change the number of columns in Appearance &gt; Customize &gt; Frontpage Modules', 'magazine-hoot' ),
				'before_title' => '<h3 class="widget-title"><span class="accent-typo">',
				'after_title'  => '</span></h3>',
			)
		);
	}

}