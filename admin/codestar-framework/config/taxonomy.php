<?php if (!defined('ABSPATH')) {
    die;
} // Cannot access directly.

//
// Set a unique slug-like ID
//
$prefix = '_dq_taxonomy_options';

//
// Create taxonomy options
//
CSF::createTaxonomyOptions($prefix, array(
    'taxonomy' => ['category', 'post_tag'],
));

//
// Create a section
//
CSF::createSection($prefix, array(
    'fields' => array(
        array(
            'id'            => 'tag_description',
            'type'          => 'wp_editor',
            'title'         => '描述',
        ),

        // 自定义文章显示数量
        array(
            'id'            => 'posts_per_page',
            'type'          => 'number',
            'title'         => '文章显示数量',
            'unit'          => '篇',
            'desc'          => '此处设置的是当前分类页面，每页显示的文章数量，不包含置顶文章',
            'min'           => 3,
            'max'           => 100,
            'default'       => 9,
            'attributes'    => array('style' => 'width: 100%;'),
        ),
        array(
            'id'            => 'posts_per_page_mobile',
            'type'          => 'number',
            'title'         => '手机端文章显示数量',
            'unit'          => '篇',
            'desc'          => '此处设置的是当前分类页面，每页显示的文章数量，不包含置顶文章',
            'min'           => 2,
            'max'           => 100,
            'default'       => 10,
            'attributes'    => array('style' => 'width: 100%;'),
        ),
        // 每行显示多少篇文章，宽屏模式下此选项无效 强制每行4篇
        array(
            'id'            => 'cat_posts_num',
            'type'          => 'radio',
            'title'         => '每行显示文章数量',
            'inline'        => true,
            'options'       => array(
                '3'         => '每行3篇文章',
                '4'         => '每行4篇文章',
            ),
            'default'       => '3',
            'dependency'    => array('cat_layout', 'any', '1,2,3'),
        ),
        array(
            'id'            => 'cat_posts_num_mobile',
            'type'          => 'radio',
            'title'         => '手机端每行显示文章数量',
            'inline'        => true,
            'options'       => array(
                '1'         => '每行1篇文章',
                '2'         => '每行2篇文章',
            ),
            'default'       => '2',
            'dependency'    => array('cat_layout', 'any', '1,2,3'),
        ),
        // 布局样式
        array(
            'id'            => 'cat_layout',
            'type'          => 'image_select',
            'title'         => '列表样式',
            //'inline'      => true,
            //'class'       => 'horizontal',
            'options'       => array(
                '1'         => get_stylesheet_directory_uri() . '/static/images/admin/cat-1.png',
                '2'         => get_stylesheet_directory_uri() . '/static/images/admin/cat-2.png',
                '3'         => get_stylesheet_directory_uri() . '/static/images/admin/cat-3.png',
                '4'         => get_stylesheet_directory_uri() . '/static/images/admin/cat-4.png',
                '5'         => get_stylesheet_directory_uri() . '/static/images/admin/cat-5.png',
                '6'         => get_stylesheet_directory_uri() . '/static/images/admin/cat-6.png',
            ),
            'default'       => '1',
        ),
        // 缩略图尺寸
        array(
            'id'            => 'post_img_width',
            'type'          => 'spinner',
            'title'         => '图片宽度',
            'desc'          => '自定义缩略图尺寸，默认宽高500*500，最小宽度264px，高度随意，如果缩略图模糊，可同比放大尺寸，比如：800*800，没有固定尺寸，建议自己设置尺寸进行调试，达到自己满意的比例',
            'max'           => 10000,
            'min'           => 264,
            'step'          => 1,
            'unit'          => 'px',
            'attributes'    => array('style' => 'width: 100%;'),
            'dependency'    => array('cat_layout', 'any', '1,2,3'),
        ),
        array(
            'id'            => 'post_img_height',
            'type'          => 'spinner',
            'title'         => '图片高度',
            //'subtitle'    => 'max:1 | min:0 | step:0.1 | unit:px',
            'max'           => 10000,
            'min'           => 0,
            'step'          => 1,
            'unit'          => 'px',
            'attributes'    => array('style' => 'width: 100%;'),
            'dependency'    => array('cat_layout', 'any', '1,2,3'),
        ),
        // Banner图片+文本内容
        array(
            'id'            => 'banner_cat_desc',
            'type'          => 'radio',
            'title'         => '显示分类名称+描述',
            'inline'        => true,
            'desc'          => 'Banner图片上面显示分类目录名字以及分类描述...',
            'options'       => array(
                '1'         => '居中显示',
                '2'         => '靠左显示',
                '3'         => '不显示',
            ),
            'default'       => '1',
        ),
        array(
            'id'            => 'cat_banner_img',
            'type'          => 'media',
            'title'         => 'Banner图片',
            'desc'          => '建议尺寸：1920*300',
            'settings'      => array(
                'button_title' => '上传图像',
                'frame_title'  => '选择图像',
                'insert_title' => '插入图像',
            ),
        ),
        array(
            'id'            => 'cat_widgets',
            'type'          => 'switcher',
            'title'         => '独立侧栏小工具',
            'label'         => '创建独立侧栏小工具，开启后到「外观-小工具」进行设置',
            'dependency'    => array('cat_layout', 'any', '5'),
        ),
        array(
            'id'            => 'cat_post_widgets',
            'type'          => 'switcher',
            'title'         => '文章侧栏调用分类侧栏',
            'label'         => '开启后此分类下的文章侧栏与此分类侧栏小工具保持一致',
            'dependency'    => array('cat_widgets', '==', true)
        ),
        array(
            'id'            => 'is_cat_imgs',
            'type'          => 'switcher',
            'title'         => '是否在分类聚合页显示',
        ),
        array(
            'id'            => 'cat_category_img',
            'type'          => 'media',
            'title'         => '分类图片',
            'desc'          => '建议尺寸：16:9',
            'settings'      => array(
                'button_title' => '上传图像',
                'frame_title'  => '选择图像',
                'insert_title' => '插入图像',
            ),
			'dependency'    => array('is_cat_imgs', '==', true)
        ),
        array(
            'id'            => 'is_cat_text',
            'type'          => 'text',
            'title'         => '分类别名',
			'dependency'    => array('is_cat_imgs', '==', true)
        ),
        array(
            'id'            => 'is_cat_desc',
            'type'          => 'switcher',
            'title'         => '是否在分类页显示描述',
        ),
        array(
            'id'            => 'cat_desc',
            'type'          => 'wp_editor',
            'title'         => '分类描述',
			'dependency'    => array('is_cat_desc', '==', true)
        ),
        array(
            'id'            => 'is_cat_tags',
            'type'          => 'switcher',
            'title'         => '是否在分类页显示标签',
        ),
        array(
            'id'            => 'is_cat_contact',
            'type'          => 'switcher',
            'title'         => '是否在分类页显示自定义按钮',
        ),
        array(
            'id'            => 'cat_contact_text',
            'type'          => 'text',
            'title'         => '按钮文字',
			'dependency'    => array('is_cat_contact', '==', true)
        ),
        array(
            'id'      => 'cat_contact_text_color',
            'type'    => 'color',
            'title'   => '文字颜色',
			'dependency'    => array('is_cat_contact', '==', true)
        ),
        array(
            'id'      => 'cat_contact_color',
            'type'    => 'color',
            'title'   => '按钮颜色',
			'dependency'    => array('is_cat_contact', '==', true)
        ),

    )
));

