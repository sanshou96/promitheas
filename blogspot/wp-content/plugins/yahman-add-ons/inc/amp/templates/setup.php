<?php
defined( 'ABSPATH' ) || exit;

add_filter( 'template_include', 'yahman_addons_amp_template_include', 99 );

function yahman_addons_amp_template_include($template){

	return YAHMAN_ADDONS_DIR . 'inc/amp/templates/index.php';

}

function yahman_addons_amp_template_replace($the_content){

	
	$the_content = preg_replace(array(
		'/<script>(.*?)<\/script>/is',
		'/<style*?>(.*?)<\/style>/is',
	), '', $the_content);

	return $the_content;

}

function yahman_addons_amp_template_style_sheet(){

	require_once ABSPATH . 'wp-admin/includes/file.php';
	WP_Filesystem();
	global $wp_filesystem;

	$style = '<style amp-custom="">';
	$style .= $wp_filesystem->get_contents(YAHMAN_ADDONS_DIR . 'assets/css/template.min.css');
	$style = str_replace('@charset "UTF-8";','',$style);
	$style = str_replace('!important','',$style);
	$style .= '</style>';

	return $style;

}
