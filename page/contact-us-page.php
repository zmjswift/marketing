<?php
/*
Template Name: 带产品信息留言页面
*/
get_header();
$postID = intval($_GET['product_id']);
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
<style>
.productImg img{width: 80px;height: auto;}
.productImg {
  display: flex;
  align-items: center;
  padding: 10px 0px;
}

.productImg a {
  text-decoration: none; /* 去掉链接的下划线 */
  display: flex;
  align-items: center;
}

.productImg a h4 {
  margin-left: 10px; /* 标题与缩略图之间的间距 */
}

</style>
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
            <?php if( $postID >= 1 ) { ?>
              <div class="productImg">
                    <a target="_blank" title="<?php echo get_post( $postID )->post_title; ?>" href="<?php echo get_permalink( $postID ) ?>">
                    <?php if ( has_post_thumbnail( $postID ) ){  
                      echo get_the_post_thumbnail( $postID, 'thumbnail' ); 
                      } ?>
                    <h4><?php echo get_post( $postID )->post_title; ?></h4>
                      </a>
            </div>
              <?php } ?>
            <?php /* Start the Loop */
            while ( have_posts() ) : the_post();
                the_content();
            endwhile; // End of the loop. ?>

          </div>

          <?php comments_template();?>

        </div>
      </div>

    </div>
  </div>
</section>

<?php get_footer(); ?>