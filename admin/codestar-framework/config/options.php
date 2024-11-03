<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.

//
// Set a unique slug-like ID
//
$prefix = 'dqtheme_optimize';

//
// Create options
//
CSF::createOptions( $prefix, array(
  'menu_title' => '网站设置',
  'menu_slug'  => 'dqtheme-optimize',
  'menu_icon'  => 'dashicons-wordpress',
  'menu_type'  => 'submenu',
  'menu_parent'=> 'dqtheme-page'
) );

/** --------------------------------------------------------------------------------- *
 *  产品专题
 *  --------------------------------------------------------------------------------- */
CSF::createSection( $prefix, array(
    'title'  => '产品专题',
    'fields' => array(
	
		array(
            'id'       => 'page_products_exclude_cats',
            'type'     => 'select',
            'title'    => '产品聚合页排除分类',
            'chosen'      => true,
            'multiple'    => true,
            'options'     => 'categories',
            'placeholder' => '请下拉选择',
            'desc'        => '',
        ),
		
      array(
          'id'        => 'special',
          'type'      => 'switcher',
          'title'     => '产品专题',
          'default'   => false,
          'desc'      => '开启后到「后台-设置-固定链接」中重新保存一下设置。',
      ),
      array(
          'id'        => 'special_title',
          'type'      => 'text',
          'title'     => '页面标题',
          'desc'      => '显示在归档页面，链接地址: '.home_url('/special'),
          'dependency'=> array( 'special', '==', true ),
      ),

      array(
          'id'    => 'special_seo_title',
          'type'  => 'text',
          'title' => 'SEO-标题',
          //'after' => '<div class="cs-text-muted">留空则调用页面标题</div>'
      ),
      array(
          'id'    => 'special_seo_keywords',
          'type'  => 'text',
          'title' => 'SEO-关键词',
          'after' => '<div class="cs-text-muted">多个关键词之间用英文逗号隔开</div>'
      ),
      array(
          'id'    => 'special_seo_description',
          'type'  => 'textarea',
          'title' => 'SEO-描述',
          //'after' => '<div class="cs-text-muted">留空则调用文章摘要</div>'
      ),

  )
) );

/** --------------------------------------------------------------------------------- *
 *  文章页面 TAB菜单
 *  --------------------------------------------------------------------------------- */
CSF::createSection( $prefix, array(
  'id'    => 'single-tab',
  'title' => '文章页-TAB菜单',
) );

CSF::createSection( $prefix, array(
  'parent' => 'single-tab',
  'title'  => 'TAB-1',
  'fields' => array(

    array(
      'id'    => 'tab-title-1',
      'type'  => 'text',
      'title' => 'TAB1-标题',
    ),
    array(
      'id'    => 'tab-content-1',
      'type'  => 'wp_editor',
      'title' => 'TAB1-详细内容',
    ),

  )
) );
CSF::createSection( $prefix, array(
  'parent' => 'single-tab',
  'title'  => 'TAB-2',
  'fields' => array(

    array(
      'id'    => 'tab-title-2',
      'type'  => 'text',
      'title' => 'TAB2-标题',
    ),
    array(
      'id'    => 'tab-content-2',
      'type'  => 'wp_editor',
      'title' => 'TAB2-详细内容',
    ),

  )
) );
CSF::createSection( $prefix, array(
  'parent' => 'single-tab',
  'title'  => 'TAB-3',
  'fields' => array(

    array(
      'id'    => 'tab-title-3',
      'type'  => 'text',
      'title' => 'TAB3-标题',
    ),
    array(
      'id'    => 'tab-content-3',
      'type'  => 'wp_editor',
      'title' => 'TAB3-详细内容',
    ),

  )
) );

/** --------------------------------------------------------------------------------- *
 *  页脚栏目设置
 *  --------------------------------------------------------------------------------- */
