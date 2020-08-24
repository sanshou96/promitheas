<?php
defined( 'ABSPATH' ) || exit;


add_action( 'wp', 'yahman_addons_setup_AMP' );
function yahman_addons_setup_AMP() {

	require_once YAHMAN_ADDONS_DIR . 'inc/amp/preconfigure.php';
	yahman_addons_amp_preconfigure();

}
