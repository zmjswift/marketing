<?php

/** --------------------------------------------------------------------------------- *
 *  去除分类标志
 *  --------------------------------------------------------------------------------- */
if ( dq('no_category') && !function_exists('no_category_base_refresh_rules') ) {
	include TEMPLATEPATH.'/public/extend/no_category.php';
}

/** --------------------------------------------------------------------------------- *
 *  去除固定链接中的子分类
 *	去掉前：www.xxx.com/fenlei/zifenlei/123.html
 *	去掉后：www.xxx.com/fenlei/123.html
 *  --------------------------------------------------------------------------------- */
if ( dq('no_zifenlei') ) {
	add_filter( 'post_link', function($permalink, $post, $leavename){
	if (!gettype($post) == 'post') {
	    return $permalink;
	}
	switch ($post->post_type) {
	    case 'post':
	    //$permalink = get_home_url() . '/' . $post->post_name . '/';
	    $cats = get_the_category($post->ID);
	    $subcats = array();
	    foreach( $cats as $cat ) {
	        $cat = get_category($cat->term_id);
	        //if($cat->parent) { $subcats[] = sanitize_title($cat->name); 
	        if($cat->parent) {
	        	$subcats[] = $cat->slug;
	        }
	    }
	    if($subcats) {
	        foreach($subcats as $subcat) {
	            $subcat = $subcat.'/';
	            $permalink = str_replace($subcat, "", $permalink);
	        }
	    }
	    break;
	}
	return $permalink;
	},10,3);
}

/** --------------------------------------------------------------------------------- *
 *  WordPress标签链接以id方式显示
 *  --------------------------------------------------------------------------------- */
if ( dq('dq_tag_rewrite') ) {
	add_action('generate_rewrite_rules','dq_tag_rewrite_rules');
	add_filter('term_link','dq_tag_term_link',10,3);
	add_action('query_vars', 'dq_tag_query_vars');
}

function dq_tag_rewrite_rules($wp_rewrite){
	$new_rules = array(
    'tag/(\d+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?tag_id=$matches[1]&feed=$matches[2]',
    'tag/(\d+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?tag_id=$matches[1]&feed=$matches[2]',
    'tag/(\d+)/embed/?$' => 'index.php?tag_id=$matches[1]&embed=true',
    'tag/(\d+)/page/(\d+)/?$' => 'index.php?tag_id=$matches[1]&paged=$matches[2]',
    'tag/(\d+)/?$' => 'index.php?tag_id=$matches[1]',
    );
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}

function dq_tag_term_link($link,$term,$taxonomy){
    if($taxonomy=='post_tag'){
    return home_url('/tag/'.$term->term_id);
	}
    return $link;
}

function dq_tag_query_vars($public_query_vars){
    $public_query_vars[] = 'tag_id';
    return $public_query_vars;
}


/** --------------------------------------------------------------------------------- *
 *  页面链接添加html后缀
 *  --------------------------------------------------------------------------------- */
if( dq('html_page_permalink') ) :

	add_action('init', function (){
	    global $wp_rewrite;
	    if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
	        $wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
	    }
	},-1);

endif;


/** --------------------------------------------------------------------------------- *
 *  给分类目录链接末尾添加 / 斜杠
 *  --------------------------------------------------------------------------------- */
if( dq('dq_trailingslashit') ) :

	add_filter('user_trailingslashit', function ( $string, $type_of_url ) {
	    if ( $type_of_url != 'single' && $type_of_url != 'page' && $type_of_url != 'single_paged' )
	        $string = trailingslashit($string);
	    return $string;
	}, 10, 2 );

endif;


/** --------------------------------------------------------------------------------- *
 *  超过2560px的图片不剪裁
 *  --------------------------------------------------------------------------------- */
add_filter( 'big_image_size_threshold', '__return_false' );

/** --------------------------------------------------------------------------------- *
 *  删除函数 comment_class() 和 body_class() 中输出的 "comment-author-" 和 "author-"
 *	避免 WordPress 登录用户名被暴露
 *  --------------------------------------------------------------------------------- */ 
