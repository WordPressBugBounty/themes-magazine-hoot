<?php
/**
 * Content Blocks Widget
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/**
* Class Maghoot_Content_Blocks_Widget
*/
class Maghoot_Content_Blocks_Widget extends HybridExtend_WP_Widget {

	function __construct() {

		$settings['id'] = 'maghoot-content-blocks-widget';
		$settings['name'] = __( 'Hoot > Content Blocks (Pages)', 'magazine-hoot' );
		$settings['widget_options'] = array(
			'description'	=> __('Display Styled Content Blocks.', 'magazine-hoot'),
			// 'classname'		=> 'maghoot-content-blocks-widget', // CSS class applied to frontend widget container via 'before_widget' arg
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
				'name'		=> __( 'Blocks Style', 'magazine-hoot' ),
				'id'		=> 'style',
				'type'		=> 'images',
				'std'		=> 'style1',
				'options'	=> array(
					'style1'	=> HYBRIDEXTEND_INCURI . 'admin/images/content-block-style-1.png',
					'style2'	=> HYBRIDEXTEND_INCURI . 'admin/images/content-block-style-2.png',
					'style3'	=> HYBRIDEXTEND_INCURI . 'admin/images/content-block-style-3.png',
					'style4'	=> HYBRIDEXTEND_INCURI . 'admin/images/content-block-style-4.png',
				),
			),
			array(
				'name'		=> __( 'No. Of Columns', 'magazine-hoot' ),
				'id'		=> 'columns',
				'type'		=> 'select',
				'std'		=> '4',
				'options'	=> array(
					'1'	=> __( '1', 'magazine-hoot' ),
					'2'	=> __( '2', 'magazine-hoot' ),
					'3'	=> __( '3', 'magazine-hoot' ),
					'4'	=> __( '4', 'magazine-hoot' ),
					'5'	=> __( '5', 'magazine-hoot' ),
				),
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
				'name'		=> __( 'Content Boxes', 'magazine-hoot' ),
				'id'		=> 'boxes',
				'type'		=> 'group',
				'options'	=> array(
					'item_name'	=> __( 'Content Box', 'magazine-hoot' ),
				),
				'fields'	=> array(
					array(
						'name'		=> __( 'Title/Content/Image', 'magazine-hoot' ),
						'desc'		=> __( 'Page Title, Content and Featured Image will be used.', 'magazine-hoot' ),
						'id'		=> 'page',
						'type'		=> 'select',
						'options'	=> HybridExtend_WP_Widget::get_wp_list('page'),
					),
					array(
						'name'		=> __( 'Sub Heading (optional)', 'magazine-hoot' ),
						'id'		=> 'subtitle',
						'type'		=> 'text',
					),
					array(
						'name'		=> __( 'Content', 'magazine-hoot' ),
						'id'		=> 'excerpt',
						'type'		=> 'select',
						'std'		=> 'excerpt',
						'options'	=> array(
							'excerpt'	=> __( 'Display Excerpt', 'magazine-hoot' ),
							'content'	=> __( 'Display Full Content', 'magazine-hoot' ),
							'none'		=> __( 'None', 'magazine-hoot' ),
						),
					),
					array(
						'name'		=> __( 'Custom Excerpt Length', 'magazine-hoot' ),
						'desc'		=> __( 'Select \'Display Excerpt\' in option above. Leave empty for default excerpt length.', 'magazine-hoot' ),
						'id'		=> 'excerptlength',
						'type'		=> 'text',
						'settings'	=> array( 'size' => 3, ),
						'sanitize'	=> 'absint',
					),
					array(
						'name'		=> __('Link Text (optional)', 'magazine-hoot'),
						'id'		=> 'link',
						'type'		=> 'text'),
					array(
						'name'		=> __('Link URL', 'magazine-hoot'),
						'id'		=> 'url',
						'type'		=> 'text',
						'sanitize'	=> 'url'),
					array(
						'name'		=> __('Icon', 'magazine-hoot'),
						'desc'		=> __( 'Use an icon instead of featured image of the page selected above.', 'magazine-hoot' ),
						'id'		=> 'icon',
						'type'		=> 'icon',
					),
					array(
						'name'		=> __( 'Icon Style', 'magazine-hoot' ),
						'id'		=> 'icon_style',
						'type'		=> 'select',
						'std'		=> 'circle',
						'options'	=> array(
							'none'		=> __( 'None', 'magazine-hoot' ),
							'circle'	=> __( 'Circle', 'magazine-hoot' ),
							'square'	=> __( 'Square', 'magazine-hoot' ),
						),
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

		$settings = apply_filters( 'maghoot_content_blocks_widget_settings', $settings );

		parent::__construct( $settings['id'], $settings['name'], $settings['widget_options'], $settings['control_options'], $settings['form_options'] );

	}

	/**
	 * Echo the widget content
	 */
	function display_widget( $instance, $before_title = '', $title='', $after_title = '' ) {
		extract( $instance, EXTR_SKIP );
		include( hybridextend_locate_widget( 'content-blocks' ) ); // Loads the widget/content-blocks or template-parts/widget-content-blocks.php template.
	}

}

/**
 * Register Widget
 */
function maghoot_content_blocks_widget_register(){
	register_widget('Maghoot_Content_Blocks_Widget');
}
add_action('widgets_init', 'maghoot_content_blocks_widget_register');