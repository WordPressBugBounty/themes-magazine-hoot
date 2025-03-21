<?php
/**
 *                  _   _             _   
 *  __      ___ __ | | | | ___   ___ | |_ 
 *  \ \ /\ / / '_ \| |_| |/ _ \ / _ \| __|
 *   \ V  V /| |_) |  _  | (_) | (_) | |_ 
 *    \_/\_/ | .__/|_| |_|\___/ \___/ \__|
 *           |_|                          
 * -------------------------------------------
 * -- HOOT THEME BUILT ON HYBRID FRAMEWORK ---
 * -------------------------------------------
 * - incorporate code from Hybrid Base Theme -
 * -- Underscores Theme, Customizer Library --
 * -- (see readme file for copyright info.) --
 * -------------------------------------------
 *
 * :: Theme's main functions file :::::::::::::::::::::::::::::::::::::::::::::
 * :: Initialize and setup the theme framework, helper functions and objects ::
 *
 * To modify this theme, its a good idea to create a child theme. This way you can easily update
 * the main theme without losing your changes. To know more about how to create child themes 
 * @see http://codex.wordpress.org/Theme_Development
 * @see http://codex.wordpress.org/Child_Themes
 *
 * Hooks, Actions and Filters are used throughout this theme. You should be able to do most of your
 * customizations without touching the main code. For more information on hooks, actions, and filters
 * @see http://codex.wordpress.org/Plugin_API
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

/**
 * Run in Debug mode to load unminified CSS and JS, and add other developer data to code.
 * - You can set HYBRIDEXTEND_DEBUG to true (default) for loading unminified files (useful for development/debugging)
 * - Or set HYBRIDEXTEND_DEBUG to false for loading minified files (for production i.e. live site)
 * 
 * NOTE: If you uncomment this line, HYBRIDEXTEND_DEBUG value will override any option for minifying
 * files (if available) set via the theme options (customizer) in WordPress Admin
 */
if ( !defined( 'HYBRIDEXTEND_DEBUG' ) && defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG )
	define( 'HYBRIDEXTEND_DEBUG', true );

/* Get the template directory and make sure it has a trailing slash. */
$maghoot_base_dir = trailingslashit( get_template_directory() );

/* Load the Core framework and theme files */
require_once( $maghoot_base_dir . 'hybrid/hybrid.php' );
require_once( $maghoot_base_dir . 'hybrid/extend/extend.php' );
require_once( $maghoot_base_dir . 'include/hoot-theme.php' );

/* Framework and Theme Setup files loaded */
do_action( 'maghoot_loaded' );

/* Launch the Hybrid framework. */
global $hybridextend;
$hybridextend = new Hybrid_Extend();

/* Framework Setup complete */
do_action( 'hybrid_after_setup' );

/* Launch the Theme */
global $maghoot_theme;
$maghoot_theme = new Maghoot_Theme();

/* Hoot Theme Setup complete */
do_action( 'maghoot_theme_after_setup' );