<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package PinkPeony
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pinkpeony_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class of no-sidebar when there is no sidebar present
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if ( is_page_template( 'full-width-page.php' ) || is_page_template( 'grid-page.php' ) )
		$classes[] = 'full-width-page';

	if ( ! is_multi_author() ) {
		$classes[] = 'not-multi-author';
	}

	if ( display_header_text() ) {
		$classes[] = 'display-header-text';
	}

	if ( is_page() && ! comments_open() && '0' == get_comments_number() ) {
		$classes[] = 'comments-closed';
	}

	return $classes;
}
add_filter( 'body_class', 'pinkpeony_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 */
function pinkpeony_post_classes( $classes ) {

	if ( ( 'post' !== get_post_type() && ! has_post_thumbnail() ) || 
		 ( 'post' === get_post_type() && ! pinkpeony_has_post_thumbnail() ) || 
		! pinkpeony_activate_featured_image() ) {
		$classes[] = 'without-featured-image';
	} else {
		$classes[] = 'with-featured-image';
	}

	return $classes;
}
add_filter( 'post_class', 'pinkpeony_post_classes' );

/*
 * Check Jetpack Content Options for Featured Image settings to aid
 * in setting post_class and other classes.
 * If Jetpack is not active, images are activated by default.
 */
function pinkpeony_activate_featured_image() {
	if ( function_exists( 'jetpack_featured_images_get_settings' ) ) {
		$jetpackopts = jetpack_featured_images_get_settings();

		if (
			( true == $jetpackopts['page-option'] && is_page() && has_post_thumbnail() ) ||
			( true == $jetpackopts['post-option'] && is_single() && pinkpeony_has_post_thumbnail() ) ||
			( true == $jetpackopts['archive-option'] && ( is_home() || is_archive() || is_search() && pinkpeony_has_post_thumbnail() ) )
		) {
			return true;
		} else {
			return false;
		}
	}
	else {
		return true;
	}
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function pinkpeony_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'pinkpeony_pingback_header' );
