<?php
defined( 'ABSPATH' ) || exit;


add_action( 'plugins_loaded', 'yahman_addons_plugins_loaded', 1 );

function yahman_addons_plugins_loaded() {

	
	load_plugin_textdomain( 'yahman-add-ons', false, dirname( plugin_basename( __FILE__ ) ).'/languages/' );

	
	if (!defined('YAHMAN_ADDONS_TEMPLATE'))
		define( 'YAHMAN_ADDONS_TEMPLATE', in_array( get_template() , array(
			'simple-days',
			'neatly',
			'laid-back',
		) , true ) );

	if( is_admin() ){

		require_once YAHMAN_ADDONS_DIR . 'inc/admin.php';

		
		if(YAHMAN_ADDONS_VERSION != get_option('yahman_addons_version') ){
			require_once YAHMAN_ADDONS_DIR . 'inc/admin/update_option.php';
			yahman_addons_update_options();
			update_option( 'yahman_addons_version' , YAHMAN_ADDONS_VERSION );
		}



	}else{

		$option =  get_option('yahman_addons');

		
		require_once YAHMAN_ADDONS_DIR . 'inc/action_get_header.php';

		
		if ( isset($option['amp']['cache']) && isset($option['amp']['enable']) && !empty($_GET['amp']) && $_GET['amp'] === '1' && !is_user_logged_in() ) {

			$post_num = get_page_by_path( basename( untrailingslashit ( strtok ( $_SERVER["REQUEST_URI"], '?' ) ) ) , "ARRAY_A" , array('post','page') );

			if( isset($post_num['ID']) ){

				$cache_content = get_transient( 'ya_amp_cache_' . $post_num['ID'] );

				if ( $cache_content ) {

					echo $cache_content;
					require_once YAHMAN_ADDONS_DIR . 'inc/remove_actions.php';
					yahman_addons_remove_all_actions();
					exit;

				}

			}

		}else if( isset($option['faster']['cache']) && empty($_GET['amp']) && !is_user_logged_in() ){

			$post_num = get_page_by_path( basename( untrailingslashit ( strtok ( $_SERVER["REQUEST_URI"], '?' ) ) ) , "ARRAY_A" , array('post','page') );

			if( isset($post_num['ID']) ){

				$cache_content = get_transient( 'ya_faster_cache_' . $post_num['ID'] );

				if ( $cache_content ) {

					echo $cache_content;
					require_once YAHMAN_ADDONS_DIR . 'inc/remove_actions.php';
					yahman_addons_remove_all_actions();
					exit;

				}

			}


		}


		if ( !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php'  ) ) && !wp_is_json_request() ) {
			
			require_once YAHMAN_ADDONS_DIR . 'inc/output_buffer.php';

			require_once YAHMAN_ADDONS_DIR . 'inc/extra-content.php';
		}

	}

	
	if ( defined( 'POLYLANG_VERSION' )  ) {
		require_once YAHMAN_ADDONS_DIR . 'inc/third/polylang.php';
		$yahman_addons_polylang = new YAHMAN_ADDONS_Polylang();
	}

	
	require_once YAHMAN_ADDONS_DIR . 'inc/action_wp_header.php';

	
	require_once YAHMAN_ADDONS_DIR . 'inc/action_wp.php';

	
	require_once YAHMAN_ADDONS_DIR . 'inc/action_widgets_init.php';

	
	require_once YAHMAN_ADDONS_DIR . 'inc/action_template_redirect.php';

	
	require_once YAHMAN_ADDONS_DIR . 'inc/action_wp_footer.php';

}

function yahman_addons_ob_end_flush() {
	if (ob_get_contents()) ob_end_flush();
	if (ob_get_length()) ob_end_flush();
}
