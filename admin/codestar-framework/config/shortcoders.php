<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.

//
// Set a unique slug-like ID
//
$prefix = 'csf_joy_shortcodes';

//
// Create a shortcoder
//
CSF::createShortcoder($prefix, array(
  'button_title'   => '添加内容组件',
  'select_title'   => '选择一个简码组件',
  'insert_title'   => '插入到文章',
  'show_in_editor' => true,
  'gutenberg'      => array(
      'title'       => '其他组件内容',
      'description' => '其他组件内容',
      'icon'        => 'screenoptions',
      'category'    => 'widgets',
      'keywords'    => array('shortcode', 'csf', 'insert', 'hide'),
      'placeholder' => '在此处编写简码...',
  ),
));
//
//视频播放器
CSF::createSection($prefix, array(
  'title'     => 'H5视频播放器',
  'view'      => 'option',
  'shortcode' => 'dq-video',
  'fields'    => array(

      array(
          'id'      => 'url',
          'type'    => 'upload',
          'title'   => '视频地址',
          'desc'    => '使用浏览器原生H5播放器，只支持视频真实播放地址，支持mp4等流媒体格式',
          'default' => '',
      ),

      array(
          'id'      => 'pic',
          'type'    => 'upload',
          'title'   => '视频封面',
          'desc'    => '视频封面,不上传不显示,推荐16:9的封面图，740x420',
          'default' => '',
      ),

  ),
));

function video_shortcode($atts) {
  $atts = shortcode_atts(array(
      'url'     => '',
      'width'   => '100%',
      'height'  => 'auto',
      'pic'  => '',
  ), $atts);

  $video_url  = esc_url($atts['url']);
  $poster_url = esc_url($atts['pic']);

  $video_tag = sprintf('<video src="%s" width="%s" height="%s" poster="%s" controls></video>', $video_url, $atts['width'], $atts['height'], $poster_url);

  return $video_tag;
}
add_shortcode('dq-video', 'video_shortcode');

//youtube视频
CSF::createSection($prefix, array(
  'title'     => 'YouTube视频',
  'view'      => 'option',
  'shortcode' => 'dq-youtube',
  'fields'    => array(

      array(
          'id'      => 'youtube_id',
          'type'    => 'text',
          'title'   => 'YouTube视频 ID',
          'desc'    => '例如：https://www.youtube.com/watch?v=IkJVA150zPY，视频ID就是：IkJVA150zPY',
          'default' => '',
      ),

  ),
));

function dq_youtube_shortcode($atts) {
  // 提取简码属性
  $atts = shortcode_atts(array(
      'id' => '',
  ), $atts);

  // 提取视频ID
  $video_id = sanitize_text_field($atts['id']);

  // 构建YouTube视频标签
  $video_tag = sprintf('<div style="position: relative; padding-bottom: 56.25%%; height: 0;"><iframe src="https://www.youtube.com/embed/%s" frameborder="0" allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%%; height: 100%%;"></iframe></div>', $video_id);

  // 返回视频标签
  return $video_tag;
}
add_shortcode('dq-youtube', 'dq_youtube_shortcode');

