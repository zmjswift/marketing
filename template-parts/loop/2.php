<?php if( is_archive() ){

    if( $cat_posts_num == '4' ){
        echo '<div class="col-md-6 col-lg-3 item">';
    }else{
        echo '<div class="col-md-6 col-lg-4 item">';
    }

}else{
    echo '<div class="item">';
}?>
    <div class="projects-item">
        <div class="thumb">
            <a href="<?php the_permalink(); ?>" target="_blank">
            <img src="<?php echo post_thumbnail($post_img_width,$post_img_height); ?>" alt="<?php echo post_thumbnail_alt();?>" loading="lazy">
            </a>
            <?php
            $badge = display_produc_radio_badge();
            if (!empty($badge)) {
                echo '<span class="product-badge">' . $badge . '</span>';
            }
                ?>

        </div>
        <div class="content">
            <?php if( is_sticky() ){ echo '<div class="post-sticky">Sticky</div>'; }?>
            <h2><a href="<?php the_permalink(); ?>" rel="bookmark" target="_blank"><?php the_title(); ?></a></h2>
            <?php dq_excerpt( 120, '...' );?>
            <a href="<?php the_permalink(); ?>" target="_blank">More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
        </div>
    </div>
</div>