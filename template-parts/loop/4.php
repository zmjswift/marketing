<div class="col-md-6 col-lg-12 cat-4-item">
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
        <h2>
            <a href="<?php the_permalink(); ?>" rel="bookmark" target="_blank"><?php the_title(); ?></a>
        </h2>
        <!--div class="meta">
            <div class="date">
                <i class="fa fa-clock-o"></i> <?php the_time('Y-m-d') ?>
            </div>
        </div-->
        <?php dq_excerpt( 300, '...' );?>
        <?php
      $current_category = get_queried_object();
      $category_id = $current_category->term_id;
      $is_cat_tags = get_term_meta($category_id, '_dq_taxonomy_options', true)['is_cat_tags'];
      $is_cat_contact = get_term_meta($category_id, '_dq_taxonomy_options', true)['is_cat_contact'];
      if ($is_cat_tags) {
      $tags = get_the_tags(get_the_ID());
      if ( $tags ) {
          echo '<p>';
          $tag_count = 0;
          foreach( $tags as $tag ) {
              if ($tag_count < 3) { 
                  echo '<a href="' . get_tag_link($tag->term_id) . '" target="_blank">' . $tag->name . '</a>';
                  $tag_count++;
                  if ($tag_count < 3) {
                      echo '  '; 
                  }
              }
          }
          echo '</p>';
      }
    }
    $cat_contact_text = get_term_meta($category_id, '_dq_taxonomy_options', true)['cat_contact_text'];
    $cat_contact_text_color = get_term_meta($category_id, '_dq_taxonomy_options', true)['cat_contact_text_color'];
    $cat_contact_color = get_term_meta($category_id, '_dq_taxonomy_options', true)['cat_contact_color'];
    $post_id = get_the_ID();
    if ($is_cat_contact) {
    echo '<li class="menu-item-btn" style="padding-left: 0px;"><a href="/contact.html?product_id='.$post_id.'" target="_blank" rel="nofollow" style="color: '.$cat_contact_text_color.'!important;background-color: '.$cat_contact_color.';">'.$cat_contact_text.'</a></li>';
    }
      ?>
        <!--<a class="project-btn" href="<?php the_permalink(); ?>" target="_blank">More</a>-->
    </div>
  </div>
</div>
