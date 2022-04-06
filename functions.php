<?php
/**
 * jape functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package jape
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jape_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on cu, use a find and replace
		* to change 'jape' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'jape', get_template_directory() . '/languages' );

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

	// add the excerpt field to pages
	add_post_type_support( 'page', 'excerpt' );
	//add_post_type_support( 'page', 'custom-fields' );
	
	add_theme_support('editor-styles');
	add_editor_style( 'style-editor.css' );



	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'jape' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'jape_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
	
	// add_theme_support( 'wp-block-styles' );
		
	add_theme_support( 'align-wide' );
	
	add_theme_support( 'editor-font-sizes', array(
		array(
        'name' => esc_attr__( 'Regular', 'jape' ),
        'size' => 16,
        'slug' => 'regular'
    ),
    array(
        'name' => esc_attr__( 'Large', 'jape' ),
        'size' => 24,
        'slug' => 'large'
    )
  ));
	
}
add_action( 'after_setup_theme', 'jape_setup' );



/**
 * Loads customizer styles in the block editor.
 * but it doesn't auto-prefix selectors, so it styles the chrome too.  :(
 */
// function jape_add_customizer_styles_to_block_editor() {
// 	wp_register_style( 'jape-customizer-styles', false );
// 	wp_enqueue_style( 'jape-customizer-styles' );
// 	wp_add_inline_style( 'jape-customizer-styles', wp_get_custom_css() );
// }
// add_action( 'enqueue_block_editor_assets', 'jape_add_customizer_styles_to_block_editor', 100 );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jape_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jape_content_width', 640 );
}
add_action( 'after_setup_theme', 'jape_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jape_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Before Header', 'jape' ),
			'id'            => 'preheader',
			'description'   => esc_html__( 'Add widgets here.', 'jape' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Before Content', 'jape' ),
			'id'            => 'precontent',
			'description'   => esc_html__( 'Add widgets here.', 'jape' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Before Footer', 'jape' ),
			'id'            => 'prefooter',
			'description'   => esc_html__( 'Add widgets here.', 'jape' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'jape_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function jape_scripts() {
	wp_enqueue_style( 'jape-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'jape-style', 'rtl', 'replace' );

	wp_enqueue_script( 'jape-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jape_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Head functions like opengraph and GTM.
 */
require get_template_directory() . '/inc/head-functions.php';

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
 * Breadcrumb generator.
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Custom metadata to toggle visibility of title and featured image.
 */
require get_template_directory() . '/inc/meta.php';

/**
 * Custom settings for Display Posts Shortcode plugin.
 */
require get_template_directory() . '/inc/dps.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

