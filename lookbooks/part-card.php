<div class="look_card" id="<?php the_ID(); ?>" data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>">
	<a class="image-container" href="<?php the_permalink(); ?>" rel="<?php the_permalink(); ?>">
		<div class="main-carousel1">
			<img class="carousel-cell" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" img-background="<?php echo get_the_post_thumbnail_url(); ?>">
		</div>
	</a>
	<div class="info-container">
		<h3><?php the_title(); ?></h3>
		<div class="icons">
			<div class="icon">
				<div class="share-look">
					<img src="<?php echo get_template_directory_uri(); ?>/lookbooks/static/picture/share_black.svg" alt="share">
				</div>
			</div>
		</div>
	</div>
</div>