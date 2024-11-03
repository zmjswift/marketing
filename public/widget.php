<?php

/**
 * @Author: 大胡子
 * @Email:  dq@dqtheme.com
 * @Link:   www.dq.me
 * @Date:   2020-11-05 14:16:03
 * @Last Modified by:   dq
 * @Last Modified time: 2022-01-25 23:09:58
 */

/** --------------------------------------------------------------------------------- *
 *  激活小工具
 *  --------------------------------------------------------------------------------- */
if (function_exists('register_sidebar')) {

	//首页侧栏
	register_sidebar(array(
		'name'			=> '首页侧栏',
		'id'			=> 'widget_home',
		'before_widget'	=> '<div class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<div class="title-box"><h3>',
		'after_title'	=> '</h3></div>'
	));

	// 分类页面侧栏
	register_sidebar(array(
		'name'			=> '分类页面侧栏',
		'id'			=> 'widget_right',
		'before_widget'	=> '<div class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<div class="title-box"><h3>',
		'after_title'	=> '</h3></div>'
	));

	// 产品聚合页
	register_sidebar(array(
		'name'			=> '产品聚合页侧栏',
		'id'			=> 'widget_products',
		'before_widget'	=> '<div class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<div class="title-box"><h3>',
		'after_title'	=> '</h3></div>'
	));

	// 文章页侧栏
	register_sidebar(array(
		'name'			=> '文章页侧栏',
		'id'			=> 'widget_post',
		'before_widget'	=> '<div class="widget %2$s" id="%2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<div class="title-box"><h3>',
		'after_title' 	=> '</h3></div>'
	));

	// 页面侧栏
	register_sidebar(array(
		'name'          => '页面侧栏',
		'id'            => 'widget_page',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '<div class="title-box"><h3>',
		'after_title'	=> '</h3></div>'
	));

	// 其它页面
	register_sidebar(array(
		'name'			=> '其它页面，标签页面、搜索页面等',
		'id'			=> 'widget_other',
		'before_widget'	=> '<div class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<div class="title-box"><h3>',
		'after_title'	=> '</h3></div>'
	));

	// 页脚小工具
	register_sidebar(array(
		'name'			=> '页脚小工具',
		'id'			=> 'widget_footer',
		'before_widget'	=> '<div class="col-md-3 col-sm-12"><div class="footer-item %2$s">',
		'after_widget'	=> '</div></div>',
		'before_title'	=> '<div class="footer-title"><h4>',
		'after_title'	=> '</h4><div class="border-style-3"></div></div>'
	));
}

/** --------------------------------------------------------------------------------- *
 *  去除自带小工具
 *  --------------------------------------------------------------------------------- */
function unregister_widgets()
{
	unregister_widget("WP_Widget_Pages"); //页面
	unregister_widget("WP_Widget_Calendar"); //文章日程表
	unregister_widget("WP_Widget_Archives"); //文章归档
	unregister_widget("WP_Widget_Meta"); //登入/登出，管理，Feed 和 WordPress 链接
	unregister_widget("WP_Widget_Search"); //搜索
	//unregister_widget("WP_Widget_Categories"); //分类目录
	unregister_widget("WP_Widget_Recent_Posts"); //近期文章
	unregister_widget("WP_Widget_Recent_Comments"); //近期评论
	unregister_widget("WP_Widget_RSS"); //RSS订阅
	unregister_widget("WP_Widget_Links"); //链接
	//unregister_widget("WP_Widget_Text"); //文本
	unregister_widget("WP_Widget_Tag_Cloud"); //标签云
	unregister_widget("WP_Widget_Block"); //古腾堡块
	//unregister_widget("WP_Nav_Menu_Widget");//自定义菜单
	unregister_widget("WP_Widget_Media_Audio"); //音频
	//unregister_widget("WP_Widget_Media_Image");//图片
	unregister_widget("WP_Widget_Media_Video"); //视频
	unregister_widget("WP_Widget_Media_Gallery"); //画廊

	register_widget('dqtheme_postlist');
	register_widget('dqtheme_postlist_img');
	register_widget('dqtheme_postlist_related');
	register_widget('dqtheme_tag');
	register_widget('dqtheme_widget_search');
}
add_action("widgets_init", "unregister_widgets");

