<?php

$special = get_post_meta( get_the_ID(), 'post_type_special', true );

get_header();?>

<div class="special-banner">
	<img src="<?php echo $special['special_banner']['url'];?>" alt="<?php the_title();?>">
</div>

<section class="blog-section">
  <div class="container">

    <div class="special-list-main">
		<div class="special-content">
			<h1 class="special-title"><?php the_title();?></h1>
			<?php echo wpautop( $special['special_desc'] );?>
		</div>
		<div class="loop-special">
			<ul>


			<?php
			$posts = array();
			if( is_array( $special['special_posts'] ) ){
			foreach ( $special['special_posts'] as $value) {
			    $posts = get_posts("post_type=any&include=".$value."");
			    if($posts) : foreach( $posts as $post ) : setup_postdata( $post );?>

				<li>
					<a href="<?php the_permalink();?>" target="_blank">
						<img width="600" height="400" src="<?php echo post_thumbnail(600,400);?>" class="special-img" alt="<?php echo post_thumbnail_alt();?>" />
					</a>
					<a href="<?php the_permalink();?>" target="_blank"><?php the_title();?></a>
				</li>

				<?php endforeach; endif; wp_reset_query();
			} }?>

	        </ul>
		</div>
    </div>

  </div>
</section>
<?php
get_footer();?>