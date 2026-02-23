<?php

/**
 * dsarichmond functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dsarichmond
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', wp_get_theme()->get('Version'));
}

if (! function_exists('dsarichmond_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dsarichmond_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on dsarichmond, use a find and replace
		 * to change 'dsarichmond' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('dsarichmond', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');


		/*
		* Add responsive Embed Support
		*
		*
		*/

		add_theme_support('responsive-embeds');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'dsarichmond'),
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
				'dsarichmond_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height' => 250,
				'width' => 250,
				'flex-width' => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'dsarichmond_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dsarichmond_content_width()
{
	$GLOBALS['content_width'] = apply_filters('dsarichmond_content_width', 640);
}
add_action('after_setup_theme', 'dsarichmond_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dsarichmond_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'dsarichmond'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'dsarichmond'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'dsarichmond_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function dsarichmond_scripts()
{
	wp_enqueue_style('dsarichmond-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_style('main-style', get_stylesheet_directory_uri() . '/build/style-index.css', array(), _S_VERSION);

	wp_style_add_data('dsarichmond-style', 'rtl', 'replace');

	wp_enqueue_script('dsarichmond-navigation', get_parent_theme_file_uri('js/navigation.js'), array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'dsarichmond_scripts');

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
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/******* NEW CODE: ************/
function rdsa_custom_blocks()
{
	register_block_type(__DIR__ . '/build/custom-blocks/mailchimp');
}
add_action('init', 'rdsa_custom_blocks');

function rdsa_enqueue_main_script()
{
	wp_enqueue_script('main', get_parent_theme_file_uri('build/index.js'), [], _S_VERSION, ['strategy' => 'defer', 'in_footer' => true]);
}
add_action('wp_enqueue_scripts', 'rdsa_enqueue_main_script', 10);

// Adding excerpt for page
add_post_type_support('page', 'excerpt');
add_post_type_support('initiatives', 'excerpt');
add_post_type_support('resources', 'excerpt');
add_post_type_support('page', 'custom-fields');
