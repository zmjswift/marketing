<?php
/**
 * 布局块相关功能
 *
 * @package DqBlocks
 */

use DqBlocks\Layouts\Component_Registry;

/**
 * 向组件注册表注册布局组件
 * 在布局块中使用
 *
 * @param array $data The component data.
 *
 * @return bool|WP_Error
 */
function dq_blocks_register_layout_component( array $data ) {

	$registry = Component_Registry::instance();

	try {
		$registry::add( $data );
		return true;
	} catch ( Exception $exception ) {
		return new WP_Error( esc_html( $exception->getMessage() ) );
	}
}

/**
 * Unregisters the specified layout component from the Component Registry
 * for use in the Layouts block.
 *
 * @return mixed Boolean true if component unregistered. WP_Error object if an error occurs.
 * @param string $type The component type to be unregistered.
 * @param string $key The unique layout key to be unregistered.
 */
function dq_blocks_unregister_layout_component( $type, $key ) {
	$registry = Component_Registry::instance();
	try {
		$registry::remove( $type, $key );
		return true;
	} catch ( Exception $exception ) {
		return new WP_Error( esc_html( $exception->getMessage() ) );
	}
}

/**
 * Retrieves the specified layout component.
 *
 * @param string $type The layout component type.
 * @param string $key The layout component's unique key.
 *
 * @return mixed|WP_Error
 */
function dq_blocks_get_layout_component( $type, $key ) {

	if ( empty( $type ) ) {
		return new WP_Error( esc_html__( '必须提供类型才能检索布局组件', 'dq-blocks' ) );
	}

	if ( empty( $key ) ) {
		return new WP_Error( esc_html__( '必须提供键才能检索布局组件', 'dq-blocks' ) );
	}

	$type = sanitize_key( $type );

	$key = sanitize_key( $key );

	$registry = Component_Registry::instance();

	try {
		return $registry::get( $type, $key );
	} catch ( Exception $exception ) {
		return new WP_Error( esc_html( $exception->getMessage() ) );
	}
}

/**
 * 注册布局
 *
 * @return array Array of registered layouts.
 */
function dq_blocks_get_layouts() {
	$registry = Component_Registry::instance();
	return $registry::layouts();
}

/**
 * 获取已注册的节
 *
 * @return array Array of registered sections.
 */
function dq_blocks_get_sections() {
	$registry = Component_Registry::instance();
	return $registry::sections();
}