function dqtheme_comment_body_class($content){
    $pattern = "/(.*?)([^>]*)author-([^>]*)(.*?)/i";
    $replacement = '$1$4';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
add_filter('comment_class', 'dqtheme_comment_body_class');
add_filter('body_class', 'dqtheme_comment_body_class');

/** --------------------------------------------------------------------------------- *
 *  删除wordpress默认相册样式
 *  --------------------------------------------------------------------------------- */
add_filter( 'use_default_gallery_style', '__return_false' );

/** --------------------------------------------------------------------------------- *
 *  评论作者链接新窗口打开
 *  --------------------------------------------------------------------------------- */
add_filter('get_comment_author_link', function () {
	$url	= get_comment_author_url();
	$author = get_comment_author();
	if ( empty( $url ) || 'http://' == $url ){
		return $author;
	}else{
		return "<a target='_blank' href='$url' rel='external nofollow' class='url'>$author</a>";
	}
});

/** --------------------------------------------------------------------------------- *
 *  搜索结果排除所有页面
 *  --------------------------------------------------------------------------------- */
function search_filter_page($query) {
    if ($query->is_search && !$query->is_admin) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts', 'search_filter_page');

/** --------------------------------------------------------------------------------- *
 *  搜索关键词为空 跳转到首页
 *  --------------------------------------------------------------------------------- */
add_filter( 'request', function ( $query_variables ) {
	if (isset($_GET['s']) && !is_admin()) {
		if (empty($_GET['s']) || ctype_space($_GET['s'])) {
			wp_redirect( home_url() );
			exit;
		}
	}
	return $query_variables;
} );

/** --------------------------------------------------------------------------------- *
 *  禁止头部加载s.w.org
 *  --------------------------------------------------------------------------------- */
add_filter( 'wp_resource_hints', function ( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		return array_diff( wp_dependencies_unique_hosts(), $hints );
	}
	return $hints;
}, 10, 2 );

/** --------------------------------------------------------------------------------- *
 *  移除头部emoji.js加载
 *  --------------------------------------------------------------------------------- */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/** --------------------------------------------------------------------------------- *
 *  给文章图片自动添加alt和title信息
 *  --------------------------------------------------------------------------------- */
add_filter('the_content', function ($content) {
	global $post;
	$pattern		= "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	$replacement	= '<a$1href=$2$3.$4$5 alt="'.$post->post_title.'" title="'.$post->post_title.'"$6>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
});

/** --------------------------------------------------------------------------------- *
 *  关闭 XML-RPC 的 pingback 端口
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_pingback') ) :
add_filter( 'xmlrpc_methods', 'remove_xmlrpc_pingback_ping' );
function remove_xmlrpc_pingback_ping( $methods ) {
	unset( $methods['pingback.ping'] );
	return $methods;
}
endif;

/** --------------------------------------------------------------------------------- *
 *  avatar头像加速
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_avatar') ) :
	add_filter( 'get_avatar', function ($avatar) {
		return str_replace(['cn.gravatar.com/avatar', 'secure.gravatar.com/avatar', '0.gravatar.com/avatar', '1.gravatar.com/avatar', '2.gravatar.com/avatar'], 'gravatar.loli.net/avatar', $avatar);
	}, 10, 3 );
endif;

/** --------------------------------------------------------------------------------- *
 *  去除wordpress前台顶部工具条
 *  --------------------------------------------------------------------------------- */
if( dq('no_admin_bar') ) :
	show_admin_bar(false);
endif;

/** --------------------------------------------------------------------------------- *
 *  移除顶部多余信息
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_wp_head') ) :
	remove_action( 'wp_head', 'feed_links', 2 ); //移除feed
	remove_action( 'wp_head', 'feed_links_extra', 3 ); //移除feed
	remove_action( 'wp_head', 'rsd_link' ); //移除离线编辑器开放接口
	remove_action( 'wp_head', 'wlwmanifest_link' );  //移除离线编辑器开放接口
	remove_action( 'wp_head', 'index_rel_link' );//去除本页唯一链接信息
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );//清除前后文信息
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );//清除前后文信息
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'locale_stylesheet' );
	remove_action( 'publish_future_post','check_and_publish_future_post',10, 1 );
	remove_action( 'wp_head', 'noindex', 1 );
	remove_action( 'wp_head', 'wp_generator' ); //移除WordPress版本
	remove_action( 'wp_head', 'rel_canonical' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
endif;

/** --------------------------------------------------------------------------------- *
 *  移除头部wp-json数据
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_wp_head_json') ) :
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
endif;

/** --------------------------------------------------------------------------------- *
 *  禁止FEED
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_feed') ) :
	function digwp_disable_feed() {
	wp_die(__('<h1>Feed已经关闭, 请访问网站<a href="'.get_bloginfo('url').'">首页</a>!</h1>'));
	}
	add_action('do_feed', 'digwp_disable_feed', 1);
	add_action('do_feed_rdf', 'digwp_disable_feed', 1);
	add_action('do_feed_rss', 'digwp_disable_feed', 1);
	add_action('do_feed_rss2', 'digwp_disable_feed', 1);
	add_action('do_feed_atom', 'digwp_disable_feed', 1);
endif;

/** --------------------------------------------------------------------------------- *
 *  禁止前台加载语言包
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_language') ) :
	add_filter( 'locale', 'dqtheme_language' );
	function dqtheme_language($locale) {
		$locale = ( is_admin() ) ? $locale : 'en_US';
		return $locale;
	}
endif;

/** --------------------------------------------------------------------------------- *
 *  修改搜索结果的链接
 *  --------------------------------------------------------------------------------- */
if( dq('redirect_search') ) :
	function dqtheme_redirect_search() {
		if (is_search() && !empty($_GET['s'])) {
			wp_redirect(home_url("/search/").urlencode(get_query_var('s')));
			exit();
		}
	}
	add_action('template_redirect', 'dqtheme_redirect_search' );
endif;

/** --------------------------------------------------------------------------------- *
 *  移除后台标题后缀 - WordPress
 *  --------------------------------------------------------------------------------- */
add_filter('admin_title', 'dqtheme_custom_admin_title', 10, 2);
function dqtheme_custom_admin_title($admin_title, $title){
	return $title.' &lsaquo; '.get_bloginfo('name');
}

/** --------------------------------------------------------------------------------- *
 *  在后台添加一些css样式
 *  --------------------------------------------------------------------------------- */
add_action( 'admin_head', 'dq_admin_head' );
function dq_admin_head(){

	echo "<style>
	.manage-column.column-views,.views.column-views{width:7%}
	.dq_img.column-dq_img,.manage-column.column-dq_img{width:100px}
	</style>";
	if( dq('remove_menu_dqtheme-license') ){
		echo "<style>.toplevel_page_dqtheme-page .wp-first-item+li{display:none}</style>";
	}
	if( dq('remove_menu_dqtheme-optimize') ){
		echo "<style>.toplevel_page_dqtheme-page .wp-first-item+li+li{display:none}</style>";
	}

}

/** --------------------------------------------------------------------------------- *
 *  去掉后台Wordpress LOGO
 *  --------------------------------------------------------------------------------- */
function my_edit_toolbar($wp_toolbar) {
	$wp_toolbar->remove_node('wp-logo'); 
}
add_action('admin_bar_menu', 'my_edit_toolbar', 999);

/** --------------------------------------------------------------------------------- *
 *  彻底关闭WordPress生成默认尺寸的缩略图
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_option_thumbnail') ) :
	add_filter('pre_option_thumbnail_size_w',	'__return_zero');
	add_filter('pre_option_thumbnail_size_h',	'__return_zero');
	add_filter('pre_option_medium_size_w',		'__return_zero');
	add_filter('pre_option_medium_size_h',		'__return_zero');
	add_filter('pre_option_large_size_w',		'__return_zero');
	add_filter('pre_option_large_size_h',		'__return_zero');
endif;

/** --------------------------------------------------------------------------------- *
 *  WordPress替换登陆后跳转的后台默认首页
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_article') ) :
	function my_login_redirect($redirect_to, $request){
	if( empty( $redirect_to ) || $redirect_to == 'wp-admin/' || $redirect_to == admin_url() )
	return home_url("/wp-admin/edit.php");
	else
	return $redirect_to;
	}
	add_filter("login_redirect", "my_login_redirect", 10, 3);
endif;

/** --------------------------------------------------------------------------------- *
 *  彻底删除后台隐私相关设置
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_privacy') ) :
add_action('admin_menu', function (){

	global $menu, $submenu;

	unset($submenu['options-general.php'][45]);

	// Bookmark hooks.
	remove_action( 'admin_page_access_denied', 'wp_link_manager_disabled_message' );

	// Privacy tools
	remove_action( 'admin_menu', '_wp_privacy_hook_requests_page' );
	// Privacy hooks
	remove_filter( 'wp_privacy_personal_data_erasure_page', 'wp_privacy_process_personal_data_erasure_page', 10, 5 );
	remove_filter( 'wp_privacy_personal_data_export_page', 'wp_privacy_process_personal_data_export_page', 10, 7 );
	remove_filter( 'wp_privacy_personal_data_export_file', 'wp_privacy_generate_personal_data_export_file', 10 );
	remove_filter( 'wp_privacy_personal_data_erased', '_wp_privacy_send_erasure_fulfillment_notification', 10 );

	// Privacy policy text changes check.
	remove_action( 'admin_init', array( 'WP_Privacy_Policy_Content', 'text_change_check' ), 100 );

	// Show a "postbox" with the text suggestions for a privacy policy.
	remove_action( 'edit_form_after_title', array( 'WP_Privacy_Policy_Content', 'notice' ) );

	// Add the suggested policy text from WordPress.
	remove_action( 'admin_init', array( 'WP_Privacy_Policy_Content', 'add_suggested_content' ), 1 );

	// Update the cached policy info when the policy page is updated.
	remove_action( 'post_updated', array( 'WP_Privacy_Policy_Content', '_policy_page_updated' ) );
},9);
endif;

/** --------------------------------------------------------------------------------- *
 *  删除文章时删除图片附件
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_delete_post_attachments') ) :
function dqtheme_delete_post_and_attachments($post_ID) {
    global $wpdb;
    //删除特色图片
    $thumbnails = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE meta_key = '_thumbnail_id' AND post_id = $post_ID" );
    foreach ( $thumbnails as $thumbnail ) {
    wp_delete_attachment( $thumbnail->meta_value, true );
    }
    //删除图片附件
    $attachments = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_parent = $post_ID AND post_type = 'attachment'" );
    foreach ( $attachments as $attachment ) {
    wp_delete_attachment( $attachment->ID, true );
    }
    $wpdb->query( "DELETE FROM $wpdb->postmeta WHERE meta_key = '_thumbnail_id' AND post_id = $post_ID" );
}
add_action('before_delete_post', 'dqtheme_delete_post_and_attachments');
endif;

/** --------------------------------------------------------------------------------- *
 *  上传图片使用日期重命名
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_upload_img_rename') ) :
	function uazoh_wp_upload_filter($file){  
	$time=date("YmdHis");  
	$file['name'] = $time."".mt_rand(1,100).".".pathinfo($file['name'] , PATHINFO_EXTENSION);  
	return $file;  
	}  
	add_filter('wp_handle_upload_prefilter', 'uazoh_wp_upload_filter'); 
endif;

/** --------------------------------------------------------------------------------- *
 *  禁用古腾堡编辑器
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_no_gutenberg') ) :
	add_filter('use_block_editor_for_post_type', '__return_false');
endif;

/** --------------------------------------------------------------------------------- *
 *  文章外链 自动添加nofollow标签
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_post_nofollow') ) :
	add_filter( 'the_content', function ( $content ) {
	    //文章自动nofollow
	    $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
	    if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
	        if( !empty($matches) ) {
	   
	            $srcUrl = get_option('siteurl');
	            for ($i=0; $i < count($matches); $i++)
	            {
	                $tag = $matches[$i][0];
	                $tag2 = $matches[$i][0];
	                $url = $matches[$i][0];
	   
	                $noFollow = '';
	                $pattern = '/target\s*=\s*"\s*_blank\s*"/';
	                preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
	                if( count($match) < 1 )
	                    $noFollow .= ' target="_blank" ';
	   
	                $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
	                preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
	                if( count($match) < 1 )
	                    $noFollow .= ' rel="nofollow" ';
	   
	                $pos = strpos($url,$srcUrl);
	                if ($pos === false) {
	                    $tag = rtrim ($tag,'>');
	                    $tag .= $noFollow.'>';
	                    $content = str_replace($tag2,$tag,$content);
	                }
	            }
	        }
	    }
	    $content = str_replace(']]>', ']]>', $content);
	    return $content;
	});
endif;

/** --------------------------------------------------------------------------------- *
 *  修复WordPress定时发布失败
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_pubMissedPosts') ) :
	function pubMissedPosts() {
		if (is_front_page() || is_single()) {
			global $wpdb;
			$now=gmdate('Y-m-d H:i:00');
		
	    	$args=array(
	        	'public'                => true,
		        'exclude_from_search'   => false,
	    	    '_builtin'              => false
		    ); 
	    	$post_types = get_post_types($args,'names','and');
			$str=implode ('\',\'',$post_types);

			if ($str) {
				$sql="Select ID from $wpdb->posts WHERE post_type in ('post','page','$str') AND post_status='future' AND post_date_gmt<'$now'";
			}
			else {$sql="Select ID from $wpdb->posts WHERE post_type in ('post','page') AND post_status='future' AND post_date_gmt<'$now'";}

			$resulto = $wpdb->get_results($sql);
	 		if($resulto) {
				foreach( $resulto as $thisarr ) {
					wp_publish_post($thisarr->ID);
				}
			}
		}
	}
	add_action('wp_head', 'pubMissedPosts');
endif;

if( dq('dq_instantpage') ) :
	// instantpage-5.1.0  即时预加载  https://instant.page/
	function dq_instantpage() {
		echo '<script src="'.get_template_directory_uri().'/static/js/instantpage-5.1.0.js" type="module" defer></script>';
	}
	add_action('wp_footer', 'dq_instantpage', 999);
	add_action('admin_footer', 'dq_instantpage', 999);
endif;

/** --------------------------------------------------------------------------------- *
 *  评论回复 邮件通知
 *  --------------------------------------------------------------------------------- */
add_action('comment_post',function ($comment_id) {
	$comment = get_comment($comment_id);
	$parent_id = $comment->comment_parent ? $comment->comment_parent : '';
	$spam_confirmed = $comment->comment_approved;
	if (($parent_id != '') && ($spam_confirmed != 'spam')) {
		$wp_email = 'no-reply@' . preg_replace('#^www.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.
		$to = trim(get_comment($parent_id)->comment_author_email);
		$subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
		$message = '
<table cellpadding="0" cellspacing="0" class="email-container" align="center" width="550" style="font-size: 15px; font-weight: normal; line-height: 22px; text-align: left; border: 1px solid rgb(177, 213, 245); width: 550px;">
<tbody><tr>
<td>
<table cellpadding="0" cellspacing="0" class="padding" width="100%" style="padding-left: 40px; padding-right: 40px; padding-top: 30px; padding-bottom: 35px;">
<tbody>
<tr class="logo">
<td align="center">
<table class="logo" style="margin-bottom: 10px;">
<tbody>
<tr>
<td>
<span style="font-size: 22px;padding: 10px 20px;margin-bottom: 5%;color: #65c5ff;border: 1px solid;box-shadow: 0 5px 20px -10px;border-radius: 2px;display: inline-block;">' . get_option("blogname") . '</span>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr class="content">
<td>
<hr style="height: 1px;border: 0;width: 100%;background: #eee;margin: 15px 0;display: inline-block;">
<p>Hi ' . trim(get_comment($parent_id)->comment_author) . '!<br>您评论在 "' . get_the_title($comment->comment_post_ID) . '":</p>
<p style="background: #eee;padding: 1em;text-indent: 2em;line-height: 30px;">' . trim(get_comment($parent_id)->comment_content) . '</p>
<p>'. $comment->comment_author .' 给您的答复:</p>
<p style="background: #eee;padding: 1em;text-indent: 2em;line-height: 30px;">' . trim($comment->comment_content) . '</p>
</td>
</tr>
<tr>
<td align="center">
<table cellpadding="12" border="0" style="font-family: Lato, \'Lucida Sans\', \'Lucida Grande\', SegoeUI, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: bold; line-height: 25px; color: #444444; text-align: left;">
<tbody><tr>
<td style="text-align: center;">
<a target="_blank" style="color: #fff;background: #65c5ff;box-shadow: 0 5px 20px -10px #44b0f1;border: 1px solid #44b0f1;width: 200px;font-size: 14px;padding: 10px 0;border-radius: 2px;margin: 10% 0 5%;text-align:center;display: inline-block;text-decoration: none;" href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看详情</a>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>

<table border="0" cellpadding="0" cellspacing="0" align="center" class="footer" style="max-width: 550px; font-family: Lato, \'Lucida Sans\', \'Lucida Grande\', SegoeUI, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 22px; color: #444444; text-align: left; padding: 20px 0; font-weight: normal;">
<tbody><tr>
<td align="center" style="text-align: center; font-size: 12px; line-height: 18px; color: rgb(163, 163, 163); padding: 5px 0px;">
</td>
</tr>
<tr>
<td style="text-align: center; font-weight: normal; font-size: 12px; line-height: 18px; color: rgb(163, 163, 163); padding: 5px 0px;">
<p>Please do not reply to this message , because it is automatically sent.</p>
<p>© '.date("Y").' <a name="footer_copyright" href="' . home_url() . '" style="color: rgb(43, 136, 217); text-decoration: underline;" target="_blank">' . get_option("blogname") . '</a></p>
</td>
</tr>
</tbody>
</table>';
		$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
		$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
		wp_mail( $to, $subject, $message, $headers );
	}
});

/** --------------------------------------------------------------------------------- *
 *  后台 文章列表  ajax删除文章
 *  --------------------------------------------------------------------------------- */
if( dq('dqtheme_moveposttotrash') ) :

	add_action( 'admin_footer', 'dq_custom_internal_javascript' );
	function dq_custom_internal_javascript(){
	
		echo "<script>
			jQuery(function($){
				$('body.post-type-post .row-actions .trash a').click(function( event ){
			 
					event.preventDefault();
			 
					var url = new URL( $(this).attr('href') ),
					    nonce = url.searchParams.get('_wpnonce'), // MUST for security checks
					    row = $(this).closest('tr'),
					    postID = url.searchParams.get('post'),
					    postTitle = row.find('.row-title').text();
			 
			 
					row.css('background-color','#ffafaf').fadeOut(300, function(){
						row.removeAttr('style').html('<td colspan=\'5\' style=\'background:#fff;border-left:1px solid #FF5722;border-left-width:4px;color:#555\'><strong>' + postTitle + '</strong> 已被移动到回收站</td>').show();
					});
			 
					$.ajax({
						method:'POST',
						url: ajaxurl,
						data: {
							'action' : 'moveposttotrash',
							'post_id' : postID,
							'_wpnonce' : nonce
						}
					});
			 
				});
			});
		</script>";
	
	}
	
	add_action('wp_ajax_moveposttotrash', function(){
		check_ajax_referer( 'trash-post_' . $_POST['post_id'] );
		wp_trash_post( $_POST['post_id'] );
		die();
	});

endif;

/** --------------------------------------------------------------------------------- *
 *  链接增加 nofollow 选项
 *  --------------------------------------------------------------------------------- */
if( dq('dq_links_nofollow') ) :

add_action('admin_head','dq_links_nofollow');
function dq_links_nofollow() {?>
<script type="text/javascript">
addLoadEvent(addNofollowTag);
function addNofollowTag() {
  tables = document.getElementsByTagName('table');
  for(i=0;i<tables.length;i++) {
    if(tables[i].getAttribute("class") == "links-table") {
      tr = tables[i].insertRow(1);
      th = document.createElement('th');
      th.setAttribute('scope','row');
      th.appendChild(document.createTextNode('Follow'));
      td = document.createElement('td');
      tr.appendChild(th);
      label = document.createElement('label');
      input = document.createElement('input');
      input.setAttribute('type','checkbox');
      input.setAttribute('id','nofollow');
      input.setAttribute('value','nofollow');
      label.appendChild(input);
      label.appendChild(document.createTextNode(' nofollow'));
      td.appendChild(label);
      tr.appendChild(td);
      input.name = 'nofollow';
      input.className = 'valinp';
      if (document.getElementById('link_rel').value.indexOf('nofollow') != -1) {
        input.setAttribute('checked','checked');
      }
      return;
    }
  }
}
</script>
<?php
}

endif;

/** --------------------------------------------------------------------------------- *
 *  彻底移除后台「评论」相关菜单
 *  --------------------------------------------------------------------------------- */
if( dq('dq_remove_comment') ) :
	include TEMPLATEPATH.'/public/extend/remove_comment.php';
endif;

/** --------------------------------------------------------------------------------- *
 *  移除后台「仪表盘」菜单
 *  --------------------------------------------------------------------------------- */
if( dq('dq_remove_dashboard') ) :

	//访问仪表盘跳转到文章列表
	add_action('load-index.php', function(){
		wp_redirect(admin_url('edit.php'));
	});
	//登录后跳转到文章列表
	add_filter('login_redirect', function($redirect_to, $request, $user){
		return admin_url('edit.php');
	},10,3);
	//移除仪表盘菜单
	add_action('admin_menu', function(){
	    global $menu;
	    $restricted = array(__('Dashboard'));
	    //$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
	    end($menu);
	    while(prev($menu)){
	        $value = explode(' ',$menu[key($menu)][0]);
	        if(in_array($value[0]!= NULL?$value[0]:'',$restricted)){unset($menu[key($menu)]);}
	    }
	});
	add_action('admin_head', function(){
		echo "<style>#adminmenu .wp-menu-separator:first-child{display:none}</style>";
	});

endif;

/** --------------------------------------------------------------------------------- *
 *  移除后台「工具」菜单
 *  --------------------------------------------------------------------------------- */
if( dq('dq_remove_tools') ) :

	//访问工具跳转到文章列表
	add_action('admin_head-tools.php', function(){
		wp_redirect(admin_url('edit.php'));
	});
	//移除工具菜单
	add_action('admin_menu', function(){
	    global $menu;
	    $restricted = array(__('Tools'));
	    //$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
	    end($menu);
	    while(prev($menu)){
	        $value = explode(' ',$menu[key($menu)][0]);
	        if(in_array($value[0]!= NULL?$value[0]:'',$restricted)){unset($menu[key($menu)]);}
	    }
	});

endif;

/** --------------------------------------------------------------------------------- *
 *  修改网站管理员邮箱 去除验证步骤
 *  --------------------------------------------------------------------------------- */
if( dq('dq_new_admin_email') ) :

	remove_action( 'add_option_new_admin_email', 'update_option_new_admin_email' );
	remove_action( 'update_option_new_admin_email', 'update_option_new_admin_email' );

	function dq_update_option_new_admin_email( $old_value, $value ) {
	  	update_option( 'admin_email', $value );
	}
	add_action( 'add_option_new_admin_email', 'dq_update_option_new_admin_email', 10, 2 );
	add_action( 'update_option_new_admin_email', 'dq_update_option_new_admin_email', 10, 2 );

endif;

/** --------------------------------------------------------------------------------- *
 *  在WordPress后台文章列表中按作者过滤帖子
 *  --------------------------------------------------------------------------------- */
function dq_filter_by_the_author() {
	$params = array(
		'name' => 'author',
		'show_option_all' => '全部作者'
	);
 
	if ( isset($_GET['user']) )
		$params['selected'] = $_GET['user'];
 
	wp_dropdown_users( $params );
}
add_action('restrict_manage_posts', 'dq_filter_by_the_author');

/** --------------------------------------------------------------------------------- *
 *  启用WPJAM插件后 不显示某些功能
 *  --------------------------------------------------------------------------------- */
if( !defined('WPJAM_BASIC_PLUGIN_FILE') ){

	//
	// 后台文章列表增加「浏览量」显示
	//
	//在后台文章列表增加一列数据
	add_filter( 'manage_post_posts_columns', 'dqtheme_customer_posts_columns' );
	function dqtheme_customer_posts_columns( $columns ) {
		$columns['views'] = '浏览量';
		return $columns;
	}

	//添加对列进行排序的功能
	add_filter('manage_edit-post_sortable_columns', 'dq_add_views_sortable_column');
	function dq_add_views_sortable_column($columns){
		$columns['views'] = '浏览量';
		return $columns;
	}

	//输出浏览次数
	add_action('manage_post_posts_custom_column', 'dqtheme_customer_columns_value', 10, 2);
	function dqtheme_customer_columns_value($column, $post_id){
		if($column=='views'){
			$count = get_post_meta($post_id, 'views', true);
			if(!$count){
				$count = 0;
			}
			echo $count;
		}
		return;
	}

	//
	// 后台文章列表增加「缩略图」显示
	//
	if( dq('dq_admin_column_img') ){ //判断是否开启文章缩略图

		/**
		* manage_post_posts_columns 为默认文章类型添加columns
		* manage_dq_posts_columns 为自定义文章类型（dq）添加columns
		*/
		add_filter('manage_post_posts_columns', 'add_img_column_dq');
		add_filter('manage_post_posts_custom_column', 'manage_img_column_dq', 10, 2);

		function add_img_column_dq($columns) {
			$columns = array_slice($columns, 0, 1, true) + array("dq_img" => "缩略图") + array_slice($columns, 1, count($columns) - 1, true);
			return $columns;
		}

		function manage_img_column_dq($column_name, $post_id) {
			if( $column_name == 'dq_img' ) {
				//echo get_the_post_thumbnail($post_id, 'thumbnail');
				echo '<a href="'.get_edit_post_link().'" rel="bookmark"><img style="width:100px;height:70px;object-fit:cover;border-radius:3px" src="'.post_thumbnail().'" alt="'.get_the_title().'"></a>';
			}
			return $column_name;
		}
	}

	//
	// 后台用户列表增加「最后登录时间」显示
	//
	add_action( 'wp_login', 'dq_collect_login_timestamp', 20, 2 );
	function dq_collect_login_timestamp( $user_login, $user ) {
		update_user_meta( $user->ID, 'last_login', time() );
	}

	add_filter( 'manage_users_columns', 'dq_user_last_login_column' );
	function dq_user_last_login_column( $columns ) {
		$columns['last_login'] = '最后登录'; //
		return $columns;
	}

	add_filter( 'manage_users_custom_column', 'dq_last_login_column', 10, 3 );
	function dq_last_login_column( $output, $column_id, $user_id ){
		if( $column_id == 'last_login' ) {
			$output = get_user_meta( $user_id, 'last_login', true );
			//$output = !empty($last_login) ? get_date_from_gmt(date('Y-m-d H:i:s', $last_login)) : '';
		}
		return $output;
	}

	//最后登录时间 增加可排序功能
	add_filter( 'manage_users_sortable_columns', 'dq_sortable_columns' );
	function dq_sortable_columns( $columns ) {
	 
		return wp_parse_args( array(
		 	'last_login' => 'last_login'
		), $columns );
	 
	}

	add_action( 'pre_get_users', 'dq_sort_last_login_column' );
	function dq_sort_last_login_column( $query ) {

		if( !is_admin() ) {
			return $query;
		}

		$screen = get_current_screen();
		if( isset( $screen->id ) && $screen->id !== 'users' ) {
			return $query;
		}

		if( isset( $_GET[ 'orderby' ] ) && $_GET[ 'orderby' ] == 'last_login' ) {
			$query->query_vars['meta_key'] = 'last_login';
			$query->query_vars['orderby'] = 'meta_value';
		}

		return $query;
	}

	//
	// 后台用户列表增加「注册日期」显示
	//
	//添加注册日期列
	add_filter('manage_users_columns', function($column_headers){
		$column_headers['registered'] = '注册日期';
		return $column_headers;
	});

	add_filter('manage_users_custom_column', function($value, $column_name, $user_id){
		if($column_name=='registered'){
			$user = get_userdata($user_id);
			return get_date_from_gmt($user->user_registered);
		}else{
			return $value;
		}
	},11,3);

	//默认以最新注册排序
	add_action('pre_user_query', function($query){
		if(!isset($_REQUEST['orderby']) ){
			//if( !in_array($_REQUEST['order'],array('asc','desc')) ){
				$_REQUEST['order'] = 'desc';
			//}
			$query->query_orderby = "ORDER BY user_registered ".$_REQUEST['order']."";
		}
	});

	//为注册日期添加可排序功能
	add_filter( 'manage_users_sortable_columns', function($columns){
		return wp_parse_args( array( 'registered' => 'registered' ), $columns );
	});

	//
	// 后台用户列表增加「用户昵称」显示，移除「姓名」
	//
	add_filter( 'manage_users_columns', function($columns){
		unset( $columns['name'] ); //移除「姓名」列
		$columns['user_nickname'] = '用户昵称';
		return $columns;
	});

	add_filter( 'manage_users_custom_column', function($value, $column_name, $user_id){

		$user = get_userdata( $user_id );
		$user_nickname = $user->nickname;
		if ( 'user_nickname' == $column_name )
			return $user_nickname;
		return $value;

	},10,3);

	//
	// 重新排列显示位置
	//
	add_filter('manage_users_columns', 'add_company_column', 15, 1);
	function add_company_column($defaults) {
	    unset($defaults);
	    $defaults['cb']				= '';
	    $defaults['username']		= '登录名/ID';
	    $defaults['user_nickname']	= '用户昵称';
	    $defaults['email']			= '电子邮件';
	    $defaults['role']			= '用户角色';
	    $defaults['last_login']		= '最后登录';
	    $defaults['registered']		= '注册日期';
	    $defaults['posts']			= '文章';
	    return $defaults;
	}

	//
	// 后台-用户，可通过用户昵称进行搜索
	//
	add_action('pre_user_query', 'dq_extend_user_search');
	function dq_extend_user_search( $u_query ){
	    // 确保代码仅应用于用户搜索
	    if ( $u_query->query_vars['search'] ){
	        $search_query = trim( $u_query->query_vars['search'], '*' );
	        if ( $_REQUEST['s'] == $search_query ){
	            global $wpdb;

	            // 添加昵称搜索查询语句
	            $u_query->query_from .= " JOIN {$wpdb->usermeta} fname ON fname.user_id = {$wpdb->users}.ID AND fname.meta_key = 'nickname'";

	            // 设置可搜索的字段
	            $search_by = array( 'user_login', 'user_email', 'fname.meta_value' );

	            // 应用到搜索
	            $u_query->query_where = 'WHERE 1=1' . $u_query->get_search_sql( $search_query, $search_by, 'both' );
	        }
	    }
	}



//end
}


/** --------------------------------------------------------------------------------- *
 *  修改WP默认站点地图
 *  --------------------------------------------------------------------------------- */
// 禁用用户站点地图
function dq_disable_sitemap_users($provider, $name) {
	return ($name == 'users') ? false : $provider;
}
add_filter('wp_sitemaps_add_provider', 'dq_disable_sitemap_users', 10, 2);

/** --------------------------------------------------------------------------------- *
 *  移除登录页面的语言选择器
 *  --------------------------------------------------------------------------------- */
add_filter( 'login_display_language_dropdown', '__return_false' );


