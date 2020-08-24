<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin Widget Page
 *
 * @package YAHMAN Add-ons
 */
function yahman_addons_admin_widget($option,$option_key,$option_checkbox){

  $widget_list = array(
    'twitter' => esc_html__('Twitter timeline widget','yahman-add-ons'),
    'facebook' => esc_html__('Facebook timeline widget','yahman-add-ons'),
    'cse' => esc_html__('Google Custom Search widget','yahman-add-ons'),
    'recent' => esc_html__('Recent Posts with thumbnail widget','yahman-add-ons'),
    'update' => esc_html__('Update Posts with thumbnail widget','yahman-add-ons'),
    'recommend' => esc_html__('Recommended Posts with thumbnail widget','yahman-add-ons'),
    'dda' => esc_html__('Drop Down Archives widget without JavaScript','yahman-add-ons'),
    'ddc' => esc_html__('Drop Down Categories widget without JavaScript','yahman-add-ons'),
    'art_2col' => esc_html__('Articles into two columns widget', 'yahman-add-ons' ),
    '2lists_2col' => esc_html__('Two lists of articles widget', 'yahman-add-ons' ),
    'alu' => esc_html__('Articles line up widget','yahman-add-ons'),
    'carousel_slider' => esc_html__('Slider with Carousel Slider widget', 'yahman-add-ons' ),
  );

  $widget_area['post_type'] = array(
    'post' => esc_html_x('the post', 'widget' ,'yahman-add-ons' ),
    'page' => esc_html_x('the page', 'widget' ,'yahman-add-ons' ),
  );
  $widget_area['position_num'] = array(
    esc_html_x('the first', 'widget' ,'yahman-add-ons' ),
    esc_html_x('the second', 'widget' ,'yahman-add-ons' ),
    esc_html_x('the third', 'widget' ,'yahman-add-ons' ),
  );

  ?>

  <div id="ya_widget_content" class="tab_content dn fi15">
    <h3><?php esc_html_e('YAHMAN Add-ons Widget','yahman-add-ons'); ?></h3>

    <table class="form-table">
      <?php
      foreach ($widget_list as $key => $value) {
        $widget[$key] = isset($option['widget'][$key]) ? true: false;
        ?>
        <tr valign="top">
          <th scope="row"><label for="widget_<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></label>
          </th>
          <td><input name="yahman_addons[widget][<?php echo esc_attr($key); ?>]" type="checkbox" id="widget_<?php echo esc_attr($key); ?>"<?php checked(true, $widget[$key]); ?> class="ya_checkbox" />
            <?php
            if($key === 'facebook'){
              echo '<label class="" for="ya_cta_social">';
              esc_html_e( 'Facebook script is required.Select script check box from CTA page.', 'yahman-add-ons' );
              echo '</label>';
            }
            ?>
          </td>
        </tr>
        <?php
      }
      ?>
      <tr valign="top">
        <th scope="row" colspan="2"><h3 style="background: #000; color:#fff; padding: 5px 10px; margin-bottom: 0;"><?php echo esc_html__('Widget area', 'yahman-add-ons'); ?></h3></th>
      </tr>
      <?php
      foreach ($widget_area['post_type'] as $post_type_key => $post_type_val) {
        $i = 1;
        foreach ($widget_area['position_num'] as $position_num_key => $position_num_val) {
          $widget_area['judge'] = isset($option['widget_area'][$post_type_key]['before_h2'][$i]) ? true: false;
          ?>
          <tr valign="top">
            <th scope="row"><label for="widget_area_<?php echo esc_attr($post_type_key); ?>_before_h2_<?php echo esc_attr($i); ?>"><?php echo sprintf( esc_html__('Before %1$s H2 of %2$s', 'yahman-add-ons' ), $position_num_val, $post_type_val ); ?></label>
            </th>
            <td><input name="yahman_addons[widget_area][<?php echo esc_attr($post_type_key); ?>][before_h2][<?php echo esc_attr($i); ?>]" type="checkbox" id="widget_area_<?php echo esc_attr($post_type_key); ?>_before_h2_<?php echo esc_attr($i); ?>"<?php checked(true, $widget_area['judge'] ); ?> class="ya_checkbox" />
            </td>
          </tr>
          <?php
          ++$i;
        }
      }


      ?>




    </table>

  </div>




  <?php
}
