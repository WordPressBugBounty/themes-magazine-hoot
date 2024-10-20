<?php
/**
 * Post Grid Widget
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/**
* Class Maghoot_Post_Grid_Widget
*/
class Maghoot_Post_Grid_Widget extends HybridExtend_WP_Widget {

	function __construct() {

		$settings['id'] = 'maghoot-post-grid-widget';
		$settings['name'] = __( 'Hoot > Post Grid', 'magazine-hoot' );
		$settings['widget_options'] = array(
			'description'	=> __('Display Posts in a Grid.', 'magazine-hoot'),
			// 'classname'		=> 'maghoot-post-grid-widget', // CSS class applied to frontend widget container via 'before_widget' arg
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
				'name'		=> __( "'View All Posts' link", 'magazine-hoot' ),
				'desc'		=> __( 'Links to your Blog page. If you have a Category selected below, then this will link to the Category Archive page.', 'magazine-hoot' ),
				'id'		=> 'viewall',
				'type'		=> 'select',
				'std'		=> 'none',
				'options'	=> array(
					'none'		=> __( 'Do not display', 'magazine-hoot' ),
					'top'		=> __( 'Show at Top', 'magazine-hoot' ),
					'bottom'	=> __( 'Show at Bottom', 'magazine-hoot' ),
				),
			),
			array(
				'name'		=> __( 'Category (Optional)', 'magazine-hoot' ),
				'desc'		=> __( 'Leave empty to display posts from all categories.', 'magazine-hoot' ),
				'id'		=> 'category',
				'type'		=> 'select',
				'options'	=> array( '0' => '' ) + HybridExtend_WP_Widget::get_tax_list('category') ,
			),
			array(
				'name'		=> __( 'No. Of Columns', 'magazine-hoot' ),
				'desc'		=> __( 'First post takes up 2 columns by default. (You can change this in options below)', 'magazine-hoot' ),
				'id'		=> 'columns',
				'type'		=> 'smallselect',
				'std'		=> '5',
				'options'	=> array(
					'1'	=> __( '1', 'magazine-hoot' ),
					'2'	=> __( '2', 'magazine-hoot' ),
					'3'	=> __( '3', 'magazine-hoot' ),
					'4'	=> __( '4', 'magazine-hoot' ),
					'5'	=> __( '5', 'magazine-hoot' ),
				),
			),
			array(
				'name'		=> __( 'Number of Posts to show', 'magazine-hoot' ),
				'desc'		=> __( 'Default: 7 (posts without a featured image are skipped)', 'magazine-hoot' ),
				'id'		=> 'count',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
			),
			array(
				'name'		=> __( 'Display Post Titles', 'magazine-hoot' ),
				'id'		=> 'show_title',
				'type'		=> 'checkbox',
				'std'		=> 1,
			),
			array(
				'name'		=> __( 'Grid Unit (Post Image) Size', 'magazine-hoot' ),
				'desc'		=> __( 'Default: 215 (in pixels)', 'magazine-hoot' ),
				'id'		=> 'unitheight',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
			),
			array(
				'name'		=> __( 'Individual Posts:', 'magazine-hoot' ),
				// 'desc'		=> __( 'INDIVIDUAL POSTS', 'magazine-hoot' ),
				'id'		=> 'seppost',
				'type'		=> 'separator',
			),
			array(
				'name'		=> __( 'Show Author', 'magazine-hoot' ),
				'id'		=> 'show_author',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Show Post Date', 'magazine-hoot' ),
				'id'		=> 'show_date',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Show number of comments', 'magazine-hoot' ),
				'id'		=> 'show_comments',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Show tags', 'magazine-hoot' ),
				'id'		=> 'show_tags',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Show categories', 'magazine-hoot' ),
				'id'		=> 'show_cats',
				'type'		=> 'select',
				'std'		=> 'first',
				'options'	=> array(
					'none'	=> __( 'None', 'magazine-hoot' ),
					'first'	=> __( 'Only First Category', 'magazine-hoot' ),
					'all'	=> __( 'All Categories', 'magazine-hoot' ),
				),
			),
			array(
				'name'		=> __( 'First Post', 'magazine-hoot' ),
				'id'		=> 'firstpost',
				'type'		=> 'collapse',
				'settings'	=> array( 'state' => 'open' ),
				'fields'	=> array(
					array(
						'name'		=> __( 'Display as Standard Size', 'magazine-hoot' ),
						'desc'		=> __( 'By default, first post is displayed bigger in size compared to other posts.', 'magazine-hoot' ),
						'id'		=> 'standard',
						'type'		=> 'checkbox',
					),
					array(
						'name'		=> __( 'Show Author', 'magazine-hoot' ),
						'id'		=> 'author',
						'type'		=> 'checkbox',
						'std'		=> 1,
					),
					array(
						'name'		=> __( 'Show Post Date', 'magazine-hoot' ),
						'id'		=> 'date',
						'type'		=> 'checkbox',
						'std'		=> 1,
					),
					array(
						'name'		=> __( 'Show number of comments', 'magazine-hoot' ),
						'id'		=> 'comments',
						'type'		=> 'checkbox',
					),
					array(
						'name'		=> __( 'Show tags', 'magazine-hoot' ),
						'id'		=> 'tags',
						'type'		=> 'checkbox',
					),
					array(
						'name'		=> __( 'Show categories', 'magazine-hoot' ),
						'id'		=> 'cats',
						'type'		=> 'select',
						'std'		=> 'first',
						'options'	=> array(
							'none'	=> __( 'None', 'magazine-hoot' ),
							'first'	=> __( 'Only First Category', 'magazine-hoot' ),
							'all'	=> __( 'All Categories', 'magazine-hoot' ),
						),
					),
					array(
						'id'		=> 'fix',
						'type'		=> '<input type="hidden" name="%name%" id="%id%" value="na" class="%class%">',
						// This field is added since all the fields in collapsible are checkboxes. So when all checkbox are unchecked, value for "widget-maghoot-post-grid-widget[N][firstpost]" in the instance is returned as false by the browsers instead of an array with all emements = 0 (empty string value is ok, but we still add a dummy value)
					),
				),
			),
			array(
				'id'		=> 'sepcss',
				'type'		=> 'separator',
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

		$settings = apply_filters( 'maghoot_post_grid_widget_settings', $settings );

		parent::__construct( $settings['id'], $settings['name'], $settings['widget_options'], $settings['control_options'], $settings['form_options'] );

	}

	/**
	 * Echo the widget content
	 */
	function display_widget( $instance, $before_title = '', $title='', $after_title = '' ) {
		extract( $instance, EXTR_SKIP );
		include( hybridextend_locate_widget( 'post-grid' ) ); // Loads the widget/content-posts-blocks or template-parts/widget-content-posts-blocks.php template.
	}

}

/**
 * Register Widget
 */
function maghoot_post_grid_widget_register(){
	register_widget('Maghoot_Post_Grid_Widget');
}
add_action('widgets_init', 'maghoot_post_grid_widget_register');