/** --------------------------------------------------------------------------------- *
 *  小工具显示分类ID
 *  --------------------------------------------------------------------------------- */
function show_category()
{
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
	$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
	$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
	$request .= " ORDER BY term_id asc";
	$categorys = $wpdb->get_results($request);
	echo '<div class="uk-panel uk-panel-box" style="margin-bottom: 20px;"><h3 style="margin-top: 0; margin-bottom: 15px; font-size: 18px; line-height: 24px; font-weight: 400; text-transform: none; color: #666;">可能会用到的分类ID</h3>';
	echo "<ul>";
	foreach ($categorys as $category) {
		echo  '<li style="margin-right: 10px;float:left;">' . $category->name . "（<code>" . $category->term_id . '</code>）</li>';
	}
	echo "</ul></div>";
}


/** --------------------------------------------------------------------------------- *
 *  页脚小工具
 *  --------------------------------------------------------------------------------- */

// 页脚小工具-1 后台设置
CSF::createWidget('widget_footer_1', array(
	'title'       => '【页脚小工具】关于我们',
	'classname'   => 'footer-widget-one',
	'description' => '可填写网站描述和上传网站Logo',
	'fields'      => array(

		array(
			'id'        => 'widget_footer1_logo',
			'type'      => 'media',
			'title'     => '网站Logo',
			'subtitle'  => '建议180px * 50px',
			'settings'  => array(
				'button_title' => '上传图片',
				'frame_title'  => '选择图片',
				'insert_title' => '插入图片',
			),
		),
		array(
			'id'		=> 'widget_footer1_describe',
			'type'		=> 'textarea',
			'title'		=> '网站描述',
		),
		array(
			'id'		=> 'social_sw',
			'type'		=> 'switcher',
			'title'		=> '社交工具',
			'default'	=> false
		),
		array(
			'id'			=> 'social_text',
			'type'		=> 'text',
			'title'		=> '标题',
			'dependency'	=> array('social_sw', '==', true)
		),

		array(
			'id'			=> 'social_facebook',
			'type'		=> 'text',
			'title'		=> 'Facebook',
			'dependency'	=> array('social_sw', '==', true)
		),
		array(
			'id'			=> 'social_twitter',
			'type'		=> 'text',
			'title'		=> 'Twitter',
			'dependency'	=> array('social_sw', '==', true)
		),
		array(
			'id'			=> 'social_pinterest',
			'type'		=> 'text',
			'title'		=> 'Pinterest',
			'dependency'	=> array('social_sw', '==', true)
		),
		array(
			'id'			=> 'social_youtube',
			'type'		=> 'text',
			'title'		=> 'YouTube',
			'dependency'	=> array('social_sw', '==', true)
		),
		array(
			'id'			=> 'social_instagram',
			'type'		=> 'text',
			'title'		=> 'Instagram',
			'dependency'	=> array('social_sw', '==', true)
		),


	)
));

// 页脚小工具-1 前端输出
if (!function_exists('widget_footer_1')) {
	function widget_footer_1($args, $instance)
	{

		echo $args['before_widget']; ?>

		<?php if ($instance['widget_footer1_logo']['url']) { ?>
			<img loading="lazy" class="footer-logo mb-25" src="<?php echo $instance['widget_footer1_logo']['url']; ?>" alt="<?php echo get_post_meta($instance['widget_footer1_logo']['id'], '_wp_attachment_image_alt', true); ?>">
		<?php } else { ?>
			<h2 class="footer-about-title"><?php echo get_bloginfo('name'); ?></h2>
		<?php } ?>
		<p><?php echo $instance['widget_footer1_describe']; ?></p>

		<?php if ($instance['social_sw']) { ?>
			<h6><?php echo $instance['social_text']; ?></h6>
			<div class="border-style-3"></div>
			<ul class="social-icon bg-transparent bordered-theme">

				<?php if ($instance['social_facebook']) { ?>
					<li>
						<a href="<?php echo $instance['social_facebook']; ?>" target="_blank" rel="nofollow"><i class="fa fa-facebook"></i></a>
					</li>
				<?php } ?>

				<?php if ($instance['social_twitter']) { ?>
					<li>
						<a href="<?php echo $instance['social_twitter']; ?>" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a>
					</li>
				<?php } ?>

				<?php if ($instance['social_pinterest']) { ?>
					<li>
						<a href="<?php echo $instance['social_pinterest']; ?>" target="_blank" rel="nofollow"><i class="fa fa-pinterest"></i></a>
					</li>
				<?php } ?>

				<?php if ($instance['social_youtube']) { ?>
					<li>
						<a href="<?php echo $instance['social_youtube']; ?>" target="_blank" rel="nofollow"><i class="fa fa-youtube"></i></a>
					</li>
				<?php } ?>

				<?php if ($instance['social_instagram']) { ?>
					<li>
						<a href="<?php echo $instance['social_instagram']; ?>" target="_blank" rel="nofollow"><i class="fa fa-instagram"></i></a>
					</li>
				<?php } ?>

			</ul>
		<?php } ?>

	<?php
		echo $args['after_widget'];
	}
}


