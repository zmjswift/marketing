<?php



/**

 * @Author: 大胡子

 * @Email:  dq@dqtheme.com

 * @Link:   www.dq.me

 * @Date:   2020-03-03 01:11:07

 * @Last Modified by:   dq

 * @Last Modified time: 2021-09-25 12:30:29

 */

if (dq('dq_seo_switch')) { //判断是否开启主题SEO设置



    add_action('wp_head', 'dq_the_head', 0);

    function dq_the_head()

    {

        dq_seo_title();

        dq_seo_keywords();

        dq_seo_description();

    }



    // 标题分隔符

    function _get_delimiter()

    {

        return dq('connector') ? dq('connector') : '-';

    }



    function _get_tax_meta($id = 0, $field = '')

    {

        $ops = get_option("_taxonomy_meta_$id");



        if (empty($ops)) {

            return '';

        }



        if (empty($field)) {

            return $ops;

        }



        return isset($ops[$field]) ? $ops[$field] : '';

    }



    // 网站标题

    function dq_seo_title()

    {

        global $new_title;

        if ($new_title) return $new_title;



        global $paged;



        $html = '';



        if ($paged > 1) {

            $html .= 'Page' . $paged . 'led tubes' . _get_delimiter();

        }



        /*

    if ( is_tag() ) {

        $html .= '标签_';

    }

    */



        $t = trim(wp_title('', false));



        if ($t) {

            $html .= $t . _get_delimiter();

        }



        $html .= get_bloginfo('name');



        if (is_home() || is_front_page()) {

            if (dq('hometitle')) {

                $html = dq('hometitle');

            } else {

                if (get_option('blogdescription')) {

                    $html .= _get_delimiter() . get_option('blogdescription');

                }

            }

        }



        if (is_category() or is_tag()) {

            //global $wp_query;

            //$cat_ID = get_query_var('cat');

            $cat_ID = get_queried_object_id();

            $category = get_term_meta($cat_ID, '_dq_taxonomy_options', true);

            $seo_str = isset($category['seo_title']) ? $category['seo_title'] : '';

            $cat_tit = ($seo_str) ? $seo_str : _get_tax_meta($cat_ID, 'title');

            if ($cat_tit) {

                $html = $cat_tit;

            }

        }



        if (is_author()) {

            $html =  'Author_' . esc_html(get_the_author()) . '-' . get_bloginfo('name');

        }



        if (is_search()) {

            $html =  'Search Results for "' . esc_html(get_search_query(), 1) . '" ' . get_bloginfo('name') . '';

        }



        if ((is_single() || is_page())) {

            global $post;

            $post_ID = $post->ID;



            if (is_singular('dq-page')) {

                $page_seo = get_post_meta($post->ID, 'dq_page_seo', true);

                $post_metabox = isset($page_seo['seo_title']) ? $page_seo['seo_title'] : '';

            } elseif (is_page()) {

                $page_seo = get_post_meta($post->ID, 'page_seo', true);

                $post_metabox = isset($page_seo['seo_title']) ? $page_seo['seo_title'] : '';

            } else {

                $post_metabox = get_post_meta($post_ID, 'seo_title', true);

            }

            if (is_array($post_metabox)) {

                $post_seo = ''; 

            } else {

                $post_seo = $post_metabox;

            }

            $seo_title = trim($post_seo);

            if ($seo_title) $html = $seo_title;

        }



        echo "<title>{$html}</title>\n";

    }



    // 网站关键词

    function dq_seo_keywords()

    {

        global $new_keywords;

        if ($new_keywords) {

            echo "<meta name=\"keywords\" content=\"{$new_keywords}\">\n";

            return;

        }



        global $s, $post;

        $keywords = '';

        if (is_home() || is_front_page()) {

            $keywords = dq('home_keywords');

        } elseif (is_singular()) {

            if (get_the_tags($post->ID)) {

                foreach (get_the_tags($post->ID) as $tag) {

                    $keywords .= $tag->name . ', ';

                }

            }

            foreach (get_the_category($post->ID) as $category) {

                $keywords .= $category->cat_name . ', ';

            }

            $keywords = substr_replace($keywords, '', -2);



            //$post_metabox = get_post_meta($post->ID, 'extend_info', true );

            if (is_singular('dq-page')) {

                $page_seo = get_post_meta($post->ID, 'dq_page_seo', true);

                $post_metabox = isset($page_seo['seo_keywords']) ? $page_seo['seo_keywords'] : '';

            } elseif (is_page()) {

                $page_seo = get_post_meta($post->ID, 'page_seo', true);

                $post_metabox = isset($page_seo['seo_keywords']) ? $page_seo['seo_keywords'] : '';

            } else {

                $post_metabox = get_post_meta($post->ID, 'seo_keywords', true);

            }



            if (is_array($post_metabox)) {

                $post_seo = ''; 

            } else {

                $post_seo = $post_metabox;

            }

            $the = trim($post_seo);



            if ($the) {

                $keywords = $the;

            }

        }elseif (is_category() or is_tag()) {

 /*elseif (is_tag()) {

            $keywords = single_tag_title('', false);

        }*/

            //global $wp_query;

            //$cat_ID = get_query_var('cat');

            $cat_ID = get_queried_object_id();

            $category = get_term_meta($cat_ID, '_dq_taxonomy_options', true);

            $seo_str = isset($category['seo_keywords']) ? $category['seo_keywords'] : '';

            $keywords = ($seo_str) ? $seo_str : _get_tax_meta($cat_ID, 'keywords');

            if (!$keywords) {

                $keywords = single_cat_title('', false);

            }

        } elseif (is_search()) {

            $keywords = esc_html($s, 1);

        } else {

            $keywords = trim(wp_title('', false));

        }

        if ($keywords) {

            echo "<meta name=\"keywords\" content=\"{$keywords}\">\n";

        }

    }



    // 网站描述

    function dq_seo_description()

    {

        global $new_description;

        if ($new_description) {

            echo "<meta name=\"description\" content=\"$new_description\">\n";

            return;

        }



        global $s, $post;

        $description = '';

        $blog_name = get_bloginfo('name');

        if (is_home() || is_front_page()) {

            $description = dq('home_description');

        } elseif (is_singular()) {

            if (!empty($post->post_excerpt)) {

                $text = $post->post_excerpt;

            } else {

                $text = $post->post_content;

            }

            $description = trim(str_replace(array("\r\n", "\r", "\n", "　", " "), " ", str_replace("\"", "'", strip_tags($text))));

            $description = mb_substr($description, 0, 200, 'utf-8');



            if (!$description) {

                $description = $blog_name . "-" . trim(wp_title('', false));

            }



            //$post_metabox = get_post_meta($post->ID, 'extend_info', true );

            if (is_singular('dq-page')) {

                $page_seo = get_post_meta($post->ID, 'dq_page_seo', true);

                $post_metabox = isset($page_seo['seo_description']) ? $page_seo['seo_description'] : '';

            } elseif (is_page()) {

                $page_seo = get_post_meta($post->ID, 'page_seo', true);

                $post_metabox = isset($page_seo['seo_description']) ? $page_seo['seo_description'] : '';

            } else {

                $post_metabox = get_post_meta($post->ID, 'seo_description', true);

            }



            if (is_array($post_metabox)) {

                $post_seo = ''; 

            } else {

                $post_seo = $post_metabox;

            }

            $the = trim($post_seo);



            if ($the) {

                $description = $the;

            }

        } elseif (is_category()) {

            //global $wp_query;

            $cat_ID = get_queried_object_id();

            $category = get_term_meta($cat_ID, '_dq_taxonomy_options', true);

            $seo_str = isset($category['seo_description']) ? $category['seo_description'] : '';

            $description = ($seo_str) ? $seo_str : _get_tax_meta($cat_ID, 'description');

            if (!$description) {

                $description = trim(strip_tags(category_description()));

            }

        } elseif (is_tag()) {

            $cat_ID = get_queried_object_id();

            $category = get_term_meta($cat_ID, '_dq_taxonomy_options', true);

            $seo_str = isset($category['seo_description']) ? $category['seo_description'] : '';

            $description = ($seo_str) ? $seo_str : _get_tax_meta($cat_ID, 'description');

            if (!$description) {

                $description = trim(strip_tags(tag_description()));

            }

        }elseif (is_archive()) {

            $description = $blog_name . "'" . trim(wp_title('', false)) . "'";

        } elseif (is_search()) {

            $description = $blog_name . ": '" . esc_html(get_search_query(), 1) . "' 的搜索結果";

        } else {

            $description = $blog_name . "'" . trim(wp_title('', false)) . "'";

        }

        if ($description) {

            echo "<meta name=\"description\" content=\"$description\">\n";

        }

    }

} else { //判断是否开启主题SEO设置  END

    add_theme_support('title-tag');

}



