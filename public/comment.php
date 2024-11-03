<?php
//评论框信息上调
function recover_comment_fields($comment_fields){
    $comment = array_shift($comment_fields);
    $comment_fields =  array_merge($comment_fields ,array('comment' => $comment));
    return $comment_fields;
}
add_filter('comment_form_fields','recover_comment_fields');

//移除评论 Cookie 确认复选框
add_filter('comment_form_field_cookies','__return_false');

//默认记录评论 Cookie
add_action('set_comment_cookies','dq_set_cookies',10,3);
function dq_set_cookies( $comment, $user, $cookies_consent){
	$cookies_consent = true;
	wp_set_comment_cookies($comment, $user, $cookies_consent);
}

//评论列表
function dq_theme_list_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount,$wpdb, $post;
	if(!$commentcount) { 
		$comments = get_comments(['post_id'=>$post->ID]);
		$cnt = count($comments);
		$page = get_query_var('cpage');
		$cpp = get_option('comments_per_page');
		if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page == ceil($cnt / $cpp))) {
			$commentcount = $cnt + 1;
		} else {
			$commentcount = $cpp * $page + 1;
		}
	}
?>
<div id="comment-<?php comment_ID() ?>" <?php comment_class('row blog-comments mb-4'); ?>>
	<?php if( get_option('show_avatars') ){?>
	<div class="col-sm-2">
	<?php echo get_avatar($comment,180); ?>
	</div>
	<?php }?>
	<div class="col-sm-1<?php if( get_option('show_avatars') ){ echo '0'; }else{ echo '2'; }?>">
	    <div class="comment">
			<h5>
	        	<?php comment_author_link();?>
	        	<span><?php comment_date() ?> <?php comment_time() ?> / <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => "回复"))) ?></span>
			</h5>
			<?php comment_text() ?>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<p style="color:#C00;">您的评论正在等待审核中...</p>
			<?php endif; ?>
	    </div>
	</div>
</div>
<?php }
