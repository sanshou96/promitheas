<?php
defined( 'ABSPATH' ) || exit;

if ( !defined('YA_AMPPROJECT_URI') )
	define( 'YA_AMPPROJECT_URI', 'https://cdn.ampproject.org/v0/');

function yahman_addons_amp_enqueue_script( $type ) {
	wp_enqueue_script('amp-'.$type, YA_AMPPROJECT_URI . 'amp-' .$type .'-0.1.js', array(), null );
}

function yahman_addons_amp_script_list() {
	
	return array(
		'ad',
		'form',
		'carousel',
		'image-lightbox',
		'iframe',
		'audio',
		'lightbox-gallery',
		'fit-text',
		'selector',
		'bind',
		'analytics',
		'facebook-like',
		'facebook-page',
		'twitter',
		'install-serviceworker',
		'gist',
	);
}

add_action('wp_enqueue_scripts','yahman_addons_amp_require_enqueue');
function yahman_addons_amp_require_enqueue( ) {

	wp_enqueue_script('amp','https://cdn.ampproject.org/v0.js', array(), null );

	
	$amp_script = array(
		'ad',
		'form',
		//'carousel',
		'image-lightbox',
		//'iframe',
		//'audio',

		//'lightbox-gallery',
		//'fit-text',
		//'selector',
		//'bind',
	);

	global $post;
	$the_content = $post->post_content;

	
	if($the_content){

		if (preg_match('/<iframe/', $the_content)) {
			$amp_script[] = 'iframe';
		}

		if (preg_match('/<audio/', $the_content)) {
			$amp_script[] = 'audio';
		}

		if (preg_match('/<script src="https:\/\/gist.github\.com\/.*\/(.*)\.js">/', $the_content)) {
			$amp_script[] = 'gist';
		}


	}



	$yahman_stylesheet = get_template();

	if($yahman_stylesheet === 'simple-days'){
		require_once YAHMAN_ADDONS_DIR . 'inc/amp/themes/simple-days.php';
		yahman_addons_Simple_Days_style();
		
		$maxcdn = 'https://maxcdn.bootstrapcdn.com';
		wp_enqueue_style('font-awesome4_cdn', $maxcdn.'/font-awesome/4.7.0/css/font-awesome.min.css', array(), null);
	}elseif($yahman_stylesheet === 'neatly'){
		require_once YAHMAN_ADDONS_DIR . 'inc/amp/themes/neatly.php';
		yahman_addons_Neatly_style();
	}elseif($yahman_stylesheet === 'laid-back'){
		require_once YAHMAN_ADDONS_DIR . 'inc/amp/themes/laid-back.php';
		yahman_addons_Laid_Back_style();
	}

	$option = get_option('yahman_addons') ;
	$amp_option['cta_facebook'] = isset($option['cta_social']['facebook']) ? true: false;
	$amp_option['cta_facebook_post'] = isset($option['cta_social']['post']) ? true: false;
	$amp_option['cta_facebook_page'] = isset($option['cta_social']['page']) ? true: false;
	$amp_option['facebook_account'] = isset($option['sns_account']['facebook']) ? $option['sns_account']['facebook'] : '';
	$amp_option['ga_gtag'] = isset($option['ga']['id']) ? $option['ga']['id'] : '';
	$amp_option['ga_amp'] = isset($option['amp']['ga']) ? $option['amp']['ga'] : '';

	if($amp_option['ga_gtag'] != '' || $amp_option['ga_amp'] != ''){

		$amp_script[] = 'analytics';

	}




	if($amp_option['cta_facebook'] && $amp_option['facebook_account'] != ''){
		if( ( is_single() && $amp_option['cta_facebook_post']) || ( is_page() && !is_front_page() && $amp_option['cta_facebook_page'] ) && !is_page_template('templates/title_content.php') && !is_page_template('templates/title_content_no_sidebar.php')  ){

			$amp_script[] = 'facebook-like';

			//wp_enqueue_script('amp-facebook-like','https://cdn.ampproject.org/v0/amp-facebook-like-0.1.js', array(), null );
		}
	}

	if ( is_active_widget( false, false, 'ya_twitter_widget', true ) ) {
		$amp_script[] = 'twitter';
	}

	if ( is_active_widget( false, false, 'ya_facebook_widget', true ) ) {
		$amp_script[] = 'facebook-page';
	}

	if(isset($option['pwa']['enable'])){
		$amp_script[] = 'install-serviceworker';
	}

	foreach ($amp_script as $key) {
		yahman_addons_amp_enqueue_script( $key );
	}

}



add_action('wp_head','yahman_addons_amp_head',0);

