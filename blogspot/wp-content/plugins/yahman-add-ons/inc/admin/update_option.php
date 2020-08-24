<?php
defined( 'ABSPATH' ) || exit;


require_once YAHMAN_ADDONS_DIR . 'inc/admin/option_key.php';

function yahman_addons_update_options(){

	$default_settings = yahman_addons_option_key();

	$load_setting = get_option('yahman_addons');

	if ( $load_setting ) {

		$load_setting = yahman_addons_merge_option($default_settings, $load_setting);

	}else{
		
		$load_setting = $default_settings;
	}

	update_option( 'yahman_addons', $load_setting );
}



function yahman_addons_merge_option($old_option, $new_option){

	if (is_array($old_option)) {
		if (is_array($new_option)) {
			foreach ($new_option as $key => $value) {
				if (isset($old_option[$key]) && is_array($value) && is_array($old_option[$key])) {
					$old_option[$key] = yahman_addons_merge_option($old_option[$key], $value);
				} else {
					$old_option[$key] = $value;
				}
			}
		}
	} elseif (! is_array($old_option) && ( strlen($old_option) == 0 || $old_option == 0 )) {
		$old_option = $new_option;
	}
	return $old_option;
}
