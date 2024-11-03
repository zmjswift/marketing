<?php
/**
 * @Author: 大胡子
 * @Email:  dq@dqtheme.com
 * @Link:   www.dq.me
 * @Date:   2020-12-09 08:11:20
 * @Last Modified by:   dq
 * @Last Modified time: 2020-12-11 00:01:10
 */

/** --------------------------------------------------------------------------------- *
 *  为前端和后端加载资源
 *  --------------------------------------------------------------------------------- */
function dq_blocks_block_assets() {

	// 加载已编译的样式
	wp_enqueue_style(
		'dq-blocks-style-css',
		get_template_directory_uri() . '/admin/dq-blocks/dist/blocks.style.build.css',
		array(),
		filemtime( get_stylesheet_directory() . '/admin/dq-blocks/dist/blocks.style.build.css')
	);

}
add_action( 'init', 'dq_blocks_block_assets' );

/** --------------------------------------------------------------------------------- *
 *  后端编辑器加载JS
 *  --------------------------------------------------------------------------------- */

function dq_blocks_editor_assets() {

	// 将编译后的块加载到编辑器中
	wp_enqueue_script(
		'dq-blocks-block-js',
		get_template_directory_uri() . '/admin/dq-blocks/dist/blocks.build.js',
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor' ),
		//'1.0.0',
		filemtime( get_stylesheet_directory() . '/admin/dq-blocks/dist/blocks.build.js'),
		true
	);

	wp_enqueue_style(
		'dq-blocks-block-editor-css',
		get_template_directory_uri() . '/admin/dq-blocks/dist/blocks.editor.build.css',
		array( 'wp-edit-blocks' ),
		filemtime( get_stylesheet_directory() . '/admin/dq-blocks/dist/blocks.editor.build.css')
	);

	$user_data = wp_get_current_user();
	unset( $user_data->user_pass, $user_data->user_email );

	// 传入 REST URL
	wp_localize_script(
		'dq-blocks-block-js',
		'dq_globals',
		array(
			'rest_url'      => esc_url( rest_url() ),
			'user_data'     => $user_data,
			'is_wpe'        => function_exists( 'is_wpe' ),
		)
	);
}
add_action( 'enqueue_block_editor_assets', 'dq_blocks_editor_assets' );


/** --------------------------------------------------------------------------------- *
 *  添加块类别
 *  --------------------------------------------------------------------------------- */

add_filter( 'block_categories', 'dq_blocks_add_custom_block_category' );
function dq_blocks_add_custom_block_category( $categories ) {

	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'dq-blocks',
				'title' => 'DQTheme Blocks',
			),
		)
	);
}