function yahman_addons_amp_head(){
	global $wp;
	?>
	<link rel="canonical" href="<?php echo esc_url(home_url( add_query_arg( array(), $wp->request ) )); ?>" />
	<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
	<meta name="amp-google-client-id-api" content="googleanalytics">
	<?php
}

add_action('template_redirect','yahman_addons_is_user_logged_in');
function yahman_addons_is_user_logged_in(){

	add_action( 'wp_footer', function() {
		ob_start( 'yahman_addons_head_amp_footer_replace' );
	}, 0 );

	function yahman_addons_head_amp_footer_replace($buffer) {
		$buffer = preg_replace('/<script type=\"text\/javascript\">(.*?)<\/script>/is', '', $buffer);
		$buffer = preg_replace('/<link rel=\"style(.*?)>/is', '', $buffer);

		$amp_keyframes = '';
		
		require_once ABSPATH . 'wp-admin/includes/file.php';
		WP_Filesystem();
		global $wp_filesystem;
		
		$yahman_stylesheet = get_template();
		if($yahman_stylesheet === 'simple-days'){
			$amp_keyframes = $wp_filesystem->get_contents( SIMPLE_DAYS_THEME_DIR.'assets/css/keyframes.min.css' );
		}elseif($yahman_stylesheet === 'neatly'){
			$amp_keyframes = $wp_filesystem->get_contents( NEATLY_THEME_DIR.'assets/css/keyframes.min.css' );
		}elseif($yahman_stylesheet === 'laid-back'){
			$amp_keyframes = $wp_filesystem->get_contents( LAID_BACK_THEME_DIR.'assets/css/keyframes.min.css' );
		}

		if($amp_keyframes !== '')
			$buffer = str_replace('</body>','<style amp-keyframes>'. $amp_keyframes .'</style></body>',$buffer);

		return $buffer;
	}


	add_action( 'widgets_init', function() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	} );
	




	
	add_filter( 'comment_reply_link', 	function ($comment_reply_link) {
		return preg_replace( '/ onclick=\'(.*?)\'/i', '', $comment_reply_link );
	} );


	
	add_filter( 'style_loader_tag', function ( $tag ) {
		return preg_replace( array( "/'/", '/(id|type|media)=".+?" */', '/ \/>/' ), array( '"', '', '>' ), $tag );
	} );

	add_filter( 'script_loader_tag','yahman_addons_replace_script_type');
	function yahman_addons_replace_script_type($tag) {

		$tag =  preg_replace('/^(?!.*(ampproject)).*$/i', '', $tag);
		$tag =  str_replace("type='text/javascript'", "async", $tag);

		if(strpos($tag,' async') === false){
			$tag =  str_replace("<script", "<script async", $tag);
		}


		
		$amp_script = yahman_addons_amp_script_list();

		foreach ($amp_script as $key) {
			$tag = str_replace('src=\'https://cdn.ampproject.org/v0/amp-'.$key.'-0.1.js\'', 'custom-element="amp-'.$key.'" src="https://cdn.ampproject.org/v0/amp-'.$key.'-0.1.js"', $tag);
		}

		return $tag;
	}


	remove_action('wp_head', 'rel_canonical');
	remove_action('wp_head', 'wp_resource_hints', 2);
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_head', 'rest_output_link_wp_head');
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_head', 'wp_oembed_add_host_js');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'edd_version_in_header');
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	add_filter( 'cancel_comment_reply_link', '__return_false' );
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles' );
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_action( 'wp_footer', 'wp_print_footer_scripts' );
	add_filter( 'show_recent_comments_widget_style', '__return_false', 99 );

}

if (!is_user_logged_in()){
	
	add_action( 'wp_enqueue_scripts', 'yahman_addons_remove_css', 99999999 );

	global $wp_scripts, $wp_styles;
	$wp_scripts = $wp_styles = new stdClass;

}


function yahman_addons_remove_css(){
	wp_dequeue_style( 'yahman_addons_social_icon' );

	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_deregister_style( 'wp-components' );

	
	wp_dequeue_style( 'font-awesome4' );

	$allow_style = array(
		'font-awesome4_cdn',
		'simple_days_block',
		'simple_days_block_one_column',
		'neatly_block',
		'neatly_block_one_column',
		'laid_back_block',
		'laid_back_block_one_column',
		'amp-custom',
	);

	$allow_script = array();
	$allow_script_list = yahman_addons_amp_script_list();
	$allow_script[] = 'amp';
	foreach ($allow_script_list as $key) {
		$allow_script[] = 'amp-'.$key;
	}

	global $wp_scripts;
	foreach( $wp_scripts->queue as $script ) :
		if(!in_array($script, $allow_script , true)){
			wp_dequeue_script($script);
		}
	endforeach;

    // Print all loaded Styles (CSS)
	global $wp_styles;
	foreach( $wp_styles->queue as $style ) :
		if(!in_array($style, $allow_style , true)){
			wp_dequeue_style( $style );
		}
	endforeach;

}