// 熊掌号 新文章发布时实时推送（天级收录）

add_action('publish_post', 'tb_xzh_post_to_baidu');

function tb_xzh_post_to_baidu()

{

    if (dq('xiongzhanghao') && dq('xzh_appid') && dq('xzh_post_token')) {

        global $post;

        $plink = get_permalink($post->ID);



        if (!$plink || get_post_meta($post->ID, 'xzh_tui_back', true)) {

            return false;

        }



        $urls = array();

        $urls[] = $plink;

        $api = 'http://data.zz.baidu.com/urls?site=' . dq('xzh_appid') . '&token=' . dq('xzh_post_token') . '&type=daily';

        $ch = curl_init();

        $options =  array(

            CURLOPT_URL => $api,

            CURLOPT_POST => true,

            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_POSTFIELDS => implode("\n", $urls),

            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),

        );

        curl_setopt_array($ch, $options);

        $result = curl_exec($ch);

        $result = json_decode($result);

        $result_text = '成功';

        if ($result->error) {

            $result_text = '失败 ' . $result->message;

        }

        update_post_meta($post->ID, 'xzh_tui_back', $result_text);

    }

}



// WordPress发布文章主动推送到百度，加快收录保护原创

if (!function_exists('DQTheme_Baidu_Submit') && function_exists('curl_init')) {

    function DQTheme_Baidu_Submit($post_ID)

    {

        if (dq('DQTheme_Baidu_Submit') && dq('Baidu_Submit_url') && dq('Baidu_Submit_token')) {

            $WEB_SITE = dq('Baidu_Submit_url'); //这里换成你的域名

            $WEB_TOKEN = dq('Baidu_Submit_token'); //这里换成你的网站的百度主动推送的token值

            //已成功推送的文章不再推送

            if (get_post_meta($post_ID, 'Baidusubmit', true) == 1) return;

            $url = get_permalink($post_ID);

            $api = 'http://data.zz.baidu.com/urls?site=' . $WEB_SITE . '&token=' . $WEB_TOKEN;

            $ch = curl_init();

            $options = array(

                CURLOPT_URL => $api,

                CURLOPT_POST => true,

                CURLOPT_RETURNTRANSFER => true,

                CURLOPT_POSTFIELDS => $url,

                CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),

            );

            curl_setopt_array($ch, $options);

            $result = json_decode(curl_exec($ch), true);



            //如果推送成功则在文章新增自定义栏目Baidusubmit，值为1

            if (array_key_exists('success', $result)) {

                add_post_meta($post_ID, 'Baidusubmit', 1, true);

            }

        }

    }

    add_action('publish_post', 'DQTheme_Baidu_Submit', 0);

}







