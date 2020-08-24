<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin Pageview Page
 *
 * @package YAHMAN Add-ons
 */

function yahman_addons_admin_page_view($option,$option_key,$option_checkbox){

  foreach ($option_checkbox['pv'] as $key => $value  ) {
    $pv[$key] = isset($option['pv'][$key]) ? true: false;
  }

  $widget_key = array(
    'pv',
    'pp',
  );
  foreach ($widget_key as $key ) {
    $widget[$key] = isset($option['widget'][$key]) ? true: false;
  }
  ?>

  <div id="ya_pv_content" class="tab_content dn fi15">
    <h3><?php esc_html_e('Pageview','yahman-add-ons'); ?></h3>

    <table class="form-table">
      <tr valign="top">
        <th scope="row"><label for="pv_enable"><?php esc_html_e('Count of Pageview','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[pv][enable]" type="checkbox" id="pv_enable"<?php checked(true, $pv['enable']); ?> class="ya_checkbox" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="widget_pv"><?php esc_html_e('Add Widget of Pageview','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[widget][pv]" type="checkbox" id="widget_pv"<?php checked(true, $widget['pv']); ?> class="ya_checkbox" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="widget_pp"><?php esc_html_e('Add Widget of Popular Post','yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[widget][pp]" type="checkbox" id="widget_pp"<?php checked(true, $widget['pp']); ?> class="ya_checkbox" /></td>
      </tr>



    </table>

    <h4><?php esc_html_e('Reset the post pageview','yahman-add-ons'); ?></h4>
    <p class="description"><?php esc_html_e('Multiple id must be seperated by a comma.','yahman-add-ons'); ?></p>

    <table class="form-table">

      <tr valign="top">
        <th scope="row">
          <label for="pv_count_reset"><?php echo esc_html_e('Post ID','yahman-add-ons'); ?></label>
        </th>
        <td>
          <input name="yahman_addons_reset[pv][count]" type="text" id="pv_count_reset" value="" class="widefat" />
        </td>
      </tr>

    </table>

  </div>




  <?php
}