// 页脚小工具-2 后台设置
CSF::createWidget('widget_footer_2', array(
	'title'       => '【页脚小工具】导航菜单',
	'classname'   => '',
	'description' => '添加页脚导航菜单',
	'fields'      => array(

		array(
			'id'		=> 'widget_footer2_title',
			'type'		=> 'text',
			'title'		=> '菜单标题',
			//'attributes'=> array('style'=> 'min-height: 28px;max-height: 28px;'),
		),
		array(
			'id'          => 'widget_footer2_menus',
			'type'        => 'select',
			'title'       => '选择菜单',
			'placeholder' => '选择菜单',
			'options'     => 'menus',
		),

	)
));

// 页脚小工具-2 前端输出
if (!function_exists('widget_footer_2')) {
	function widget_footer_2($args, $instance)
	{

		echo $args['before_widget']; ?>

		<div class="footer-title">
			<h4><?php echo $instance['widget_footer2_title']; ?></h4>
			<div class="border-style-3"></div>
		</div>
		<ul class="footer-list">
			<?php wp_nav_menu(array(
				'container'     => false,
				'items_wrap'    => '%3$s',
				'menu'			=> $instance['widget_footer2_menus']
			)); ?>
		</ul>

	<?php
		echo $args['after_widget'];
	}
}

// 页脚小工具-3 后台设置
CSF::createWidget('widget_footer_3', array(
	'title'       => '【页脚小工具】文章列表',
	'classname'   => '',
	'description' => '添加页脚导航菜单',
	'fields'      => array(

		array(
			'id'		=> 'widget_footer3_title',
			'type'		=> 'text',
			'title'		=> '标题',
			//'attributes'=> array('style'=> 'min-height: 28px;max-height: 28px;'),
		),
		array(
			'id'          => 'widget_footer3_cat',
			'type'        => 'select',
			'title'       => '选择分类',
			'placeholder' => '选择分类',
			'options'     => 'categories',
		),
		array(
			'id'		=> 'widget_footer3_img',
			'type'		=> 'switcher',
			'title'		=> '文章缩略图',
			'default'	=> false
		),
		array(
			'id'       	=> 'widget_footer3_number',
			'type'     	=> 'slider',
			'title'    	=> '显示文章数量',
			'unit'     	=> '篇',
			'min'      	=> 1,
			'max'      	=> 10,
			'step'     	=> 1,
			'default'  	=> 5,
		),

	)
));

