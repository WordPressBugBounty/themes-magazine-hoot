=== Magazine Hoot ===
Contributors: wphoot
Tags: one-column, two-columns, three-columns, left-sidebar, right-sidebar, block-styles, custom-background, custom-colors, custom-menu, custom-logo, featured-images, footer-widgets, full-width-template, microformats, sticky-post, theme-options, threaded-comments, translation-ready, wide-blocks, entertainment, education, news
Requires at least: 5.4
Tested up to: 6.6
Requires PHP: 7.4
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html

Magazine Hoot is a responsive WordPress theme with a bold modern design.

== Description ==

Magazine Hoot is a responsive WordPress theme with a bold modern design. For more information about Magazine Hoot please go to https://wphoot.com/themes/magazine-hoot/ Theme support is available at https://wphoot.com/support/ You can also check out the theme instructions at https://wphoot.com/support/magazine-hoot/ and demo at https://demo.wphoot.com/magazine-hoot/ for a closer look.

== Frequently Asked Questions ==

= How to install Magazine Hoot =

1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Type in 'Magazine Hoot' in the search form and press the 'Enter' key on your keyboard.
3. Click on the 'Activate' button to use your new theme right away.

= How to get theme support =

You can look at the theme instructions at https://wphoot.com/support/magazine-hoot/ To get support beyond the scope of documentation provided, please open a support ticket via https://wphoot.com/support/

== Changelog ==

= 1.11.2 =
* # Hybrid 4.0.0 HybridExtend 2.2.10 #
* bugfix: Remove label 'With' when no comments and comments are closed
* Fix image link for hoot import
* Fix links typo

= 1.11.1 =
* # Hybrid 4.0.0 HybridExtend 2.2.10 #
* Fix customizer flypanel display minor bug
* WooCommerce Cart and Checkout Block Styling
* WooCommerce buttons styling
* Dont load Maghoot_WPTT_WebFont_Loader if option not active in customizer
* Update WooCommerce Templates

= 1.11.0 =
* # Hybrid 4.0.0 HybridExtend 2.2.10 #
* Fix "Creation of dynamic property is deprecated" for PHP 8.2
* Compatibility with Hoot Import plugin
* Option to load Google Fonts locally
* Update to google fonts css2

