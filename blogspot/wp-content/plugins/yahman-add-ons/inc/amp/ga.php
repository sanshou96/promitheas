<?php
defined( 'ABSPATH' ) || exit;
/**
 * Google AMP Analytics
 *
 * @package YAHMAN Add-ons
 */


function yahman_addons_ga_amp(){

	if(YA_GA_AMP !== ''){
		$ga_acount = YA_GA_AMP;
	}else{
		$ga_acount = YA_GA_GTAG;
	}

	if($ga_acount !== ''){
		$ga_acount = '<amp-analytics type="googleanalytics"><script type="application/json">{"vars":{"account":"'.esc_attr($ga_acount).'"},"triggers":{"trackPageview":{"on":"visible","request":"pageview"}}}</script></amp-analytics>';
	}

	return $ga_acount;

}
