<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.

//
// Set a unique slug-like ID
//
$prefix = 'dqtheme_customize';

//
//获取链接分类目录
//
$options_linkcats = array();
$options_linkcats_obj = get_terms('link_category');
if( ! empty( $options_linkcats_obj ) ) {
    foreach ( $options_linkcats_obj as $tag ) {
        $options_linkcats[$tag->term_id] = $tag->name;
    }
}else{
    $options_linkcats = array( 'term_id' => '请到「后台-链接」中添加链接分类目录' );
    add_action('admin_enqueue_scripts',function(){ ?>
        <style type="text/css">
            input[data-depend-id="foot_link_cat"]{display:none !important}
            .csf-customize-field[data-option-id="foot_link_cat"] label{pointer-events:none}
        </style>
    <?php });
}

//
// Create customize options
//
CSF::createCustomizeOptions( $prefix );

// ----------------------------------------
// 头部设置
// ----------------------------------------
CSF::createSection( $prefix, array(
    'title'    => '其他设置',
    'priority' => 999,
    'fields'   => array(

        // Loading 动画
        array(
            'id'        => 'dq_loading',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => 'Loading加载动画',
            'default'   => false,
        ),
        array(
            'id'        => 'loading_gif',
            'type'      => 'media',
            'title'     => 'Loading图片',
            'subtitle'  => 'GIF，建议尺寸：80×80 px',
            'add_title' => '上传Loading图片',
            'dependency'=> array( 'dq_loading', '==', true )
        ),
        // 侧栏靠右显示
        array(
            'id'        => 'dq_sidebar_right',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '侧边栏显示在左侧',
            'default'   => false,
        ),

    )
) );

// ----------------------------------------
// 头部设置
// ----------------------------------------
CSF::createSection( $prefix, array(
    'title'    => '头部设置',
    'priority' => 2,
    'fields'   => array(

        // 选择头部样式
        array(
            'id'        => 'header_type',
            'type'      => 'button_set',
            'title'     => '选择头部样式',
            'options'   => array(
                '1'     => '头部样式-1',
                '2'     => '头部样式-2',
            ),
            'default'   => '1',
        ),

        array(
            'id'        => 'header_banner_img_default',
            'type'      => 'media',
            'title'     => '默认Banner图片',
            'subtitle'  => '选择「头部样式-1」时候必须有Banner图片，此次的设置将会显示在「搜索页面」、「标签页面」',
            'add_title' => '上传 默认Banner图片',
            'dependency'=> array( 'header_type', 'any', '1' )
        ),

        /*
        array(
            'id'        => 'header_type',
            'type'      => 'image_select',
            'title'     => '选择头部样式',
            //'inline'    => true,
            //'class'     => 'horizontal',
            'options'   => array(
                '1'     => get_stylesheet_directory_uri() . '/static/images/admin/header-1.png',
                '2'     => get_stylesheet_directory_uri() . '/static/images/admin/header-2.png',
            ),
            'default'   => '1',
        ),
        */
        array(
            'id'        => 'logo',
            'type'      => 'media',
            'title'     => '网站 LOGO（PC端）',
            'subtitle'  => '建议尺寸：180×50 px（或同比例放大）',
            'add_title' => '上传 LOGO（PC端）',
            //'dependency'=> array( 'header_type', 'any', '1' )
        ),
        array(
            'id'        => 'mb_logo',
            'type'      => 'media',
            'title'     => '网站 LOGO（手机端）',
            'subtitle'  => '建议尺寸：180×50 px（或同比例放大）',
            'add_title' => '上传 LOGO（手机端）',
            //'dependency'=> array( 'header_type', 'any', '1' )
        ),
        /*
        array(
            'id'        => 'header2_logo',
            'type'      => 'media',
            'title'     => '网站 LOGO',
            'help'      => '建议尺寸：234×58 px',
            'add_title' => '上传 LOGO',
            'dependency'=> array( 'header_type', 'any', '2' )
        ),
        array(
            'id'              => 'header2_contact',
            'type'            => 'group',
            'title'           => '',
            'button_title'    => '添加联系信息',
            'accordion_title' => '添加联系信息',
            'fields'          => array(
                array(
                    'id'        => 'header2_contact_title',
                    'type'      => 'text',
                    'title'     => '标题',
                ),
                array(
                    'id'        => 'header2_contact_describe',
                    'type'      => 'text',
                    'title'     => '描述',
                ),
                array(
                    'id'            => 'footer2_contact_icon',
                    'type'          => 'icon',
                    'title'         => '选择图标',
                ),
            ),
            'dependency'=> array( 'header_type', 'any', '2' )
        ),

        array(
            'id'        => 'logo_mobile',
            'type'      => 'media',
            'title'     => '手机端 LOGO',
            'help'      => '建议尺寸：250×71 px',
            'add_title' => '上传手机端 LOGO',
        ),
        */
        /*
        array(
            'id'        => 'favicon',
            'type'      => 'media',
            'title'     => 'Favicon 图标',
            'subtitle'  => '建议尺寸：50×50 px',
            'add_title' => '上传 Favicon',
        ),
        */

        /*
        //搜索框
        array(
            'id'        => 'search_header',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '搜索按钮（显示在导航栏尾部）',
            'default'   => false
        ),
        //搜索框 END
        */

        //顶部工具栏
        array(
            'id'        => 'social_sw',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '显示社交工具',
            'default'   => false
        ),
        array(
          'id'			=> 'social_facebook',
          'type'		=> 'text',
          'title'		=> 'Facebook',
          'dependency'	=> array( 'social_sw', '==', true )
        ),
        array(
          'id'			=> 'social_twitter',
          'type'		=> 'text',
          'title'		=> 'Twitter',
          'dependency'	=> array( 'social_sw', '==', true )
        ),
        array(
          'id'			=> 'social_pinterest',
          'type'		=> 'text',
          'title'		=> 'Pinterest',
          'dependency'	=> array( 'social_sw', '==', true )
        ),
        array(
          'id'			=> 'social_youtube',
          'type'		=> 'text',
          'title'		=> 'YouTube',
          'dependency'	=> array( 'social_sw', '==', true )
        ),
        array(
          'id'			=> 'social_instagram',
          'type'		=> 'text',
          'title'		=> 'Instagram',
          'dependency'	=> array( 'social_sw', '==', true )
        ),

        //搜索图标
        array(
            'id'        => 'search_header',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '搜索按钮',
            'default'   => false
        ),
        array(
            'id'        => 'search_placeholder',
            'type'      => 'text',
            'title'     => '搜索框默认显示文本',
            'subtitle'  => '例如：搜索一下...',
            'dependency'=> array( 'search_header', '==', true )
        ),
        array(
            'id'        => 'header_sticky',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '菜单栏一直显示在最顶部',
            'default'   => false
        ),

        /*      
        array(
            'id'        => 'notice_code_close',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '显示 关闭 按钮，关闭后半个小时内不再显示',
            'default'   => false,
            'dependency'=> array( 'notice_code_switch', '==', true )
        ),*/
        /*
        array(
            'id'        => 'notice_no_mobile',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '禁止手机端显示公告',
            'help'      => '开启后手机端浏览将不显示顶部公告',
            'dependency'=> array( 'notice_code_switch', '==', true ),
            'default'   => false
        ),
        */
        //顶部公告 END

        //菜单栏显示自定义按钮
        array(
            'id'        => 'menu_item_btn',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '菜单栏显示自定义按钮',
            'default'   => false
        ),
        //按钮文本
        array(
            'id'        => 'menu_item_btn_text',
            'type'      => 'text',
            'title'     => '按钮文本',
            'dependency'=> array( 'menu_item_btn', '==', true )
        ),
        //跳转链接
        array(
            'id'        => 'menu_item_btn_url',
            'type'      => 'text',
            'title'     => '跳转链接',
            'dependency'=> array( 'menu_item_btn', '==', true )
        ),

    )
) );


//
// 首页模块
//
CSF::createSection( $prefix, array(
  'id'       => 'home_modular',
  'title'    => '首页模块',
  'priority' => 3,
) );

//
// 幻灯片设置
//
CSF::createSection( $prefix, array(
    'parent'   => 'home_modular',
    'title'    => '幻灯片设置',
    //'priority' => 3,
    'fields'   => array(

        //幻灯片设置
        array(
            'id'              => 'banner',
            'type'            => 'group',
            'title'           => '首页幻灯片设置',
            'button_title'    => '添加幻灯片',
            'accordion_title' => '添加幻灯片',
            'fields'          => array(

                array(
                    'id'                => 'banner_subtitle',
                    'type'              => 'text',
                    'title'             => '小标题',
                ),
                array(
                    'id'                => 'banner_title',
                    'type'              => 'text',
                    'title'             => '大标题',
                ),
                array(
                    'id'                => 'banner_img',
                    'type'              => 'media',
                    'title'             => '上传图片(PC端)',
                    'subtitle'          => '建议尺寸 1905×750 px',
                    'settings'          => array(
                        'button_title'  => '上传图片(PC端)',
                        'frame_title'   => '选择图片(PC端)',
                        'insert_title'  => '插入图片(PC端)',
                    ),
                ),
                array(
                    'id'                => 'banner_img_mobile',
                    'type'              => 'media',
                    'title'             => '上传图片(手机端)',
                    'subtitle'          => '建议尺寸 750×580 px（留空则显示PC端）',
                    'settings'          => array(
                        'button_title'  => '上传图片(手机端)',
                        'frame_title'   => '选择图片(手机端)',
                        'insert_title'  => '插入图片(手机端)',
                    ),
                ),
                array(
                    'id'                => 'btn_txt',
                    'type'              => 'text',
                    'title'             => '按钮文本',
                ),
                array(
                    'id'                => 'banner_url',
                    'type'              => 'text',
                    'title'             => '按钮跳转链接',
                    'subtitle'          => '链接带上 http:// 或者 https://',
                    'attributes'        => array('style'=> 'width: 100%;'),
                ),
                array(
                    'id'                => 'banner_blank',
                    'type'              => 'checkbox',
                    'title'             => '',
                    'label'             => '链接新窗口打开',
                    'default'           => false
                ),
                array(
                    'id'                => 'banner_title_position',
                    'type'              => 'select',
                    'title'             => '标题/文本显示位置',
                    'options'           => array(
                        'left'          => '靠左',
                        'right'         => '靠右',
                        'center'        => '居中',
                    ),
                    'default'           => 'left',
                ),

            )
        ),

        //幻灯片下面的小块
        array(
            'id'              => 'banner_block',
            'type'            => 'group',
            'title'           => '幻灯片下面的块元素',
            'button_title'    => '添加块元素',
            'accordion_title' => '添加块元素',
            'max'             => 5,
            'fields'          => array(

                array(
                    'id'                => 'block_title',
                    'type'              => 'text',
                    'title'             => '标题',
                ),
                array(
                    'id'                => 'block_subtitle',
                    'type'              => 'textarea',
                    'title'             => '描述',
                    'attributes'        => array('style'=> 'min-height:65px;'),
                ),
                array(
                    'id'                => 'block_img',
                    'type'              => 'media',
                    'title'             => '上传图标',
                    'subtitle'          => '建议尺寸 50×50 px',
                    'settings'          => array(
                        'button_title'  => '上传图标',
                        'frame_title'   => '选择图标',
                        'insert_title'  => '插入图标',
                    ),
                ),
                array(
                    'id'                => 'block_img_px',
                    'type'              => 'slider',
                    'title'             => '图标占位',
                    'unit'              => '%',
                    'min'               => 1,
                    'max'               => 100,
                    'default'           => 20,
                ),
                array(
                    'id'                => 'block_url',
                    'type'              => 'text',
                    'title'             => '跳转链接',
                    'subtitle'          => '链接带上 http:// 或者 https://',
                    'attributes'        => array('style'=> 'width: 100%;'),
                ),
                array(
                    'id'                => 'block_blank',
                    'type'              => 'checkbox',
                    'title'             => '',
                    'label'             => '链接新窗口打开',
                    'default'           => false
                ),

            )
        ),

    ),
) );

