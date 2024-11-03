<?php

/** --------------------------------------------------------------------------------- *
 *  自定义文章类型：客户定制
 *  --------------------------------------------------------------------------------- */
function dq_custom_customized_special() {
  $labels = array(
    'name'                => '产品专题',
    'singular_name'       => '产品专题',
    'add_new'             => '新建专题',
    'add_new_item'        => '新建专题',
    'edit_item'           => '编辑专题',
    'new_item'            => '新专题',
    'all_items'           => '所有专题',
    'view_item'           => '查看专题',
    'search_items'        => '搜索专题',
    'not_found'           => '没有找到有专题',
    'not_found_in_trash'  => '回收站里面没有相关专题',
    'parent_item_colon'   => '',
    'menu_name'           => '产品专题'
  );
  $args = array(
    'labels'              => $labels,
    'description'         => '产品专题',
    'menu_icon'			  => 'dashicons-portfolio',
    'public'              => true,
    //'public'            => false,
    'show_ui'             => true,
    'menu_position'       => 888,
    //'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'supports'            => array( 'title', 'thumbnail' ),
    'has_archive'         => true,
    //'permastruct'         => 'special/%post_id%/',

  );
  register_post_type( 'special', $args );
}
add_action( 'init', 'dq_custom_customized_special' );

//引导wordpress从新的链接中找到帖子
function parse_request_remove_special_slug( $query_vars ) {

    // return if admin dashboard 
    if ( is_admin() ) {
        return $query_vars;
    }

    // return if pretty permalink isn't enabled
    if ( ! get_option( 'permalink_structure' ) ) {
        return $query_vars;
    }

    $cpt = 'special';

    // store post slug value to a variable
    if ( isset( $query_vars['pagename'] ) ) {
        $slug = $query_vars['pagename'];
    } elseif ( isset( $query_vars['name'] ) ) {
        $slug = $query_vars['name'];
    } else {
        global $wp;
        
        $path = $wp->request;

        // use url path as slug
        if ( $path && strpos( $path, '/' ) === false ) {
            $slug = $path;
        } else {
            $slug = false;
        }
    }

    if ( $slug ) {
        $post_match = get_page_by_path( $slug, 'OBJECT', $cpt );

        if ( ! is_admin() && $post_match ) {

            // remove any 404 not found error element from the query_vars array because a post match already exists in cpt
            if ( isset( $query_vars['error'] ) && $query_vars['error'] == 404 ) {
                unset( $query_vars['error'] );
            }

            // remove unnecessary elements from the original query_vars array
            unset( $query_vars['pagename'] );
    
            // add necessary elements in the the query_vars array
            $query_vars['post_type'] = $cpt;
            $query_vars['name'] = $slug;
            $query_vars[$cpt] = $slug; // this constructs the "cpt=>post_slug" element
        }
    }

    return $query_vars;
}
add_filter( 'request', "parse_request_remove_special_slug" , 1, 1 );


/** --------------------------------------------------------------------------------- *
 *  自定义文章类型：文章设置
 *  --------------------------------------------------------------------------------- */

$special_opts = 'post_type_special';

CSF::createMetabox( $special_opts, array(
	'title'        => '产品专题',
	'post_type'    => 'special',
) );

CSF::createSection( $special_opts, array(
    //'title'    => '首页模块',
    'fields'   => array(

		array(
			'id'                => 'special_banner',
			'type'              => 'media',
			'title'             => 'Banner图片',
			'settings'          => array(
				'button_title'  => '上传图片',
				'frame_title'   => '选择图片',
				'insert_title'  => '插入图片',
			),
		),
		array(
			'id'				=> 'special_desc',
			'type'				=> 'wp_editor',
			'title'				=> '专题简介',
			'height'			=> '100px',
			'media_buttons'		=> false,
			'quicktags'			=> false,
		),
		array(
			'id'				=> 'special_posts',
			'type'				=> 'select',
			'title'				=> '指定产品',
			'chosen'			=> true,
			'multiple'			=> true,
			'sortable'			=> true,
			'ajax'				=> true,
			'options'			=> 'posts',
			'placeholder'		=> '输入关键词进行搜索',
            'settings'			=> array(
                'min_length'	=> 1 //输入一个字也可以搜索
            ),
		),

    ),
) );

// 文章SEO设置
$dq_seo_switch = get_option('dqtheme_optimize');
if( $dq_seo_switch['dq_seo_switch'] ){ //判断是否开启主题SEO设置

$prefix_special_opts = 'dq_special_seo';

CSF::createMetabox( $prefix_special_opts, array(
    'title'        => 'SEO设置',
    'post_type'    => 'special',
    //'show_restore' => true,
) );

CSF::createSection( $prefix_special_opts, array(
    //'title'  => ' SEO设置',
    //'icon'   => 'iconfont icon-wz-seo',
    'fields' => array(

        array(
            'id'    => 'seo_title',
            'type'  => 'text',
            'title' => 'SEO-标题',
            //'after' => '<div class="cs-text-muted">留空则调用页面标题</div>'
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
            //'after' => '<div class="cs-text-muted">留空则调用文章摘要</div>'
        ),

    )
) );

}//判断是否开启主题SEO设置 END