function yahman_addons_remove_specific_widget($sidebars_widgets){



	$ok_widget = array('ya_', 'custom_hp_' , 'recent-comments' , 'calendar' , 'tag_cloud' , 'meta' , 'search-');

	foreach($sidebars_widgets as $widget_area => $widget_list){

		foreach($widget_list as $pos => $widget_id){

			$judge = true;
			foreach($ok_widget as $key => $value){
				if(strpos($widget_id, $value) !== false){
					$judge = false;
					break;
				}

			}
			if($judge){
				unset($sidebars_widgets[$widget_area][$pos]);
			}

		}
	}

	return $sidebars_widgets;
}
add_filter('sidebars_widgets','yahman_addons_remove_specific_widget');


if(is_singular()){
	add_action( 'wp_footer', function (){
		echo '<amp-image-lightbox id="amp_image_lightbox" layout="nodisplay"></amp-image-lightbox>' . "\n";
	} );
}

add_action('wp_head', function() { ob_start('yahman_addons_amp_buffer_callback'); }, 10000);
add_action('shutdown', 'yahman_addons_ob_end_flush', 100000);


function yahman_addons_amp_buffer_callback ( $the_content ) {

	$option = get_option('yahman_addons') ;

	$the_content =  str_replace(' ontouchstart=""', '', $the_content);


	

	
	$the_content = mb_ereg_replace('\xc2\xa0', ' ', $the_content);
	
	
	$the_content = preg_replace('/<script src="https:\/\/gist.github\.com\/.*\/(.*)\.js"><\/script>/', '<amp-gist data-gistid="$1" layout="fixed-height" height="260"></amp-gist>', $the_content);

	
	$the_content = preg_replace('/<script.*?static\.codepen\.io\/assets\/embed\/ei\.js.*?>.*?<\/script>/iu','<a class="github_link" href="'.esc_url(get_the_permalink()).'">'.esc_html__( 'Code check to master page', 'yahman-add-ons' ).'</a>', $the_content);



	
	$pattern_front = '/style=[\'"](.*?)';
	$pattern_end = '(.*?)[\'"]/i';
	$pattern = array(
		$pattern_front.'zoom:.+?;'.$pattern_end,
			//$pattern_front.'--.+?:.+?;'.$pattern_end,
			//$pattern_front.'-webkit-.+?:.+?;'.$pattern_end,
			//$pattern_front.'-ms-.+?:.+?;'.$pattern_end,
		$pattern_front.'_display:.+?;'.$pattern_end,
		$pattern_front.'!important'.$pattern_end,
	);
	$append = 'style="$1$2"';
	$the_content = preg_replace($pattern, $append, $the_content);


	
	$pattern = '/<script language="javascript" src="(https?)?\/\/ad\.jp\.ap\.valuecommerce\.com\/servlet\/jsbanner.+?<a.+?ck\.jp\.ap\.valuecommerce\.com.+?sid=(\d+).+?pid=(\d+).+?<\/a><\/noscript>/';
	$append = '<amp-ad width="240" height="400" type="valuecommerce" data-sid="$2" data-pid="$3"></amp-ad>';
	$the_content = preg_replace($pattern, $append, $the_content);

		//$the_content = preg_replace(
		//	'/<form(.*?)>/iu',
		//	'<form$1 target="_top">', $the_content);


	$pattern = 'iframe';
	
	$the_content = preg_replace(array(
		'/<'.$pattern.'/i',
		'/<\/'.$pattern.'>/i',
	),
	array(
		'<amp-iframe layout="responsive"',
		'</amp-iframe>',
	),$the_content);


	$pattern = 'audio';
	
	$the_content = preg_replace(array(
		'/<'.$pattern.'/i',
		'/<\/'.$pattern.'>/i',
	),
	array(
		'<amp-audio ',
		'</amp-audio>',
	),$the_content);

	
	$the_content = str_replace('http://ecx.images-amazon.com','https://images-fe.ssl-images-amazon.com', $the_content);





	if(is_singular()){

		$pattern     = '{<a href="[^"]+?/wp-content/uploads.+?"><img(.+?)></a>}i';
		
		
		if (preg_match_all($pattern, $the_content, $match)) {
			$i = 0;
			foreach ($match[0] as $tag) {

				$any_tag = $match[1][$i];
				if (preg_match('/class="(.+?)"/i', $any_tag, $value)) {
					$any_tag = preg_replace('/class=".+?"/i', '', $any_tag );
					$the_content = str_replace($tag,
						'<amp-img class="amp-lightbox amp-image-lightbox '.$value[1].'" on="tap:amp_image_lightbox" role="button" tabindex="0"'.$any_tag.'>',
						$the_content);
				} else {
					$the_content = str_replace($tag,
						'<amp-img class="amp-lightbox amp-image-lightbox" on="tap:amp_image_lightbox" role="button" tabindex="0"'.$any_tag.'>',
						$the_content);
				}
				$i++;
			}


		}



	}


	if ( !function_exists( 'wp_body_open' ) ){
		if(isset($option['ga']['enable'])){

			$ga_amp_code = yahman_addons_ga_amp();
			$the_content = preg_replace('/<body(.*?)>/iu', '<body$1>'.$ga_amp_code, $the_content);

		}

		if( isset($option['pwa']['enable']) && isset($option['pwa']['amp_service_worker'] ) ){

			$the_content = yahman_addons_pwa_amp_sw( $option['pwa'] ) . $the_content;

		}

	}

	return $the_content;

}