CSF::createSection( $prefix, array(
    'title'  => '页脚栏目设置',
    'fields' => array(
      array(
        'id'        => 'footer_8_modular_title',
        'type'      => 'textarea',
        'title'     => '模块标题',
        'default'   => '模块标题',
    ),
    array(
        'id'        => 'footer_8_modular_describe',
        'type'      => 'textarea',
        'title'     => '模块描述',
        'default'   => '无需编码技能，您也可以创建出一个独特的网站（DQTheme）',
    ),
      array(
        'id'                => 'footer_8',
        'type'              => 'group',
        'title'             => '',
        'button_title'      => '添加联系信息',
        'accordion_title'   => '添加联系信息',
        'fields'            => array(
            array(
                'id'        => 'footer_8_title',
                'type'      => 'text',
                'title'     => '联系内容...',
            ),
    array(
        'id'         => 'footer_8_icons',
        'type'       => 'icon',
        'title'      => '选择图标',
    ),
array(
        'id'      => 'footer_8_icon_size',
        'type'    => 'number',
        'unit'        => 'rem',
        'title'   => '图标大小',
),
array(
        'id'      => 'footer_8_icon_color',
        'type'    => 'color',
        'title'   => '图标颜色',
    ),
    array(
        'id'        => 'footer_8_icon',
        'type'      => 'media',
        'title'     => '联系图标',
    ),
),
    ),
    //自定义表单文本
    array(
        'id'                => 'footer_cf7_shortcode',
        'type'              => 'textarea',
        'title'             => '请输入CF7留言表单短代码...',
    ),
                
        array(
            'id'                => 'footer_features',
            'type'              => 'group',
            'title'             => '',
            'button_title'      => '添加页脚项目',
            'accordion_title'   => '添加页脚项目',
            'fields'            => array(
                array(
                'id'         => 'features_title',
                  'type'       => 'text',
                'title'      => '项目标题',
                  //'attributes' => array('style'=> 'width:100%'),
                ),
                array(
                    'id'         => 'features_desc',
                    'type'       => 'text',
                    'title'      => '项目描述',
                    //'attributes' => array('style'=> 'width:100%'),
                ),
                array(
                    'id'         => 'features_icon',
                    'type'       => 'icon',
                    'title'      => '选择图标',
                ),
				array(
				'id'      => 'icon_size',
				'type'    => 'number',
				'unit'        => 'rem',
				'output'      => '.heading',
				'output_mode' => 'width',
				'title'   => '图标大小',
				),
				array(
				'id'      => 'icon_color',
				'type'    => 'color',
				'title'   => '图标颜色',
				),
                array(
                    'id'        => 'features_img',
                    'type'      => 'media',
                    'title'     => '项目图标',
                    'desc'      => '自定义图标图片，建议尺寸：100×100 px',
                    'settings'  => array(
                        'button_title' => '上传图标',
                        'frame_title'  => '选择图标',
                        'insert_title' => '插入图标',
                    ),
                ),
            ),
        ),
  )
) );

/** --------------------------------------------------------------------------------- *
 *  其他设置
 *  --------------------------------------------------------------------------------- */
CSF::createSection( $prefix, array(
  'title'  => '其他设置',
  'fields' => array(

    array(
      'type'      => 'subheading',
      'content'   => '请务必要上传默认缩略图！！！文章缩略图的显示顺序是：文章特色图片》文章内第一张图片》默认缩略图。',
    ),

    array(
      'id'        => 'default_timthumb',
      'type'      => 'media',
      'title'     => '文章默认缩略图',
      'add_title' => '上传图片',
    ),

    array(
      'id'        => 'dq_thumbnail_link',
      'type'      => 'switcher',
      'title'     => '禁用 Timthumb',
      'desc'      => '输出图片直链，不使用「timthumb.php」剪裁图片',
      'default'   => false,
    ),

    array(
      'id'        => 'remove_admin_dq_contact',
      'type'      => 'switcher',
      'title'     => '禁用 在线留言',
      'desc'      => '开启后将会隐藏「在线留言」菜单，但如果你有使用「在线留言」模块，访客提交留言后仍然会保存在数据库和进行邮件通知。',
      'default'   => false,
    ),

    array(
      'id'        => 'remove_menu_dqtheme-license',
      'type'      => 'switcher',
      'title'     => '禁用「主题授权」菜单',
      'desc'      => '开启后将会隐藏「主题授权」菜单，但你仍然可以通过“域名/wp-admin/admin.php?page=theme-license”进行访问。',
      'default'   => false,
    ),

    array(
      'id'        => 'remove_menu_dqtheme-optimize',
      'type'      => 'switcher',
      'title'     => '隐藏「网站优化」菜单',
      'desc'      => '开启后将会隐藏「网站优化」菜单，但你仍然可以通过“域名/wp-admin/admin.php?page=dqtheme-optimize”进行访问。',
      'default'   => false,
    ),
        
    array(
      'id'        => 'dq_404',
      'type'      => 'radio',
      'title'     => '404 页面',
      'options'   => array(
          'default'   => '默认404页面',
          'tencent'   => '腾讯公益404页面',
      ),
      'default'   => 'default',
    ),
	array(
      'id'        => 'post_rand_404',
      'type'      => 'text',
      'title'=>'404随机显示产品',
      'desc'      => '分类限制：<br>格式：1,2 &nbsp;表示只显示分类ID为1,2分类的文章。<br>格式：-1,-2 &nbsp;表示排除分类ID为1,2的文章。<br>也可以直接写1或者-1。<br>注意：多个ID之间用英文逗号隔开！',
      'attributes'=> array('style'=> 'width: 100%;'),
      'dependency'=> array( 'dq_404', '==', 'default' ),
    ),

	array(
      'id'        => 'tag_all_link',
      'type'      => 'text',
      'title'     =>'标签页ALL链接',
      'desc'      => '',
      'attributes'=> array('style'=> 'width: 100%;'),
    ),

    array(
      'id'        => 'is_privacy',
      'type'      => 'switcher',
      'title'     => '启用Cookies使用政策',
      'desc'      => '点击同意后Cookie失效钱不会弹出，默认1天失效',
      'default'   => false,
    ),

	array(
      'id'        => 'privacy_title',
      'type'      => 'text',
      'title'     =>'Cookies使用政策标题',
      'desc'      => '',
      'default'   => 'Cookies Policy',
      'dependency' => array('is_privacy', '==', 'true'),
    ),

	array(
      'id'        => 'privacy_content',
      'type'      => 'wp_editor',
      'title'     =>'Cookies使用政策内容',
      'desc'      => '',
      'default'   => 'Our website uses cookies to improve our website and improve user experience.<br>If you continue to browse this website without changing your browser cookie settings, you are deemed to agree to our cookie usage policy.<br><span style="color: #ff0000;"><a style="color: #ff0000;" href="/privacy">Cookies Policy</a></span>',
      'dependency' => array('is_privacy', '==', 'true'),
    ),

	array(
      'id'        => 'privacy_button',
      'type'      => 'text',
      'title'     =>'Cookies使用政策按钮文字',
      'desc'      => '',
      'default'   => 'Accept all cookies',
      'dependency' => array('is_privacy', '==', 'true'),
    ),
    
  )
) );

