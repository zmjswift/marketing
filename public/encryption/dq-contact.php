<?php
add_action("init", "app_output_buffer");
add_action("after_switch_theme", "dq_load_theme");
add_action("admin_menu", "contact_menu");
add_action("wp_ajax_dq_contact_ajax", "dq_contact_ajax");
add_action("wp_ajax_nopriv_dq_contact_ajax", "dq_contact_ajax");
function app_output_buffer()
{
	ob_start();
}
function install()
{
	global $wpdb;
	$_var_0 = $wpdb->prefix . "dq_contact";
	$_var_1 = "CREATE TABLE IF NOT EXISTS `" . $_var_0 . "` (\n        `id` int(8) NOT NULL AUTO_INCREMENT,\n        `name` char(255) NOT NULL,\n        `mail` char(255) NOT NULL,\n        `phone` char(255) NOT NULL,\n        `message` char(255) NOT NULL,\n        `source` char(255) NOT NULL,\n\t\t`status` int(1) NOT NULL,\n \n        `date` date NOT NULL,\n        UNIQUE KEY `id` (`id`)\n    ) ENGINE=MyISAM DEFAULT CHARACTER SET UTF8 COLLATE utf8_general_ci";
	if ($wpdb->get_var("show tables like " . $_var_0) != $_var_0) {
		$wpdb->query($_var_1);
	}
}
function dq_load_theme()
{
	install();
}
function contact_menu()
{
	global $wpdb;
	$_var_2 = $wpdb->prefix . "dq_contact";
	$_var_3 = $wpdb->get_var("SELECT count(*) FROM " . $_var_2 . " WHERE status = 1");
	if ($_var_3 > 0) {
		add_menu_page(__("在线留言"), __("在线留言<span class=\"awaiting-mod\"><span class=\"pending-count\">" . $wpdb->get_var("SELECT count(*) FROM " . $_var_2 . " WHERE status = 1") . "</span></span>"), "manage_options", "contact.php", "", "dashicons-testimonial", 100);
	} else {
		add_menu_page(__("在线留言"), __("在线留言"), "manage_options", "contact.php", "", "dashicons-testimonial", 100);
	}
	add_submenu_page("contact.php", "在线留言", "在线留言", "manage_options", "contact.php", "contact_function");
}
function contact_function()
{
	?><style>
    .user .info { margin-top: 20px; }
    .user .info table{border-collapse: collapse;  border: none; width: 100%; }
    .user .info td,.user .info th{ border: solid #CCC 1px; text-align: center; height: 30px; padding: 5px 0px; }
    .bg { background: #FFF; }
</style>
<div class="wrap user">
    <h2>在线留言记录</h2>
    <?php 
	$_var_4 = isset($_GET["message"]) ? $_GET["message"] : 0;
	if ($_var_4 == 1) {
		?><div id="message" class="updated fade"><p>状态变更成功！</p></div><?php 
	} elseif ($_var_4 == 2) {
		?><div id="message" class="updated fade"><p>留言删除成功！</p></div><?php 
	}
	?>    <div class="info">
        <table>
            <thead>
                <tr>
                    <th><span class="dashicons dashicons-editor-ul"></span></th>
                    <th>姓名/昵称</th>
                    <th>联系邮箱</th>
                    <th>联系电话</th>
                    <th>留言内容</th>
					<th>留言日期</th>
					<th>来源页面</th>
					<th>当前状态</th>
                    <th>相关操作</th>
                </tr>
            </thead>
            <?php 
	global $wpdb;
	$_var_5 = $wpdb->prefix . "dq_contact";
	$_var_6 = $wpdb->get_var("SELECT count(*) FROM " . $_var_5);
	$_var_7 = $_var_6 / 14;
	$_var_8 = isset($_GET["paged"]) ? $_GET["paged"] : 1;
	$_var_9 = ($_var_8 - 1) * 14;
	$_var_10 = $_var_8 - 1 < 1 ? $_var_8 : $_var_8 - 1;
	$_var_11 = $_var_8 + 1 > ceil($_var_7) ? ceil($_var_8) : $_var_8 + 1;
	$_var_5 = $wpdb->get_results("SELECT * FROM " . $_var_5 . " ORDER BY id DESC LIMIT " . $_var_9 . ",14");
	?>            <tbody>
                <?php 
	$_var_12 = "bg";
	$_var_13 = 1;
	echo "                ";
	foreach ($_var_5 as $_var_14) {
		?>                <tr class="<?php echo $_var_12;?>">
                    <td><?php echo $_var_13;?></td>
                    <td><?php echo $_var_14->name;?></td>
                    <td><?php echo $_var_14->mail ?: "用户未填写";?></td>
                    <td><?php echo $_var_14->phone;?></td>
                    <td style="width:20%;padding:7px 15px"><?php echo $_var_14->message;?></td>
                    <td><?php echo $_var_14->date;?></td>
                    <td style="width:15%;padding:0 10px"><?php echo $_var_14->source;?></td>
                    <?php 
		if ($_var_14->status == 1) {
			?><td style='color:#F44336'>未处理</td><?php 
		} elseif ($_var_14->status == 2) {
			?><td style='color:#009688'>处理中</td><?php 
		} elseif ($_var_14->status == 3) {
			?><td style='color:#444'>已处理</td><?php 
		}
		?>                    <td>
                        <a href="<?php 
		bloginfo("url");
		?>/wp-admin/admin.php?page=contact.php&id=<?php echo $_var_14->id;?>&action=status#status_change">状态变更</a>&nbsp;
                        <a class='del' href="<?php 
		bloginfo("url");
		?>/wp-admin/admin.php?page=contact.php&id=<?php echo $_var_14->id;?>&action=del">删除</a>
                    </td>
                </tr>

                <?php 
		$_var_13++;
		$_var_12 = empty($_var_12) ? "bg" : "";
	}
	?>            </tbody>
        </table>
        <script>
            jQuery(function(){

                jQuery('.del').click(function(event) {
                    event.preventDefault();
                    if(window.confirm('你确定要删除这条记录吗？')){
                        var url = jQuery(this).attr('href');
                        window.location.href=url;
                         return true;
                      }else{
                         return false;
                     }
                });

            });
        </script>
        <?php 
	if ($_var_6 > 14) {
		?>        <div class="tablenav bottom">

			<div class="tablenav-pages">
				<span class="displaying-num"><?php echo $_var_6;?>条留言</span>

				<?php 
		if ($_var_8 == 1) {
			?>				<span class="tablenav-pages-navspan button disabled" aria-hidden="true">«</span>
				<span class="tablenav-pages-navspan button disabled" aria-hidden="true">‹</span>
				<?php 
		} else {
			?>				<a class="first-page button" href="<?php 
			bloginfo("url");
			?>/wp-admin/admin.php?page=contact.php"><span class="screen-reader-text">首页</span><span aria-hidden="true">«</span></a>
				<a class="prev-page button" href="<?php 
			bloginfo("url");
			?>/wp-admin/admin.php?page=contact.php&paged=<?php echo $_var_10;?>"><span class="screen-reader-text">上一页</span><span aria-hidden="true">‹</span></a>
				<?php 
		}
		?>				<span class="screen-reader-text">当前页</span><span id="table-paging" class="paging-input"><span class="tablenav-paging-text">第<?php echo $_var_8;?>页，共<span class="total-pages"><?php echo ceil($_var_7);?></span>页</span></span>
				<?php 
		if ($_var_8 != ceil($_var_7)) {
			?>				<a class="next-page button" href="<?php 
			bloginfo("url");
			?>/wp-admin/admin.php?page=contact.php&paged=<?php echo $_var_11;?>"><span class="screen-reader-text">下一页</span><span aria-hidden="true">›</span></a>
				<a class="last-page button" href="<?php 
			bloginfo("url");
			?>/wp-admin/admin.php?page=contact.php&paged=<?php echo ceil($_var_7);?>"><span class="screen-reader-text">尾页</span><span aria-hidden="true">»</span></a></span>
				<?php 
		} else {
			?>				<span class="tablenav-pages-navspan button disabled" aria-hidden="true">›</span>
				<span class="tablenav-pages-navspan button disabled" aria-hidden="true">»</span>
				<?php 
		}
		?>			</div>

        </div>
        <?php 
	}
	?>    </div>
    <?php 
	if (isset($_GET["action"])) {
		if ($_GET["action"] == "status") {
			echo "    ";
			global $wpdb;
			$_var_15 = $_GET["id"] ?: "";
			$_var_16 = $wpdb->prefix . "dq_contact";
			$_var_5 = $wpdb->get_row("SELECT * FROM " . $_var_16 . " WHERE id=" . $_var_15);
			if ($_POST["publish"] == "提交") {
				$_var_17 = array("id" => $_var_5->id, "name" => $_var_5->name, "mail" => $_var_5->mail, "phone" => $_var_5->phone, "message" => $_var_5->message, "status" => $_POST["status"], "date" => $_var_5->date, "source" => $_var_5->source);
				$wpdb->update($_var_16, $_var_17, array("id" => $_GET["id"]));
				wp_redirect("admin.php?page=contact.php&message=1");
			}
			?>    <div style="position:fixed;height:100%;width:100%;top:0;left:0;background:#1e1e1ed9;z-index:999999;-webkit-animation:fade-zoom-in .3s forwards;-o-animation:fade-zoom-in .3s forwards;animation:fade-zoom-in .3s forwards">
    <div style="max-width:460px;padding:25px 45px;margin:auto;position:absolute;width:100%;left:0;right:0;height:200px;top:0;bottom:0;background:#fff;border-radius:5px">
    <h2 id="status_change">留言状态变更</h2>
    <form action="" method="POST">
        <table class="form-table" style="margin-bottom:25px">
            <tr>
                <th><label><?php echo $_var_5->name;?> 的留言记录</label></th>
                <td>
                    <label style="margin-right:10px"><input name="status" type="radio" <?php 
			if ($_var_5->status == 1) {
				print "checked=\"checked\"";
			} else {
				print "";
			}
			?> value="1" />未处理</label>
                    <label style="margin-right:10px"><input name="status" type="radio" <?php 
			if ($_var_5->status == 2) {
				print "checked=\"checked\"";
			} else {
				print "";
			}
			?> value="2" />处理中</label>
                    <label style="margin-right:10px"><input name="status" type="radio" <?php 
			if ($_var_5->status == 3) {
				print "checked=\"checked\"";
			} else {
				print "";
			}
			?> value="3" />已处理</label>
                </td>
            </tr>
            
        </table>
        <input style="margin-right:10px" type="submit" name="publish" id="publish" class="button button-primary button-large" value="提交" accesskey="p">
    <a class='button button-large' href="<?php 
			bloginfo("url");
			?>/wp-admin/admin.php?page=contact.php">返回</a>
    </form>
    </div>
    </div>
    <?php 
		}
	}
	echo "    ";
	if (isset($_GET["action"])) {
		if ($_GET["action"] == "del") {
			global $wpdb;
			$_var_15 = $_GET["id"];
			$_var_16 = $wpdb->prefix . "dq_contact";
			$wpdb->query("DELETE FROM " . $_var_16 . " WHERE id=" . $_var_15);
			wp_redirect("admin.php?page=contact.php&message=2");
		}
	}
	?></div>

<?php 
}
function dq_contact_ajax()
{
	if ($_POST["name"] == "") {
		$_var_18 = 1;
	}
	if ($_POST["phone"] == "") {
		$_var_18 = 1;
	}
	if ($_POST["message"] == "") {
		$_var_18 = 1;
	}
	$_var_19 = $_POST["phone"];
	$_var_20 = "/[一-龥]/u";
	if (!preg_match("/^1[3456789]{1}\\d{9}\$/", $_var_19)) {
		$_var_21 = json_encode(array("state" => 201, "tips" => "提交失败，手机号码有误，请输入正确的手机号码！"));
	} else {
		if (!preg_match($_var_20, $_POST["message"])) {
			$_var_21 = json_encode(array("state" => 201, "tips" => "提交失败，您的留言内容中必须包含汉字！"));
		} else {
			if (!$_var_18) {
				global $wpdb;
				$_var_22 = array("id" => "", "name" => htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8"), "mail" => htmlspecialchars($_POST["mail"], ENT_QUOTES, "UTF-8"), "phone" => htmlspecialchars($_POST["phone"], ENT_QUOTES, "UTF-8"), "message" => htmlspecialchars($_POST["message"], ENT_QUOTES, "UTF-8"), "source" => htmlspecialchars($_POST["current_url"], ENT_QUOTES, "UTF-8"), "status" => "1", "date" => date("Y-m-d", time()));
				$_var_23 = $wpdb->prefix . "dq_contact";
				$_var_24 = $wpdb->insert($_var_23, $_var_22);
				$_var_25 = get_option("admin_email");
				$_var_26 = get_option("date_format");
				$_var_27 = get_option("time_format");
				$_var_28 = "您好，有一条【在线留言】信息需要您处理，详细信息如下：\n\n        姓名/昵称：" . htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8") . "\n            \n        联系邮箱：" . htmlspecialchars($_POST["mail"], ENT_QUOTES, "UTF-8") . "\n            \n        联系电话：" . htmlspecialchars($_POST["phone"], ENT_QUOTES, "UTF-8") . "\n            \n        留言内容：" . htmlspecialchars($_POST["message"], ENT_QUOTES, "UTF-8") . "\n            \n        提交时间：" . date($_var_26 . " " . $_var_27, current_time("timestamp"));
				$_var_29 = "您收到一条新的【在线留言】，请及时跟进客户";
				if ($_var_24) {
					wp_mail($_var_25, $_var_29, $_var_28);//$_var_30
					$_var_21 = json_encode(array("state" => 200, "tips" => "提交成功，请耐心等待，我们将尽快与您联系！"));
				} else {
					$_var_21 = json_encode(array("state" => 201, "tips" => "提交失败，未知错误，请联系站点管理员！"));
				}
			} else {
				$_var_21 = json_encode(array("state" => 201, "tips" => "提交失败，请完成表单内所有内容，谢谢！"));
			}
		}
	}
	echo $_var_21;
	die;
}