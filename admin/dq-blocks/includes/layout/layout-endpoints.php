<?php
/**
 * 节和布局的restapi端点
 */

namespace DqBlocks\Layouts;

use \WP_REST_Response;
use \WP_REST_Server;

const DB_API_NAMESPACE = 'dqblocks/v1';

const LAYOUTS_ROUTE       = 'layouts';
const SINGLE_LAYOUT_ROUTE = 'layouts/([A-Za-z])\w+/';

const SECTIONS_ROUTE       = 'sections';
const SINGLE_SECTION_ROUTE = 'sections/([A-Za-z])\w+/';

const FAVORITE_LAYOUTS_ROUTE = 'layouts/favorites';
const ALL_LAYOUTS_ROUTE      = 'layouts/all';

add_action( 'rest_api_init', __NAMESPACE__ . '\register_layout_endpoints' );
/**
 * 为块设置创建自定义端点
 */
function register_layout_endpoints() {

	/**
	 * 注册收藏夹获取 api
	 */
	register_rest_route(
		DB_API_NAMESPACE,
		FAVORITE_LAYOUTS_ROUTE,
		[
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => function () {
				return new WP_REST_Response( (array) get_user_meta( get_current_user_id(), 'dq_blocks_favorite_layouts', true ) );
			},
			'permission_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
		]
	);

	/**
	 * 注册layouts GET api
	 * 它合并了所有部分、布局和其他布局
	 */
	register_rest_route(
		DB_API_NAMESPACE,
		ALL_LAYOUTS_ROUTE,
		[
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => function ( \WP_REST_Request $request ) {

				$layouts            = dq_blocks_get_layouts();
				$sections           = dq_blocks_get_sections();
				$additional_layouts = apply_filters( 'dq_blocks_additional_layout_components', [] );
				$all_layouts        = array_merge( $layouts, $sections, $additional_layouts );
				$request_params     = $request->get_params();

				// 如果未请求筛选，则返回所有布局。“allowed”是当前支持的唯一筛选器。
				if ( empty( $request_params['filter'] ) || 'allowed' !== $request_params['filter'] ) {
					return new WP_REST_Response( $all_layouts );
				}

				/**
				 * 过滤允许在布局库中显示的节和布局列表。
				 *
				 */
				$allowed_layouts = (array) apply_filters( 'dq_blocks_allowed_layout_components', array_keys( $all_layouts ) );

				if ( empty( $allowed_layouts ) ) {
					return new WP_REST_Response( [] );
				}

				$filtered_layouts = [];

				foreach ( $all_layouts as $key => $layout ) {
					if ( in_array( $key, $allowed_layouts, true ) ) {
						$filtered_layouts[ $key ] = $layout;
					}
				}

				return new WP_REST_Response( $filtered_layouts );
			},
			'permission_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
		]
	);

	/**
	 * 注册layouts GET api
	 */
	register_rest_route(
		DB_API_NAMESPACE,
		LAYOUTS_ROUTE,
		[
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => function () {
				return new WP_REST_Response( (array) dq_blocks_get_layouts() );
			},
			'permission_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
		]
	);

	/**
	 * 注册单个布局获取终api
	 */
	register_rest_route(
		DB_API_NAMESPACE,
		SINGLE_LAYOUT_ROUTE,
		[
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => function ( $request ) {
				$route      = $request->get_route();
				$layout_key = substr( strrchr( $route, '/' ), 1 );
				$layouts    = dq_blocks_get_layouts();
				if ( isset( $layouts[ $layout_key ] ) ) {
					return new WP_REST_Response( $layouts[ $layout_key ] );
				}

				return new WP_REST_Response( esc_html__( '找不到布局', 'dq-blocks' ) );
			},
			'permission_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
		]
	);

	/**
	 * 注册收藏夹更新终api
	 */
	register_rest_route(
		DB_API_NAMESPACE,
		FAVORITE_LAYOUTS_ROUTE,
		[
			'methods'             => 'PATCH',
			'callback'            => function ( $request ) {

				$body      = json_decode( $request->get_body(), true );
				$new       = sanitize_key( $body['dq_blocks_favorite_key'] );
				$favorites = (array) get_user_meta( get_current_user_id(), 'dq_blocks_favorite_layouts', true );

				if ( in_array( $new, $favorites, true ) ) {
					return new WP_REST_Response( $favorites );
				}

				if ( empty( $favorites[0] ) ) {
					$favorites = array( $new );
				} else {
					$favorites[] = $new;
				}

				update_user_meta( get_current_user_id(), 'dq_blocks_favorite_layouts', array_values( $favorites ) );

				return new WP_REST_Response( (array) get_user_meta( get_current_user_id(), 'dq_blocks_favorite_layouts', true ) );
			},
			'permission_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
		]
	);

	/**
	 * 注册收藏夹删除api
	 */
	register_rest_route(
		DB_API_NAMESPACE,
		FAVORITE_LAYOUTS_ROUTE,
		[
			'methods'             => 'DELETE',
			'callback'            => function ( $request ) {

				$body      = json_decode( $request->get_body(), true );
				$delete_id = sanitize_key( $body['dq_blocks_favorite_key'] );
				$favorites = (array) get_user_meta( get_current_user_id(), 'dq_blocks_favorite_layouts', true );

				if ( ! in_array( $delete_id, $favorites, true ) ) {
					return new WP_REST_Response( $favorites );
				}

				$position = array_search( $delete_id, $favorites, true );

				unset( $favorites[ $position ] );

				update_user_meta( get_current_user_id(), 'dq_blocks_favorite_layouts', array_values( $favorites ) );

				return new WP_REST_Response( (array) get_user_meta( get_current_user_id(), 'dq_blocks_favorite_layouts', true ) );
			},
			'permission_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
		]
	);

	/**
	 * 注册区段GET api  返回所有已注册的节
	 */
	register_rest_route(
		DB_API_NAMESPACE,
		SECTIONS_ROUTE,
		[
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => function () {
				return new WP_REST_Response( (array) dq_blocks_get_sections() );
			},
			'permission_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
		]
	);
}
