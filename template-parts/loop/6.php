<?php

if( is_archive() ){

    if( $cat_posts_num == '4' ){?>
        <div class="col-md-3 video-item">
    <?php }else{?>
        <div class="col-md-4 video-item">
    <?php }?>

<?php }else{?>

    <?php if($modular_col_post_num == '4'){?>
        <div class="col-md-3 video-item">
    <?php }else{?>
        <div class="col-md-4 video-item">
    <?php }?>

<?php }?>

    <div class="service-item style-4">
        <div class="thumb">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo get_post_meta( get_the_ID(), 'youtube_id', true );?>" frameborder="0" allowfullscreen=""></iframe>
        </div>
        <?php
            $badge = display_produc_radio_badge();
            if (!empty($badge)) {
                echo '<span class="product-badge">' . $badge . '</span>';
            }
                ?>
        <div class="content">
            <?php if( is_sticky() ){ echo '<div class="post-sticky">Sticky</div>'; }?>
        	<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        </div>
    </div>
</div>