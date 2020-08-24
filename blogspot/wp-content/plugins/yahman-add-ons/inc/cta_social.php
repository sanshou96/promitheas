<?php
defined( 'ABSPATH' ) || exit;
/**
 * Social CTA
 *
 * @package YAHMAN Add-ons
 */

function yahman_addons_cta_social(){

	if( is_front_page() || is_attachment() )return;

	
	$defaults = array(
		'heading'    => esc_html__('Follow us', 'yahman-add-ons'),
		'ending'    => esc_html__('We will keep you updated', 'yahman-add-ons'),
		'facebook'    => false,
		'facebook_script'    => false,
		'twitter'    => false,
		'feedly'    => false,
	);

	$option = get_option('yahman_addons');

	$settings = wp_parse_args( $option['cta_social'], $defaults );

	$cta_social['heading'] = apply_filters('yahman_addons_cta_social_heading', $settings['heading'] );
	$cta_social['ending'] = apply_filters('yahman_addons_cta_social_ending', $settings['ending'] );
	$cta_social['facebook'] = $settings['facebook'];
	$cta_social['facebook_script'] = $settings['facebook_script'];
	$cta_social['twitter'] = $settings['twitter'];
	$cta_social['feedly'] = $settings['feedly'];

	$facebook_id = isset($option['sns_account']['facebook']) ? $option['sns_account']['facebook'] : '';
	$facebook_app_id = isset($option['sns_account']['facebook_app_id']) ? $option['sns_account']['facebook_app_id'] : '';
	$twitter_id = isset($option['sns_account']['twitter']) ? $option['sns_account']['twitter'] : '';

	$no_image = !empty($option['other']['no_image']) ? $option['other']['no_image'] : YAHMAN_ADDONS_URI . 'assets/images/no_image.png';



	$post = get_post();
	$thumurl = yahman_addons_get_thumbnail( $post->ID , 'medium' );

	ob_start();
	?>
	<div class="cta_box mb_L shadow_box fit_content">
		<div class="cta_box_wrap f_box">
			<div class="cta_box_thum fit_box_img_wrap">
				<<?php echo ( YA_AMP ? 'amp-img':'img decoding="async"'); ?> src="<?php echo esc_url($thumurl[0]); ?>" class="scale_13 trans_10" width="<?php echo esc_attr($thumurl[1]); ?>" height="<?php echo esc_attr($thumurl[2]); ?>" />
			</div>
			<div class="cta_box_like f_box jc_c ai_c">
				<div class="cta_box_like_wrap">
					<p class="cta_box_like_text"><?php echo esc_html($cta_social['heading']); ?></p>

					<div class="cta_box_social">
						<?php if($cta_social['facebook'] && $facebook_id != ''){ ?>
							<div class="cta_box_fa">
								<?php
								if(!YA_AMP){
									require_once YAHMAN_ADDONS_DIR . 'inc/facebook_script.php';
									yahman_addons_facebook_script();
									?>
									<div class="fb-like" data-href="https://www.facebook.com/<?php echo esc_attr($facebook_id); ?>" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="false"></div>
									<?php
								}else{
									require_once YAHMAN_ADDONS_DIR . 'inc/facebook_script.php';
									$fb_lang = yahman_addons_facebook_lang(get_locale());
									?>
									<amp-facebook-like width="111" height="28"
									layout="fixed"
									data-layout="button_count"
									data-action="like"
									data-size="large"
									data-locale="<?php echo esc_attr($fb_lang); ?>"
									data-href="https://www.facebook.com/<?php echo esc_attr($facebook_id); ?>/">
								</amp-facebook-like>
							<?php  } ?>

						</div>
					<?php } ?>
					<?php if($cta_social['twitter'] && $twitter_id != ''){ ?>
						<div class="cta_box_tw f_box ai_c jc_c">
							<?php if(!YA_AMP){ ?>
								<a href="https://twitter.com/<?php echo esc_attr(str_replace( '@' , '' , $twitter_id )); ?>" class="twitter-follow-button" data-show-count="true" data-size="large" data-show-screen-name="false">Follow <?php echo esc_attr('@' . str_replace( '@' , '' , $twitter_id )); ?></a><script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
							<?php  }else{ ?>
								<a href="https://twitter.com/intent/follow?screen_name=<?php echo esc_attr(str_replace( '@' , '' , $twitter_id )); ?>" class="sns_twitter icon_rectangle non_hover icon_rec" title="<?php echo esc_html_x('Follow', 'cta_twitter_follow' ,'yahman-add-ons'); ?>" style="font-size:16px;width:auto;height:28px;position:relative;text-decoration:none;border-radius:5px;text-align:left;padding:0 10px 0 5px;color:#fff;background:#1DA1F2;display:inline-block;"><svg class="svg-icon" width="20" height="20" fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="vertical-align:middle;"><path class="sns_icon_4" d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z"></path></svg></a>
							<?php  } ?>
						</div>
					<?php } ?>
					<?php if($cta_social['feedly']){ ?>
						<div class="cta_box_fe">

							<a href="<?php echo esc_url('https://feedly.com/i/subscription/feed/'.get_bloginfo('rss2_url')); ?>" target="_blank" class="sns_feedly icon_rectangle non_hover icon_rec" title="<?php echo esc_html_x('Follow', 'cta_feedly_follow' ,'yahman-add-ons'); ?>" style="font-size:16px;width:auto;height:28px;position:relative;text-decoration:none;border-radius:5px;text-align:left;padding:0 10px 0 5px;color:#fff;background:#2BB24C;display:inline-block;"><svg class="svg-icon" width="20" height="20" fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="vertical-align:middle;display:inline-block;"><path class="sns_icon_1" d="M7.396 21.932L.62 15.108c-.825-.824-.825-2.609 0-3.39l9.709-9.752c.781-.78 2.521-.78 3.297 0l9.756 9.753c.826.825.826 2.611 0 3.391l-6.779 6.824c-.411.41-1.053.686-1.695.686H9c-.596-.001-1.19-.276-1.604-.688zm6.184-2.656c.137-.138.137-.413 0-.55l-1.328-1.328c-.138-.15-.412-.15-.549 0l-1.329 1.319c-.138.134-.138.405 0 .54l1.054 1.005h1.099l1.065-1.02-.012.034zm0-5.633c.092-.09.092-.32 0-.412l-1.42-1.409c-.09-.091-.32-.091-.412 0l-4.121 4.124c-.139.15-.139.465 0 .601l.959.96h1.102l3.893-3.855v-.009zm0-5.587c.092-.091.137-.366 0-.458l-1.375-1.374c-.09-.104-.365-.104-.502 0l-6.914 6.915c-.094.09-.14.359-.049.449l1.1 1.05h1.053l6.687-6.582z"></path></svg></a>

						</div>
					<?php } ?>
				</div>
				<p class="cta_box_like_text"><?php echo esc_html($cta_social['ending']); ?></p>
			</div>
		</div>
	</div>
</div>
<?php

return ob_get_clean();

}
