<?php
/**
 * jptheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package jptheme
 */

if ( ! function_exists( 'jptheme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function jptheme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on jptheme, use a find and replace
		 * to change 'jptheme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'jptheme', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'header-menu' => esc_html__( 'Header Menu', 'jptheme' ),
			'secondary' => esc_html__( 'Secondary', 'jptheme' ),
			'footer-menu' => esc_html__( 'Footer Menu' , 'jptheme'),
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

		// Set up the WordPress core custom background feature. remove if you don't want admin of the site to change default color
		add_theme_support( 'custom-background', apply_filters( 'jptheme_custom_background_args', array(
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
			'height'      => 100,
			'width'       => 100,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'jptheme_setup' );

/**
 * Register custom fonts.
 */
function jptheme_fonts_url() {
	$fonts_url = '';
	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Nunito Sans & Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$nunito_sans = _x( 'on', 'Nunito Sans font: on or off', 'jptheme' );
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'jptheme' );

	$font_families = array();
	if ( 'off' !== $nunito_sans) {
		$font_families[] = 'Nunito Sans:300,400,400i,600,900';
	}
	if ( 'off' !== $source_sans_pro) {
		$font_families[] = 'Source Sans Pro:400,400i,600,900';
	}

	if ( in_array( 'on', array($source_sans_pro, $nunito_sans))) {

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since jptheme 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function jptheme_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'jptheme-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'jptheme_resource_hints', 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jptheme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'jptheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'jptheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jptheme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'jptheme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'jptheme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'jptheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function jptheme_scripts() {
	// Enqueue Google Fonts: Nunito Sans & Source Sans Pro
	wp_enqueue_style( 'jptheme-fonts', jptheme_fonts_url());
	wp_enqueue_style( 'jptheme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jptheme-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );
	wp_localize_script( 'jptheme-navigation', 'jpthemeScreenReaderText', array(
		'expand' => __( 'Expand child menu', 'jptheme'),
		'collapse' => __( 'Collapse child menu', 'jptheme'),
	));

	wp_enqueue_script( 'jptheme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'jptheme-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20190219', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jptheme_scripts' );

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
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
