<?php

define('WPKF_LOOKBOOKS_VER', '1.0.0');
define('WPKF_LOOKBOOKS_DURL', get_template_directory_uri());
define('WPKF_LOOKBOOKS_PATH', get_template_directory());

new WPKF_LOOKBOOKS_Init();

class WPKF_LOOKBOOKS_Init
{

	public function __construct()
	{
		static::init();
		static::load_file();
	}

	private static function init()
	{
		/*
        add_filter('plugin_action_links', function ($actions, $plugin_file) {
            if (WPKF_LOOKBOOKS_BASE == $plugin_file) {
                $actions[] = '<a href="admin.php?page=LOOKBOOKS">' . __('Settings') . '</a>';
            }
            return $actions;
        }, 10, 2);
        */
		add_action('init', [__CLASS__, 'register_post_type']);
		add_filter('template_include', [__CLASS__, 'template_include'], 99);
		add_action('wp_ajax_wpkf_lookbooks', [__CLASS__, 'lookbooks_aciton']);
		add_action('wp_ajax_nopriv_wpkf_lookbooks', [__CLASS__, 'lookbooks_aciton']);
		add_action('wp_ajax_wpkf_lookbooks_posts', [__CLASS__, 'lookbooks_posts_aciton']);
		add_action('wp_ajax_nopriv_wpkf_lookbooks_posts', [__CLASS__, 'lookbooks_posts_aciton']);
		add_action('init', [__CLASS__, 'register_taxonomy']);
		add_action('pre_get_posts', [__CLASS__, 'pre_get_posts'], 100, 1);
		//add_action('init', [__CLASS__, 'register_post_status']);
		//add_action('admin_init', [__CLASS__, 'admin_init']);
	}

	private static function load_file()
	{
		require get_template_directory() . '/lookbooks/options/wpkf-metabox-lookbooks.php';
		require get_template_directory() . '/lookbooks/options/wpkf-metabox-post.php';
		require get_template_directory() . '/lookbooks/options/wpkf-options.php';
		require get_template_directory() . '/lookbooks/part-actions.php';
	}

	public static function lookbooks_aciton()
	{
		$nonce   = !empty($_POST['nonce']) ? esc_sql($_POST['nonce']) : null;
		$post_id = !empty($_POST['post_id']) ? esc_sql($_POST['post_id']) : null;
		if (!wp_verify_nonce($nonce, 'wpkf_lookbooks')) {
			wp_send_json(array('status' => '0', 'msg' => 'illegal request'));
		}
        
        ob_start();
		$html = wpkf_get_action_lookbook_html($post_id);
		echo ob_get_clean();
		exit;
		//wp_send_json($html);
	}

	public static function lookbooks_posts_aciton()
	{
		$nonce   = !empty($_POST['nonce']) ? esc_sql($_POST['nonce']) : null;
		if (!wp_verify_nonce($nonce, 'wpkf_lookbooks')) {
			wp_send_json(array('status' => '0', 'msg' => 'illegal request'));
		}

		$cat_id = !empty($_POST['cat_id']) ? esc_sql($_POST['cat_id']) : null;
		$page = !empty($_POST['page']) ? esc_sql($_POST['page']) : null;

		$args['ignore_sticky_posts'] = 1;
		$args['paged'] = $page;
		$args['post_type'] = 'lookbooks';
		$data =  new WP_Query($args);

		ob_start();
		if ($data->have_posts()) : while ($data->have_posts()) : $data->the_post();
				get_template_part('lookbooks/part-card');
			endwhile;
			//get_template_part('parts/wpkf-pagination');
			wp_reset_postdata();
		else :
			//echo '0';
		endif;
		echo ob_get_clean();

		exit;
		//wp_send_json($html);
	}

