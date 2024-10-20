<?php
/**
 * Posts List Widget
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/**
* Class Maghoot_Posts_List_Widget
*/
class Maghoot_Posts_List_Widget extends HybridExtend_WP_Widget {

	function __construct() {

		$settings['id'] = 'maghoot-posts-list-widget';
		$settings['name'] = __( 'Hoot > Posts List', 'magazine-hoot' );
		$settings['widget_options'] = array(
			'description'	=> __('Display Posts List (all or specific category).', 'magazine-hoot'),
			// 'classname'		=> 'maghoot-post-list-widget', // CSS class applied to frontend widget container via 'before_widget' arg
		);
		$settings['control_options'] = array();
		$settings['form_options'] = array(
			//'name' => can be empty or false to hide the name
			array(
				'name'		=> __( 'Title (Optional)', 'magazine-hoot' ),
				'desc'		=> __( 'Leave empty to display category name', 'magazine-hoot' ),
				'id'		=> 'title',
				'type'		=> 'text',
			),
			array(
				'name'		=> __( 'List Style', 'magazine-hoot' ),
				'id'		=> 'style',
				'type'		=> 'images',
				'std'		=> 'style1',
				'options'	=> array(
					'style1'	=> HYBRIDEXTEND_INCURI . 'admin/images/posts-list-style-1.png',
					'style2'	=> HYBRIDEXTEND_INCURI . 'admin/images/posts-list-style-2.png',
					//'style3'	=> HYBRIDEXTEND_INCURI . 'admin/images/posts-list-style-3.png',
				),
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
				'name'		=> __( 'Category', 'magazine-hoot' ),
				'desc'		=> __( 'Leave empty to display posts from all categories.', 'magazine-hoot' ),
				'id'		=> 'category',
				'type'		=> 'select',
				'options'	=> array( '0' => '' ) + HybridExtend_WP_Widget::get_tax_list('category') ,
			),
			array(
				'name'		=> __( 'No. Of Columns', 'magazine-hoot' ),
				'id'		=> 'columns',
				'type'		=> 'smallselect',
				'std'		=> '1',
				'options'	=> array(
					'1'	=> __( '1', 'magazine-hoot' ),
					'2'	=> __( '2', 'magazine-hoot' ),
					'3'	=> __( '3', 'magazine-hoot' ),
				),
			),
			array(
				'name'		=> __( 'Number of Posts - 1st Column', 'magazine-hoot' ),
				'desc'		=> __( 'Default: 3', 'magazine-hoot' ),
				'id'		=> 'count1',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
			),
			array(
				'name'		=> __( 'Number of Posts - 2nd Column', 'magazine-hoot' ),
				'desc'		=> __( 'Default: 3<br>(if selected 2 or 3 columns above)', 'magazine-hoot' ),
				'id'		=> 'count2',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
			),
			array(
				'name'		=> __( 'Number of Posts - 3rd Column', 'magazine-hoot' ),
				'desc'		=> __( 'Default: 3<br>(if selected 3 columns above)', 'magazine-hoot' ),
				'id'		=> 'count3',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
			),
			array(
				'name'		=> __( 'Skip Posts', 'magazine-hoot' ),
				'desc'		=> __( 'Number of posts to skip from start (By default, the list starts from latest post)', 'magazine-hoot' ),
				'id'		=> 'offset',
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
				'std'		=> 1,
			),
			array(
				'name'		=> __( 'Show Post Date', 'magazine-hoot' ),
				'id'		=> 'show_date',
				'type'		=> 'checkbox',
				'std'		=> 1,
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
				'std'		=> 'none',
				'options'	=> array(
					'none'	=> __( 'None', 'magazine-hoot' ),
					'first'	=> __( 'Only First Category', 'magazine-hoot' ),
					'all'	=> __( 'All Categories', 'magazine-hoot' ),
				),
			),
			array(
				'name'		=> __( 'Content', 'magazine-hoot' ),
				'id'		=> 'show_content',
				'type'		=> 'select',
				'std'		=> 'none',
				'options'	=> array(
					'excerpt'	=> __( 'Display Excerpt', 'magazine-hoot' ),
					'content'	=> __( 'Display Full Content', 'magazine-hoot' ),
					'none'		=> __( 'None', 'magazine-hoot' ),
				),
			),
			array(
				'name'		=> __( 'Custom Excerpt Length', 'magazine-hoot' ),
				'desc'		=> __( 'Select \'Display Excerpt\' in option above. Leave empty for default excerpt length.', 'magazine-hoot' ),
				'id'		=> 'excerpt_length',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
			),
			array(
				'name'		=> __( 'First Post', 'magazine-hoot' ),
				'id'		=> 'firstpost',
				'type'		=> 'collapse',
				'settings'	=> array( 'state' => 'open' ),
				'fields'	=> array(
					array(
						'name'		=> __( 'Image Size', 'magazine-hoot' ),
						'id'		=> 'size',
						'type'		=> 'select',
						'std'		=> 'medium',
						'options'	=> array(
							'thumb'		=> __( 'Thumbnail (like other posts)', 'magazine-hoot' ),
							'small'		=> __( 'Rectangular Small', 'magazine-hoot' ),
							'medium'	=> __( 'Rectangular Medium', 'magazine-hoot' ),
							'big'		=> __( 'Rectangular Big', 'magazine-hoot' ),
							'full'		=> __( 'Full (Non Cropped)', 'magazine-hoot' ),
						),
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
						'name'		=> __( 'Content', 'magazine-hoot' ),
						'id'		=> 'show_content',
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
						'id'		=> 'excerpt_length',
						'type'		=> 'text',
						'settings'	=> array( 'size' => 3, ),
						'sanitize'	=> 'absint',
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

		$settings = apply_filters( 'maghoot_posts_list_widget_settings', $settings ); // @todo posts=>post for free version filter to convert id slug=>hoot

		parent::__construct( $settings['id'], $settings['name'], $settings['widget_options'], $settings['control_options'], $settings['form_options'] );

	}

	/**
	 * Echo the widget content
	 */
	function display_widget( $instance, $before_title = '', $title='', $after_title = '' ) {
		extract( $instance, EXTR_SKIP );
		include( hybridextend_locate_widget( 'posts-list' ) ); // Loads the widget/post-list or template-parts/widget-posts-list.php template.
	}

}

/**
 * Register Widget
 */
function maghoot_posts_list_widget_register(){
	register_widget('Maghoot_Posts_List_Widget');
}
add_action('widgets_init', 'maghoot_posts_list_widget_register');