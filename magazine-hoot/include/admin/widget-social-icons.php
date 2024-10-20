<?php
/**
 * Social Icons Widget
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/**
* Class Maghoot_Social_Icons_Widget
*/
class Maghoot_Social_Icons_Widget extends HybridExtend_WP_Widget {

	function __construct() {

		$settings['id'] = 'maghoot-social-icons-widget';
		$settings['name'] = __( 'Hoot > Social Icons', 'magazine-hoot' );
		$settings['widget_options'] = array(
			'description'	=> __('Display Social Icons', 'magazine-hoot'),
			// 'classname'		=> 'maghoot-social-icons-widget', // CSS class applied to frontend widget container via 'before_widget' arg
		);
		$settings['control_options'] = array();
		$settings['form_options'] = array(
			//'name' => can be empty or false to hide the name
			array(
				'name'		=> __( "Title (optional)", 'magazine-hoot' ),
				'id'		=> 'title',
				'type'		=> 'text',
			),
			array(
				'name'		=> __( 'Icon Size', 'magazine-hoot' ),
				'id'		=> 'size',
				'type'		=> 'select',
				'std'		=> 'small',
				'options'	=> array(
					'small'		=> __( 'Small', 'magazine-hoot' ),
					'medium'	=> __( 'Medium', 'magazine-hoot' ),
					'large'		=> __( 'Large', 'magazine-hoot' ),
					'huge'		=> __( 'Huge', 'magazine-hoot' ),
				),
			),
			array(
				'name'		=> __( 'Social Icons', 'magazine-hoot' ),
				'id'		=> 'icons',
				'type'		=> 'group',
				'options'	=> array(
					'item_name'	=> __( 'Icon', 'magazine-hoot' ),
				),
				'fields'	=> array(
					array(
						'name'		=> __( 'Social Icon', 'magazine-hoot' ),
						'id'		=> 'icon',
						'type'		=> 'select',
						'options'	=> hybridextend_enum_social_profiles(),
					),
					array(
						'name'		=> __( 'URL (enter username for Skype, email address for Email)', 'magazine-hoot' ),
						'id'		=> 'url',
						'type'		=> 'text',
						'sanitize'	=> 'social_icons_sanitize_url',
					),
				),
			),
			array(
				'name'		=> __( 'Widget CSS', 'magazine-hoot' ),
				'id'		=> 'customcss',
				'type'		=> 'collapse',
				'fields'	=> array(
					array(
						'name'		=> __( 'Custom CSS Class', 'magazine-hoot' ),
						'desc'		=> __( 'Give this widget a custom css classname', 'magazine-hoot' ),
						'id'		=> 'class',
						'type'		=> 'text',
					),
					array(
						'name'		=> __( 'Margin Top', 'magazine-hoot' ),
						'desc'		=> __( '(in pixels) Leave empty to load default margins', 'magazine-hoot' ),
						'id'		=> 'mt',
						'type'		=> 'text',
						'settings'	=> array( 'size' => 3 ),
						'sanitize'	=> 'integer',
					),
					array(
						'name'		=> __( 'Margin Bottom', 'magazine-hoot' ),
						'desc'		=> __( '(in pixels) Leave empty to load default margins', 'magazine-hoot' ),
						'id'		=> 'mb',
						'type'		=> 'text',
						'settings'	=> array( 'size' => 3 ),
						'sanitize'	=> 'integer',
					),
				),
			),
		);

		$settings = apply_filters( 'maghoot_social_icons_widget_settings', $settings );

		parent::__construct( $settings['id'], $settings['name'], $settings['widget_options'], $settings['control_options'], $settings['form_options'] );

	}

	/**
	 * Echo the widget content
	 */
	function display_widget( $instance, $before_title = '', $title='', $after_title = '' ) {
		extract( $instance, EXTR_SKIP );
		include( hybridextend_locate_widget( 'social-icons' ) ); // Loads the widget/social-icons or template-parts/widget-social-icons.php template.
	}

}

/**
 * Register Widget
 */
function maghoot_social_icons_widget_register(){
	register_widget('Maghoot_Social_Icons_Widget');
}
add_action('widgets_init', 'maghoot_social_icons_widget_register');

/**
 * Custom Sanitization Function
 */
function maghoot_social_icons_sanitize_url( $value, $name, $instance ){
	if ( $name == 'social_icons_sanitize_url' ) {
		if ( !empty( $instance['icon'] ) && $instance['icon'] == 'fa-skype' )
			$new = sanitize_user( $value, true );
		elseif ( !empty( $instance['icon'] ) && $instance['icon'] == 'fa-envelope' )
			$new = ( is_email( $value ) ) ? sanitize_email( $value ) : '';
		else
			$new = esc_url_raw( $value );
		return $new;
	}
	return $value;
}
add_filter('widget_admin_sanitize_field', 'maghoot_social_icons_sanitize_url', 10, 3);