//
// 添加首页模块
//
CSF::createSection( $prefix, array(
    'parent'   => 'home_modular',
    'title'    => '首页模块',
    //'priority' => 3,
    'fields'   => array(

        // 模块类型
        array(
            'id'                => 'index_modular',
            'type'              => 'group',
            'title'             => '添加首页模块',
            'button_title'      => '添加模块',
            'accordion_title'   => '添加模块',
            'fields'            => array(

                array(
                    'id'        => 'modular_name',
                    'type'      => 'text',
                    'title'     => '模块名称',
                    'subtitle'  => '此处的自定义名称仅用于后台标记模块使用',
                ),

                array(
                    'id'        => 'modular_type',
                    'type'      => 'image_select',
                    'title'     => '选择模块',
                    //'inline'    => true,
                    //'class'     => 'horizontal',
                    'options'   => array(
                        '1'     => get_stylesheet_directory_uri() . '/static/images/admin/index-1.png',
                        '2'     => get_stylesheet_directory_uri() . '/static/images/admin/index-2.png',
                        '3'     => get_stylesheet_directory_uri() . '/static/images/admin/index-3.png',
                        '4'     => get_stylesheet_directory_uri() . '/static/images/admin/index-4.png',
                        '5'     => get_stylesheet_directory_uri() . '/static/images/admin/index-5.png',
                        '6'     => get_stylesheet_directory_uri() . '/static/images/admin/index-6.png',
                        '7'     => get_stylesheet_directory_uri() . '/static/images/admin/index-7.png',
                        '8'     => get_stylesheet_directory_uri() . '/static/images/admin/index-8.png',
                        '9'     => get_stylesheet_directory_uri() . '/static/images/admin/index-9.png',
                        '10'    => get_stylesheet_directory_uri() . '/static/images/admin/index-10.png',
                        '11'    => get_stylesheet_directory_uri() . '/static/images/admin/index-11.png',
                        '12'    => get_stylesheet_directory_uri() . '/static/images/admin/index-12.png',
                        '13'    => get_stylesheet_directory_uri() . '/static/images/admin/index-13.png',
                        '14'    => get_stylesheet_directory_uri() . '/static/images/admin/index-14.png',
                        '15'    => get_stylesheet_directory_uri() . '/static/images/admin/index-15.png',
                        '16'    => get_stylesheet_directory_uri() . '/static/images/admin/index-16.png',
                        '17'    => get_stylesheet_directory_uri() . '/static/images/admin/index-17.png',
                        '18'    => get_stylesheet_directory_uri() . '/static/images/admin/index-18.png',
                        '19'    => get_stylesheet_directory_uri() . '/static/images/admin/index-19.png',
                        '20'    => get_stylesheet_directory_uri() . '/static/images/admin/index-20.png',
                        '21'    => get_stylesheet_directory_uri() . '/static/images/admin/index-21.png',
                        '22'    => get_stylesheet_directory_uri() . '/static/images/admin/index-22.png',
                        '23'    => get_stylesheet_directory_uri() . '/static/images/admin/index-23.png',
                        '24'    => get_stylesheet_directory_uri() . '/static/images/admin/index-24.png',
                        '25'    => get_stylesheet_directory_uri() . '/static/images/admin/index-25.png',
                        '26'    => get_stylesheet_directory_uri() . '/static/images/admin/index-26.png',
                        '27'    => get_stylesheet_directory_uri() . '/static/images/admin/index-27.png',
                        '28'    => get_stylesheet_directory_uri() . '/static/images/admin/index-28.png',
                        '36'    => get_stylesheet_directory_uri() . '/static/images/admin/index-36.png',
						'37'    => get_stylesheet_directory_uri() . '/static/images/admin/index-37.png',
                        '40'    => get_stylesheet_directory_uri() . '/static/images/admin/index-40.png',
                        '41'    => get_stylesheet_directory_uri() . '/static/images/admin/index-41.png',
                        '42'    => get_stylesheet_directory_uri() . '/static/images/admin/index-42.png',
                        '43'    => get_stylesheet_directory_uri() . '/static/images/admin/index-43.png',
                        '44'    => get_stylesheet_directory_uri() . '/static/images/admin/index-44.png',
                        '45'    => get_stylesheet_directory_uri() . '/static/images/admin/index-45.png',
                        '46'    => get_stylesheet_directory_uri() . '/static/images/admin/index-46.png',
                        '47'    => get_stylesheet_directory_uri() . '/static/images/admin/index-47.png',
						'48'    => get_stylesheet_directory_uri() . '/static/images/admin/index-48.png',
                        '49'    => get_stylesheet_directory_uri() . '/static/images/admin/index-49.png',
                        '50'    => get_stylesheet_directory_uri() . '/static/images/admin/index-50.png',
                        '51'    => get_stylesheet_directory_uri() . '/static/images/admin/index-51.png',
                        '52'    => get_stylesheet_directory_uri() . '/static/images/admin/index-52.png',
                        '53'    => get_stylesheet_directory_uri() . '/static/images/admin/index-53.png',
                    ),
                    'default'   => '1',
                ),

                /** --------------------------------------------------------------------------------- *
                 *  通用模块设置
                 *  --------------------------------------------------------------------------------- */

                // 模块显示规则
                array(
                    'id'        => 'modular_display',
                    'type'      => 'button_set',
                    'title'     => '模块显示规则',
                    'options'   => array(
                        '1'     => '默认',
                        '2'     => '仅电脑端显示',
                        '3'     => '仅手机端显示',
                    ),
                    'default'   => '1',
                ),

                // 模块背景色加深，利于区分显示
                array(
                    'id'        => 'modular_bg_f9',
                    'type'      => 'checkbox',
                    'title'     => '',
                    'label'     => '模块背景色加深，利于区分显示',
                    'default'   => false,
                    'dependency'=> array( 'modular_type', 'any', '1,2,3,6,7,8,9,10,11,12,13,15,16,18,19,20,21,22,23,24,25,26,48,49' ),
                ),

                // 手机端轮播显示
                array(
                    'id'        => 'modular_mobile_slider',
                    'type'      => 'checkbox',
                    'title'     => '',
                    'label'     => '手机端轮播显示',
                    'default'   => false,
                    'dependency'=> array( 'modular_type', 'any', '1,11,12,13' ),
                ),

                //模块标题和描述
                array(
                    'id'        => 'modular_title',
                    'type'      => 'textarea',
                    'title'     => '模块标题',
                    'default'   => '模块标题',
                    'dependency'=> array( 'modular_type', 'any', '1,2,3,4,6,7,8,9,10,11,12,13,16,18,19,20,21,22,23,24,25,26,27,36,37,40,41,42,43,44,45,46,47,51,52,53' ),
                ),
                array(
                    'id'        => 'modular_describe',
                    'type'      => 'textarea',
                    'title'     => '模块描述',
                    'default'   => '无需编码技能，您也可以创建出一个独特的网站（DQTheme）',
                    'dependency'=> array( 'modular_type', 'any', '1,2,3,4,6,7,8,9,10,11,12,13,16,18,19,20,21,22,23,24,25,26,27,36,37,40,41,43,44,45,47,51,52,53' ),
                ),
				array(
                    'id'      => 'mmodular_describe_color',
                    'type'    => 'color',
                    'title'   => '模块描述文字颜色',
                    'dependency'=> array( 'modular_type', 'any', '1,2,3,4,6,7,8,9,10,11,12,13,16,18,19,20,21,22,23,24,25,26,27,36,37,40,41,43,44,45,47,51,52,53' ),
                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-1设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'        => 'modular1_col_img_num',
                    'type'      => 'slider',
                    'title'     => '一行显示几组图片',
                    'unit'      => '组',
                    'min'       => 2,
                    'max'       => 4,
                    'default'   => 3,
                    'dependency'=> array( 'modular_type', 'any', '1' ),
                ),
                array(
                    'id'                => 'add_modular_1',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加模块内容',
                    'accordion_title'   => '添加模块内容',
                    'fields'            => array(
                        array(
                            'id'        => 'modular_1_title',
                            'type'      => 'text',
                            'title'     => '图片标题',
                        ),
                        array(
                            'id'        => 'modular_1_img',
                            'type'      => 'media',
                            'title'     => '特色图片',
                            'subtitle'  => '建议尺寸：562×331 px',
                            'settings'  => array(
                                'button_title' => '上传图片',
                                'frame_title'  => '选择图片',
                                'insert_title' => '插入图片',
                            ),
                        ),
                        array(
                            'id'         => 'modular_1_url',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                            'attributes' => array('style'=> 'width: 100%;'),
                            'subtitle'   => '链接带上 http:// 或者 https://',
                        ),
                        array(
                            'id'         => 'modular_1_url_blank',
                            'type'       => 'checkbox',
                            'title'      => '',
                            'label'      => '链接新窗口打开',
                            'default'    => false
                        ),
                    ),
                    'dependency'        => array( 'modular_type', 'any', '1' ),
                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-2、首页模块-4、首页模块-7设置
                 *  --------------------------------------------------------------------------------- */

                // 调用文章
                array(
                    'id'        => 'modular_cat_or_post',
                    'type'      => 'select',
                    'title'     => '调用内容',
                    'subtitle'  => '选择「指定分类」请勾选下分类目录，选择「指定文章」请设置一下指定文章',
                    'options'   => array(
                        '1'     => '请选择调用内容',
                        'cat'   => '指定分类',
                        'post'  => '指定文章',
                    ),
                    'default'   => '1',
                    'dependency'=> array( 'modular_type', 'any', '2,4,7' ),
                ),
                array(
                    'id'        => 'modular_category',
                    'type'      => 'select',
                    'title'     => '选择分类',
                    'chosen'    => true,
                    'multiple'  => true,
                    'sortable'  => true,
                    'options'   => 'categories',
                    'subtitle'  => '如果分类下没有文章，此处将不显示此分类目录',
                    'placeholder'=> '选择分类目录，可多选，可排序',
                    //'dependency'=> array( 'modular_cat_or_post', 'any', 'cat' ),
                    'dependency'=> array( 'modular_type', 'any', '2,4,7,12' ),
                ),
                array(
                    'id'        => 'modular_posts_id',
                    'type'      => 'select',
                    'title'     => '指定文章',
                    'chosen'    => true,
                    'multiple'  => true,
                    'sortable'  => true,
                    'ajax'      => true,
                    'options'   => 'posts',
                    'placeholder'=> '输入关键词进行搜索，不少于三个字',
                    //'dependency'=> array( 'modular_cat_or_post', 'any', 'post' ),
                    'dependency'=> array( 'modular_type', 'any', '2,4,7' ),
                ),
                // 调用文章 结束

                // 缩略图尺寸
                array(
                    'id'         => 'post_img_width',
                    'type'       => 'spinner',
                    'title'      => '图片宽度',
                    'subtitle'   => '自定义缩略图尺寸，默认宽高350*230，最小宽度350px，高度随意，如果缩略图模糊，可同比放大尺寸，没有固定尺寸，建议自己设置尺寸进行调试，达到自己满意的比例',
                    'max'        => 10000,
                    'min'        => 264,
                    'step'       => 1,
                    'unit'       => 'px',
                    'attributes' => array('style'=> 'width: 100%;'),
                    'dependency' => array( 'modular_type', 'any', '2,4,7' ),
                ),
                array(
                    'id'         => 'post_img_height',
                    'type'       => 'spinner',
                    'title'      => '图片高度',
                    //'subtitle' => 'max:1 | min:0 | step:0.1 | unit:px',
                    'max'        => 10000,
                    'min'        => 0,
                    'step'       => 1,
                    'unit'       => 'px',
                    'attributes' => array('style'=> 'width: 100%;'),
                    'dependency' => array( 'modular_type', 'any', '2,4,7' ),
                ),
                // 缩略图尺寸 结束

                // 首页模块-4 背景图片设置
                array(
                    'id'        => 'modular_4_bg',
                    'type'      => 'media',
                    'title'     => '背景图片',
                    'settings'  => array(
                        'button_title' => '上传图片',
                        'frame_title'  => '选择图片',
                        'insert_title' => '插入图片',
                    ),
                    'dependency'=> array( 'modular_type', 'any', '4' ),
                ),

                // 首页模块-7 文章数量设置
                array(
                    'id'        => 'modular7_col_post_num',
                    'type'      => 'radio',
                    'title'     => '每行显示文章数量',
                    'inline'    => true,
                    'options'   => array(
                        '3'  => '每行显示3篇',
                        '4'   => '每行显示4篇',
                    ),
                    'default'   => 3,
                    'dependency'=> array( 'modular_type', 'any', '2,7' ),
                ),
                array(
                    'id'        => 'modular7_post_num',
                    'type'      => 'number',
                    'title'     => '显示文章数量',
                    'unit'      => '篇',
                    'default'   => 6,
                    'dependency'=> array( 'modular_type', 'any', '2,7' ),
                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-3设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'    => 'modular_3',
                    'type'  => 'tabbed',
                    'title' => '',
                    'tabs'  => array(

                        array(
                            'title'  => '特点介绍',
                            'fields' => array(

                                array(
                                    'id'                => 'add_special',
                                    'type'              => 'group',
                                    'title'             => '',
                                    'button_title'      => '添加特点介绍',
                                    'accordion_title'   => '添加特点介绍',
                                    'desc'              => '如果添加后不显示内容，可尝试点击「发布」后重新编辑',
                                    'fields'            => array(
                                        array(
                                            'id'        => 'special_text',
                                            'type'      => 'text',
                                            'title'     => '特点介绍',
                                        ),
                                    ),
                                ),

                            ),
                        ),
                        array(
                            'title'  => '数字介绍',
                            'fields' => array(

                                array(
                                    'id'                => 'add_number',
                                    'type'              => 'group',
                                    'title'             => '',
                                    'button_title'      => '添加数字介绍',
                                    'accordion_title'   => '添加数字介绍',
                                    'desc'              => '如果添加后不显示内容，可尝试点击「发布」后重新编辑',
                                    'fields'            => array(
                                        array(
                                            'id'        => 'modular3_number',
                                            'type'      => 'text',
                                            'title'     => '数值',
                                        ),
                                        array(
                                            'id'        => 'modular3_number_text',
                                            'type'      => 'text',
                                            'title'     => '描述',
                                        ),
                                    ),
                                ),

                            ),
                        ),
                        array(
                            'title'  => '图片/视频',
                            'fields' => array(
                                array(
                                    'id'        => 'modular_3_img_left',
                                    'type'      => 'checkbox',
                                    'title'     => '',
                                    'label'     => '「图片/视频」区域，靠左显示',
                                    'default'   => false,
                                ),
                                array(
                                    'id'        => 'modular_3_img',
                                    'type'      => 'media',
                                    'title'     => '特色图片',
                                    'subtitle'  => '宽350px，高随意（建议430px）',
                                    'settings'  => array(
                                        'button_title' => '上传图片',
                                        'frame_title'  => '选择图片',
                                        'insert_title' => '插入图片',
                                    ),
                                ),
                                array(
                                    'id'        => 'modular_3_video',
                                    'type'      => 'textarea',
                                    'title'     => '视频链接',
                                    'subtitle'  => '视频直链，.mp4后缀，如：https://www.dqtheme.com/video.mp4<br><b>特别注意：视频链接设置与第三方视频链接，2选1即可，不可同时使用</b>',
                                    'attributes'=> array('style'=> 'width:100%;min-height:65px;'),
                                ),
                                array(
                                    'id'        => 'modular_3_video2',
                                    'type'      => 'textarea',
                                    'title'     => '第三方视频链接',
                                    'subtitle'  => '第三方视频平台分享链接，腾讯视频、优酷、爱奇艺等，比如：https://v.qq.com/txp/iframe/player.html?vid=j3162uatq40<br><b>特别注意：第三方视频链接设置与上面的视频链接设置，2选1即可，不可同时使用</b>',
                                    'attributes'=> array('style'=> 'width:100%;min-height:65px;'),
                                ),
                                array(
                                    'id'        => 'modular_3_video_text',
                                    'type'      => 'text',
                                    'title'     => '视频标题',
                                    'attributes'=> array('style'=> 'width:100%;'),
                                ),
                            ),
                        ),

                    ),
                    'dependency' => array( 'modular_type', 'any', '3' ),
                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-5设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'        => 'modular5_subtitle',
                    'type'      => 'text',
                    'title'     => '小标题',
                    'default'   => 'DQTheme',
                    'dependency'=> array( 'modular_type', 'any', '5' ),
                ),
                array(
                    'id'        => 'modular5_title',
                    'type'      => 'text',
                    'title'     => '大标题',
                    'default'   => '无需编码技能，您也可以创建出一个独特的网站',
                    'dependency'=> array( 'modular_type', 'any', '5' ),
                ),
                array(
                    'id'        => 'modular5_describe',
                    'type'      => 'textarea',
                    'title'     => '描述文本',
                    'default'   => '我们是专业的WordPress网站建设团队，提供高品质的WordPress主题。DQ主题微信公众号：www-dqtheme-com，欢迎热爱WordPress的每一位朋友关注！',
                    'dependency'=> array( 'modular_type', 'any', '5' ),
                ),
                array(
                    'id'        => 'modular5_phone',
                    'type'      => 'text',
                    'title'     => '联系电话',
                    'default'   => '138-8888-8888',
                    'dependency'=> array( 'modular_type', 'any', '5' ),
                ),
                array(
                    'id'        => 'modular5_but_title',
                    'type'      => 'text',
                    'title'     => '按钮标题',
                    'default'   => '点击访问DQ主题官网',
                    'dependency'=> array( 'modular_type', 'any', '5' ),
                ),
                array(
                    'id'        => 'modular5_but_url',
                    'type'      => 'text',
                    'title'     => '按钮跳转链接',
                    'default'   => 'https://www.dqtheme.com',
                    'dependency'=> array( 'modular_type', 'any', '5' ),
                ),
                array(
                    'id'        => 'modular5_bg_color',
                    'type'      => 'color',
                    'title'     => '模块背景颜色',
                    'default'   => '#091426',
                    'dependency'=> array( 'modular_type', 'any', '5' ),
                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-6设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'        => 'modular_6_bgimg',
                    'type'      => 'media',
                    'title'     => '模块背景图片',
                    'settings'  => array(
                        'button_title' => '上传背景图片',
                        'frame_title'  => '选择背景图片',
                        'insert_title' => '插入背景图片',
                    ),
                    'dependency'=> array( 'modular_type', 'any', '6' ),
                ),
				array(
                    'id'      => 'modular_6_bg_color',
                    'type'    => 'color',
                    'title'   => '模块背景颜色',
                    'dependency'=> array( 'modular_type', 'any', '6' ),
                ),
                array(
                    'id'                => 'add_modular_6',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加客户评价',
                    'accordion_title'   => '添加客户评价',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_6_title',
                            'type'       => 'text',
                            'title'      => '客户昵称',
                        ),
                        array(
                            'id'      => 'modular_6_title_color',
                            'type'    => 'color',
                            'title'   => '客户昵称颜色',
                        ),
                        array(
                            'id'        => 'modular_6_img',
                            'type'      => 'media',
                            'title'     => '客户头像',
                            'subtitle'  => '建议尺寸：90×90 px',
                            'settings'  => array(
                                'button_title' => '上传头像',
                                'frame_title'  => '选择头像',
                                'insert_title' => '插入头像',
                            ),
                        ),
                        array(
                            'id'         => 'modular_6_describe',
                            'type'       => 'textarea',
                            'title'      => '客户评价内容',
                        ),
                        array(
                            'id'      => 'modular_6_describe_color',
                            'type'    => 'color',
                            'title'   => '评价文字颜色',
                        ),
                    ),
                    'dependency'        => array( 'modular_type', 'any', '6' ),
                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-8设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'add_modular_8',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加联系信息',
                    'accordion_title'   => '添加联系信息',
                    'fields'            => array(
                        array(
                            'id'        => 'modular_8_title',
                            'type'      => 'text',
                            'title'     => '联系内容...',
                        ),
                array(
                    'id'         => 'modular_8_icons',
                    'type'       => 'icon',
                    'title'      => '选择图标',
                ),
				array(
                    'id'      => 'modular_8_icon_size',
                    'type'    => 'number',
                    'unit'        => 'rem',
                    'title'   => '图标大小',
				),
				array(
                    'id'      => 'modular_8_icon_color',
                    'type'    => 'color',
                    'title'   => '图标颜色',
                ),
                array(
                    'id'        => 'modular_8_icon',
                    'type'      => 'media',
                    'title'     => '联系图标',
                ),
            ),
            'dependency'        => array( 'modular_type', 'any', '8' ),
                ),
                //自定义表单文本
                array(
                    'id'                => 'modular_8_cf7_shortcode',
                    'type'              => 'textarea',
                    'title'             => '请输入CF7留言表单短代码...',
                    'dependency'        => array( 'modular_type', 'any', '8' ),
                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-9设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'add_modular_9',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加合作伙伴',
                    'accordion_title'   => '添加合作伙伴',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_9_title',
                            'type'       => 'text',
                            'title'      => '合作伙伴名字',
                        ),
                        array(
                            'id'        => 'modular_9_img',
                            'type'      => 'media',
                            'title'     => '合作伙伴Logo',
                            'subtitle'  => '建议尺寸：160×42 px',
                            'settings'  => array(
                                'button_title' => '上传Logo',
                                'frame_title'  => '选择Logo',
                                'insert_title' => '插入Logo',
                            ),
                        ),
                        array(
                            'id'         => 'modular_9_url',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                    ),
                    'dependency'        => array( 'modular_type', 'any', '9' ),
                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-10 设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'add_modular_10',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_10_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                        ),
                        array(
                            'id'         => 'modular_10_desc',
                            'type'       => 'textarea',
                            'title'      => '项目描述',
                           'attributes'=> array('style'=> 'min-height:90px;height:90px;line-height:1.6'),
                        ),
                array(
                    'id'         => 'modular_10_icons',
                    'type'       => 'icon',
                    'title'      => '选择图标',
                ),
				array(
                    'id'      => 'modular_10_icon_size',
                    'type'    => 'number',
                    'unit'        => 'rem',
                    'title'   => '图标大小',
				),
				array(
                    'id'      => 'modular_10_icon_color',
                    'type'    => 'color',
                    'title'   => '图标颜色',
                ),
                        array(
                            'id'        => 'modular_10_img',
                            'type'      => 'media',
                            'title'     => '项目图标',
                            'subtitle'  => '建议尺寸：50×50 px',
                            'settings'  => array(
                                'button_title' => '上传图标',
                                'frame_title'  => '选择图标',
                                'insert_title' => '插入图标',
                            ),
                        ),
                        array(
                            'id'        => 'modular_10_img_bg_color',
                            'type'      => 'color',
                            'title'     => '图标背景颜色',
                            'default'   => '#fcab00',
                        ),
                        array(
                            'id'         => 'modular_10_url',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                    ),
                    'dependency'        => array( 'modular_type', 'any', '10' ),
                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-11 设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'add_modular_11',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_11_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                        ),
                        array(
                            'id'         => 'modular_11_desc',
                            'type'       => 'textarea',
                            'title'      => '项目描述',
                            'attributes'=> array('style'=> 'min-height:90px;height:90px;line-height:1.6'),
                        ),
                        array(
                            'id'        => 'modular_11_img',
                            'type'      => 'media',
                            'title'     => '项目缩略图',
                            'subtitle'  => '建议尺寸：370×250 px',
                            'settings'  => array(
                                'button_title' => '上传图片',
                                'frame_title'  => '选择图片',
                                'insert_title' => '插入图片',
                            ),
                        ),
                array(
                    'id'         => 'modular_11_icons',
                    'type'       => 'icon',
                    'title'      => '选择图标',
                ),
				array(
                    'id'      => 'modular_11_icon_size',
                    'type'    => 'number',
                    'unit'        => 'rem',
                    'title'   => '图标大小',
				),
				array(
                    'id'      => 'modular_11_icon_color',
                    'type'    => 'color',
                    'title'   => '图标颜色',
                ),
                        array(
                            'id'        => 'modular_11_ico',
                            'type'      => 'media',
                            'title'     => '项目图标',
                            'subtitle'  => '建议尺寸：50×50 px',
                            'settings'  => array(
                                'button_title' => '上传图标',
                                'frame_title'  => '选择图标',
                                'insert_title' => '插入图标',
                            ),
                        ),
                        array(
                            'id'        => 'modular_11_ico_bg_color',
                            'type'      => 'color',
                            'title'     => '图标背景颜色',
                            'default'   => '#fcab00',
                        ),
                        array(
                            'id'         => 'modular_11_url',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                            'attributes' => array('style'=> 'width:100%'),
                        ),
                    ),
                    'dependency'        => array( 'modular_type', 'any', '11' ),
                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-13 设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'add_modular_13',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_13_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                        ),
                        array(
                            'id'         => 'modular_13_desc',
                            'type'       => 'textarea',
                            'title'      => '项目描述',
                        ),
                        array(
                    'id'         => 'modular_13_icons',
                    'type'       => 'icon',
                    'title'      => '选择图标',
                ),
				array(
                    'id'      => 'modular_13_icon_size',
                    'type'    => 'number',
                    'unit'        => 'rem',
                    'title'   => '图标大小',
				),
				array(
                    'id'      => 'modular_13_icon_color',
                    'type'    => 'color',
                    'title'   => '图标颜色',
                ),
                        array(
                            'id'        => 'modular_13_ico',
                            'type'      => 'media',
                            'title'     => '项目图标',
                            'subtitle'  => '建议尺寸：50×50 px',
                            'settings'  => array(
                                'button_title' => '上传图标',
                                'frame_title'  => '选择图标',
                                'insert_title' => '插入图标',
                            ),
                        ),
                        array(
                            'id'        => 'modular_13_img',
                            'type'      => 'media',
                            'title'     => '项目背景图',
                            'settings'  => array(
                                'button_title' => '上传图片',
                                'frame_title'  => '选择图片',
                                'insert_title' => '插入图片',
                            ),
                        ),
                        array(
                            'id'         => 'modular_13_url',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                        array(
                            'id'         => 'modular_13_url_text',
                            'type'       => 'text',
                            'title'      => '按钮文本',
                        ),
                    ),
                    'dependency'        => array( 'modular_type', 'any', '13' ),
                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-14 设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'        => 'modular_14_content',
                    'type'      => 'code_editor',
                    'title'     => '自定义代码',
                    'help'      => '支持html、css、js...',
                    'settings'  => array(
                        'theme'  => 'shadowfox',
                        'mode'   => 'htmlmixed',
                    ),
                    'dependency'=> array( 'modular_type', 'any', '14' ),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-15 设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'    => 'modular_15',
                    'type'  => 'tabbed',
                    'title' => '模块设置',
                    'tabs'  => array(
                        array(
                            'title'  => '内容设置',
                            'fields' => array(
                                array(
                                    'id'            => 'modular_15_title',
                                    'type'          => 'textarea',
                                    'title'         => '模块标题',
                                    'attributes'    => array('style'=> 'min-height:46px;height:46px;line-height:1.6'),
                                    //'dependency'    => array( 'modular_type', 'any', '15' ),
                                ),
                                array(
                                    'id'            => 'modular_15_desc',
                                    'type'          => 'wp_editor',
                                    'title'         => '模块内容',
                                    'height'        => '100px',
                                    'media_buttons' => false,
                                    'quicktags'     => false,
                                    //'dependency'    => array( 'modular_type', 'any', '15' ),
                                ),
                                array(
                                    'id'            => 'modular_15_btn',
                                    'type'          => 'textarea',
                                    'title'         => '按钮文本',
                                    'attributes'    => array('style'=> 'min-height:30px;height:30px;line-height:1.6'),
                                    //'dependency'    => array( 'modular_type', 'any', '15' ),
                                ),
                                array(
                                    'id'            => 'modular_15_btn_url',
                                    'type'          => 'textarea',
                                    'title'         => '按钮链接',
                                    'attributes'    => array('style'=> 'min-height:30px;height:30px;line-height:1.6'),
                                    //'dependency'    => array( 'modular_type', 'any', '15' ),
                                ),
                            ),
                        ),
                        array(
                            'title'  => '图片/图集/视频',
                            'fields' => array(
                                array(
                                    'id'            => 'modular_15_img_position',
                                    'type'          => 'radio',
                                    'title'         => '媒体显示位置',
                                    'inline'        => true,
                                    'options'       => array(
                                        'left'      => '靠左',
                                        'right'     => '靠右',
                                    ),
                                    'default'       => 'right',
                                    //'dependency'    => array( 'modular_type', 'any', '15' ),
                                ),
                                array(
                                    'id'            => 'modular_15_media_type',
                                    'type'          => 'radio',
                                    'inline'        => true,
                                    'title'         => '媒体类型',
                                    'options'       => array(
                                        'img'       => '图片',
                                        'gallery'   => '图集',
                                        'video'     => '视频',
                                    ),
                                    'default'       => 'img',
                                    //'dependency'    => array( 'modular_type', 'any', '15' ),
                                ),
                                array(
                                    'id'            => 'modular_15_img',
                                    'type'          => 'media',
                                    'title'         => '特色图片',
                                    'subtitle'      => '建议尺寸：540 × 355 px',
                                    'settings'      => array(
                                        'button_title' => '上传图片',
                                        'frame_title'  => '选择图片',
                                        'insert_title' => '插入图片',
                                    ),
                                    'dependency'    => array( 'modular_15_media_type', 'any', 'img' ),
                                ),
                                array(
                                    'id'            => 'modular_15_video',
                                    'type'          => 'textarea',
                                    'title'         => '视频链接',
                                    'subtitle'      => '视频文件的直链，而非某个平台的视频播放页面，比如：http://factory.wkbanjia.com/wp-content/uploads/2021/12/dq.mp4',
                                    'attributes'    => array('style'=> 'min-height:30px;height:30px;line-height:1.6'),
                                    'dependency'    => array( 'modular_15_media_type', 'any', 'video' ),
                                ),
                                array(
                                    'id'            => 'modular_15_video_img',
                                    'type'          => 'media',
                                    'title'         => '视频封面图片',
                                    'settings'      => array(
                                        'button_title' => '上传图片',
                                        'frame_title'  => '选择图片',
                                        'insert_title' => '插入图片',
                                    ),
                                    'dependency'    => array( 'modular_15_media_type', 'any', 'video' ),
                                ),
                                array(
                                    'id'            => 'modular_15_gallery',
                                    'type'          => 'gallery',
                                    'title'         => '上传图集',
                                    'subtitle'      => '建议上传6张图片，尺寸 200×200 px',
                                    'add_title'     => '添加图片',
                                    'edit_title'    => '编辑',
                                    'clear_title'   => '全部删除',
                                    'dependency'    => array( 'modular_15_media_type', 'any', 'gallery' ),
                                ),
                                array(
                                    'id'            => 'modular_15_img_circular',
                                    'type'          => 'checkbox',
                                    'title'         => '',
                                    'label'         => '图片增加圆角样式',
                                    'default'       => true
                                ),
                            ),
                        ),

                    ),
                    'dependency'    => array( 'modular_type', 'any', '15' ),

                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-16 设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'        => 'modular_16_img',
                    'type'      => 'media',
                    'title'     => '上传图片',
                    'settings'  => array(
                        'button_title' => '上传图片',
                        'frame_title'  => '选择图片',
                        'insert_title' => '插入图片',
                    ),
                    'dependency'    => array( 'modular_type', 'any', '16' ),
                ),
                array(
                    'id'            => 'modular_16_img_url',
                    'type'          => 'textarea',
                    'title'         => '跳转链接',
                    'attributes'    => array('style'=> 'min-height:30px;height:30px;line-height:1.6'),
                    'dependency'    => array( 'modular_type', 'any', '16' ),
                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-17 设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'            => 'modular_17_center',
                    'type'          => 'radio',
                    'title'         => '内容对齐方式',
                    'inline'        => true,
                    'options'       => array(
                        'left'      => '靠左',
                        'center'    => '居中',
                        'right'     => '靠右',
                    ),
                    'default'       => 'center',
                    'dependency'    => array( 'modular_type', 'any', '17' ),
                ),
                array(
                    'id'            => 'modular_17_title',
                    'type'          => 'textarea',
                    'title'         => '模块标题',
                    'attributes'    => array('style'=> 'min-height:46px;height:46px;line-height:1.6'),
                    'dependency'    => array( 'modular_type', 'any', '17' ),
                ),
                array(
                    'id'            => 'modular_17_desc',
                    'type'          => 'wp_editor',
                    'title'         => '模块内容',
                    'height'        => '100px',
                    'media_buttons' => false,
                    'quicktags'     => false,
                    'dependency'    => array( 'modular_type', 'any', '17' ),
                ),
                array(
                    'id'        => 'modular_17_img',
                    'type'      => 'media',
                    'title'     => '背景图片',
                    'settings'  => array(
                        'button_title' => '上传图片',
                        'frame_title'  => '选择图片',
                        'insert_title' => '插入图片',
                    ),
                    'dependency'    => array( 'modular_type', 'any', '17' ),
                ),
                array(
                    'id'    => 'modular_17_btn',
                    'type'  => 'tabbed',
                    'title' => '按钮设置',
                    'tabs'  => array(
                        array(
                            'title'  => '按钮-1',
                            'fields' => array(
                                array(
                                    'id'            => 'modular_17_btn_1',
                                    'type'          => 'textarea',
                                    'title'         => '按钮文本',
                                    'attributes'    => array('style'=> 'min-height:30px;height:30px;line-height:1.6'),
                                    //'dependency'    => array( 'modular_type', 'any', '15' ),
                                ),
                                array(
                                    'id'            => 'modular_17_btn_1_url',
                                    'type'          => 'textarea',
                                    'title'         => '按钮链接',
                                    'attributes'    => array('style'=> 'min-height:30px;height:30px;line-height:1.6'),
                                    //'dependency'    => array( 'modular_type', 'any', '15' ),
                                ),
                            ),
                        ),
                        array(
                            'title'  => '按钮-2',
                            'fields' => array(
                                array(
                                    'id'            => 'modular_17_btn_2',
                                    'type'          => 'textarea',
                                    'title'         => '按钮文本',
                                    'attributes'    => array('style'=> 'min-height:30px;height:30px;line-height:1.6'),
                                    //'dependency'    => array( 'modular_type', 'any', '15' ),
                                ),
                                array(
                                    'id'            => 'modular_17_btn_2_url',
                                    'type'          => 'textarea',
                                    'title'         => '按钮链接',
                                    'attributes'    => array('style'=> 'min-height:30px;height:30px;line-height:1.6'),
                                    //'dependency'    => array( 'modular_type', 'any', '15' ),
                                ),
                            ),
                        ),

                    ),
                    'dependency'    => array( 'modular_type', 'any', '17' ),

                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-18 设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'            => 'modular_18_col',
                    'type'          => 'radio',
                    'title'         => '每行显示数量',
                    'inline'        => true,
                    'options'       => array(
                        '6'         => '2个',
                        '4'         => '3个',
                        '3'         => '4个',
                    ),
                    'default'       => '3',
                    'dependency'    => array( 'modular_type', 'any', '18' ),
                ),
                array(
                    'id'                => 'modular_18',
                    'type'              => 'group',
                    'title'             => '模块设置',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_18_title',
                            'type'       => 'text',
                            'title'      => '标题',
                        ),
                        array(
                            'id'         => 'modular_18_desc',
                            'type'       => 'text',
                            'title'      => '描述',
                        ),
                    ),
                    'dependency'        => array( 'modular_type', 'any', '18' ),
                ),

                /** --------------------------------------------------------------------------------- *
                 *  首页模块-19 设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'modular_19',
                    'type'              => 'group',
                    'title'             => '模块设置',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_19_title',
                            'type'       => 'textarea',
                            'title'      => '标题',
                            'attributes' => array('style'=> 'min-height:30px;height:30px;line-height:1.6'),
                        ),
                        array(
                            'id'         => 'modular_19_desc',
                            'type'       => 'textarea',
                            'title'      => '描述',
                            'attributes' => array('style'=> 'min-height:90px;height:90px;line-height:1.6'),
                        ),
                        array(
                            'id'        => 'modular_19_img',
                            'type'      => 'media',
                            'title'     => '背景图片',
                            'subtitle'  => '建议尺寸：1760 × 900 px',
                            'settings'  => array(
                                'button_title' => '上传图片',
                                'frame_title'  => '选择图片',
                                'insert_title' => '插入图片',
                            ),
                        ),
                        array(
                            'id'         => 'modular_19_btn',
                            'type'       => 'textarea',
                            'title'      => '按钮文本',
                            'attributes' => array('style'=> 'min-height:30px;height:30px;line-height:1.6'),
                        ),
                        array(
                            'id'         => 'modular_19_btn_url',
                            'type'       => 'textarea',
                            'title'      => '按钮链接',
                            'attributes' => array('style'=> 'min-height:30px;height:30px;line-height:1.6'),
                        ),
                    ),
                    'dependency'            => array( 'modular_type', 'any', '19' ),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-20 设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'            => 'modular_20_ak',
                    'type'          => 'text',
                    'title'         => '应用AK',
                    'subtitle'      => '<a href="http://lbsyun.baidu.com/apiconsole/key" target="_blank" style="color:#f44336;">点我前往「百度地图开放平台」创建应用并复制AK</a>',
                    'dependency'    => array( 'modular_type', 'any', '20' ),
                ),
                array(
                    'id'            => 'modular_20_zuobiao',
                    'type'          => 'text',
                    'title'         => '地址坐标',
                    'subtitle'      => '<a href="http://api.map.baidu.com/lbsapi/getpoint/index.html" target="_blank" style="color:#f44336;">点我前往「百度地图拾取坐标系统」获取坐标</a>',
                    'dependency'    => array( 'modular_type', 'any', '20' ),
                ),
                array(
                    'id'            => 'modular_20_dzmc',
                    'type'          => 'text',
                    'title'         => '公司名称',
                    'dependency'    => array( 'modular_type', 'any', '20' ),
                ),
                array(
                    'id'            => 'modular_20_dtxxms',
                    'type'          => 'textarea',
                    'title'         => '详细描述',
                    'attributes'    => array(
                        'style'     => 'width: 100%;'
                    ),
                    'subtitle'      => '请勿直接换行，如需换行，请添加 &lt;br&gt; 标签',
                    'dependency'    => array( 'modular_type', 'any', '20' ),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-21设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'            => 'modular_21_img_circular',
                    'type'          => 'checkbox',
                    'title'         => '',
                    'label'         => '图片增加圆角样式',
                    'default'       => true,
                    'dependency'    => array( 'modular_type', 'any', '21' ),
                ),
                array(
                    'id'            => 'modular_21_col',
                    'type'          => 'radio',
                    'title'         => '每行显示数量',
                    'inline'        => true,
                    'options'       => array(
                        '6'         => '2个',
                        '4'         => '3个',
                        '3'         => '4个',
                        '55'        => '5个',
                        '2'         => '6个',
                    ),
                    'default'       => '2',
                    'dependency'    => array( 'modular_type', 'any', '21' ),
                ),
                array(
                    'id'                => 'add_modular_21',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加合作伙伴',
                    'accordion_title'   => '添加合作伙伴',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_21_title',
                            'type'       => 'text',
                            'title'      => '合作伙伴名字',
                        ),
                        array(
                            'id'        => 'modular_21_img',
                            'type'      => 'media',
                            'title'     => '合作伙伴Logo',
                            'subtitle'  => '建议尺寸：260×90 px',
                            'settings'  => array(
                                'button_title' => '上传Logo',
                                'frame_title'  => '选择Logo',
                                'insert_title' => '插入Logo',
                            ),
                        ),
                        array(
                            'id'         => 'modular_21_url',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                    ),
                    'dependency'        => array( 'modular_type', 'any', '21' ),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-22设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'add_modular_22',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_22_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                        ),
                        array(
                            'id'         => 'modular_22_desc',
                            'type'       => 'textarea',
                            'title'      => '项目描述',
                            'attributes' => array(
                                'style'  => 'width: 100%;'
                            )
                        ),
                        array(
                    'id'         => 'modular_22_icons',
                    'type'       => 'icon',
                    'title'      => '选择图标',
                ),
				array(
                    'id'      => 'modular_22_icon_size',
                    'type'    => 'number',
                    'unit'        => 'rem',
                    'title'   => '图标大小',
				),
				array(
                    'id'      => 'modular_22_icon_color',
                    'type'    => 'color',
                    'title'   => '图标颜色',
                ),
                        array(
                            'id'        => 'modular_22_img',
                            'type'      => 'media',
                            'title'     => '项目图标',
                            'desc'      => '建议尺寸：100×100 px',
                            'settings'  => array(
                                'button_title' => '上传图标',
                                'frame_title'  => '选择图标',
                                'insert_title' => '插入图标',
                            ),
                        ),
                        array(
                            'id'         => 'modular_22_url',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                    ),
                    'dependency'        => array( 'modular_type', 'any', '22' ),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-23设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'add_modular_23',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_23_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                        ),
                        array(
                            'id'         => 'modular_23_desc',
                            'type'       => 'textarea',
                            'title'      => '项目描述',
                        ),
                        
                        array(
                    'id'         => 'modular_23_icons',
                    'type'       => 'icon',
                    'title'      => '选择图标',
                ),
				array(
                    'id'      => 'modular_23_icon_size',
                    'type'    => 'number',
                    'unit'        => 'rem',
                    'title'   => '图标大小',
				),
				array(
                    'id'      => 'modular_23_icon_color',
                    'type'    => 'color',
                    'title'   => '图标颜色',
                ),
                        array(
                            'id'        => 'modular_23_img',
                            'type'      => 'media',
                            'title'     => '项目图标',
                            'desc'      => '建议尺寸：100×100 px',
                            'settings'  => array(
                                'button_title' => '上传图标',
                                'frame_title'  => '选择图标',
                                'insert_title' => '插入图标',
                            ),
                        ),
                        array(
                            'id'         => 'modular_23_url',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                    ),
                    'dependency'        => array( 'modular_type', 'any', '23' ),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-24设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'add_modular_24',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_24_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                        ),
                        array(
                            'id'         => 'modular_24_desc',
                            'type'       => 'textarea',
                            'title'      => '项目描述',
                            'attributes' => array(
                                'style'  => 'width: 100%;'
                            )
                        ),
                        array(
                            'id'        => 'modular_24_img',
                            'type'      => 'media',
                            'title'     => '背景图片',
                            'desc'      => '建议尺寸：560×280 px',
                            'settings'  => array(
                                'button_title' => '上传图片',
                                'frame_title'  => '选择图片',
                                'insert_title' => '插入图片',
                            ),
                        ),
                        array(
                            'id'         => 'modular_24_url',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                    ),
                    'dependency'        => array( 'modular_type', 'any', '24' ),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-25设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'add_modular_25',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_25_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                        ),
                        array(
                            'id'         => 'modular_25_desc',
                            'type'       => 'textarea',
                            'title'      => '项目描述',
                        ),
                        array(
                    'id'         => 'modular_25_icons',
                    'type'       => 'icon',
                    'title'      => '选择图标',
                ),
				array(
                    'id'      => 'modular_25_icon_size',
                    'type'    => 'number',
                    'unit'        => 'rem',
                    'title'   => '图标大小',
				),
				array(
                    'id'      => 'modular_25_icon_color',
                    'type'    => 'color',
                    'title'   => '图标颜色',
                ),
                        array(
                            'id'        => 'modular_25_img',
                            'type'      => 'media',
                            'title'     => '项目图标',
                            'desc'      => '建议尺寸：100×100 px',
                            'settings'  => array(
                                'button_title' => '上传图标',
                                'frame_title'  => '选择图标',
                                'insert_title' => '插入图标',
                            ),
                        ),
                        array(
                            'id'         => 'modular_25_url',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                    ),
                    'dependency'        => array( 'modular_type', 'any', '25' ),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-26设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'        => 'modular_26_google_map',
                    'type'      => 'code_editor',
                    'title'     => '谷歌地图Html代码',
                    'desc'      => '谷歌地图Html代码获取地址：https://www.google.com/maps/（搜索到位置，点击分享，嵌入滴入，复制html代码）',
                    'settings'  => array(
                        'theme'  => 'shadowfox',
                        'mode'   => 'htmlmixed',
                    ),
                    'dependency'=> array( 'modular_type', 'any', '26' ),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-27设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'add_modular_27',
                    'type'              => 'select',
                    'title'             => 'FAQ分类',
                    'chosen'            => true,
                    'multiple'          => true,
                    'options'           => 'categories',
                    'placeholder'       => '请下拉选择分类',
                    'dependency'        => array('modular_type', 'any', '27'),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-28设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'modular_28_bg_color',
                    'type'              => 'color',
                    'title'             => '背景色',
                    'default'           => '#81d742',
                    'dependency'        => array('modular_type', 'any', '28'),
                ),
                array(
                    'id'                => 'modular_28_content',
                    'type'              => 'wp_editor',
                    'title'             => '内容',
                    'media_buttons'     => false,
                    'desc'              => '请填写文字部分',
                    'dependency'        => array('modular_type', 'any', '28'),
                ),
                array(
                    'id'                => 'add_modular_28',
                    'type'              => 'textarea',
                    'title'             => '短代码',
                    'desc'              => '请填写Sendy Widget Pro的短代码',
                    'dependency'        => array('modular_type', 'any', '28'),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-36设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'add_modular_36',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(array(
                            'id'         => 'modular_36_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                        ),
                        array(
                            'id'         => 'modular_36_desc',
                            'type'       => 'textarea',
                            'title'      => '项目描述',
                            
                        ),
                        array(
                            'id'         => 'modular_36_img',
                            'type'       => 'media',
                            'title'      => '图片',
                            'settings'  => array(
			            'button_title' => '上传图片',
			            'frame_title'  => '选择图片',
			            'insert_title' => '插入图片',
		            ),
                        ),
                        array(
                            'id'         => 'modular_36_video',
                            'type'       => 'upload',
                            'title'      => '视频',
		            'settings'  => array(
			            'button_title' => '上传视频',
			            'frame_title'  => '选择视频',
			            'insert_title' => '插入视频',
		            ),
                        ),
                    ),
                    'dependency'        => array( 'modular_type', 'any', '36' ),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-37设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'add_modular_37',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(array(
                            'id'         => 'modular_37_title',
                            'type'       => 'text',
                            'title'      => '问题',
                        ),
                        array(
                            'id'         => 'modular_37_color',
                            'type'       => 'color',
                            'title'      => '标题颜色',
                        ),
                        array(
                            'id'         => 'modular_37_desc',
                            'type'       => 'textarea',
                            'title'      => '答案',
                            
                        ),
                    ),
                    'dependency'        => array( 'modular_type', 'any', '37' ),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-40设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'         => 'img_40',
                    'type'       => 'media',
                    'title'      => '图片',
                    'attributes' => array(
                        'style'  => 'width: 100%;'
                    ),
                    'desc'      => '建议尺寸：450×570 px',
                    'dependency'        => array('modular_type', 'any', '40'),
                ),
                array(
                    'id'            => 'modular_40_img_position',
                    'type'          => 'radio',
                    'title'         => '媒体显示位置',
                    'inline'        => true,
                    'options'       => array(
                        'left'      => '靠左',
                        'right'     => '靠右',
                    ),
                    'default'       => 'left',
                    'dependency'    => array( 'modular_type', 'any', '40' ),
                ),
                array(
                    'id'         => 'modular_40_licolor',
                    'type'       => 'color',
                    'title'      => '分隔符颜色',
                    'dependency'        => array('modular_type', 'any', '40'),
                ),
                array(
                    'id'                => 'add_modular_40',
                    'type'              => 'group',
                    'title'             => '文本组',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_40_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                            'attributes' => array('style' => 'width:100%'),
                        ),
                        array(
                            'id'         => 'modular_40_desc',
                            'type'       => 'textarea',
                            'title'      => '项目描述',
                            'attributes' => array('style' => 'min-height:90px;height:90px;line-height:1.6'),
                        ),
                array(
                    'id'         => 'modular_40_icons',
                    'type'       => 'icon',
                    'title'      => '选择图标',
                ),
				array(
                    'id'      => 'modular_40_icon_size',
                    'type'    => 'number',
                    'unit'        => 'rem',
                    'title'   => '图标大小',
				),
				array(
                    'id'      => 'modular_40_icon_color',
                    'type'    => 'color',
                    'title'   => '图标颜色',
                ),
                array(
                    'id'         => 'modular_40_icon_bgcolor',
                    'type'       => 'color',
                    'title'      => '背景颜色',
                    'default'   => '#fe60a1',
                ),
                        array(
                            'id'        => 'modular_40_img',
                            'type'      => 'media',
                            'title'     => '项目图标',
                            'desc'      => '建议尺寸：50×50 px',
                            'settings'  => array(
                                'button_title' => '上传图标',
                                'frame_title'  => '选择图标',
                                'insert_title' => '插入图标',
                            ),
                        ),
                    ),
                    'dependency'        => array('modular_type', 'any', '40'),
                ),
                array(
                    'id'                => 'module_40_button',
                    'type'              => 'group',
                    'title'             => '按钮组',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    //'desc'              => '第一个为左边按钮，第二个为右边按钮',
                    //'max'               => 2,
                    'fields'            => array(
                        array(
                            'id'         => 'title_40',
                            'type'       => 'text',
                            'title'      => '按钮文字',
                        ),
                        array(
                            'id'         => 'color_40',
                            'type'       => 'color',
                            'title'      => '文字颜色',
                        ),
                        array(
                            'id'         => 'background_40',
                            'type'       => 'color',
                            'title'      => '背景颜色',
                        ),
                        array(
                            'id'         => 'link_40',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                        array(
                            'id'         => 'icons_40',
                            'type'       => 'icon',
                            'title'      => '选择图标',
                        ),
                        array(
                            'id'      => 'icon_size_40',
                            'type'    => 'number',
                            'unit'        => 'rem',
                            'title'   => '图标大小',
                        ),
                        array(
                            'id'      => 'icon_color_40',
                            'type'    => 'color',
                            'title'   => '图标颜色',
                        ),
                                array(
                                    'id'        => 'icon_img_40',
                                    'type'      => 'media',
                                    'title'     => '项目图标',
                                    'desc'      => '建议尺寸：50×50 px',
                                    'settings'  => array(
                                        'button_title' => '上传图标',
                                        'frame_title'  => '选择图标',
                                        'insert_title' => '插入图标',
                                    ),
                                ),
                    ),
                    
                    'dependency'        => array('modular_type', 'any', '40'),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-41设置
                 *  --------------------------------------------------------------------------------- */
                
                 array(
                    'id'         => 'modular_41_bgcolor',
                    'type'       => 'color',
                    'title'      => '背景颜色',
                    'dependency'        => array('modular_type', 'any', '41'),
                ),
                 array(
                    'id'                => 'add_modular_41',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_41_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                            'attributes' => array('style' => 'width:100%'),
                        ),
                array(
                    'id'         => 'modular_41_icons',
                    'type'       => 'icon',
                    'title'      => '选择图标',
                ),
				array(
                    'id'      => 'modular_41_icon_size',
                    'type'    => 'number',
                    'unit'        => 'rem',
                    'title'   => '图标大小',
				),
				array(
                    'id'      => 'modular_41_icon_color',
                    'type'    => 'color',
                    'title'   => '图标颜色',
                ),
                        array(
                            'id'        => 'modular_41_img',
                            'type'      => 'media',
                            'title'     => '项目图标',
                            'desc'      => '建议尺寸：50×50 px',
                            'settings'  => array(
                                'button_title' => '上传图标',
                                'frame_title'  => '选择图标',
                                'insert_title' => '插入图标',
                            ),
                        ),
                    ),
                    'dependency'        => array('modular_type', 'any', '41'),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-42设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'add_modular_42',
                    'type'              => 'group',
                    'title'             => '图标组',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_42_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                            'attributes' => array('style' => 'width:100%'),
                        ),
                array(
                    'id'         => 'modular_42_icons',
                    'type'       => 'icon',
                    'title'      => '选择图标',
                ),
				array(
                    'id'      => 'modular_42_icon_size',
                    'type'    => 'number',
                    'unit'        => 'rem',
                    'title'   => '图标大小',
				),
				array(
                    'id'      => 'modular_42_icon_color',
                    'type'    => 'color',
                    'title'   => '图标颜色',
                ),
                        array(
                            'id'        => 'modular_42_img',
                            'type'      => 'media',
                            'title'     => '项目图标',
                            'desc'      => '建议尺寸：50×50 px',
                            'settings'  => array(
                                'button_title' => '上传图标',
                                'frame_title'  => '选择图标',
                                'insert_title' => '插入图标',
                            ),
                        ),
                        array(
                            'id'        => 'modular_42_content',
                            'type'      => 'wp_editor',
                            'title'     => '自定义代码',
                            'help'      => '支持html、css、js...',
                            'settings'  => array(
                                'theme'  => 'shadowfox',
                                'mode'   => 'htmlmixed',
                            ),
                        ),
                        
                    ),
                    'dependency'        => array('modular_type', 'any', '42'),
                ),
                array(
                    'id'                => 'module_42_button',
                    'type'              => 'group',
                    'title'             => '按钮组',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'title_42',
                            'type'       => 'text',
                            'title'      => '按钮文字',
                        ),
                        array(
                            'id'         => 'color_42',
                            'type'       => 'color',
                            'title'      => '文字颜色',
                            'default'   => '#fff',
                        ),
                        array(
                            'id'         => 'background_42',
                            'type'       => 'color',
                            'title'      => '背景颜色',
                        ),
                        array(
                            'id'         => 'link_42',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                    ),
                    
                    'dependency'        => array('modular_type', 'any', '42'),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-43设置
                 *  --------------------------------------------------------------------------------- */
                
                 array(
                    'id'         => 'modular_43_color',
                    'type'       => 'color',
                    'title'      => '控件颜色',
                    'dependency'        => array('modular_type', 'any', '43'),
                ),
                array(
                    'id'                => 'add_modular_43',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_43_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                            'attributes' => array('style' => 'width:100%'),
                        ),
                        array(
                            'id'         => 'modular_43_img',
                            'type'       => 'media',
                            'title'      => '图片',
                            'attributes' => array(
                                'style'  => 'width: 100%;'
                            ),
                            'desc'      => '建议尺寸：1:1',
                        ),
                        array(
                            'id'         => 'odular_43_link',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                    ),
                    'dependency'        => array('modular_type', 'any', '43'),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-44设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'         => 'modular_44_desc',
                    'type'       => 'text',
                    'title'      => '模块小标题',
                    'attributes' => array('style' => 'width:100%'),
                    'dependency'        => array('modular_type', 'any', '44'),
                ),
				array(
                    'id'      => 'modular_44_desc_color',
                    'type'    => 'color',
                    'title'   => '小标题颜色',
                    'dependency'        => array('modular_type', 'any', '44'),
                ),
                array(
                    'id'         => 'modular_44_img',
                    'type'       => 'media',
                    'title'      => '图片',
                    'attributes' => array(
                        'style'  => 'width: 100%;'
                    ),
                    'desc'      => '建议尺寸：450×570 px',
                    'dependency'        => array('modular_type', 'any', '44'),
                ),
                array(
                    'id'         => 'modular_44_bgcolor',
                    'type'       => 'color',
                    'title'      => '背景色',
                    'dependency'        => array('modular_type', 'any', '44'),
                ),
                array(
                    'id'                => 'add_modular_44',
                    'type'              => 'group',
                    'title'             => '图标组',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_44_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                            'attributes' => array('style' => 'width:100%'),
                        ),
                        array(
                            'id'         => 'modular_44_descs',
                            'type'       => 'textarea',
                            'title'      => '项目描述',
                            'attributes' => array('style' => 'min-height:90px;height:90px;line-height:1.6'),
                        ),
                        array(
                            'id'         => 'modular_44_icons',
                            'type'       => 'icon',
                            'title'      => '选择图标',
                        ),
                        array(
                            'id'      => 'modular_44_icon_size',
                            'type'    => 'number',
                            'unit'        => 'rem',
                            'title'   => '图标大小',
                        ),
                        array(
                            'id'      => 'modular_44_icon_color',
                            'type'    => 'color',
                            'title'   => '图标颜色',
                        ),
                                array(
                                    'id'        => 'modular_42_img',
                                    'type'      => 'media',
                                    'title'     => '项目图标',
                                    'desc'      => '建议尺寸：50×50 px',
                                    'settings'  => array(
                                        'button_title' => '上传图标',
                                        'frame_title'  => '选择图标',
                                        'insert_title' => '插入图标',
                                    ),
                                ),
                    ),
                    'dependency'        => array('modular_type', 'any', '44'),
                ),
                array(
                    'id'                => 'module_44_button',
                    'type'              => 'group',
                    'title'             => '按钮组',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'title_44',
                            'type'       => 'text',
                            'title'      => '按钮文字',
                        ),
                        array(
                            'id'         => 'color_44',
                            'type'       => 'color',
                            'title'      => '按钮背景色',
                        ),
                        array(
                            'id'         => 'link_44',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                    ),
                    
                    'dependency'        => array('modular_type', 'any', '44'),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-45设置
                 *  --------------------------------------------------------------------------------- */
                 array(
                    'id'         => 'modular_45_licolor',
                    'type'       => 'color',
                    'title'      => '分隔符颜色',
                    'dependency'        => array('modular_type', 'any', '45'),
                ),
                 array(
                    'id'                => 'add_modular_45',
                    'type'              => 'group',
                    'title'             => '图文组',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_45_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                            'attributes' => array('style' => 'width:100%'),
                        ),
                        array(
                            'id'         => 'modular_45_img',
                            'type'       => 'media',
                            'title'      => '图片',
                            'attributes' => array(
                                'style'  => 'width: 100%;'
                            ),
                            'desc'      => '建议白底图',
                        ),
                        array(
                            'id'         => 'modular_45_link',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                        array(
                            'id'         => 'modular_45_color',
                            'type'       => 'color',
                            'title'      => '文字颜色',
                        ),
                    ),
                    'dependency'        => array('modular_type', 'any', '45'),
                ),
                array(
                    'id'                => 'module_45_button',
                    'type'              => 'group',
                    'title'             => '按钮组',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'title_45',
                            'type'       => 'text',
                            'title'      => '按钮文字',
                        ),
                        array(
                            'id'         => 'color_45',
                            'type'       => 'color',
                            'title'      => '文字颜色',
                        ),
                        array(
                            'id'         => 'link_45',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                    ),
                    
                    'dependency'        => array('modular_type', 'any', '45'),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-46设置
                 *  --------------------------------------------------------------------------------- */
                
                 array(
                    'id'                => 'add_modular_46_1',
                    'type'              => 'group',
                    'title'             => '组一',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_46_1_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                            'attributes' => array('style' => 'width:100%'),
                        ),
                        array(
                            'id'      => 'modular_46_1_bg_color',
                            'type'    => 'color',
                            'title'   => '背景颜色',
                            'default'   => '#8224e3',
                        ),
                        array(
                            'id'         => 'modular_46_1_icons',
                            'type'       => 'icon',
                            'title'      => '选择图标',
                        ),
                        array(
                            'id'      => 'modular_46_1_icon_size',
                            'type'    => 'number',
                            'unit'        => 'rem',
                            'title'   => '图标大小',
                        ),
                        array(
                            'id'      => 'modular_46_1_icon_color',
                            'type'    => 'color',
                            'title'   => '图标颜色',
                        ),
                                array(
                                    'id'        => 'modular_46_1_img',
                                    'type'      => 'media',
                                    'title'     => '项目图标',
                                    'desc'      => '建议尺寸：50×50 px',
                                    'settings'  => array(
                                        'button_title' => '上传图标',
                                        'frame_title'  => '选择图标',
                                        'insert_title' => '插入图标',
                                    ),
                                ),
                                array(
                                    'id'      => 'modular_46_1_num_color',
                                    'type'    => 'color',
                                    'title'   => '序号图标颜色',
                                    'default'   => '#FBBDFB',
                                ),
                        array(
                            'id'                => 'add_modular_46_1s',
                            'type'              => 'group',
                            'title'             => '文本',
                            'button_title'      => '添加项目',
                            'accordion_title'   => '添加项目',
                            'fields'            => array(
                                array(
                                    'id'         => 'modular_46_1_desc',
                                    'type'       => 'textarea',
                                    'title'      => '项目描述',
                                    'attributes' => array('style' => 'width:100%'),
                                ),
                                array(
                                    'id'      => 'modular_46_1_text_color',
                                    'type'    => 'color',
                                    'title'   => '文本颜色',
                                    'default'   => '#000',
                                ),
                            ),
                        ),
                    ),
                    'dependency'        => array('modular_type', 'any', '46'),
                ),
                array(
                    'id'                => 'add_modular_46_2',
                    'type'              => 'group',
                    'title'             => '组二',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_46_2_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                            'attributes' => array('style' => 'width:100%'),
                        ),
                        array(
                            'id'      => 'modular_46_2_bg_color',
                            'type'    => 'color',
                            'title'   => '背景颜色',
                            'default'   => '#181818',
                        ),
                        array(
                            'id'         => 'modular_46_2_icons',
                            'type'       => 'icon',
                            'title'      => '选择图标',
                        ),
                        array(
                            'id'      => 'modular_46_2_icon_size',
                            'type'    => 'number',
                            'unit'        => 'rem',
                            'title'   => '图标大小',
                        ),
                        array(
                            'id'      => 'modular_46_2_icon_color',
                            'type'    => 'color',
                            'title'   => '图标颜色',
                        ),
                                array(
                                    'id'        => 'modular_46_2_img',
                                    'type'      => 'media',
                                    'title'     => '项目图标',
                                    'desc'      => '建议尺寸：50×50 px',
                                    'settings'  => array(
                                        'button_title' => '上传图标',
                                        'frame_title'  => '选择图标',
                                        'insert_title' => '插入图标',
                                    ),
                                ),
                                array(
                                    'id'      => 'modular_46_2_num_color',
                                    'type'    => 'color',
                                    'title'   => '序号图标颜色',
                                    'default'   => '#FBBDFB',
                                ),
                        array(
                            'id'                => 'add_modular_46_2s',
                            'type'              => 'group',
                            'title'             => '文本',
                            'button_title'      => '添加项目',
                            'accordion_title'   => '添加项目',
                            'fields'            => array(
                                array(
                                    'id'         => 'modular_46_2_desc',
                                    'type'       => 'textarea',
                                    'title'      => '项目描述',
                                    'attributes' => array('style' => 'width:100%'),
                                ),
                                array(
                                    'id'      => 'modular_46_2_text_color',
                                    'type'    => 'color',
                                    'title'   => '文本颜色',
                                    'default'   => '#000',
                                ),
                            ),
                        ),
                    ),
                    'dependency'        => array('modular_type', 'any', '46'),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-47设置
                 *  --------------------------------------------------------------------------------- */

                array(
                    'id'         => 'modular_47_video',
                    'type'       => 'upload',
                    'title'      => '直连视频',
                    'settings'  => array(
                        'button_title' => '上传视频',
                        'frame_title'  => '选择视频',
                        'insert_title' => '插入视频',
                    ),
                    'desc'      => '直连视频地址和YuToube视频填一个即可',
                    'dependency'        => array('modular_type', 'any', '47'),
                ),
                array(
                    'id'         => 'modular_47_video_img',
                    'type'       => 'media',
                    'title'      => '图片',
                    'attributes' => array(
                        'style'  => 'width: 100%;'
                    ),
                    'desc'      => '直连视频封面，不设置则不显示',
                    'dependency'        => array('modular_type', 'any', '47'),
                ),
                array(
                    'id'         => 'modular_47_video_ytb',
                    'type'       => 'text',
                    'title'      => 'YuToube视频ID',
                    'desc'      => '例如：https://www.youtube.com/watch?v=IkJVA150zPY，视频ID就是：IkJVA150zPY',
                    'dependency'        => array('modular_type', 'any', '47'),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-48 设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'    => 'modular_48',
                    'type'  => 'tabbed',
                    'title' => '模块设置',
                    'tabs'  => array(
                        array(
                            'title'  => '内容设置',
                            'fields' => array(
                                array(
                                    'id'            => 'modular_48_title',
                                    'type'          => 'textarea',
                                    'title'         => '模块标题',
                                    'attributes'    => array('style' => 'min-height:46px;height:46px;line-height:1.6'),
                                    //'dependency'    => array( 'modular_type', 'any', '48' ),
                                ),
                                array(
                                    'id'            => 'modular_48_desc',
                                    'type'          => 'wp_editor',
                                    'title'         => '模块内容',
                                    'height'        => '100px',
                                    'media_buttons' => false,
                                    'quicktags'     => false,
                                    //'dependency'    => array( 'modular_type', 'any', '48' ),
                                ),
                                array(
                                    'id'            => 'modular_48_btnduan',
                                    'type'          => 'textarea',
                                    'title'         => 'STD短代码',
                                    'attributes'    => array('style' => 'min-height:30px;height:30px;line-height:1.6'),
                                    //'dependency'    => array( 'modular_type', 'any', '15' ),
                                ),
                                array(
                                    'id'                => 'module_48_button',
                                    'type'              => 'group',
                                    'title'             => '按钮组',
                                    'button_title'      => '添加项目',
                                    'accordion_title'   => '添加项目',
                                    //'desc'              => '第一个为左边按钮，第二个为右边按钮',
                                    //'max'               => 2,
                                    'fields'            => array(
                                        array(
                                        'id'         => 'modular_48_icons',
                                        'type'       => 'icon',
                                        'title'      => '选择图标',
                                    ),
                                    array(
                                        'id'      => 'modular_48_icon_size',
                                        'type'    => 'number',
                                        'unit'        => 'rem',
                                        'title'   => '图标大小',
                                    ),
                                    array(
                                        'id'      => 'modular_48_icon_color',
                                        'type'    => 'color',
                                        'title'   => '图标颜色',
                                    ),
                                        array(
                                            'id'         => 'title_48',
                                            'type'       => 'text',
                                            'title'      => '按钮文字',
                                        ),
                                        array(
                                            'id'         => 'color_48',
                                            'type'       => 'color',
                                            'title'      => '文字颜色',
                                        ),
                                        array(
                                            'id'         => 'background_48',
                                            'type'       => 'color',
                                            'title'      => '背景颜色',
                                        ),
                                        array(
                                            'id'         => 'link_48',
                                            'type'       => 'text',
                                            'title'      => '跳转链接',
                                        ),
                                    ),
                                    //'dependency'        => array('modular_type', 'any', '48'),
                                ),
                            ),
                        ),
                        array(
                            'title'  => '图片/图集/视频',
                            'fields' => array(
                                array(
                                    'id'            => 'modular_48_img_position',
                                    'type'          => 'radio',
                                    'title'         => '媒体显示位置',
                                    'inline'        => true,
                                    'options'       => array(
                                        'left'      => '靠左',
                                        'right'     => '靠右',
                                    ),
                                    'default'       => 'right',
                                    //'dependency'    => array( 'modular_type', 'any', '48' ),
                                ),
                                array(
                                    'id'            => 'modular_48_media_type',
                                    'type'          => 'radio',
                                    'inline'        => true,
                                    'title'         => '媒体类型',
                                    'options'       => array(
                                        'img'       => '图片',
                                        'gallery'   => '图集',
                                        'video'     => '视频',
                                    ),
                                    'default'       => 'img',
                                    //'dependency'    => array( 'modular_type', 'any', '48' ),
                                ),
                                array(
                                    'id'            => 'modular_48_img',
                                    'type'          => 'media',
                                    'title'         => '特色图片',
                                    'desc'          => '建议尺寸：540 × 355 px',
                                    'settings'      => array(
                                        'button_title' => '上传图片',
                                        'frame_title'  => '选择图片',
                                        'insert_title' => '插入图片',
                                    ),
                                    'dependency'    => array('modular_48_media_type', 'any', 'img'),
                                ),
                                array(
                                    'id'            => 'modular_48_video',
                                    'type'          => 'textarea',
                                    'title'         => '视频链接',
                                    'desc'          => '视频文件的直链，而非某个平台的视频播放页面，比如：http://factory.wkbanjia.com/wp-content/uploads/2021/12/dq.mp4',
                                    'attributes'    => array('style' => 'min-height:30px;height:30px;line-height:1.6'),
                                    'dependency'    => array('modular_48_media_type', 'any', 'video'),
                                ),
                                array(
                                    'id'            => 'modular_48_video_img',
                                    'type'          => 'media',
                                    'title'         => '视频封面图片',
                                    'settings'      => array(
                                        'button_title' => '上传图片',
                                        'frame_title'  => '选择图片',
                                        'insert_title' => '插入图片',
                                    ),
                                    'dependency'    => array('modular_48_media_type', 'any', 'video'),
                                ),
                                array(
                                    'id'            => 'modular_48_gallery',
                                    'type'          => 'gallery',
                                    'title'         => '上传图集',
                                    'desc'          => '建议上传6张图片，尺寸 200×200 px',
                                    'add_title'     => '添加图片',
                                    'edit_title'    => '编辑',
                                    'clear_title'   => '全部删除',
                                    'dependency'    => array('modular_48_media_type', 'any', 'gallery'),
                                ),
                                array(
                                    'id'            => 'modular_48_img_circular',
                                    'type'          => 'checkbox',
                                    'title'         => '',
                                    'label'         => '图片增加圆角样式',
                                    'default'       => true
                                ),
                            ),
                        ),

                    ),
                    'dependency'    => array('modular_type', 'any', '48'),

                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-49 设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'    => 'modular_49',
                    'type'  => 'tabbed',
                    'title' => '模块设置',
                    'tabs'  => array(
                        array(
                            'title'  => '内容设置',
                            'fields' => array(
                                array(
                                    'id'            => 'modular_49_title',
                                    'type'          => 'textarea',
                                    'title'         => '模块标题',
                                    'attributes'    => array('style' => 'min-height:46px;height:46px;line-height:1.6'),
                                    //'dependency'    => array( 'modular_type', 'any', '49' ),
                                ),
                                array(
                                    'id'            => 'modular_49_desc',
                                    'type'          => 'wp_editor',
                                    'title'         => '模块内容',
                                    'height'        => '100px',
                                    'media_buttons' => false,
                                    'quicktags'     => false,
                                    //'dependency'    => array( 'modular_type', 'any', '49' ),
                                ),
                                array(
                                    'id'            => 'modular_49_btnduan',
                                    'type'          => 'textarea',
                                    'title'         => 'STD短代码',
                                    'attributes'    => array('style' => 'min-height:30px;height:30px;line-height:1.6'),
                                    //'dependency'    => array( 'modular_type', 'any', '15' ),
                                ),
                                array(
                                    'id'                => 'module_49_button',
                                    'type'              => 'group',
                                    'title'             => '按钮组',
                                    'button_title'      => '添加项目',
                                    'accordion_title'   => '添加项目',
                                    //'desc'              => '第一个为左边按钮，第二个为右边按钮',
                                    //'max'               => 2,
                                    'fields'            => array(
                                        array(
                                        'id'         => 'modular_49_icons',
                                        'type'       => 'icon',
                                        'title'      => '选择图标',
                                    ),
                                    array(
                                        'id'      => 'modular_49_icon_size',
                                        'type'    => 'number',
                                        'unit'        => 'rem',
                                        'title'   => '图标大小',
                                    ),
                                    array(
                                        'id'      => 'modular_49_icon_color',
                                        'type'    => 'color',
                                        'title'   => '图标颜色',
                                    ),
                                        array(
                                            'id'         => 'title_49',
                                            'type'       => 'text',
                                            'title'      => '按钮文字',
                                        ),
                                        array(
                                            'id'         => 'color_49',
                                            'type'       => 'color',
                                            'title'      => '文字颜色',
                                        ),
                                        array(
                                            'id'         => 'background_49',
                                            'type'       => 'color',
                                            'title'      => '背景颜色',
                                        ),
                                        array(
                                            'id'         => 'link_49',
                                            'type'       => 'text',
                                            'title'      => '跳转链接',
                                        ),
                                    ),
                                    //'dependency'        => array('modular_type', 'any', '49'),
                                ),
                            ),
                        ),
                        array(
                            'title'  => '图文内容',
                            'fields' => array(
                                array(
                                    'id'            => 'modular_49_img_position',
                                    'type'          => 'radio',
                                    'title'         => '媒体显示位置',
                                    'inline'        => true,
                                    'options'       => array(
                                        'left'      => '靠左',
                                        'right'     => '靠右',
                                    ),
                                    'default'       => 'left',
                                    //'dependency'    => array( 'modular_type', 'any', '49' ),
                                ),
                                array(
                                    'id'                => 'module_49_img',
                                    'type'              => 'group',
                                    'title'             => '图文组',
                                    'button_title'      => '添加项目',
                                    'accordion_title'   => '添加项目',
                                    'fields'            => array(
                                        array(
                                            'id'         => 'title',
                                            'type'       => 'text',
                                            'title'      => '标题',
                                        ),
                                        array(
                                            'id'         => 'img',
                                            'type'       => 'media',
                                            'title'      => '图片',
                                            'attributes' => array(
                                                'style'  => 'width: 100%;'
                                            )
                                        ),
                                    ),
                                ),
                            ),
                        ),

                    ),
                    'dependency'    => array('modular_type', 'any', '49'),

                ),
                
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-50 设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'    => 'modular_50',
                    'type'  => 'tabbed',
                    'title' => '模块设置',
                    'tabs'  => array(
                        array(
                            'title'  => '页头/页尾设置',
                            'fields' => array(
                                array(
                                    'id'            => 'modular_50_title',
                                    'type'          => 'textarea',
                                    'title'         => '版头标题',
                                    'attributes'    => array('style' => 'min-height:46px;height:46px;line-height:1.6'),
                                    //'dependency'    => array( 'modular_type', 'any', '49' ),
                                ),
                                array(
                                    'id'            => 'modular_50_desc',
                                    'type'          => 'wp_editor',
                                    'title'         => '版头描述',
                                    'height'        => '100px',
                                    'media_buttons' => false,
                                    'quicktags'     => false,
                                    //'dependency'    => array( 'modular_type', 'any', '49' ),
                                ),
                                array(
                                    'id'            => 'modular_50_title_footer',
                                    'type'          => 'textarea',
                                    'title'         => '版尾标题',
                                    'attributes'    => array('style' => 'min-height:46px;height:46px;line-height:1.6'),
                                    //'dependency'    => array( 'modular_type', 'any', '49' ),
                                ),
                                array(
                                    'id'            => 'modular_50_desc_footer',
                                    'type'          => 'wp_editor',
                                    'title'         => '版尾描述',
                                    'height'        => '100px',
                                    'media_buttons' => false,
                                    'quicktags'     => false,
                                    //'dependency'    => array( 'modular_type', 'any', '49' ),
                                ),
                                array(
                                    'id'            => 'modular_50_btnduan_footer',
                                    'type'          => 'textarea',
                                    'title'         => '版尾STD短代码',
                                    'attributes'    => array('style' => 'min-height:30px;height:30px;line-height:1.6'),
                                    //'dependency'    => array( 'modular_type', 'any', '15' ),
                                ),
                                array(
                                    'id'                => 'module_50_button_footer',
                                    'type'              => 'group',
                                    'title'             => '版尾按钮组',
                                    'button_title'      => '添加版尾按钮',
                                    'accordion_title'   => '添加版尾按钮',
                                    //'desc'              => '第一个为左边按钮，第二个为右边按钮',
                                    //'max'               => 2,
                                    'fields'            => array(
                                        array(
                                            'id'         => 'modular_50_icons_footer',
                                            'type'       => 'icon',
                                            'title'      => '选择图标',
                                        ),
                                        array(
                                            'id'      => 'modular_50_icon_size_footer',
                                            'type'    => 'number',
                                            'unit'        => 'rem',
                                            'title'   => '图标大小',
                                        ),
                                        array(
                                            'id'      => 'modular_50_icon_color_footer',
                                            'type'    => 'color',
                                            'title'   => '图标颜色',
                                        ),
                                        array(
                                            'id'         => 'title_50_footer',
                                            'type'       => 'text',
                                            'title'      => '按钮文字',
                                        ),
                                        array(
                                            'id'         => 'color_50_footer',
                                            'type'       => 'color',
                                            'title'      => '文字颜色',
                                        ),
                                        array(
                                            'id'         => 'background_50_footer',
                                            'type'       => 'color',
                                            'title'      => '背景颜色',
                                        ),
                                        array(
                                            'id'         => 'link_50_footer',
                                            'type'       => 'text',
                                            'title'      => '跳转链接',
                                        ),
                                    ),
                                    //'dependency'        => array('modular_type', 'any', '49'),
                                ),
                            ),
                        ),
                        array(
                            'title'  => '图文内容',
                            'fields' => array(
                                array(
                                    'id'                => 'module_50_img',
                                    'type'              => 'group',
                                    'title'             => '图文组',
                                    'button_title'      => '添加项目',
                                    'accordion_title'   => '添加项目',
                                    'fields'            => array(
                                        array(
                                            'id'         => 'title',
                                            'type'       => 'text',
                                            'title'      => '标题',
                                        ),
                                        array(
                                            'id'         => 'desc',
                                            'type'          => 'wp_editor',
                                            'title'         => '描述',
                                            'height'        => '100px',
                                            'media_buttons' => false,
                                            'quicktags'     => false,
                                        ),
                                        array(
                                            'id'         => 'img',
                                            'type'       => 'media',
                                            'title'      => '图片',
                                            'attributes' => array(
                                                'style'  => 'width: 100%;'
                                            )
                                        ),
                                        array(
                                            'id'            => 'modular_50_btnduan',
                                            'type'          => 'textarea',
                                            'title'         => 'STD短代码',
                                            'attributes'    => array('style' => 'min-height:30px;height:30px;line-height:1.6'),
                                            //'dependency'    => array( 'modular_type', 'any', '15' ),
                                        ),
                                        array(
                                            'id'                => 'module_50_button',
                                            'type'              => 'group',
                                            'title'             => '按钮组',
                                            'button_title'      => '添加按钮',
                                            'accordion_title'   => '添加按钮',
                                            //'desc'              => '第一个为左边按钮，第二个为右边按钮',
                                            //'max'               => 2,
                                            'fields'            => array(
                                                array(
                                                    'id'         => 'modular_50_icons',
                                                    'type'       => 'icon',
                                                    'title'      => '选择图标',
                                                ),
                                                array(
                                                    'id'      => 'modular_50_icon_size',
                                                    'type'    => 'number',
                                                    'unit'        => 'rem',
                                                    'title'   => '图标大小',
                                                ),
                                                array(
                                                    'id'      => 'modular_50_icon_color',
                                                    'type'    => 'color',
                                                    'title'   => '图标颜色',
                                                ),
                                                array(
                                                    'id'         => 'title_50',
                                                    'type'       => 'text',
                                                    'title'      => '按钮文字',
                                                ),
                                                array(
                                                    'id'         => 'color_50',
                                                    'type'       => 'color',
                                                    'title'      => '文字颜色',
                                                ),
                                                array(
                                                    'id'         => 'background_50',
                                                    'type'       => 'color',
                                                    'title'      => '背景颜色',
                                                ),
                                                array(
                                                    'id'         => 'link_50',
                                                    'type'       => 'text',
                                                    'title'      => '跳转链接',
                                                ),
                                            ),
                                            //'dependency'        => array('modular_type', 'any', '49'),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'dependency'    => array('modular_type', 'any', '50'),
                ),
                
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-51设置
                 *  --------------------------------------------------------------------------------- */
                 array(
                    'id'                => 'add_modular_51',
                    'type'              => 'group',
                    'title'             => '图文组',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_51_img',
                            'type'       => 'media',
                            'title'      => '图片',
                            'attributes' => array(
                                'style'  => 'width: 100%;'
                            ),
                        ),
                        array(
                            'id'         => 'modular_51_title',
                            'type'       => 'text',
                            'title'      => '项目标题',
                            'attributes' => array('style' => 'width:100%'),
                        ),
                        array(
                            'id'         => 'modular_51_color',
                            'type'       => 'color',
                            'title'      => '标题文字颜色',
                        ),
                        array(
                            'id'            => 'modular_51_btnduan',
                            'type'          => 'textarea',
                            'title'         => 'STD短代码',
                            'attributes'    => array('style' => 'min-height:30px;height:30px;line-height:1.6'),
                            'desc'      => '与跳转链接二选一',
                        ),
                        array(
                            'id'         => 'modular_51_icons',
                            'type'       => 'icon',
                            'title'      => '选择图标',
                        ),
                        array(
                            'id'      => 'modular_51_icon_size',
                            'type'    => 'number',
                            'unit'        => 'rem',
                            'title'   => '图标大小',
                        ),
                        array(
                            'id'      => 'modular_51_icon_color',
                            'type'    => 'color',
                            'title'   => '图标颜色',
                        ),
                        array(
                            'id'         => 'title_51',
                            'type'       => 'text',
                            'title'      => '按钮文字',
                        ),
                        array(
                            'id'         => 'color_51',
                            'type'       => 'color',
                            'title'      => '按钮文字颜色',
                        ),
                        array(
                            'id'         => 'background_51',
                            'type'       => 'color',
                            'title'      => '背景颜色',
                        ),
                        array(
                            'id'         => 'link_51',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                            'desc'      => '与STD代码二选一',
                        ),
                    ),
                    'dependency'        => array('modular_type', 'any', '51'),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-52设置
                 *  --------------------------------------------------------------------------------- */
                array(
                    'id'                => 'add_modular_52',
                    'type'              => 'group',
                    'title'             => '图文组',
                    'button_title'      => '添加项目',
                    'accordion_title'   => '添加项目',
                    'fields'            => array(
                        array(
                            'id'            => 'modular_52_media_type',
                            'type'          => 'radio',
                            'inline'        => true,
                            'title'         => '媒体类型',
                            'options'       => array(
                                'img'       => '图片',
                                'video'     => '视频',
                            ),
                            'default'       => 'img',
                        ),
                        array(
                            'id'            => 'modular_52_img',
                            'type'          => 'media',
                            'title'         => '特色图片',
                            'desc'          => '建议尺寸：540 × 355 px',
                            'settings'      => array(
                                'button_title' => '上传图片',
                                'frame_title'  => '选择图片',
                                'insert_title' => '插入图片',
                            ),
                            'dependency'    => array('modular_52_media_type', 'any', 'img'),
                        ),
                        array(
                            'id'            => 'modular_52_video',
                            'type'          => 'upload',
                            'title'         => '视频链接',
                            'desc'          => '视频文件的直链，而非某个平台的视频播放页面，比如：http://factory.wkbanjia.com/wp-content/uploads/2021/12/dq.mp4',
                            'attributes'    => array('style' => 'min-height:30px;height:30px;line-height:1.6'),
                            'dependency'    => array('modular_52_media_type', 'any', 'video'),
                        ),
                        array(
                            'id'            => 'modular_52_video_img',
                            'type'          => 'media',
                            'title'         => '视频封面图片',
                            'settings'      => array(
                                'button_title' => '上传图片',
                                'frame_title'  => '选择图片',
                                'insert_title' => '插入图片',
                            ),
                            'dependency'    => array('modular_52_media_type', 'any', 'video'),
                        ),
                        array(
                            'id'         => 'modular_52_title',
                            'type'       => 'text',
                            'title'      => '标题文字',
                            'attributes' => array('style' => 'width:100%'),
                        ),
                        array(
                            'id'         => 'modular_52_title_color',
                            'type'       => 'color',
                            'title'      => '标题文字颜色',
                        ),
                        array(
                            'id'         => 'modular_52_desc',
                            'type'       => 'text',
                            'title'      => '描述文字',
                            'attributes' => array('style' => 'width:100%'),
                        ),
                        array(
                            'id'         => 'modular_52_desc_color',
                            'type'       => 'color',
                            'title'      => '描述文字颜色',
                        ),
                    ),
                    'dependency'        => array('modular_type', 'any', '52'),
                    ),
                        array(
                            'id'                => 'add_modular_52_btn',
                            'type'              => 'group',
                            'title'             => '按钮组',
                            'button_title'      => '添加按钮',
                            'accordion_title'   => '添加按钮',
                            'fields'            => array(
                        array(
                            'id'         => 'modular_52_icons',
                            'type'       => 'icon',
                            'title'      => '选择图标',
                        ),
                        array(
                            'id'      => 'modular_52_icon_size',
                            'type'    => 'number',
                            'unit'        => 'rem',
                            'title'   => '图标大小',
                        ),
                        array(
                            'id'      => 'modular_52_icon_color',
                            'type'    => 'color',
                            'title'   => '图标颜色',
                        ),
                        array(
                            'id'         => 'title_52',
                            'type'       => 'text',
                            'title'      => '按钮文字',
                        ),
                        array(
                            'id'         => 'color_52',
                            'type'       => 'color',
                            'title'      => '按钮文字颜色',
                        ),
                        array(
                            'id'         => 'background_52',
                            'type'       => 'color',
                            'title'      => '背景颜色',
                        ),
                        array(
                            'id'         => 'link_52',
                            'type'       => 'text',
                            'title'      => '跳转链接',
                        ),
                        array(
                            'id'         => 'navcolor_52',
                            'type'       => 'color',
                            'title'      => '指示器颜色',
                        ),
                    ),
                    'dependency'        => array('modular_type', 'any', '52'),
                ),
                /** --------------------------------------------------------------------------------- *
                 *  首页模块-53设置
                 *  --------------------------------------------------------------------------------- */
                
                 array(
                    'id'         => 'modular_53_color',
                    'type'       => 'color',
                    'title'      => '控件颜色',
                    'dependency'        => array('modular_type', 'any', '53'),
                ),
                array(
                    'id'                => 'add_modular_53',
                    'type'              => 'group',
                    'title'             => '',
                    'button_title'      => '添加视频',
                    'accordion_title'   => '添加视频',
                    'fields'            => array(
                        array(
                            'id'         => 'modular_53_title',
                            'type'       => 'text',
                            'title'      => '视频标题',
                            'attributes' => array('style' => 'width:100%'),
                        ),
                        array(
                            'id'         => 'modular_53_img',
                            'type'       => 'upload',
                            'title'      => '视频',
                            'attributes' => array(
                                'style'  => 'width: 100%;'
                            ),
                            'desc'      => '建议尺寸：9:16',
                        ),
                    ),
                    'dependency'        => array('modular_type', 'any', '53'),
                ),
                /** --------------------------------------------------------------------------------- *
	             *  首页模块-36设置
	             *  --------------------------------------------------------------------------------- */
	            /*array(
		            'id'        => 'modular_36_img',
		            'type'      => 'media',
		            'title'     => '图片',
		            'settings'  => array(
			            'button_title' => '上传图片',
			            'frame_title'  => '选择图片',
			            'insert_title' => '插入图片',
		            ),
		            'dependency'    => array('modular_type', 'any', '36'),
	            ),	            array(
		            'id'        => 'modular_36_video',
		            'type'      => 'media',
		            'title'     => '视频',
		            'settings'  => array(
			            'button_title' => '上传视频',
			            'frame_title'  => '选择视频',
			            'insert_title' => '插入视频',
		            ),
		            'dependency'    => array('modular_type', 'any', '36'),
	            ),*/



            ),

        ),
    ),
) );

