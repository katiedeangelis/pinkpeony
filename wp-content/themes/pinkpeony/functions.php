<?php
/**
 * PinkPeony functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package PinkPeony
 */

if ( ! function_exists( 'pinkpeony_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pinkpeony_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'pinkpeony' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'pinkpeony', get_template_directory() . '/languages' );

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

	// Post thumbnails
	add_image_size( 'pinkpeony-featured-image', 880, 312, true );
	// Hero Image on the front page slider
	add_image_size( 'pinkpeony-hero-thumbnail', 1180, 600, true );
	// Full width and grid page template
	add_image_size( 'pinkpeony-page-thumbnail', 1180, 435, true );
	// Grid child page thumbnail
	add_image_size( 'pinkpeony-grid-thumbnail', 360, 242, true );
	// Testimonial thumbnail
	add_image_size( 'pinkpeony-testimonial-thumbnail', 180, 180, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Header', 'pinkpeony' ),
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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'pinkpeony_custom_background_args', array(
		'default-color' => '444340',
	) ) );

	// Add theme support for custom logos
	add_theme_support( 'custom-logo',
		array(
			'width'       => 1200,
			'height'      => 300,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add theme support for excerpts on pages
	add_post_type_support( 'page', 'excerpt' );
}
endif;
add_action( 'after_setup_theme', 'pinkpeony_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pinkpeony_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pinkpeony_content_width', 825 );
}
add_action( 'after_setup_theme', 'pinkpeony_content_width', 0 );

/**
 * Set the content width for the full-width page template.
 */
function pinkpeony_adjust_content_width() {
	if ( is_post_type_archive( 'jetpack-testimonial' ) || ( is_front_page() ) ) {
		$GLOBALS['content_width'] = 1180;
	}
}
add_action( 'template_redirect', 'pinkpeony_adjust_content_width' );

/**
 * Return early if Custom Logos are not available.
 *
 * @todo Remove after WP 4.7
 */
function pinkpeony_the_custom_logo() {
	if ( ! function_exists( 'the_custom_logo' ) ) {
		return;
	} else {
		the_custom_logo();
	}
}

/**
 * Returns the Google font stylesheet URL, if available.
 */
function pinkpeony_fonts_url() {
	$fonts_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Source Sans Pro, translate this to 'off'. Do not translate into your own language.
	 */
	$source_sans_pro = esc_html_x( 'on', 'Source Sans Pro font: on or off',	 'pinkpeony' );

	/* translators: If there are characters in your language that are not supported
	 * by Yrsa, translate this to 'off'. Do not translate into your own language.
	 */
	$yrsa = esc_html_x( 'on', 'Yrsa font: on or off',  'pinkpeony' );

	if ( 'off' !== $source_sans_pro || 'off' !== $merriweather || 'off' !== $Yrsa ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro ) {
			$font_families[] = 'Source Sans Pro:300,300italic,400,400italic,600';
		}
		if ( 'off' !== $yrsa ) {
			$font_families[] = 'Yrsa:300,400,700';
		}
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "https://fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pinkpeony_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'pinkpeony' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'pinkpeony' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'pinkpeony' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'pinkpeony' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'pinkpeony_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pinkpeony_scripts() {
	wp_enqueue_style( 'pinkpeony-style', get_stylesheet_uri() );

	// Add Yrsa, Source Sans Pro and Merriweather fonts.
	wp_enqueue_style( 'pinkpeony-fonts', pinkpeony_fonts_url(), array(), null );

	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/assets/genericons/genericons.css', array(), '3.4.1' );

	wp_enqueue_script( 'pinkpeony-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	if ( pinkpeony_has_featured_posts( 1 ) && ( is_home() || is_front_page() ) ) {
		wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider.js', array( 'jquery' ), '20161220', true );
		wp_enqueue_script( 'pinkpeony-slider', get_template_directory_uri() . '/assets/js/slider.js', array( 'flexslider' ), '20161220', true );
	}

	// If there's an active Video widget, and it's (hopefully) in the footer widget area
	if ( is_active_widget( '','', 'media_video' ) && ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) ) ) {
		wp_enqueue_script( 'pinkpeony-video', get_template_directory_uri() . '/assets/js/video-widget.js', array( 'jquery' ), '20170608', true );
	}

	wp_enqueue_script( 'pinkpeony-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pinkpeony_scripts' );

if ( ! function_exists( 'pinkpeony_continue_reading_link' ) ) :
/**
 * Returns an ellipsis and "Continue reading" plus off-screen title link for excerpts
 */
function pinkpeony_continue_reading_link() {
	return '&hellip; <a href="'. esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( 'Continue reading <span class="screen-reader-text">%1$s</span>', 'pinkpeony' ), esc_attr( strip_tags( get_the_title() ) ) ) . '</a>';
}
endif; // pinkpeony_continue_reading_link

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with pinkpeony_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function pinkpeony_auto_excerpt_more() {
	if ( is_admin() ) {
		return;
	}

	return pinkpeony_continue_reading_link();
}
add_filter( 'excerpt_more', 'pinkpeony_auto_excerpt_more' );

/**
 * Custom Header support.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}



/**
 * Load plugin enhancement file to display admin notices.
 */
require get_template_directory() . '/inc/plugin-enhancements.php';