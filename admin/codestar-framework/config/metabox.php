<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.

//
// Metabox of the PAGE
// Set a unique slug-like ID
//
$prefix_post_opts = 'extend_info';

//
// Create a metabox
//
CSF::createMetabox( $prefix_post_opts, array(
	'title'        => '文章扩展选项',
	'post_type'    => 'post',
	'data_type'    => 'unserialize',
	//'show_restore' => true,
) );


// 产品模块设置
CSF::createSection( $prefix_post_opts, array(
	'title'  => '产品信息',
	'fields' => array(

		array(
			'id'		=> 'showproduct_head',
			'type'		=> 'switcher',
			'title'   	=> '产品信息',
			'label'		=> '',
			//'text_on'	=> '显示产品信息',
			//'text_off'	=> '隐藏产品信息',
			'default' 	=> false
		),
		array(
			'id'	=> 'produc_layout',
			'type'	=> 'radio',
			'title'	=> '产品布局',
			'options' => array(
				'0' => '老布局',
				'1' => '新布局',
			),
			'default' => '0',
			'dependency' => array(
				array('showproduct_head', '==', 'true')
			),
			'class'      => 'left_radio'

		),
		/*
		array(
			'id'        => 'produc_img',
			'type'      => 'gallery',
			'title'     => '产品图集',
			'desc'      => '建议尺寸：500*500，或同比放大/缩小',
			'add_title' => '选择产品图',
			'edit_title'=> '编辑图集',
			'dependency'=> array( 'showproduct_head', '==', true )
		),
		*/
		array(
			'id'		=> 'produc_tag',
			'type'		=> 'switcher',
			'title'   	=> '产品标签',
			'label'		=> '',
			'default' 	=> false,
			'dependency'=> array( 'showproduct_head', '==', true )
		),
		array(
			'id'    => 'produc_radio',
			'type'    => 'radio',
			'options' => array(
				'new' => 'New',
				'hot' => 'Hot',
				'custom' => '自定义',
			),
			'dependency' => array(
						array('showproduct_head', '==', 'true'),
						array('produc_tag', '==', 'true')
						),
			'class'      => 'left_radio'
		),
		array(
			'id'    => 'produc_radio_text',
			'type'    => 'text',
			'attributes' => array(
				'style' => 'width: 100px;margin-left: 12%;', 
			),
			'dependency' => array(
						array('showproduct_head', '==', 'true'),
						array('produc_tag', '==', 'true'),
						array('produc_radio', '==', 'custom')
						)
		),

        array(
            'id'        => 'produc_img_1',
            'type'      => 'media',
            'title'     => '产品图片-1',
            'button_title' => '上传',
            'remove_title' => '移除',
			'dependency'=> array( 'showproduct_head', '==', true )
        ),
        array(
            'id'        => 'produc_img_2',
            'type'      => 'media',
            'title'     => '产品图片-2',
            'button_title' => '上传',
            'remove_title' => '移除',
			'dependency'=> array( 'showproduct_head', '==', true )
        ),
        array(
            'id'        => 'produc_img_3',
            'type'      => 'media',
            'title'     => '产品图片-3',
            'button_title' => '上传',
            'remove_title' => '移除',
			'dependency'=> array( 'showproduct_head', '==', true )
        ),
        array(
            'id'        => 'produc_img_4',
            'type'      => 'media',
            'title'     => '产品图片-4',
            'button_title' => '上传',
            'remove_title' => '移除',
			'dependency'=> array( 'showproduct_head', '==', true )
        ),
		// 视频
		array(
			'id'        => 'produc_video_1',
			'type'      => 'upload',
			'title'     => '产品视频-1',
			'button_title' => '上传',
			'remove_title' => '移除',
			'dependency'=> array( 'showproduct_head', '==', true )
		),
		array(
			'id'        => 'produc_video_1_cover',
			'type'      => 'media',
			'title'     => '产品视频-1-封面',
			'button_title' => '上传',
			'remove_title' => '移除',
			'dependency'=> array( 'showproduct_head', '==', true )
		),
		array(
			'id'        => 'produc_video_2',
			'type'      => 'upload',
			'title'     => '产品视频-2',
			'button_title' => '上传',
			'remove_title' => '移除',
			'dependency'=> array( 'showproduct_head', '==', true )
		),
		array(
			'id'        => 'produc_video_2_cover',
			'type'      => 'media',
			'title'     => '产品视频-2-封面',
			'button_title' => '上传',
			'remove_title' => '移除',
			'dependency'=> array( 'showproduct_head', '==', true )
		),
		array(
			'id'		=> 'produc_abstract',
			'type'		=> 'wp_editor',
			'title'		=> '产品参数',
			'after'		=> '<p class="cs-text-muted">自定义产品摘要，如留空，则自动调用文章首段文字...</p>',
			'media_buttons' => false,
			'quicktags'     => false,
			'dependency'=> array( 'showproduct_head', '==', true )
		),
		
		/*
		//产品参数
		array(
			'id'			=> 'produc_parameter_col',
			'type'			=> 'radio',
			'title'			=> '每行几个参数',
			'inline'        => true,
			'options'		=> array(
				'1'		=> '一行 1个参数',
				'2'		=> '一行 2个参数',
				'3'		=> '一行 3个参数',
			),
			'default'		=> '1',
			'dependency'	=> array( 'showproduct_head', '==', true )
		),
		array(
			'id'              => 'add_produc_parameter',
			'type'            => 'group',
			'title'           => '产品参数',
			'button_title'    => '添加产品参数',
			'accordion_title' => '添加产品参数',
			'fields'          => array(
				array(
					'id'			=> 'parameter_text',
					'type'			=> 'text',
					'title'			=> '产品参数',
					'desc'			=>	'例如：型号：XX888',
					'attributes'    => array('style'=> 'width: 100%;'),
				),
			),
			'dependency'=> array( 'showproduct_head', '==', true )
		),
		*/
		/*
		//添加按钮
		array(
			'id'              => 'add_button',
			'type'            => 'group',
			'title'           => '联系方式',
			'button_title'    => '添加联系方式',
			'accordion_title' => '添加联系方式',
			'fields'          => array(

				array(
					'id'			=> 'produc_button_type',
					'type'			=> 'radio',
					'title'			=> '按钮类型',
					'inline'        => true,
					'options'		=> array(
						'link'		=> '跳转链接',
						'img'		=> '弹出图像',
						'qq'		=> 'QQ在线咨询',
					),
					'default'		=> 'link',
				),
				array(
					'id'			=> 'button_title',
					'type'			=> 'text',
					'title'			=> '按钮文本',
				),
				array(
					'id'      		=> 'button_color',
					'type'    		=> 'color',
					'title'   		=> '按钮颜色',
					//'default' 		=> '#666',
				),
				array(
				    'id'			=> 'button_url',
				    'type'			=> 'text',
				    'title'			=> '跳转链接',
				    'attributes'	=> array('style'=> 'width: 100%;'),
				    'desc'			=> '记得输入： http:// 或者 https://',
				    'dependency'    => array( 'produc_button_type', 'any', 'link' )
				),
				array(
					'id'			=> 'button_qq',
					'type'			=> 'text',
					'title'			=> 'QQ号码',
					'dependency'    => array( 'produc_button_type', 'any', 'qq' )
				),
				array(
					'id'			=> 'button_img',
					'type'        	=> 'media',
					'title'      	=> '上传图像',
					'after'			=> '<p class="cs-text-muted">建议尺寸 200*200</p>',
					'settings'      => array(
						'button_title' => '上传图像',
						'frame_title'  => '选择图像',
						'insert_title' => '插入图像',
					),
					'dependency'    => array( 'produc_button_type', 'any', 'img' )
				),


			),
			'dependency'=> array( 'showproduct_head', '==', true )

		),
		*/

  )
) );