//关键词自动内链

add_filter('the_content', 'dqtheme_auto_keyword_link', 10);

function dqtheme_auto_keyword_link($content)

{

    $content = dqtheme_tag_link($content);

    $content = dqtheme_keyword_link($content);

    return $content;

}



//添加自定义关键词链接

function dqtheme_keyword_link($content)

{

    $dqtheme_auto_keyword = dq('dqtheme_auto_keyword');

    if (dq('dqtheme_auto_key_url') && is_array($dqtheme_auto_keyword)) {

        foreach ($dqtheme_auto_keyword as $value) {



            if (!$value['auto_keyword_link']) continue;



            $keyword = $value['auto_keyword_key'];

            $auto_keyword_link = $value['auto_keyword_link'];

            $auto_keyword_title = $value['auto_keyword_title'];



            //如果链接是当前页面,则跳过.

            $http_type = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';

            $recent_url = $http_type . $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];

            $_url = explode(', ', $auto_keyword_link);

            if ($_url && $_url[0] && $_url[0] == $recent_url) continue;



            //跳过页面

            if (is_page()) continue;



            $cleankeyword = stripslashes($keyword);

            $url = '<span class="dqtheme_keyword_link">';

            $url .= '<a href="' . $auto_keyword_link . '" target="_blank" title="' . esc_attr($auto_keyword_title ? $auto_keyword_title : $keyword) . '"';

            $url .= '>' . addcslashes($cleankeyword, '$') . '</a>';

            $url .= '</span>';

            $limit = 1; //rand(1, 3);

            $case = "";

            $zh_CN = "1";



            // we don't want to link the keyword if it is already linked.

            $ex_word = preg_quote($cleankeyword, '\'');

            //ignore pre

            if ($pre_num = preg_match_all("/<pre.*?>.*?<\/pre>/is", $content, $ignore_pre))

                for ($i = 1; $i <= $pre_num; $i++)

                    $content = preg_replace("/<pre.*?>.*?<\/pre>/is", "%ignore_pre_$i%", $content, 1);



            $content = preg_replace('|(<img)([^>]*)(' . $ex_word . ')([^>]*)(>)|U', '$1$2%&&&&&%$4$5', $content);



            // For keywords with quotes (') to work, we need to disable word boundary matching

            $cleankeyword = preg_quote($cleankeyword, '\'');

            if ($zh_CN) {

                $regEx = '\'(?!((<.*?)|(<a.*?)))(' . $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;

            } elseif (strpos($cleankeyword, '\'') > 0) {

                $regEx = '\'(?!((<.*?)|(<a.*?)))(' . $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;

            } else {

                $regEx = '\'(?!((<.*?)|(<a.*?)))(\b' . $cleankeyword . '\b)(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;

            }

            $content = preg_replace($regEx, $url, $content, $limit);



            //change our '%&&&&&%' things to $cleankeyword.

            $content = str_replace('%&&&&&%', stripslashes($ex_word), $content);



            //ignore pre

            if ($ignore_pre) {

                for ($i = 1; $i <= $pre_num; $i++) {

                    $content = str_replace("%ignore_pre_$i%", $ignore_pre[0][$i - 1], $content);

                }

            }

        }

    }

    return $content;

}



