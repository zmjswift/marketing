<?php
/*
Template Name: 在线留言页面
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

<section class="blog-section sidebar">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="single-breadcrumbs">
          <?php if (function_exists('get_breadcrumbs')){get_breadcrumbs(); } ?>
        </div>
        <div class="blog-details">
          <div class="details-content mb-40">
            <?php if( !has_post_thumbnail() ){?>
            <h1><?php the_title_attribute(); ?></h1>
            <?php }?>
            <?php if( !empty($single_ad['single_ad_top']['url']) ){?>
            <div class="single-top">
              <?php if( !empty($single_ad['single_ad_top_url']) ){?><a href="<?php echo $single_ad['single_ad_top_url'];?>" target="_blank" rel="nofollow"><?php }?>
                  <img src="<?php echo $single_ad['single_ad_top']['url'];?>" alt="<?php echo $single_ad['single_ad_top']['title'];?>">
              <?php if( !empty($single_ad['single_ad_top_url']) ){?></a><?php }?>
            </div>
            <?php }?>

            <?php /* Start the Loop */
            while ( have_posts() ) : the_post();
                the_content();
            endwhile; // End of the loop. ?>

            <?php if( !empty($single_ad['single_ad_bottom']['url']) ){?>
            <div class="single-bottom">
              <?php if( !empty($single_ad['single_ad_bottom_url']) ){?><a href="<?php echo $single_ad['single_ad_bottom_url'];?>" target="_blank" rel="nofollow"><?php }?>
                  <img src="<?php echo $single_ad['single_ad_bottom']['url'];?>" alt="<?php echo $single_ad['single_ad_bottom']['title'];?>">
              <?php if( !empty($single_ad['single_ad_bottom_url']) ){?></a><?php }?>
            </div>
            <?php }?>

          </div>

          <?php get_template_part( 'template-parts/dq_contact');?>

        </div>
      </div>

    </div>
  </div>
</section>

<?php get_footer(); ?>