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

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'site-navigation' 			=> esc_html__( 'Site Navigation', 'business' ),
			'secondary-navigation'		=> esc_html__( 'Secondary Navigation', 'business' ),
		) );

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

function business_get_social_menu_markup() {
	$social_networks = array(
		'facebook'			=> get_theme_mod( 'url_facebook' ),
		'twitter'			=> get_theme_mod( 'url_twitter' ),
		'instagram'			=> get_theme_mod( 'url_instagram' ),
		'google-plus'		=> get_theme_mod( 'url_google' ),
		'linkedin'			=> get_theme_mod( 'url_linkedin' ),
	);

	$active_social_networks = array_filter( $social_networks, function( $value, $key ) {
		return $value; // return where true
	}, ARRAY_FILTER_USE_BOTH ); // for clarity

	if ( ! empty( $active_social_networks ) ) : ?>
		<div class="social">
		<?php foreach( $active_social_networks as $network => $url ) { ?>

			<a href="<?php printf( esc_html__( '%s', 'business' ), esc_url( trim( $url ) ) ); ?>" target="_blank" class="icon icon-<?php printf( esc_attr__( '%s', 'business' ), strtolower( $network ) ); ?>">
				<span class="screen-reader-text"><?php printf( esc_html__( '%s', 'business' ), ucwords( $network ) ); ?></span>
				<i class="fa fa-<?php printf( esc_html__( '%s', 'business' ), strtolower( $network ) ); ?>"></i>
			</a>

		<?php } ?>
		</div>
	<?php endif;
}

function business_get_business_info_markup() {
	$options = array(
		'display_full_address'						=> get_theme_mod( 'display_full_address' ),
		'show_business_info_icons'				=> get_theme_mod( 'show_business_info_icons' ),
		'show_business_info_city-state'		=> get_theme_mod( 'show_business_info_address' ),
		'show_business_info_email'				=> get_theme_mod( 'show_business_info_email' ),
		'show_business_info_phone'				=> get_theme_mod( 'show_business_info_phone' ),
	);

	$fields = array(
		'city-state'				=> array(
			'icon' 			=> 'map-marker',
			'theme_mod'	=> get_theme_mod( 'business_city_state' ),
		),
		'address'						=> array(
			'icon'			=> '',
			'theme_mod'	=> get_theme_mod( 'business_address' ),
		),
		'email'							=> array(
			'icon'			=> 'envelope',
			'theme_mod'	=> get_theme_mod( 'business_email' ),
		),
		'phone'							=> array(
			'icon'			=> 'phone',
			'theme_mod'	=> get_theme_mod( 'business_phone' ),
		),
	);

	$active_options = array_filter( $options, function( $value, $key ) {
		return $value;
	}, ARRAY_FILTER_USE_BOTH ); // for clarity

	$active_fields = array_filter( $fields, function( $value, $key ) {
		return $value[ 'theme_mod' ];
	}, ARRAY_FILTER_USE_BOTH ); // for clarity

	if ( ! empty( $active_options ) || ! empty( $active_fields ) ) : ?>
		<div class="business-information">

		<?php if ( $options[ 'display_full_address' ] == 1 ) :
			$active_fields[ 'city-state' ][ 'theme_mod' ] = $active_fields[ 'address' ][ 'theme_mod' ] . ', ' . $active_fields[ 'city-state' ][ 'theme_mod' ];
		endif; ?>

		<?php foreach( $active_fields as $field => $info_arr ) {
			if ( $field == 'address' ) :
				continue;
			endif;

			if ( $options[ 'show_business_info_'.$field ] == 1 ) : ?>
			<div class="<?php echo esc_attr( $field ); ?>">
				<?php if ( $options[ 'show_business_info_icons' ] == 1 && $info_arr[ 'icon' ] ) : ?>
					<span class="icon fa fa-<?php echo esc_attr( $info_arr[ 'icon' ] ); ?>"></span>
				<?php endif; ?>
					<span><?php esc_html_e( $info_arr[ 'theme_mod' ] ); ?></span>
			</div>
			<?php endif;
		} ?>

		</div>
	<?php endif;
}

function business_navigation_localize_vars() {
	$businessNavigation = array();
	$businessNavigation[ 'screenReaderText' ] = array(
		'expand'					=> __( 'Expand child menu', 'business' ),
		'collapse'					=> __( 'Collapse child menu', 'business' ),
	);

	if ( get_theme_mod( 'overview_pages' ) == 1 ) {
		$businessNavigation[ 'menus' ] = array(
			'overview'				=> __( 'Overview', 'business' ),
		);
	}

	return $businessNavigation;
}

/**
 * Enqueue scripts and styles.
 */
function business_scripts() {
	wp_enqueue_style( 'business-fonts', business_fonts_url() );

	wp_enqueue_style( 'business-style', get_stylesheet_uri() );

	wp_enqueue_script( 'business-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20151215', true );
	wp_localize_script( 'business-navigation', 'businessNavigation', business_navigation_localize_vars() );

	wp_enqueue_script( 'business-functions', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20151215', true );

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
