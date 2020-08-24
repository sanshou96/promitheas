<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin AMP
 *
 * @package YAHMAN Add-ons
 */

function yahman_addons_admin_amp($option,$option_key,$option_checkbox){

  foreach ($option_key['amp'] as $key => $value  ) {
    $amp[$key] = $option['amp'][$key];
  }
  foreach ($option_checkbox['amp'] as $key => $value  ) {
    $amp[$key] = isset($option['amp'][$key]) ? true: false;
  }

  //$amp['logo'] = !empty($option['amp']['logo']) ? $option['amp']['logo'] : YAHMAN_ADDONS_URI . 'assets/images/amp-logo.png';
  //$amp['logo_id'] = isset($option['amp']['logo_id']) ? $option['amp']['logo_id'] : '';
  //$amp['ga'] = isset($option['amp']['ga']) ? $option['amp']['ga'] : '';

  //$amp['post_not_in'] = isset($option['amp']['post_not_in']) ? $option['amp']['post_not_in']: '';

  ?>

  <div id="ya_amp_content" class="tab_content dn fi15">
    <h3><?php esc_html_e('AMP','yahman-add-ons'); ?></h3>
    <h4><?php esc_html_e('If the theme is Simple Days or Neatly, keep the theme style.','yahman-add-ons'); ?></h4>
    <h4><?php esc_html_e('Other themes have a simple style.','yahman-add-ons'); ?></h4>
    <table class="form-table">
      <tr valign="top">
        <th scope="row"><label for="amp_enable"><?php esc_html_e('Enable','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[amp][enable]" type="checkbox" id="amp_enable"<?php checked(true, $amp['enable']); ?> class="ya_checkbox" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="amp_logo"><?php esc_html_e('AMP Logo Image','yahman-add-ons'); ?></label><br />
          <label for="amp_logo"><?php esc_html_e('AMP Logo use this image.','yahman-add-ons'); ?></label><br />
          <label for="amp_logo"><?php echo esc_html__( 'For more information', 'yahman-add-ons').' <a href="'.esc_url('https://developers.google.com/search/docs/data-types/article#guidelines').'" target="_blank">'.esc_html__( 'click here' , 'yahman-add-ons').'</a>'; ?></label>
        </th>
        <td>

          <div class="amp_logo" style="width: 100%; max-width:640px; height:auto;">
            <div class="amp_logo_id_placeholder" style="width: 100%; position: relative; text-align: center; cursor: default;border: 1px dashed #b4b9be;box-sizing: border-box;padding: 9px 0;line-height: 20px; margin: 10px 0;<?php if( !empty( $amp['logo'] ) ){echo 'display:none;';} ?>"><?php esc_html_e( 'No image selected', 'yahman-add-ons' ); ?></div>
            <img class="amp_logo_id_media_image custom_media_image" src="<?php if( !empty( $amp['logo'] ) ){echo esc_url($amp['logo']);} ?>" style="width: 100%; max-width: 640px; height:auto; margin-bottom: 10px;" />

          </div>
          <input type="hidden" type="text" class="amp_logo_id_media_id custom_media_id" name="yahman_addons[amp][logo_id]" id="amp_logo_id" value="<?php echo esc_attr($amp['logo_id']); ?>" />

          <input type="hidden" type="text" class="amp_logo_id_media_url custom_media_url" name="yahman_addons[amp][logo]" id="amp_logo_url" value="<?php echo esc_url($amp['logo']); ?>" >
          <input type="button" value="<?php esc_html_e( 'Clear Image', 'yahman-add-ons' ); ?>" class="button amp_logo_id_remove-button custom_media_clear" id="amp_logo_id" style="<?php if( !empty( $amp['logo'] ) ){echo 'display:inline-block;';}else{echo 'display:none;';} ?>" />
          <input type="button" value="<?php esc_html_e( 'Select Image', 'yahman-add-ons' ); ?>" class="button upload-button custom_media_upload" id="amp_logo_id"/>

        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="amp_ga"><?php esc_html_e('Google Analytics AMP account','yahman-add-ons'); ?></label><br />
          <label for="amp_ga"><?php echo esc_html__('e.g.&nbsp;', 'yahman-add-ons').esc_html('UA-XXXXXX-Y'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[amp][ga]" type="text" id="amp_ga" value="<?php echo esc_attr($amp['ga']); ?>" class="ya_textbox" />
        </td>
      </tr>

    </table>

    <h4><?php echo sprintf( esc_html__( 'Input post id then the post do not change to %s.', 'yahman-add-ons'), 'AMP'); ?></h4>
    <p class="description"><?php esc_html_e('Multiple id must be seperated by a comma.','yahman-add-ons'); ?></p>

    <table class="form-table">

      <tr valign="top">
        <th scope="row">
          <label for="amp_post_not_in"><?php echo esc_html_e('Post ID','yahman-add-ons'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[amp][post_not_in]" type="text" id="amp_post_not_in" value="<?php echo $amp['post_not_in']; ?>" class="widefat" />
        </td>
      </tr>

    </table>

    <h4><?php echo sprintf( esc_html__( 'Input parent post id then child page do not change to %s.','yahman-add-ons'), 'AMP'); ?></h4>
    <p class="description"><?php esc_html_e('Multiple id must be seperated by a comma.','yahman-add-ons'); ?></p>

    <table class="form-table">

      <tr valign="top">
        <th scope="row">
          <label for="amp_parent_not_in"><?php echo esc_html_e('Post ID','yahman-add-ons'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[amp][parent_not_in]" type="text" id="amp_parent_not_in" value="<?php echo $amp['parent_not_in']; ?>" class="widefat" />
        </td>
      </tr>

    </table>


    <table class="form-table">
      <tr valign="top">
        <th scope="row"><label for="amp_cache"><?php esc_html_e('Cache','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[amp][cache]" type="checkbox" id="amp_cache"<?php checked(true, $amp['cache']); ?> class="ya_checkbox" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="amp_cache_period"><?php esc_html_e('Cache period','yahman-add-ons'); ?></label></th>
        <td>
          <select name="yahman_addons[amp][cache_period]" id="amp_cache_period">
            <option value="1"<?php selected( $amp['cache_period'], '1' ); ?>>1</option>
            <option value="2"<?php selected( $amp['cache_period'], '2' ); ?>>2</option>
            <option value="3"<?php selected( $amp['cache_period'], '3' ); ?>>3</option>
            <option value="4"<?php selected( $amp['cache_period'], '4' ); ?>>4</option>
            <option value="5"<?php selected( $amp['cache_period'], '5' ); ?>>5</option>
            <option value="6"<?php selected( $amp['cache_period'], '6' ); ?>>6</option>
            <option value="7"<?php selected( $amp['cache_period'], '7' ); ?>>7</option>
            <option value="14"<?php selected( $amp['cache_period'], '14' ); ?>>14</option>
            <option value="21"<?php selected( $amp['cache_period'], '21' ); ?>>21</option>
            <option value="28"<?php selected( $amp['cache_period'], '28' ); ?>>28</option>
            </select><?php esc_html_e('Days','yahman-add-ons'); ?>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="amp_cache_delete"><?php esc_html_e('Cache all delete','yahman-add-ons'); ?></label></th>
          <td><input name="yahman_addons_reset[amp][cache]" type="checkbox" id="amp_cache_delete" class="ya_checkbox" /></td>
        </tr>
      </table>



    <h4><?php echo sprintf( esc_html__( 'Input post id then the post do not change to %s.', 'yahman-add-ons'), esc_html__( 'cache', 'yahman-add-ons') ); ?></h4>
    <p class="description"><?php esc_html_e('Multiple id must be seperated by a comma.','yahman-add-ons'); ?></p>

    <table class="form-table">

      <tr valign="top">
        <th scope="row">
          <label for="amp_cache_post_not_in"><?php echo esc_html_e('Post ID','yahman-add-ons'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[amp][cache_post_not_in]" type="text" id="amp_cache_post_not_in" value="<?php echo $amp['cache_post_not_in']; ?>" class="widefat" />
        </td>
      </tr>

    </table>

    <h4><?php echo sprintf( esc_html__( 'Input parent post id then child page do not change to %s.','yahman-add-ons'), esc_html__( 'cache', 'yahman-add-ons') ); ?></h4>
    <p class="description"><?php esc_html_e('Multiple id must be seperated by a comma.','yahman-add-ons'); ?></p>

    <table class="form-table">

      <tr valign="top">
        <th scope="row">
          <label for="amp_cache_parent_not_in"><?php echo esc_html_e('Post ID','yahman-add-ons'); ?></label>
        </th>
        <td>
          <input name="yahman_addons[amp][cache_parent_not_in]" type="text" id="amp_cache_parent_not_in" value="<?php echo $amp['cache_parent_not_in']; ?>" class="widefat" />
        </td>
      </tr>

    </table>

    </div>




    <?php
  }
