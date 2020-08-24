<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin PWA
 *
 * @package YAHMAN Add-ons
 */

function yahman_addons_admin_pwa($option,$option_key,$option_checkbox){

  foreach ($option_key['pwa'] as $key => $value  ) {
    $pwa[$key] = $option['pwa'][$key];
  }
  foreach ($option_checkbox['pwa'] as $key => $value  ) {
    $pwa[$key] = isset($option['pwa'][$key]) ? true: false;
  }

  ?>

  <div id="ya_pwa_content" class="tab_content dn fi15">
    <h3><?php esc_html_e('Progressive Web App','yahman-add-ons'); ?></h3>
    <table class="form-table">
      <tr valign="top">
        <th scope="row"><label for="pwa_enable"><?php esc_html_e('Enable','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[pwa][enable]" type="checkbox" id="pwa_enable"<?php checked(true, $pwa['enable']); ?> class="ya_checkbox" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="pwa_manifest"><?php esc_html_e('The manifest file','yahman-add-ons'); ?></label><br />
          <label for="pwa_manifest"><?php echo esc_html__('e.g.&nbsp;', 'yahman-add-ons').esc_html('manifest.json'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[pwa][manifest]" type="text" id="pwa_manifest" value="<?php echo esc_attr($pwa['manifest']); ?>" class="ya_textbox" />
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="pwa_service_worker"><?php esc_html_e('The Service Worker file','yahman-add-ons'); ?></label><br />
          <label for="pwa_service_worker"><?php echo esc_html__('e.g.&nbsp;', 'yahman-add-ons').esc_html('sw.js'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[pwa][service_worker]" type="text" id="pwa_service_worker" value="<?php echo esc_attr($pwa['service_worker']); ?>" class="ya_textbox" />
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="pwa_theme_color"><?php esc_html_e('Theme color','yahman-add-ons'); ?></label><br />
          <label for="pwa_theme_color"><?php echo esc_html__('e.g.&nbsp;', 'yahman-add-ons').esc_html('#5fb17f'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[pwa][theme_color]" type="text" id="pwa_theme_color" value="<?php echo esc_attr($pwa['theme_color']); ?>" class="ya_textbox" />
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="pwa_apple_touch_icon"><?php esc_html_e('apple-touch-icon','yahman-add-ons'); ?></label><br />
          <label for="pwa_apple_touch_icon"><?php echo esc_html__('e.g.&nbsp;', 'yahman-add-ons').esc_html('assets/icons/icon-192x192.png'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[pwa][apple_touch_icon]" type="text" id="pwa_apple_touch_icon" value="<?php echo esc_attr($pwa['apple_touch_icon']); ?>" class="ya_textbox" />
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="pwa_amp_service_worker"><?php esc_html_e('The Service Worker file when AMP','yahman-add-ons'); ?></label><br />
          <label for="pwa_amp_service_worker"><?php echo esc_html__('e.g.&nbsp;', 'yahman-add-ons').esc_html('sw_amp.js'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[pwa][amp_service_worker]" type="text" id="pwa_amp_service_worker" value="<?php echo esc_attr($pwa['amp_service_worker']); ?>" class="ya_textbox" />
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="pwa_amp_install_html"><?php esc_html_e('data-iframe-src attribute when AMP','yahman-add-ons'); ?></label><br />
          <label for="pwa_amp_install_html"><?php echo esc_html__('e.g.&nbsp;', 'yahman-add-ons').esc_html('serviceworker.html'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[pwa][amp_install_html]" type="text" id="pwa_amp_install_html" value="<?php echo esc_attr($pwa['amp_install_html']); ?>" class="ya_textbox" />
        </td>
      </tr>

    </table>

    <h4><?php esc_html_e('The post do not loading PWA when input post id.','yahman-add-ons'); ?></h4>
    <p class="description"><?php esc_html_e('Multiple id must be seperated by a comma.','yahman-add-ons'); ?></p>

    <table class="form-table">

      <tr valign="top">
        <th scope="row">
          <label for="pwa_post_not_in"><?php echo esc_html_e('Post ID','yahman-add-ons'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[pwa][post_not_in]" type="text" id="pwa_post_not_in" value="<?php echo $pwa['post_not_in']; ?>" class="widefat" />
        </td>
      </tr>

    </table>


    <h4><?php esc_html_e('Child page do not loading PWA when input parent post id.','yahman-add-ons'); ?></h4>
    <p class="description"><?php esc_html_e('Multiple id must be seperated by a comma.','yahman-add-ons'); ?></p>

    <table class="form-table">

      <tr valign="top">
        <th scope="row">
          <label for="pwa_parent_not_in"><?php echo esc_html_e('Post ID','yahman-add-ons'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[pwa][parent_not_in]" type="text" id="pwa_parent_not_in" value="<?php echo $pwa['parent_not_in']; ?>" class="widefat" />
        </td>
      </tr>

    </table>

  </div>




  <?php
}
