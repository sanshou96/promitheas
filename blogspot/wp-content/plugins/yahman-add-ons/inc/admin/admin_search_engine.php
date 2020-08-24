<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin Search Engine Visibility Page
 *
 * @package YAHMAN Add-ons
 */
function yahman_addons_admin_search_engine($option,$option_key,$option_checkbox){

  foreach ($option_key['robot'] as $key => $value  ) {
    $robot[$key] = $option['robot'][$key];
  }


  $robot_list = array(
    '404' => esc_html_x('404', 'robot' ,'yahman-add-ons') ,
    'search' => esc_html_x('search', 'robot' ,'yahman-add-ons') ,
    'year' => esc_html_x('year', 'robot' ,'yahman-add-ons') ,
    'month' => esc_html_x('month', 'robot' ,'yahman-add-ons') ,
    'day' => esc_html_x('day', 'robot' ,'yahman-add-ons') ,
    'tag' => esc_html_x('tag', 'robot' ,'yahman-add-ons') ,
    'category' => esc_html_x('category', 'robot' ,'yahman-add-ons') ,
    'attachment' => esc_html_x('attachment', 'robot' ,'yahman-add-ons') ,
  );

  ?>

<div id="ya_robot_content" class="tab_content dn fi15">
  <h3><?php esc_html_e('Search Engine Visibility','yahman-add-ons'); ?></h3>
  <h4><?php esc_html_e('Discourage search engines from indexing checked page','yahman-add-ons'); ?></h4>
  <p class="description"><?php esc_html_e('It is up to search engines to honor this request.','yahman-add-ons'); ?></p>




  <table class="form-table">
    <?php
    foreach ($robot_list as $key => $value) { ?>
      <tr valign="top">
        <th scope="row"><label for="robot_<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></label></th>
        <td><input name="yahman_addons[robot][<?php echo esc_attr($key); ?>]" type="checkbox" id="robot_<?php echo esc_attr($key); ?>"<?php checked(true, isset($option['robot'][$key]) ? true: false ); ?> class="ya_checkbox" /></td>
      </tr>
      <?php
    }
    ?>


  </table>

  <h4><?php esc_html_e('Discourage search engines when you type post id.','yahman-add-ons'); ?></h4>
  <p class="description"><?php esc_html_e('Multiple id must be seperated by a comma.','yahman-add-ons'); ?></p>

  <table class="form-table">

    <tr valign="top">
      <th scope="row">
        <label for="robot_post_not_in"><?php echo esc_html_e('Post ID','yahman-add-ons'); ?></label>
      </th>
      <td>
        <input name="yahman_addons[robot][post_not_in]" type="text" id="robot_post_not_in" value="<?php echo $robot['post_not_in']; ?>" class="widefat" />
      </td>
    </tr>

  </table>

  <h4><?php esc_html_e('Child page discourage search engines when input parent post id.','yahman-add-ons'); ?></h4>
  <p class="description"><?php esc_html_e('Multiple id must be seperated by a comma.','yahman-add-ons'); ?></p>

  <table class="form-table">

    <tr valign="top">
      <th scope="row">
        <label for="robot_parent_not_in"><?php echo esc_html_e('Post ID','yahman-add-ons'); ?></label>
      </th>
      <td>
        <input name="yahman_addons[robot][parent_not_in]" type="text" id="robot_parent_not_in" value="<?php echo $robot['parent_not_in']; ?>" class="widefat" />
      </td>
    </tr>

  </table>

</div>




<?php
}