$dq_seo_switch = get_option('dqtheme_optimize');
if ($dq_seo_switch['dq_seo_switch']) { //判断是否开启主题SEO设置
    CSF::createSection($prefix, array(
        'fields' => array(

            // SEO设置
            array(
                'type'            => 'notice',
                'style'           => 'success',
                'content'         => 'SEO相关信息设置，非必填项，可留空',
            ),

            array(
                'id'            => 'seo_title',
                'type'          => 'text',
                'title'         => 'SEO-分类标题',
                'desc'          => '留空则默认显示分类标题+网站副标题',
                'attributes'    => array('style' => 'width: 100%;'),
            ),

            array(
                'id'            => 'seo_description',
                'type'          => 'textarea',
                'title'         => 'SEO-分类描述',
                'desc'          => '一段简单的分类描述文字',
                'attributes'    => array('style' => 'width: 100%;'),
            ),

            array(
                'id'            => 'seo_keywords',
                'type'          => 'textarea',
                'title'         => 'SEO-关键词',
                'desc'          => '多个关键词之间用英文逗号隔开',
                'attributes'    => array('style' => 'width: 100%;'),
            ),


        )
    ));
} //判断是否开启主题SEO设置 END


add_action('admin_head', function () { ?>

    <style type="text/css">
        .csf-taxonomy {
            width: 95%
        }
    </style>

<?php });
