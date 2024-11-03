<?php

//SMTP邮箱设置
if ( dq('smtp_switcher') ) {
    function dq_mail_smtp($phpmailer) {
        $phpmailer->From = dq('dq_email'); //发件人地址
        $phpmailer->FromName = dq('dq_mailname'); //发件人昵称
        $phpmailer->Host = dq('dq_mailsmtp'); //SMTP服务器地址
        $phpmailer->Port = dq('dq_mailport'); //SMTP邮件发送端口
        if (dq('dq_smtpssl')) {
            $phpmailer->SMTPSecure = 'ssl';
        } else {
            $phpmailer->SMTPSecure = '';
        } //SMTP加密方式(SSL/TLS)没有为空即可
        $phpmailer->Username = dq('dq_mailuser'); //邮箱帐号
        $phpmailer->Password = dq('dq_mailpass'); //邮箱密码
        $phpmailer->IsSMTP();
        $phpmailer->SMTPAuth = true; //启用SMTPAuth服务

    }
    add_action('phpmailer_init', 'dq_mail_smtp');
}

//CDN加速储存
if ( !is_admin() && dq('cdn_type') != '0' ) {
    add_action('wp_loaded', 'dqtheme_ob_start');
    function dqtheme_ob_start() {
        ob_start('dqtheme_cdn_replace');
    }
    function dqtheme_cdn_replace($html) {
        $local_host = home_url(); //博客域名
        $cdn_host = dq('cdn_url'); //CDN域名
        $cdn_exts = dq('cdn_file_format'); //扩展名（使用|分隔）
        $cdn_dirs = dq('cdn_mirror_folder'); //目录（使用|分隔）
        $cdn_dirs = str_replace('-', '\-', $cdn_dirs);
        if ($cdn_dirs) {
            $regex = '/' . str_replace('/', '\/', $local_host) . '\/((' . $cdn_dirs . ')\/[^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
            $html = preg_replace($regex, $cdn_host . '/$1$4', $html);
        } else {
            $regex = '/' . str_replace('/', '\/', $local_host) . '\/([^\s\?\\\'\"\;\>\<]{1,}.(' . $cdn_exts . '))([\"\\\'\s\?]{1})/';
            $html = preg_replace($regex, $cdn_host . '/$1$3', $html);
        }
        return $html;
    }
}
//自动替换媒体库图片的域名
if ( is_admin() && dq('cdn_type') != '0' ) {
    function dqtheme_attachment_replace($text) {
        $replace = array(
            home_url() => dq('cdn_url') ?: home_url()
        );
        $text = str_replace(array_keys($replace) , $replace, $text);
        return $text;
    }
    add_filter('wp_get_attachment_url', 'dqtheme_attachment_replace');
}

//自定义用户头像
if( dq('dqtheme_custom_avatar') ) :
    include_once TEMPLATEPATH.'/public/extend/custom-avatar.php';
endif;

//链接转换
if( dq('dqtheme_simple_urls') ) :
    include_once TEMPLATEPATH.'/public/extend/simple-urls/simple-urls.php';
endif;

//站点地图
if( dq('dqtheme_sitemap') ) :
    include_once TEMPLATEPATH.'/public/extend/Sitemap/sitemap.php';
endif;

//数据库清理
if( dq('dqtheme_wp-clean-up') ) :
    include_once TEMPLATEPATH.'/public/extend/wp-clean-up/wp-clean-up.php';
endif;

//登录界面美化
if( dq('login_style') ) :
    include_once TEMPLATEPATH.'/public/extend/login-style.php';
endif;

//自动保存文章中的外链图片
if( dq('save_remote_pic') ) :
    include_once TEMPLATEPATH.'/public/extend/save_remote_pic.php';
endif;

//自定义文章排序
//if( dq('dq_custom_sort') ) :
//	include_once TEMPLATEPATH.'/public/core/dq_post_sort/custom_sort.php';
//endif;