// 页脚小工具-3 前端输出
if (!function_exists('widget_footer_3')) {
	function widget_footer_3($args, $instance)
	{ ?>

		<div class="col-md-3 col-sm-12">
			<div class="footer-item">
				<div class="footer-title">
					<h4><?php echo $instance['widget_footer3_title']; ?></h4>
					<div class="border-style-3"></div>
				</div>
				<ul class="footer-list">
					<?php
					$args = array(
						'post_status' => 'publish', // 只选公开的文章.
						'post__not_in' => array(get_the_ID()), //排除当前文章
						'ignore_sticky_posts' => 1, // 排除置頂文章.
						//'orderby' =>  $orderby, // 排序方式.
						'cat'     => $instance['widget_footer3_cat'],
						'order'   => 'DESC',
						'showposts' => $instance['widget_footer3_number'],
						'tax_query' => array(array(
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => array(
								//请根据需要保留要排除的文章形式
								//'post-format-aside',

							),
							'operator' => 'NOT IN',
						)),
					);
					//$query_posts = new WP_Query($args);
					$query_posts = Dq_Query($args);
					//$query_posts->query($args);
					while ($query_posts->have_posts()) {
						$query_posts->the_post(); ?>

						<?php if ($instance['widget_footer3_img']) { ?>
							<div class="blog-small-item">
								<img loading="lazy" src="<?php echo post_thumbnail(68, 68); ?>" alt="<?php echo post_thumbnail_alt(); ?>" />
								<div class="tex">
									<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								</div>
							</div>
						<?php } else { ?>
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</li>
						<?php } ?>

					<?php }
					wp_reset_query(); ?>
				</ul>
			</div>
		</div>
	<?php
	}
}

// 页脚小工具-4 后台设置
CSF::createWidget('widget_footer_4', array(
	'title'       => '【页脚小工具】二维码展示',
	'classname'   => '',
	'description' => '二维码图片展示，一般用于扫码添加微信',
	'fields'      => array(

		array(
			'id'		=> 'widget_footer4_title',
			'type'		=> 'text',
			'title'		=> '标题',
			//'attributes'=> array('style'=> 'min-height: 28px;max-height: 28px;'),
		),
		array(
			'id'        => 'widget_footer4_img',
			'type'      => 'media',
			'title'     => '上传图片',
			'subtitle'  => '建议150px * 50px',
			'settings'  => array(
				'button_title' => '上传图片',
				'frame_title'  => '选择图片',
				'insert_title' => '插入图片',
			),
		),

	)
));

// 页脚小工具-4 前端输出
if (!function_exists('widget_footer_4')) {
	function widget_footer_4($args, $instance)
	{

		echo $args['before_widget']; ?>

		<div class="footer-title">
			<h4><?php echo $instance['widget_footer4_title']; ?></h4>
			<div class="border-style-3"></div>
		</div>
		<ul class="footer-list">
			<img loading="lazy" src="<?php echo $instance['widget_footer4_img']['url']; ?>" alt="<?php echo get_post_meta($instance['widget_footer4_img']['id'], '_wp_attachment_image_alt', true); ?>">
		</ul>

	<?php
		echo $args['after_widget'];
	}
}
// 简码小工具 后台设置
CSF::createWidget('shortcode', array(
	'title'       => '简码小工具',
	'classname'   => '',
	'description' => '添加支持简码的小工具',
	'fields'      => array(

		array(
			'id'		=> 'widget_shortcode_title',
			'type'		=> 'text',
			'title'		=> '标题',
			//'attributes'=> array('style'=> 'min-height: 28px;max-height: 28px;'),
		),
		array(
			'id'          => 'widget_shortcode_textarea',
			'type'        => 'textarea',
			'title'       => '输入简码',
		),

	)
));


// 简码小工具  前端输出
if (!function_exists('shortcode')) {
	function shortcode($args, $instance)
	{

		echo $args['before_widget']; ?>

		<div class="footer-title">
			<h4><?php echo $instance['widget_shortcode_title']; ?></h4>
			<div class="border-style-3"></div>
		</div>
		<ul class="footer-list">
			<?php echo do_shortcode($instance['widget_shortcode_textarea']); ?>
		</ul>
		<style>
			@media only screen and (max-width: 767px) {
				.sidebar .col-lg-3.none-sidebar {
					display: block !important;
					/* 添加 !important 以提高优先级 */
				}
			}
		</style>

	<?php
		echo $args['after_widget'];
	}
}


/** --------------------------------------------------------------------------------- *
 *  标签云小工具-热门标签
 *  --------------------------------------------------------------------------------- */
function dqtheme_hot_tag_list($num = null, $hot = null)
{
	$num = $num ? $num : 14;

	$output = '<div class="tags-item">';
	$tags = get_tags(array(
		"number" => $num,
		"orderby" => "count",
		"order" => "DESC",
	));
	foreach ($tags as $tag) {
		$count = intval($tag->count);
		$name = $tag->name;
		$output .= '<a href="' . esc_attr(get_tag_link($tag->term_id)) . '" class="tag-item" title="#' . $name . '# 共有' . $tag->count . '篇文章">' . $name . ' <!--sup>（' . $tag->count . '）</sup--></a>';
	}
	$output .= '</div>';
	return $output;
}

