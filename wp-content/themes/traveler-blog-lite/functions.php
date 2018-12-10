<?php
/**
 *  Traveler Blog Lite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Traveler Blog Lite
 * @since 1.0.1
 */

// Defining Some Variable
if( !defined( 'TRAVELER_BLOG_LITE_VERSION' ) ) {
	define('TRAVELER_BLOG_LITE_VERSION', '1.0.2'); // Theme Version
}
if( !defined( 'TRAVELER_BLOG_LITE_DIR' ) ) {
	define( 'TRAVELER_BLOG_LITE_DIR', get_template_directory() ); // Theme dir
}
if( !defined( 'TRAVELER_BLOG_LITE_URL' ) ) {
	define( 'TRAVELER_BLOG_LITE_URL', get_template_directory_uri() ); // Theme url
}


// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 1170;
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function traveler_blog_lite_setup() {
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Traveler Blog Lite, use a find and replace
	 * to change 'traveler-blog-lite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'traveler-blog-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
        
        // This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
        
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );	   

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(		
		'main-menu' 	=> esc_html__( 'Main Menu', 'traveler-blog-lite' ),
		'top-menu' 	=> esc_html__( 'Top Menu', 'traveler-blog-lite' ),
		'footer-menu' 	=> esc_html__( 'Footer Menu', 'traveler-blog-lite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'traveler_blog_lite_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for custom logo.
	add_theme_support( 'custom-logo' );

	// Post format.
	add_theme_support( 'post-formats', array('video', 'audio', 'quote', 'gallery'));
	
}
add_action( 'after_setup_theme', 'traveler_blog_lite_setup' );

/**
 * Admin Welcome Notice
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_admin_welcom_notice() {
	global $pagenow;

	if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' === $pagenow ) {
		echo '<div class="updated notice notice-success is-dismissible"><p>'.sprintf( __( 'Thank you for choosing Traveler Blog Lite Blog Theme. To get started, visit our <a href="%s">welcome page</a>.', 'traveler-blog-lite' ), esc_url( admin_url( 'themes.php?page=traveler-blog-lite' ) ) ).'</p></div>';
	}
}
add_action( 'admin_notices', 'traveler_blog_lite_admin_welcom_notice' );


/**
 * Handles Post Classes
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_render_post_classes( $classes ) {
	global $post_count,$count;
	$wrapper = has_post_thumbnail();   

	if ( $wrapper ) {
		$classes[] = 'blog_design-has-thumbnail';
	}
	if(is_home()) {
		$blog_layout_grid 	= traveler_blog_lite_get_theme_mod( 'blog_layout_grid' );
		$classes[] = 'traveler-blog-lite-columns traveler-blog-lite-masonry traveler-blog-lite-col-'.$blog_layout_grid;        

	} else if( is_search() || is_author() ) {         
        $classes[] = 'traveler-blog-lite-columns traveler-blog-lite-masonry traveler-blog-lite-col-4';                
	} else if( (is_category() || is_archive() || is_tag()) && ( (class_exists('WooCommerce') && !is_post_type_archive('product')) || !class_exists('WooCommerce') ) ) { // Category Page
		$cat_layout_grid 	= traveler_blog_lite_get_theme_mod( 'cat_layout_grid' );        
        $classes[] = 'traveler-blog-lite-columns traveler-blog-lite-masonry traveler-blog-lite-col-'.$cat_layout_grid;     
              
	}
	 return $classes;
	}

add_filter( 'post_class', 'traveler_blog_lite_render_post_classes' );
/**
	* Register Sidebars
	* 
	* @package Traveler Blog Lite
	* @since 1.0
	*/
	function traveler_blog_lite_register_sidebar() {

		// Main Sidebar Area
		register_sidebar( array(
			'name'          => esc_html__( 'Main Sidebar', 'traveler-blog-lite' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Appears on posts and pages.', 'traveler-blog-lite' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		
		

		// Footer Sidebar Area
		register_sidebar( array(
			'name'          => esc_html__( 'Footer', 'traveler-blog-lite' ),
			'id'            => 'footer',
			'description'   => esc_html__( 'Footer Widhet Area : Add widgets here.', 'traveler-blog-lite' ),
			'before_widget' => '<section id="%1$s" class="widget traveler-blog-lite-columns '. traveler_blog_lite_footer_widgets_cls( 'footer' ) .' %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));

		// Footer Instgarm Widget Area
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Instgarm Widget Area', 'traveler-blog-lite' ),
			'id'            => 'traveler-blog-lite-intsgram-feed',
			'description'   => esc_html__( 'Add widgets here.', 'traveler-blog-lite' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
	}
	// Action to register sidebar
		
	add_action( 'widgets_init', 'traveler_blog_lite_register_sidebar' );
	
if ( ! function_exists( 'traveler_blog_lite_fonts_url' ) ) {
/**
 * Register Google fonts for Traveler Blog Lite.
 * Create your own traveler_blog_lite_fonts_url() function to override in a child theme.
 * @return string Google fonts URL for the theme.
 */
function traveler_blog_lite_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Cormorant, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Cormorant: on or off', 'traveler-blog-lite' ) ) {
		$fonts[] = 'Cormorant:700';
	}
	/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'traveler-blog-lite' ) ) {
		$fonts[] = 'Roboto:400,500';
	}
	/* translators: If there are characters in your language that are not supported by Lobster, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lobster: on or off', 'traveler-blog-lite' ) ) {
		$fonts[] = 'Lobster';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
}	
/**
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'traveler_blog_lite_pingback_header', 5 );

// Common Functions File
require_once TRAVELER_BLOG_LITE_DIR . '/includes/traveler-blog-lite-functions.php';

// Custom template tags for this theme
require_once TRAVELER_BLOG_LITE_DIR . '/includes/template-tags.php';

// Theme Customizer Settings
require_once TRAVELER_BLOG_LITE_DIR . '/includes/customizer.php';

// Script Class
require_once( TRAVELER_BLOG_LITE_DIR . '/includes/class-traveler-blog-lite-script.php' );

// Theme Dynemic CSS
require_once( TRAVELER_BLOG_LITE_DIR . '/includes/traveler-blog-lite-theme-css.php' );

/**
 * Load tab dashboard
 */
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require get_template_directory() . '/includes/dashboard/traveler-blog-lite-how-it-work.php';
    
}

/************Category image Module Module End******************/

// Plugin recomendation class
require_once( TRAVELER_BLOG_LITE_DIR . '/includes/plugins/class-wpcrt-recommendation.php' );