// ----------------------------------------
// 文章页面
// ----------------------------------------
CSF::createSection( $prefix, array(
    'title'    => '文章页面',
    'priority' => 4,
    'fields'   => array(

        array(
            'id'        => 'post_header_banner',
            'type'      => 'checkbox',
            'title'     => '',
            'subtitle'  => 'Baanner图片来自于分类目录中设置的Banner图片',
            'label'     => '文章顶部显示Banner图片',
            'help'      => '选择「头部样式-1」的时候文章顶部必须显示Banner图片',
            'default'   => false
        ),

        array(
            'id'        => 'single_header_img',
            'type'      => 'media',
            'title'     => 'Banner图片',
            'subtitle'  => '不上传图片则默认调用当前分类下的Banner图片',
            'settings'  => array(
                'button_title' => '上传图片',
                'frame_title'  => '选择图片',
                'insert_title' => '插入图片',
            ),
            'dependency'=> array( 'post_header_banner', '==', true )
        ),

        array(
            'id'        => 'breadcrumbs_post_title',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '面包屑导航中的文章标题用「正文」代替',
            'default'   => true
        ),
        array(
            'id'        => 'post_no_sidebar_all',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '所有文章均使用单栏文章页',
            'default'   => false
        ),
        array(
            'id'        => 'dqtheme_single_author1',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '文章作者',
            'default'   => true
        ),
        array(
            'id'        => 'dqtheme_single_category',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '文章分类',
            'default'   => true
        ),
        array(
            'id'        => 'dqtheme_single_time',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '文章发布时间',
            'default'   => true
        ),
        array(
            'id'        => 'dqtheme_single_views',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '文章浏览量',
            'default'   => true
        ),
        array(
            'id'        => 'dqtheme_single_related',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '相关文章推荐',
            'default'   => false
        ),
        array(
            'id'        => 'dqtheme_single_author',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '文章作者模块（显示在文章内容底部）',
            'default'   => true
        ),
        array(
            'id'        => 'dqtheme_single_comments',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '文章评论',
            'default'   => true
        ),
        array('id'=>'cf7_form','type'=> 'checkbox','title'=> '','label'=>'CF7留言表单短代码','default'=>false),
        array('id'=>'cf7_shortcode','type'=>'textarea','title'=>'请输入CF7留言表单短代码...','dependency'=>array( 'cf7_form', '==', true )),

        /*
        array(
            'id'      => 'produc_single_button',
            'type'    => 'switcher',
            'title'   => '<br><br>产品文章页 自定义默认按钮',
            'after'   => '<p class="cs-text-muted">开启后，所有产品文章页摘要下面将显示这里添加的自定义按钮，如果编辑文章的时候有单独设置自定义按钮，则优先显示文章内添加的按钮。</p>',
            'default' => false
        ),
        */

        //添加按钮
        array(
            'id'                => 'add_button',
            'type'              => 'group',
            'title'             => '添加产品文章页按钮',
            'subtitle'          => '产品文章页默认按钮，所有产品文章页摘要下面将显示这里添加的自定义按钮，如果编辑文章的时候有单独设置自定义按钮，则优先显示文章内添加的按钮。',
            'button_title'      => '添加产品文章页按钮',
            'accordion_title'   => '添加产品文章页按钮',
            'fields'            => array(

                array(
                    'id'            => 'produc_button_type',
                    'type'          => 'radio',
                    'title'         => '菜单类型',
                    'class'         => 'horizontal',
                    'options'       => array(
                        'link'      => '跳转链接',
                        'img'       => '弹出图像',
                        'qq'        => 'QQ在线咨询',
                    ),
                    'default'       => 'link',
                ),
				array(
				    'id'			=> 'button_icon',
				    'type'			=> 'icon',
				    'title'			=> '按钮图标',
				),
                array(
                    'id'            => 'button_title',
                    'type'          => 'text',
                    'title'         => '按钮文本',
                ),
                array(
                    'id'            => 'button_color',
                    'type'          => 'color',
                    'title'         => '按钮颜色',
                    //'default'       => '#666',
                ),
                array('id'=>'button_text_color','type'=>'color','title'=>'按钮文字颜色'),
                array(
                    'id'            => 'button_url',
                    'type'          => 'text',
                    'title'         => '跳转链接',
                    'attributes'    => array('style'=> 'width: 100%;'),
                    'desc'          => '记得输入： http:// 或者 https://',
                    'dependency'    => array( 'produc_button_type', 'any', 'link' )
                ),
                array(
                    'id'            => 'button_qq',
                    'type'          => 'text',
                    'title'         => 'QQ号码',
                    'dependency'    => array( 'produc_button_type', 'any', 'qq' )
                ),
                array(
                    'id'            => 'button_img',
                    'type'          => 'media',
                    'title'         => '上传图像',
                    'after'         => '<p class="cs-text-muted">建议尺寸 200*200</p>',
                    'settings'      => array(
                        'button_title' => '上传图像',
                        'frame_title'  => '选择图像',
                        'insert_title' => '插入图像',
                    ),
                    'dependency'    => array( 'produc_button_type', 'any', 'img' )
                ),


            ),
            //'dependency'    => array( 'produc_single_button', '==', true )
        ),

        //广告设置
        array(
            'id'    => 'single_ad',
            'type'  => 'tabbed',
            'title' => '广告设置',
            'tabs'  => array(
                array(
                    'title'  => '内容顶部广告',
                    'fields' => array(
                        array(
                            'id'        => 'single_ad_top',
                            'type'      => 'media',
                            'title'     => '广告图片',
                            'help'      => '建议图片宽度为785 px',
                            'settings'  => array(
                                'button_title' => '上传图片',
                                'frame_title'  => '选择图片',
                                'insert_title' => '插入图片',
                            ),
                        ),
                        array(
                            'id'        => 'single_ad_top_url',
                            'type'      => 'text',
                            'title'     => '跳转链接',
                            'attributes'=> array('style'=> 'width: 100%;'),
                        ),
                    ),
                ),
                array(
                    'title'  => '内容底部广告',
                    'fields' => array(
                        array(
                            'id'        => 'single_ad_bottom',
                            'type'      => 'media',
                            'title'     => '广告图片',
                            'help'      => '建议图片宽度为785 px',
                            'settings'  => array(
                                'button_title' => '上传图片',
                                'frame_title'  => '选择图片',
                                'insert_title' => '插入图片',
                            ),
                        ),
                        array(
                            'id'        => 'single_ad_bottom_url',
                            'type'      => 'text',
                            'title'     => '跳转链接',
                            'attributes'=> array('style'=> 'width: 100%;'),
                        ),
                    ),
                ),

            ),

        ),
        //广告设置结束


    )
) );

