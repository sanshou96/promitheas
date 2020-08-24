<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin Site map Page
 *
 * @package YAHMAN Add-ons
 */
function yahman_addons_admin_sitemap($option,$option_key,$option_checkbox){

  foreach ($option_key['sitemap'] as $key => $value  ) {
    $sitemap[$key] = $option['sitemap'][$key];
  }
  foreach ($option_checkbox['sitemap'] as $key => $value  ) {
    $sitemap[$key] = isset($option['sitemap'][$key]) ? true: false;
  }

  ?>

  <div id="ya_sitemap_content" class="tab_content dn fi15">
    <h3><?php esc_html_e('Site map','yahman-add-ons'); ?></h3>

    <table class="form-table">
      <tr valign="top">
        <th scope="row"><label for="sitemap_enable"><?php esc_html_e('Enable','yahman-add-ons'); ?></label><br />
          <label for="sitemap_enable"><?php esc_html_e('Display the site map at the page.', 'yahman-add-ons'); ?></label>
        </th>

        <td><input name="yahman_addons[sitemap][enable]" type="checkbox" id="sitemap_enable"<?php checked(true, $sitemap['enable']); ?> class="ya_checkbox" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="sitemap_slug"><?php esc_html_e('Page slug to be display at the page.','yahman-add-ons'); ?></label><br />
          <label for="sitemap_slug"><?php echo esc_html__('e.g.&nbsp;', 'yahman-add-ons').' sitemap'; ?></label>
        </th>
        <td><input name="yahman_addons[sitemap][slug]" type="text" id="sitemap_slug" value="<?php echo esc_html($sitemap['slug']); ?>" class="ya_textbox" /></td>
      </tr>
    </table>

    <h4><?php esc_html_e('Exclude when you type post id.','yahman-add-ons'); ?></h4>
    <p class="description"><?php esc_html_e('Multiple id must be seperated by a comma.','yahman-add-ons'); ?></p>

    <table class="form-table">

      <tr valign="top">
        <th scope="row">
          <label for="sitemap_exclude"><?php echo esc_html_e('Post ID','yahman-add-ons'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[sitemap][exclude]" type="text" id="sitemap_exclude" value="<?php echo $sitemap['exclude']; ?>" class="widefat" />
        </td>
      </tr>

    </table>

    <h4><?php esc_html_e('Child page exclude when input parent post id.','yahman-add-ons'); ?></h4>
    <p class="description"><?php esc_html_e('Multiple id must be seperated by a comma.','yahman-add-ons'); ?></p>

    <table class="form-table">

      <tr valign="top">
        <th scope="row">
          <label for="sitemap_exclude_tree"><?php echo esc_html_e('Post ID','yahman-add-ons'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[sitemap][exclude_tree]" type="text" id="sitemap_exclude_tree" value="<?php echo $sitemap['exclude_tree']; ?>" class="widefat" />
        </td>
      </tr>

    </table>

  </div>




  <?php
}
