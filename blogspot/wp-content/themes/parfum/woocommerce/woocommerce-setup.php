<?php

/* WooCommerce compatible */
add_action( 'after_setup_theme', 'parfum_woocommerce_setup' );
function parfum_woocommerce_setup() {

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}

// Unhook the WooCommerce wrappers.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Hook the Parfum wrappers.
add_action( 'woocommerce_before_main_content', 'parfum_woocommerce_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'parfum_woocommerce_wrapper_end', 10 );

function parfum_woocommerce_wrapper_start() {
	echo '<div id="primary" class="site-content">';
}

function parfum_woocommerce_wrapper_end() {
	echo '</div>';
}
/* End WooCommerce compatible */

// WooCommerce style.
add_action( 'wp_enqueue_scripts', 'parfum_woocommerce_style' );
function parfum_woocommerce_style() {
	wp_enqueue_style( 'parfum-woocommerce-style', get_template_directory_uri() . '/woocommerce/css/woocommerce-style.css', array(), PARFUM_VERSION );
}

// WooCommerce sidebar.
add_action( 'widgets_init', 'parfum_woocommerce_sidebar' );
function parfum_woocommerce_sidebar() {

	register_sidebar( array(
		'name'          => esc_html__( 'WooCommerce Sidebar', 'parfum' ),
		'description'   => esc_html__( 'Appears on posts and pages except Full-width Page Template', 'parfum' ),
		'id'            => 'parfum-sidebar-shop',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span class="widget-title-tab">',
		'after_title'   => '</span></h3>',
	) );

}

add_action( 'customize_register', 'parfum_woocommerce_customizer' );
function parfum_woocommerce_customizer( $wp_customize ) {

	$wp_customize->add_section('parfum_woocommerce_sidebar', array(
		'panel' => 'woocommerce',
		'title' => '(GT) ' . __( 'Sidebar', 'parfum' ),
	));

	// Remove WooCommerce sidebar.
	$wp_customize->add_setting('parfum_remove_woocommerce_sidebar', array(
		'default'           => '',
		'sanitize_callback' => 'parfum_sanitize_checkbox',
	));
	$wp_customize->add_control('parfum_remove_woocommerce_sidebar', array(
		'type'        => 'checkbox',
		'label'       => __( 'Remove WooCommerce sidebar', 'parfum' ),
		'section'     => 'parfum_woocommerce_sidebar',
		'description' => __( 'The change of this option is not seen in the customizer, but it will be effective in your website when you save the changes', 'parfum' ),
	));

}

$parfum_remove_woocommerce_sidebar = get_theme_mod( 'parfum_remove_woocommerce_sidebar', '' );

if ( $parfum_remove_woocommerce_sidebar == 1 ) {
	add_action( 'init', 'parfum_remove_woocommerce_sidebar' );
	add_action( 'get_header', 'parfum_add_woocommerce_no_sidebar_full_width' );
}

function parfum_remove_woocommerce_sidebar() {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
}

function parfum_add_woocommerce_no_sidebar_full_width() {

	if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
		add_filter( 'body_class', 'parfum_add_woocommerce_no_sidebar_full_width_class' );
	}

}

function parfum_add_woocommerce_no_sidebar_full_width_class( $classes ) {

	$classes[] = 'woocommerce-no-sidebar-full-width';

	return $classes;

}

require_once get_template_directory() . '/woocommerce/inc/wc-customization.php';
