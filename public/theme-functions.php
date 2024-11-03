<?php

/**

 * @Author: 大胡子

 * @Email:  dq@dqtheme.com

 * @Link:   www.dq.me

 * @Date:   2020-09-09 22:18:48

 * @Last Modified by:   dq

 * @Last Modified time: 2022-02-11 01:14:36

 */



/** --------------------------------------------------------------------------------- *

 *  禁用古腾堡小工具

 *  --------------------------------------------------------------------------------- */

add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );

add_filter( 'use_widgets_block_editor', '__return_false' );



/** --------------------------------------------------------------------------------- *

 *  启用主题后跳转到入门页面

 *  --------------------------------------------------------------------------------- */

global $pagenow ; 

if( is_admin() && isset( $_GET['activated'] ) && $pagenow  ==  'themes.php' ) {

    wp_redirect( admin_url('admin.php?page=dqtheme-page') );

    exit;

}



/** --------------------------------------------------------------------------------- *

 *  注册导航

 *  --------------------------------------------------------------------------------- */

    register_nav_menus(

    	array(

        	'main' => __( '主菜单导航' ),

    	)

	);





/*为菜单增加「启用超级菜单」选项*/

add_action('wp_nav_menu_item_custom_fields', function($item_id, $item) {

    $show_as_button = get_post_meta($item_id, '_show-mega-menu', true);

    ?>

    <p class="description description-wide">

        <label for="mega-menu-button-<?php echo $item_id; ?>" >

            <input type="checkbox" 

                id="mega-menu-button-<?php echo $item_id; ?>" 

                name="mega-menu-button[<?php echo $item_id; ?>]" 

                <?php checked($show_as_button, true); ?> 

            />启用超级菜单

        </label>

    </p>

    <?php

}, 10, 2);



add_action('wp_update_nav_menu_item', function($menu_id, $menu_item_db_id) {

    $button_value = (isset($_POST['mega-menu-button'][$menu_item_db_id]) && $_POST['mega-menu-button'][$menu_item_db_id] == 'on') ? true : false;

    update_post_meta($menu_item_db_id, '_show-mega-menu', $button_value);

}, 10, 2);



add_filter('nav_menu_css_class', function($classes, $menu_item) {

    $show_as_button = get_post_meta($menu_item->ID, '_show-mega-menu', true);

    if ($show_as_button) {

        $classes[] = 'menu-item-mega';

    }

    return $classes;

}, 10, 2);



/** --------------------------------------------------------------------------------- *

 *  载入JS、CSS

 *  --------------------------------------------------------------------------------- */

if ( ! function_exists( 'dqtheme_scripts_method' ) ) {

    function dqtheme_scripts_method() {

		

		wp_enqueue_style('plugins', DAHUZI_THEME_URL . '/static/css/plugins.min.css', array(), DAHUZI_THEME_VERSION);

		wp_enqueue_style('style', DAHUZI_THEME_URL . '/static/css/style.css', array(), DAHUZI_THEME_VERSION);

		wp_enqueue_style('responsive', DAHUZI_THEME_URL . '/static/css/responsive.css', array(), DAHUZI_THEME_VERSION);

		wp_enqueue_style( 'font-awesome', DAHUZI_THEME_URL . '/static/font-awesome/css/font-awesome.min.css', array(), '4.7.1', 'all' );



		//载入JS

		wp_deregister_script('jquery');

		wp_enqueue_script('jquery', "https://cdn.staticfile.org/jquery/3.3.1/jquery.min.js", false, null);



		wp_deregister_script('jquery-migrate');

		wp_enqueue_script('jquery-migrate', "https://cdn.staticfile.org/jquery-migrate/3.0.1/jquery-migrate.min.js", false, null);



		wp_enqueue_script('bootstrap', DAHUZI_THEME_URL . '/static/js/bootstrap.min.js', array(), '4.1.3', true);

		wp_enqueue_script('owl', DAHUZI_THEME_URL . '/static/js/owl.carousel.min.js', array(), '2.2.1', true);

		wp_enqueue_script('animate', DAHUZI_THEME_URL . '/static/js/css3-animate-it.js', array(), '1.0.0', true);

        //一键复制js

        wp_enqueue_script('_clipboard', DAHUZI_THEME_URL . '/static/js/clipboard.min.js', array(), '1.6.1', true);



		wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/static/js/theia-sticky-sidebar.js', array(),false, true);

		wp_enqueue_script('script', DAHUZI_THEME_URL . '/static/js/script.js', array(), DAHUZI_THEME_VERSION, true);

        wp_localize_script('script', 'dq', [

            'ajaxurl' => admin_url('admin-ajax.php'),

        ]);



		//fancybox

		wp_enqueue_style('fancybox', 'https://cdn.staticfile.org/fancybox/3.5.7/jquery.fancybox.min.css');

		wp_enqueue_script('fancybox3', 'https://cdn.staticfile.org/fancybox/3.5.7/jquery.fancybox.min.js', ['jquery'], '', true);

		

		if (is_single()){

		    wp_enqueue_style('xzoom-css', DAHUZI_THEME_URL . '/static/xzoom/xzoom.min.css', array(), '1.0.15');

		    wp_enqueue_script('xzoom-js', DAHUZI_THEME_URL . '/static/xzoom/xzoom.min.js', array(), '1.0.15', true);

		}

		

		if (is_singular() && comments_open() && get_option('thread_comments')){

			wp_enqueue_script( 'comment-reply' );

		}

		

     }

}

