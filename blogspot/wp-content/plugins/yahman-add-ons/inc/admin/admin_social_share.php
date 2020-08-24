<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin Social Share Page
 *
 * @package YAHMAN Add-ons
 */
function yahman_addons_admin_social_share($option,$option_key,$option_checkbox){

  $sns_name = yahman_addons_social_name_list();
  unset($sns_name['feedly']);
  unset($sns_name['rdf']);
  unset($sns_name['rss']);
  unset($sns_name['rss2']);
  unset($sns_name['atom']);
  unset($sns_name['amazon']);
  unset($sns_name['codepen']);
  unset($sns_name['flickr']);
  unset($sns_name['github']);
  unset($sns_name['instagram']);
  unset($sns_name['meetup']);
  unset($sns_name['soundcloud']);
  unset($sns_name['vimeo']);
  unset($sns_name['youtube']);


  foreach ($option_key['share'] as $key => $value  ) {
    $share[$key] = $option['share'][$key];
  }
  foreach ($option_checkbox['share'] as $key => $value  ) {
    $share[$key] = isset($option['share'][$key]) ? true: false;
  }



?>

<div id="ya_share_content" class="tab_content dn fi15">
  <h3><?php esc_html_e('Social Share','yahman-add-ons'); ?></h3>


  <table class="form-table">
    <tr valign="top">
      <th scope="row">
        <label for="share_post"><?php esc_html_e('Social share under in the contents of the post','yahman-add-ons'); ?></label>
      </th>
      <td><input name="yahman_addons[share][post]" type="checkbox" id="share_post"<?php checked(true, $share['post']); ?> class="ya_checkbox" /></td>
    </tr>
    <tr valign="top">
      <th scope="row">
        <label for="share_page"><?php esc_html_e('Social share under in the contents of the page','yahman-add-ons'); ?></label>
      </th>
      <td><input name="yahman_addons[share][page]" type="checkbox" id="share_page"<?php checked(true, $share['page']); ?> class="ya_checkbox" /></td>
    </tr>

    <tr valign="top">
      <th scope="row"><label for="share_title"><?php esc_html_e('Title','yahman-add-ons'); ?></label>
      </th>
      <td><input name="yahman_addons[share][title]" type="text" id="share_title" value="<?php echo esc_html($share['title']); ?>" class="ya_textbox" /></td>
    </tr>

    <?php
    $i = 1;

    while($i < 11){
      $share['icon_'.$i] = isset($option['share']['icon_'.$i]) ? $option['share']['icon_'.$i] : 'none';
      ?>
      <tr valign="top">
        <th scope="row"><label for="share_icon_<?php echo esc_attr($i); ?>"><?php esc_html_e('Social Icon','yahman-add-ons'); ?> #<?php echo esc_attr($i); ?></label>
        </th>

        <td>
          <select name="yahman_addons[share][icon_<?php echo esc_attr($i); ?>]" id="share_icon_<?php echo esc_attr($i); ?>">
            <?php
            foreach ($sns_name as $key => $value) {
              echo '<option value="'.esc_attr($key).'"'.selected( $share['icon_'.$i], $key ).'>'. esc_html($value['name']).'</option>';
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
      <th scope="row"><label for="share_icon_shape"><?php esc_html_e('Display style','yahman-add-ons'); ?></label>
      </th>

      <td>
        <select name="yahman_addons[share][icon_shape]" id="share_icon_shape">
          <?php

          foreach (yahman_addons_social_shape_list() as $key => $value) {
            echo '<option value="'.esc_attr($key).'"'.selected( $share['icon_shape'], $key ).'>'. esc_html($value).'</option>';
          }
          ?>
        </select>
      </td>
    </tr>


    <tr valign="top">
      <th scope="row"><label for="share_icon_align"><?php esc_html_e('Align','yahman-add-ons'); ?></label>
      </th>

      <td>
        <select name="yahman_addons[share][icon_align]" id="share_icon_align">
          <?php

          foreach (yahman_addons_social_align_list() as $key => $value) {
            echo '<option value="'.esc_attr($key).'"'.selected( $share['icon_align'], $key ).'>'. esc_html($value).'</option>';
          }
          ?>
        </select>
      </td>
    </tr>


    <tr valign="top">
      <th scope="row"><label for="share_icon_size"><?php esc_html_e('Icon Size','yahman-add-ons'); ?></label>
      </th>

      <td>
        <select name="yahman_addons[share][icon_size]" id="share_icon_size">
          <?php

          foreach (yahman_addons_social_size_list() as $key => $value) {
            echo '<option value="'.esc_attr($key).'"'.selected( $share['icon_size'], $key ).'>'. esc_html($value).'</option>';
          }
          ?>
        </select>
      </td>
    </tr>

    <tr valign="top">
      <th scope="row"><label for="share_icon_user_color"><?php esc_html_e('Color of icon','yahman-add-ons'); ?></label>
      </th>

      <td>
        <input class="ya_color-picker" id="share_icon_user_color" name="yahman_addons[share][icon_user_color]" type="text" value="<?php echo esc_attr( $share['icon_user_color'] ); ?>" data-alpha="true" />
      </td>
    </tr>

    <tr valign="top">
      <th scope="row"><label for="share_icon_user_hover_color"><?php esc_html_e('Hover color of icon','yahman-add-ons'); ?></label>
      </th>

      <td>
        <input class="ya_color-picker" id="share_icon_user_hover_color" name="yahman_addons[share][icon_user_hover_color]" type="text" value="<?php echo esc_attr( $share['icon_user_hover_color'] ); ?>" data-alpha="true" />
      </td>
    </tr>

    <tr valign="top">
      <th scope="row"><label for="share_icon_tooltip"><?php esc_html_e('Tool tip','yahman-add-ons'); ?></label>
      </th>

      <td><input name="yahman_addons[share][icon_tooltip]" type="checkbox" id="share_icon_tooltip"<?php checked(true, $share['icon_tooltip']); ?> class="ya_checkbox" /></td>
    </tr>



  </table>

</div>

<?php
}
