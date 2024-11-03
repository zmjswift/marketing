<?php

/**
 * @Author: 大胡子
 * @Email:  dq@dqtheme.com
 * @Link:   www.dq.me
 * @Date:   2021-01-30 20:45:12
 * @Last Modified by:   dq
 * @Last Modified time: 2021-06-16 02:27:54
 */


/** --------------------------------------------------------------------------------- *
 *  自定义上传用户头像
 *  --------------------------------------------------------------------------------- */

// 添加所需要的脚本
add_action( "admin_enqueue_scripts", "dqtheme_upload_avatar_enqueue" );
function dqtheme_upload_avatar_enqueue( $hook ){
  // 仅在「个人资料、编辑用户资料」页面上加载脚本
  if( $hook === 'profile.php' || $hook === 'user-edit.php' ){
    add_thickbox();
    wp_enqueue_script( 'media-upload' );
    wp_enqueue_media();
  }
}

// 上传头像到媒体库
add_action( 'admin_print_footer_scripts-profile.php', 'dqtheme_admin_media_scripts' );
add_action( 'admin_print_footer_scripts-user-edit.php', 'dqtheme_admin_media_scripts' );
function dqtheme_admin_media_scripts() {?>
  <script>
    jQuery(document).ready(function ($) {
      // 调换头像显示位置，默认显示在最后一位，通过JS将其放在个人说明下面
      $('.dqtheme-avatar-upload-options tr').insertAfter($('.user-description-wrap'));
      // 隐藏原本的「资料图片」栏
      $( '.user-profile-picture' ).remove();
      // 选择或上传自定义头像
      $(document).on('click', '.avatar-image-upload', function (e) {
        e.preventDefault();
        var $button = $(this);
        var file_frame = wp.media.frames.file_frame = wp.media({
          title: '选择或上传自定义头像',
          library: {
            type: 'image' // mime type
          },
          button: {
            text: '选择头像'
          },
          multiple: false
        });
        file_frame.on('select', function() {
          var attachment = file_frame.state().get('selection').first().toJSON();
          $button.siblings('#dqtheme-custom-avatar').val( attachment.url );
          $button.siblings('.custom-avatar-preview').attr( 'src', attachment.url );
        });
        file_frame.open();
      });
    });
  </script>
  <?php
}

// 隐藏原本的「资料图片」栏
add_action( 'admin_print_scripts-profile.php', 'user_profile_picture_display_none' );
add_action( 'admin_print_scripts-user-edit.php', 'user_profile_picture_display_none' );
function user_profile_picture_display_none() {?>
  <style>.user-profile-picture,.dqtheme-avatar-upload-options{display:none !important}</style>
  <?php
}

// 上传自定义头像选项
add_action( 'show_user_profile', 'custom_user_profile_fields', 10, 1 );
add_action( 'edit_user_profile', 'custom_user_profile_fields', 10, 1 );
function custom_user_profile_fields( $profileuser ) {?>
  <!--h2>资料图片</h2-->
  <table class="form-table dqtheme-avatar-upload-options">
    <tr>
      <th>
        <label for="image">个人头像</label>
      </th>
      <td>
        <?php
        // 检查是否保存了自定义头像，否则返回默认头像
        $custom_avatar = get_the_author_meta( 'dqtheme-custom-avatar', $profileuser->ID );
        if ( $custom_avatar == '' ){
          $custom_avatar = get_avatar_url( $profileuser->ID );
        }else{
          $custom_avatar = esc_url_raw( $custom_avatar );
        }
        ?>
        <img style="width: 96px; height: 96px; display: block; margin-bottom: 15px;" class="custom-avatar-preview" src="<?php echo $custom_avatar; ?>">
        <input type="text" name="dqtheme-custom-avatar" id="dqtheme-custom-avatar" value="<?php echo esc_attr( esc_url_raw( get_the_author_meta( 'dqtheme-custom-avatar', $profileuser->ID ) ) ); ?>" class="regular-text" />
        <input type='button' class="avatar-image-upload button-primary" value="上传头像" id="uploadimage"/>
        <p class="description">上传自定义头像，建议尺寸：200*200 px。（清空网址栏即可删除自定义头像）</p>
      </td>
    </tr>
  </table>
  <?php
}

// 保存设置
add_action( 'personal_options_update', 'dqtheme_save_local_avatar_fields' );
add_action( 'edit_user_profile_update', 'dqtheme_save_local_avatar_fields' );
function dqtheme_save_local_avatar_fields( $user_id ) {
  if ( current_user_can( 'edit_user', $user_id ) ) {
    if( isset($_POST[ 'dqtheme-custom-avatar' ]) ){
      $avatar = esc_url_raw( $_POST[ 'dqtheme-custom-avatar' ] );
      update_user_meta( $user_id, 'dqtheme-custom-avatar', $avatar );
    }
  }
}

// 将 get_avatar_url 替换成自定义头像链接
add_filter( 'get_avatar_url', 'dqtheme_get_avatar_url', 10, 3 );
function dqtheme_get_avatar_url( $url, $id_or_email, $args ) {
  $id = '';
  if ( is_numeric( $id_or_email ) ) {
    $id = (int) $id_or_email;
  } elseif ( is_object( $id_or_email ) ) {
    if ( ! empty( $id_or_email->user_id ) ) {
      $id = (int) $id_or_email->user_id;
    }
  } else {
    $user = get_user_by( 'email', $id_or_email );
    $id = !empty( $user ) ?  $user->data->ID : '';
  }
  //Preparing for the launch.
  $custom_url = $id ?  get_user_meta( $id, 'dqtheme-custom-avatar', true ) : '';
  
  // 如果没有自定义头像，则返回默认头像
  if( $custom_url == '' || !empty($args['force_default'])) {
    return esc_url_raw( dq_img('default_avatar') ?: 'https://www.dqtheme.com/wp-content/uploads/2021/01/team-3.png' ); 
  }else{
    return esc_url_raw($custom_url);
  }
}

// 将 get_avatar 中的头像地址，替换成自定义头像链接
add_filter( 'get_avatar' , 'dqtheme_custom_get_avatar' , 1, 5 );
function dqtheme_custom_get_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
    $user = false;
 
    if ( is_numeric( $id_or_email ) ) {
 
        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );
 
    } elseif ( is_object( $id_or_email ) ) {
 
        if ( ! empty( $id_or_email->user_id ) ) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }
 
    } else {
        $user = get_user_by( 'email', $id_or_email );   
    }
 
    if ( $user && is_object( $user ) ) {
 
        $avatar = get_avatar_url($user->data->ID);
        $avatar = "<img alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";

    }
 
    return $avatar;
}