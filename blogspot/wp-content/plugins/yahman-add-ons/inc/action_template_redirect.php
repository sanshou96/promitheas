<?php
defined( 'ABSPATH' ) || exit;

add_action('template_redirect','yahman_addons_template_setup',1);
//template_loaded
function yahman_addons_template_setup(){


	$option =  get_option('yahman_addons') ;

	$profile['user_profile'] = isset($option['profile']['user_profile']) ? true: false;

	if($profile['user_profile']){
		require_once YAHMAN_ADDONS_DIR . 'inc/user_profile_output.php';

		if(!YAHMAN_ADDONS_TEMPLATE){
			add_action('wp_footer','yahman_addons_enqueue_style_notice');
		}
	}


	define( 'YA_USER_PROFILE', $profile['user_profile'] );


	$ga_gtag = '';
	$amp_ga = '';
	if(isset($option['ga']['enable'])){
		if(isset($option['ga']['id']))  $ga_gtag = $option['ga']['id'];
		if(isset($option['amp']['ga'])) $amp_ga = $option['amp']['ga'];
		if (!defined('YA_GA_GTAG')) {
			define( 'YA_GA_GTAG', $ga_gtag );
		}
		if (!defined('YA_GA_AMP')) {
			define( 'YA_GA_AMP', $amp_ga );
		}
		if(YA_AMP){
			require_once YAHMAN_ADDONS_DIR . 'inc/amp/ga.php';
			if ( function_exists( 'wp_body_open' ) ) {
				add_action( 'wp_body_open', function() {
					echo yahman_addons_ga_amp();
				});
			}
		}else{
			if ( !is_user_logged_in() )
				require_once YAHMAN_ADDONS_DIR . 'inc/ga_gtag.php';
		}

	}else{
    //else of $option['ga']['enable']

		if (!defined('YA_GA_GTAG')) {
			define( 'YA_GA_GTAG', $ga_gtag );
		}
		if (!defined('YA_GA_AMP')) {
			define( 'YA_GA_AMP', $amp_ga );
		}

    }  //end of $option['ga']['enable']


    if (YA_AMP){

    	
    	add_filter( 'wp_lazy_loading_enabled', '__return_false' );

    	if ( function_exists( 'wp_body_open' ) ) {
    		if( isset($option['pwa']['enable']) && isset($option['pwa']['amp_service_worker']) ){
    			require_once YAHMAN_ADDONS_DIR . 'inc/pwa.php';
    			add_action( 'wp_body_open', function() use ($option) {
    				echo yahman_addons_pwa_amp_sw( $option['pwa'] );
    			});

    		}

    	}


    }else{

    	if( isset($option['javascript']['lazy']) && $option['javascript']['lazy'] === 'lozad'){

    		
    		add_filter( 'wp_lazy_loading_enabled', '__return_false' );

    		add_action( 'wp_footer', 'yahman_addons_lazy_lozad');

    	}

    	if( isset($option['other']['user_timing_api']) ){

    		add_action( 'wp_print_footer_scripts', 'yahman_addons_user_timing_api');

    	}

    /*
        if( isset($option['faster']['async_scripts']) ){

          		add_action( 'script_loader_tag', 'yahman_addons_replace_scripts_type',9999);

        }
    */

    }




}
