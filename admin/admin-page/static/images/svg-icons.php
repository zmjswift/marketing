<?php

/**
 * @Author: 大胡子
 * @Email:  dq@dqtheme.com
 * @Link:   www.dq.me
 * @Date:   2021-01-05 23:30:33
 * @Last Modified by:   dq
 * @Last Modified time: 2021-01-05 23:37:58
 */

/** --------------------------------------------------------------------------------- *
 *  SVG图标
 *  --------------------------------------------------------------------------------- */
if ( ! function_exists( 'dq_admin_svg' ) ) {
	
	// 输出并获取SVG图标
	function dq_admin_svg( $svg_name, $group = 'ui', $color = '' ) {
		echo dq_admin_get_svg( $svg_name, $group, $color );
		//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in dq_admin_get_svg();.
	}
}

if ( ! function_exists( 'dq_admin_get_svg' ) ) {

	// 获取有关SVG图标的信息
	function dq_admin_get_svg( $svg_name, $group = 'ui', $color = '' ) {

		// 确保仅包含我们允许的标签和属性
		$svg = wp_kses(
			Dq_Admin_Page_SVG_Icons::get_svg( $svg_name, $group, $color ),
			array(
				'svg'     => array(
					'class'       => true,
					'xmlns'       => true,
					'width'       => true,
					'height'      => true,
					'viewbox'     => true,
					'aria-hidden' => true,
					'role'        => true,
					'focusable'   => true,
				),
				'path'    => array(
					'fill'      => true,
					'fill-rule' => true,
					'd'         => true,
					'transform' => true,
				),
				'polygon' => array(
					'fill'      => true,
					'fill-rule' => true,
					'points'    => true,
					'transform' => true,
					'focusable' => true,
				),
			)
		);

		if ( ! $svg ) {
			return false;
		}
		return $svg;
	}
}