add_action('wp_enqueue_scripts', 'dqtheme_scripts_method');



// 获取文章缩略图

function post_thumbnail($width=400, $height=200, $echo=1){



    global $post, $is_chrome;



    $default_timthumb = dq_img('default_timthumb');

    $cdn_type = dq('cdn_type');

    

    $dir = get_bloginfo('template_directory');



    if( has_post_thumbnail() ){

        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');

        $img_url = $timthumb_src[0];

        if( $cdn_type == 'qiniu' ){

            if( $is_chrome || is_android_dq() ){

                $src = "$img_url?imageView2/1/format/webp/w/$width/h/$height/q/100";

            }else{

                $src = "$img_url?imageView2/1/w/$width/h/$height/q/100";

            }

        }elseif( $cdn_type == 'alioss' ){

            if( $is_chrome || is_android_dq() ){

                $src = "$img_url?x-oss-process=image/resize,m_fill,w_$width,h_$height/format,webp";

            }else{

                $src = "$img_url?x-oss-process=image/resize,m_fill,w_$width,h_$height";

            }

        }else{

            //$src = $img_url;

            if( dq('dq_thumbnail_link') ){

                $src = $img_url;

            }else{

                $src = "$dir/timthumb.php&#63;src=$img_url&#38;w=$width&#38;h=$height&#38;zc=1&#38;q=100";

            }

        }

    }else{

        ob_start();

        ob_end_clean();

        $output = preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $post->post_content, $matches);

        //$first_img = $matches[1][0]; 

        if(!empty($matches[1][0])){

            $img_url = $matches[1][0];

            if( $cdn_type == 'qiniu' ){

                if( $is_chrome || is_android_dq() ){

                    $src = "$img_url?imageView2/1/format/webp/w/$width/h/$height/q/100";

                }else{

                    $src = "$img_url?imageView2/1/format/webp/w/$width/h/$height/q/100";

                }

            }elseif( $cdn_type == 'alioss' ){

                if( $is_chrome || is_android_dq() ){

                    $src = "$img_url?x-oss-process=image/resize,m_fill,w_$width,h_$height/format,webp";

                }else{

                    $src = "$img_url?x-oss-process=image/resize,m_fill,w_$width,h_$height";

                }

            }else{

                //$src = $img_url; // 使用文章内第一张图作为文章缩略图

                if( dq('dq_thumbnail_link') ){

                    $src = $img_url;

                }else{

                    $src = "$dir/timthumb.php&#63;src=$img_url&#38;w=$width&#38;h=$height&#38;zc=1&#38;q=100";

                }

            }

        }else{

            //$src = $default_timthumb; // 默认缩略图

            if( dq('dq_thumbnail_link') ){

                $src = $default_timthumb;

            }else{

                $src = "$dir/timthumb.php&#63;src=$default_timthumb&#38;w=$width&#38;h=$height&#38;zc=1&#38;q=100";

            }

        }

    }

    return $src;

}



/** --------------------------------------------------------------------------------- *

 *  自动添加暗箱标签属性

 *  --------------------------------------------------------------------------------- */

add_filter('the_content', 'add_dq_data_fancybox');

function add_dq_data_fancybox ($content){

    global $post;

    $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";

    $replacement = '<a$1href=$2$3.$4$5 data-fancybox="images"$6>$7</a>';

    $content = preg_replace($pattern, $replacement, $content);

    

    return $content;

}



/** --------------------------------------------------------------------------------- *

 *  favicon 图标

 *  --------------------------------------------------------------------------------- */

add_action('wp_head', 'dq_favicon', 0);

function dq_favicon() {

    $favicon = get_template_directory_uri().'/static/images/favicon.png';

    if( $favicon && !get_option('site_icon') ) {

    	echo "<link rel=\"shortcut icon\" href=\"$favicon\">\n";

    }

}



/** --------------------------------------------------------------------------------- *

 *  菜单添加class

 *  --------------------------------------------------------------------------------- */

function dqtheme_menu_classes($classes, $item, $args) {

	if($args->theme_location == 'main') { //这里的 main 是菜单id

    	$classes[] = 'nav-item dropdown'; //这里的 nav-item 是要添加的class类

	}

	return $classes;

}

add_filter('nav_menu_css_class','dqtheme_menu_classes',10,3);



add_action( 'wp_head', 'dq_theme_color', 20 );

if ( ! function_exists( 'dq_theme_color' ) ) :

