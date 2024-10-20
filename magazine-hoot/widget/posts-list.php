<?php
// Get total columns and set column counter
$columns = ( intval( $columns ) >= 1 && intval( $columns ) <= 3 ) ? intval( $columns ) : 1;

// Create a custom WP Query
$posts_per_page = 0;
for ( $ci = 1; $ci <= 3; $ci++ ) {
	${ 'count' . $ci } = intval( ${ 'count' . $ci } );
	${ 'count' . $ci } = empty( ${ 'count' . $ci } ) ? 3 : ${ 'count' . $ci };
	if ( $ci <= $columns )
		$posts_per_page += ${ 'count' . $ci };
}
$query_args = array();
$query_args['posts_per_page'] = $posts_per_page;
if ( $category )
	$query_args['category'] = $category;
if ( $offset )
	$query_args['offset'] = $offset;
$query_args = apply_filters( 'maghoot_posts_list_query', $query_args, $instance, $before_title, $title, $after_title );
$posts_list_query = get_posts( $query_args );

// Temporarily remove read more links from excerpts
if ( apply_filters( 'maghoot_posts_list_remove_readmore', true ) )
	maghoot_remove_readmore_link();

// Add Pagination
if ( !function_exists( 'maghoot_posts_list_pagination' ) ) :
	function maghoot_posts_list_pagination( $posts_list_query, $query_args ) {
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
				$class .= ( !empty( $category ) || !empty( $title ) ) ? ' view-all-withtitle' : '';
			echo '<div class="view-all ' . $class . '"><a href="' . $base_url . '">' . __( 'View All', 'magazine-hoot' ) . '</a></div>';
		}
	}
endif;
if ( $viewall == 'top' ) {
	add_action( 'maghoot_posts_list_start', 'maghoot_posts_list_pagination', 10, 2 );
	remove_action( 'maghoot_posts_list_end', 'maghoot_posts_list_pagination', 10, 2 );
} elseif ( $viewall == 'bottom' ) {
	add_action( 'maghoot_posts_list_end', 'maghoot_posts_list_pagination', 10, 2 );
	remove_action( 'maghoot_posts_list_start', 'maghoot_posts_list_pagination', 10, 2 );
} else {
	remove_action( 'maghoot_posts_list_start', 'maghoot_posts_list_pagination', 10, 2 );
	remove_action( 'maghoot_posts_list_end', 'maghoot_posts_list_pagination', 10, 2 );
}

// Template modification Hook
do_action( 'maghoot_posts_list_wrap', $posts_list_query, $query_args );
?>

