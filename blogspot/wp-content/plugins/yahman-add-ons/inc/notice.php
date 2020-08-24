<?php
defined( 'ABSPATH' ) || exit;


function yahman_addons_add_quicktags() {

  if (wp_script_is('quicktags')){
    ?>
  <script type="text/javascript">
   QTags.addButton( 'notice-info', '<?php esc_html_e( 'BOX (info)', 'yahman-add-ons' ); ?>', '<div class="ya_notice ya_info shadow_box">', '</div>', '', '<?php esc_html_e( 'Notice', 'yahman-add-ons' ); ?>', 1010 );
   QTags.addButton( 'notice-success', '<?php esc_html_e( 'BOX (Success)', 'yahman-add-ons' ); ?>', '<div class="ya_notice ya_success shadow_box">', '</div>', '', '<?php esc_html_e( 'Notice', 'yahman-add-ons' ); ?>', 1011 );
   QTags.addButton( 'notice-alert', '<?php esc_html_e( 'BOX (Warning)', 'yahman-add-ons' ); ?>', '<div class="ya_notice ya_warning shadow_box">', '</div>', '', '<?php esc_html_e( 'Notice', 'yahman-add-ons' ); ?>', 1012 );
   QTags.addButton( 'notice-danger', '<?php esc_html_e( 'BOX (Danger)', 'yahman-add-ons' ); ?>', '<div class="ya_notice ya_danger shadow_box">', '</div>', '', '<?php esc_html_e( 'Notice', 'yahman-add-ons' ); ?>', 1013 );
 </script>
 <?php
}
}
add_action( 'admin_print_footer_scripts', 'yahman_addons_add_quicktags' );



function yahman_addons_add_editor_styles() {

  if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {

    add_filter( 'mce_buttons', 'yahman_addons_tiny_mce_register_buttons' );
    add_filter( 'mce_external_plugins', 'yahman_addons_tiny_mce_register_script' );
    add_filter( 'mce_css', 'yahman_addons_tiny_mce_editor_styles' );

  }
}

add_action( 'admin_init', 'yahman_addons_add_editor_styles' );


function yahman_addons_tiny_mce_register_script( $plugins ) {
  $plugins['yahman_addons_notice_plugin'] = YAHMAN_ADDONS_URI . 'assets/js/tinymce/tiny-mce.js';
  return $plugins;
}



function yahman_addons_tiny_mce_register_buttons( $buttons ) {
  $newBtns = array(
    'yahman_addons_notice_list'
  );
  $buttons = array_merge( $buttons, $newBtns );
  return $buttons;
}

function yahman_addons_tiny_mce_editor_styles( $mce_css ) {
  if ( ! empty( $mce_css ) )
    $mce_css .= ',';

  $mce_css .= YAHMAN_ADDONS_URI. 'assets/css/custom-editor-style.min.css' ;

  return $mce_css;

}

function yahman_addons_gutenberg_editor_styles() {
  wp_enqueue_style( 'yahman_addons_gutenberg_editor_styles', YAHMAN_ADDONS_URI . 'assets/css/custom-editor-style.min.css',array( 'wp-edit-blocks' ) );
}

add_action( 'enqueue_block_editor_assets', 'yahman_addons_gutenberg_editor_styles' );