// ----------------------------------------
// 页脚样式
// ----------------------------------------
CSF::createSection( $prefix, array(
    'title'    => '页脚设置',
    'priority' => 5,
    'fields'   => array(

        array(
            'id'        => 'footer_color',
            'type'      => 'color_group',
            'title'     => '页脚配色设置',
            //'subtitle'  => '自定义配色',
            'options'   => array(
                'bg_color'   => '背景颜色',
                'text_color' => '文本颜色',
            ),
            'default'   => array(
                'bg_color'   => '#091426',
                'text_color' => '#989898',
            ),
        ),

        array(
            'id'        => 'footer_copyright',
            'type'      => 'textarea',
            'title'     => '自定义页脚版权信息',
            'subtitle'  => '如需添加链接，请使用 a 标签...',
        ),
        array(
            'id'        => 'footer_icp',
            'type'      => 'text',
            'title'     => 'ICP备案号',
            'subtitle'  => '只填写备案号即可，别添加什么乱七八糟的代码',
        ),
        array(
            'id'        => 'footer_gaba',
            'type'      => 'text',
            'title'     => '公安备案号',
            'subtitle'  => '只填写备案号即可，别添加什么乱七八糟的代码',
        ),
        array(
            'id'        => 'footer_gaba_url',
            'type'      => 'text',
            'title'     => '公安备案跳转链接',
            'subtitle'  => '只填写链接地址即可，别添加什么乱七八糟的代码',
        ),
        array(
            'id'        => 'foot_link',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '友情链接',
            'help'      => '友情链接在【后台 - 链接】 中添加',
            'default'   => true
        ),
        array(
            'id'        => 'foot_link_cat',
            'type'      => 'checkbox',
            'title'     => '选择链接分类',
            'class'     => 'horizontal',
            'options'   => $options_linkcats,
            'subtitle'  => '如果此处没有显示您创建的链接分类，是因为您的链接分类中没有添加链接</p>',
            'dependency'=> array( 'foot_link', '==', true )
        ),
        array(
            'id'        => 'foot_link_mobile',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '手机端不显示友情链接',
            'dependency'=> array( 'foot_link', '==', true )
        ),
        array(
            'id'        => 'dqtheme_link',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '页脚主题版权信息',
            'default'   => true
        ),

  )
) );

