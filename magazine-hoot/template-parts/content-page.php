<?php
/**
 * Template to display single static page content
 */

/**
 * If viewing a single page (pages can occur in archive lists as well. Example: search results)
 * Use `( is_singular() )` instead of `( is_page() )` to allow plugins like Tribe Events use page templates on single event pages
 * This lets pages show in category pages with plugins like 'Category Tag Pages'
 * Additionally, display full content on post type archive pages to allow plugins like Tribe Events use page templates on events pages
 */
if ( is_singular() || ( is_archive() && is_post_type_archive() ) ) :
?>

	<article <?php hybridextend_attr( 'page' ); ?>>

		<div <?php hybridextend_attr( 'entry-content' ); ?>>

			<div class="entry-the-content">
				<?php the_content(); ?>
			</div>
			<?php wp_link_pages(); ?>

		</div><!-- .entry-content -->

		<div class="screen-reader-text" itemprop="datePublished" itemtype="https://schema.org/Date"><?php echo get_the_date('Y-m-d'); ?></div>

		<?php
		$hide_meta_info = apply_filters( 'maghoot_hide_meta_info', false, 'bottom' );
		if ( !$hide_meta_info && 'bottom' == maghoot_get_mod( 'post_meta_location' ) ):
			$metarray = maghoot_get_mod('page_meta');
			if ( maghoot_meta_info_display( $metarray, 'page', true ) ) :
			?>
			<footer class="entry-footer">
				<?php maghoot_meta_info_blocks( $metarray, 'page' ); ?>
			</footer><!-- .entry-footer -->
			<?php
			endif;
		endif;
		?>

	</article><!-- .entry -->

<?php
/**
 * If not viewing a single page i.e. viewing the page in a list index (Example: search results)
 */
else :

	if ( ! apply_filters( 'maghoot_searchresults_hide_pages', false ) ) {

		$archive_type = apply_filters( 'maghoot_default_archive_type', 'block2', 'content-page' );
		$archive_template = apply_filters( 'maghoot_default_archive_location', 'template-parts/content-archive', $archive_type, 'content-page' );

		// Loads the template-parts/content-archive-{type}.php template.
		get_template_part( $archive_template, $archive_type );

	}

endif;
?>