	public static function register_post_type()
	{
		$labels = [
			'name'               => __('Lookbooks', 'WPKF'),
			'add_new'            => __('新增', 'WPKF'),
			'add_new_item'       => __('新增', 'WPKF'),
			'new_item'           => __('新增', 'WPKF'),
			'edit_item'          => __('编辑Lookbooks信息', 'WPKF'),
			'view_item'          => __('查看Lookbooks信息', 'WPKF'),
			'view_items'         => __('查看Lookbooks信息', 'WPKF'),
			'all_items'          => __('全部', 'WPKF'),
			'search_items'       => __('搜索Lookbooks信息', 'WPKF'),
			'parent_item_colon'  => __('父级Lookbooks信息', 'WPKF'),
			'not_found'          => __('没有搜索到相关Lookbooks信息', 'WPKF'),
			'not_found_in_trash' => __('回收站中没有Lookbooks信息', 'WPKF'),
		];
		$args = [
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_nav_menus'  => true,
			'show_in_menu'       => true,
			'show_in_rest'       => false,
			'query_var'          => true,
			'rewrite'            => ['slug' => 'lookbooks'],
			'capability_type'    => 'post',
			'menu_icon'          => 'dashicons-controls-repeat',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 10,
			'taxonomies'         => ['type'],
			//'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments', 'page-attributes'],
			'supports'           => ['title', 'editor', 'author', 'thumbnail'],
			'can_export'         => true,
			//add_post_type_support( 'your_cpt', 'sticky' );
			//'sticky', 'page-attributes'
		];

		register_post_type('lookbooks', $args);
	}

	public static function register_taxonomy()
	{
		$labels = [
			'name'                       => __('Situation', 'WPKF'),
			'menu_name'                  => __('Situation', 'WPKF'),
			'singular_name'              => __('Situation', 'WPKF'),
			'search_items'               => __('搜索', 'WPKF'),
			'popular_items'              => __('热门', 'WPKF'),
			'all_items'                  => __('所有', 'WPKF'),
			'edit_item'                  => __('编辑', 'WPKF'),
			'update_item'                => __('更新', 'WPKF'),
			'add_new_item'               => __('添加', 'WPKF'),
			'new_item_name'              => __('Situation', 'WPKF'),
			'separate_items_with_commas' => __('按逗号分开', 'WPKF'),
			'add_or_remove_items'        => __('添加或删除', 'WPKF'),
			'choose_from_most_used'      => __('从经常使用的Situation中选择', 'WPKF'),
		];
		$args = [
			'labels'             => $labels,
			'hierarchical'       => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => ['slug' => 'situation'],
			'show_in_rest'       => true,
			'show_admin_column'  => true,
		];
		register_taxonomy('lookbooks_cat', ['lookbooks'], $args);

		$labels2 = [
			'name'                       => __('Product', 'WPKF'),
			'menu_name'                  => __('Product', 'WPKF'),
			'singular_name'              => __('Product', 'WPKF'),
			'search_items'               => __('搜索', 'WPKF'),
			'popular_items'              => __('热门', 'WPKF'),
			'all_items'                  => __('所有', 'WPKF'),
			'edit_item'                  => __('编辑', 'WPKF'),
			'update_item'                => __('更新', 'WPKF'),
			'add_new_item'               => __('添加', 'WPKF'),
			'new_item_name'              => __('Product', 'WPKF'),
			'separate_items_with_commas' => __('按逗号分开', 'WPKF'),
			'add_or_remove_items'        => __('添加或删除', 'WPKF'),
			'choose_from_most_used'      => __('从经常使用的Product中选择', 'WPKF'),
		];
		$args2 = [
			'labels'             => $labels2,
			'hierarchical'       => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => ['slug' => 'product'],
			'show_in_rest'       => true,
			'show_admin_column'  => true,
		];
		register_taxonomy('lookbooks_tag', ['lookbooks'], $args2);
	}

    public static function pre_get_posts($query)
    {
        if (!is_admin() and (is_post_type_archive('lookbooks') or is_tax('lookbooks_cat') or is_tax('lookbooks_tag'))) {
            $by_product = !empty($_GET['by_product']) ? $_GET['by_product'] : null;
            $by_situation = !empty($_GET['by_situation']) ? $_GET['by_situation'] : null;
        
            $tax_query = [];
            
            if ($by_product) {
                $query_by_product = array(array('taxonomy' => 'lookbooks_tag', 'field' => 'id', 'terms' => (int) $by_product));
                array_push($tax_query, $query_by_product);
            }
            if ($by_situation) {
                $query_by_situation = array(array('taxonomy' => 'lookbooks_cat', 'field' => 'id', 'terms' => (int) $by_situation));
                array_push($tax_query, $query_by_situation);
            }
			if($by_product or $by_situation){
				$query->set('tax_query', $tax_query);
			}
        }
    }

	public static function template_include($template)
	{
		if (is_post_type_archive('lookbooks') or is_tax('lookbooks_cat') or is_tax('lookbooks_tag')) {
			return get_stylesheet_directory() . '/lookbooks/archive-lookbooks.php';
		}
		if (is_singular('lookbooks')) {
			return get_stylesheet_directory() . '/lookbooks/single-lookbooks.php';
		}
		return $template;
	}
}
