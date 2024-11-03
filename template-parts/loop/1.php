
<?php

if( is_archive() ){

    if( $cat_posts_num == '4' ){?>
        <div class="col-md-3">
    <?php }else{?>
        <div class="col-md-4">
    <?php }?>

<?php }else{?>

    <?php if($modular_col_post_num == '4'){?>
        <div class="col-md-3">
    <?php }else{?>
        <div class="col-md-4">
    <?php }?>

<?php }?>
    <div class="service-item style-4">
        <div class="thumb">
        	<a href="<?php the_permalink(); ?>" target="_blank">
                <img loading="lazy" alt="<?php echo post_thumbnail_alt();?>" src="<?php echo post_thumbnail($post_img_width,$post_img_height); ?>">
            </a>
            <?php
            $badge = display_produc_radio_badge();
            if (!empty($badge)) {
                echo '<span class="badge">' . $badge . '</span>';
            }
                ?>
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