// ----------------------------------------
// 手机端设置
// ----------------------------------------
CSF::createSection( $prefix, array(
    'title'    => '手机端设置',
    'priority' => 6,
    'fields'   => array(

        array(
            'id'        => 'dqtheme_none_sidebar',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '手机端不显示边栏小工具',
            'default'   => true
        ),
        array(
            'id'        => 'mobile_foot_menu_sw',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '手机端底部菜单',
            'default'   => false
        ),
        array(
            'id'        => 'mobile_foot_inquiry_link',
            'type'      => 'text',
            'title'     => '手机端底部询盘链接',
            'label'     => '',
            'desc'      => 'id形式：#id名；链接形式直接填链接',
            'default'   => '',
            'dependency'=> array( 'mobile_foot_menu_sw', '==', true )
        ),
        array(
            'id'        => 'mobile_foot_menu_touch',
            'type'      => 'checkbox',
            'title'     => '',
            'label'     => '手机端底菜单，向上滑动隐藏，向下滑显示',
            'default'   => false,
            'dependency'=> array( 'mobile_foot_menu_sw', '==', true )
        ),
        array(
            'id'        => 'mobile_foot_background_color',
            'type'      => 'color',
            'title'     => '底部菜单，背景颜色',
            //'subtitle'  => '自定义配色',
            'bg_color'   => '背景颜色',
            'default'   => '#081526',
           'dependency'=> array( 'mobile_foot_menu_sw', '==', true )
        ),
        array(
            'id'                => 'add_mobile_foot_menu',
            'type'              => 'group',
            'title'             => '',
            'button_title'      => '添加手机端底部菜单',
            'accordion_title'   => '添加手机端底部菜单',
            'fields'            => array(
                array(
                    'id'        => 'mobile_foot_menu_title',
                    'type'      => 'text',
                    'title'     => '标题',
                ),
                array(
                    'id'        => 'mobile_foot_menu_type',
                    'type'      => 'radio',
                    'title'     => '客服类型',
                    'inline'    => true,
                    'options'   => array(
                        'link'  => '跳转链接',
                        'img'   => '弹出图像',
                        'tel'   => '联系电话',
                        'qq'    => '联系QQ',
                        'copy'  => '一键复制',
                    ),
                    'default'   => 'link',
                ),
                array(
                    'id'        => 'mobile_foot_menu_icon',
                    'type'      => 'media',
                    'title'     => '图标',
                    'desc'      => '上传图标，建议100*100 px',
                    'add_title' => '上传图标'
                ),
                array(
                    'id'        => 'mobile_foot_menu_url',
                    'type'      => 'text',
                    'title'     => '跳转链接',
                    'dependency'=> array( 'mobile_foot_menu_type', '==', 'link' )
                ),
                array(
                    'id'        => 'mobile_foot_menu_url_blank',
                    'type'      => 'checkbox',
                    'title'     => '',
                    'label'     => '链接新窗口打开',
                    'dependency'=> array( 'mobile_foot_menu_type', '==', 'link' )
                ),
                array(
                    'id'        => 'mobile_foot_menu_tel',
                    'type'      => 'text',
                    'title'     => '电话号码',
                    'dependency'=> array( 'mobile_foot_menu_type', '==', 'tel' )
                ),
                array(
                    'id'        => 'mobile_foot_menu_qq',
                    'type'      => 'text',
                    'title'     => 'QQ号码',
                    'dependency'=> array( 'mobile_foot_menu_type', '==', 'qq' )
                ),
                array(
                    'id'        => 'mobile_foot_menu_img',
                    'type'      => 'media',
                    'title'     => '弹出图片',
                    'subtitle'  => '通常放二维码图片，建议200*200 px',
                    'add_title' => '上传图片',
                    'dependency'=> array( 'mobile_foot_menu_type', '==', 'img' )
                ),
                array(
                    'id'        => 'mobile_foot_menu_copy',
                    'type'      => 'text',
                    'title'     => '复制内容',
                    'subtitle'  => '常用于一键复制微信号',
                    'dependency'=> array( 'mobile_foot_menu_type', '==', 'copy' )
                ),
                array(
                    'id'        => 'mobile_foot_menu_copy_tips',
                    'type'      => 'text',
                    'title'     => '复制成功提示语',
                    'subtitle'  => '例如：微信号复制成功，请打开微信添加好友',
                    'dependency'=> array( 'mobile_foot_menu_type', '==', 'copy' )
                ),
                array(
                    'id'        => 'mobile_foot_menu_copy_weixin',
                    'type'      => 'checkbox',
                    'title'     => '',
                    'label'     => '复制成功后跳转到微信APP',
                    'dependency'=> array( 'mobile_foot_menu_type', '==', 'copy' )
                ),
            ),
            'dependency'=> array( 'mobile_foot_menu_sw', '==', true )
        ),


  )
) );

