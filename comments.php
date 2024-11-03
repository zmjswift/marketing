<?php if ( comments_open() && !post_password_required() ) {?>
<div class="mt-5"></div>
<?php if ( get_comments_number() ) {?>
<div class="mb-5">
  <?php comments_number('', '<h4 class="comments-title">文章评论 (1)</h4>', '<h4 class="comments-title">文章评论 (%)</h4>' );?>
  <div class="border-style-2"></div>
</div>
<?php }?>

<?php if(have_comments()){

wp_list_comments('type=comment&callback=dq_theme_list_comments');
the_comments_pagination(['prev_text'=>'上一页', 'next_text'=>'下一页']);

}?>

<div class="mt-5">
	<h4 class="comments-title">发表评论</h4>
	<div class="border-style-2"></div>
</div>

<?php

$comments_args = array(
	'comment_notes_before' => '<div class="form-row"><p class="comment-notes col-md-12 mb-3"><span id="email-notes">您的电子邮件地址不会被公开，</span>必填项已用 <span class="required">*</span> 标注。</p>',

	'title_reply'=> '',

	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="form-group col-md-6"><input type="text" name="author" id="author" class="form-control" placeholder="昵称" required="" /></div>',
		'email' => '<div class="form-group col-md-6"><input type="email" name="email" id="email" class="form-control" placeholder="Email" required="" /></div>'
	) ),

	'comment_field' => '<div class="form-group col-md-12"><div class="contact-textarea"><textarea class="form-control" rows="6" placeholder="请输入评论内容..." id="comment" name="comment" required=""></textarea></div></div>',

	'cancel_reply_link' => __( '取消回复' ),

	'logged_in_as' => '<div class="form-row"><p class="logged-in-as col-md-12 mb-3">' . sprintf( __( '当前登录账号为： <a href="%1$s">%2$s</a>，<a href="%3$s" title="Log out of this account">退出登录?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',

    'submit_button' => '<button class="btn btn-theme btn btn-theme mt-1 mb-3" type="submit">提交评论</button></div>',

);

comment_form($comments_args);

}




