<?php
/*
Template Name: 页面构建器
*/
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

<?php /* Start the Loop */
while ( have_posts() ) : the_post();
  the_content();
endwhile; // End of the loop. ?>

<?php get_footer(); ?>