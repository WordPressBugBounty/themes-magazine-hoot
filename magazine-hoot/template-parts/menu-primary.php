<?php

// Template modification Hook
do_action( 'maghoot_template_before_menu', 'primary' );

if ( has_nav_menu( 'hoot-primary' ) ) : // Check if there's a menu assigned to the 'primary' location.

	?>
	<div class="screen-reader-text"><?php _e( 'Primary Navigation Menu', 'magazine-hoot' ); ?></div>
	<nav <?php hybridextend_attr( 'menu', 'primary' ); ?>>
		<a class="menu-toggle" href="#"><span class="menu-toggle-text"><?php _e( 'Menu', 'magazine-hoot' ); ?></span><i class="fas fa-bars"></i></a>

		<?php
		/* Create Menu Args Array */
		$menu_args = array(
			'theme_location'  => 'hoot-primary',
			'container'       => false,
			'menu_id'         => 'menu-primary-items',
			'menu_class'      => 'menu-items sf-menu menu',
			'fallback_cb'     => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			);

		/* Display Main Menu */
		wp_nav_menu( $menu_args ); ?>

	</nav><!-- #menu-primary -->
	<?php

endif; // End check for menu.

// Template modification Hook
do_action( 'maghoot_template_after_menu', 'primary' );