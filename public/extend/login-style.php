<?php
function dq_login_style() {  

echo '<style type="text/css">
body{background:0 0;font-family:"Microsoft YaHei",sans-serif;min-height:100vh;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;width:100%;background-repeat:no-repeat;background-position:center center;background-size:cover;position:relative;z-index:1}
#login{width:350px;background:#fff;padding:40px 20px;border-radius:3px;box-shadow:0 1px 1px 0 rgba(0,0,0,.2)}
.login form{margin-top:20px;margin-left:0;padding:6px 24px 10px;-webkit-box-shadow:none;box-shadow:none;border:none}
.login form .forgetmenot{float:none}
.login #backtoblog{margin-bottom:0}
.login .button-primary{float:none;background-color:#494949;font-weight:700;color:#fff;width:100%;height:40px;border-width:0;border-color:none}
#login form p.login-actions{display:inline-block;width:100%;margin:15px 0 20px}
#login form p.submit{padding:20px 0 0}
#login form p.login-actions a{font-size:14px;display:inline-block;margin-right:10px;border-right:1px solid #8c8f94;padding-right:10px;line-height:1}
#login form p.login-actions a:nth-child(2){border-right:none}
.wp-core-ui .button-primary.focus,.wp-core-ui .button-primary.hover,.wp-core-ui .button-primary:focus,.wp-core-ui .button-primary:hover{background:#1f1f1f}
.wp-core-ui .button.button-large{height:40px;line-height:38px;font-size:16px;box-shadow:none;text-shadow:none}
input{outline:0!important}
@media (max-width:991px){
  #login{margin:15px !important}
  #login form p.login-actions a{margin-right:10px;padding-right:10px;font-size:12px}
}
</style>';

if( dq_img('login_logo') ){
	echo '<style type="text/css">
.login h1 a {background-image: url('.dq_img('login_logo').'); }
</style>';
}else{
	echo '<style type="text/css">
.login h1 a {display:none}
</style>';
}

if( dq_img('login_bgimg') ){
	echo '<style type="text/css">
body{background-image:url('.dq_img('login_bgimg').');}
</style>';
}else{
	echo '<style type="text/css">
body{background:#31629f}
</style>';
}

$login_logo_form = dq('login_logo_form') ?: 'middle';
if( $login_logo_form == 'left' ){
	echo '<style type="text/css">
#login{margin-left:10%;}
</style>';
}elseif( $login_logo_form == 'right' ){
	echo '<style type="text/css">
#login{margin-right:10%;}
</style>';
}

}  
add_action('login_head', 'dq_login_style');

//自定义登录页面的LOGO链接为首页链接
function dq_custom_login_url( $url ) {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'dq_custom_login_url', 10, 1 );

//自定义登录页面的LOGO提示为网站名称
function dq_custom_login_login_name( $url ) {
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'dq_custom_login_login_name', 10, 1 );