/** --------------------------------------------------------------------------------- *
 *  SEO优化
 *  --------------------------------------------------------------------------------- */
CSF::createSection( $prefix, array(
  'id'    => 'seo',
  'title' => 'SEO优化',
  //'icon'  => 'fa fa-tint',
) );

//
// SEO优化：SEO设置
//
CSF::createSection( $prefix, array(
  'parent'        => 'seo',
  'title'         => '网站SEO设置',
  //'description'   => '可自定义首页、文章页、页面、分类页面的标题、关键词和描述。',
  'fields'        => array(

    array(
      'type'      => 'subheading',
      'content'   => '可自定义首页、文章页、页面、分类页面的标题、关键词和描述。<a href="https://www.dqtheme.com/theme-docs/107113.html" target="_blank">查看网站SEO设置说明文档</a>',
    ),

    array(
      'id'        => 'dq_seo_switch',
      'type'      => 'switcher',
      'title'     => '主题SEO设置',
    ),

    array(
      'id'        => 'connector',
      'type'      => 'text',
      'title'     => '标题分隔符',
      'default'   => '-',
      'desc'      => '一般设置为 - 或 _ 不要留空格',
      'attributes'=> array('style'=> 'width: 10%;'),
      'dependency'=> array( 'dq_seo_switch', '==', true ),
    ),

    array(
      'id'        => 'hometitle',
      'type'      => 'text',
      'title'     => '首页标题',
      'desc'      => '自定义首页标题，留空则自动调用「后台-设置-常规」中的“站点标题+副标题”的内容',
      'attributes'=> array('style'=> 'width: 100%;'),
      'dependency'=> array( 'dq_seo_switch', '==', true ),
    ),

    array(
      'id'        => 'home_description',
      'type'      => 'textarea',
      'title'     => '首页描述',
      'desc'      => '一段简单的描述文字',
      'attributes'=> array('style'=> 'width: 100%;'),
      'dependency'=> array( 'dq_seo_switch', '==', true ),
    ),

    array(
      'id'        => 'home_keywords',
      'type'      => 'textarea',
      'title'     => '首页关键词',
      'desc'      => '多个关键词之间用英文逗号隔开',
      'attributes'=> array('style'=> 'width: 100%;'),
      'dependency'=> array( 'dq_seo_switch', '==', true ),
    ),

  )
) );

//
// SEO优化：网站URL优化
//
CSF::createSection( $prefix, array(
  'parent'      => 'seo',
  'title'       => '网站URL优化',
  'fields'      => array(

    array(
      'type'      => 'subheading',
      'content'   => '开启或关闭此处功能后请到「固定链接」中重新保存一下设置。<a href="https://www.dqtheme.com/theme-docs/107113.html" target="_blank">查看网站SEO设置说明文档</a>',
    ),

    array(
      'id'      => 'no_category',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '去除固定连接中的「category」标志',
    ),
    array(
      'id'      => 'dq_tag_rewrite',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => 'WordPress标签链接以id方式显示',
    ),
    array(
      'id'      => 'no_zifenlei',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '去除固定链接中的子分类，去掉前：www.xxx.com/fenlei/zifenlei/123.html，去掉后：www.xxx.com/fenlei/123.html',
    ),
    array(
      'id'      => 'dq_links_nofollow',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '给「链接」增加Nofollow属性选项，这个属性基本上都知道吧？不懂的还是看下百度百科吧：<a target="_blank" href="https://baike.baidu.com/item/Nofollow/2410595?fr=aladdin">点击查看</a>',
    ),
    array(
      'id'    => 'html_page_permalink',
      'type'  => 'switcher',
      'title' => '',
      'label' => '页面链接添加.html后缀',
    ),
    array(
      'id'    => 'dq_trailingslashit',
      'type'  => 'switcher',
      'title' => '',
      'label' => '给分类目录链接末尾添加 / 斜杠',
    ),
    array(
      'id'    => 'dqtheme_post_nofollow',
      'type'  => 'switcher',
      'title' => '',
      'label' => '文章外链自动添加nofollow标签',
    ),

  )
) );

