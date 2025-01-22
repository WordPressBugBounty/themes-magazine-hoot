<?php
/**
 * Add custom css to frontend.
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/* Add CSS built from options to the dynamic CSS array */
add_action( 'hybridextend_dynamic_cssrules', 'maghoot_dynamic_cssrules', 2 );

/**
 * Custom CSS built from user theme options
 * For proper sanitization, always use functions from hoot/includes/sanitization.php
 * and hoot/customizer/sanitization.php
 *
 * @since 1.0
 * @access public
 */
function maghoot_dynamic_cssrules() {

	/*** Settings Values ***/

	/* Lite Settings */

	$settings = array();
	$settings['grid_width']           = intval( maghoot_get_mod( 'site_width' ) ) . 'px';
	$settings['accent_color']         = maghoot_get_mod( 'accent_color' );
	$settings['accent_color_dark']    = hybridext_color_decrease( $settings['accent_color'], 25, 25 );
	$settings['accent_font']          = maghoot_get_mod( 'accent_font' );
	$settings['logo_fontface']        = maghoot_get_mod( 'logo_fontface' );
	$settings['logo_fontface_style']  = maghoot_get_mod( 'logo_fontface_style' );
	$settings['headings_fontface']    = maghoot_get_mod( 'headings_fontface' );
	$settings['headings_fontface_style'] = maghoot_get_mod( 'headings_fontface_style' );
	// $settings['site_layout']          = maghoot_get_mod( 'site_layout' );
	// $settings['background_color']     = maghoot_get_mod( 'background-color' );
	$settings['box_background_color'] = maghoot_get_mod( 'box_background_color' );
	$settings['content_bg_color']     = $settings['box_background_color'];
	$settings['site_title_icon_size'] = maghoot_get_mod( 'site_title_icon_size' );
	$settings['logo_image_width']     = maghoot_get_mod( 'logo_image_width' );
	$settings['logo_image_width']     = ( intval( $settings['logo_image_width'] ) ) ?
	                                        intval( $settings['logo_image_width'] ) . 'px' :
	                                        '150px';
	$settings['logo']                 = maghoot_get_mod( 'logo' );
	$settings['logo_custom']          = apply_filters( 'maghoot_logo_custom_text', hybridextend_sortlist( maghoot_get_mod( 'logo_custom' ) ) );
	$categories = get_categories( array( 'orderby' => 'name', 'order' => 'ASC' ) );
	foreach( $categories as $category ) {
		$settings['cat_color' . $category->term_id] = maghoot_get_mod( 'cat_colors-highlight' . $category->term_id );
		$settings['cat_font' . $category->term_id]  = maghoot_get_mod( 'cat_colors-font' . $category->term_id );
	}
	$menuitems = maghoot_nav_menu_toplevel_items('hoot-secondary');
	foreach( $menuitems as $key => $menuitem ) {
		$settings['menuitem_color' . ($key+1)] = maghoot_get_mod( 'menuitem_colors-highlight' . ($key+1) );
	}

	// Troubleshooting
	// echo '<!-- '; print_r($settings); echo ' -->';

	extract( apply_filters( 'maghoot_custom_css_settings', $settings, 'lite' ) );

	/*** Add Dynamic CSS ***/

	/* Hoot Grid */

	hybridextend_add_css_rule( array(
						'selector'  => '.hgrid',
						'property'  => 'max-width',
						'value'     => $grid_width,
						'idtag'     => 'grid_width',
					) );

	/* Base Typography and HTML */

	hybridextend_add_css_rule( array(
						'selector'  => 'a' . ',' . '.widget .view-all a:hover',
						'property'  => 'color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );

	hybridextend_add_css_rule( array(
						'selector'  => 'a:hover',
						'property'  => 'color',
						'value'     => $accent_color_dark,
					) );

	hybridextend_add_css_rule( array(
						'selector'  => '.accent-typo' . ',' . '.cat-label',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( $accent_color, 'accent_color' ),
							'color'      => array( $accent_font, 'accent_font' ),
							),
					) );
	foreach( $categories as $category ) {
	hybridextend_add_css_rule( array(
						'selector'  => '.cat-typo-' . $category->term_id,
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background'   => array( $settings['cat_color' . $category->term_id], 'cat_colors-highlight' . $category->term_id ),
							'color'        => array( $settings['cat_font' . $category->term_id], 'cat_colors-font' . $category->term_id ),
							'border-color' => array( $settings['cat_color' . $category->term_id], 'cat_colors-highlight' . $category->term_id ),
							),
					) );
	}

	hybridextend_add_css_rule( array(
						'selector'  => '.invert-typo',
						'property'  => 'color',
						'value'     => $content_bg_color,
					) );

	hybridextend_add_css_rule( array(
						'selector'  => '.enforce-typo',
						'property'  => 'background',
						'value'     => $content_bg_color,
					) );

	hybridextend_add_css_rule( array(
						'selector'  => 'body.wordpress input[type="submit"], body.wordpress #submit, body.wordpress .button' . ',' . '.wc-block-components-button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( $accent_color, 'accent_color' ),
							'color'      => array( $accent_font, 'accent_font' ),
							),
					) );

	hybridextend_add_css_rule( array(
						'selector'  => 'body.wordpress input[type="submit"]:hover, body.wordpress #submit:hover, body.wordpress .button:hover, body.wordpress input[type="submit"]:focus, body.wordpress #submit:focus, body.wordpress .button:focus' . ',' . '.wc-block-components-button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( $accent_color_dark ),
							'color'      => array( $accent_font, 'accent_font' ),
							),
					) );

	$headingproperty = array();
	if ( 'standard' == $headings_fontface )
		$headingproperty['font-family'] = array( '"Open Sans", sans-serif' );
	elseif ( 'display' == $headings_fontface )
		$headingproperty['font-family'] = array( '"Oswald", sans-serif' );
	if ( 'uppercase' == $headings_fontface_style )
		$headingproperty['text-transform'] = array( 'uppercase' );
	else
		$headingproperty['text-transform'] = array( 'none' );
	if ( !empty( $headingproperty ) ) {
		hybridextend_add_css_rule( array(
						'selector'  => 'h1, h2, h3, h4, h5, h6, .title, .titlefont',
						'property'  => $headingproperty,
					) );
	}

	/* Layout */

	hybridextend_add_css_rule( array(
						'selector'  => 'body',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background'   => array( '', 'background' ),
							'border-color' => array( $accent_color, 'accent_color' ),
							),
					) );

	// if ( $site_layout == 'boxed' ) {
		hybridextend_add_css_rule( array(
						'selector'  => '#topbar, #main.main, #header-supplementary' . ',' . '.sub-footer',
						'property'  => 'background',
						'value'     => $box_background_color,
						'idtag'     => 'box_background_color',
					) );
	// }

	/* Header (Topbar, Header, Main Nav Menu) */
	// Topbar

	// hybridextend_add_css_rule( array(
	// 					'selector'  => '.topbar-right-inner',
	// 					'property'  => 'background',
	// 					'value'     => $content_bg_color,
	// 				) );

	/* Header (Topbar, Header, Main Nav Menu) */
	// Text Logo

	$logoproperty = array();
	if ( 'standard' == $logo_fontface )
		$logoproperty['font-family'] = array( '"Open Sans", sans-serif' );
	elseif ( 'heading' == $logo_fontface )
		$logoproperty['font-family'] = array( '"Roboto", sans-serif' );
	if ( 'uppercase' == $logo_fontface_style )
		$logoproperty['text-transform'] = array( 'uppercase' );
	else
		$logoproperty['text-transform'] = array( 'none' );
	if ( !empty( $logoproperty ) ) {
		hybridextend_add_css_rule( array(
						'selector'  => '#site-title',
						'property'  => $logoproperty,
					) );
	}

	/* Header (Topbar, Header, Main Nav Menu) */
	// Logo (with icon)

	if ( intval( $site_title_icon_size ) ) {
		hybridextend_add_css_rule( array(
						'selector'  => '.site-logo-with-icon #site-title i',
						'property'  => 'font-size',
						'value'     => $site_title_icon_size,
						'idtag'     => 'site_title_icon_size',
					) );
	}

	/* Header (Topbar, Header, Main Nav Menu) */
	// Mixed/Mixedcustom Logo (with image)

	if ( !empty( $logo_image_width ) ) :
	hybridextend_add_css_rule( array(
						'selector'  => '.site-logo-mixed-image img',
						'property'  => 'max-width',
						'value'     => $logo_image_width,
						'idtag'     => 'logo_image_width',
					) );
	endif;

	/* Header (Topbar, Header, Main Nav Menu) */
	// Custom Logo

	if ( 'custom' == $logo || 'mixedcustom' == $logo ) {
		if ( is_array( $logo_custom ) && !empty( $logo_custom ) ) {
			$lcount = 1;
			foreach ( $logo_custom as $logo_custom_line ) {
				if ( !$logo_custom_line['sortitem_hide'] && !empty( $logo_custom_line['size'] ) ) {
					hybridextend_add_css_rule( array(
						'selector'  => '#site-logo-custom .site-title-line' . $lcount . ',#site-logo-mixedcustom .site-title-line' . $lcount,
						'property'  => 'font-size',
						'value'     => $logo_custom_line['size'],
					) );
				}
				$lcount++;
			}
		}
	}

	hybridextend_add_css_rule( array(
						'selector'  => '.site-title-line b, .site-title-line em, .site-title-line strong',
						'property'  => 'color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );

	/* Header (Topbar, Header, Main Nav Menu) */
	// Nav Menu

	hybridextend_add_css_rule( array(
						// 'selector'  => '.menu-items > li.current-menu-item:not(.nohighlight), .menu-items > li:hover' . ',' . '.sf-menu ul li:hover > a',
						'selector'  => '.menu-items > li.current-menu-item:not(.nohighlight) > a, .menu-items > li.current-menu-ancestor > a, .menu-items > li:hover > a' . ',' . '.sf-menu ul li:hover > a, .sf-menu ul li.current-menu-ancestor > a, .sf-menu ul li.current-menu-item:not(.nohighlight) > a',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							// 'background' => array( $accent_font, 'accent_font' ),
							'color'      => array( $accent_color, 'accent_color' ),
							),
					) );

	foreach( $menuitems as $key => $menuitem ) {
	hybridextend_add_css_rule( array(
						'selector'  => '.menu-highlight > li:nth-of-type(' . ($key+1) . ')', // use nth-of-type instead of nth-child #8993
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'color'   => array( $settings['menuitem_color' . ($key+1)], 'menuitem_colors-highlight' . ($key+1) ),
							'border-color' => array( $settings['menuitem_color' . ($key+1)], 'menuitem_colors-highlight' . ($key+1) ),
							),
					) );
	}

	/* Main #Content */

	hybridextend_add_css_rule( array(
						'selector'  => '.entry-footer .entry-byline',
						'property'  => 'color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );

	/* Main #Content for Index (Archive / Blog List) */

	hybridextend_add_css_rule( array(
						'selector'  => '.more-link',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'border-color' => array( $accent_color, 'accent_color' ),
							'color'        => array( $accent_color, 'accent_color' ),
							),
					) );

	hybridextend_add_css_rule( array(
						'selector'  => '.more-link a',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( $accent_color, 'accent_color' ),
							'color'      => array( $accent_font, 'accent_font' ),
							),
					) );

	hybridextend_add_css_rule( array(
						'selector'  => '.more-link a:hover',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( $accent_color_dark, 'accent_color_dark' ),
							'color'      => array( $accent_font, 'accent_font' ),
							),
					) );

	/* Light Slider */

	hybridextend_add_css_rule( array(
						'selector'  => '.lSSlideOuter .lSPager.lSpg > li:hover a, .lSSlideOuter .lSPager.lSpg > li.active a',
						'property'  => 'background-color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );

	/* Frontpage */

	hybridextend_add_css_rule( array(
						'selector'  => '.frontpage-area.module-bg-accent',
						'property'  => 'background-color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );

	// Set as inline CSS
	// foreach ( $wtmodule_bg as $wtmname ) {
	// 	if ( $wtm_sectionbg[ $wtmname . '_type'] == 'image' && !empty( $wtm_sectionbg[ $wtmname . '_image'] ) && empty( $wtm_sectionbg[ $wtmname . '_parallax'] ) ) {
	// 		hybridextend_add_css_rule( array(
	// 					'selector'  => "#frontpage-{$wtmname}",
	// 					'property'  => 'background-image',
	// 					'value'     => $wtm_sectionbg[ $wtmname . '_image'],
	// 					'idtag'     => "frontpage_sectionbg_{$wtmname}-image",
	// 				) );
	// 	}
	// }

	/* Sidebars and Widgets */

	if ( 'standard' != $headings_fontface_style ) {
		$widget_title_style = ( 'normal' == $headings_fontface_style ) ? 'inherit' : 'uppercase';
		hybridextend_add_css_rule( array(
						'selector'  => '#site-description' . ',' . '.menu-items > li > a' . ',' . '.widget-title' . ',' . '.post-gridunit-title' . ',' . '.sub-footer .widget-title, .footer .widget-title' . ',' . '#content .loop-title',
						'property'  => 'text-transform',
						'value'     => $widget_title_style,
					) );
	}

	hybridextend_add_css_rule( array(
						'selector'  => '.widget-title > span.accent-typo',
						'property'  => 'border-color',
						'value'     => $accent_color,
						'idtag'     => 'accent_color',
					) );

	hybridextend_add_css_rule( array(
						'selector'  => '.content-block-style3 .content-block-icon',
						'property'  => 'background',
						'value'     => $content_bg_color,
					) );

	hybridextend_add_css_rule( array(
						'selector' => '.content-block-icon i',
						'property' => 'color',
						'value'    => $accent_color,
						'idtag'    => 'accent_color',
					) );

	hybridextend_add_css_rule( array(
						'selector' => '.icon-style-circle, .icon-style-square',
						'property' => 'border-color',
						'value'    => $accent_color,
						'idtag'    => 'accent_color',
					) );

	hybridextend_add_css_rule( array(
						'selector' => '.content-block-column .more-link a',
						'property' => 'color',
						'value'    => $accent_color,
						'idtag'    => 'accent_color',
					) );

	hybridextend_add_css_rule( array(
						'selector' => '.content-block-column .more-link a:hover',
						'property' => 'color',
						'value'    => $accent_font,
						'idtag'    => 'accent_font',
					) );

	/* Plugins */

	hybridextend_add_css_rule( array(
						'selector'  => '#infinite-handle span' . ',' . '.lrm-form a.button, .lrm-form button, .lrm-form button[type=submit], .lrm-form #buddypress input[type=submit], .lrm-form input[type=submit]',
						'property'  => array(
							// property  => array( value, idtag, important, typography_reset ),
							'background' => array( $accent_color, 'accent_color' ),
							'color'      => array( $accent_font, 'accent_font' ),
							),
					) );

	hybridextend_add_css_rule( array(
						'selector'  => '.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover',
						'property'  => 'color',
						'value'     => $accent_color_dark,
					) );

}