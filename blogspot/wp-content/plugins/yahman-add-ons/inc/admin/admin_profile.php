<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin Profile Page
 *
 * @package YAHMAN Add-ons
 */
function yahman_addons_admin_profile($option,$option_key,$option_checkbox){

  foreach ($option_key['profile'] as $key => $value  ) {
    $profile[$key] = $option['profile'][$key];
  }
  foreach ($option_checkbox['profile'] as $key => $value  ) {
    $profile[$key] = isset($option['profile'][$key]) ? true: false;
  }

  $widget_key = array(
    'profile',
    'another',
  );

  foreach ($widget_key as $key ) {
    $widget[$key] = isset($option['widget'][$key]) ? true: false;
  }

  $sns_name = yahman_addons_social_name_list();
  unset($sns_name['buffer']);
  unset($sns_name['digg']);
  unset($sns_name['evernote']);
  unset($sns_name['mail']);
  unset($sns_name['messenger']);
  unset($sns_name['pocket']);
  unset($sns_name['reddit']);
  unset($sns_name['whatsapp']);
  unset($sns_name['print']);





  $i = 1;
  while($i < 6){
    $profile['icon_'.$i] = isset($option['profile']['icon_'.$i]) ? $option['profile']['icon_'.$i] : 'none';
    ++$i;
  }
  //$profile['title'] = !empty($option['profile']['title']) ? $option['profile']['title'] : esc_html__( 'About me', 'yahman-add-ons' );
  //$profile['read_more_text'] = !empty($option['profile']['read_more_text']) ? $option['profile']['read_more_text'] : esc_html__( 'Read More', 'yahman-add-ons' );

  //$profile['icon_shape'] = isset($option['profile']['icon_shape']) ? $option['profile']['icon_shape'] : 'icon_square';
  //$profile['icon_size'] = isset($option['profile']['icon_size']) ? $option['profile']['icon_size'] : 'icon_medium';
  //$profile['icon_align']  = isset($option['profile']['icon_align']) ? $option['profile']['icon_align'] : 'center';
  //$profile['image_shape'] = isset($option['profile']['image_shape']) ? $option['profile']['image_shape'] : 'circle';
  //$profile['read_more_blank'] = isset($option['profile']['read_more_blank']) ? true: false;
  //$profile['icon_tooltip'] = isset($option['profile']['icon_tooltip']) ? true: false;

  ?>

  <div id="ya_profile_content" class="tab_content dn fi15">
    <h3><?php esc_html_e('Profile','yahman-add-ons'); ?></h3>

    <table class="form-table">
      <tr valign="top">
        <th scope="row"><label for="widget_profile"><?php esc_html_e('Add Profile Widget', 'yahman-add-ons'); ?></label>
        </th>

        <td><input name="yahman_addons[widget][profile]" type="checkbox" id="widget_profile"<?php checked(true, $widget['profile']); ?> class="ya_checkbox" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="profile_user_profile"><?php esc_html_e('Add Social area on User Profile', 'yahman-add-ons'); ?></label><br />
          <label for="profile_user_profile"><a href="<?php echo esc_url(admin_url('profile.php') ); ?>" target="_blank"><?php esc_html_e('Edit Profile', 'yahman-add-ons'); ?></a></label>
        </th>

        <td><input name="yahman_addons[profile][user_profile]" type="checkbox" id="profile_user_profile"<?php checked(true, $profile['user_profile']); ?> class="ya_checkbox" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="widget_another"><?php esc_html_e('Add Another Profile Widget', 'yahman-add-ons'); ?></label>
        </th>

        <td><input name="yahman_addons[widget][another]" type="checkbox" id="widget_another"<?php checked(true, $widget['another']); ?> class="ya_checkbox" /></td>
      </tr>





      <tr valign="top">
        <th scope="row"><label for="profile_title"><?php esc_html_e('Title','yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[profile][title]" type="text" id="profile_title" value="<?php echo esc_html($profile['title']); ?>" class="ya_textbox" style="width:100%;max-width:320px;" /></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="profile_name"><?php esc_html_e('Name','yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[profile][name]" type="text" id="profile_name" value="<?php echo esc_html($profile['name']); ?>" class="ya_textbox" style="width:100%;max-width:320px;" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="profile_img_id"><?php esc_html_e('Profile image','yahman-add-ons'); ?></label>
        </th>
        <td>

          <div class="profile_img" style="width: 100%; max-width:320px; height:auto;">
            <div class="profile_img_id_placeholder" style="width: 100%; position: relative; text-align: center; cursor: default;border: 1px dashed #b4b9be;box-sizing: border-box;padding: 9px 0;line-height: 20px; margin: 10px 0;<?php if( !empty( $profile['image'] ) ){echo 'display:none;';} ?>"><?php esc_html_e( 'No image selected', 'yahman-add-ons' ); ?></div>
            <img class="profile_img_id_media_image custom_media_image" src="<?php if( !empty( $profile['image'] ) ){echo esc_url($profile['image']);} ?>" style="width: 100%; max-width: 120px; height:auto; margin-bottom: 10px;" />

          </div>
          <input type="hidden" type="text" class="profile_img_id_media_id custom_media_id" name="yahman_addons[profile][image_id]" id="profile_img_id" value="<?php echo esc_attr($profile['image_id']); ?>" />

          <input type="hidden" type="text" class="profile_img_id_media_url custom_media_url" name="yahman_addons[profile][image]" id="profile_img_url" value="<?php echo esc_url($profile['image']); ?>" >
          <input type="button" value="<?php esc_html_e( 'Clear Image', 'yahman-add-ons' ); ?>" class="button profile_img_id_remove-button custom_media_clear" id="profile_img_id" style="<?php if( !empty( $profile['image'] ) ){echo 'display:inline-block;';}else{echo 'display:none;';} ?>" />
          <input type="button" value="<?php esc_html_e( 'Select Image', 'yahman-add-ons' ); ?>" class="button upload-button custom_media_upload" id="profile_img_id"/>

        </td>
      </tr>






      <tr valign="top">
        <th scope="row"><label for="profile_image_shape"><?php esc_html_e('Profile image display shape','yahman-add-ons'); ?></label></th>
        <td>
          <select name="yahman_addons[profile][image_shape]" id="profile_image_shape">
            <option value="circle"<?php selected( $profile['image_shape'], 'circle' ); ?>><?php esc_html_e('Circle', 'yahman-add-ons'); ?></option>
            <option value="square"<?php selected( $profile['image_shape'], 'square' ); ?>><?php esc_html_e('Square', 'yahman-add-ons'); ?></option>
          </select>
        </td>
      </tr>


      <tr valign="top">
        <th scope="row"><label for="profile_img_bg_id"><?php esc_html_e('Background image','yahman-add-ons'); ?></label>
        </th>
        <td>

          <div class="profile_img_bg" style="width: 100%; max-width:320px; height:auto;">
            <div class="profile_img_bg_id_placeholder" style="width: 100%; position: relative; text-align: center; cursor: default;border: 1px dashed #b4b9be;box-sizing: border-box;padding: 9px 0;line-height: 20px; margin: 10px 0;<?php if( !empty( $profile['image_bg'] ) ){echo 'display:none;';} ?>"><?php esc_html_e( 'No image selected', 'yahman-add-ons' ); ?></div>
            <img class="profile_img_bg_id_media_image custom_media_image" src="<?php if( !empty( $profile['image_bg'] ) ){echo esc_url($profile['image_bg']);} ?>" style="width: 100%; max-width: 120px; height:auto; margin-bottom: 10px;" />

          </div>
          <input type="hidden" type="text" class="profile_img_bg_id_media_id custom_media_id" name="yahman_addons[profile][image_bg_id]" id="profile_img_bg_id" value="<?php echo esc_attr($profile['image_bg_id']); ?>" />

          <input type="hidden" type="text" class="profile_img_bg_id_media_url custom_media_url" name="yahman_addons[profile][image_bg]" id="profile_img_url" value="<?php echo esc_url($profile['image_bg']); ?>" >
          <input type="button" value="<?php esc_html_e( 'Clear Image', 'yahman-add-ons' ); ?>" class="button profile_img_bg_id_remove-button custom_media_clear" id="profile_img_bg_id" style="<?php if( !empty( $profile['image_bg'] ) ){echo 'display:inline-block;';}else{echo 'display:none;';} ?>" />
          <input type="button" value="<?php esc_html_e( 'Select Image', 'yahman-add-ons' ); ?>" class="button upload-button custom_media_upload" id="profile_img_bg_id"/>

        </td>
      </tr>


      <tr valign="top">
        <th scope="row"><label for="profile_text"><?php esc_html_e('Profile text','yahman-add-ons'); ?></label>
        </th>
        <td><textarea name="yahman_addons[profile][text]" rows="4" cols="48" id="profile_text" class="ya_textbox" /><?php echo $profile['text']; ?></textarea>
        </td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="profile_read_more_url"><?php esc_html_e('Read more URL','yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[profile][read_more_url]" type="text" id="profile_read_more_url" value="<?php echo esc_url($profile['read_more_url']); ?>" class="ya_textbox" style="width:100%;max-width:320px;" /></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="profile_read_more_text"><?php esc_html_e('Read more text','yahman-add-ons'); ?></label>
        </th>
        <td><input name="yahman_addons[profile][read_more_text]" type="text" id="profile_read_more_text" value="<?php echo esc_html($profile['read_more_text']); ?>" class="ya_textbox" style="width:100%;max-width:320px;" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="profile_read_more_blank"><?php esc_html_e('Enable','yahman-add-ons'); ?></label><br />
          <label for="profile_read_more_blank"><?php esc_html_e('Read more link open new window.', 'yahman-add-ons'); ?></label>
        </th>

        <td><input name="yahman_addons[profile][read_more_blank]" type="checkbox" id="profile_read_more_blank"<?php checked(true, $profile['read_more_blank']); ?> class="ya_checkbox" /></td>
      </tr>

      <tr valign="top">
        <th scope="row" colspan="2"><h3 style="background: #000; color:#fff; padding: 5px 10px; margin-bottom: 0;"><?php  esc_html_e('Social settings', 'yahman-add-ons'); ?></h3></th>
      </tr>
      <?php
      $i = 1;

      while($i < 6){
        ?>
        <tr valign="top">
          <th scope="row"><label for="profile_icon_<?php echo esc_attr($i); ?>"><?php esc_html_e('Social Icon','yahman-add-ons'); ?> #<?php echo esc_attr($i); ?></label>
          </th>

          <td>
            <select name="yahman_addons[profile][icon_<?php echo esc_attr($i); ?>]" id="profile_icon_<?php echo esc_attr($i); ?>">
              <?php
              foreach ($sns_name as $key => $value) {
                echo '<option value="'.esc_attr($key).'"'.selected( $profile['icon_'.$i], $key ).'>'. esc_html($value['name']).'</option>';
              }
              ?>
            </select>
          </td>
        </tr>
        <?php
        ++$i;
      }
      ?>

      <tr valign="top">
        <th scope="row"><label for="profile_icon_shape"><?php esc_html_e('Display style','yahman-add-ons'); ?></label>
        </th>

        <td>
          <select name="yahman_addons[profile][icon_shape]" id="profile_icon_shape">
            <?php
            foreach (yahman_addons_social_shape_list() as $key => $value) {
              echo '<option value="'.esc_attr($key).'"'.selected( $profile['icon_shape'], $key ).'>'. esc_html($value).'</option>';
            }
            ?>
          </select>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="profile_icon_align"><?php esc_html_e('Align','yahman-add-ons'); ?></label>
        </th>

        <td>
          <select name="yahman_addons[profile][icon_align]" id="profile_icon_align">
            <?php

            foreach (yahman_addons_social_align_list() as $key => $value) {
              echo '<option value="'.esc_attr($key).'"'.selected( $profile['icon_align'], $key ).'>'. esc_html($value).'</option>';
            }
            ?>
          </select>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="profile_icon_size"><?php esc_html_e('Icon Size','yahman-add-ons'); ?></label>
        </th>

        <td>
          <select name="yahman_addons[profile][icon_size]" id="profile_icon_size">
            <?php
            foreach (yahman_addons_social_size_list() as $key => $value) {
              echo '<option value="'.esc_attr($key).'"'.selected( $profile['icon_size'], $key ).'>'. esc_html($value).'</option>';
            }
            ?>
          </select>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="profile_icon_user_color"><?php esc_html_e('Color of icon','yahman-add-ons'); ?></label>
        </th>

        <td>
          <input class="ya_color-picker" id="profile_icon_user_color" name="yahman_addons[profile][icon_user_color]" type="text" value="<?php echo esc_attr( $profile['icon_user_color'] ); ?>" data-alpha="true" />
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="profile_icon_user_hover_color"><?php esc_html_e('Hover color of icon','yahman-add-ons'); ?></label>
        </th>

        <td>
          <input class="ya_color-picker" id="profile_icon_user_hover_color" name="yahman_addons[profile][icon_user_hover_color]" type="text" value="<?php echo esc_attr( $profile['icon_user_hover_color'] ); ?>" data-alpha="true" />
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="profile_icon_tooltip"><?php esc_html_e('Tool tip','yahman-add-ons'); ?></label>
        </th>

        <td><input name="yahman_addons[profile][icon_tooltip]" type="checkbox" id="profile_icon_tooltip"<?php checked(true, $profile['icon_tooltip']); ?> class="ya_checkbox" /></td>
      </tr>

    </table>

  </div>




  <?php
}
