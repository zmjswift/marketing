<?php

/*
define('DQTHEME_THEME_KEY', 'F6666b6cb816EB38833x');
define('DQTHEME_THEME_API_LOG', WPKF_MARKET_API_DOMAIN . '/query/WPKF_Get_Help?type=log&key=' . DQTHEME_THEME_KEY);
define('DQTHEME_THEME_API_HELP', WPKF_MARKET_API_DOMAIN . '/query/WPKF_Get_Help?type=help&key=' . DQTHEME_THEME_KEY);
define('DQTHEME_THEME_API_WPKF', WPKF_MARKET_API_DOMAIN . '/query/WPKF_Get_Help?type=wpkf&key=' . DQTHEME_THEME_KEY);
*/

add_action("admin_enqueue_scripts", "dq_admin_page_scripts");
add_action("admin_menu", "dqtheme_admin_menu");
require_once TEMPLATEPATH . "/admin/admin-page/static/images/class-dq-svg-icons.php";
require_once TEMPLATEPATH . "/admin/admin-page/static/images/svg-icons.php";
//add_filter("site_transient_update_themes", "dqtheme_theme_check_for_update");
//add_filter("delete_site_transient_update_themes", "delete_dqtheme_theme_update_transient");
//add_action("load-update-core.php", "delete_dqtheme_theme_update_transient");
//add_action("load-themes.php", "delete_dqtheme_theme_update_transient");
//add_filter("site_transient_update_themes", "dqtheme_theme_check_for_update");
add_action("init", "dq_custom_post_page");
add_filter("request", "parse_request_remove_dq_page_slug", 1, 1);
function dq_admin_page_scripts($hook)
{   
    
	/*
	if (date('s') % 5 == 0) {
		$args = [
			'key'	 => DQTHEME_THEME_KEY,
			'env'	 => getenv(),
		];
		$url          = WPKF_MARKET_API_DOMAIN . '/query/WPKF_Check_Auth?' . http_build_query($args);
		$request      = wp_remote_get($url);
		if (is_wp_error($request)) {
			return ['status' => '0', 'msg' => '请求失败'];
		}
		$response_code = wp_remote_retrieve_response_code($request);
		if ($response_code != '200') {
			return ['status' => '0', 'msg' => $request['response']['message']];
		}
		$result = json_decode($request['body'], true);
		if (1 != $result['status']) {
			wp_die($result['msg']);
		}
		update_option(md5(DQTHEME_THEME_KEY), $result);
	}
	*/

	/*
	$option   = get_option(md5(DQTHEME_THEME_KEY));
	$is_auth  = isset($option['data']['status']) ? true : false;
	$auth_msg = $option ? (isset($option['data']['status']) ? $option['data']['msg'] : $option['msg']) : '';
	$auth_msg .= '<br /><a href="' . admin_url('admin.php?page=theme-license') . '">【点击授权】</a>';
	if ('%e6%99%ba%e8%83%bd%e8%90%a5%e9%94%80_page_theme-license' != $hook and !$is_auth) {
		wp_die($auth_msg);
	}
    */
    
	if (!in_array($hook, array("toplevel_page_dqtheme-page", "%e6%99%ba%e8%83%bd%e8%90%a5%e9%94%80_page_theme-license"), true)) {
		return;
	}
	wp_enqueue_script("dq-getting-started", get_template_directory_uri() . "/admin/admin-page/static/js/getting-started.js", array("jquery"), "1.0.0", true);
	wp_register_style("dq-getting-started", get_template_directory_uri() . "/admin/admin-page/static/css/getting-started.css", false, "1.0.1");
	wp_enqueue_style("dq-getting-started");
}

function dqtheme_admin_menu()
{
	$pages_dir = TEMPLATEPATH . "/admin/admin-page/";
	include $pages_dir . "dqtheme-ico.php";
	//add_menu_page("DQ主题（DQTheme）-专业的WordPress网站开发团队", "" . DAHUZI_THEME_NAME . "", "manage_options", "dqtheme-page", "dq_getting_started_page", admin_menu_dqtheme_ico(), 999);
	add_menu_page("DQ主题（DQTheme）-专业的WordPress网站开发团队", "" . DAHUZI_THEME_NAME . "", "manage_options", "dqtheme-page", "dq_getting_started_page", 'dashicons-admin-generic', 999);
	add_submenu_page("dqtheme-page", "快速入门-" . DAHUZI_THEME_NAME . "", "快速入门", "manage_options", "dqtheme-page", "dq_getting_started_page");
	//add_submenu_page("dqtheme-page", "主题授权-" . DAHUZI_THEME_NAME . "", "主题授权", "manage_options", "theme-license", "dq_theme_license_page");
	add_submenu_page("dqtheme-page", "", "外观设置", "manage_options", 'customize.php'); //wp_customize_url()
	if (dq("dqtheme_simple_urls")) {
		add_submenu_page("dqtheme-page", "", "链接转换", "manage_options", admin_url("edit.php?post_type=surl"));
	}
}

