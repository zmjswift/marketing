<?php

//启用特色图片
add_theme_support('post-thumbnails');

//友情链接
if (dqtheme('foot_link')) {
    add_filter('pre_option_link_manager_enabled', '__return_true');
}

// 添加全宽和宽对齐方式
add_theme_support('align-wide');

//文章浏览量统计
function record_visitors()
{
    if (is_singular()) {
        global $post;
        $post_ID = $post->ID;
        if ($post_ID) {
            $post_views = (int)get_post_meta($post_ID, 'views', true);
            if (!update_post_meta($post_ID, 'views', ($post_views + 1))) {
                add_post_meta($post_ID, 'views', 1, true);
            }
        }
    }
}
add_action('wp_head', 'record_visitors');

function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
    global $post;
    $post_ID = $post->ID;
    $views = (int)get_post_meta($post_ID, 'views', true);
    if ($echo) echo $before, number_format($views), $after;
    else return $views;
};

//侧边栏分类
function get_category_root_id($cat)
{
    // 取得当前分类
    //$this_category = get_category($cat);
    $cat_ID = get_queried_object_id();
    $this_category = get_category($cat_ID, false);
    // 若当前分类有上级分类时，循环
    while (!empty($this_category->category_parent)) {
        // 将当前分类设为上级分类（往上爬）
        $this_category = get_category($this_category->category_parent);
    }
    // 返回根分类的id号
    return $this_category->term_id;
}

//分页
function par_pagenavi($range = 9)
{
    if (is_singular()) return;

    global $wp_query, $paged;
    $max_page = $wp_query->max_num_pages;
    if ($max_page == 1) return;
    if (empty($paged)) $paged = 1;
    echo ' ';
    global $paged, $wp_query;
    if (!$max_page) {
        $max_page = $wp_query->max_num_pages;
    }

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

//面包屑导航
function get_breadcrumbs()
{
    global $wp_query;
    if (!is_home()) {
        // Start the UL
        //echo '<ul class="breadcrumb">'; 
        // Add the Home link  
        echo '<i class="fa fa-home"></i> <a href="' . get_option('home') . '">Home</a>';

        if (is_category()) {
            $catTitle = single_cat_title("", false);
            $cat = get_cat_ID($catTitle);
            echo " <span>&raquo;</span> " . get_category_parents($cat, TRUE, " <span>&raquo;</span> ") . "";
        } elseif (is_tag()) {
            echo ' <span>&raquo;<a href="' . dq('tag_all_link') . '">ALL</span><span></a>&raquo;</span> ' . single_tag_title('', false) . '';
        } elseif (is_author()) {
            echo " <span>&raquo;</span> Author";
        } elseif (is_archive() && !is_category()) {
            echo " <span>&raquo;</span> archive";
        } elseif (is_search()) {
            echo ' <span>&raquo;</span> ' . sprintf(__('Search for: %s', 'dq_theme'), get_search_query()) . '';
        } elseif (is_404()) {
            echo " <span>&raquo;</span> 404 Not Found";
        } elseif (is_single()) {
            $category = get_the_category();
            if ($category) {
                $category_id = get_cat_ID($category[0]->cat_name);
                echo ' <span>&raquo;</span> ' . get_category_parents($category_id, TRUE, "  <span>&raquo;</span> ");
                if (dqtheme('breadcrumbs_post_title')) {
                    echo 'Details';
                } else {
                    echo get_the_title();
                }
            }
        } elseif (is_page()) {
            $post = $wp_query->get_queried_object();
            if ($post->post_parent == 0) {
                echo " <span>&raquo;</span> " . the_title('', '', FALSE) . "";
            } else {
                $title = the_title('', '', FALSE);
                $ancestors = array_reverse(get_post_ancestors($post->ID));
                array_push($ancestors, $post->ID);

                foreach ($ancestors as $ancestor) {
                    if ($ancestor != end($ancestors)) {
                        echo ' <span>&raquo;</span> <a href="' . get_permalink($ancestor) . '">' . strip_tags(apply_filters('single_post_title', get_the_title($ancestor))) . '</a>';
                    } else {
                        echo ' <span>&raquo;</span> ' . strip_tags(apply_filters('single_post_title', get_the_title($ancestor))) . '';
                    }
                }
            }
        }
        // End the UL
        //echo "</ul>";
    }
}

// 添加@评论
add_filter('comment_text', function ($comment_text) {
    $comment_ID = get_comment_ID();
    $comment = get_comment($comment_ID);
    if ($comment->comment_parent) {
        $parent_comment = get_comment($comment->comment_parent);
        $comment_text = '<a href="#comment-' . $comment->comment_parent . '"><span class="parent-icon">@' . $parent_comment->comment_author . '</a></span> ' . $comment_text;
    }
    return $comment_text;
});


//百度地图短代码
add_shortcode('baidu_map', 'baidu_map');
function baidu_map($atts, $content = null)
{

    extract(shortcode_atts(array("dtmishi" => '', "dzmc" => '', "dtxxms" => '', "zuobiao" => ''), $atts));

    $return = '<div id="map_contact" class="version_2">';
    $return .= '<style type="text/css">#allmap{width:100%;height:500px;margin-top: 30px;}</style>';
    $return .= '<script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=' . $dtmishi . '"></script>';
    $return .= '<div id="allmap"></div>';
    $return .= '<script type="text/javascript">
                // 百度地图API功能
                var sContent =
                "<h4>' . $dzmc . '</h4>" + 
                "<p>' . $dtxxms . '</p>" + 
                "</div>";
                var map = new BMap.Map("allmap");
                var point = new BMap.Point(' . $zuobiao . ');
                var marker = new BMap.Marker(point);
                var infoWindow = new BMap.InfoWindow(sContent);  // 创建信息窗口对象
                marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
                map.openInfoWindow(infoWindow,point); //开启信息窗口
                map.centerAndZoom(point, 15);
                map.addOverlay(marker);
                marker.addEventListener("click", function(){          
                this.openInfoWindow(infoWindow);
                //图片加载完毕重绘infowindow
                document.getElementById("imgDemo").onload = function (){
                    infoWindow.redraw();   //防止在网速较慢，图片未加载时，生成的信息框高度比图片的总高度小，导致图片部分被隐藏
                }
                });
            </script>';
    $return .= '</div>';

    return $return;
}

// 页面支持摘要
function dq_excerpt_page()
{
    add_post_type_support('page', array('excerpt'));
}
add_action('init', 'dq_excerpt_page');

// 添加代码到头部
function dq_code_head()
{
    echo dq('code_head');
}
add_action('wp_head', 'dq_code_head');

// 添加代码到页脚
function dq_code_foot()
{
    echo dq('code_foot');
}
add_action('wp_footer', 'dq_code_foot');