//自定义标签内链

function dqtheme_tag_link($content)

{

    if (dq('auto_tag_link')) {



        $posttags = get_the_tags();



        if ($posttags) {

            usort($posttags, "dqtheme_sort_by_len");

            foreach ($posttags as $tag) {

                $link = get_tag_link($tag->term_id);

                $keyword = $tag->name;



                //如果链接是当前页面,则跳过.

                $http_type = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';

                $recent_url = $http_type . $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];

                if ($link == $recent_url) continue;



                //跳过页面

                if (is_page()) continue;



                $cleankeyword = stripslashes($keyword);

                $url = '<span class="dqtheme_tag_link">';

                $url .= '<a href="' . $link . '" title="' . str_replace('%s', addcslashes($cleankeyword, '$'), __('%s')) . '"';

                $url .= ' target="_blank"';

                $url .= '>' . addcslashes($cleankeyword, '$') . '</a>';

                $url .= '</span>';

                $limit = 1; //rand(1, 3);

                $case = "";

                $zh_CN = "1";



                // we don't want to link the keyword if it is already linked.

                $ex_word = preg_quote($cleankeyword, '\'');

                //ignore pre

                if ($pre_num = preg_match_all("/<pre.*?>.*?<\/pre>/is", $content, $ignore_pre))

                    for ($i = 1; $i <= $pre_num; $i++)

                        $content = preg_replace("/<pre.*?>.*?<\/pre>/is", "%ignore_pre_$i%", $content, 1);



                $content = preg_replace('|(<img)([^>]*)(' . $ex_word . ')([^>]*)(>)|U', '$1$2%&&&&&%$4$5', $content);



                // For keywords with quotes (') to work, we need to disable word boundary matching

                $cleankeyword = preg_quote($cleankeyword, '\'');

                if ($zh_CN) {

                    $regEx = '\'(?!((<.*?)|(<a.*?)))(' . $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;

                } elseif (strpos($cleankeyword, '\'') > 0) {

                    $regEx = '\'(?!((<.*?)|(<a.*?)))(' . $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;

                } else {

                    $regEx = '\'(?!((<.*?)|(<a.*?)))(\b' . $cleankeyword . '\b)(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;

                }

                $content = preg_replace($regEx, $url, $content, $limit);



                //change our '%&&&&&%' things to $cleankeyword.

                $content = str_replace('%&&&&&%', stripslashes($ex_word), $content);



                //ignore pre

                if ($ignore_pre) {

                    for ($i = 1; $i <= $pre_num; $i++) {

                        $content = str_replace("%ignore_pre_$i%", $ignore_pre[0][$i - 1], $content);

                    }

                }

            }

        }

    }

    return $content;

}



function dqtheme_sort_by_len($a, $b)

{

    if ($a->name == $b->name) return 0;

    return (strlen($a->name) > strlen($b->name)) ? -1 : 1;

}

