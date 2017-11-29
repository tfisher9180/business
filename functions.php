<?php
/**
 * Business functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Business
 */

if ( ! function_exists( 'business_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function business_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Business, use a find and replace
		 * to change 'business' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'business', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'business_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'business_setup' );

function business_nav_menus() {
	$nav_menus = array(
		'site-navigation' 			=> esc_html__( 'Site Navigation', 'business' ),
		'secondary-navigation'	=> esc_html__( 'Secondary Navigation', 'business' ),
	);

	if ( get_theme_mod( 'separate_desktop_mobile_menu' ) == 1 ) {
		$nav_menus[ 'mobile-navigation' ] = esc_html__( 'Mobile Navigation', 'business' );
		if ( ! wp_get_nav_menu_object( 'Mobile Navigation' ) ) {
			if ( ! has_nav_menu( 'mobile-navigation' ) ) {
				$menu_id = wp_create_nav_menu( 'Mobile Navigation' );
				$locations = get_theme_mod( 'nav_menu_locations' );
				$locations[ 'mobile-navigation' ] = $menu_id;
				set_theme_mod( 'nav_menu_locations', $locations );
			}
		}
	}
	// This theme uses wp_nav_menu() in two-three locations.
	register_nav_menus( $nav_menus );
}
add_action( 'after_setup_theme', 'business_nav_menus' );

function business_sync_nav_menus( $nav_menu_id ) {
	if ( did_action( 'wp_update_nav_menu' ) === 1 ) {
		if ( get_theme_mod( 'separate_desktop_mobile_menu' ) == 1 ) {
			$menus = get_theme_mod( 'nav_menu_locations' );
			if ( array_search( $nav_menu_id, $menus ) === 'site-navigation' ) {
				// the updated menu is assigned to the site-navigation menu location
				$mobile_navigation_id = get_term( $menus[ 'mobile-navigation' ], 'nav_menu' )->term_id;

				$site_navigation_menu_items = wp_get_nav_menu_items( $nav_menu_id );
				$mobile_navigation_menu_items = wp_get_nav_menu_items( $mobile_navigation_id );

				$site_navigation_menu_items = json_decode( json_encode( $site_navigation_menu_items ), true );
				$mobile_navigation_menu_items = json_decode( json_encode( $mobile_navigation_menu_items ), true );

				$menu_items = array_diff( $site_navigation_menu_items, $mobile_navigation_menu_items );
				var_dump( $menu_items );

				foreach ( $menu_items as $index => $info ) {
					$menu_data = array(
						'menu-item-db-id'				=> $info[ 'db_id' ],
						'menu-item-object-id' 	=> $info[ 'object_id' ],
						'menu-item-object' 			=> $info[ 'object' ],
						'menu-item-parent-id' 	=> $info[ 'post_parent' ],
						'menu-item-position' 		=> $info[ 'menu_order' ],
						'menu-item-type' 				=> $info[ 'type' ],
						'menu-item-title' 			=> $info[ 'title' ],
						'menu-item-url' 				=> $info[ 'url' ],
						'menu-item-description' => $info[ 'description' ],
						'menu-item-attr-title' 	=> $info[ 'attr_title' ],
						'menu-item-target' 			=> $info[ 'target' ],
						'menu-item-classes' 		=> implode( " ", $info[ 'classes' ] ),
						'menu-item-xfn' 				=> $info[ 'xfn' ],
						'menu-item-status' 			=> $info[ 'post_status' ]
					);
					wp_update_nav_menu_item( $mobile_navigation_id, 0, $menu_data );
				}
			}
		}
	}
}
add_action( 'wp_update_nav_menu', 'business_sync_nav_menus' );

function business_fonts_url() {
	$fonts_url = '';
	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Montserrat, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$font_families = array();

	$montserrat = _x( 'on', 'Montserrat font: on or off', 'business' );

	if ( 'off' !== $montserrat ) {
		$font_families[] = 'Montserrat:300,400,500,600,700';
	}

	if ( in_array( 'on', array( $montserrat ) ) ) {
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	return esc_url_raw( $fonts_url );
}

function business_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'business-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'business_resource_hints', 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function business_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'business_content_width', 640 );
}
add_action( 'after_setup_theme', 'business_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function business_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'business' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'business' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'business_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function business_scripts() {
	wp_enqueue_style( 'business-fonts', business_fonts_url() );

	wp_enqueue_style( 'business-style', get_stylesheet_uri() );

	wp_enqueue_script( 'business-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20151215', true );
	wp_localize_script( 'business-navigation', 'businessScreenReaderText', array(
		'expand'					=> __( 'Expand child menu', 'business' ),
		'collapse'				=> __( 'Collapse child menu', 'business' ),
	));

	wp_enqueue_script( 'business-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'business_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
