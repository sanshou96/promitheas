<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin Related posts
 *
 * @package YAHMAN Add-ons
 */
function yahman_addons_admin_related_posts($option,$option_key,$option_checkbox){

  foreach ($option_key['related_posts'] as $key => $value  ) {
    $related_posts[$key] = $option['related_posts'][$key];
  }
  foreach ($option_checkbox['related_posts'] as $key => $value  ) {
    $related_posts[$key] = isset($option['related_posts'][$key]) ? true: false;
  }

  ?>

  <div id="ya_related_posts_content" class="tab_content dn fi15">
    <h3><?php esc_html_e('Related Posts','yahman-add-ons'); ?></h3>

    <table class="form-table">

      <tr valign="top">
        <th scope="row"><label for="related_posts_post"><?php esc_html_e('Related posts under in the contents of the post','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[related_posts][post]" type="checkbox" id="related_posts_post"<?php checked(true, $related_posts['post']); ?> class="ya_checkbox" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="related_posts_post_title"><?php esc_html_e('Post title','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[related_posts][post_title]" type="text" id="cta_social_heading" value="<?php echo esc_attr($related_posts['post_title']); ?>" class="ya_textbox" style="width: 300px;" /></td>
      </tr>


      <tr valign="top">
        <th scope="row"><label for="related_posts_post_num"><?php esc_html_e('Maximum number of Related Posts','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[related_posts][post_num]" type="number"  min="1" max="20" value="<?php echo $related_posts['post_num']; ?>" id="related_posts_num" class="" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="related_posts_post_style"><?php esc_html_e('Display style','yahman-add-ons'); ?></label></th>
        <td>
          <select name="yahman_addons[related_posts][post_style]" id="related_posts_post_style">
            <option value="1"<?php selected( $related_posts['post_style'], "1" ); ?>><?php esc_html_e( 'List', 'yahman-add-ons' ); ?></option>
            <option value="2"<?php selected( $related_posts['post_style'], "2" ); ?>><?php esc_html_e( 'List with thumbnail', 'yahman-add-ons' ); ?></option>
            <option value="3"<?php selected( $related_posts['post_style'], "3" ); ?>><?php esc_html_e( 'Title over a thumbnail', 'yahman-add-ons' ); ?></option>
            <option value="4"<?php selected( $related_posts['post_style'], "4" ); ?>><?php esc_html_e( 'Title under a thumbnail', 'yahman-add-ons' ); ?></option>
          </select>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="related_posts_page"><?php esc_html_e('Related posts under in the contents of the page','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[related_posts][page]" type="checkbox" id="related_posts_page"<?php checked(true, $related_posts['page']); ?> class="ya_checkbox" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="related_posts_page_title"><?php esc_html_e('Page title','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[related_posts][page_title]" type="text" id="cta_social_heading" value="<?php echo esc_attr($related_posts['page_title']); ?>" class="ya_textbox" style="width: 300px;" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="related_posts_page_num"><?php esc_html_e('Maximum number of Related Posts','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[related_posts][page_num]" type="number"  min="1" max="20" value="<?php echo $related_posts['page_num']; ?>" id="related_posts_page_num" class="" /></td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="related_posts_page_style"><?php esc_html_e('Display style','yahman-add-ons'); ?></label></th>
        <td>
          <select name="yahman_addons[related_posts][page_style]" id="related_posts_page_style">
            <option value="1"<?php selected( $related_posts['page_style'], "1" ); ?>><?php esc_html_e( 'List', 'yahman-add-ons' ); ?></option>
            <option value="2"<?php selected( $related_posts['page_style'], "2" ); ?>><?php esc_html_e( 'List with thumbnail', 'yahman-add-ons' ); ?></option>
            <option value="3"<?php selected( $related_posts['page_style'], "3" ); ?>><?php esc_html_e( 'Title over a thumbnail', 'yahman-add-ons' ); ?></option>
            <option value="4"<?php selected( $related_posts['page_style'], "4" ); ?>><?php esc_html_e( 'Title under a thumbnail', 'yahman-add-ons' ); ?></option>
          </select>
        </td>
      </tr>


    </table>

  </div>




  <?php
}
