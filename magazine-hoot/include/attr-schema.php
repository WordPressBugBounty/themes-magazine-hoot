<?php
/**
 * HTML attribute filters. #Hybrid3.0
 * Default microdata vocabulary supported is Schema.org.
 *
 * @package    Hoot
 * @subpackage Magazine Hoot
 */

# Attributes for major structural elements.
add_filter( 'hybrid_attr_body',    'hybridtheme_attr_body',    7    );
add_filter( 'hybrid_attr_header',  'hybridtheme_attr_header',  7    );
add_filter( 'hybrid_attr_footer',  'hybridtheme_attr_footer',  7    );
add_filter( 'hybrid_attr_content', 'hybridtheme_attr_content', 7    );
add_filter( 'hybrid_attr_sidebar', 'hybridtheme_attr_sidebar', 7, 2 );
add_filter( 'hybrid_attr_menu',    'hybridtheme_attr_menu',    7, 2 );

# Header attributes.
add_filter( 'hybrid_attr_head',             'hybridtheme_attr_head',             7 );
add_filter( 'hybrid_attr_branding',         'hybridtheme_attr_branding',         7 );
add_filter( 'hybrid_attr_site-title',       'hybridtheme_attr_site_title',       7 );
add_filter( 'hybrid_attr_site-description', 'hybridtheme_attr_site_description', 7 );

# Archive page header attributes.
add_filter( 'hybrid_attr_archive-header',      'hybridtheme_attr_archive_header',      7 );
add_filter( 'hybrid_attr_archive-title',       'hybridtheme_attr_archive_title',       7 );
add_filter( 'hybrid_attr_archive-description', 'hybridtheme_attr_archive_description', 7 );

# Post-specific attributes.
add_filter( 'hybrid_attr_post',            'hybridtheme_attr_post',            7    );
add_filter( 'hybrid_attr_entry',           'hybridtheme_attr_post',            7    ); // Alternate for "post".
add_filter( 'hybrid_attr_entry-title',     'hybridtheme_attr_entry_title',     7    );
add_filter( 'hybrid_attr_entry-author',    'hybridtheme_attr_entry_author',    7    );
add_filter( 'hybrid_attr_entry-published', 'hybridtheme_attr_entry_published', 7    );
add_filter( 'hybrid_attr_entry-content',   'hybridtheme_attr_entry_content',   7    );
add_filter( 'hybrid_attr_entry-summary',   'hybridtheme_attr_entry_summary',   7    );
add_filter( 'hybrid_attr_entry-terms',     'hybridtheme_attr_entry_terms',     7, 2 );

# Comment specific attributes.
add_filter( 'hybrid_attr_comment',           'hybridtheme_attr_comment',           7 );
add_filter( 'hybrid_attr_comment-author',    'hybridtheme_attr_comment_author',    7 );
add_filter( 'hybrid_attr_comment-published', 'hybridtheme_attr_comment_published', 7 );
add_filter( 'hybrid_attr_comment-permalink', 'hybridtheme_attr_comment_permalink', 7 );
add_filter( 'hybrid_attr_comment-content',   'hybridtheme_attr_comment_content',   7 );

/* === Structural === */