// SEO优化：关键词自动链接
CSF::createSection( $prefix, array(
  'parent'      => 'seo',
  'title'       => '关键词自动链接',
  'fields'      => array(


    array(
      'id'      => 'auto_tag_link',
      'type'    => 'switcher',
      'title'   => '标签内链',
      'desc'    => '为文章内的标签自动添加标签页面链接，每个标签仅添加一个超链接',
    ),

    array(
      'id'      => 'dqtheme_auto_key_url',
      'type'    => 'switcher',
      'title'   => '自定义关键词链接',
      'desc'    => '如果文章中出现了你在下面添加的词，将自动给这个词加上你指定的链接地址',
    ),
    array(
      'id'                => 'dqtheme_auto_keyword',
      'type'              => 'group',
      'title'             => '添加关键词',
      'button_title'      => '添加关键词',
      'accordion_title'   => '添加关键词',
      'fields'            => array(
        array(
          'id'        => 'auto_keyword_key',
          'type'      => 'text',
          'title'     => '关键词',
        ),
        array(
          'id'        => 'auto_keyword_link',
          'type'      => 'text',
          'title'     => '链接地址',
        ),
        array(
          'id'        => 'auto_keyword_title',
          'type'      => 'text',
          'title'     => '说明文本',
          'desc'      => '显示在a标签的title属性里面',
        ),
      ),
      'dependency'=> array( 'dqtheme_auto_key_url', '==', true ),
    ),


  )
) );

//
// SEO优化：主动推送
//
CSF::createSection( $prefix, array(
  'parent'      => 'seo',
  'title'       => '百度-普通收录',
  'fields'      => array(

    //主动推送
    array(
      'id'    => 'DQTheme_Baidu_Submit',
      'type'  => 'switcher',
      'title' => '',
      'label' => '百度站长平台-普通收录（API提交）',
    ),
    array(
      'id'    => 'Baidu_Submit_url',
      'type'  => 'text',
      'title' => '网站域名',
      'after'      => '<p class="cs-text-muted">记得填写“http://”或者“https://”</p>',
      'attributes'   => array('style'=> 'width: 100%;'),
      'dependency'   => array( 'DQTheme_Baidu_Submit', '==', true ),
    ),
    array(
      'id'    => 'Baidu_Submit_token',
      'type'  => 'text',
      'title' => '准入密钥（token）',
      'attributes'   => array('style'=> 'width: 100%;'),
      'dependency'   => array( 'DQTheme_Baidu_Submit', '==', true ),
    ),


  )
) );

//
// SEO优化：百度移动专区
//
CSF::createSection( $prefix, array(
  'parent'      => 'seo',
  'title'       => '百度-快速收录',
  'fields'      => array(

    //熊账号
    array(
      'id'    => 'xiongzhanghao',
      'type'  => 'switcher',
      'title' => '',
      'label' => '百度站长平台-快速收录（API提交）',
    ),
    array(
      'id'    => 'xzh_appid',
      'type'  => 'text',
      'title' => '网站域名',
      'after'      => '<p class="cs-text-muted">记得填写“http://”或者“https://”</p>',
      'attributes'   => array('style'=> 'width: 100%;'),
      'dependency'   => array( 'xiongzhanghao', '==', true ),
    ),
    array(
      'id'    => 'xzh_post_token',
      'type'  => 'text',
      'title' => '准入密钥（token）',
      'attributes'   => array('style'=> 'width: 100%;'),
      'dependency'   => array( 'xiongzhanghao', '==', true ),
    ),


  )
) );


/** --------------------------------------------------------------------------------- *
 *  WP优化
 *  --------------------------------------------------------------------------------- */
CSF::createSection( $prefix, array(
  'id'    => 'wp_optimization',
  'title' => 'WP优化',
  //'icon'  => 'fa fa-tint',
) );

//
// WP优化：后台优化
//
CSF::createSection( $prefix, array(
  'parent' => 'wp_optimization',
  'title'  => '后台优化',
  'fields' => array(

    array(
      'type'      => 'subheading',
      'content'   => '针对WordPress进行数十种性能优化，告别网站龟速加载！<a href="https://www.dqtheme.com/theme-docs/107140.html" target="_blank">「WP优化」功能介绍</a>',
    ),

    array(
      'id'      => 'dq_admin_column_img',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '后台「文章列表中」表显示文章缩略图',
      //'default' => true,
    ),
    array(
      'id'      => 'dqtheme_moveposttotrash',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '后台Ajax删除文章（https://www.dqtheme.com/wpjiaocheng/93394.html）',
    ),
    array(
      'id'    => 'dqtheme_article',
      'type'  => 'switcher',
      'title' => '',
      'label' => '登录后台后默认跳转到文章列表',
    ),

  )

) );