CSF::createSection( $prefix_post_opts, array(
	'title'  => 'YouTube视频ID',
	'fields' => array(

		array(
			'id'        => 'youtube_id',
			'type'      => 'text',
			'title'     => 'YouTube ID',
			'desc'		=> '例如：https://www.youtube.com/watch?v=IkJVA150zPY，视频ID就是：IkJVA150zPY',
		),

  )
) );

CSF::createSection( $prefix_post_opts, array(
	'title'  => '认证banner',
	'fields' => array(

		array(
			'id'        => 'branding',
			'type'      => 'text',
			'title'     => 'banner链接',
			'desc'		=> '',
			'default'=> 'https://www.cornealighting.com/wp-content/uploads/2024/07/214.png',
		),

  )
) );

// 文章相关推荐
$dq_single_related = get_option('dqtheme_customize');
if( ! empty( $dq_single_related['dqtheme_single_related'] ) ) { //判断是否开启相关文章推荐

CSF::createSection( $prefix_post_opts, array(
	'title'  => '相关文章推荐',
	'fields' => array(

		array(
			'id'        => 'related_posts_id',
			'type'      => 'select',
			'title'     => '指定推荐文章',
			'desc'		=> '留空则显示系统自动推荐文章，根据同分类或同标签进行推荐',
			'chosen'    => true,
			'multiple'  => true,
			'sortable'  => true,
			'ajax'      => true,
			'options'   => 'posts',
			'placeholder'=> '输入关键词进行搜索，不少于三个字',
		),

  )
) );

}//判断是否开启相关文章推荐 END



