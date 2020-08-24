<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin Social Page
 *
 * @package YAHMAN Add-ons
 */

function yahman_addons_admin_social($option,$option_key,$option_checkbox){

  foreach ( $option_key['sns_account'] as $key => $value ) {
    $sns_account[$key] = $option['sns_account'][$key];
  }

  $widget_key = array(
    'sns_link',
  );

  foreach ($widget_key as $key ) {
    $widget[$key] = isset($option['widget'][$key]) ? true: false;
  }

  $sns_name = yahman_addons_social_name_list();
  unset($sns_name['none']);
  unset($sns_name['buffer']);
  unset($sns_name['digg']);
  unset($sns_name['mail']);
  unset($sns_name['evernote']);
  unset($sns_name['messenger']);
  unset($sns_name['pocket']);
  unset($sns_name['reddit']);
  unset($sns_name['whatsapp']);
  unset($sns_name['feedly']);
  unset($sns_name['rdf']);
  unset($sns_name['rss']);
  unset($sns_name['rss2']);
  unset($sns_name['atom']);
  unset($sns_name['print']);

  ?>
  <div id="ya_sns_content" class="tab_content dn fi15">
    <h3><?php esc_html_e('Social Account','yahman-add-ons'); ?></h3>

    <table class="form-table">
      <tr valign="top">
        <th scope="row"><label for="widget_sns_link"><?php esc_html_e('Add Social Links Widget','yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[widget][sns_link]" type="checkbox" id="widget_sns_link"<?php checked(true, $widget['sns_link']); ?> class="ya_checkbox" /></td>
      </tr>
      <?php

      foreach ($sns_name as $key => $value) {
        $sns_account[$key] = isset($option['sns_account'][$key]) ? $option['sns_account'][$key] : ''; ?>
        <tr valign="top">
          <th scope="row"><label for="sns_account_<?php echo esc_attr($key); ?>"><?php echo esc_html($value['name']); ?></label></th>
          <td><input name="yahman_addons[sns_account][<?php echo esc_attr($key); ?>]" type="text" id="sns_account_<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($sns_account[$key]); ?>" class="ya_textbox" />
            <?php
            if($key === 'amazon'){
              esc_html_e("add your Amazon website's full URL", 'yahman-add-ons').'<br />'.esc_html_e('e.g.&nbsp;', 'yahman-add-ons').esc_html_e('Your wish list URL', 'yahman-add-ons');
            }else if($key === 'tumblr'){
              yahman_addons_sns_account_eg_before('.tumblr.com');
            }else{
              yahman_addons_sns_account_eg($value['base']);
            }
            ?>

          </td>
        </tr>
        <?php

      }


      ?>

      <tr valign="top">
        <th scope="row"><label for="sns_account_facebook_app_id"><?php esc_html_e('Facebook App ID','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[sns_account][facebook_app_id]" type="text" id="sns_account_facebook_app_id" value="<?php echo esc_attr($sns_account['facebook_app_id']); ?>" class="ya_textbox" /><?php echo esc_html__(' e.g.&nbsp;', 'yahman-add-ons').esc_html('1234567890'); ?></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="sns_account_facebook_admins"><?php esc_html_e('Facebook fb:admins','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[sns_account][facebook_admins]" type="text" id="sns_account_facebook_admins" value="<?php echo esc_attr($sns_account['facebook_admins']); ?>" class="ya_textbox" /><?php echo esc_html__(' e.g.&nbsp;', 'yahman-add-ons').esc_html('1234567890'); ?></td>
      </tr>
    </table>

  </div>

  <?php
}

function yahman_addons_sns_account_eg($account){
 esc_html_e(' e.g.&nbsp;', 'yahman-add-ons');
 echo esc_html($account);
 echo '<strong class="highlighter">&lowast;&lowast;&lowast;&lowast;&lowast;&lowast;</strong><br />'.esc_html__('type the &lowast;&lowast;&lowast;&lowast;&lowast;&lowast; part of your url', 'yahman-add-ons');
}

function yahman_addons_sns_account_eg_before($account){
 esc_html_e(' e.g.&nbsp;', 'yahman-add-ons');
 echo '<strong class="highlighter">&lowast;&lowast;&lowast;&lowast;&lowast;&lowast;</strong>'.esc_html($account).'<br />'.esc_html__('type the &lowast;&lowast;&lowast;&lowast;&lowast;&lowast; part of your url', 'yahman-add-ons');
}