//
// WP优化：加速优化
//
CSF::createSection( $prefix, array(
  'parent' => 'wp_optimization',
  'title'  => '加速优化',
  'fields' => array(

    array(
      'type'      => 'subheading',
      'content'   => '针对WordPress进行数十种性能优化，告别网站龟速加载！<a href="https://www.dqtheme.com/theme-docs/107140.html" target="_blank">「WP优化」功能介绍</a>',
    ),

    array(
      'id'      => 'dq_instantpage',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '瞬间预加载（Instant Page）',
    ),
    array(
      'id'      => 'dqtheme_avatar',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '使用avatar头像加速，加快加载速度',
    ),
    array(
      'id'      => 'dqtheme_language',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '禁止前台加载语言包',
    ),

  )

) );

//
// WP优化：功能屏蔽
//
CSF::createSection( $prefix, array(
  'parent' => 'wp_optimization',
  'title'  => '功能屏蔽',
  'fields' => array(

    array(
      'type'      => 'subheading',
      'content'   => '针对WordPress进行数十种性能优化，告别网站龟速加载！<a href="https://www.dqtheme.com/theme-docs/107140.html" target="_blank">「WP优化」功能介绍</a>',
    ),

    array(
      'id'      => 'dq_remove_comment',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '彻底移除后台「评论」（对企业站来说，评论几乎没用，可根据需求决定是否移除）',
    ),
    array(
      'id'      => 'dq_remove_dashboard',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '移除后台「仪表盘」菜单',
    ),
    array(
      'id'      => 'dq_remove_tools',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '移除后台「工具」菜单',
    ),
    array(
      'id'      => 'dq_new_admin_email',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '移除修改网站管理员邮箱时的邮件验证步骤',
    ),
    array(
      'id'      => 'dqtheme_no_gutenberg',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '禁用古腾堡编辑器',
    ),
    array(
      'id'      => 'no_admin_bar',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '去除wordpress前台顶部工具条',
    ),
    array(
      'id'      => 'dqtheme_privacy',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '彻底删除后台隐私相关设置',
    ),
    array(
      'id'      => 'dqtheme_pingback',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '关闭 XML-RPC 和 pingback 端口',
    ),
    array(
      'id'      => 'dqtheme_wp_head',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '移除前端header中多余的代码',
    ),
    array(
      'id'      => 'dqtheme_wp_head_json',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '移除前端header中的wp-json代码',
    ),
    array(
      'id'      => 'dqtheme_feed',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '禁止FEED，防采集',
    ),
    array(
      'id'      => 'dqtheme_option_thumbnail',
      'type'    => 'switcher',
      'title'   => '',
      'label'   => '彻底关闭WordPress生成默认尺寸的缩略图',
    ),


  )
) );

//
// WP优化：登录界面美化
//
CSF::createSection( $prefix, array(
  'parent' => 'wp_optimization',
  'title'  => '登录界面美化',
  'fields' => array(

    array(
      'id'      => 'login_style',
      'type'    => 'switcher',
      'title'   => '登录界面美化',
    ),

    array(
      'id'        => 'login_logo_form',
      'type'      => 'radio',
      'title'     => '登录框位置',
      'inline'    => true,
      'options'   => array(
        'left'    => '靠左',
        'middle'  => '居中',
        'right'   => '靠右',
      ),
      'default'   => 'middle',
      'dependency'=> array( 'login_style', '==', true ),
    ),
    array(
      'id'        => 'login_logo',
      'type'      => 'media',
      'title'     => '登录页面Logo',
      'desc'      => '建议200*200 px',
      'add_title' => '上传图片',
      'dependency'=> array( 'login_style', '==', true ),
    ),
    array(
      'id'        => 'login_bgimg',
      'type'      => 'media',
      'title'     => '登录页面背景图片',
      'desc'      => '没有建议尺寸，铺满整个屏幕最佳',
      'add_title' => '上传图片',
      'dependency'=> array( 'login_style', '==', true ),
    ),


  )

) );