= 1.10.0 =
* # Hybrid 4.0.0 HybridExtend 2.2.10 #
* Update woocommerce template to 8.6.0
* Add X (twitter) to Social Profiles
* Update facebook brand colors to the new vibrant blue (Ticket#10949)
* Fix alignment for wide and full in block-media-text (Ticket#11369)
* Fix cropping of 'file' block in frontend (Ticket#11625)

= 1.9.25 =
* # Hybrid 4.0.0 HybridExtend 2.2.10 #
* Add discord and whatsapp options in social profiles
* Fix Gallery Block layout issue on certain installations (Ticket#11387 Ticket#11371)
* Fix lightSlider script for jquery >= 3.0 (Ticket#11596)
* Fix PHP error when default top level variables are not global by default (Ticket#11381)

= 1.9.24 =
* # Hybrid 4.0.0 HybridExtend 2.2.10 #
* Fix: get_header returns boolean instead of array Ticket#11267
* Fix Jetpack infinite scroll for WooCommerce Products view
* Add button style to File block's Download link Ticket#11222
* Remove sizing for elementor WC widgets (products grid) which adds flex grid Ticket#11215
* Fix: WC plugin: iframe offset inside chekout fields made it difficult to select input fields Ticket#11252

= 1.9.23 =
* # Hybrid 4.0.0 HybridExtend 2.2.10 #
* Fix nested gallery css in admin
* Add Site Title to Image Logo inside <h1> for better SEO #11064
* Update facebook brand color #10949

= 1.9.22 =
* # Hybrid 4.0.0 HybridExtend 2.2.10 #
* Fix gallery css for WP 5.9

= 1.9.21 =
* # Hybrid 4.0.0 HybridExtend 2.2.10 #
* Updated Font Awesome to 5.15.3 (increase icons from 991 to 1608 )
* Added TikTok to Social Icons List
* Replace deprecated 'jetpack_lazy_images_blacklisted_classes' with 'jetpack_lazy_images_blocked_classes' filter

= 1.9.20 =
* # Hybrid 4.0.0 HybridExtend 2.2.10 #
* Change conditional tags used in content-page.php to display full content for custom post types (Tribe single event and events pages) and excerpts for rest (including Category Tag Pages)
* Minor css fix for Tribe Default Template (li bullets and margins)

= 1.9.19 =
* # Hybrid 4.0.0 HybridExtend 2.2.10 #
* Fix: Allow plugins like Tribe to use full content page templates (removes <untitled> page title and fixes <li> css on event pages)
* Remove redundant tribe event code in favor of above fix
* Minor Fix: Tribe single event page css

= 1.9.18 =
* # Hybrid 4.0.0 HybridExtend 2.2.10 #
* Skip version

= 1.9.17 =
* # Hybrid 4.0.0 HybridExtend 2.2.10 #
* Add theme support for 'wp-block-styles' and 'custom-spacing'
* Fix widget name issue with SiteOrigins Page Builder

= 1.9.16 =
* # Hybrid 4.0.0 HybridExtend 2.2.9 #
* Improved CSS for WordPress Core Blocks (Media&Text, Cover, Blockquote, Pullquote, Verse)
* Improved CSS for WordPress Block Alignments (Wide, Full)
* Refactor code to combine all block related code and add block related tags
* Updated stylesheet (and dynamic css) enqueue priorities and handles for better management of dependent styles (blocks, hootkit etc)
* Compatibility with Legacy_Widget_Block_WP5.8_beta1 (checked upto RC1)

= 1.9.15 =
* # Hybrid 4.0.0 HybridExtend 2.2.8 #
* Add accent color and font accent color to block palette
* Add 'nohighlight' class to menu items to skip css for 'current-menu-item' - useful for scrollpoints (ticket#10227)
* Preload font icons to improve Page Speed Score (ticket#10244)
* Check for parent theme object before (fixes bug where it returns false) (ticket#10248)
* Compatibility with Legacy_Widget_Block_WP5.8_beta1
* Fixed widget group bug (pass $this->number to js to assign correct fieldnames)

= 1.9.14 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Update function hooked to 'get_the_archive_title' to remove prefixes, and use 'get_the_archive_title_prefix' hook instead
* Fix css for page title background (parallax,nocrop) when used on Elementor Pages (ticket#10161 followup:#10071)
* Fix css for forminator plugin (ticket#10151)
* Recommend classic widgets plugin (tgmpa) for wordpress 5.8

= 1.9.13 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Buddypress compatibility: Remove loop meta, fix alignwide margins, display the_content (content.php template) and on BP pages
* Remove WC bug fix (v1.5CDR@2016) (runs get_queried_object) to fix empty global $authordata for author page loop meta with WP5.7
* Fix formatting for wp 'code' block
* Auxillary css for Elementor 'Hide Title' option (ticket#10071)
* Add archive-wrap div wrap to woocommerce products archive template
* Fix infinite scroll button display with mosaic layout - add archive-wrap div wrap to index template

= 1.9.12 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Added patreon to social profile widget
* Temporarily remove Gutenberg Widgets Screen
* Add theme support for Gutenberg Wide Align (ticket#9032)
* Fix Buddypress menu item conflict with calling 'maghoot_nav_menu_toplevel_items' during init action @0priority (when bp item is added to main theme nav secondary location)

= 1.9.11 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Woocommerce heading styles (related, upsell, cross-sells)
* Add theme-name to body class
* Fix input:focus and placeholder text color for topbar/container with custom background
* Fix edge case: ios mobile add superfish js delay
* Fix menu 'jump' due to dropdown menu arrow and fix megamenu icon width

= 1.9.10 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Skip Version

= 1.9.9 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Fix container class for jetpack infinite-scroll (when frontpage set to display blog)
* Fix compatibility with wp-megamenu plugin (plugin css hiding logo area)

= 1.9.8 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Update sanitization for text in sortlist to wp_kses_post
* Misc Woocommerce stylings (tabs on single product page, pagination, buttons, table radius)
* Improved pagination styling - archive, post links, woocommerce
* Added Options builder helper product functions
* Fix block button when user adds the button class manually (to display theme's button style)
* Updated deprecated syntax (jQuery 3.0) in parallax script from .on('ready',handler) to $(handler) https://api.jquery.com/ready/

= 1.9.7 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Fix for AMP menu with fixed menu javascript
* CSS fix for Image block (caption overflow image in default settings) and Cover block (image overflow due to padding)

= 1.9.6 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Mobile Fixed Menu - Fix display for logged in users with admin bar
* Improve accessibility - fix keyboard navigation issues (menu, mobile menu, search widget etc)

= 1.9.5 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Remove WC 4.4 bug fix from last update (bug removed in WC 4.4.1)
* Remove top/bottom margin for main content area added in last update (fixes no space issue in certain displays theme)

= 1.9.4 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Fix woocommerce pagination display on archive pages (woocommerce 4.4)
* Fix woocommerce column display on archive pages (woocommerce 4.4)
* Remove column/total item options in favor of WC default options

= 1.9.3 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* AMP support for search (remove JS for input text field)
* Return empty read more text for feed
* Fix: color rgba sanitization in style builder for dynamic css
* Fix Safari bug for sidebars when percentage width gets rounds up (in flex model)
* Fix menu item color in customizer preview (shifts by 1 place due to partial-edit-shortcut icon when nth-child used in css.php)

= 1.9.2 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Fix site title with icon (flex to inline flex) when branding is center of header
* Removed orphan sourceMappingURL from third party library files
* AMP plugin support
* Fix mobile safari bug when telephone numbers are automatically converted to links with hidden font color
* Minor fix: Removed for attribute for label in search form widget
* Fix mosaic layout for blog when displayed on frontpage - add archive-wrap div wrap
* Bug fix: Sidebar did not display in frontpage content module if "Hoot > Blog Posts" widget used in an area before it
* Removed deprecated second argument from get_terms function

= 1.9.1 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* CSS for block elements in WP5.4 (social icons)
* CSS for block editor dropcap, generic font sizes used in blocks, other minor adjustments
* Update 'get_the_archive_title' hooked function to remove prefixes from translated WordPress strings as well
* Remove deprecated array offset using {} for PHP 7.4 (ticket#8681)

= 1.9.0 =
* # Hybrid 4.0.0 HybridExtend 2.2.7 #
* Updated Requires at least, Tested up to and Requires PHP tags in style.css and readme.txt
* Add sidebar layout option for archives/blog to lite
* CSS updates for Block gallery (margins for gallery grid, Gallery Captions, image captions)
* Various CSS fixes and other minor adjustments
* Add script for interlinking customizer control/section/panel
* Improved hybridextend_get_attr function to accept classes when other custom attributes also present
* Refactor frontpage template code
* Fix Customizer Settings Priorities
* Add separate sidebar layout option for frontpage content block (blog / static page)
* Remove HootKit and TGMPA code

= 1.8.7 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Hide Menu Toggle when Max Mega Menu active
* Add font-display:swap to font icons (fixes Google Pagespeed error: Ensure text remains visible during webfont load)
* Check for parent theme object before assigning parent theme details to framework variables (fixes edge case scenario on certain server configurations)
* Add 'entry-title' class to h1.loop-title (to make title compatibile with Elementor hide-title option)
* Remove filter=5 attribute from wordpress.org review url

= 1.8.6 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Polylang menu flag image alignment
* Fix bbPress Forums view (archive view was being displayed instead of forums list)
* Fix title/descriptions for bbPress User view, Single Forum view, Forums view

= 1.8.5 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Add gravatar to loop meta for authors

= 1.8.4 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Internal Version. Not Released

= 1.8.3 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Update ul.wp-block-gallery css for WP 5.3 compatibility
* Added HTML5 Supports Argument for Script and Style Tags for WP 5.3
* Added semibold option for typography settings
* Fix custom logo bug (fix warning when default value does not have all options defined for sortitem line)
* Apply filter to frontpage id index for background options
* CSS fix for sortitem checkbox input in customizer
* CSS fix for woocommerce message button on small screen (ticket#4621)
* Upgrade logo-with-icon from Table to Flexbox
* Add filter for Custom Text Logo

= 1.8.2 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Logo and Site Description css fixes
* Fix social icons widget color for footer nand invert/non-invert topbar

= 1.8.1 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Accessibility Improvements: Skip to Content link fixed
* Accessibility Improvements: Keyboard Navigation improved (link and form field outlines, improved button focus visual)
* Removed min-width for grid (mobile view)
* Fix iframe and embed margins in wp embed blocks
* Fix label max-width for contact forms to display properly on mobile
* Fix for woocommerce pagination when inifinite scroll is active
* Fix required fonticon for Contact Form 7 plugin
* Bug Fix: Add space for loop-meta-wrap class (for mods)
* Remove comma in inline background-image css (to prevent escape attribute which confuses lazy load plugins)

= 1.8.0 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Remove shim for the_custom_logo
* Fix: Inline menu display css fix with mega menu plugin
* Apply filter on arguments array for the_posts_pagination
* Add help link to One Click Demo documentation
* Replace support for HootKit with OCDI plugin

= 1.7.8 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Removed One Click Demo for compatibility with TRT guidelines
* Removed admin_list_item_count limit
* CSS fix: last menu item dropdown
* Added missing argument for 'the_title' filter to prevent error with certain plugins
* Remove shim for the_custom_logo

= 1.7.7 =
* Internal Version. Not Released

= 1.7.6 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Added sortable capability to widgets group type

= 1.7.5 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Added support for 'inherit' value in css sanitization for dynamic css build
* Bug fix for 'box-shadow' property in css sanitization for dynamic css build
* Bug fix by unsetting selective refresh from passing into $settings array in customizer interface builder

= 1.7.4 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Added the new 'wp_body_open' function
* Improved dynamic css for ajax login form

= 1.7.3 =
* # Hybrid 4.0.0 HybridExtend 2.2.6 #
* Added Tribe 'The Events Calendar' plugin support - template fixes
* Improved logic for maghoot_get_mod function

= 1.7.2 =
* # Hybrid 4.0.0 HybridExtend 2.2.5 #
* Add css support for Gutenberg gallery block
* Fix parallax image misalignment on load when lightslider is present
* Sanitize debug data for logged in admin users

= 1.7.1 =
* Internal Version. Not Released

= 1.7.0 =
* # Hybrid 4.0.0 HybridExtend 2.2.5 #
* Fix <!--default--> content for postfooter in new theme installations
* Removed older IE css support
* Fixed Color class name
* Removed minified script/style from admin
* Add support for selective refresh in customizer settings
* Added HootKit support
* One click demo import support added (via HootKit plugin)
* Updated welcome page to help users with OCDI
* Added TGMPA library to recommend HootKit

= 1.6.6 =
* # Hybrid 4.0.0 HybridExtend 2.2.4 #
* Improved 404 handeling using default wordpress template
* 404 template update
* Fix: Frontpage section action hook passes $type instead of $key
* Fix: Jetpack lazy load exception for slider images
* Update schema links from http:// to https://
* Add helper messages to sidebars
* Use 'nav_menu_item_title' filter for menu instead of extending Walker_Nav_Menu
* Remove document title filters (not needed for new wp versions)
* Remove archive description filter (not needed for new wp versions)
* Update Wordpress to WordPress for display in enum sets
* Sortlist - add otpion for default open (custom module)

= 1.6.3 =
* # Hybrid 4.0.0 HybridExtend 2.2.3 #
* Improved frontpage template for easy modification (separate content-blog/page cases)
* Display a message in inactive sidebars instead of hiding them
* Removed deprecated attribte filters for content block image
* Added 'hybridextend_get_template_part' function
* Improved the way 'hybridextend_get_attr' handles custom classes param
* Improved headings for better SEO
* Added 'loop_meta_displayed' flag
* Escaped custom site_info (post footer content)
* Fixed google font url syntax
* Fixed review url
* Added open state to customize sortlist, added radio/radioimage option to sortlist items
* Removed $global variable for base directory path (error on some servers)
* Added limit constraint to group type in widgets
* Set default grid to max choice available for calculating image size
* Improved enum font size function
* Updated get_temrs (taxonomy) args for latest WP version in widgets admin

= 1.6.2 =
* # Hybrid 4.0.0 HybridExtend 2.2.2 #
* Minor js bug fix to work with Page Builder plugin

= 1.6.1 =
* # Hybrid 4.0.0 HybridExtend 2.2.2 #
* Use SCRIPT_DEBUG to define HYBRIDEXTEND_DEBUG
* Remove empty div containers if no slider to show (widgetized template)
* Add filters for titles in included widgets
* Add Privacy Policy page (if defined) to default Post Footer text - GDPR compliance
* Add 'maghoot_searchresults_hide_pages' filter instead of global variable
* Add hook to filter google font query
* Fixed 'View All' links display in Post Grid and Post List widget

= 1.6.0 =
* # Hybrid 4.0.0 HybridExtend 2.2.2 #
* Fixed 'main-content-grid' class for Frontpage Template
* Fixed CSS class for Frontpage Page Content (when set to static Page)
* Improve Post Grid and Post List widget's thumbnail display (added image size option)
* Post Grid widget - option to hide title; separate categories option for non-first posts
* Content Block Page widget - excerpt length option
* Improved implementation of Widget Margin option
* Remove Edit link from Meta information in non archive and non singular context
* Register sidebars even when not displayed (added a note message to inform users)
* Fixed: Widget color options display hexa input field
* Fixed: Widget color option in customizer screen not responsive when widget added for first time
* 'startwrap' option (css class) for customizer group types
* Load minified assets (admin) in customizer screen if available
* Improved customizer css (admin) styles
* Improved Framework constants

= 1.5.4 =
* # Hybrid 4.0.0 HybridExtend 2.2.1 #
* Removed redundant update_browser notification
* Pass type argument for lite_slider filter hook
* Allow style builder to store dynamic css as variable (for external stylesheet plugin)
* Add hooks to modify query hooks for content block widgets
* Bug Fix: Image display (post-list and post-grid widgets) with Lazy Load plugins

= 1.5.3 =
* # Hybrid 4.0.0 HybridExtend 2.2.1 #
* Added backward compatibility for font icons for plugins using older version (missing font names)

= 1.5.1 =
* # Hybrid 4.0.0 HybridExtend 2.2.1 #
* Updated Font Awesome Version for Enqueue

= 1.5.0 =
* # Hybrid 4.0.0 HybridExtend 2.2.1 #
* Updated Font Awesome Library 5.0.10
* CSS fix for Comment Respond Form checkboxes
* Updated woocommerce template (archive-product) to v3.4.0
* Removed redundant Customizer Premium upsell code
* Jetpack Infinite Scroll fix

= 1.4.5 =
* # Hybrid 4.0.0 HybridExtend 2.2.0 #
* Add 'current' status to individual slides during render
* Hide empty entry-byline block when nothing to show
* Allow social profile enum to skip skype and email when not needed
* Fix link and link hover color css for footer
* Add filter for post grid widget query

= 1.4.4 =
* # Hybrid 4.0.0 HybridExtend 2.2.0 #
* Fixed menu hover z-index css
* Remove override mod value filter from maghoot_get_mod function
* Add tagline display option for image logo
* Update sanitization filter for values returned using maghoot_get_mod function
* Post grid widget uses meta_query in custom query to return posts with thumbnails only
* Post grid widget : Link images as well to the Title URL

= 1.4.1 =
* # Hybrid 4.0.0 HybridExtend 2.2.0 #
* Prefixed filter names in various files
* Fix: font awesome version number for enqueue
* Fix: Customizer CSS for latest WP version

= 1.4.0 =
* # Hybrid 4.0.0 HybridExtend 2.2.0 #
* Initial release.

== Upgrade Notice ==

= 1.9 =
* This is the officially supported stable release version. Please update to this version before opening a support ticket.

== Resources ==

= This Theme has code derived/modified from the following resources all of which, like WordPress, are distributed under the terms of the GNU GPL =

* Underscores WordPress Theme, Copyright 2012 Automattic http://underscores.me/
* Hybrid Core Framework v3.0.0, Copyright 2008 - 2015, Justin Tadlock  http://themehybrid.com/
* Hybrid Base WordPress Theme v1.0.0, Copyright 2013 - 2015, Justin Tadlock  http://themehybrid.com/
* Customizer Library v1.3.0, Copyright 2010 WP Theming http://wptheming.com

= This theme bundles the following third-party resources =

* FitVids http://fitvidsjs.com/ Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com : WTFPL license http://sam.zoy.org/wtfpl/
* Modernizr http://modernizr.com/ Copyright 2009—2014 : MIT License
* lightSlider http://sachinchoolur.github.io/lightslider/ Copyright sachi77n@gmail.com : MIT License
* Superfish https://github.com/joeldbirch/superfish/ Copyright Joel Birch : MIT License
* Font Awesome http://fontawesome.io/ Copyright (c) 2015, Dave Gandy : SIL OFL 1.1 (Font) MIT License (Code)
* TRT Customizer Pro https://github.com/justintadlock/trt-customizer-pro Copyright 2016 Justin Tadlock : GNU GPL Version 2
* Parallax http://pixelcog.com/parallax.js/ Copyright 2016 PixelCog Inc. : MIT License

= This theme screenshot contains the following images =

* Image: Milk Splash https://pxhere.com/en/photo/1279611 : CC0
* Image: Coffee Time https://www.pexels.com/photo/5686 : CC0
* Image: Girl resting with legs on a white chair https://www.pexels.com/photo/6344 : CC0
* Image: Nature Landscape https://stocksnap.io/photo/GR25DDD39V : CC0
* Image: Leek and potato soup / hand https://www.pexels.com/photo/5793 : CC0
* Image: Create Art https://stocksnap.io/photo/Z30Y4VKJBT : CC0
* Image: Fruit Tea https://www.pexels.com/photo/5798 : CC0
* Image: Hand with oil pastel draws the heart https://www.pexels.com/photo/6333 : CC0
* Image: Apple iPhone 6 Plus on a white desk https://www.pexels.com/photo/6438 : CC0
* Image: Creative Desk Pens School https://www.pexels.com/photo/2091 : CC0
* Image: Architecture Eiffel Tower https://pxhere.com/en/photo/727850 : CC0
* Image: Man Couch Working https://www.pexels.com/photo/7066 : CC0

= Bundled Images: The theme bundles patterns =

* Background Patterns, Copyright 2015, wpHoot : CC0

= Bundled Images: The theme bundles composite images in /include/admin/images using the following resources =

* Misc UI Grpahics, Copyright 2015, wpHoot : CC0
* Image: Wild Hair https://pxhere.com/en/photo/606493 : CC0
* Image: Wood Spice Cooking https://pxhere.com/en/photo/444 : CC0
* Image: Desk https://pxhere.com/en/photo/1434235 : CC0
* Image: Analysis Background https://pxhere.com/en/photo/1445331 : CC0
* Image: Aerial Background https://pxhere.com/en/photo/1430841 : CC0
* Image: Article Assortment https://pxhere.com/en/photo/1452883 : CC0
* Image: Avatar Network https://pxhere.com/en/photo/1444327 : CC0
* Image: Mans Avatar https://publicdomainvectors.org/en/free-clipart/Mans-avatar/49761.html : CC0
* Image: Man with beard https://publicdomainvectors.org/en/free-clipart/Man-with-beard-profile-picture-vector-clip-art/16285.html : CC0
* Image: Faceless Female Avatar https://publicdomainvectors.org/en/free-clipart/Faceless-female-avatar/71113.html : CC0