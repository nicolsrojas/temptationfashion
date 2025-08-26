<?php
/**
 * Theme functions and definitions
 */

if ( ! defined( 'ECOMMERCE_VERSION' ) ) {
	define( 'ECOMMERCE_VERSION', time() ); // Change this to a static version number for production
}

if (! defined( 'THEME_TEXTDOMAIN' ) ) {
	define( 'THEME_TEXTDOMAIN', 'ecommerce' );
}

/**
 * Theme setup
 */
function ecommerce_setup() {
	// Translation support
	load_theme_textdomain( THEME_TEXTDOMAIN, get_template_directory() . '/languages' );

	// WordPress features
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	// Navigation menus
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', THEME_TEXTDOMAIN ),
	) );

	// HTML5 support
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
	) );

	// Custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );
}
add_action( 'after_setup_theme', 'ecommerce_setup' );

/**
 * Set content width
 */
function ecommerce_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ecommerce_content_width', 1200 );
}
add_action( 'after_setup_theme', 'ecommerce_content_width', 0 );

/**
 * Enqueue scripts and styles
 */
function ecommerce_scripts() {
	wp_enqueue_style('ecommerce-style', get_stylesheet_uri(), array(), ECOMMERCE_VERSION );
	wp_enqueue_style('ecommerce-main', get_template_directory_uri() . '/assets/css/main.css', array('ecommerce-style'), ECOMMERCE_VERSION );

	wp_enqueue_script('gsap',  get_template_directory_uri() . '/assets/js/gsap.min.js', array(), ECOMMERCE_VERSION, true);
	wp_enqueue_script('gsap-scrolltrigger',  get_template_directory_uri() . '/assets/js/ScrollTrigger.min.js', array(), ECOMMERCE_VERSION, true);
	wp_enqueue_script('gsap-scrollsmoother',  get_template_directory_uri() . '/assets/js/ScrollSmoother.min.js', array(), ECOMMERCE_VERSION, true);

	wp_enqueue_script('ecommerce-main',  get_template_directory_uri() . '/assets/js/main.js', array(), ECOMMERCE_VERSION, true);

	wp_enqueue_script('ecommerce-carousel',  get_template_directory_uri() . '/assets/js/carousel.js', array('swiper'), ECOMMERCE_VERSION, true);
}
add_action( 'wp_enqueue_scripts', 'ecommerce_scripts' );

function ecommerce_async_css_loader( $html, $handle, $href, $media ) {
    if ( $handle === 'ecommerce-main' ) {
        $html  = "<link rel='preload' href='$href' as='style' onload=\"this.rel='stylesheet'\">\n";
        $html .= "<noscript><link rel='stylesheet' href='$href'></noscript>\n";
    }
    return $html;
}
add_filter( 'style_loader_tag', 'ecommerce_async_css_loader', 10, 4 );

add_action('wp_head', function() {
    if ( is_front_page() ) {
        $critical = get_template_directory() . '/assets/css/critical-home.css';
    } elseif ( is_single() && 'product' === get_post_type() ) {
        $critical = get_template_directory() . '/assets/css/critical-product.css';
    } else {
        $critical = get_template_directory() . '/assets/css/critical-page.css';
    }
    if ( isset($critical) && file_exists($critical) ) {
        echo '<style>' .  esc_html(file_get_contents($critical)) . '</style>';
    }
});

/**
 * Include additional files
 */

require get_template_directory() . '/inc/classes/class-nav-walker.php';
require get_template_directory() . '/inc/cleanups.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';

/* Components  */
require get_template_directory() . '/components/carousel/carousel.php';
function load_conditional_components() {
	enqueue_carousel_assets();
    // if (is_page_template('templates-homepage.php')) {
    //     enqueue_carousel_assets();
    // }
}
add_action('wp_enqueue_scripts', 'load_conditional_components');

if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}