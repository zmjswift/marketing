<div class="related-posts mt-40">
	<div class="related-title mb-15">Related Products:</div>
	<ul>
    <div class="row">
	<?php
		$post_num = 4;
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
				'showposts' => $post_num,
                'category__not_in' => [12]
			);
			query_posts($args);
			while( have_posts() ) { the_post(); ?>
            <div class="col-md-3">
                <div class="service-item style-4">
                    <div class="thumb">
                    	<a href="<?php the_permalink(); ?>" target="_blank">
                            <img loading="lazy" alt="<?php echo post_thumbnail_alt();?>" src="<?php echo post_thumbnail(500,500); ?>">
                        </a>
                    	<div class="service-link-box">
                    		<a href="<?php the_permalink(); ?>" target="_blank">More</a>
                    	</div>
                    </div>
                    <div class="content">
                        <?php if( is_sticky() ){ echo '<div class="post-sticky">Sticky</div>'; }?>
                    	<h2><a href="<?php the_permalink(); ?>" rel="bookmark" target="_blank"><?php the_title(); ?></a></h2>
                    </div>
                </div>
            </div>
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
            <div class="col-md-3">
                <div class="service-item style-4">
                    <div class="thumb">
                    	<a href="<?php the_permalink(); ?>" target="_blank">
                            <img loading="lazy" alt="<?php echo post_thumbnail_alt();?>" src="<?php echo post_thumbnail(500,500); ?>">
                        </a>
                    	<div class="service-link-box">
                    		<a href="<?php the_permalink(); ?>" target="_blank">More</a>
                    	</div>
                    </div>
                    <div class="content">
                        <?php if( is_sticky() ){ echo '<div class="post-sticky">Sticky</div>'; }?>
                    	<h2><a href="<?php the_permalink(); ?>" rel="bookmark" target="_blank"><?php the_title(); ?></a></h2>
                    </div>
                </div>
            </div>
			<?php
			$i++; }
			wp_reset_query();
		}

	//if ( $i  == 0 )  echo '<li>暂无相关文章!</li>';
	?>
	</div>
	</ul>
</div>
