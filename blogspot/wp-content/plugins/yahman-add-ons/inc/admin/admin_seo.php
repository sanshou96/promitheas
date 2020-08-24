<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin OGP Page
 *
 * @package YAHMAN Add-ons
 */
function yahman_addons_admin_seo($option,$option_key,$option_checkbox){

  foreach ($option_key['ogp'] as $key => $value  ) {
    $ogp[$key] = $option['ogp'][$key];
  }
  foreach ($option_checkbox['ogp'] as $key => $value  ) {
    $ogp[$key] = isset($option['ogp'][$key]) ? true: false;
  }
  foreach ($option_checkbox['json'] as $key => $value  ) {
    $json[$key] = isset($option['json'][$key]) ? true: false;
  }
  foreach ($option_checkbox['header'] as $key => $value  ) {
    $header[$key] = isset($option['header'][$key]) ? true: false;
  }

?>

<div id="ya_seo_content" class="tab_content dn fi15">
  <h3><?php esc_html_e('SEO','yahman-add-ons'); ?></h3>

  <table class="form-table">
    <tr valign="top">
      <th scope="row" colspan="2"><h3 style="background: #000; color:#fff; padding: 5px 10px; margin-bottom: 0;"><?php esc_html_e('Open Graph protocol', 'yahman-add-ons'); ?></h3></th>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="ogp_meta"><?php esc_html_e('Enable','yahman-add-ons'); ?></label><br />
        <label for="ogp_meta"><?php esc_html_e('add metadata for Open Graph protocol(OGP)', 'yahman-add-ons'); ?></label>
      </th>

      <td><input name="yahman_addons[ogp][meta]" type="checkbox" id="ogp_meta"<?php checked(true, $ogp['meta']); ?> class="ya_checkbox" /></td>
    </tr>

    <tr valign="top">
      <th scope="row"><label for="ogp_image"><?php esc_html_e('OGP Image','yahman-add-ons'); ?></label><br />
        <label for="ogp_image"><?php esc_html_e('If no thumbnail or home page then use this image.','yahman-add-ons'); ?></label>
      </th>
      <td>

        <div class="ogp_image" style="width: 100%; max-width:320px; height:auto;">
          <div class="ogp_image_id_placeholder" style="width: 100%; position: relative; text-align: center; cursor: default;border: 1px dashed #b4b9be;box-sizing: border-box;padding: 9px 0;line-height: 20px; margin: 10px 0;<?php if( !empty( $ogp['image'] ) ){echo 'display:none;';} ?>"><?php esc_html_e( 'No image selected', 'yahman-add-ons' ); ?></div>
          <img class="ogp_image_id_media_image custom_media_image" src="<?php if( !empty( $ogp['image'] ) ){echo esc_url($ogp['image']);} ?>" style="width: 100%; max-width: 120px; height:auto; margin-bottom: 10px;" />

        </div>
        <input type="hidden" type="text" class="ogp_image_id_media_id custom_media_id" name="yahman_addons[ogp][image_id]" id="ogp_image_id" value="<?php echo esc_attr($ogp['image_id']); ?>" />

        <input type="hidden" type="text" class="ogp_image_id_media_url custom_media_url" name="yahman_addons[ogp][image]" id="ogp_image_url" value="<?php echo esc_url($ogp['image']); ?>" >
        <input type="button" value="<?php esc_html_e( 'Clear Image', 'yahman-add-ons' ); ?>" class="button ogp_image_id_remove-button custom_media_clear" id="ogp_image_id" style="<?php if( !empty( $ogp['image'] ) ){echo 'display:inline-block;';}else{echo 'display:none;';} ?>" />
        <input type="button" value="<?php esc_html_e( 'Select Image', 'yahman-add-ons' ); ?>" class="button upload-button custom_media_upload" id="ogp_image_id"/>

      </td>
    </tr>

    <tr valign="top">
      <th scope="row"><label for="ogp_twitter_card"><?php esc_html_e('Twitter Card','yahman-add-ons'); ?></label></th>
      <td>
        <select name="yahman_addons[ogp][twitter_card]" id="ogp_twitter_card">
          <option value="false"<?php selected( $ogp['twitter_card'], 'false' ); ?>><?php esc_html_e('Disable', 'yahman-add-ons'); ?></option>
          <option value="summary"<?php selected( $ogp['twitter_card'], 'summary' ); ?>><?php esc_html_e('Summary Card', 'yahman-add-ons'); ?></option>
          <option value="summary_large_image"<?php selected( $ogp['twitter_card'], 'summary_large_image' ); ?>><?php esc_html_e('Summary Card with Large Image', 'yahman-add-ons'); ?></option>
        </select>
      </td>
    </tr>

    <tr valign="top">
      <th scope="row" colspan="2"><h3 style="background: #000; color:#fff; padding: 5px 10px; margin-bottom: 0;"><?php esc_html_e('Structured Data Markup', 'yahman-add-ons'); ?></h3></th>
    </tr>
    <tr valign="top">
      <th scope="row">
        <label for="json_breadcrumblist"><?php esc_html_e('BreadcrumbList using JSON-LD', 'yahman-add-ons'); ?></label>
      </th>
      <td><input name="yahman_addons[json][breadcrumblist]" type="checkbox" id="json_breadcrumblist"<?php checked(true, $json['breadcrumblist']); ?> class="ya_checkbox" /></td>
    </tr>

    <tr valign="top">
      <th scope="row">
        <label for="json_page"><?php esc_html_e('Page using JSON-LD', 'yahman-add-ons'); ?></label>
      </th>
      <td><input name="yahman_addons[json][page]" type="checkbox" id="json_page"<?php checked(true, $json['page']); ?> class="ya_checkbox" /></td>
    </tr>

    <tr valign="top">
      <th scope="row" colspan="2"><h3 style="background: #000; color:#fff; padding: 5px 10px; margin-bottom: 0;"><?php esc_html_e('Meta Data', 'yahman-add-ons'); ?></h3></th>
    </tr>
    <tr valign="top">
      <th scope="row">
        <label for="header_meta_thum"><?php echo esc_html__('add thumbnail to metadata', 'yahman-add-ons'); ?></label>
      </th>
      <td><input name="yahman_addons[header][meta_thum]" type="checkbox" id="header_meta_thum"<?php checked(true, $header['meta_thum']); ?> class="ya_checkbox" /></td>
    </tr>

    <tr valign="top">
      <th scope="row">
        <label for="header_meta_description"><?php echo esc_html__('add description to metadata', 'yahman-add-ons'); ?></label>
      </th>
      <td><input name="yahman_addons[header][meta_description]" type="checkbox" id="header_meta_description"<?php checked(true, $header['meta_description']); ?> class="ya_checkbox" /></td>
    </tr>

  </table>

</div>




<?php
}