<div class="posts-list-widget posts-list-<?php echo $style; ?>">

	<?php
	if ( $category ) {
		if ( !$title ) $title = get_cat_name( $category );
		if ( empty( $wtitle_bg ) && empty( $wtitle_font ) && empty( $wtitle_nostyle ) ) $before_title = '<h3 class="widget-title"><span class="cat-typo cat-typo-' . intval( $category ) .'">';
	}

	/* Display Title */
	if ( $title )
		echo wp_kses_post( apply_filters( 'maghoot_widget_title', $before_title . $title . $after_title, 'posts-list', $title, $before_title, $after_title ) );

	// Template modification Hook
	do_action( 'maghoot_posts_list_start', $posts_list_query, $query_args );

	// Variables
	global $post;
	$postcount = $colcount = 1;
	$count = $count1;
	$lastclass = ( $colcount == $columns ) ? 'hcol-last' : '';
	?>

	<div class="posts-list-columns">
		<div class="<?php echo "hcolumn-1-{$columns} posts-list-column-1 hcol-first {$lastclass}"; ?>">
			<?php
			foreach ( $posts_list_query as $post ) :

				// Init
				setup_postdata( $post );
				$visual = ( has_post_thumbnail() ) ? 1 : 0;
				$metadisplay = array();

				if ( $postcount == 1 ) {
					if ( empty( $firstpost['size'] ) ) $firstpost['size'] = ( empty( $firstpost['standard'] ) ) ? 'medium' : 'thumb'; // Backward Compatibility
					$factor = ( $firstpost['size'] == 'thumb' ) ? 'small' : 'large';
					if ( !empty( $firstpost['author'] ) ) $metadisplay[] = 'author';
					if ( !empty( $firstpost['date'] ) ) $metadisplay[] = 'date';
					if ( !empty( $firstpost['comments'] ) ) $metadisplay[] = 'comments';
					if ( !empty( $firstpost['tags'] ) ) $metadisplay[] = 'tags';
					$showcats = ( !empty ( $firstpost['show_cats'] ) ) ? $firstpost['show_cats'] : 'first';
					$showcontent = ( !empty ( $firstpost['show_content'] ) ) ? $firstpost['show_content'] : 'excerpt';
					$excerptlength = ( !empty( $firstpost['excerpt_length'] ) ) ? intval( $firstpost['excerpt_length'] ) : '';
				} else {
					$factor = 'small';
					if ( !empty( $show_author ) ) $metadisplay[] = 'author';
					if ( !empty( $show_date ) ) $metadisplay[] = 'date';
					if ( !empty( $show_comments ) ) $metadisplay[] = 'comments';
					if ( !empty( $show_tags ) ) $metadisplay[] = 'tags';
					$showcats = ( !empty ( $show_cats ) ) ? $show_cats : 'none';
					$showcontent = ( !empty ( $show_content ) ) ? $show_content : 'none';
					$excerptlength = ( !empty( $excerpt_length ) ) ? intval( $excerpt_length ) : '';
				}
				if ( !empty( $showcats ) && $showcats == 'all' ) $metadisplay[] = 'cats';

				if ( $postcount == 1 ) {
					if ( $firstpost['size'] == 'thumb' ) $img_size = 'thumbnail';
					elseif( $firstpost['size'] == 'full' ) $img_size = 'full';
					else $img_size = 'hoot-preview-large';
				} else $img_size = 'thumbnail';
				$img_size = apply_filters( 'maghoot_posts_list_img', $img_size, $columns, $postcount, $factor );

				// Start Block Display
				$gridunit_attr = array();
				$gridunit_attr['class'] = "posts-listunit posts-listunit-{$factor}";
				$gridunit_attr['class'] .= ( $postcount == 1 ) ? ' posts-listunit-parent posts-imgsize-' . $firstpost['size'] : ' posts-listunit-child';
				$gridunit_attr['class'] .= ($visual) ? ' visual-img' : ' visual-none';
				$gridunit_attr['data-unitsize'] = $factor;
				$gridunit_attr['data-columns'] = $columns;
				?>

				<div <?php echo hybridextend_get_attr( 'posts-listunit', '', $gridunit_attr ) ?>>

					<?php
					if ( $visual ) :
						$gridimg_attr = array( 'class' => 'posts-listunit-image' );
						if ( $factor == 'large' && $firstpost['size'] == 'full' ) {
							$gridimg_attr['class'] .= ' posts-listunit-nobg';
						} else {
							$gridimg_attr['class'] .= ' posts-listunit-bg';
							$thumbnail_size = maghoot_thumbnail_size( $img_size, false );
							$thumbnail_url = get_the_post_thumbnail_url( null, $thumbnail_size );
							$gridimg_attr['style'] = "background-image:url(" . esc_url($thumbnail_url) . ");";
						}
						?>
						<div <?php echo hybridextend_get_attr( 'posts-listunit-image', '', $gridimg_attr ) ?>>
							<?php
							if ( !empty( $showcats ) && $showcats == 'first' ) {
								$catid = $category;
								if ( !$catid ) {
									$categories = get_the_category();
									$catid = ( !empty( $categories[0]->term_id ) ) ? $categories[0]->term_id : 0;
								}
								$catid = intval( $catid );
								if ( $catid ) {
									$caturl = esc_url( get_category_link( $catid ) );
									$catname = get_cat_name( $catid );
									echo apply_filters( 'maghoot_posts_list_catlabel', '<div class="posts-listunit-cat cat-label cat-typo cat-typo-' . intval($catid) . '"><a href="' . $caturl . '">' . esc_html( $catname ) . '</a></div>', $catid, $caturl, $catname );
								}
							}
							maghoot_post_thumbnail( 'posts-listunit-img', $img_size, false, esc_url( get_permalink( $post->ID ) ) );
							?>
						</div>
					<?php endif; ?>

					<div class="posts-listunit-content">
						<h4 class="posts-listunit-title"><?php echo '<a href="' . esc_url( get_permalink() ) . '" ' . hybridextend_get_attr( 'posts-listunit-link', 'permalink' ) . '>';
							the_title();
							echo '</a>'; ?></h4>
						<?php
						if ( maghoot_meta_info_display( $metadisplay, 'posts-listunit-' . $postcount, true ) ) {
							echo '<div class="posts-listunit-subtitle small">';
							maghoot_meta_info_blocks( $metadisplay, 'posts-listunit-' . $postcount );
							echo '</div>';
						}
						if ( $showcontent == 'excerpt' ) {
							echo '<div class="posts-listunit-text posts-listunit-excerpt">';
							echo hybridextend_get_excerpt( $excerptlength );
							echo '</div>';
						} elseif ( $showcontent == 'content' ) {
							echo '<div class="posts-listunit-text posts-listunit-fulltext">';
							the_content();
							echo '</div>';
						}
						?>
					</div>

				</div><?php
				if ( $postcount == $count && $colcount < $columns ) {
					$colcount++;
					$count += ${ 'count' . $colcount };
					$lastclass = ( $colcount == $columns ) ? 'hcol-last' : '';
					echo "</div><div class='hcolumn-1-{$columns} posts-list-column-{$colcount} {$lastclass}'>";
				}
				$postcount++;

			endforeach;

			wp_reset_postdata();
			?>
		</div>
		<div class="clearfix"></div>
	</div>

	<?php
	// Template modification Hook
	do_action( 'maghoot_posts_list_end', $posts_list_query, $query_args );
	?>

</div>

<?php
// Reinstate read more links to excerpts
if ( apply_filters( 'maghoot_posts_list_remove_readmore', true ) )
	maghoot_reinstate_readmore_link();