<div class="related-posts mt-40">
	<div class="related-title mb-15">Related Posts:</div>
	<ul>

	<?php
	$related_posts = get_post_meta( get_the_ID(), 'extend_info', true );
	$related_posts_id	= isset($related_posts['related_posts_id']) ?$related_posts['related_posts_id'] : '';
	//$posts = array();
	if( is_array( $related_posts_id ) ){
		foreach ( $related_posts_id as $value) {
			$posts = get_posts("post_type=any&include=".$value.""); if($posts) : foreach( $posts as $post ) : setup_postdata( $post );
			echo '<li><a href="'.get_permalink().'" target="_blank" rel="bookmark" title="'.get_the_title().'">'.get_the_title().'</a></li>';
		endforeach; endif; wp_reset_query();
		}
	}else{
		$post_num = 5;
		$exclude_id = $post->ID;
		$posttags = get_the_tags(); $i = 0;
		if ( $posttags ) {
			$tags = '';
			foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
			$args = array(
				'post_status' => 'publish',
				'tag__in' => explode(',', $tags),
				'post__not_in' => explode(',', $exclude_id),
				'ignore_sticky_posts' => 1,
				'orderby' => 'comment_date',
				'showposts' => $post_num
			);
			query_posts($args);
			while( have_posts() ) { the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>" target="_blank" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</li>
			<?php
			$exclude_id .= ',' . $post->ID; $i ++;
			}
			wp_reset_query();
		}
		if ( $i < $post_num ) {
			$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
			$args = array(
				'category__in' => explode(',', $cats),
				'post__not_in' => explode(',', $exclude_id),
				'ignore_sticky_posts' => 1,
				'orderby' => 'comment_date',
				'showposts' => $post_num - $i
			);
			query_posts($args);
			while( have_posts() ) {the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>" target="_blank" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</li>
			<?php
			$i++; }
			wp_reset_query();
		}

	//if ( $i  == 0 )  echo '<li>暂无相关文章!</li>';
	}?>
	</ul>
</div>
