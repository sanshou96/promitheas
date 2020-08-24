<?php
defined( 'ABSPATH' ) || exit;




function yahman_addons_Laid_Back_style(){

	//$yahman_option = get_option('yahman_addons') ;

	require_once ABSPATH . 'wp-admin/includes/file.php';
	WP_Filesystem();
	global $wp_filesystem;

	$css = '';

	$css .= $wp_filesystem->get_contents(LAID_BACK_THEME_DIR . 'assets/css/style.min.css');

	if ( function_exists( 'has_blocks' ) ) {

		$css_url = $wp_filesystem->get_contents( LAID_BACK_THEME_DIR . 'assets/css/block.min.css' );
		if ( file_exists($css_url) )

			$css .= $wp_filesystem->get_contents( $css_url );

		if(!LAID_BACK_SIDEBAR){

			$css_url = $wp_filesystem->get_contents( LAID_BACK_THEME_DIR . 'assets/css/block_one_column.min.css' );
			if ( file_exists($css_url) )

				$css .= $wp_filesystem->get_contents( $css_url );
		}

		$css .= $wp_filesystem->get_contents( YAHMAN_ADDONS_DIR . 'assets/css/amp_block.min.css' );
	}

	$fontawesome = $wp_filesystem->get_contents(LAID_BACK_THEME_DIR .'assets/font/fontawesome/style.min.css');
	$fontawesome = str_replace('url(\'FontAwesome','url(\''.esc_url(LAID_BACK_THEME_URI) .'assets/font/fontawesome/FontAwesome',$fontawesome);
	$amp_file_size = strlen($css) + strlen($fontawesome);
	if($amp_file_size < 75000){
		
		$css .= $fontawesome;
	}




	
	if (get_theme_file_path('style.css') !== LAID_BACK_THEME_DIR .'style.css'){

		$css_url = get_theme_file_path('style.min.css');
		if ( file_exists($css_url) ){

			$css_child = $wp_filesystem->get_contents($css_url);

			$amp_file_size = strlen($css) + strlen($css_child);
			if($amp_file_size < 75000){
				
				$css .= $css_child;
			}

		}
	}

	$custom_css = wp_get_custom_css();
	$amp_file_size = strlen($css) + strlen($custom_css);
	if($amp_file_size < 75000){
		
		$css .= $custom_css;
	}

	
	$css = str_replace(array('@charset "UTF-8";','@charset"UTF-8";'),'',$css);

	wp_register_style( 'amp-custom', false ); wp_enqueue_style( 'amp-custom' );
	wp_add_inline_style( 'amp-custom', preg_replace('/!important/i', '', $css) );

	
	add_filter( 'wp_get_custom_css', function ( $css ) {
		return '';
	} );




}



