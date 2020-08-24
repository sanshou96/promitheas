<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin Blog Card Page
 *
 * @package YAHMAN Add-ons
 */
function yahman_addons_admin_blog_card($option,$option_key,$option_checkbox){

  foreach ($option_checkbox['blogcard'] as $key => $value  ) {
    $blogcard[$key] = isset($option['blogcard'][$key]) ? true: false;
  }

  ?>

  <div id="ya_blogcard_content" class="tab_content dn fi15">
    <h3><?php esc_html_e('Blog Card','yahman-add-ons'); ?></h3>


    <table class="form-table">
      <tr valign="top">
        <th scope="row"><label for="blogcard_internal"><?php esc_html_e('Enable','yahman-add-ons'); ?></label><br />
          <label for="blogcard_internal"><?php esc_html_e('(internal site)', 'yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[blogcard][internal]" type="checkbox" id="blogcard_internal"<?php checked(true, $blogcard['internal']); ?> class="ya_checkbox" /></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="blogcard_external"><?php esc_html_e('Enable','yahman-add-ons'); ?></label><br />
          <label for="blogcard_external"><?php esc_html_e('(external site)', 'yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[blogcard][external]" type="checkbox" id="blogcard_external"<?php checked(true, $blogcard['external']); ?> class="ya_checkbox" /></td>
      </tr>

    </table>

  </div>




  <?php
}