//
// WP优化：功能修复/新增
//
CSF::createSection( $prefix, array(
  'parent' => 'wp_optimization',
  'title'  => '功能修复/新增',
  'fields' => array(

    array(
      'type'      => 'subheading',
      'content'   => '针对WordPress进行数十种性能优化，告别网站龟速加载！<a href="https://www.dqtheme.com/theme-docs/107140.html" target="_blank">「WP优化」功能介绍</a>',
    ),

    array(
      'id'    => 'dqtheme_delete_post_attachments',
      'type'  => 'switcher',
      'title' => '',
      'label' => '删除文章时删除图片附件',
    ),
    array(
      'id'    => 'dqtheme_upload_img_rename',
      'type'  => 'switcher',
      'title' => '',
      'label' => '上传图片使用日期重命名',
    ),
    array(
      'id'    => 'dqtheme_pubMissedPosts',
      'type'  => 'switcher',
      'title' => '',
      'label' => '修复WordPress文章定时发布失败的问题',
    ),
    array(
      'id'    => 'redirect_search',
      'type'  => 'switcher',
      'title' => '',
      'label' => '修改搜索结果的链接，修改前：域名/?s=搜索词，修改后：域名/search/搜索词',
    ),

  )

) );

/** --------------------------------------------------------------------------------- *
 *  扩展功能
 *  --------------------------------------------------------------------------------- */
CSF::createSection( $prefix, array(
  'id'    => 'extend_fields',
  'title' => '扩展功能',
  //'icon'  => 'fa fa-tint',
) );


//
// 扩展功能：自定义文章排序、分类目录排序
//
/*
$options_taxonomies = array();
$options_taxonomies_obj = get_taxonomies(array( 'show_ui' => true ), 'objects');
foreach ( $options_taxonomies_obj as $taxonomy ) {

	if( $taxonomy->name == 'category' ){
		//$taxonomy_name = '分类目录';
		$options_taxonomies['category'] = '分类目录';
	}
	//if( $taxonomy->name == 'post_tag' ){
		//$taxonomy_name = '标签「暂不支持排序」';
	//}
	if( $taxonomy->name == 'link_category' ){
		//$taxonomy_name = '链接分类目录';
		$options_taxonomies['link_category'] = '链接分类目录';
	}
	//$options_taxonomies[$taxonomy->name] = $taxonomy_name; //输出所有自定义分类法

}


CSF::createSection( $prefix, array(
  'parent'      => 'extend_fields',
  'title'       => '自定义文章排序',
  'description' => '自定义文章排序，功能介绍请点击：<a href="https://www.dqtheme.com/wpjiaocheng/93513.html" target="_blank">https://www.dqtheme.com/wpjiaocheng/93513.html</a>',
  'fields'      => array(

    array(
      'id'    => 'dq_custom_sort',
      'type'  => 'switcher',
      'title' => '启用自定义排序',
    ),
    array(
      'id'          => 'dq_post_type',
      'type'        => 'checkbox',
      'title'       => '启用文章排序',
      'options'     => 'post_types',
      'dependency'  => array( 'dq_custom_sort', '==', true ),
    ),

    array(
      'id'          => 'dq_cat_type',
      'type'        => 'checkbox',
      'title'       => '启用分类排序',
      'options'     => $options_taxonomies,
      'dependency'  => array( 'dq_custom_sort', '==', true ),
    ),

    )
) );
*/

//
// 扩展功能：自动保存文章中的外链图片
//
CSF::createSection( $prefix, array(
  'parent'      => 'extend_fields',
  'title'       => '自动保存文章外链图片',
  'fields'      => array(

    array(
      'type'      => 'subheading',
      'content'   => '【测试版，个别情况下可能会遇到问题】发布文章时候自动保存文章中的外链图片，此功能适用于喜欢复制粘贴文章的用户。',
    ),

    array(
      'id'      => 'save_remote_pic',
      'type'    => 'switcher',
      'title'   => '自动保存外链图片',
      'desc'    => '【测试版，个别情况下可能会遇到问题】发布文章时候自动保存文章中的外链图片，此功能适用于喜欢复制粘贴文章的用户。',
      'default' => false
    ),


  )
) );

//
// 扩展功能：自定义用户头像
//
CSF::createSection( $prefix, array(
  'parent'      => 'extend_fields',
  'title'       => '自定义用户头像',
  'fields'      => array(

    array(
      'type'      => 'subheading',
      'content'   => 'WordPress默认调用的Gravatar头像，设置方面不够友好，开启此功能后可后台上传自定义用户头像。<a href="#" target="_blank">详细介绍</a>',
    ),

    array(
      'id'      => 'dqtheme_custom_avatar',
      'type'    => 'switcher',
      'title'   => '自定义用户头像',
      'desc'    => '开启后到「用户-个人资料」中上传个人头像',
      'default' => false
    ),
    array(
      'id'        => 'default_avatar',
      'type'      => 'media',
      'title'     => '默认用户头像',
      'add_title' => '上传头像',
      'dependency'=> array( 'dqtheme_custom_avatar', '==', true ),
    ),


  )
) );

