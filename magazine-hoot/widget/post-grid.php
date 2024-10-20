<?php
// Get total columns and set column counter
$columns = ( intval( $columns ) >= 1 && intval( $columns ) <= 5 ) ? intval( $columns ) : 4;

// Create a custom WP Query
$count = intval( $count );
$query_args = array();
$query_args['posts_per_page'] = ( empty( $count ) ) ? 7 : $count;
if ( $category )
	$query_args['category'] = $category;
$query_args['meta_query'] = array(
	array(
		'key' => '_thumbnail_id',
		'compare' => 'EXISTS'
	),
);
$query_args = apply_filters( 'maghoot_post_grid_query', $query_args, $instance, $before_title, $title, $after_title );
$post_grid_query = get_posts( $query_args );

// Temporarily remove read more links from excerpts
maghoot_remove_readmore_link();

// Add Pagination
if ( !function_exists( 'maghoot_post_grid_pagination' ) ) :
	function maghoot_post_grid_pagination( $post_grid_query, $query_args ) {
		global $hybridext_currentwidget;
		if ( !empty( $hybridext_currentwidget['instance'] ) )
			extract( $hybridext_currentwidget['instance'], EXTR_SKIP );
		if ( !empty( $viewall ) ) {
			$base_url = ( !empty( $query_args['category'] ) ) ?
						esc_url( get_category_link( $query_args['category'] ) ) :
						( ( get_option( 'page_for_posts' ) ) ?
							esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) :
							esc_url( home_url('/') )
							);
			$class = sanitize_html_class( 'view-all-' . $viewall );
			if ( $viewall == 'top' )
				$class .= ( !empty( $title ) ) ? ' view-all-withtitle' : '';
			echo '<div class="view-all ' . $class . '"><a href="' . $base_url . '">' . __( 'View All', 'magazine-hoot' ) . '</a></div>';
		}
	}
endif;
if ( $viewall == 'top' ) {
	add_action( 'maghoot_post_grid_start', 'maghoot_post_grid_pagination', 10, 2 );
	remove_action( 'maghoot_post_grid_end', 'maghoot_post_grid_pagination', 10, 2 );
} elseif ( $viewall == 'bottom' ) {
	add_action( 'maghoot_post_grid_end', 'maghoot_post_grid_pagination', 10, 2 );
	remove_action( 'maghoot_post_grid_start', 'maghoot_post_grid_pagination', 10, 2 );
} else {
	remove_action( 'maghoot_post_grid_start', 'maghoot_post_grid_pagination', 10, 2 );
	remove_action( 'maghoot_post_grid_end', 'maghoot_post_grid_pagination', 10, 2 );
}

// Template modification Hook
do_action( 'maghoot_post_grid_wrap', $post_grid_query, $query_args );
?>

