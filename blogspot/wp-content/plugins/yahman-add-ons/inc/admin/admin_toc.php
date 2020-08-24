<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin TOC Page
 *
 * @package YAHMAN Add-ons
 */
function yahman_addons_admin_toc($option,$option_key,$option_checkbox){


  foreach ($option_key['toc'] as $key => $value  ) {
    $toc[$key] = $option['toc'][$key];
  }
  foreach ($option_checkbox['toc'] as $key => $value  ) {
    $toc[$key] = isset($option['toc'][$key]) ? true: false;
  }

  $widget_key = array(
    'toc',
  );

  foreach ($widget_key as $key ) {
    $widget[$key] = isset($option['widget'][$key]) ? true: false;
  }

?>

<div id="ya_toc_content" class="tab_content dn fi15">
  <h3><?php esc_html_e('Table of contents','yahman-add-ons'); ?></h3>

  <table class="form-table">
    <tr valign="top">
      <th scope="row"><label for="toc_enable"><?php esc_html_e('Enable','yahman-add-ons'); ?></label></th>
      <td><input name="yahman_addons[toc][enable]" type="checkbox" id="toc_enable"<?php checked(true, $toc['enable']); ?> class="ya_checkbox" /></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="toc_title"><?php esc_html_e('Toc Title','yahman-add-ons'); ?></label></th>
      <td><input name="yahman_addons[toc][title]" type="text" id="toc_title" value="<?php echo esc_attr($toc['title']); ?>" class="ya_textbox" /></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="toc_dc"><?php esc_html_e('lower limit the heading which toc is displayed','yahman-add-ons'); ?></label></th>
      <td>
        <select name="yahman_addons[toc][dc]" id="toc_dc">
          <?php
          for( $i = 2; $i <= 10; ++$i ){
            echo '<option value="'.$i.'"'. selected( $toc['dc'], $i ,false ).'>'.$i.'</option>';
          } ?>
        </select>
      </td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="toc_dp"><?php esc_html_e('display position','yahman-add-ons'); ?></label></th>
      <td>
        <select name="yahman_addons[toc][dp]" id="toc_dp">
          <?php
          $toc_dp = array(
            esc_html__('Before the first heading', 'yahman-add-ons'),
            esc_html__('After the first heading', 'yahman-add-ons'),
            esc_html__('Top', 'yahman-add-ons'),
          );
          for( $i = 1; $i <= 3; ++$i ){
            echo '<option value="'.$i.'"'. selected( $toc['dp'], $i ,false ).'>'.$toc_dp[$i-1].'</option>';
          } ?>
        </select>
      </td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="toc_post"><?php esc_html_e('Automatically display toc in post','yahman-add-ons'); ?></label></th>
      <td><input name="yahman_addons[toc][post]" type="checkbox" id="toc_post"<?php checked(true, $toc['post']); ?> class="ya_checkbox" /></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="toc_page"><?php esc_html_e('Automatically display toc in page','yahman-add-ons'); ?></label></th>
      <td><input name="yahman_addons[toc][page]" type="checkbox" id="toc_page"<?php checked(true, $toc['page']); ?> class="ya_checkbox" /></td>
    </tr>

    <tr valign="top">
      <th scope="row">
        <label for="toc_post_not_in"><?php esc_html_e('Not automatically display toc when you type post id.','yahman-add-ons'); ?></label><br>
        <label for="toc_post_not_in"><?php esc_html_e('Multiple id must be seperated by a comma.','yahman-add-ons'); ?></label>
      </th>
      <td>
        <input name="yahman_addons[toc][post_not_in]" type="text" id="toc_post_not_in" value="<?php echo $toc['post_not_in']; ?>" class="widefat" />
      </td>
    </tr>

    <tr valign="top">
      <th scope="row"><label for="toc_hierarchical"><?php esc_html_e('hierarchical view','yahman-add-ons'); ?></label></th>
      <td><input name="yahman_addons[toc][hierarchical]" type="checkbox" id="toc_hierarchical"<?php checked(true, $toc['hierarchical']); ?> class="ya_checkbox" /></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="toc_numerical"><?php esc_html_e('numerical display','yahman-add-ons'); ?></label></th>
      <td><input name="yahman_addons[toc][numerical]" type="checkbox" id="toc_numerical"<?php checked(true, $toc['numerical']); ?> class="ya_checkbox" /></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="toc_hide"><?php esc_html_e('Initially hide table of contents','yahman-add-ons'); ?></label></th>
      <td><input name="yahman_addons[toc][hide]" type="checkbox" id="toc_hide"<?php checked(true, $toc['hide']); ?> class="ya_checkbox" /></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="toc_nextpage"><?php esc_html_e('Include next page','yahman-add-ons'); ?></label></th>
      <td><input name="yahman_addons[toc][nextpage]" type="checkbox" id="toc_nextpage"<?php checked(true, $toc['nextpage']); ?> class="ya_checkbox" /></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="widget_toc"><?php esc_html_e('Add Widgets TOC','yahman-add-ons'); ?></label></th>
      <td><input name="yahman_addons[widget][toc]" type="checkbox" id="widget_toc"<?php checked(true, $widget['toc']); ?> class="ya_checkbox" /></td>
    </tr>

  </table>

</div>




<?php
}
