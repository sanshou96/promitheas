<?php
defined( 'ABSPATH' ) || exit;
/**
 * Table of contents
 *
 * @package YAHMAN Add-ons
 */




function yahman_addons_toc($the_content,$option) {
  $toc['title'] = apply_filters('yahman_addons_toc_title', isset($option['toc']['title']) ? esc_html($option['toc']['title']) : esc_html_x( 'Table of contents', 'toc' , 'yahman-add-ons' ) );
  $toc['dc'] = isset($option['toc']['dc']) ? intval($option['toc']['dc']) : 3;

  $toc['dp'] = isset($option['toc']['dp']) ? intval($option['toc']['dp']) : 1;

  $toc['hierarchical'] = isset($option['toc']['hierarchical']) ? true: false;
  $toc['numerical'] = isset($option['toc']['numerical']) ? true: false;
  $toc['hide'] = isset($option['toc']['hide']) ? true: false;
  $toc['nextpage'] = isset($option['toc']['nextpage']) ? true: false;

  $toc['widget'] = isset($option['widget']['toc']) ? true: false;

  $nextpage_content = false;
  $page_permalink = array();

  $heading_num = '';
  $heading_title = '';

  if( $toc['nextpage'] ){

    global $post;
    if ( preg_match('$<!--nextpage-->$', $post->post_content) ) {
      $pages = explode('<!--nextpage-->', $post->post_content);

      $heading = array();
      $heading_count = preg_match_all( '/<h([1-6]).*?>(.*?)<\/h[1-6].*?>/iu', $post->post_content, $heading );

      if( $heading_count != 0 ) {



        $nextpage_content = true;
        $i = 0;

        $permalink = trailingslashit( get_permalink($post->ID) );
        $now_page = (get_query_var('page')) ? get_query_var('page') : 1;
        $now_page = $now_page - 1;


        foreach ($pages as $page_num => $value) {

          $page_heading_count = preg_match_all( '/<h([1-6]).*?>(.*?)<\/h[1-6].*?>/iu', $value, $page_heading );

          for($j = 0; $j < $page_heading_count; $j++){

            if($page_heading_count !== 0){


              if( $page_num === 0 ) {

                $page_permalink[$i] = $permalink;

              }else{

                $page_permalink[$i] = $permalink . ($page_num + 1) . '/';
              }

              
              if($page_num === $now_page) $page_permalink[$i] = '';

              
              if( $page_num === $now_page ) {
                $heading_num = $page_heading[1][0];
                $heading_title = $page_heading[2][0];
              }

            }
            ++$i;
          }

        }






      }

    }

  }

  if( !$nextpage_content ){
    $heading = array();
    $heading_count = preg_match_all( '/<h([1-6]).*?>(.*?)<\/h[1-6].*?>/iu', $the_content, $heading );
  }


  
  
  if( $heading_count < $toc['dc'] && !$nextpage_content) return $the_content;

    //$numif = $toc['numerical'] ? '1' : "0" ;
    //$hieif = $toc['hierarchical'] ? '1' : "0" ;
  $toc_html = '';
  $toc_header_html = '';
  $toc_footer_html = '';
  $numerical = '';
  $top_level = 6;



  foreach($heading[1] as $data){
    if($data < $top_level) $top_level = $data;
  }
  $i = $first = $heading_1 = $heading_2 = $heading_3 = $heading_4 = $heading_5 = $heading_6 = $num_heading_1 = $num_heading_2 = $num_heading_3 = $num_heading_4 = $num_heading_5 = $num_heading_6 = 0;
  $before_level = $top_level;
  $after_level = $heading[1][1];

  $caret_right = '<svg width="10" height="10" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path class="svg_icon" d="M18.8,12c0,0.4-0.2,0.8-0.4,1.1L7.8,23.6C7.5,23.8,7.1,24,6.8,24c-0.8,0-1.5-0.7-1.5-1.5v-21C5.3,0.7,5.9,0,6.8,0 c0.4,0,0.8,0.2,1.1,0.4l10.5,10.5C18.6,11.2,18.8,11.6,18.8,12z"></path></svg>';
  $caret_down = '<svg width="10" height="10" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path class="svg_icon" d="M24,6.8c0,0.4-0.2,0.8-0.4,1.1L13.1,18.3c-0.3,0.3-0.7,0.4-1.1,0.4s-0.8-0.2-1.1-0.4L0.4,7.8C0.2,7.5,0,7.1,0,6.8 c0-0.8,0.7-1.5,1.5-1.5h21C23.3,5.3,24,5.9,24,6.8z"></path></svg>';


  $toc_header_html = '<nav id="toc" class="toc p10 p12 mb_L dib shadow_box"><input id="tog_toc" type="checkbox"'. (!$toc['hide'] ? '': ' checked' ) .' /><div class="toc_ctrl f_box"><label for="tog_toc" class="toc_view toc_caret toc_lab ta_c dib fw2 fs14 tap_no">'.$caret_right.'</label><label for="tog_toc" class="toc_hide toc_caret toc_lab ta_c dib fw2 fs14 tap_no">'.$caret_down.'</label> <label for="tog_toc" class="toc_title toc_lab fw8 fs14 w100 tap_no">'.esc_html($toc['title']).'</label></div>'."\n";
  $toc_footer_html = '</nav>';


  if($toc['hierarchical']){
    
    $toc_html .= '<ul class="toc_ul fs17 m0" style="list-style:none;">';
    foreach($heading[1] as $data){

      if( !$nextpage_content ) $page_permalink[$i] = '';

      ${"num_heading_".$heading[1][$i]}++;
      ${"heading_".$heading[1][$i]}++;
      $link_number = ${"heading_".$heading[1][$i]};
      $currnt_level = $heading[1][$i];


      $pattern = '{<h'.$heading[1][$i].'(.*?)>'.preg_quote($heading[2][$i]).'<\/h'.$heading[1][$i].'>}isum';
      $replacement = '<h'.$heading[1][$i].'$1><span id="heading'.$heading[1][$i].'_'.$link_number.'">'.$heading[2][$i].'</span></h'.$heading[1][$i].'>';

      $the_content  = preg_replace($pattern, $replacement, $the_content,1);
      
      if($toc['numerical']){
        switch ($heading[1][$i]){
          case 1:
          $numerical = $num_heading_1.' ';
          $num_heading_2 = $num_heading_3 = $num_heading_4 = $num_heading_5 = $num_heading_6 = 0;
          break;
          case 2:
          $numerical = ($top_level < 2 ? $num_heading_1.'.' : '' ).$num_heading_2.' ';
          $num_heading_3 = $num_heading_4 = $num_heading_5 = $num_heading_6 = 0;
          break;
          case 3:
          $numerical = ($top_level < 2 ? $num_heading_1.'.' : '' ).($top_level < 3 ? $num_heading_2.'.' : '' ).$num_heading_3.' ';
          $num_heading_4 = $num_heading_5 = $num_heading_6 = 0;
          break;
          case 4:
          $numerical = ($top_level < 2 ? $num_heading_1.'.' : '' ).($top_level < 3 ? $num_heading_2.'.' : '' ).($top_level < 4 ? $num_heading_3.'.' : '' ).$num_heading_4.' ';
          $num_heading_5 = $num_heading_6 = 0;
          break;
          case 5:
          $numerical = ($top_level < 2 ? $num_heading_1.'.' : '' ).($top_level < 3 ? $num_heading_2.'.' : '' ).($top_level < 4 ? $num_heading_3.'.' : '' ).($top_level < 5 ? $num_heading_4.'.' : '' ).$num_heading_5.' ';
          $num_heading_6 = 0;
          break;
          case 6:
          $numerical = ($top_level < 2 ? $num_heading_1.'.' : '' ).($top_level < 3 ? $num_heading_2.'.' : '' ).($top_level < 4 ? $num_heading_3.'.' : '' ).($top_level < 5 ? $num_heading_4.'.' : '' ).($top_level < 6 ? $num_heading_5.'.' : '' ).$num_heading_6.' ';
          break;
          default:
          $numerical = '';
        }
        
      }

      if($before_level === $currnt_level){
        $toc_html .= '<li>'.esc_html($numerical).'<a href="'.esc_url($page_permalink[$i].'#heading'.$heading[1][$i].'_'.$link_number).'">'.esc_html(wp_strip_all_tags($heading[2][$i])).'</a>';
      }else if ($currnt_level > $before_level ){

        while($currnt_level != $before_level){
          $toc_html .= '<ul><li>';
          $currnt_level-- ;
        }
        $toc_html .= esc_html($numerical).'<a href="'.esc_url($page_permalink[$i].'#heading'.$heading[1][$i].'_'.$link_number).'">'.esc_html(wp_strip_all_tags($heading[2][$i])).'</a>';
      }else{
        
        $toc_html .= '<li>'.esc_html($numerical).'<a href="'.esc_url($page_permalink[$i].'#heading'.$heading[1][$i].'_'.$link_number).'">'.esc_html(wp_strip_all_tags($heading[2][$i])).'</a>';
      }
      $before_level = $heading[1][$i];

      $i++;

      if(isset($heading[1][$i])) $after_level = $heading[1][$i];
      if($before_level === $after_level){
        $toc_html .= '</li>'."\n";
      }else if($before_level > $after_level){
        $diff_level = $before_level - $after_level;
        while($diff_level > 0){
          $toc_html .= '</li></ul></li>'."\n";
          $diff_level-- ;
        }
        $toc_html .= ''."\n";
        
      }else{
        $toc_html .= "\n";
        
      }

    }
    if ($before_level > $top_level){
      $toc_html .= '</li>'."\n";
      $diff_level = $before_level;
      while($diff_level > 2){
        $toc_html .= '</ul></li>'."\n";
        $diff_level-- ;
      }
    }
    $toc_html .= '</ul>'."\n";





  }else{
    

    $ulol = ($toc['hierarchical'] && $toc['numerical'] ? 'ol' : 'ul');
    $toc_html .= '<'.esc_attr($ulol).' class="toc_ul'.($ulol == 'ol' ? ' toc_ol' : '').' fs17 m0" style="list-style:none;">';

    foreach($heading[1] as $data){

      if( !$nextpage_content ) $page_permalink[$i] = '';

      ${"heading_".$heading[1][$i]}++;
      $link_number = ${"heading_".$heading[1][$i]};


      $pattern = '{<h'.$heading[1][$i].'(.*?)>'.yahman_addons_toc_special_character_replace($heading[2][$i]).'<\/h'.$heading[1][$i].'>}isum';

      $replacement = '<h'.$heading[1][$i].'$1><span id="heading'.$heading[1][$i].'_'.$link_number.'">'.$heading[2][$i].'</span></h'.$heading[1][$i].'>';

      $the_content  = preg_replace($pattern, $replacement, $the_content,1);
      $toc_html .= '<li><a href="'.esc_url($page_permalink[$i].'#heading'.$heading[1][$i].'_'.$link_number).'">'.wp_strip_all_tags($heading[2][$i]).'</a></li>'."\n";

      $i++;
    }
    $toc_html .= '</'.esc_attr($ulol).'>'."\n";

  }

  
  if( !$toc['nextpage'] || !$nextpage_content ){

    $heading_num = $heading[1][0];
    $heading_title = $heading[2][0];

  }

  
  $pattern = '{<h'.$heading_num.'(.*?)>(.*?)'.yahman_addons_toc_special_character_replace($heading_title).'(.*?)<\/h'.$heading_num.'>}ismu';
  if($toc['dp'] == 1 ){
    $replacement = $toc_header_html.$toc_html.$toc_footer_html."\n".'<h'.$heading_num.'$1>${2}'.$heading_title.'$3</h'.$heading_num.'>';

    $the_content  = preg_replace($pattern, $replacement, $the_content,1);
  }else if ($toc['dp'] == 2 ){
    $replacement = '<h'.$heading_num.'$1>${2}'.$heading_title.'$3</h'.$heading_num.'>'.$toc_header_html.$toc_html.$toc_footer_html;
    $the_content  = preg_replace($pattern, $replacement, $the_content,1);
  }else{
    $the_content  = $toc_header_html.$toc_html.$toc_footer_html.$the_content;
  }

  set_query_var('yahman_addons_toc', true);

  if( $toc['widget'] && is_active_widget( false, false, 'yahman_addons_toc_widget', true ) && $toc_html != ''){
    $pattern = '/<input id="toggle_toc".*?<\/label>\]<\/div>/iu';
    $toc_header_html  = '<div class="toc_widget">';
    $toc_footer_html  = '</div>';
    set_query_var( 'yahman_addons_toc_html', $toc_header_html.$toc_html.$toc_footer_html );

  }
  
  if(!YAHMAN_ADDONS_TEMPLATE && !YA_AMP){
    add_action( 'wp_footer', 'yahman_addons_enqueue_style_toc' );
  }

  return $the_content;

}

function yahman_addons_toc_special_character_replace($replace) {
  
  $brackets_search = array(
    '\\',
    '?',
    '*',
    '+',
    '.',
    '(',
    ')',
    '{',
    '}',
    '[',
    ']',
    '^',
    '$',
    '-',
    '|',
    '=',
    '!',
    '<',
    '>',
    ':',
  );
  $brackets_replace = array(
    '\\\\',
    '\?',
    '\*',
    '\+',
    '\.',
    '\(',
    '\)',
    '\{',
    '\}',
    '\[',
    '\]',
    '\^',
    '\$',
    '\-',
    '\|',
    '\=',
    '\!',
    '\<',
    '\>',
    '\:',
  );
  return str_replace($brackets_search,$brackets_replace,$replace);
}
