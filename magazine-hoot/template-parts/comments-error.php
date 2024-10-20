<?php if ( pings_open() && !comments_open() ) : ?>

	<p class="comments-closed pings-open">
		<?php
			/* Translators: The two %s are placeholders for HTML. The order can't be changed. */
			printf( __( 'Comments are closed, but %1$strackbacks%2$s and pingbacks are open.', 'magazine-hoot' ), '<a href="' . esc_url( get_trackback_url() ) . '">', '</a>' );
		?>
	</p><!-- .comments-closed .pings-open -->

<?php elseif ( !comments_open() ) : ?>

	<p class="comments-closed">
		<?php _e( 'Comments are closed.', 'magazine-hoot' ); ?>
	</p><!-- .comments-closed -->

<?php endif; ?>