/**
 * <body> element attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_body( $attr ) {

	$class = apply_filters( 'maghoot_default_body_class', 'magazine-hoot' );
	$class = is_string( $class ) ? esc_attr( $class ) : '';
	$attr['class']     = join( ' ', get_body_class( $class ) );
	$attr['dir']       = is_rtl() ? 'rtl' : 'ltr';
	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'https://schema.org/WebPage';

	if ( is_singular( 'post' ) || is_home() || is_archive() )
		$attr['itemtype'] = 'https://schema.org/Blog';

	elseif ( is_search() )
		$attr['itemtype'] = 'https://schema.org/SearchResultsPage';

	return $attr;
}

/**
 * Page <header> element attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_header( $attr ) {

	$attr['id']        = 'header';
	$attr['class']     = 'site-header';
	$attr['role']      = 'banner';
	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'https://schema.org/WPHeader';

	return $attr;
}

/**
 * Page <footer> element attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_footer( $attr ) {

	$attr['id']        = 'footer';
	$attr['class']     = 'site-footer';
	$attr['role']      = 'contentinfo';
	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'https://schema.org/WPFooter';

	return $attr;
}

/**
 * Main content container of the page attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_content( $attr ) {

	$attr['id']       = 'content';
	$attr['class']    = 'content';
	$attr['role']     = 'main';

	if ( ! is_singular( 'post' ) && ! is_home() && ! is_archive() )
		$attr['itemprop'] = 'mainContentOfPage';

	return $attr;
}

/**
 * Sidebar attributes.
 *
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybridtheme_attr_sidebar( $attr, $context ) {

	$attr['class'] = 'sidebar';
	$attr['role']  = 'complementary';

	if ( $context ) {

		$attr['class'] .= " sidebar-{$context}";
		$attr['id']     = "sidebar-{$context}";

		$sidebar_name = hybrid_get_sidebar_name( $context );

		if ( $sidebar_name ) {
			// Translators: The %s is the sidebar name. This is used for the 'aria-label' attribute.
			$attr['aria-label'] = esc_attr( sprintf( _x( '%s Sidebar', 'sidebar aria label', 'hybrid-core' ), $sidebar_name ) );
		}
	}

	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'https://schema.org/WPSideBar';

	return $attr;
}

/**
 * Nav menu attributes.
 *
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybridtheme_attr_menu( $attr, $context ) {

	$attr['class'] = 'menu';
	$attr['role']  = 'navigation';

	if ( $context ) {

		$attr['class'] .= " menu-{$context}";
		$attr['id']     = "menu-{$context}";

		$menu_name = hybrid_get_menu_location_name( $context );

		if ( $menu_name ) {
			// Translators: The %s is the menu name. This is used for the 'aria-label' attribute.
			$attr['aria-label'] = esc_attr( sprintf( _x( '%s Menu', 'nav menu aria label', 'hybrid-core' ), $menu_name ) );
		}
	}

	$attr['itemscope']  = 'itemscope';
	$attr['itemtype']   = 'https://schema.org/SiteNavigationElement';

	return $attr;
}

/* === header === */

/**
 * <head> attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_head( $attr ) {

	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'https://schema.org/WebSite';

	return $attr;
}

/**
 * Branding (usually a wrapper for title and tagline) attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_branding( $attr ) {

	$attr['id']    = 'branding';
	$attr['class'] = 'site-branding';

	return $attr;
}

/**
 * Site title attributes.
 *
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybridtheme_attr_site_title( $attr ) {

	$attr['id']       = 'site-title';
	$attr['class']    = 'site-title';
	$attr['itemprop'] = 'headline';

	return $attr;
}

/**
 * Site description attributes.
 *
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybridtheme_attr_site_description( $attr ) {

	$attr['id']       = 'site-description';
	$attr['class']    = 'site-description';
	$attr['itemprop'] = 'description';

	return $attr;
}

/* === loop === */

/**
 * Archive header attributes.
 *
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybridtheme_attr_archive_header( $attr ) {

	$attr['class']     = 'archive-header';
	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'https://schema.org/WebPageElement';

	return $attr;
}

/**
 * Archive title attributes.
 *
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybridtheme_attr_archive_title( $attr ) {

	$attr['class']     = 'archive-title';
	$attr['itemprop']  = 'headline';

	return $attr;
}

/**
 * Archive description attributes.
 *
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybridtheme_attr_archive_description( $attr ) {

	$attr['class']     = 'archive-description';
	$attr['itemprop']  = 'text';

	return $attr;
}

/* === posts === */

