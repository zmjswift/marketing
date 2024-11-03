<?php
/**
 * 容器块的服务器端渲染
 */

/**
 * 过滤单个块的内容
 *
 */
function dq_blocks_filter_container_block_for_amp( $block_content, $block ) {
	if ( ! (
		isset( $block['blockName'] )
		&&
		'dq-blocks/db-container' !== $block['blockName']
		&&
		function_exists( 'is_amp_endpoint' )
		&&
		is_amp_endpoint()
	) ) {
		$block_content = preg_replace(
			'/(?<=<img class="db-container-image has-background-dim")/',
			' object-fit="cover" ',
			$block_content
		);
	}

	return $block_content;
}
add_filter( 'render_block', 'dq_blocks_filter_container_block_for_amp', 10, 2 );