function dq_theme_color(){

//通知栏配色

$notice_color = dqtheme('notice_color');

$notice_bg_color = isset( $notice_color['bg_color'] ) ? $notice_color['bg_color'] : '#091426';

$notice_text_color = isset( $notice_color['text_color'] ) ? $notice_color['text_color'] : '#eee';

//网站主色调

$theme_color = dqtheme('theme_color');

$theme_color_1 = isset( $theme_color['theme_color_1'] ) ? $theme_color['theme_color_1'] : '#fcab03';

$theme_color_2 = isset( $theme_color['theme_color_2'] ) ? $theme_color['theme_color_2'] : '#091426';

//鼠标悬浮配色

$theme_color_hover = dqtheme('theme_color_hover') ?: '#fcab03';



//页脚配色

$footer_color = dqtheme('footer_color');

$footer_bg_color = isset( $footer_color['bg_color'] ) ? $footer_color['bg_color'] : '#091426';

$footer_text_color = isset( $footer_color['text_color'] ) ? $footer_color['text_color'] : '#989898';



?>

<style><?php include get_template_directory() . '/static/css/color.php';?></style>



<?php }

endif;



/** --------------------------------------------------------------------------------- *

 *  清除wp所有自带的customize选项

 *  --------------------------------------------------------------------------------- */

function remove_default_settings_customize( $wp_customize ) {

    //$wp_customize->remove_section( 'title_tagline');

    $wp_customize->remove_section( 'colors');

    $wp_customize->remove_section( 'header_image');

    $wp_customize->remove_section( 'background_image');

    //$wp_customize->remove_panel( 'nav_menus');

    //$wp_customize->remove_section( 'static_front_page');

    $wp_customize->remove_section( 'custom_css');

    //$wp_customize->remove_panel( 'widgets' );



    $wp_customize->get_section( 'title_tagline' )->priority = 0; // 将「站点身份」移动到第一位

    $wp_customize->get_section( 'static_front_page' )->priority  = 1; // 将「主页设置」移动到第二位



}

add_action( 'customize_register', 'remove_default_settings_customize',50 );



/** --------------------------------------------------------------------------------- *

 *  隐藏后台「在线留言」菜单

 *  --------------------------------------------------------------------------------- */



if( dq('remove_admin_dq_contact') ){



	add_action( 'admin_head', 'remove_admin_dq_contact' );

	function remove_admin_dq_contact(){

		echo "<style>#toplevel_page_contact{display:none}</style>";

	}



}



/** --------------------------------------------------------------------------------- *

 *  从固定链接中移除 post_type slug

 *  --------------------------------------------------------------------------------- */

function remove_dq_page_slug( $post_link, $post, $leavename ) {



    if ( $post->post_type != 'dq-page' ) {

        return $post_link;

    } else {

        $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

        return $post_link;

    }

}

add_filter( 'post_type_link', 'remove_dq_page_slug', 10, 3 );



/** --------------------------------------------------------------------------------- *

 *  国外分享按钮

 *  --------------------------------------------------------------------------------- */

function dq_sharing_links() {

    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
    $dq_media = '';
    if($featured_image && isset($featured_image[0])){
        $dq_media = '&media=' . urlencode( $featured_image[0] );
    }
    return array(

        'facebook' => array(

            'link' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( get_the_permalink() ),

            'icon' => 'facebook',

        ),

        'twitter' => array(

            'link' => 'https://twitter.com/intent/tweet?text=' . urlencode( get_the_title() ) . '&url=' . urlencode( get_the_permalink() ),

            'icon' => 'twitter',

        ),

        'pinterest' => array(

            'link' => 'https://pinterest.com/pin/create/button/?url=' . urlencode( get_the_permalink() ) . $dq_media . '&description=' . urlencode( get_the_title() ),
            'icon' => 'pinterest',

        ),

        'google' => array(

            'link' => 'https://plus.google.com/share?url=' . urlencode( get_the_permalink() ) . '&text=' . urlencode( get_the_title() ),

            'icon' => 'google-plus',

        ),

        'linkedin' => array(

            'link' => 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode( get_the_permalink() ) . '&title=' . urlencode( get_the_title() ),

            'icon' => 'linkedin',

        ),

        'reddit' => array(

            'link' => 'https://reddit.com/submit?url=' . urlencode( get_the_permalink() ) . '&title=' . urlencode( get_the_title() ),

            'icon' => 'reddit',

        ),

        'tumblr' => array(

            'link' => 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . urlencode( get_the_permalink() ) . '&title=' . urlencode( get_the_title() ),

            'icon' => 'tumblr',

        ),

        'vk' => array(

            'link' => 'http://vk.com/share.php?url=' . urlencode( get_the_permalink() ) . '&title=' . urlencode( get_the_title() ),

            'icon' => 'vk',

        ),

        'whatsapp' => array(

            'link' => 'https://api.whatsapp.com/send?phone=whatsappphonenumber&text=' . urlencode( get_the_permalink() ) . '&title=' . urlencode( get_the_title() ),

            'icon' => 'whatsapp',

        ),

        'email' => array(

            'link' => 'mailto:?subject=' . get_the_title() . '&body=' . urlencode( get_the_permalink() ),

            'icon' => 'email',

        ),

    );

}