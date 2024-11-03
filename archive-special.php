<?php
get_header();?>

<section class="blog-section">
  <div class="container">

    <div class="special-list-main">
      <h1><?php echo dq('special_title');?></h1>
      <div class="loop-special">
        <ul>

          <?php
          $args = array(
            'posts_per_page'        => '100',
            'ignore_sticky_posts'   => true,
            'no_found_rows'         => true,
            'post_status'           => 'publish',
            'post_type'             => 'special',
          );
          $special_posts = new WP_Query( $args );
          if ( $special_posts->have_posts() ) :
          while ( $special_posts->have_posts() ) : $special_posts->the_post();?>
                         
          <li>
            <a href="<?php the_permalink(); ?>">
              <img width="600" height="400" src="<?php echo post_thumbnail(600,400);?>" class="special-img" alt="<?php echo post_thumbnail_alt();?>" /></a>
            <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
          </li>

          <?php endwhile; endif;?>

        </ul>
      </div>
    </div>

  </div>
</section>
<?php
get_footer();?>