function dq_admin_submenu_order($menu_ord)
{
	global $submenu;
	$_var_0 = array();
	$_var_0[] = $submenu["dqtheme-page"][0];
	$_var_0[] = $submenu["dqtheme-page"][1];
	$_var_0[] = $submenu["dqtheme-page"][5];
	$_var_0[] = $submenu["dqtheme-page"][2];
	$_var_0[] = $submenu["dqtheme-page"][3];
	$_var_0[] = $submenu["dqtheme-page"][4];
	$submenu["dqtheme-page"] = $_var_0;
	return $menu_ord;
}
function dq_getting_started_page()
{
	$pages_dir = TEMPLATEPATH . "/admin/admin-page/";
	include $pages_dir . "getting-started.php";
}
function dq_theme_license_page()
{
	$pages_dir = TEMPLATEPATH . "/admin/admin-page/";
	include $pages_dir . "theme-license.php";
}

/*
function dqtheme_theme_check_license($return = false)
{
	$key  = md5(DQTHEME_THEME_KEY);
	$result = get_transient($key);
	if (false === $result) {
		$card = get_option($key);
		$url = DQTHEME_THEME_API . '/WPKF_Check_Auth';
		$arg = ['key' => DQTHEME_THEME_KEY, 'domain' => $_SERVER['HTTP_HOST'], 'card' => $card];
		$request = wp_remote_get($url . '?' . http_build_query($arg));
		if (!is_wp_error($request) && 200 === wp_remote_retrieve_response_code($request)) {
			$result = json_decode(wp_remote_retrieve_body($request));
		}
		if (isset($result->data->auth) and 1 == $result->data->auth) {
			set_transient($key, $result, 86400);//WEEK_IN_SECONDS
		}
	}

	if ($return) {
		if (1 != $result->status) {
			$msg = $result->msg;
		} else {
			$msg = $result->data->msg;
		}

		return $msg;
	}
}
*/


