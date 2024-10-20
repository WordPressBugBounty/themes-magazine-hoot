<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?> class="no-js">

<head>
<?php
// Fire the wp_head action required for hooking in scripts, styles, and other <head> tags.
wp_head();
?>
</head>

<body <?php hybridextend_attr( 'body' ); ?>>

	<?php wp_body_open(); ?>

	<a href="#main" class="screen-reader-text"><?php _e( 'Skip to content', 'magazine-hoot' ); ?></a>

	<?php
	// Display Topbar
	get_template_part( 'template-parts/topbar' );
	?>

	<div <?php hybridextend_attr( 'page-wrapper' ); ?>>

		<?php
		// Template modification Hook
		do_action( 'maghoot_template_site_start' );
		?>

		<header <?php hybridextend_attr( 'header' ); ?>>

			<?php
			// Display Secondary Menu
			maghoot_secondary_menu( 'top' );
			?>

			<div <?php hybridextend_attr( 'header-part', 'primary' ); ?>>
				<div class="hgrid">
					<div class="table hgrid-span-12">
						<?php
						// Display Branding
						maghoot_header_branding();

						// Display Menu
						maghoot_header_aside();
						?>
					</div>
				</div>
			</div>

			<?php
			// Display Secondary Menu
			maghoot_secondary_menu( 'bottom' );
			?>

		</header><!-- #header -->

		<?php hybridextend_get_sidebar( 'below-header' ); // Loads the template-parts/sidebar-below-header.php template. ?>

		<div <?php hybridextend_attr( 'main' ); ?>>
			<?php
			// Template modification Hook
			do_action( 'maghoot_template_main_wrapper_start' );