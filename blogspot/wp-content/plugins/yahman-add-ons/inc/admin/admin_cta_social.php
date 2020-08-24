<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin cta_social Page
 *
 * @package YAHMAN Add-ons
 */
function yahman_addons_admin_cta_social($option,$option_key,$option_checkbox){

  foreach ($option_key['cta_social'] as $key => $value  ) {
    $cta_social[$key] = $option['cta_social'][$key];
  }
  foreach ($option_checkbox['cta_social'] as $key => $value  ) {
    $cta_social[$key] = isset($option['cta_social'][$key]) ? true: false;
  }


  ?>

  <div id="ya_cta_social_content" class="tab_content dn fi15">
    <h3><?php esc_html_e('Social CTA','yahman-add-ons'); ?></h3>

    <table class="form-table">

      <tr valign="top">
        <th scope="row">
          <label for="cta_social_post"><?php esc_html_e('call-to-action under in the contents of the post','yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[cta_social][post]" type="checkbox" id="cta_social_post"<?php checked(true, $cta_social['post']); ?> class="ya_checkbox" /></td>
      </tr>
      <tr valign="top">
        <th scope="row">
          <label for="cta_social_page"><?php esc_html_e('call-to-action under in the contents of the page','yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[cta_social][page]" type="checkbox" id="cta_social_page"<?php checked(true, $cta_social['page']); ?> class="ya_checkbox" /></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="cta_social_heading"><?php esc_html_e('heading text','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[cta_social][heading]" type="text" id="cta_social_heading" value="<?php echo esc_html($cta_social['heading']); ?>" class="ya_textbox" style="width: 300px;" /></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="cta_social_ending"><?php esc_html_e('end text','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[cta_social][ending]" type="text" id="cta_social_ending" value="<?php echo esc_html($cta_social['ending']); ?>" class="ya_textbox" style="width: 300px;" /></td>
      </tr>


      <tr valign="top">
        <th scope="row"><label for="cta_social_facebook"><?php esc_html_e('Display','yahman-add-ons'); ?></label><br />
          <label for="cta_social_facebook"><?php esc_html_e('Facebook','yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[cta_social][facebook]" type="checkbox" id="cta_social_facebook"<?php checked(true, $cta_social['facebook']); ?> class="ya_checkbox" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="cta_social_facebook_script"><?php esc_html_e('Enable','yahman-add-ons'); ?></label><br />
          <label for="cta_social_facebook_script"><?php esc_html_e('required Facebook script.','yahman-add-ons'); ?></label><br />
          <label for="cta_social_facebook_script"><?php esc_html_e('be careful not to conflict','yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[cta_social][facebook_script]" type="checkbox" id="cta_social_facebook_script"<?php checked(true, $cta_social['facebook_script']); ?> class="ya_checkbox" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="cta_social_twitter"><?php esc_html_e('Display','yahman-add-ons'); ?></label><br />
          <label for="cta_social_twitter"><?php esc_html_e('Twitter','yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[cta_social][twitter]" type="checkbox" id="cta_social_twitter"<?php checked(true, $cta_social['twitter']); ?> class="ya_checkbox" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="cta_social_feedly"><?php esc_html_e('Display','yahman-add-ons'); ?></label><br />
          <label for="cta_social_feedly"><?php esc_html_e('Feedly','yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[cta_social][feedly]" type="checkbox" id="cta_social_feedly"<?php checked(true, $cta_social['feedly']); ?> class="ya_checkbox" /></td>
      </tr>


    </table>

  </div>

  <?php
}