/**
 * Post <article> element attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_post( $attr ) {

	$post = get_post();

	// Make sure we have a real post first.
	if ( ! empty( $post ) ) {

		$attr['id']        = 'post-' . get_the_ID();
		$attr['class']     = join( ' ', get_post_class() );
		$attr['itemscope'] = 'itemscope';

		if ( 'post' === get_post_type() ) {

			$attr['itemtype']  = 'https://schema.org/BlogPosting';

			/* Add itemprop if within the main query. */
			if ( is_main_query() && ! is_search() )
				$attr['itemprop'] = 'blogPost';
		}

		elseif ( 'attachment' === get_post_type() && wp_attachment_is_image() ) {

			$attr['itemtype'] = 'https://schema.org/ImageObject';
		}

		elseif ( 'attachment' === get_post_type() && hybrid_attachment_is_audio() ) {

			$attr['itemtype'] = 'https://schema.org/AudioObject';
		}

		elseif ( 'attachment' === get_post_type() && hybrid_attachment_is_video() ) {

			$attr['itemtype'] = 'https://schema.org/VideoObject';
		}

		else {
			$attr['itemtype']  = 'https://schema.org/CreativeWork';
		}

	} else {

		$attr['id']    = 'post-0';
		$attr['class'] = join( ' ', get_post_class() );
	}

	return $attr;
}

/**
 * Post title attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_entry_title( $attr ) {

	$attr['class']    = 'entry-title';
	$attr['itemprop'] = 'headline';

	return $attr;
}

/**
 * Post author attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_entry_author( $attr ) {

	$attr['class']     = 'entry-author';
	$attr['itemprop']  = 'author';
	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'https://schema.org/Person';

	return $attr;
}

/**
 * Post time/published attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_entry_published( $attr ) {

	$attr['class']    = 'entry-published updated';
	$attr['datetime'] = get_the_time( 'Y-m-d\TH:i:sP' );
	$attr['itemprop'] = 'datePublished';

	// Translators: Post date/time "title" attribute.
	$attr['title']    = get_the_time( _x( 'l, F j, Y, g:i a', 'post time format', 'hybrid-core' ) );

	return $attr;
}

/**
 * Post content (not excerpt) attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_entry_content( $attr ) {

	$attr['class'] = 'entry-content';

	if ( 'post' === get_post_type() )
		$attr['itemprop'] = 'articleBody';
	else
		$attr['itemprop'] = 'text';

	return $attr;
}

/**
 * Post summary/excerpt attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_entry_summary( $attr ) {

	$attr['class']    = 'entry-summary';
	$attr['itemprop'] = 'description';

	return $attr;
}

/**
 * Post terms (tags, categories, etc.) attributes.
 *
 * @access public
 * @param  array   $attr
 * @param  string  $context
 * @return array
 */
function hybridtheme_attr_entry_terms( $attr, $context ) {

	if ( !empty( $context ) ) {

		$attr['class'] = 'entry-terms ' . sanitize_html_class( $context );

		if ( 'category' === $context )
			$attr['itemprop'] = 'articleSection';

		else if ( 'post_tag' === $context )
			$attr['itemprop'] = 'keywords';
	}

	return $attr;
}


/* === Comment elements === */


/**
 * Comment wrapper attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_comment( $attr ) {

	$attr['id']    = 'comment-' . get_comment_ID();
	$attr['class'] = join( ' ', get_comment_class() );

	if ( in_array( get_comment_type(), array( '', 'comment' ) ) ) {

		$attr['itemprop']  = 'comment';
		$attr['itemscope'] = 'itemscope';
		$attr['itemtype']  = 'https://schema.org/Comment';
	}

	return $attr;
}

/**
 * Comment author attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_comment_author( $attr ) {

	$attr['class']     = 'comment-author';
	$attr['itemprop']  = 'author';
	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'https://schema.org/Person';

	return $attr;
}

/**
 * Comment time/published attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_comment_published( $attr ) {

	$attr['class']    = 'comment-published';
	$attr['datetime'] = get_comment_time( 'Y-m-d\TH:i:sP' );

	// Translators: Comment date/time "title" attribute.
	$attr['title']    = get_comment_time( _x( 'l, F j, Y, g:i a', 'comment time format', 'hybrid-core' ) );
	$attr['itemprop'] = 'datePublished';

	return $attr;
}

/**
 * Comment permalink attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_comment_permalink( $attr ) {

	$attr['class']    = 'comment-permalink';
	$attr['href']     = get_comment_link();
	$attr['itemprop'] = 'url';

	return $attr;
}

/**
 * Comment content/text attributes.
 *
 * @access public
 * @param  array   $attr
 * @return array
 */
function hybridtheme_attr_comment_content( $attr ) {

	$attr['class']    = 'comment-content';
	$attr['itemprop'] = 'text';

	return $attr;
}