// ----------------------------------------
// 客服工具
// ----------------------------------------
CSF::createSection( $prefix, array(
    'title'         => '客服工具',
    'priority'      => 7,
    'description'   => '侧栏悬浮客服工具，适用于添加QQ客服、微信二维码等等...',
    'fields'        => array(

        array(
            'id'                => 'add_kefu',
            'type'              => 'group',
            'title'             => '',
            'button_title'      => '添加客服工具',
            'accordion_title'   => '添加客服工具',
            'fields'            => array(
                array(
                    'id'        => 'kefu_title',
                    'type'      => 'text',
                    'title'     => '标题',
                ),
                array(
                    'id'        => 'kefu_icon',
                    'type'      => 'media',
                    'title'     => '图标',
                    'desc'      => '上传图标，建议100*100 px',
                    'add_title' => '上传图标'
                ),
                array(
                    'id'        => 'kefu_type',
                    'type'      => 'radio',
                    'title'     => '客服类型',
                    'inline'    => true,
                    'options'   => array(
                        'link'  => '跳转链接',
                        'img'   => '弹出图像',
                    ),
                    'default'   => 'link',
                ),
                array(
                    'id'        => 'kefu_url',
                    'type'      => 'text',
                    'title'     => '跳转链接',
                    'dependency'=> array( 'kefu_type', '==', 'link' )
                ),
                array(
                    'id'        => 'kefu_desc',
                    'type'      => 'text',
                    'title'     => '描述文本',
                    'dependency'=> array( 'kefu_type', '==', 'link' )
                ),
                array(
                    'id'        => 'kefu_img',
                    'type'      => 'media',
                    'title'     => '弹出图片',
                    'subtitle'  => '通常放二维码图片，建议200*200 px',
                    'add_title' => '上传图片',
                    'dependency'=> array( 'kefu_type', '==', 'img' )
                ),
            ),
        ),

  )
) );

