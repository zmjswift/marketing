<?php
class Dq_Post
{
	public static function get_by_ids($post_ids)
	{
		return self::update_caches($post_ids);
	}
	public static function update_caches($post_ids, $args = [])
	{
		if ($post_ids) {
			$post_ids = array_filter($post_ids);
			$post_ids = array_unique($post_ids);
		}
		if (empty($post_ids)) {
			return array();
		}
		$_var_0 = true;
		$_var_1 = true;
		_prime_post_caches($post_ids, $_var_0, $_var_1);
		$_var_2 = array();
		foreach ($post_ids as $_var_3) {
			$_var_4 = wp_cache_get($_var_3, "posts");
			if ($_var_4 !== false) {
				$_var_2[$_var_3] = $_var_4;
			}
		}
		return $_var_2;
	}
}
add_action("parse_query", function (&$wp_query) {
	if (!is_admin() && $wp_query->get("post_type") == "nav_menu_item") {
		$wp_query->set("suppress_filters", false);
	}
});
add_filter("posts_pre_query", function ($pre, $wp_query) {
	if ($wp_query->get("orderby") == "rand") {
		return $pre;
	}
	if (!$wp_query->is_main_query() && $wp_query->get("post_type") != "nav_menu_item" && !$wp_query->get("cache_it")) {
		return $pre;
	}
	$_var_5 = md5(serialize(array_filter($wp_query->query_vars)) . $wp_query->request);
	$_var_6 = wp_cache_get_last_changed("posts");
	$_var_7 = "dq_get_posts:" . $_var_5 . ":" . $_var_6;
	$_var_8 = wp_cache_get($_var_7, "dq_post_ids");
	$wp_query->set("cache_key", $_var_7);
	if ($_var_8 === false) {
		return $pre;
	}
	if ($_var_8 && !$wp_query->is_singular() && empty($wp_query->get("nopaging")) && empty($wp_query->get("no_found_rows"))) {
		$_var_9 = wp_cache_get($_var_7, "dq_found_posts");
		if ($_var_9 === false) {
			return $pre;
		}
		$wp_query->set("no_found_rows", true);
		$wp_query->found_posts = $_var_9;
		$wp_query->max_num_pages = ceil($_var_9 / $wp_query->get("posts_per_page"));
	}
	$_var_10 = wp_array_slice_assoc($wp_query->query_vars, array("update_post_term_cache", "update_post_meta_cache"));
	return dq_get_posts($_var_8, $_var_10);
}, 10, 2);
add_filter("posts_results", function ($posts, $wp_query) {
	$_var_11 = $wp_query->get("cache_key");
	if ($_var_11) {
		if (count($posts) > 1) {
			$_var_12 = wp_list_pluck($posts, "post_author");
			$_var_12 = array_unique($_var_12);
			$_var_12 = array_filter($_var_12);
			if (count($_var_12) > 1) {
				cache_users($_var_12);
			}
		}
		$_var_13 = wp_cache_get($_var_11, "dq_post_ids");
		if ($_var_13 === false) {
			wp_cache_set($_var_11, array_column($posts, "ID"), "dq_post_ids", HOUR_IN_SECONDS);
		}
	}
	return $posts;
}, 10, 2);
add_filter("found_posts", function ($found_posts, $wp_query) {
	$_var_14 = $wp_query->get("cache_key");
	if ($_var_14) {
		wp_cache_set($_var_14, $found_posts, "dq_found_posts", HOUR_IN_SECONDS);
	}
	return $found_posts;
}, 10, 2);
add_filter("update_post_metadata", function ($check, $post_id, $meta_key, $meta_value) {
	if ($meta_key == "_edit_lock") {
		return wp_cache_set($post_id, $meta_value, "_edit_lock", 300);
	} elseif ($meta_key == "_edit_last") {
		if (get_post($post_id)->post_author == $meta_value) {
			if (get_post_meta($post_id, $meta_key, true) != $meta_value) {
				delete_post_meta($post_id, $meta_key);
			}
			return true;
		}
	}
	return $check;
}, 1, 4);
add_filter("add_post_metadata", function ($check, $post_id, $meta_key, $meta_value) {
	if ($meta_key == "_edit_lock") {
		return wp_cache_set($post_id, $meta_value, "_edit_lock", 300);
	} elseif ($meta_key == "_edit_last") {
		if (get_post($post_id)->post_author == $meta_value) {
			return true;
		}
	} elseif ($meta_key == "_wp_old_slug") {
		if (strpos($meta_value, "%") !== false) {
			return true;
		}
	}
	return $check;
}, 1, 4);
add_filter("get_post_metadata", function ($pre, $post_id, $meta_key) {
	$_var_15 = array("_edit_lock");
	if (in_array($meta_key, $_var_15)) {
		$_var_16 = wp_cache_get($post_id, $meta_key);
		if ($_var_16 !== false) {
			return array($_var_16);
		}
	} else {
		if ($meta_key == "_edit_last") {
			$_var_17 = get_post_meta($post_id);
			if (!isset($_var_17["_edit_last"])) {
				$_var_17["_edit_last"] = array(get_post($post_id)->post_author);
			}
			return $_var_17["_edit_last"];
		} elseif ($meta_key == "") {
			$_var_18 = wp_cache_get($post_id, "post_meta");
			if ($_var_18 === false) {
				$_var_18 = update_meta_cache("post", array($post_id));
				$_var_18 = $_var_18[$post_id];
			}
			foreach ($_var_15 as $_var_19) {
				$_var_20 = wp_cache_get($post_id, $_var_19);
				if ($_var_20 !== false) {
					$_var_18[$_var_19] = array($_var_20);
				}
			}
			return $_var_18;
		}
	}
	return $pre;
}, 1, 3);
//去掉检测授权
//add_action("wp_head", "dqtheme_check_license");
add_filter("admin_footer_text", function () {
	echo "<span id=\"footer-thankyou\">感谢使用 <a href=\"http://www.dqtheme.com\" target=\"_blank\" style=\"text-transform: uppercase;\">" . wp_get_theme() . "主题</a> 进行创作</span>";
});
add_action("pre_get_posts", function ($query) {
	if ($query->is_archive && is_archive() && !is_admin()) {
		if (wp_is_mobile()) {
			$_var_21 = dq_taxonomy("posts_per_page_mobile") ?: "10";
		} else {
			$_var_21 = dq_taxonomy("posts_per_page") ?: "9";
		}
		$query->set("posts_per_page", $_var_21);
	}
	return $query;
});
add_action("widgets_init", function () {
	$_var_22 = array("type" => "post", "orderby" => "name", "order" => "ASC", "hide_empty" => 0, "taxonomy" => "category", "pad_counts" => false);
	$_var_23 = get_categories($_var_22);
	foreach ($_var_23 as $_var_24) {
		$_var_25 = get_term_meta($_var_24->term_id, "_dq_taxonomy_options", true);
		if (!empty($_var_25["cat_widgets"])) {
			register_sidebar(array("id" => "widget-area-" . $_var_24->term_id, "name" => "「" . $_var_24->name . "」 - 侧栏小工具", "before_widget" => "<div class=\"widget %2\$s\">", "after_widget" => "</div>", "before_title" => "<div class=\"title-box\"><h3>", "after_title" => "</h3></div>"));
		}
	}
});
add_action("after_switch_theme", "create_home_page");
function Dq_Query($args = [], $cache_time = '3600')
{
	$args["no_found_rows"] = true;
	$args["cache_results"] = true;
	$args["cache_it"] = true;
	return new WP_Query($args);
}
function dq_get_posts($post_ids, $args = [])
{
	$_var_26 = Dq_Post::get_by_ids($post_ids, $args);
	return $_var_26 ? array_values($_var_26) : array();
}
/*
function dqtheme_check_license()
{
	//dqtheme_theme_check_license();
	//print_r(dqtheme_theme_check_license());
	$auth = dqtheme_is_auth();
	if (!$auth) {
		if (!is_admin()) {
			delete_transient("dqtheme-theme-license");
			wp_die("<div class=\"no-verify-box\" style=\"text-align: center;\">
				<div class=\"no-verify-inner\" style=\"background: #fff6dc;padding: 20px;margin-top: 20px;\">
					<p style=\"font-family:microsoft yahei;margin:10px 0;line-height:30px\">您好，您还没有进行主题授权验证， 请到 <a href=\"/wp-admin/admin.php?page=theme-license\">[后台 → " . DAHUZI_THEME_NAME . " → 主题授权 ]</a>进行授权</br>
				</p>
				</div>
				</div>");
		}
	}
}
*/
function dq_post_time()
{
	$_var_28 = get_option("date_format");
	$_var_29 = get_option("time_format");
	return get_the_date($_var_28 . " " . $_var_29);
}
function post_thumbnail_url()
{
	global $post;
	$_var_30 = dq_img("default_timthumb");
	if (has_post_thumbnail()) {
		$_var_31 = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full");
		$_var_32 = $_var_31[0];
		$_var_33 = $_var_32;
	} else {
		ob_start();
		ob_end_clean();
		$_var_34 = preg_match_all("/<img.+src=['\"]([^'\"]+)['\"].*>/i", $post->post_content, $_var_35, PREG_SET_ORDER);
		$_var_36 = count($_var_35);
		if ($_var_36 > 0) {
			$_var_32 = $_var_35[0][1];
			$_var_33 = $_var_32;
		} else {
			$_var_33 = $_var_30;
		}
	}
	return $_var_33;
}
function dqtheme_get_attachment_id($img_url)
{
	$_var_37 = md5($img_url);
	$_var_38 = wp_cache_get($_var_37, "dqtheme_attachment_id");
	if ($_var_38 == false) {
		$_var_39 = wp_upload_dir();
		$_var_40 = $_var_39["baseurl"] . "/";
		$_var_41 = str_replace($_var_40, "", $img_url);
		if ($_var_41) {
			global $wpdb;
			$_var_38 = $wpdb->get_var("SELECT post_id FROM " . $wpdb->postmeta . " WHERE meta_value = '" . $_var_41 . "'");
			$_var_38 = $_var_38 ?: "";
		} else {
			$_var_38 = "";
		}
		wp_cache_set($_var_37, $_var_38, "dqtheme_attachment_id", 86400);
	}
	return $_var_38;
}
function post_thumbnail_alt()
{
	$_var_42 = dqtheme_get_attachment_id(post_thumbnail_url());
	$_var_43 = get_post_meta($_var_42, "_wp_attachment_image_alt", true);
	return $_var_43;
}
function is_android_dq()
{
	$_var_44 = (bool) strpos($_SERVER["HTTP_USER_AGENT"], "Android");
	if ($_var_44) {
		return true;
	} else {
		return false;
	}
}
function dq_add_page($title, $slug, $parent_slug, $page_template = '')
{
	$_var_45 = get_pages();
	$_var_46 = 0;
	$_var_47 = false;
	foreach ($_var_45 as $_var_48) {
		if (strtolower($_var_48->post_name) == strtolower($slug)) {
			$_var_47 = true;
		}
		if ($parent_slug != "") {
			if (strtolower($_var_48->post_name) == strtolower($parent_slug)) {
				$_var_46 = $_var_48->ID;
			}
		}
	}
	if ($_var_47 == false) {
		if ($_var_46 != 0) {
			$_var_49 = array("post_title" => $title, "post_type" => "page", "post_name" => $slug, "comment_status" => "closed", "ping_status" => "closed", "post_content" => "", "post_status" => "publish", "post_parent" => $_var_46, "post_author" => 1, "menu_order" => 0);
		} else {
			$_var_49 = array("post_title" => $title, "post_type" => "page", "post_name" => $slug, "comment_status" => "closed", "ping_status" => "closed", "post_content" => "", "post_status" => "publish", "post_author" => 1, "menu_order" => 0);
		}
		$_var_50 = wp_insert_post($_var_49);
		if ($_var_50 && $page_template != "") {
			update_post_meta($_var_50, "_wp_page_template", $page_template);
		}
	}
}
function dq_excerpt($length, $more = '&hellip;', $echo = true)
{
	static $_var_51, $_var_52;
	$_var_53 = current_filter();
	if ($_var_53 == "excerpt_length") {
		return $_var_51;
	}
	if ($_var_53 == "excerpt_more") {
		return $_var_52;
	}
	$_var_51 = $length;
	$_var_52 = $more;
	$_var_54 = "dq_excerpt";
	add_filter("excerpt_length", $_var_54, 18);
	add_filter("excerpt_more", $_var_54, 18);
	$_var_55 = $echo ? the_excerpt() : get_the_excerpt();
	remove_filter("excerpt_length", $_var_54, 18);
	remove_filter("excerpt_more", $_var_54, 18);
	unset($_var_51, $_var_52);
	return $_var_55;
}
function create_home_page()
{
	dq_add_page("模块化首页", "home", "member", "template-parts/modular-index.php");
}