<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin JavaScript
 *
 * @package YAHMAN Add-ons
 */

function yahman_addons_admin_javascript($option,$option_key,$option_checkbox){

  foreach ( $option_key['javascript'] as $key => $value ) {
    $javascript[$key] = $option['javascript'][$key];
  }

  foreach ($option_checkbox['javascript'] as $key => $value  ) {
    $javascript[$key] = isset($option['javascript'][$key]) ? true: false;
  }


  ?>

  <div id="ya_javascript_content" class="tab_content dn fi15">
    <h3><?php esc_html_e('JavaScript','yahman-add-ons'); ?></h3>

    <table class="form-table">

      <tr valign="top">
        <th scope="row" colspan="2"><h3 style="background: #000; color:#fff; padding: 5px 10px; margin-bottom: 0;"><?php esc_html_e('Lightbox', 'yahman-add-ons'); ?></h3></th>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="javascript_lightbox"><?php esc_html_e('Choose a script','yahman-add-ons'); ?></label></th>
        <td>
          <select name="yahman_addons[javascript][lightbox]" id="javascript_lightbox">
            <option value="false"<?php selected( $javascript['lightbox'], 'false' ); ?>><?php esc_html_e('Disable', 'yahman-add-ons'); ?></option>
            <option value="lity"<?php selected( $javascript['lightbox'], 'lity' ); ?>><?php esc_html_e('Lity', 'yahman-add-ons'); ?></option>
            <option value="luminous"<?php selected( $javascript['lightbox'], 'luminous' ); ?>><?php esc_html_e('Luminous', 'yahman-add-ons'); ?></option>
          </select>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row" colspan="2"><h3 style="background: #000; color:#fff; padding: 5px 10px; margin-bottom: 0;"><?php esc_html_e('Lazy Load', 'yahman-add-ons'); ?></h3></th>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="javascript_lazy"><?php esc_html_e('Choose a script','yahman-add-ons'); ?></label></th>
        <td>
          <select name="yahman_addons[javascript][lazy]" id="javascript_lazy">
            <option value="false"<?php selected( $javascript['lazy'], 'false' ); ?>><?php esc_html_e('Disable', 'yahman-add-ons'); ?></option>
            <option value="lozad"<?php selected( $javascript['lazy'], 'lozad' ); ?>><?php esc_html_e('Lozad.js', 'yahman-add-ons'); ?></option>
          </select>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row" colspan="2"><h3 style="background: #000; color:#fff; padding: 5px 10px; margin-bottom: 0;"><?php esc_html_e('Code', 'yahman-add-ons'); ?></h3></th>
      </tr>
      <tr valign="top">
        <th scope="row"><label for="javascript_code"><?php esc_html_e('Choose a script','yahman-add-ons'); ?></label></th>
        <td>
          <select name="yahman_addons[javascript][code]" id="javascript_code">
            <option value="false"<?php selected( $javascript['code'], 'false' ); ?>>
              <?php esc_html_e('Disable', 'yahman-add-ons'); ?>
            </option>
            <option value="highlight"<?php selected( $javascript['code'], 'highlight' ); ?>>
              <?php esc_html_e('highlight.js', 'yahman-add-ons'); ?>
            </option>
          </select>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row"><label for="javascript_highlight_style"><?php esc_html_e('Style of highlight.js','yahman-add-ons'); ?></label></th>
        <td>
          <select name="yahman_addons[javascript][highlight_style]" id="javascript_highlight_style">
            <?php
            foreach (yahman_addons_highlight_style() as $key => $value) { ?>
              <option value="<?php echo esc_attr($key); ?>"<?php selected( $javascript['highlight_style'], $key ); ?>>
                <?php echo esc_html($value); ?>
              </option>
              <?php
            }
            ?>
          </select>
        </td>
      </tr>

      <tr valign="top">
        <th scope="row" colspan="2"><h3 style="background: #000; color:#fff; padding: 5px 10px; margin-bottom: 0;"><?php esc_html_e('Etc', 'yahman-add-ons'); ?></h3></th>
      </tr>


      <tr valign="top">
        <th scope="row"><label for="javascript_pel"><?php esc_html_e('Passive Event Listener','yahman-add-ons'); ?></label></th>
        <td><input name="yahman_addons[javascript][pel]" type="checkbox" id="javascript_pel"<?php checked(true, $javascript['pel']); ?> class="ya_checkbox" /></td>
      </tr>

    </table>

  </div>




  <?php
}