// ----------------------------------------
// 网站配色
// ----------------------------------------
CSF::createSection( $prefix, array(
    'title'         => '网站配色',
    'priority'      => 998,
    'description'   => '自定义网站配色',
    'fields'        => array(

        array(
            'id'        => 'theme_color',
            'type'      => 'color_group',
            'title'     => '网站主色调',
            //'subtitle'  => '自定义配色',
            'options'   => array(
                'theme_color_1' => '主色调-1',
                'theme_color_2' => '主色调-2',
            ),
            'default'   => array(
                'theme_color_1' => '#fcab03',
                'theme_color_2' => '#091426',
            ),
        ),

        array(
            'id'        => 'theme_color_hover',
            'type'      => 'color',
            'title'     => '链接悬停颜色',
            'default'   => '#fcab03',
        ),



  )
) );

// 添加修改按钮
/*
function add_blue_pencil( $wp_customize ) {

    $wp_customize->selective_refresh->add_partial(
        'dqtheme_customize[logo]',
        array(
            'selector'        => '.logo',
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'dqtheme_customize[banner]',
        array(
            'selector'        => '#responsive-309391',
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'dqtheme_customize[index_modular]',
        array(
            'selector'        => '.module-full-screen',
        )
    );


}
add_action( 'customize_register', 'add_blue_pencil' );

if( is_user_logged_in() ){
	add_action('wp_head',function(){ ?>
	
	<style type="text/css">
	    .customize-partial-edit-shortcut-dqtheme_customize-banner,.customize-partial-edit-shortcut-dqtheme_customize-index_modular{margin-left: 50px;margin-top: 20px}
	</style>
	
	<?php });
}
*/

