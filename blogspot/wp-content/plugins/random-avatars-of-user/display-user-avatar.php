<?php
/*
  Plugin Name: Customize Random Avatar
  Description:
  Plugin URI:
  Version: 2.0.0
  Author: biztechc
  Author URI: https://www.appjetty.com/
 */
?>
<?php
require_once 'image_resize.php';

function dispaly_avatar_style() {
    wp_enqueue_style('dispaly_avatar', plugins_url('css/style.css', __FILE__));
}

add_action('init', 'dispaly_avatar_style');
add_action('show_user_profile', 'bc_get_avatar');
add_action('edit_user_profile', 'bc_get_avatar');

function bc_get_avatar() {   //   Debugbreak();

    global $current_user;
    $current_user_id = get_current_user_id();
    $url = plugin_dir_url(__FILE__);

    $upload_dir = wp_upload_dir();
    $path = $upload_dir['baseurl'];
    $upload_medium = $upload_dir['baseurl'] . "/medium/";

    if (isset($_REQUEST['user_id']) == true) {
        $avatar_user_id = $_REQUEST['user_id'];
    }
    else {
        $avatar_user_id = $current_user->data->ID;
    }

    if ( ! isset( $avatar_user_id ) || $avatar_user_id == 0 || $avatar_user_id == NULL) {
        return;
    }

    $get_profile1 = get_user_meta($avatar_user_id, 'profile1', true);
    $get_profile2 = get_user_meta($avatar_user_id, 'profile2', true);
    $get_profile3 = get_user_meta($avatar_user_id, 'profile3', true);

    $get_user_pic1 = get_user_meta($avatar_user_id, 'user_pic1', true);
    $chk1 = '';
    if (isset($get_user_pic1) && $get_user_pic1 == 'on') {
        $chk1 = 'checked';
    }
    $get_user_pic2 = get_user_meta($avatar_user_id, 'user_pic2', true);
    $chk2 = '';
    if (isset($get_user_pic2) && $get_user_pic2 == 'on') {
        $chk2 = 'checked';
    }
    $get_user_pic3 = get_user_meta($avatar_user_id, 'user_pic3', true);
    $chk3 = '';
    if (isset($get_user_pic3) && $get_user_pic3 == 'on') {
        $chk3 = 'checked';
    }

    //$gvatar =  get_avatar( $current_user->user_email, 90, $default, false );
    wp_enqueue_script('jquery');
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('#your-profile').attr('enctype', 'multipart/form-data');
            jQuery("#remove_1").click(function () {
                jQuery('#avatar1 > img').hide();
                jQuery('#remove_1').hide();
                jQuery('#avatar_1_val').val('');
                jQuery('#pic1').removeAttr("checked");

            });
            jQuery("#remove_2").click(function () {
                jQuery('#avatar2 > img').hide();
                jQuery('#remove_2').hide();
                jQuery('#avatar_2_val').val('');
                jQuery('#pic2').removeAttr("checked");
            });
            jQuery("#remove_3").click(function () {
                jQuery('#avatar3 > img').hide();
                jQuery('#remove_3').hide();
                jQuery('#avatar_3_val').val('');
                jQuery('#pic3').removeAttr("checked");
            });
        });
    </script>
    <table class="form-table dua-table">
        <tr>
            <th scope="row">
                <label><input type="checkbox" name="pic1" id="pic1" <?php echo $chk1; ?> /> Profile picture 1 :</label>
            </th>
            <td>
                <input type="file" name="avatar1" />
            </td>

            <td id="avatar1">
            <?php
                if ($get_profile1 != '') {
            ?>
                <img src="<?php echo $upload_medium . $get_profile1 ?>" alt="" />
            <?php
                }
            ?>
            </td>
            <td>
                <?php
                    if ($get_profile1 != '') {
                ?>
                    <input type="hidden" name="avatar1" value="<?php echo $get_profile1; ?>" id="avatar_1_val" />
                    <input type="button" id="remove_1" class="button button-primary" value="Remove" />
                <?php
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><input type="checkbox" name="pic2" id="pic2" <?php echo $chk2 ?> /> Profile picture 2 :</label>
            </th>
            <td>
                <input type="file" name="avatar2" />
            </td>
            <td id="avatar2">
            <?php
                if ($get_profile2 != '') {
            ?>
                    <img src="<?php echo $upload_medium . $get_profile2 ?>" alt="">
            <?php
                }
            ?>
            </td>
            <td>
            <?php
                if ($get_profile2 != '') {
            ?>
                <input type="hidden" name="avatar2" value="<?php echo $get_profile2; ?>" id="avatar_2_val" />
                <input type="button" id="remove_2" class="button button-primary" value="Remove" />
            <?php
                }
            ?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><input type="checkbox" name="pic3" id="pic3" <?php echo $chk3 ?> /> Profile picture 3 :</label>
            </th>
            <td>
                <input type="file" name="avatar3" />
            </td>
            <td id="avatar3">
            <?php
                if ($get_profile3 != '') {
            ?>
                <img src="<?php echo $upload_medium . $get_profile3 ?>" alt="" />
            <?php
                }
            ?>
            </td>
            <td>
            <?php
                if ($get_profile3 != '') {
            ?>
                <input type="hidden" name="avatar3" class="button button-primary" value="<?php echo $get_profile3; ?>" id="avatar_3_val" />
                <input type="button" id="remove_3" class="button button-primary" value="Remove" />
            <?php
                }
            ?>
            </td>
        </tr>
    </table>
    <?php
}

