<?php



define('DAHUZI_THEMER_DIR', get_template_directory());

define('DAHUZI_THEME_URL', get_template_directory_uri());

define('DAHUZI_THEME_VERSION', wp_get_theme()->get('Version'));

define('DAHUZI_THEME_NAME', '智能营销');



/** --------------------------------------------------------------------------------- *

 *  codestar-framework 相关

 *  --------------------------------------------------------------------------------- */

include TEMPLATEPATH . '/admin/codestar-framework/codestar-framework.php'; // codestar-framework

include TEMPLATEPATH . '/admin/codestar-framework/config/customize.php'; // 自定义设置

include TEMPLATEPATH . '/admin/codestar-framework/config/options.php'; // 通用优化设置

include TEMPLATEPATH . '/admin/codestar-framework/config/metabox.php'; // 文章扩展

include TEMPLATEPATH . '/admin/codestar-framework/config/post-type-dq-page.php'; // 低配版页面构建器

include TEMPLATEPATH . '/admin/codestar-framework/config/taxonomy.php'; // 分类扩展

//include TEMPLATEPATH.'/admin/codestar-framework/config/shortcoders.php'; // 短代码配置器



// 自定义设置 echo dqtheme('option');

if (!function_exists('dqtheme')) {

    function dqtheme($option = '', $default = null)

    {

        $options = get_option('dqtheme_customize');

        return (isset($options[$option])) ? $options[$option] : $default;

    }

}

if (!function_exists('dqtheme_img')) {

    function dqtheme_img($option = '', $default = '')

    {

        $options = get_option('dqtheme_customize');

        return (isset($options[$option]['url'])) ? $options[$option]['url'] : $default;

    }

}



// 输出图片Alt文本 echo dqtheme_image_alt('option');

if (!function_exists('dqtheme_image_alt')) {

    function dqtheme_image_alt($option = '', $default = '')

    {

        $options = get_option('dqtheme_customize');

        $id = isset($options[$option]['id']) ? $options[$option]['id'] : $default;

        $_wp_attachment_image_alt = get_post_meta($id, '_wp_attachment_image_alt', true);

        return (isset($_wp_attachment_image_alt)) ? $_wp_attachment_image_alt : $default;

    }

}



// 网站优化设置 echo dq('option');

if (!function_exists('dq')) {

    function dq($option = '', $default = null)

    {

        $options = get_option('dqtheme_optimize');

        return (isset($options[$option])) ? $options[$option] : $default;

    }

}

if (!function_exists('dq_img')) {

    function dq_img($option = '', $default = null)

    {

        $options = get_option('dqtheme_optimize');

        return (isset($options[$option]['url'])) ? $options[$option]['url'] : $default;

    }

}



// 分类扩展设置 echo dq_taxonomy('option');

if (!function_exists('dq_taxonomy')) {

    function dq_taxonomy($option = '', $default = null)

    {

        global $wp_query;

        $options = get_term_meta($wp_query->get_queried_object_id(), '_dq_taxonomy_options', true);

        return (isset($options[$option])) ? $options[$option] : $default;

    }

}





/** --------------------------------------------------------------------------------- *

 *  核心文件

 *  --------------------------------------------------------------------------------- */

include TEMPLATEPATH . '/public/encryption/admin-page.php';

include TEMPLATEPATH . '/public/encryption/encryption.php';

include TEMPLATEPATH . '/public/extend/dqtheme-seo.php'; //SEO设置

include TEMPLATEPATH . '/public/encryption/dq-contact.php'; //在线留言

include TEMPLATEPATH . '/public/theme-functions.php'; //主题相关

include TEMPLATEPATH . '/public/basic-functions.php'; //通用函数

include TEMPLATEPATH . '/public/wp-optimize.php'; //WP优化

include TEMPLATEPATH . '/public/extend-functions.php'; //扩展功能

include TEMPLATEPATH . '/public/widget.php'; //小工具

include TEMPLATEPATH . '/public/comment.php'; //评论相关

include TEMPLATEPATH . '/public/wp_bootstrap_navwalker.php'; //菜单



include TEMPLATEPATH . '/admin/dq-blocks/dq-blocks.php'; //古腾堡模块



//用户定制

include TEMPLATEPATH . '/customized/functions.php';



/** --------------------------------------------------------------------------------- *

 *  WordPress 获取“上一篇”文章缩略图的图片地址

 *  --------------------------------------------------------------------------------- */

function dqtheme_prev_thumbnail_url()

