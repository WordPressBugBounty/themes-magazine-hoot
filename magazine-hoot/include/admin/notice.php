<?php
/**
 * Welcome Notice
 */

/**
 * Whether to load notice
 */
function maghoot_load_notices() {
	global $pagenow;
	$subpage = isset( $_GET['page'] ) ? $_GET['page'] : 'subpage';
	$slug = maghoot_abouttag( 'slug' );
	return (
		$slug && is_string( $slug )
		&& ! get_option( "{$slug}-dismiss-welcome" )
		&& (
			in_array( $pagenow, array( 'themes.php', 'plugins.php', 'upload.php' ) )
			|| ( $pagenow === 'edit.php' && ( empty( $_GET['post_type'] ) || $_GET['post_type'] === 'page' ) )
		)
		&& ! in_array( $subpage, array( "{$slug}-welcome", 'hootkit', 'hoot-import' ) )
	);
}

/**
 * Skip notice for already installed themes
 */
function maghoot_theme_update_action( $upgrader_object, $options ) {
	if ( $options['type'] === 'theme' && $options['action'] === 'update' ) {
		$updated_themes = $options['themes'];
		$current_theme = get_option( 'stylesheet' ); // Get the active theme's slug (directory name)
		if ( in_array( $current_theme, $updated_themes ) && function_exists( 'get_theme_mod' ) && get_theme_mod('accent_color') ) {
			$slug = maghoot_abouttag( 'slug' );
			update_option( "{$slug}-dismiss-welcome", 1 );
		}
	}
}
add_action( 'upgrader_process_complete', 'maghoot_theme_update_action', 10, 2 );

/**
 * Add a welcome notice if not already dismissed
 */
function maghoot_welcome_notice() {
	$slug = maghoot_abouttag( 'slug' );
	if ( maghoot_load_notices() ) {
		add_action( 'admin_notices', 'maghoot_add_welcome_notice' );
	}
	if ( !empty( $_GET['maghoot-noticereset'] ) ) {
		update_option( "{$slug}-dismiss-welcome", 0 );
		update_option( "{$slug}-dismiss-import", 0 );
	}
}
add_action( 'admin_head', 'maghoot_welcome_notice' );

/**
 * Enqueue CSS
 *
 * @since 1.0
 * @access public
 * @return void
 */
function maghoot_admin_enqueue_notice_styles( $hook ) {
	$slug = maghoot_abouttag( 'slug' );
	if ( maghoot_load_notices() || $hook === "appearance_page_{$slug}-welcome" ) {
		wp_enqueue_style( 'maghoot-admin-notice', HYBRIDEXTEND_INCURI . 'admin/css/notice.css', array(), HYBRIDEXTEND_VERSION );
		wp_enqueue_script( 'maghoot-admin-notice', HYBRIDEXTEND_INCURI . 'admin/js/notice.js', array( 'jquery' ), HYBRIDEXTEND_VERSION, true );
		wp_localize_script( 'maghoot-admin-notice', 'maghoot_admin_notice', array(
							'ajax_url' => esc_url( admin_url( 'admin-ajax.php' ) ),
							'nonce' => wp_create_nonce( 'hoottheme-welcome-action' ),
							'dismiss_action' => 'maghoot_dismiss_welcome_notice',
							'maghoot_processplugin_action' => 'maghoot_processplugin',
							'maghoot_processplugin_btntext' => esc_html__( 'Please Wait. This may take a while...', 'magazine-hoot' ),
						) );
	}
}
add_action( 'admin_enqueue_scripts', 'maghoot_admin_enqueue_notice_styles' );

/**
 * Display admin notice
 */
