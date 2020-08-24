<?php
defined( 'ABSPATH' ) || exit;
/**
 * Google AMP preconfigure
 *
 * @package YAHMAN Add-ons
 */


function yahman_addons_amp_preconfigure(){

	$amp['judge'] = false;
	$amp['ready'] = false;
	$amp['logo'] = '';

	$option =  get_option('yahman_addons');

	if( !isset($option['amp']['enable']) || is_admin() ){
		
		yahman_addons_amp_define($amp);
		return;

	}else{

		$amp['ready'] = true ;
    //$amp['judge'] = false;
		if ( !empty($_GET['amp']) && $_GET['amp'] === '1' ) {

			
			$amp['judge'] = true;
			$amp['logo'] = !empty($option['amp']['logo']) ? $option['amp']['logo'] : YAHMAN_ADDONS_URI . 'assets/images/amp-logo.png';

		}

	}

	
	if( is_singular() || !in_array ( get_post_type() , array('post','page') ) ){


		
		$post_num = get_the_ID();

		$post_not_in = array();

		
		if( !empty($option['amp']['post_not_in']))

			$post_not_in = explode(',', $option['amp']['post_not_in']);

		if( in_array ( $post_num , $post_not_in  ) ) {

			$amp['judge'] = $amp['ready'] = false;
			$amp['logo'] = '';

			
		}elseif( isset($option['amp']['parent_not_in']) ){

			$parents_id = array_reverse ( get_post_ancestors($post_num) );

			
			if( !empty($parents_id) ) $post_num = $parents_id[0];

			if( in_array ( $post_num , explode(',', $option['amp']['parent_not_in'])  ) ) {
				$amp['judge'] = $amp['ready'] = false;
				$amp['logo'] = '';
			}


		}

	}

	yahman_addons_amp_define($amp);

}



function yahman_addons_amp_define($amp){

	if (!defined('YA_AMP')) {
		define( 'YA_AMP', $amp['judge'] );
	}
	if (!defined('YA_AMP_READY')) {
		define( 'YA_AMP_READY', $amp['ready'] );
	}
	if (!defined('YA_AMP_LOGO')) {
		define( 'YA_AMP_LOGO', $amp['logo'] );
	}

	if ( YA_AMP ){
		require_once YAHMAN_ADDONS_DIR . 'inc/amp/setup.php';

		
		if( !YAHMAN_ADDONS_TEMPLATE ){
			require_once YAHMAN_ADDONS_DIR . 'inc/amp/templates/setup.php';
			
			
			require_once YAHMAN_ADDONS_DIR . 'inc/enqueue.php';

		}

	}else{
		
		require_once YAHMAN_ADDONS_DIR . 'inc/enqueue.php';
	}

}