class dqtheme_tag extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_tag_cloud', 'description' => '主题自带标签云小工具，显示热门标签，可自定义显示数量');
		parent::__construct('dqtheme_tag', '热门标签 ', $widget_ops);
	}

	function widget($args, $instance)
	{
		extract($args);
		echo $before_widget;
		$title = apply_filters('widget_name', $instance['title']);
		$count = $instance['count'];
		echo $before_title . $title . $after_title;
		echo dqtheme_hot_tag_list($count);
		echo $after_widget;
	}

	function form($instance)
	{
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title' => '热门标签',
				'count' => '15',
			)
		);
	?>

		<p>
			<label> 名称：
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label> 显示数量：
				<input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="number" value="<?php echo $instance['count']; ?>" class="widefat" />
			</label>
		</p>
	<?php
	}
}


/** --------------------------------------------------------------------------------- *
 *  文章展示小工具（小图）
 *  --------------------------------------------------------------------------------- */
class dqtheme_postlist_img extends WP_Widget
{

	public function __construct()
	{
		$widget_ops = array('description' => '可以选择显示最新文章、随机文章。');
		parent::__construct('dqtheme_postlist_img', __('文章展示（小图）'), $widget_ops);
	}

	function widget($args, $instance)
	{
		extract($args);
		$limit = $instance['limit'];
		$title = apply_filters('widget_name', $instance['title']);
		$cat          = $instance['cat'];
		$orderby      = $instance['orderby'];
		echo $before_widget;
		echo $before_title . $title . $after_title;
		echo dqtheme_widget_postlist_img($orderby, $limit, $cat);
		echo $after_widget;
	}

	function form($instance)
	{
		$instance['title'] = !empty($instance['title']) ? esc_attr($instance['title']) : '';
		$instance['orderby'] = !empty($instance['orderby']) ? esc_attr($instance['orderby']) : '';
		$instance['cat'] = !empty($instance['cat']) ? esc_attr($instance['cat']) : '';
		$instance['limit']    = isset($instance['limit']) ? absint($instance['limit']) : 5;
	?>
		<p style="clear: both;padding-top: 5px;">
			<label>显示标题：（例如：最新文章、随机文章）
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label> 排序方式：
				<select style="width:100%;" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" style="width:100%;">
					<option value="date" <?php selected('date', $instance['orderby']); ?>>发布时间</option>
					<option value="rand" <?php selected('rand', $instance['orderby']); ?>>随机文章</option>
				</select>
			</label>
		</p>
		<p>
			<label>
				分类限制：
				<p>只显示指定分类，填写数字，用英文逗号隔开，例如：1,2 </p>
				<p>排除指定分类的文章，填写负数，用英文逗号隔开，例如：-1,-2。</p>
				<input style="width:100%;" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo $instance['cat']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label> 显示数目：
				<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
			</label>
		</p>
		<p><?php show_category(); ?><br /><br /></p>
	<?php
	}
}

function dqtheme_widget_postlist_img($orderby, $limit, $cat)
{

	$args = array(
		'post_status'			=> 'publish', // 只选公开的文章.
		'post__not_in'			=> array(get_the_ID()), //排除当前文章
		'ignore_sticky_posts'	=> 1, // 排除置頂文章.
		'orderby'				=>  $orderby, // 排序方式.
		'cat'					=> $cat,
		'order'					=> 'DESC',
		'showposts'				=> $limit,
		'tax_query'				=> array(array(
			'taxonomy'				=> 'post_format',
			'field'					=> 'slug',
			'terms'					=> array(
				//请根据需要保留要排除的文章形式
				//'post-format-aside',
			),
			'operator' => 'NOT IN',
		)),
	);
	//$query_posts = new WP_Query($args);
	$query_posts = Dq_Query($args);
	//$query_posts->query($args);
	while ($query_posts->have_posts()) {
		$query_posts->the_post(); ?>

		<div class="blog-small-item">
			<a href="<?php the_permalink(); ?>">
				<img loading="lazy" src="<?php echo post_thumbnail(120, 120); ?>" alt="<?php echo post_thumbnail_alt(); ?>" />
			</a>
			<div class="tex">
				<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			</div>
		</div>

	<?php }
	wp_reset_query();
}

