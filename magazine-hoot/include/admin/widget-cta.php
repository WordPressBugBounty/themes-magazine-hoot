<?php
/**
 * Call To Action Widget
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/**
* Class Maghoot_CTA_Widget
*/
class Maghoot_CTA_Widget extends HybridExtend_WP_Widget {

	function __construct() {

		$settings['id'] = 'maghoot-cta-widget';
		$settings['name'] = __( 'Hoot > Call To Action', 'magazine-hoot' );
		$settings['widget_options'] = array(
			'description'	=> __('Display Call To Action block.', 'magazine-hoot'),
			// 'classname'		=> 'maghoot-cta-widget', // CSS class applied to frontend widget container via 'before_widget' arg
		);
		$settings['control_options'] = array();
		$settings['form_options'] = array(
			//'name' => can be empty or false to hide the name
			array(
				'name'		=> __( 'Headline', 'magazine-hoot' ),
				'id'		=> 'headline',
				'type'		=> 'text',
			),
			array(
				'name'		=> __( 'Description', 'magazine-hoot' ),
				'id'		=> 'description',
				'type'		=> 'textarea',
			),
			array(
				'name'		=> __( 'Button Text', 'magazine-hoot' ),
				'id'		=> 'button_text',
				'type'		=> 'text',
				'std'		=> __( 'KNOW MORE', 'magazine-hoot' ),
			),
			array(
				'name'		=> __( 'Button URL', 'magazine-hoot' ),
				'desc'		=> __( 'Leave empty if you dont want to show button', 'magazine-hoot' ),
				'id'		=> 'url',
				'type'		=> 'text',
				'sanitize'	=> 'url',
			),
			array(
				'name'		=> __( 'Border', 'magazine-hoot' ),
				'desc'		=> __( 'Top and bottom borders.', 'magazine-hoot' ),
				'id'		=> 'border',
				'type'		=> 'select',
				'std'		=> 'none none',
				'options'	=> array(
					'line line'		=> __( 'Top - Line || Bottom - Line', 'magazine-hoot' ),
					'line shadow'	=> __( 'Top - Line || Bottom - DoubleLine', 'magazine-hoot' ),
					'line none'		=> __( 'Top - Line || Bottom - None', 'magazine-hoot' ),
					'shadow line'	=> __( 'Top - DoubleLine || Bottom - Line', 'magazine-hoot' ),
					'shadow shadow'	=> __( 'Top - DoubleLine || Bottom - DoubleLine', 'magazine-hoot' ),
					'shadow none'	=> __( 'Top - DoubleLine || Bottom - None', 'magazine-hoot' ),
					'none line'		=> __( 'Top - None || Bottom - Line', 'magazine-hoot' ),
					'none shadow'	=> __( 'Top - None || Bottom - DoubleLine', 'magazine-hoot' ),
					'none none'		=> __( 'Top - None || Bottom - None', 'magazine-hoot' ),
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

		$settings = apply_filters( 'maghoot_cta_widget_settings', $settings );

		parent::__construct( $settings['id'], $settings['name'], $settings['widget_options'], $settings['control_options'], $settings['form_options'] );

	}

	/**
	 * Echo the widget content
	 */
	function display_widget( $instance, $before_title = '', $title='', $after_title = '' ) {
		extract( $instance, EXTR_SKIP );
		include( hybridextend_locate_widget( 'cta' ) ); // Loads the widget/cta or template-parts/widget-cta.php template.
	}

}

/**
 * Register Widget
 */
function maghoot_cta_widget_register(){
	register_widget('Maghoot_CTA_Widget');
}
add_action('widgets_init', 'maghoot_cta_widget_register');