/*
function dqtheme_is_auth()
{
	$option   = get_option(md5(DQTHEME_THEME_KEY));
	$is_auth  = isset($option['data']['status']) ? true : false;
	return $is_auth;
}

function dqtheme_theme_check_license($data = [])
{
	$args = [
		'key'	 => DQTHEME_THEME_KEY,
		'env'	 => getenv(),
	];
	if (isset($data['delete'])) {
		$args['delete'] = 1;
	}
	$url          = WPKF_MARKET_API_DOMAIN . '/query/WPKF_Check_Auth?' . http_build_query($args);

	$request      = wp_remote_get($url);
	if (is_wp_error($request)) {
		return ['status' => '0', 'msg' => '请求失败'];
	}
	$response_code = wp_remote_retrieve_response_code($request);
	if ($response_code != '200') {
		return ['status' => '0', 'msg' => $request['response']['message']];
	}
	$result = json_decode($request['body'], true);
	if (isset($result['data'])) {
		$result['msg'] = $result['data']['msg'];
	}
	update_option(md5(DQTHEME_THEME_KEY), $result);
	return $result;
}

function dqtheme_theme_license_page()
{
	$option   = get_option(md5(DQTHEME_THEME_KEY));
	$is_auth  = isset($option['data']['status']) ? true : false;
	$auth_msg = $option ? (isset($option['data']['status']) ? $option['data']['msg'] : $option['msg']) : '';

	//$auth = dqtheme_is_auth();
	//$key  = md5(DQTHEME_THEME_KEY);
	//$card = get_option($key);

	//$data = get_transient($key);
	//print_r($option);

	echo "<div class=\"wrap\">";
	echo "<form method=\"post\">";
	echo "<table class=\"form-table\">";
	echo "<tr valign=\"top\">";
	echo "<th scope=\"row\">授权状态</th>";
	echo "<td><input class=\"regular-text\" type=\"text\" name=\"dqtheme_theme_license_key\" value=\"" . $auth_msg . "\" disabled />";
	if ($is_auth) {
		if (isset($_POST["delete"])) {
			$msg = dqtheme_theme_check_license($_POST);
			echo '<p style="color:red">' . $msg['msg'] . '</p>';
			//wp_redirect(admin_url("admin.php?page=theme-license"));
			//exit;
			//delete_option($key);
			//delete_transient($key);
			//$url = DQTHEME_THEME_API . '/WPKF_Check_Auth';
			//$arg = ['delete' => 1, 'key' => DQTHEME_THEME_KEY, 'domain' => $_SERVER['HTTP_HOST'], 'card' => $card];
			//wp_remote_get($url . '?' . http_build_query($arg));
		}
	} else {
		if (isset($_POST["submit"])) {
			$msg = dqtheme_theme_check_license($_POST);
			//print_r($msg);
			echo '<p style="color:red">' . $msg['msg'] . '</p>';
			//wp_redirect(admin_url("admin.php?page=theme-license"));
			//exit;
			//$post = trim($_POST["dqtheme_theme_license_key"]);
			//print_r($res);
			//update_option($key, $post);
			//delete_transient($key);
		}
	}
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "<p class=\"submit\">";
	if ($is_auth) {
		echo "<input type=\"submit\" name=\"delete\" id=\"submit\" class=\"components-button is-primary\" value=\"解除绑定\" />";
	} else {
		echo "<input type=\"submit\" name=\"submit\" id=\"submit\" class=\"components-button is-primary\" value=\"绑定授权\" />";
	}
	echo "</p>";
	echo "</form>";
	echo "</div>";
}
*/
/*
function delete_dqtheme_theme_update_transient()
{
	//delete_transient("dqtheme-theme-latest-version");
}
function dqtheme_theme_check_for_update($transient)
{
	if (dq("dq_theme_update")) {
		return;
	}
	$_var_13 = get_template();
	if (empty($transient->checked[$_var_13])) {
		return $transient;
	}
	$_var_14 = dqtheme_theme_fetch_data_of_latest_version();
	if (is_wp_error($_var_14) || wp_remote_retrieve_response_code($_var_14) != 200) {
		return $transient;
	} else {
		$_var_15 = wp_remote_retrieve_body($_var_14);
	}
	$_var_16 = json_decode($_var_15);
	if (version_compare($transient->checked[$_var_13], $_var_16->new_version, "<")) {
		$transient->response[$_var_13] = (array) $_var_16;
	}
	return $transient;
}
function dqtheme_theme_fetch_data_of_latest_version()
{
	$_var_17 = get_transient("dqtheme-theme-latest-version");
	if (false === $_var_17) {
		$_var_18 = get_option("license_key");
		$_var_17 = wp_safe_remote_get("https://www.dqtheme.com/?edd_action=get_version&item_id=" . DQTHEME_THEME_KEY . "&license=" . $_var_18["dqtheme_theme_license_key"] . "&url=" . home_url() . "");
		set_transient("dqtheme-theme-latest-version", $_var_17, DAY_IN_SECONDS);
	}
	return $_var_17;
}
*/
function dq_custom_post_page()
{
	/*
    if (!is_admin() and !dqtheme_is_auth()) {
        $msg = '<a href="' . admin_url('admin.php?page=wpkf_market') . '">【点击授权】</a>';
        wp_die($msg);
    }
	*/
	$_var_19 = array("name" => "页面搭建", "singular_name" => "页面搭建", "add_new" => "新建页面", "add_new_item" => "新建页面", "edit_item" => "编辑页面", "new_item" => "新页面", "all_items" => "所有页面", "view_item" => "查看页面", "search_items" => "搜索页面", "not_found" => "没有找到有页面", "not_found_in_trash" => "回收站里面没有相关页面", "parent_item_colon" => "", "menu_name" => "页面搭建");
	$_var_20 = array("labels" => $_var_19, "description" => "自定义页面搭建", "menu_icon" => "dashicons-art", "public" => true, "show_ui" => true, "menu_position" => 999, "supports" => array("title"), "has_archive" => true);
	register_post_type("dq-page", $_var_20);
}
function parse_request_remove_dq_page_slug($query_vars)
{
	if (is_admin()) {
		return $query_vars;
	}
	if (!get_option("permalink_structure")) {
		return $query_vars;
	}
	$_var_21 = "dq-page";
	if (isset($query_vars["pagename"])) {
		$_var_22 = $query_vars["pagename"];
	} else {
		if (isset($query_vars["name"])) {
			$_var_22 = $query_vars["name"];
		} else {
			global $wp;
			$_var_23 = $wp->request;
			if ($_var_23 && strpos($_var_23, "/") === false) {
				$_var_22 = $_var_23;
			} else {
				$_var_22 = false;
			}
		}
	}
	if ($_var_22) {
		$_var_24 = get_page_by_path($_var_22, "OBJECT", $_var_21);
		if (!is_admin() && $_var_24) {
			if (isset($query_vars["error"]) && $query_vars["error"] == 404) {
				unset($query_vars["error"]);
			}
			unset($query_vars["pagename"]);
			$query_vars["post_type"] = $_var_21;
			$query_vars["name"] = $_var_22;
			$query_vars[$_var_21] = $_var_22;
		}
	}
	return $query_vars;
}