/** --------------------------------------------------------------------------------- *
 *  文章展示小工具（无图）
 *  --------------------------------------------------------------------------------- */
class dqtheme_postlist extends WP_Widget
{

	public function __construct()
	{
		$widget_ops = array('description' => '可以选择显示最新文章、随机文章。');
		parent::__construct('dqtheme_postlist', __('文章展示（无图）'), $widget_ops);
	}

	function widget($args, $instance)
	{
		extract($args);
		$limit = $instance['limit'];
		$title = apply_filters('widget_name', $instance['title']);
		$cat          = $instance['cat'];
		$orderby      = $instance['orderby'];
		echo $before_widget;
		echo $before_title . $title . $after_title;
		echo dqtheme_widget_postlist($orderby, $limit, $cat);
		echo $after_widget;
	}

	function form($instance)
	{
		$instance['title'] = !empty($instance['title']) ? esc_attr($instance['title']) : '';
		$instance['orderby'] = !empty($instance['orderby']) ? esc_attr($instance['orderby']) : '';
		$instance['cat'] = !empty($instance['cat']) ? esc_attr($instance['cat']) : '';
		$instance['limit']    = isset($instance['limit']) ? absint($instance['limit']) : 5;
	?>
		<p style="clear: both;padding-top: 5px;">
			<label>显示标题：（例如：最新文章、随机文章）
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label> 排序方式：
				<select style="width:100%;" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" style="width:100%;">
					<option value="date" <?php selected('date', $instance['orderby']); ?>>发布时间</option>
					<option value="rand" <?php selected('rand', $instance['orderby']); ?>>随机文章</option>
				</select>
			</label>
		</p>
		<p>
			<label>
				分类限制：
				<p>只显示指定分类，填写数字，用英文逗号隔开，例如：1,2 </p>
				<p>排除指定分类的文章，填写负数，用英文逗号隔开，例如：-1,-2。</p>
				<input style="width:100%;" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo $instance['cat']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label> 显示数目：
				<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
			</label>
		</p>
		<p><?php show_category(); ?><br /><br /></p>
	<?php
	}
}

function dqtheme_widget_postlist($orderby, $limit, $cat)
{

	$args = array(
		'post_status'			=> 'publish', // 只选公开的文章.
		'post__not_in'			=> array(get_the_ID()), //排除当前文章
		'ignore_sticky_posts'	=> 1, // 排除置頂文章.
		'orderby'				=>  $orderby, // 排序方式.
		'cat'					=> $cat,
		'order'					=> 'DESC',
		'showposts'				=> $limit,
		'tax_query'				=> array(array(
			'taxonomy'				=> 'post_format',
			'field'					=> 'slug',
			'terms'					=> array(
				//请根据需要保留要排除的文章形式
				//'post-format-aside',
			),
			'operator' => 'NOT IN',
		)),
	);
	//$query_posts = new WP_Query($args);
	$query_posts = Dq_Query($args);
	//$query_posts->query($args);
	while ($query_posts->have_posts()) {
		$query_posts->the_post(); ?>

		<div class="blog-small-item widget-post-title">
			<div class="tex">
				<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			</div>
		</div>

	<?php }
	wp_reset_query();
}


/** --------------------------------------------------------------------------------- *
 *  相关文章推荐小工具（小图）
 *  --------------------------------------------------------------------------------- */
class dqtheme_postlist_related extends WP_Widget
{

	public function __construct()
	{
		$widget_ops = array('description' => '相关文章推荐，仅在文章页面显示');
		parent::__construct('dqtheme_postlist_related', __('相关推荐（小图）'), $widget_ops);
	}

	function widget($args, $instance)
	{
		extract($args);
		$limit = $instance['limit'];
		$title = apply_filters('widget_name', $instance['title']);
		echo $before_widget;
		echo $before_title . $title . $after_title;
		echo dqtheme_widget_postlist_related($limit);
		echo $after_widget;
	}

