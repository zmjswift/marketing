<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$modular_category = isset( $id['modular_category'] ) ? $id['modular_category'] : '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
?>

<section class="home-modular-12 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
  <div class="container">
    <?php if( $modular_title || $modular_describe ){?>
    <div class="section-title">
      <?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
      <?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; }?>
    </div>
    <?php }?>
    <div <?php if( ! empty($id['modular_mobile_slider']) && wp_is_mobile() ){ echo 'class="owl-carousel" id="modular_12_mobile_slider"'; }else{ echo 'class="row"'; }?>>
    <?php
    if(is_array( $modular_category )){
    $s = 1;
    foreach ($modular_category as $cat=>$catid ){?>
      <div class="col-lg-4">
        <div class="modular-12">
          <div class="newscat">
            <h3>
              <a href="<?php echo get_category_link($catid);?>" target="_blank"><?php echo get_cat_name( $catid );?></a>
            </h3>
            <span class="more">
              <a href="<?php echo get_category_link($catid);?>" rel="nofollow" target="_blank"><svg t="1608448718517" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2865" width="14" height="14"><path d="M512 224.85m-82.04 0a82.04 82.04 0 1 0 164.08 0 82.04 82.04 0 1 0-164.08 0Z" fill="#666666" p-id="2866"></path><path d="M512 512m-82.04 0a82.04 82.04 0 1 0 164.08 0 82.04 82.04 0 1 0-164.08 0Z" fill="#666666" p-id="2867"></path><path d="M512 799.15m-82.04 0a82.04 82.04 0 1 0 164.08 0 82.04 82.04 0 1 0-164.08 0Z" fill="#666666" p-id="2868"></path></svg></a>
            </span>
          </div>
          <?php
          $args = array(
            'no_found_rows' => true,
            'ignore_sticky_posts' => 1,
            'posts_per_page' => 7,
            'cat' => $catid
          );
          $cat_posts = Dq_Query($args);
          $i = 1;
          while( $cat_posts->have_posts() ): $cat_posts->the_post();?>

          <?php if($i == 1){ ?>
          <div class="news_top">
            <a href="<?php the_permalink(); ?>" target="_blank"><img src="<?php echo post_thumbnail(500,216); ?>" alt="<?php echo post_thumbnail_alt();?>" loading="lazy" /></a>
            <a class="news_title_1" href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a>
          </div>
          <div class="news_list">
            <ul>
              <?php }else{ ?>
              <li>
                <a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a>
              </li>
              <?php } ?>
              <?php $i++; endwhile; wp_reset_query();?>
            </ul>
          </div>
        </div>
      </div>
    <?php } }?>
    </div>
  </div>
</section>
