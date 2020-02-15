<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package PinkPeony
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function pinkpeony_woocommerce_setup() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 300,
		'single_image_width'    => 624,
	) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'pinkpeony_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function pinkpeony_woocommerce_scripts() {
	wp_enqueue_style( 'pinkpeony-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );
	wp_style_add_data( 'pinkpeony-woocommerce-style', 'rtl', 'replace' );

	/* Load WooCommerce custom fonts. */
	$fonts_path  = WC()->plugin_url() . '/assets/fonts/';
	$fonts       = array( 'star', 'WooCommerce' );
	$inline_font = '';

	foreach ( $fonts as $font ) {
		$inline_font .= '@font-face {
				font-family: "' . $font . '";
				src: url("' . $fonts_path . $font . '.eot");
				src: url("' . $fonts_path . $font . '.eot?#iefix") format("embedded-opentype"),
					url("' . $fonts_path . $font . '.woff") format("woff"),
					url("' . $fonts_path . $font . '.ttf") format("truetype"),
					url("' . $fonts_path . $font . '.svg#' . $font . '") format("svg");
				font-weight: normal;
				font-style: normal;
			}';
	}

	wp_add_inline_style( 'pinkpeony-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'pinkpeony_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function pinkpeony_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'pinkpeony_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function pinkpeony_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'pinkpeony_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function pinkpeony_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'pinkpeony_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function pinkpeony_woocommerce_loop_columns() {
	return 4;
}
add_filter( 'loop_shop_columns', 'pinkpeony_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function pinkpeony_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'pinkpeony_woocommerce_related_products_args' );

if ( ! function_exists( 'pinkpeony_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function pinkpeony_woocommerce_product_columns_wrapper() {
		$columns = pinkpeony_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'pinkpeony_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'pinkpeony_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function pinkpeony_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'pinkpeony_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
 * Remove WooCommerce sidebar.
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

if ( ! function_exists( 'pinkpeony_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function pinkpeony_woocommerce_wrapper_before() {
		$classes = array( 'content-wrapper' );

		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'full-width';
		}

		$classes = implode( ' ', $classes );
		?>
		<div class="<?php echo esc_attr( $classes ); ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'pinkpeony_woocommerce_wrapper_before' );

if ( ! function_exists( 'pinkpeony_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function pinkpeony_woocommerce_wrapper_after() {
		?>
				</main><!-- #main -->
			</div><!-- #primary -->

			<?php get_sidebar( 'shop' ); ?>
		</div><!-- .content-wrapper -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'pinkpeony_woocommerce_wrapper_after' );

if ( ! function_exists( 'pinkpeony_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function pinkpeony_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		pinkpeony_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'pinkpeony_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'pinkpeony_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function pinkpeony_woocommerce_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'pinkpeony' ); ?>">
				<?php /* translators: number of items in the mini cart. */ ?>
				<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'pinkpeony' ), WC()->cart->get_cart_contents_count() ) );?></span>
			</a>
		<?php
	}
}

if ( ! function_exists( 'pinkpeony_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function pinkpeony_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php pinkpeony_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
					$instance = array(
						'title' => '',
					);

					the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

/**
 * Workaround to prevent is_shop() from failing due to WordPress core issue
 *
 * @link https://core.trac.wordpress.org/ticket/21790
 * @param  array $args infinite scroll args.
 * @return array       infinite scroll args.
 */
function pinkpeony_woocommerce_is_shop_page() {
	global $wp_query;

	$front_page_id        = get_option( 'page_on_front' );
	$current_page_id      = $wp_query->get( 'page_id' );
	$is_static_front_page = 'page' === get_option( 'show_on_front' );

	if ( $is_static_front_page && $front_page_id === $current_page_id  ) {
		$is_shop_page = ( $current_page_id === wc_get_page_id( 'shop' ) ) ? true : false;
	} else {
		$is_shop_page = is_shop();
	}

	return $is_shop_page;
}

/**
 * Jetpack infinite scroll duplicates posts where orderby is anything other than modified or date
 * This filter offsets the products returned by however many are displayed per page
 *
 * @link https://github.com/Automattic/jetpack/issues/1135
 * @param  array $args infinite scroll args.
 * @return array       infinite scroll args.
 */
function pinkpeony_woocommerce_jetpack_duplicate_products( $args ) {
	if ( ( isset( $args['post_type'] ) && 'product' === $args['post_type'] ) || ( isset( $args['taxonomy'] ) && 'product_cat' === $args['taxonomy'] ) ) {
		$args['offset'] = $args['posts_per_page'] * $args['paged'];
	}

 	return $args;
}
add_filter( 'infinite_scroll_query_args', 'pinkpeony_woocommerce_jetpack_duplicate_products', 100 );

/**
 * Override number of products per page in Jetpack infinite scroll.
 *
 * @param  array $args infinite scroll args.
 * @return array       infinite scroll args.
 */
function pinkpeony_woocommerce_jetpack_products_per_page( $args ) {
	if ( is_array( $args ) && ( pinkpeony_woocommerce_is_shop_page() || is_product_taxonomy() || is_product_category() || is_product_tag() ) ) {
		 $args['posts_per_page'] = pinkpeony_woocommerce_products_per_page();
	}

	return $args;
}
add_filter( 'infinite_scroll_settings', 'pinkpeony_woocommerce_jetpack_products_per_page' );