add_action('personal_options_update', 'bc_add_avatar');
function bc_add_avatar($user_id) {

    global $current_user;

    $current_blog_id = get_current_blog_id();
    $blogusers = get_users('blog_id=' . $current_blog_id . '&orderby=nicename');
    $c = 0;
    foreach ($blogusers as $user) {
        $c++;
        if ($current_user->data->ID == $user->data->ID) {
            $dir = plugin_dir_path(__FILE__);

            $upload_dir = wp_upload_dir();
            $path = $upload_dir['basedir'];
            $upload_large = $upload_dir['basedir'] . "/large/";
            $upload_medium = $upload_dir['basedir'] . "/medium/";
            $upload_small = $upload_dir['basedir'] . "/small/";

            $allowedExts = array("jpeg", "jpg", "png", "JPG", "PNG");
            if (isset($_FILES)) {
                $extension1 = @end(explode(".", $_FILES["avatar1"]["name"]));
                $extension2 = @end(explode(".", $_FILES["avatar2"]["name"]));
                $extension3 = @end(explode(".", $_FILES["avatar3"]["name"]));
            }

            if ($_FILES['avatar1']['name'] != '') {
                if (in_array($extension1, $allowedExts)) {
                    $user_img1 = $_FILES['avatar1']['name'];
                    move_uploaded_file($_FILES['avatar1']['tmp_name'], $path . "/" . $user_img1);
                }
                else {
                    add_action('user_profile_update_errors', 'validate_steamid_field');
                    $user_img1 = isset( $_POST['avatar1'] ) ? $_POST['avatar1'] : '';
                }
            } else {
                $user_img1 = $_POST['avatar1'];
            }

            if ($_FILES['avatar2']['name'] != '') {
                if (in_array($extension2, $allowedExts)) {
                    $user_img2 = $_FILES['avatar2']['name'];
                    move_uploaded_file($_FILES['avatar2']['tmp_name'], $path . "/" . $user_img2);
                } else {
                    add_action('user_profile_update_errors', 'validate_steamid_field');
                    $user_img2 = $_POST['avatar2'];
                }
            } else {
                $user_img2 = isset( $_POST['avatar2'] ) ? $_POST['avatar2'] : '';
            }

            if ($_FILES['avatar3']['name'] != '') {

                if (in_array($extension3, $allowedExts)) {
                    $user_img3 = $_FILES['avatar3']['name'];
                    move_uploaded_file($_FILES['avatar3']['tmp_name'], $path . "/" . $user_img3);
                } else {
                    add_action('user_profile_update_errors', 'validate_steamid_field');
                    $user_img3 = $_POST['avatar3'];
                }
            } else {
                $user_img3 = isset( $_POST['avatar3'] ) ? $_POST['avatar3'] : '';
            }

            update_user_meta($current_user->data->ID, 'user_pic1', (isset( $_POST['pic1'] ) ? $_POST['pic1'] : ''));
            update_user_meta($current_user->data->ID, 'user_pic2', (isset( $_POST['pic2'] ) ? $_POST['pic2'] : ''));
            update_user_meta($current_user->data->ID, 'user_pic3', (isset( $_POST['pic3'] ) ? $_POST['pic3'] : ''));

            if ($_FILES['avatar1']['name'] != '' && in_array($extension1, $allowedExts)) {
                /* createScaledImage($path."/".$user_img1,$upload_large.$user_img1,90);
                  createScaledImage($path."/".$user_img1,$upload_medium.$user_img1,60);
                  createScaledImage($path."/".$user_img1,$upload_small.$user_img1,30); */

                makeThumbnails($path . "/", $user_img1, $upload_large, 90, 90);
                makeThumbnails($path . "/", $user_img1, $upload_medium, 60, 60);
                makeThumbnails($path . "/", $user_img1, $upload_small, 30, 30);
                update_user_meta($current_user->data->ID, 'profile1', $user_img1);
            } else {
                update_user_meta($current_user->data->ID, 'profile1', $user_img1);
            }

            if ($_FILES['avatar2']['name'] != '' && in_array($extension2, $allowedExts)) {
                /* createScaledImage($path."/".$user_img2,$upload_large.$user_img2,90);
                  createScaledImage($path."/".$user_img2,$upload_medium.$user_img2,60);
                  createScaledImage($path."/".$user_img2,$upload_small.$user_img2,30); */

                makeThumbnails($path . "/", $user_img2, $upload_large, 90, 90);
                makeThumbnails($path . "/", $user_img2, $upload_medium, 60, 60);
                makeThumbnails($path . "/", $user_img2, $upload_small, 30, 30);
                update_user_meta($current_user->data->ID, 'profile2', $user_img2);
            } else {
                update_user_meta($current_user->data->ID, 'profile2', $user_img2);
            }

            if ($_FILES['avatar3']['name'] != '' && in_array($extension3, $allowedExts)) {
                /* createScaledImage($path."/".$user_img3,$upload_large.$user_img3,90);
                  createScaledImage($path."/".$user_img3,$upload_medium.$user_img3,60);
                  createScaledImage($path."/".$user_img3,$upload_small.$user_img3,30); */

                makeThumbnails($path . "/", $user_img3, $upload_large, 90, 90);
                makeThumbnails($path . "/", $user_img3, $upload_medium, 60, 60);
                makeThumbnails($path . "/", $user_img3, $upload_small, 30, 30);
                update_user_meta($current_user->data->ID, 'profile3', $user_img3);
            } else {
                update_user_meta($current_user->data->ID, 'profile3', $user_img3);
            }
        }
    }
}

            /* function my_avatar()
              {           //Debugbreak();
              //global $current_user;
              $blog_id  = get_current_blog_id();
              $blogusers = get_users( 'blog_id=1&orderby=nicename&role=administrator' );

              foreach($blogusers as $user)
              {
              //$current_user = $user;
              //if($current_user->data->ID == $user->data->ID)
              {
              $url = plugin_dir_url( __FILE__ );
              $upload_dir = wp_upload_dir();
              $upload_large=$upload_dir['baseurl']."/large/";
              $upload_medium=$upload_dir['baseurl']."/medium/";
              $upload_small=$upload_dir['baseurl']."/small/";


              $get_profile1 = get_user_meta($user->data->ID, 'profile1', true);
              $get_profile2 = get_user_meta($user->data->ID, 'profile2', true);
              $get_profile3 = get_user_meta($user->data->ID, 'profile3', true);


              if(isset($get_profile1) && $get_profile1 !='')
              {
              $get_profile[] = get_user_meta($user->data->ID, 'profile1', true);
              $get_user_pic[] = get_user_meta($user->data->ID, 'user_pic1', true);
              }

              if(isset($get_profile2) && $get_profile2 !='')
              {
              $get_profile[] = get_user_meta($user->data->ID, 'profile2', true);
              $get_user_pic[] = get_user_meta($user->data->ID, 'user_pic2', true);
              }

              if(isset($get_profile3) && $get_profile3 !='')
              {
              $get_profile[] = get_user_meta($user->data->ID, 'profile3', true);
              $get_user_pic[] = get_user_meta($user->data->ID, 'user_pic3', true);
              }


              if(!array_filter($get_user_pic))
              {

              return $avatar;
              }else
              {
              $val = $_SESSION['"'.$user->data->user_email.'"'];
              $avatar = '<img src="'.$upload_medium.$get_profile[$val].'">';
              }

              }
              return $avatar;

              }



              //$dir = plugin_dir_path( __FILE__ );


              }
              add_action( 'get_avatar', 'my_avatar' ); */
