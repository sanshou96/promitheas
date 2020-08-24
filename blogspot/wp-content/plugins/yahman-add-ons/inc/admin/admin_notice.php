<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin notice Box Page
 *
 * @package YAHMAN Add-ons
 */
function yahman_addons_admin_notice($option,$option_key,$option_checkbox){

  foreach ($option_checkbox['notice'] as $key => $value  ) {
    $notice[$key] = isset($option['notice'][$key]) ? true: false;
  }

  ?>

  <div id="ya_notice_content" class="tab_content dn fi15">
    <h3><?php esc_html_e('Notice Box','yahman-add-ons'); ?></h3>

    <table class="form-table">
      <tr valign="top">
        <th scope="row"><label for="notice_enable"><?php esc_html_e('Enable','yahman-add-ons'); ?></label><br />
          <label for="notice_enable"><?php esc_html_e('Notice Box', 'yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[notice][enable]" type="checkbox" id="notice_enable"<?php checked(true, $notice['enable']); ?> class="ya_checkbox" /></td>
      </tr>

    </table>

  </div>




  <?php
}
