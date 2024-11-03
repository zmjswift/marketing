<?php
$module_title    = $id['module_title'] ?: '';
$module_button   = $id['module_button'] ?: '';
$modular_33_cat  = $id['modular_33_cat'] ?: '';
$ids_array = explode(',', $modular_33_cat);
?>

<div class="recent-post-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="section-title-one"><?php echo $module_title; ?></h3>
            </div>
        </div>

        

            <?php
			$args = array(
			'post__in' => $ids_array, 
			'orderby' => 'post__in',
			);
			$data = new WP_Query($args);
			?>

            <?php if ($data->have_posts()) : ?>
                <?php while ($data->have_posts()) : $data->the_post(); ?>
<div class="row post-wrapper">
                    <div class="col-xl-3 offset-xl-2 col-lg-4 offset-lg-1 col-md-5 my-auto">
                        <a href="#" class="post-thumbnail">
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" style="max-height: 180px;">
                        </a>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-7 my-auto">
                        <div class="recent-post-content">

                            <a href="<?php the_permalink(); ?>">
                                <h3 class="post-title"><?php the_title(); ?></h3>
                            </a>
                            <div class="excerpt">
                                <p><?php
								$excerpt = get_the_excerpt();
								echo mb_strimwidth($excerpt, 0, 240, '...');
								?></p>
                            </div>
                            
                            <a style="color: <?php echo $module_button[0]['color']; ?>;background: <?php echo $module_button[0]['background']; ?>;" href="<?php echo $module_button[0]['link']; ?>" class="wrd-read-more-button">
                                <?php echo $module_button[0]['title']; ?>
                            </a>
                            
                        </div>
                    </div>
</div>
                <?php endwhile; ?>
                <?php
                wp_reset_postdata();
                ?>
            <?php else : ?>
            <?php endif; ?>

        
    </div>
</div><!-- Recent Post Area End-->