// 在自定义设置页面添加css
add_action('admin_enqueue_scripts',function(){ ?>

<style type="text/css">
	.quicktags-toolbar{display:none}
    .quicktags-toolbar+textarea{min-height:200px}
    .button.button-primary.csf-cloneable-add{width:100%;text-align:center;padding:5px 0;font-size:15px}

    /*基础优化*/
    .wp-core-ui .button-primary.focus,.wp-core-ui .button-primary:focus{box-shadow:none !important}

    /*选中样式 Factory*/
    #customize-control-dqtheme_customize-header_type .csf-field-image_select .csf--active,
    #customize-control-dqtheme_customize-foot_type .csf-field-image_select .csf--active{border: 4px solid #F44336}
    #customize-control-dqtheme_customize-header_type .csf-field-image_select .csf--image:before,
    #customize-control-dqtheme_customize-foot_type .csf-field-image_select .csf--image:before{background-color:#F44336}
    #customize-control-dqtheme_customize-index_modular .csf-field-image_select .csf--image{max-width: 45.5%;border: 3px solid #eee;}
    #customize-control-dqtheme_customize-index_modular .csf-field-image_select .csf--image:nth-child(2){margin-right:0px}
    #customize-control-dqtheme_customize-index_modular .csf-field-image_select .csf--active{border: 3px solid #F44336}
    #customize-control-dqtheme_customize-index_modular .csf-field-image_select .csf--image:before{background-color:#F44336}
    /*模块3 tab Factory*/
    .csf-field-tabbed[data-controller=modular_type][data-value="3"] .csf-tabbed-nav a{display:inline-block;padding:10px 12.7px;margin-top:1px;margin-right:5px;margin-bottom:-1px;position:relative;text-decoration:none;color:#444;font-weight:600;border:1px solid #ccd0d4;background-color:#f3f3f3;transition:all .2s}
    .csf-field-tabbed[data-controller=modular_type][data-value="3"] .csf-tabbed-nav a.csf-tabbed-active{background-color:#fff;border-bottom-color:#fff}
    .csf-field-tabbed[data-controller=modular_type][data-value="3"] .csf-tabbed-nav a:last-child{margin-right:0}
    /*幻灯片下面的块元素*/
    [data-option-id="banner_block"] .csf-field.csf-field-group{margin-top:20px}
    /*模块标题样式*/
    body .control-section .csf-field .csf-title h4{font-size:14px;font-weight:400;color:#007cba}

    /*禁止点击文章数量的输入框*/
    .csf-field-slider input[type=number]{pointer-events:none}

</style>

<?php });
