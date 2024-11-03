<?php
get_header();
if( has_post_thumbnail() ){?>
<section class="inner-area text-align-left" style="background-image: url('<?php the_post_thumbnail_url(); ?>');">
  <div class="container">
    <div class="section-content">
      <div class="row">
        <div class="col-12">
          <h1><?php the_title_attribute(); ?></h1>
          <?php if (has_excerpt()) {
            dq_excerpt( 120, '...' );
          }?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php }?>

<section class="blog-section sidebar">
  <div class="container">
    <div class="row">
      <?php if( dqtheme('dq_sidebar_right') && !dqtheme('post_no_sidebar_all') ){ get_sidebar(); }?>
      <div class="col-md-8 col-lg-9">
        <div class="single-breadcrumbs">
          <?php if (function_exists('get_breadcrumbs')){get_breadcrumbs(); } ?>
        </div>
        <div class="blog-details">
          <div class="details-content mb-40">
            <?php if( !has_post_thumbnail() ){?>
            <h1><?php the_title_attribute(); ?></h1>
            <?php }?>

            <?php /* Start the Loop */
            while ( have_posts() ) : the_post();
                the_content();
            endwhile; // End of the loop. ?>

          </div>

          <?php comments_template();?>

        </div>
      </div>
      <?php if( !dqtheme('dq_sidebar_right') && !dqtheme('post_no_sidebar_all') ){ get_sidebar(); }?>
    </div>
  </div>
</section>


<?php get_footer(); ?>