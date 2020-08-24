<?php
defined( 'ABSPATH' ) || exit;



function yahman_addons_add_menu() {
	$yahman_addons_admin_page = add_options_page(esc_html__('Setting Up YAHMAN Add-ons','yahman-add-ons'),'YAHMAN Add-ons', 'administrator', 'yahman-add-ons','yahman_addons_admin_page');

	
	require_once YAHMAN_ADDONS_DIR . 'inc/enqueue.php';

	add_action( "admin_print_scripts-$yahman_addons_admin_page", 'yahman_addons_admin_page_scripts' );
}
add_action( 'admin_menu', 'yahman_addons_add_menu' );


function yahman_addons_admin_page() {

	if (!current_user_can('manage_options')){
		wp_die( esc_html__('You do not have sufficient permissions to access this page.','yahman-add-ons') );
	}

	require_once YAHMAN_ADDONS_DIR . 'inc/admin_menu.php';

}

$option =  get_option('yahman_addons') ;

$notice['enable'] = isset($option['notice']['enable']) ? true: false;

if($notice['enable'])
	require_once YAHMAN_ADDONS_DIR . 'inc/notice.php';

$profile['user_profile'] = isset($option['profile']['user_profile']) ? true: false;

if($profile['user_profile'])
	require_once YAHMAN_ADDONS_DIR . 'inc/user_profile.php';

$header['meta_description'] = isset($option['header']['meta_description']) ? true: false;
if($header['meta_description']){
	require_once YAHMAN_ADDONS_DIR . 'inc/classes/header_meta.php';

	new YAHMAN_ADDONS_ADD_META_TAGS();
}


if( isset($option['blogcard']['internal']) || isset($option['blogcard']['external']) ){

	
	function yahman_addons_blog_card_add_quicktags() {

		global $hook_suffix;

		if ( ( 'post.php' == $hook_suffix || 'post-new.php' == $hook_suffix ) && wp_script_is('quicktags')){
			?>
			<style>#yahman_bc_btn,.yahman_bc_popup{display:none;opacity:0}#yahman_bc_btn:checked ~ .yahman_bc_popup{display:block;opacity:1;width:100vw;height:100vh;position:absolute;top:0;left:0;z-index:9999}.yahman_bc_close_popup{position:fixed;display:block;left:0;top:0;width:100vw;height:100vh;background:rgba(0,0,0,.8);z-index:10000;cursor:pointer}.yahman_bc_popup_wrap{position:fixed;left:50%;top:50%;transform:translate(-50%,-50%);width:auto;max-height:90%;height:fit-content;max-width:540px;padding:24px 24px;background:#fff;border-radius:10px;z-index:10001;overflow-y:scroll;overflow-x:hidden;-ms-overflow-style:none}.yahman_bc_popup_wrap::-webkit-scrollbar{display:none}.yahman_bc_close_btn{position:absolute;right:6px;top:0;cursor:pointer;font-size:20px;color:#333;margin:0}</style>

			<div>
				<input id="yahman_bc_btn" type="checkbox" />
				<div class="yahman_bc_popup">
					<label class="yahman_bc_close_popup" for="yahman_bc_btn"></label>
					<div class="yahman_bc_popup_wrap">
						<label class="yahman_bc_close_btn" for="yahman_bc_btn">&#10006;</label>
						<label for="ya_blog_card_url">URL</label>
						<input id="ya_blog_card_url" name="Text" type="text" value="" class="" />
						<input class="button button-primary" name="Insert" title="Insert" value="<?php esc_html_e('Insert','yahman-add-ons'); ?>" type="button" onClick="yahman_addons_input_blog_card_insert(this)">
						<div style="display:flex;align-items:center;margin-top:12px;">
							<input id="ya_blog_card_blank" type="checkbox" style="margin:0 8px 0 0;" />
							<label for="ya_blog_card_blank"><?php esc_html_e('Open link in a new tab','yahman-add-ons'); ?></label>
						</div>
					</div>
				</div>
			</div>

			<script>function yahman_addons_input_blog_card_insert(){var a=document.getElementById("ya_blog_card_url").value;if(a===""){exit;}var c="";if(document.getElementById("ya_blog_card_blank").checked===true){c=' target="_blank"';}a='<p><a href="'+a+'"'+c+">"+a+"</a></p>";var b=window.dialogArguments||opener||parent||top;b.send_to_editor(a);document.getElementById("ya_blog_card_url").value="";document.getElementById("ya_blog_card_blank").checked=false;document.getElementById("yahman_bc_btn").checked=false;}function yahman_addons_input_blog_card_url(){document.getElementById("yahman_bc_btn").checked=true;document.getElementById("ya_blog_card_url").focus();}
			QTags.addButton( 'blog_card', '<?php esc_html_e('Blog Card','yahman-add-ons'); ?>', yahman_addons_input_blog_card_url );</script>
			<?php
		}
	}
	add_action( 'admin_print_footer_scripts', 'yahman_addons_blog_card_add_quicktags' );

	
	function yahman_addons_blog_card_tinymce_button() {

		add_filter( 'mce_buttons', 'yahman_addons_blog_card_register_tinymce_button' );
		add_filter( 'mce_external_plugins', 'yahman_addons_blog_card_tinymce_button_script' );

	}
	add_action( 'admin_init', 'yahman_addons_blog_card_tinymce_button' );

	
	function yahman_addons_blog_card_register_tinymce_button( $buttons ) {
		array_push( $buttons, 'yahman_addons_blog_card_button' );

		return $buttons;
	}

	
	function yahman_addons_blog_card_tinymce_button_script( $plugin_array ) {
		$plugin_array['yahman_addons_blog_card_script'] = YAHMAN_ADDONS_URI . 'assets/js/tinymce/blog_card.min.js';
		return $plugin_array;
	}





}


add_action( 'save_post', 'yahman_addons_remove_amp_cache' );
function yahman_addons_remove_amp_cache( $post_ID ) {

	delete_transient( 'ya_amp_cache_' . $post_ID );
	delete_transient( 'ya_faster_cache_' . $post_ID );

}


