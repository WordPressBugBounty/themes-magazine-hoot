<?php
/**
 * Announce Widget
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/**
* Class Maghoot_Announce_Widget
*/
class Maghoot_Announce_Widget extends HybridExtend_WP_Widget {

	function __construct() {

		$settings['id'] = 'maghoot-announce-widget';
		$settings['name'] = __( 'Hoot > Announce', 'magazine-hoot' );
		$settings['widget_options'] = array(
			'description'	=> __('Display Announcement Message', 'magazine-hoot'),
			// 'classname'		=> 'maghoot-announce-widget', // CSS class applied to frontend widget container via 'before_widget' arg
		);
		$settings['control_options'] = array();
		$settings['form_options'] = array(
			//'name' => can be empty or false to hide the name
			array(
				'name'		=> __( 'Message', 'magazine-hoot' ),
				'id'		=> 'message',
				'type'		=> 'text',
			),
			array(
				'name'		=> __('Background (optional)', 'magazine-hoot'),
				'desc'		=> __('Leave empty for no background.', 'magazine-hoot'),
				'id'		=> 'background',
				// 'std'		=> '#aa0000',
				'type'		=> 'color',
			),
			array(
				'name'		=> __('Font Color (optional)', 'magazine-hoot'),
				'desc'		=> __('Leave empty to use default font colors.', 'magazine-hoot'),
				'id'		=> 'fontcolor',
				// 'std'		=> '#aa0000',
				'type'		=> 'color',
			),
			array(
				'name'		=> __('Icon', 'magazine-hoot'),
				'id'		=> 'icon',
				'type'		=> 'icon',
			),
			array(
				'name'		=> __( 'Link URL (Optional)', 'magazine-hoot' ),
				'id'		=> 'url',
				'type'		=> 'text',
				'sanitize'	=> 'url',
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

		$settings = apply_filters( 'maghoot_announce_widget_settings', $settings );

		parent::__construct( $settings['id'], $settings['name'], $settings['widget_options'], $settings['control_options'], $settings['form_options'] );

	}

	/**
	 * Echo the widget content
	 */
	function display_widget( $instance, $before_title = '', $title='', $after_title = '' ) {
		extract( $instance, EXTR_SKIP );
		include( hybridextend_locate_widget( 'announce' ) ); // Loads the widget/announce or template-parts/widget-announce.php template.
	}

}

/**
 * Register Widget
 */
function maghoot_announce_widget_register(){
	register_widget('Maghoot_Announce_Widget');
}
add_action('widgets_init', 'maghoot_announce_widget_register');