	function form($instance)
	{
		$instance['title'] = !empty($instance['title']) ? esc_attr($instance['title']) : '';
		$instance['limit']    = isset($instance['limit']) ? absint($instance['limit']) : 5;
	?>
		<p style="clear: both;padding-top: 5px;">
			<label>显示标题：（例如：猜你喜欢、相关推荐）
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label> 显示数目：
				<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
			</label>
		</p>
		<!--p><?php //show_category();
				?><br/><br/></p-->
		<?php
	}
}

function dqtheme_widget_postlist_related($limit)
{

	if (is_single()) {
		global $post;
		$exclude_id = $post->ID;
		$posttags = get_the_tags();
		$i = 0;
		if ($posttags) {
			$tags = '';
			foreach ($posttags as $tag) $tags .= $tag->term_id . ',';
			$args = array(
				'post_status' => 'publish',
				'tag__in' => explode(',', $tags),
				'post__not_in' => explode(',', $exclude_id),
				'ignore_sticky_posts' => 1,
				'orderby' => 'comment_date',
				'showposts' => $limit
			);
			query_posts($args);
			while (have_posts()) {
				the_post(); ?>
				<div class="blog-small-item">
					<a href="<?php the_permalink(); ?>">
						<img loading="lazy" src="<?php echo post_thumbnail(120, 120); ?>" alt="<?php echo post_thumbnail_alt(); ?>" />
					</a>
					<div class="tex">
						<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					</div>
				</div>
			<?php
				$exclude_id .= ',' . $post->ID;
				$i++;
			}
			wp_reset_query();
		}
		if ($i < $limit) {
			$cats = '';
			foreach (get_the_category() as $cat) $cats .= $cat->cat_ID . ',';
			$args = array(
				'category__in' => explode(',', $cats),
				'post__not_in' => explode(',', $exclude_id),
				'ignore_sticky_posts' => 1,
				'orderby' => 'comment_date',
				'showposts' => $limit - $i
			);
			query_posts($args);
			while (have_posts()) {
				the_post(); ?>
				<div class="blog-small-item">
					<a href="<?php the_permalink(); ?>">
						<img loading="lazy" src="<?php echo post_thumbnail(120, 120); ?>" alt="<?php echo post_thumbnail_alt(); ?>" />
					</a>
					<div class="tex">
						<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					</div>
				</div>
		<?php
				$i++;
			}
			wp_reset_query();
		}
		if ($i  == 0)  echo '<li>暂无相关文章!</li>';
	} else {
		echo '「相关推荐」小工具，仅在文章页面有效！';
	}
}


/** --------------------------------------------------------------------------------- *
 *  搜索框小工具
 *  --------------------------------------------------------------------------------- */
function dqtheme_search($placeholder = null)
{

	$output = '<form class="search-box" role="search" method="get" action="' . esc_url(home_url('/')) . '">';
	$output .= '<div class="form-group">';
	$output .= '<input type="text" placeholder="' . $placeholder . '" name="s" class="form-control" />';
	$output .= '<button type="submit" class="fa fa-search form-control-feedback"></button>';
	$output .= '</div>';
	$output .= '</form>';

	return $output;
}

class dqtheme_widget_search extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_search', 'description' => '主题自带搜索小工具，可自定义搜索框默认显示文本');
		parent::__construct('dqtheme_widget_search', '站内搜索 ', $widget_ops);
	}

	function widget($args, $instance)
	{
		extract($args);
		echo $before_widget;
		$title = apply_filters('widget_name', $instance['title']);
		$placeholder = $instance['placeholder'];
		echo $before_title . $title . $after_title;
		echo dqtheme_search($placeholder);
		echo $after_widget;
	}

	function form($instance)
	{
		$instance = wp_parse_args((array) $instance, array(
			'title' => '站内搜索',
			'placeholder' => '输入关键词进行搜索...',
		));
		?>

		<p>
			<label> 标题：
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label> 搜索框默认显示文本：
				<input id="<?php echo $this->get_field_id('placeholder'); ?>" name="<?php echo $this->get_field_name('placeholder'); ?>" type="text" value="<?php echo $instance['placeholder']; ?>" class="widefat" />
			</label>
		</p>

<?php
	}
}
