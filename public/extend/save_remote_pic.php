<?php
add_action("save_post", "dq_save_remote_pic");
function dq_save_remote_pic()
{
	global $post;
	$_var_0 = !empty($post) ? $post->ID : null;
	if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
		return;
	}
	if (!current_user_can("edit_post", $_var_0)) {
		return;
	}
	$post = get_post($_var_0);
	$_var_1 = "";
	if (preg_match_all("/<img.+src=['\"]([^'\"]+)['\"].*>/i", $post->post_content, $_var_2)) {
		$_var_1 = $_var_2[1];
		foreach ($_var_1 as $_var_3) {
			if (strpos($_var_3, $_SERVER["HTTP_HOST"]) === false) {
				remove_action("save_post", "dq_save_remote_pic");
				$_var_4 = wp_remote_get($_var_3);
				$_var_5 = wp_remote_retrieve_header($_var_4, "content-type");
				$_var_6 = wp_upload_bits(rawurldecode(basename($_var_3)), "", wp_remote_retrieve_body($_var_4));
				$_var_7 = array("post_title" => basename($_var_3), "post_mime_type" => $_var_5);
				$_var_8 = wp_insert_attachment($_var_7, $_var_6["file"], $_var_0);
				$_var_9 = wp_generate_attachment_metadata($_var_8, $_var_3);
				wp_update_attachment_metadata($_var_8, $_var_9);
				$_var_10 = str_replace($_var_3, $_var_6["url"], $post->post_content);
				wp_update_post(array("ID" => $_var_0, "post_content" => $_var_10));
				add_action("save_post", "dq_save_remote_pic");
			}
		}
	}
}