<?php
defined( 'ABSPATH' ) || exit;



function yahman_addons_Simple_Days_style(){

	//$yahman_option = get_option('yahman_addons') ;

	require_once ABSPATH . 'wp-admin/includes/file.php';
	WP_Filesystem();
	global $wp_filesystem;

	
	$upload_dir = wp_upload_dir();
	$check_file = $upload_dir['basedir']. '/simple_days_cache/style.min.css';

	
	if ( file_exists ($check_file)) {
		$css_url = $check_file;
	}else{
		$css_url = SIMPLE_DAYS_THEME_DIR . 'assets/css/style.min.css';
	}
	$css = $wp_filesystem->get_contents($css_url);

	//if ($css == ''){
	//	require_once ABSPATH . 'wp-load.php';
	//	$css_remote = wp_remote_get( $css_url );
	//	$css = $css_remote['body'];
	//}



	if ( function_exists( 'has_blocks' ) ) {

		$css_url = SIMPLE_DAYS_THEME_DIR . 'assets/css/block.min.css';
		if ( file_exists($css_url) )
			$css .= $wp_filesystem->get_contents( $css_url );

		if(!SIMPLE_DAYS_RIGHT_SIDEBAR && !SIMPLE_DAYS_LEFT_SIDEBAR){

			$css_url = SIMPLE_DAYS_THEME_DIR . 'assets/css/block_one_column.min.css';
			if ( file_exists($css_url) )
				$css .= $wp_filesystem->get_contents( $css_url );

		}

		$css .= $wp_filesystem->get_contents( YAHMAN_ADDONS_DIR . 'assets/css/amp_block.min.css' );
	}

	
	if(get_theme_mod( 'simple_days_skin_style_random',false)){
		$skins_list = array('red_orange','orange','rose_peche','grape_juice','blue_yellow','blue_ocean','petrole','apple_green','yellow_mustard','brown_bread','gray_horse','black_coffee','moss_green','cinnamon');
	}else{
		$skins_list = 'none';
	}



	
	if($skins_list != 'none'){
		$skins_list_key = array_rand($skins_list);
		$css_url =  SIMPLE_DAYS_THEME_DIR . 'assets/skins/'.$skins_list[$skins_list_key].'.min.css';
		$css_skin = $wp_filesystem->get_contents($css_url);

		$css .= $css_skin;


	}



	
	if (get_theme_file_path('style.css') != SIMPLE_DAYS_THEME_DIR .'style.css'){

		$css_url = get_theme_file_path('style.min.css');
		if ( file_exists($css_url) ){

			$css_child = $wp_filesystem->get_contents($css_url);
		//if ($css_child == ''){
		//	$css_child_remote = wp_remote_get( get_theme_file_uri('style.min.css'));
		//	$css_child = $css_child_remote['body'];
		//}

			$amp_file_size = strlen($css) + strlen($css_child);
			if($amp_file_size < 75000){
				
				$css .= $css_child;
			}

		}


	}






      //$fontawesome4 = $wp_filesystem->get_contents(SIMPLE_DAYS_THEME_URI .'assets/fonts/fontawesome/style.min.css');
      //$css .= str_replace('url(\'../fonts/','url(\''.esc_url(SIMPLE_DAYS_THEME_URI) .'assets/fonts/fontawesome/fonts/',$fontawesome4);

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