function maghoot_add_welcome_notice() {
	$slug = maghoot_abouttag( 'slug' );
	$themename = maghoot_abouttag( 'name' );
	$fullshot = maghoot_abouttag( 'fullshot' );
	$import_config = apply_filters( 'hootimport_theme_config', array() ); // Hoot Import has been configured for active theme
	$display_import = ! empty( $import_config ) && ! get_option( "{$slug}-dismiss-import" );
	?>
	<div id="maghoot-welcome-msg" class="maghoot-welcome-msg notice notice-success is-dismissible">
		<div class="maghoot-welcome-content">
			<?php if ( $fullshot ) : ?>
				<a class="maghoot-welcome-img <?php if ( $display_import ) { echo 'maghoot-welcome-img--large'; } ?>" href="<?php echo esc_url( "https://demo.wphoot.com/magazine-hoot" ); ?>" target="_blank">
					<img class="maghoot-welcome-screenshot" src="<?php echo esc_url( $fullshot ); ?>" alt="<?php echo esc_attr( $themename ); ?>" />
				</a>
			<?php endif; ?>
			<div class="maghoot-welcome-text">
				<h1><?php
					/* Translators: 1 is the theme name */
					printf( esc_html__( 'Thank you for choosing %1$s!', 'magazine-hoot' ), $themename );
				?></h1>
				<p><?php
					/* Translators: 1 is the link start markup, 2 is link markup end */
					printf( esc_html__( 'To get started and fully take advantage of our theme, please make sure you visit the welcome page for the %1$sQuick Start Guide%2$s.', 'magazine-hoot' ), '<a href="' . esc_url( admin_url( "themes.php?page={$slug}-welcome&tab=qstart" ) ) . '">', '</a>' );
				?></p>
				<?php if ( $display_import ) : ?>
					<p><?php _e( 'Or you can import the demo data by clicking the button below to help you get familiar with the theme.', 'magazine-hoot' ); ?></p>
					<p><a class="button button-primary maghoot-welcome-btn maghoot-btn-processplugin" href="#"><?php esc_html_e( 'Import Demo Content', 'magazine-hoot' ); ?></a></p>
					<?php if ( ! class_exists( 'HootImport' ) ) : ?><p class="maghoot-welcome-note"><?php _e( 'Clicking the button will install and activate the "Hoot Import" plugin.', 'magazine-hoot' ); ?></p><?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Ajax callback to set dismissable notice
 */
function maghoot_dismiss_welcome_notice() {
	check_ajax_referer( 'hoottheme-welcome-action', 'nonce' );
	$slug = maghoot_abouttag( 'slug' );
	update_option( "{$slug}-dismiss-welcome", 1 );
	wp_die();
}
add_action( 'wp_ajax_maghoot_dismiss_welcome_notice', 'maghoot_dismiss_welcome_notice' );

/**
 * Ajax callback to import and activate Hoot Import plugin
 */
function maghoot_processplugin() {
	check_ajax_referer( 'hoottheme-welcome-action', 'nonce' );
	$slug = maghoot_abouttag( 'slug' );
	$state = '';
	$response = array();
	$plugin = isset( $_POST['plugin'] ) && in_array( $_POST['plugin'], array( 'hoot-import', 'hootkit' ) ) ? $_POST['plugin'] : '';
	if (
		( $plugin === 'hoot-import' && class_exists( 'HootImport' ) ) ||
		( $plugin === 'hootkit' && class_exists( 'HootKit' ) )
	 ) {
		$state = 'activated';
	} elseif ( file_exists( WP_PLUGIN_DIR . "/{$plugin}/{$plugin}.php" ) ) {
		$state = 'installed';
	} else {
		/** Install plugin. **/
		wp_enqueue_style( 'plugin-install' );
		wp_enqueue_script( 'plugin-install' );
		include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
		include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
		include_once( ABSPATH . 'wp-admin/includes/class-wp-ajax-upgrader-skin.php' );
		include_once( ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php' );
		$api = plugins_api(
			'plugin_information',
			array(
				'slug'   => sanitize_key( wp_unslash( $plugin ) ),
				'fields' => array(
					'short_description' => false,
					'sections' => false,
					'requires' => false,
					'rating' => false,
					'ratings' => false,
					'downloaded' => false,
					'last_updated' => false,
					'added' => false,
					'tags' => false,
					'compatibility' => false,
					'homepage' => false,
					'donate_link' => false,
				),
			)
		);
		if ( is_wp_error( $api ) ) {
			$response['errorInstall'] = $api->get_error_message();
		} else {
			$skin     = new WP_Ajax_Upgrader_Skin();
			$upgrader = new Plugin_Upgrader( $skin );
			$result   = $upgrader->install( $api->download_link );
			if ( $result ) {
				$state = 'installed';
			} else {
				$pluginname = ucwords( str_replace( '-', ' ', $plugin ) );
				/* Translators: 1 is line break, 2 is the link start markup, 3 is link markup end, 4 is the plugin name, 5 and 6 are strong tags */
				$errormsg = sprintf( esc_html__( 'WordPress encountered an unexpected error during the plugin installation.%1$sPlease %2$sclick this link%3$s to install the %5$s%4$s plugin%6$s directly.', 'magazine-hoot' ), '<br />', '<a href="' . esc_url( admin_url( "plugin-install.php?s={$plugin}&tab=search&type=term" ) ) . '">', '</a>', $pluginname, '<strong>', '</strong>' );
				$response['errorInstall'] = $errormsg;
			}
		}
	}

	if ( 'installed' === $state ) {
		if ( current_user_can( 'activate_plugin' ) ) {
			$result = activate_plugin( "{$plugin}/{$plugin}.php" );
			if ( ! is_wp_error( $result ) ) {
				$state = 'activated';
			} else {
				$response['errorCode']    = $result->get_error_code();
				$response['errorMessage'] = $result->get_error_message();
			}
		}
	}

	if ( 'activated' === $state ) {
		if ( $plugin === 'hoot-import' ) {
			$response['redirect'] = esc_url( admin_url( 'themes.php?page=hoot-import' ) );
			update_option( "{$slug}-dismiss-import", 1 );
		} elseif ( $plugin === 'hootkit' ) {
			$response['redirect'] = esc_url( admin_url( 'options-general.php?page=hootkit' ) );
		}
	}

	wp_send_json( $response );
	exit();
}
add_action( 'wp_ajax_maghoot_processplugin', 'maghoot_processplugin' );