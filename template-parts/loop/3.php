<?php

if( is_archive() ){

    if( $cat_posts_num == '4' ){?>
        <div class="col-md-6 col-lg-3">
    <?php }else{?>
        <div class="col-md-6 col-lg-4">
    <?php }?>

<?php }else{?>

    <?php if($modular_col_post_num == '4'){?>
        <div class="col-md-6 col-lg-3">
    <?php }else{?>
        <div class="col-md-6 col-lg-4">
    <?php }?>

<?php }?>

    <div class="blog-post">
        <div class="thumb">
            <a href="<?php the_permalink(); ?>" target="_blank" aria-label="Read more about <?php the_title(); ?>">
            <img src="<?php echo post_thumbnail($post_img_width,$post_img_height); ?>" alt="<?php echo post_thumbnail_alt();?>" loading="lazy">
            </a>
            <?php
            $badge = display_produc_radio_badge();
            if (!empty($badge)) {
                echo '<span class="badge">' . $badge . '</span>';
            }
                ?>
        </div>
        <div class="content">
            <h3><a href="<?php the_permalink(); ?>" rel="bookmark" target="_blank"><?php the_title(); ?></a></h3>
            <?php dq_excerpt( 120, '...' );?>
        </div>
        <?php
      $current_category = get_queried_object();
      $category_id = $current_category->term_id;
      $is_cat_tags = get_term_meta($category_id, '_dq_taxonomy_options', true)['is_cat_tags'];
      $is_cat_contact = get_term_meta($category_id, '_dq_taxonomy_options', true)['is_cat_contact'];
      $cat_contact_text = get_term_meta($category_id, '_dq_taxonomy_options', true)['cat_contact_text'];
      $cat_contact_text_color = get_term_meta($category_id, '_dq_taxonomy_options', true)['cat_contact_text_color'];
      $cat_contact_color = get_term_meta($category_id, '_dq_taxonomy_options', true)['cat_contact_color'];
      $post_id = get_the_ID();
      if ($is_cat_contact) {
      echo '<a href="/contact.html?product_id='.$post_id.'" class="read-btn" target="_blank"  style="color: '.$cat_contact_text_color.'!important;background-color: '.$cat_contact_color.';">'.$cat_contact_text.'</a>';
      }
        ?>
        <!--<a href="<?php the_permalink(); ?>" class="read-btn" target="_blank">More
        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
        </a>-->
    </div>
    <?php if( is_sticky() ){ echo '<div class="post-sticky">Sticky</div>'; }?>
</div>