//add_filter( 'get_avatar' , 'my_custom_avatar' , 1 , 4 );

add_action('get_avatar', 'my_avatar');
function my_avatar($avatar) {//     Debugbreak();

    global $screen, $post;
    if (is_user_logged_in() && !is_front_page()) {
        //$screen = get_current_screen();
    }

    //if(isset($screen) && $screen->base == 'options-discussion')
    if ( ( isset( $GLOBALS['current_screen'] ) ) &&
         ( $GLOBALS['current_screen']->base == 'options-discussion' || $GLOBALS['current_screen']->base == 'users' || $GLOBALS['current_screen']->base == 'user-edit' || $GLOBALS['current_screen']->base == 'edit-comments' || $GLOBALS['current_screen']->base == 'dashboard' ) ) {
        return $avatar;
    }
    else {

        $comment_id = @get_comment_ID();
        $user_id = @get_comment($comment_id)->user_id;
        if (isset($GLOBALS['current_screen'])) {
            $user_id = get_current_user_id();
        }

        //if(is_user_logged_in())

        $get_profile1 = get_user_meta($user_id, 'profile1', true);
        $get_profile2 = get_user_meta($user_id, 'profile2', true);
        $get_profile3 = get_user_meta($user_id, 'profile3', true);

        $user_pic1 = get_user_meta($user_id, 'user_pic1', true);
        $user_pic2 = get_user_meta($user_id, 'user_pic2', true);
        $user_pic3 = get_user_meta($user_id, 'user_pic3', true);

        $profile_img = array();
        if (isset($get_profile1) && isset($user_pic1) && $user_pic1 == 'on' && $get_profile1 != '') {
            $profile_img[] = get_user_meta($user_id, 'profile1', true);
        }
        if (isset($get_profile2) && isset($user_pic2) && $user_pic2 == 'on' && $get_profile2 != '') {
            $profile_img[] = get_user_meta($user_id, 'profile2', true);
        }
        if (isset($get_profile3) && isset($user_pic3) && $user_pic3 == 'on' && $get_profile3 != '') {
            $profile_img[] = get_user_meta($user_id, 'profile3', true);
        }

        $upload_dir = wp_upload_dir();
        $upload_large = $upload_dir['baseurl'] . "/large/";
        $upload_medium = $upload_dir['baseurl'] . "/medium/";
        $upload_small = $upload_dir['baseurl'] . "/small/";

        $cnt = count($profile_img);
        if ($cnt > 1) {
            /* $random_keys=array_rand($profile_img,$cnt);
              $key = $random_keys[0]; */
            $key = array_rand($profile_img, 1);
        }
        else {
            $key = 0;
        }
        //Debugbreak();
        //$avatar = '<img src="'.$upload_medium.$profile_img.'">';
        if ($user_id != 0) {
            //$avatar = '<img src="'.$upload_medium.$profile_img[$random_keys[0]].'">';
            if (!empty($profile_img)) {
                $avatar = '<img src="' . $upload_medium . $profile_img[$key] . '">'; // Final
            }

            return $avatar;
        }
        else {
            return $avatar;
        }
    }
}

            /* add_action('init','get_val');
              function get_val()
              {      //Debugbreak();
              session_start();
              //global $current_user;
              $blogusers = get_users( 'blog_id=1&orderby=nicename' );
              $val = '';
              foreach($blogusers as $user)
              {                  $current_user = $user;
              $get_profile1 = get_user_meta($current_user->data->ID, 'profile1', true);
              $get_profile2 = get_user_meta($current_user->data->ID, 'profile2', true);
              $get_profile3 = get_user_meta($current_user->data->ID, 'profile3', true);

              if(isset($get_profile1) && $get_profile1 !='')
              {
              $get_profile[] = get_user_meta($current_user->data->ID, 'profile1', true);
              $get_user_pic[] = get_user_meta($current_user->data->ID, 'user_pic1', true);
              }

              if(isset($get_profile2) && $get_profile2 !='')
              {
              $get_profile[] = get_user_meta($current_user->data->ID, 'profile2', true);
              $get_user_pic[] = get_user_meta($current_user->data->ID, 'user_pic2', true);
              }

              if(isset($get_profile3) && $get_profile3 !='')
              {
              $get_profile[] = get_user_meta($current_user->data->ID, 'profile3', true);
              $get_user_pic[] = get_user_meta($current_user->data->ID, 'user_pic3', true);
              }//    Debugbreak();
              $val =  count($get_profile);
              $_SESSION['"'.$current_user->data->user_email.'"']= rand(0,$val-1);
              }



              } */