//
// 扩展功能：SMTP邮箱设置
//
CSF::createSection( $prefix, array(
  'parent'      => 'extend_fields',
  'title'       => 'SMTP邮箱设置',
  'fields'      => array(

    array(
      'type'      => 'subheading',
      'content'   => '配置SMTP服务后即可实现发信（邮件通知）功能。<a href="#" target="_blank">「SMTP服务」功能介绍</a>',
    ),

    array(
      'id'    => 'smtp_switcher',
      'type'  => 'switcher',
      'title' => '启用SMTP服务',
    ),

    array(
      'id'          => 'dq_email',
      'type'        => 'text',
      'title'       => '发件人邮箱',
      'desc'        => '请输入您的邮箱地址',
      'attributes'  => array('style'=> 'width: 50%;'),
      'dependency'  => array( 'smtp_switcher', '==', true ),
    ),

    array(
      'id'          => 'dq_mailname',
      'type'        => 'text',
      'title'       => '发件人昵称',
      'desc'        => '请输入发件人昵称',
      'attributes'  => array('style'=> 'width: 50%;'),
      'dependency'  => array( 'smtp_switcher', '==', true ),
    ),

    array(
      'id'          => 'dq_mailsmtp',
      'type'        => 'text',
      'title'       => 'SMTP服务器地址',
      'desc'        => '请输入您邮箱的SMTP服务器地址',
      'default'     => 'smtp.qq.com',
      'attributes'  => array('style'=> 'width: 50%;'),
      'dependency'  => array( 'smtp_switcher', '==', true ),
    ),

    array(
      'id'          => 'dq_smtpssl',
      'type'        => 'switcher',
      'title'       => 'SSL安全连接',
      'default'     => true,
      'dependency'  => array( 'smtp_switcher', '==', true ),
    ),

    array(
      'id'          => 'dq_mailport',
      'type'        => 'number',
      'title'       => 'SMTP服务器端口',
      'default'     => '465',
      'attributes'  => array('style'=> 'width: 50%;'),
      'dependency'  => array( 'smtp_switcher', '==', true ),
    ),

    array(
      'id'          => 'dq_mailuser',
      'type'        => 'text',
      'title'       => '邮箱帐号',
      'desc'        => '请输入您的邮箱地址，例如：670088886@qq.com',
      'attributes'  => array('style'=> 'width: 50%;'),
      'dependency'  => array( 'smtp_switcher', '==', true ),
    ),

    array(
      'id'          => 'dq_mailpass',
      'type'        => 'text',
      'title'       => '邮箱认证密码',
      'desc'        => '如果使用QQ邮箱，这里输入的不是QQ密码，请前往QQ邮箱 - 设置 - 账户中生成授权码',
      'attributes'  => array('style'=> 'width: 50%;'),
      'dependency'  => array( 'smtp_switcher', '==', true ),
    ),

  )
) );

//
// 扩展功能：对象储存
//
CSF::createSection( $prefix, array(
  'parent'      => 'extend_fields',
  'title'       => '对象储存',
  'fields'      => array(

    array(
      'type'      => 'subheading',
      'content'   => '七牛云：<a href="https://www.dqtheme.com/theme-docs/105608.html" target="_blank">点击查看【七牛云对象储存配置教程】</a><span style="margin:0 20px;color:#eee;font-size:18px;line-height:0">|</span>阿里云：<a href="https://www.dqtheme.com/theme-docs/105609.html" target="_blank">点击查看【阿里云OSS对象储存配置教程】</a>',
    ),

    array(
			'id'    		=> 'cdn_type',
			'type'  		=> 'select',
			'title' 		=> '选择云储存',
			'options'		=> array(
				'0' 		  => '关闭',
				'qiniu'   => '七牛云储存',
				'alioss'  => '阿里云OSS'
			),
    ),
    array(
      'id'        => 'cdn_url',
      'type'			=> 'text',
      'title'			=> '加速域名',
			'after'			=> '<p class="cs-text-muted">不要忘记了“http(s)://”</p>',
			'attributes'=> array('style'=> 'width: 50%;'),
			'dependency'=> array( 'cdn_type', 'any', 'qiniu,alioss' )
    ),
    array(
      'id'        => 'cdn_file_format',
      'type'			=> 'text',
      'title'			=> '镜像文件格式',
			'default'		=> 'png|jpg|jpeg|gif|ico|7z|zip|rar|pdf|ppt|wmv|mp4|avi|mp3|txt',
			'after'   	=> '<p class="cs-text-muted">在输入框内添加准备镜像的文件格式，比如png|jpg|jpeg|gif|ico|html|7z|zip|rar|pdf|ppt|wmv|mp4|avi|mp3|txt（使用|分隔）</p>',
			'attributes'=> array('style'=> 'width: 50%;'),
			'dependency'=> array( 'cdn_type', 'any', 'qiniu,alioss' )
    ),
    array(
      'id'        => 'cdn_mirror_folder',
      'type'			=> 'text',
      'title'			=> '镜像文件夹',
			'default'		=> 'wp-content|wp-includes',
			'after'			=> '<p class="cs-text-muted">在输入框内添加准备镜像的文件夹，比如wp-content|wp-includes（使用|分隔）</p>',
			'attributes'=> array('style'=> 'width: 50%;'),
			'dependency'=> array( 'cdn_type', 'any', 'qiniu,alioss' )
    ),

  )
) );

