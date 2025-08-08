<?php
/* WooCommerce Compatibility File */

function ecommerce_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'ecommerce_woocommerce_setup' );

// function ecommerce_woocommerce_scripts() {
// 	wp_enqueue_style( 'ecommerce-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), ECOMMERCE_VERSION );

// }
// add_action( 'wp_enqueue_scripts', 'ecommerce_woocommerce_scripts' );
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


function ecommerce_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'ecommerce_woocommerce_related_products_args' );


// Remove default sidebar action
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'ecommerce_woocommerce_wrapper_before' ) ) {
    function ecommerce_woocommerce_wrapper_before() {
        ?>
            <main id="primary" class="site-main">
        <?php
    }
}
add_action( 'woocommerce_before_main_content', 'ecommerce_woocommerce_wrapper_before' );

if ( ! function_exists( 'ecommerce_woocommerce_wrapper_after' ) ) {
    function ecommerce_woocommerce_wrapper_after() {
        ?>
            </main>
        <?php
    }
}
add_action( 'woocommerce_after_main_content', 'ecommerce_woocommerce_wrapper_after' );

function custom_wrap_content_sidebar() {
    echo '<div class="container flex">';
}

function custom_close_content_sidebar() {
	woocommerce_get_sidebar();
    echo '</div>';
}

// Hook the wrapper functions
add_action('woocommerce_before_main_content', 'custom_wrap_content_sidebar', 5);
add_action('woocommerce_after_main_content', 'custom_close_content_sidebar', 25);

if ( ! function_exists( 'ecommerce_woocommerce_cart_link_fragment' ) ) {

	function ecommerce_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		ecommerce_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

add_filter( 'woocommerce_add_to_cart_fragments', 'ecommerce_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'ecommerce_woocommerce_cart_link' ) ) {

	function ecommerce_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'ecommerce' ); ?>">
			<?php
			$item_count_text = sprintf(
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'ecommerce' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'ecommerce_woocommerce_header_cart' ) ) {
	function ecommerce_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php ecommerce_woocommerce_cart_link(); ?>
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