// 文章SEO设置
$dq_seo_switch = get_option('dqtheme_optimize');
if( $dq_seo_switch['dq_seo_switch'] ){ //判断是否开启主题SEO设置

CSF::createSection( $prefix_post_opts, array(
	'title'  => ' SEO设置',
	//'icon'   => 'iconfont icon-wz-seo',
	'fields' => array(

        array(
            'id'    => 'seo_title',
            'type'  => 'text',
            'title' => 'SEO-标题',
            'after' => '<div class="cs-text-muted">留空则调用文章标题</div>'
        ),
        array(
            'id'    => 'seo_keywords',
            'type'  => 'text',
            'title' => 'SEO-关键词',
            'after' => '<div class="cs-text-muted">多个关键词之间用英文逗号隔开</div>'
        ),
        array(
            'id'    => 'seo_description',
            'type'  => 'textarea',
            'title' => 'SEO-描述',
            'after' => '<div class="cs-text-muted">留空则调用文章摘要</div>'
        ),

	)
) );


$prefix_page_opts = 'page_seo';

CSF::createMetabox( $prefix_page_opts, array(
	'title'        => 'SEO设置',
	'post_type'    => 'page',
	//'show_restore' => true,
) );

CSF::createSection( $prefix_page_opts, array(
	//'title'  => ' SEO设置',
	//'icon'   => 'iconfont icon-wz-seo',
	'fields' => array(

        array(
            'id'    => 'seo_title',
            'type'  => 'text',
            'title' => 'SEO-标题',
            'after' => '<div class="cs-text-muted">留空则调用文章标题</div>'
        ),
        array(
            'id'    => 'seo_keywords',
            'type'  => 'text',
            'title' => 'SEO-关键词',
            'after' => '<div class="cs-text-muted">多个关键词之间用英文逗号隔开</div>'
        ),
        array(
            'id'    => 'seo_description',
            'type'  => 'textarea',
            'title' => 'SEO-描述',
            'after' => '<div class="cs-text-muted">留空则调用文章摘要</div>'
        ),

	)
) );

}//判断是否开启主题SEO设置 END


CSF::createSection( $prefix_post_opts, array(
	'title'  => ' 文章来源',
	//'icon'   => 'iconfont icon-wz-seo',
	'fields' => array(

        array(
            'id'    => 'single_source',
            'type'  => 'text',
            'title' => '文章来源',
            'after' => '<div class="cs-text-muted">输入文章来源信息</div>'
        ),
        array(
            'id'    => 'single_source_url',
            'type'  => 'text',
            'title' => '来源链接',
            'after' => '<div class="cs-text-muted">请输入来源链接地址，必须包含https://或者http://</div>'
        ),

	)
) );