function yahman_addons_highlight_style(){
  return array(
    'default'                 => 'default',
    'a11y-dark'                 => 'a11y-dark',
    'a11y-light'                   => 'a11y-light',
    'agate'                   => 'agate',
    'androidstudio'                 => 'androidstudio',
    'an-old-hope'                 => 'an-old-hope',
    'arduino-light'                   => 'arduino-light',
    'arta'                 => 'arta',
    'ascetic'                   => 'ascetic',
    'atelier-cave-dark'                 => 'atelier-cave-dark',
    'atelier-cave-light'                   => 'atelier-cave-light',
    'atelier-dune-dark'                 => 'atelier-dune-dark',
    'atelier-dune-light'                   => 'atelier-dune-light',
    'atelier-estuary-dark'                 => 'atelier-estuary-dark',
    'atelier-estuary-light'                   => 'atelier-estuary-light',
    'atelier-forest-dark'                 => 'atelier-forest-dark',
    'atelier-forest-light'                   => 'atelier-forest-light',
    'atelier-heath-dark'                 => 'atelier-heath-dark',
    'atelier-heath-light'                   => 'atelier-heath-light',
    'atelier-lakeside-dark'                 => 'atelier-lakeside-dark',
    'atelier-lakeside-light'                   => 'atelier-lakeside-light',
    'atelier-plateau-dark'                 => 'atelier-plateau-dark',
    'atelier-plateau-light'                   => 'atelier-plateau-light',
    'atelier-savanna-dark'                 => 'atelier-savanna-dark',
    'atelier-savanna-light'                   => 'atelier-savanna-light',
    'atelier-seaside-dark'                 => 'atelier-seaside-dark',
    'atelier-seaside-light'                   => 'atelier-seaside-light',
    'atelier-sulphurpool-dark'                 => 'atelier-sulphurpool-dark',
    'atelier-sulphurpool-light'                   => 'atelier-sulphurpool-light',
    'atom-one-dark'                 => 'atom-one-dark',
    'atom-one-dark-reasonable'                 => 'atom-one-dark-reasonable',
    'atom-one-light'                   => 'atom-one-light',
    'brown-paper'                 => 'brown-paper',
    'codepen-embed'                   => 'codepen-embed',
    'color-brewer'                 => 'color-brewer',
    'darcula'                   => 'darcula',
    'dark'                 => 'dark',
    'darkula'                   => 'darkula',
    'docco'                 => 'docco',
    'dracula'                   => 'dracula',
    'far'                 => 'far',
    'foundation'                   => 'foundation',
    'github'                 => 'github',
    'github-gist'                   => 'github-gist',
    'gml'                 => 'gml',
    'googlecode'                 => 'googlecode',
    'gradient-dark'                   => 'gradient-dark',
    'grayscale'                   => 'grayscale',
    'gruvbox-dark'                 => 'gruvbox-dark',
    'gruvbox-light'                   => 'gruvbox-light',
    'hopscotch'                 => 'hopscotch',
    'hybrid'                   => 'hybrid',
    'idea'                 => 'idea',
    'ir-black'                   => 'ir-black',
    'isbl-editor-dark'                   => 'isbl-editor-dark',
    'isbl-editor-light'                   => 'isbl-editor-light',
    'kimbie.dark'                 => 'kimbie.dark',
    'kimbie.light'                   => 'kimbie.light',
    'lightfair'                   => 'lightfair',
    'magula'                   => 'magula',
    'mono-blue'                 => 'mono-blue',
    'monokai'                   => 'monokai',
    'monokai-sublime'                 => 'monokai-sublime',
    'night-owl'                 => 'night-owl',
    'nord'                   => 'nord',
    'obsidian'                   => 'obsidian',
    'ocean'                 => 'ocean',
    'paraiso-dark'                   => 'paraiso-dark',
    'paraiso-light'                 => 'paraiso-light',
    'pojoaque'                   => 'pojoaque',
    'purebasic'                   => 'purebasic',
    'qtcreator_dark'                 => 'qtcreator_dark',
    'qtcreator_light'                   => 'qtcreator_light',
    'railscasts'                 => 'railscasts',
    'rainbow'                   => 'rainbow',
    'routeros'                 => 'routeros',
    'school-book'                   => 'school-book',
    'shades-of-purple'                   => 'shades-of-purple',
    'solarized-dark'                 => 'solarized-dark',
    'solarized-light'                   => 'solarized-light',
    'srcery'                   => 'srcery',
    'sunburst'                   => 'sunburst',
    'tomorrow'                 => 'tomorrow',
    'tomorrow-night'                   => 'tomorrow-night',
    'tomorrow-night-blue'                 => 'tomorrow-night-blue',
    'tomorrow-night-bright'                   => 'tomorrow-night-bright',
    'tomorrow-night-eighties'                 => 'tomorrow-night-eighties',
    'vs'                   => 'vs',
    'vs2015'                 => 'vs2015',
    'xcode'                   => 'xcode',
    'xt256'                   => 'xt256',
    'zenburn'                 => 'zenburn',
  );
}