function avatar_folders() {
    $upload_dir = wp_upload_dir();
    $upload_large = $upload_dir['basedir'] . "/large";
    $upload_medium = $upload_dir['basedir'] . "/medium";
    $upload_small = $upload_dir['basedir'] . "/small";
    if (!is_dir($upload_large)) {
        wp_mkdir_p($upload_large);
    }

    if (!is_dir($upload_medium)) {
        wp_mkdir_p($upload_medium);
    }

    if (!is_dir($upload_small)) {
        wp_mkdir_p($upload_small);
    }
}

register_activation_hook(__FILE__, 'avatar_folders');
register_deactivation_hook(__FILE__, 'destroy_session_val');

function destroy_session_val() {
    //session_destroy();
}

//add_action( 'user_profile_update_errors', 'validate_steamid_field' );
register_uninstall_hook(__FILE__, 'remove_folders'); // uninstall plug-in
function remove_folders() {

    $upload_dir = wp_upload_dir();
    $upload_large = $upload_dir['basedir'] . "/large";
    $upload_medium = $upload_dir['basedir'] . "/medium";
    $upload_small = $upload_dir['basedir'] . "/small";
    $args = array('blog_id' => $current_blog_id);
    $current_blog_users = get_users($args);
    foreach ($current_blog_users as $user) {
        update_user_meta($user->data->ID, 'user_pic1', '');
        update_user_meta($user->data->ID, 'user_pic2', '');
        update_user_meta($user->data->ID, 'user_pic3', '');

        update_user_meta($user->data->ID, 'profile1', '');
        update_user_meta($user->data->ID, 'profile2', '');
        update_user_meta($user->data->ID, 'profile3', '');
    }

    deleteDirectory($upload_large);
    deleteDirectory($upload_medium);
    deleteDirectory($upload_small);
}

function deleteDirectory($dir) {

    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }

    return rmdir($dir);
}

function validate_steamid_field(&$errors, $update = null, &$user = null) {

    $errors->add('wrong_formate', "<strong>ERROR</strong>: Please Upload Image with proper format. ");
}