{

    global $post;



    $timthumb = dq_img('default_timthumb');



    $categories = get_the_category($post->ID);

    $categoryIDS = array();

    foreach ($categories as $category) {

        //array_push($categoryIDS, $category->term_id);

    }

    $categoryIDS = implode(",", $categoryIDS);



    $prev_post = get_previous_post($categoryIDS);



    if (has_post_thumbnail($prev_post->ID)) {

        $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post->ID), 'full');

        return $img_src[0];

    } else {

        $content = $prev_post->post_content;

        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);

        $n = count($strResult[1]);

        if ($n > 0) {

            return $strResult[1][0];

        } else {

            return $timthumb;

        }

    }

}



/** --------------------------------------------------------------------------------- *

 *  WordPress 获取“下一篇”文章缩略图的图片地址

 *  --------------------------------------------------------------------------------- */

function dqtheme_next_thumbnail_url()

{

    global $post;



    $timthumb = dq_img('default_timthumb');



    $categories = get_the_category($post->ID);

    $categoryIDS = array();

    foreach ($categories as $category) {

        //array_push($categoryIDS, $category->term_id);

    }

    $categoryIDS = implode(",", $categoryIDS);



    $next_post = get_next_post($categoryIDS);



    if (has_post_thumbnail($next_post->ID)) {

        $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($next_post->ID), 'full');

        return $img_src[0];

    } else {

        $content = $next_post->post_content;

        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);

        $n = count($strResult[1]);

        if ($n > 0) {

            return $strResult[1][0];

        } else {

            return $timthumb;

        }

    }

}



// WPKF

/*

function wpkf_wp_enqueue_scripts()

{

    wp_register_style('module', DAHUZI_THEME_URL . '/static/css/module.css', array(), time()); //DAHUZI_THEME_VERSION

}

add_action('wp_enqueue_scripts', 'wpkf_wp_enqueue_scripts');

*/

/*

// 分类描述加上编辑器

remove_filter('pre_term_description', 'wp_filter_kses');

remove_filter('term_description', 'wp_kses_data');



add_action("category_edit_form_fields", 'edit_form_fields_example', 10, 2);

add_action("category_add_form_fields", 'add_form_fields_example', 10, 2);

add_action("post_tag_edit_form_fields", 'edit_form_fields_example', 10, 2);

add_action("post_tag_add_form_fields", 'add_form_fields_example', 10, 2);



function edit_form_fields_example($term)

{

?>

    <tr valign="top">

        <th scope="row"><?php _e('Description'); ?></th>

        <td>

            <?php

            $settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '5', 'textarea_name' => 'description');

            wp_editor(wp_kses_post($term->description, ENT_QUOTES, 'UTF-8'), 'tag_description', $settings);

            ?>

            <br />

            <span class="description"><?php _e('The description is not prominent by default; however, some themes may show it.'); ?></span>

            <script>

                jQuery(window).ready(function() {

                    jQuery('label[for=description]').parent().parent().remove();

                });

            </script>

        </td>



    </tr>

<?php

}



function add_form_fields_example()

{

?>

    <tr valign="top">

        <th scope="row"><?php _e('Description'); ?></th>

        <td>

            <?php wp_editor('', 'description', array('wpautop' => true, 'default_editor' => 'html', 'quicktags' => true)); ?>

            <script>

                jQuery(window).ready(function() {

                    jQuery('label[for=tag-description]').parent().remove();

                });

            </script>

        </td>

    </tr>

<?php

}*/

// 隐藏分类描述字段

function hide_category_description_field() {

    echo '<style>.term-description-wrap { display: none; }</style>';

}

add_action('admin_head', 'hide_category_description_field');





//add_action('save_post', function ($post_id) {

    //print_r($_POST);exit;

//});



// shop look

include TEMPLATEPATH . '/lookbooks/wpkf-init.php';



/*

if (!defined('WPKF_MARKEY_VER')) {

    add_action('admin_notices', function () {

        echo '<div class="notice notice-success is-dismissible">

                <p>本插件基于应用市场,请先安装</p>

            </div>';

    });

    return;

}

if (!wpkf_market_is_login()) {

    add_action('get_header', function () {

        $login_msg = '<a href="' . admin_url('admin.php?page=wpkf_market') . '">【点击登录】</a>';

        wp_die('请前往后台登录应用市场' . $login_msg);

    });

    add_action('admin_notices', function () {

        $login_msg = '<a href="' . admin_url('admin.php?page=wpkf_market') . '">【点击登录】</a>';

        echo '<div class="notice notice-success is-dismissible">

                <p>请前往后台登录应用市场' . $login_msg . '</p>

            </div>';

    });

    return;

}

if (!dqtheme_is_auth()) {

    add_action('get_header', function () {

        $auth_msg = '未授权';

        wp_die('请前往后台' . $auth_msg);

    });

    add_action('admin_notices', function () {

        $auth_msg = '未授权';

        echo '<div class="notice notice-success is-dismissible">

                <p>请前往后台' . $auth_msg . '</p>

            </div>';

    });

    return;

}

*/