function yahman_addons_amp_buffer_replace ( $the_content ) {

	$the_content =  preg_replace("/<html/", "<html ⚡", $the_content , 1 );
	$the_content =  preg_replace('/initial-scale=1/', 'minimum-scale=1,initial-scale=1', $the_content , 1);

	$the_content = str_replace("id='amp-custom-inline-css'", "amp-custom", $the_content);
	$the_content = preg_replace('/<link (.*?)type=\"text\/css\"(.*?)>/i', '', $the_content);

	
	$the_content = preg_replace(array(
		'/( onclick| border| scale marginwidth| marginheight| security| decoding)=[\'"]([^\'"]+)[\'"]/iu',
		'/<script(?!( async| type="application\/ld\+json")).*?>(.*?)<\/script>/isu',
		'/<style.(?!amp-(boilerplate|custom|keyframes)).*?<\/style>/isu',
		'/ +?target=[\'"](?!.*_blank).*?[\'"]/i',
		'/<font*?>/iu',
		'/<\/font>/iu',
		
		
	), '', $the_content);


	
	if( !YAHMAN_ADDONS_TEMPLATE ){

		
		$the_content = yahman_addons_amp_template_replace($the_content);


	}

	
	
	$amp_layout = array('nodisplay','fixed','responsive','fixed-height','fill','container','flex-item','intrinsic');

	$judge = preg_match_all('/<img(.+?)\/?>/is', $the_content, $match);

	if($judge){
		foreach ($match[0] as $str) {
			$src = $img_url = $width = $height = $class = $alt = $title = $size = $sizes = $layout = null;
			
			$judge = preg_match('/src=["\']([^"\']+?)["\']/is', $str, $value);
			if($judge){
				$src = $value[0];
				$img_url = $value[1];
			}

			
			$judge = preg_match('/width=["\']([^"\']*?)["\']/is', $str, $value);
			if ($judge) {
				$width = $value[1];
			}

			
			$judge = preg_match('/height=["\']([^"\']*?)["\']/is', $str, $value);
			if ($judge) {
				$height = $value[1];
			}

			
			$judge = preg_match('/class=["\']([^"\']*?)["\']/is', $str, $value);
			if ($judge) {
				$class = $value[1];
			}

			
			$judge = preg_match('/alt=["\']([^"\']*?)["\']/is', $str, $value);
			if ($judge) {
				$alt = $value[1];
			}

			
			$judge = preg_match('/title=["\']([^"\']*?)["\']/is', $str, $value);
			if ($judge) {
				$title = $value[1];
			}

			
			$judge = preg_match('/layout=["\']([^"\']*?)["\']/is', $str, $value);
			if ($judge) {
				if(in_array($value[1], $amp_layout, true))
					$layout = ' layout="'.$value[1].'"';
			}

			if($img_url && ( empty($width) || empty($height) ) ){
				$width = 240;
				$height = 240;
					//if(strpos($img_url,home_url()) !== false){
					//	if ( file_exists($img_url) ) {
					//		$size = getimagesize($img_url);
					//		$width = $size[0];
					//		$height = $size[1];
					//	}
					//}else{
				//$layout = ' layout="fixed-height"';
					//}

			}

			if ($width) {
				$sizes = ' sizes="(max-width: '.$width.'px) 100vw, '.$width.'px"';
				$width = ' width="'.$width.'"';
			}
			if ($height) {
				$height = ' height="'.$height.'"';
			}

			$amp_img = '<amp-img '.$src.$width.$height.' alt="'.$alt.'" title="'.$title.'" class="'.$class.'"'.$layout.$sizes.'></amp-img>';

			$the_content = preg_replace('{'.preg_quote($str).'}', $amp_img , $the_content, 1);

		}
	}


	return $the_content;
}


