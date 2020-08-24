<?php
defined( 'ABSPATH' ) || exit;

function yahman_addons_meta_ogp($ogp,$sns_account){

  

  $url = $description = $title = $image = '';
  $ogp_logo = !empty($ogp['image']) ? $ogp['image'] : YAHMAN_ADDONS_URI . 'assets/images/ogp.jpg';
  if(is_home()){
    $url = home_url();
    $description = get_bloginfo('description');
    $title = get_bloginfo('name');
    $imgae = $ogp_logo;
  }else{
    $url = get_the_permalink();
    if(have_posts()): while(have_posts()): the_post();
      $description = mb_strimwidth( wp_strip_all_tags(strip_shortcodes(get_the_content()), true), 0 , 150, '&hellip;' );
    endwhile; endif;
    $title = get_the_title();
    if(!has_post_thumbnail()) {
      $imgae = $ogp_logo;
    }else{
      $imgae = wp_get_attachment_image_src( get_post_thumbnail_id() , 'full' );
      $imgae = $imgae[0];
    }
  }
  $get_locale = get_locale();
  if ($get_locale == 'ja'):$get_locale = 'ja_JP'; endif;

  echo '<meta property="og:url" content="'.esc_url($url).'" />'."\n";
  echo '<meta property="og:type" content="'.(is_singular() ? 'article' : 'website').'" />'."\n";
  echo '<meta property="og:title" content="'.esc_attr($title).'" />'."\n";
  echo '<meta property="og:description" content="'.esc_attr($description).'" />'."\n";
  echo '<meta property="og:image" content="'.esc_url($imgae).'" />'."\n";
  echo '<meta property="og:site_name" content="'.esc_attr(get_bloginfo('name')).'" />'."\n";
  echo '<meta property="og:locale" content="'.esc_attr($get_locale).'" />'."\n";
  if ( $sns_account['facebook_app_id'] != ''){
    echo '<meta property="fb:app_id" content="'.esc_attr($sns_account['facebook_app_id']).'" />'."\n";
  }
  if ( $sns_account['facebook_admins'] != ''){
    echo '<meta property="fb:admins" content="'.esc_attr($sns_account['facebook_admins']).'" />'."\n";
  }

  $twitter_card = isset($ogp['twitter_card']) ? $ogp['twitter_card'] : 'false';
  if ( $twitter_card != 'false'){
    $twitter_user_name = isset($sns_account['twitter']) ? $sns_account['twitter'] : '';
    if ($twitter_user_name != ''){
      $twitter_user_name = '@' . str_replace( '@' , '' , $twitter_user_name );
      echo '<meta name="twitter:card" content="'.esc_attr($twitter_card).'" />'."\n";
      echo '<meta name="twitter:site" content="'.esc_attr($twitter_user_name).'" />'."\n";
    }
  }

}