//
// 扩展功能：链接转换
//
CSF::createSection( $prefix, array(
  'parent'      => 'extend_fields',
  'title'       => '链接转换',
  'fields'      => array(

    array(
      'type'      => 'subheading',
      'content'   => '链接转换功能，手动把外链转为内链，并且可以统计链接点击量。<a href="#" target="_blank">「外链转内链」功能介绍</a>',
    ),

    array(
      'id'      => 'dqtheme_simple_urls',
      'type'    => 'switcher',
      'title'   => '外链转内链',
      'desc'    => '开启后刷新一下页面即可在菜单栏显示按钮',
      'help'    => '集成Simple Urls外链转内链插件，开启即可使用。',
      'default' => false
    ),


  )
) );

//
// 扩展功能：数据库优化清理
//
CSF::createSection( $prefix, array(
  'parent'      => 'extend_fields',
  'title'       => '数据库优化清理',
  'fields'      => array(

    array(
      'type'      => 'subheading',
      'content'   => '可清理数据库中的垃圾信息，比如：文章修订版本、自动草稿、垃圾评论等等。<a href="#" target="_blank">「数据库优化清理」功能介绍</a>',
    ),

    array(
      'id'      => 'dqtheme_wp-clean-up',
      'type'    => 'switcher',
      'title'   => '数据库优化清理',
      'desc'    => '开启后刷新一下页面，在外观 - 数据库清理 中进行优化',
      'help'    => '集成wp-clean-up插件，WordPress数据库优化，它包含删除冗余数据和数据库优化两大功能，操作界面十分简洁易于理解。',
      'default' => false
    ),


  )
) );

//
// 扩展功能：站点地图（Sitemap）
//
CSF::createSection( $prefix, array(
  'parent'      => 'extend_fields',
  'title'       => '站点地图（Sitemap）',
  'fields'      => array(

    array(
      'type'      => 'subheading',
      'content'   => '自动生成xml文件，可用于百度站长平台，有助于快速、全面的抓取或更新网站上内容。<a href="#" target="_blank">「站点地图」功能介绍</a>',
    ),

    array(
      'id'      => 'dqtheme_sitemap',
      'type'    => 'switcher',
      'title'   => '站点地图',
      'desc'    => '开启后刷新一下页面，在智能营销主题 - 站点地图 中进行设置',
      'help'    => '自动生成xml文件，遵循Sitemap协议，用于指引搜索引擎快速、全面的抓取或更新网站上内容。兼容百度、google、360等主流搜索引擎。',
      'default' => false
    ),


  )
) );

/** --------------------------------------------------------------------------------- *
 *  添加代码
 *  --------------------------------------------------------------------------------- */
CSF::createSection( $prefix, array(
  'title'  => '添加代码',
  'fields' => array(

    array(
      'type'      => 'subheading',
      'content'   => '支持html、css和js代码，js请添加&lt;script&gt;闭合标签，css请添加&lt;style&gt;闭合标签',
    ),

    array(
      'id'        => 'code_head',
      'type'      => 'code_editor',
      'title'     => '添加到头部',
      'settings'  => array(
        'theme'   => 'shadowfox',
        'mode'    => 'htmlmixed',
      ),
    ),
    array(
      'id'        => 'code_foot',
      'type'      => 'code_editor',
      'title'     => '添加到页脚',
      //'desc'      => '支持html、css、js，js请添加&lt;script&gt;闭合标签，css请添加&lt;style&gt;闭合标签',
      'settings'  => array(
        'theme'   => 'shadowfox',
        'mode'    => 'htmlmixed',
      ),
    ),

  )
) );

/** --------------------------------------------------------------------------------- *
 *  禁用主题更新
 *  --------------------------------------------------------------------------------- */
CSF::createSection( $prefix, array(
  'title'  => '禁用主题更新',
  'fields' => array(

    array(
      'type'      => 'subheading',
      'content'   => '开启后，后台将不再显示主题更新提示，如果你修改了主题文件且以后都不需要更DQ主题了，则可以开启',
    ),

    array(
      'id'      => 'dq_theme_update',
      'type'    => 'switcher',
      'title'   => '禁用主题更新',
      'default' => false
    ),

  )
) );

CSF::createSection($prefix, array(
    'title'       => '备份恢复',
    //'icon'        => 'fa fa-shield',
    'fields'      => array(
        array(
            'type' => 'backup',
        ),
    ),
));

add_action('admin_head',function(){ ?>

<style type="text/css">
  .toplevel_page_dqtheme-optimize .csf-content{min-height:74vh}
</style>

<?php });