<div class="post-grid-widget">

	<?php
	/* Display Title */
	if ( $title )
		echo wp_kses_post( apply_filters( 'maghoot_widget_title', $before_title . $title . $after_title, 'post-grid', $title, $before_title, $after_title ) );

	// Template modification Hook
	do_action( 'maghoot_post_grid_start', $post_grid_query, $query_args );
	?>

	<div class="post-grid-columns">
		<?php
		global $post;
		$postcount = 1;

		foreach ( $post_grid_query as $post ) :

				// Init
				setup_postdata( $post );
				$visual = ( has_post_thumbnail() ) ? 1 : 0;
				$metadisplay = array();

				if ( $visual ) :

					if ( $postcount == 1 ) {
						$factor = ( $columns == 1 || !empty( $firstpost['standard'] ) ) ? '1' : '2';
						if ( !empty( $firstpost['author'] ) ) $metadisplay[] = 'author';
						if ( !empty( $firstpost['date'] ) ) $metadisplay[] = 'date';
						if ( !empty( $firstpost['comments'] ) ) $metadisplay[] = 'comments';
						if ( !empty( $firstpost['tags'] ) ) $metadisplay[] = 'tags';
						if ( !empty( $firstpost['cats'] ) && $firstpost['cats'] == 'all' ) $metadisplay[] = 'cats';
						$cats = ( !empty( $firstpost['cats'] ) ) ? $firstpost['cats'] : 'first';
					} else {
						$factor = '1';
						if ( !empty( $show_author ) ) $metadisplay[] = 'author';
						if ( !empty( $show_date ) ) $metadisplay[] = 'date';
						if ( !empty( $show_comments ) ) $metadisplay[] = 'comments';
						if ( !empty( $show_tags ) ) $metadisplay[] = 'tags';
						if ( !empty( $show_cats ) && $show_cats == 'all' ) $metadisplay[] = 'cats';
						$cats = $show_cats;
					}

					// $img_size = maghoot_thumbnail_size( "column-{$factor}-{$columns}" );
					$img_size = 'hoot-preview-large';
					$img_size = apply_filters( 'maghoot_post_grid_img', $img_size, $columns, $postcount, $factor );

					// Start Block Display
					$gridunit_attr = array();
					$gridunit_attr['class'] = "post-gridunit hcolumn-{$factor}-{$columns} post-gridunit-size{$factor}";
					$gridunit_attr['class'] .= ($visual) ? ' visual-img' : ' visual-none';
					$gridunit_attr['data-unitsize'] = $factor;
					$gridunit_attr['data-columns'] = $columns;

					// Set Grid Height
					$gridunit_height = ( empty( $unitheight ) ) ? 0 : ( intval( $unitheight ) );
					$gridunit_style = ( $gridunit_height && $factor == 2 ) ? 'style="height:' . esc_attr( $gridunit_height ) . 'px;"' : '';
					?>

					<div <?php echo hybridextend_get_attr( 'post-gridunit', '', $gridunit_attr ) ?> <?php echo $gridunit_style; ?>>

						<?php
						$gridimg_attr = array( 'style' => '' );
						$thumbnail_size = maghoot_thumbnail_size( $img_size, false );
						$thumbnail_url = get_the_post_thumbnail_url( null, $thumbnail_size );
						if ( $thumbnail_url ) $gridimg_attr['style'] .= "background-image:url(" . esc_url($thumbnail_url) . ");";
						if ( $gridunit_height ) $gridimg_attr['style'] .= 'height:' . esc_attr( $gridunit_height * $factor ) . 'px;';
						?>
						<div <?php echo hybridextend_get_attr( 'post-gridunit-image', '', $gridimg_attr ) ?>>
							<?php maghoot_post_thumbnail( 'post-gridunit-img', $img_size ); // Redundant, but we use it for SEO (related images) ?>
						</div>

						<div class="post-gridunit-bg"><?php echo '<a href="' . esc_url( get_permalink() ) . '" ' . hybridextend_get_attr( 'post-gridunit-imglink', 'permalink' ) . '></a>'; ?></div>
						<?php
						if ( !empty( $cats ) && $cats == 'first' ) {
							$catid = $category;
							if ( !$catid ) {
								$categories = get_the_category();
								$catid = ( !empty( $categories[0]->term_id ) ) ? $categories[0]->term_id : 0;
							}
							$catid = intval( $catid );
							if ( $catid ) {
								$caturl = esc_url( get_category_link( $catid ) );
								$catname = get_cat_name( $catid );
								echo apply_filters( 'maghoot_post_gridunit_catlabel', '<div class="post-gridunit-cat cat-label cat-typo cat-typo-' . intval($catid) . '"><a href="' . $caturl . '">' . esc_html( $catname ) . '</a></div>', $catid, $caturl, $catname );
							}
						} ?>
						<div class="post-gridunit-content">
							<?php if ( !empty( $show_title ) ) : ?>
								<h4 class="post-gridunit-title"><?php echo '<a href="' . esc_url( get_permalink() ) . '" ' . hybridextend_get_attr( 'post-gridunit-link', 'permalink' ) . '>';
									the_title();
									echo '</a>'; ?></h4>
							<?php endif; ?>
							<?php if ( maghoot_meta_info_display( $metadisplay, 'post-gridunit-' . $postcount, true ) ) : ?>
								<div class="post-gridunit-subtitle small">
									<?php maghoot_meta_info_blocks( $metadisplay, 'post-gridunit-' . $postcount, false ); ?>
								</div>
							<?php endif; ?>
						</div>

					</div><?php
					$postcount++;

				endif;

		endforeach;

		wp_reset_postdata();

		echo '<div class="clearfix"></div>';
		?>
	</div>

	<?php
	// Template modification Hook
	do_action( 'maghoot_post_grid_end', $post_grid_query, $query_args );
	?>

</div>

<?php
// Reinstate read more links to excerpts
maghoot_reinstate_readmore_link();