function load_custom_script() {

    wp_enqueue_script('custom-script', get_template_directory_uri() . '/static/js/qrcode.js', array('jquery'), '1.0', true);

}

add_action('wp_enqueue_scripts', 'load_custom_script');





function display_produc_radio_badge() {

    $produc_radio = get_post_meta( get_the_ID(), 'produc_radio', true );

    $produc_radio_text = get_post_meta( get_the_ID(), 'produc_radio_text', true );

    if ($produc_radio) {

        if ($produc_radio === 'new'){

            return 'New';

        } elseif ($produc_radio === 'hot'){

            return 'Hot';

        } elseif ($produc_radio === 'custom'){

            return $produc_radio_text;

        }

    }

    return ''; 

}



add_action('wpcf7_posted_data', 'add_source_page_to_posted_data');



function add_source_page_to_posted_data($posted_data) {

    // 获取当前页面的 URL

    $current_url = esc_url( home_url( $_SERVER['REQUEST_URI'] ) );



    // 将当前页面的 URL 添加到表单数据中

    $posted_data['source_page'] = $current_url;



    return $posted_data;

}

// 排除特定分类
function wpkf_exclude_category_widget($args) {
    $exclude_cats = dq('page_products_exclude_cats');
    $args['exclude'] = $exclude_cats;
    return $args;
}
add_filter('widget_categories_args', 'wpkf_exclude_category_widget');


// 王牌开发

function wpkf_pagenavi($wp_query, $paged)

{

    //if (is_singular()) return;



    //global $wp_query, $paged;

    $max_page = $wp_query->max_num_pages;

    if ($max_page == 1) return;

    if (empty($paged)) $paged = 1;

    echo ' ';



    if ($max_page > 1) {

        if (!$paged) {

            $paged = 1;

        }

        if ($paged != 1) {

            echo "<li><a href='" . get_pagenum_link(1) . "' class='extend'> <i class='fa fa-angle-double-left'></i> </a></li>";

        }

        //echo '<li>' .get_previous_posts_link(' <i class="fa fa-angle-left"></i> ').'</li>';  

        if ($max_page > $range) {

            if ($paged < $range) {

                for ($i = 1; $i <= ($range + 1); $i++) {

                    echo "<li><a href='" . get_pagenum_link($i) . "'";

                    if ($i == $paged) echo " class='active'";

                    echo ">$i</a></li>";

                }

            } elseif ($paged >= ($max_page - ceil(($range / 2)))) {

                for ($i = $max_page - $range; $i <= $max_page; $i++) {

                    echo "<li><a href='" . get_pagenum_link($i) . "'";

                    if ($i == $paged) echo " class='active'";

                    echo ">$i</a></li>";

                }

            } elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {

                for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {

                    echo "<li><a href='" . get_pagenum_link($i) . "'";

                    if ($i == $paged) echo " class='active'";

                    echo ">$i</a></li>";

                }

            }

        } else {

            for ($i = 1; $i <= $max_page; $i++) {

                echo "<li><a href='" . get_pagenum_link($i) . "'";

                if ($i == $paged) echo " class='active'";

                echo ">$i</a></li>";

            }

        }

        //echo '<li>' .get_next_posts_link(' <i class="fa fa-angle-right"></i> ').'</li>';

        if ($paged != $max_page) {

            echo "<li><a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> <i class='fa fa-angle-double-right'></i> </a></li>";

        }

    }

}

function custom_theme_styles() {
    $theme_color = dqtheme('theme_color');
    $theme_color_1 = isset( $theme_color['theme_color_1'] ) ? $theme_color['theme_color_1'] : '#fcab03';
    ?>
    <style>
       .wpcf7 input[type=submit] {
          background-color: <?php echo $theme_color_1; ?> !important;
       }
    </style>
    <?php
 }
 add_action('wp_head', 'custom_theme_styles');
 

