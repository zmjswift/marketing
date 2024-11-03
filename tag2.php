<?php
$post_img_height = dq_taxonomy('post_img_height') ?: '230';
$post_img_width = dq_taxonomy('post_img_width') ?: '350';
get_header();?>

<?php
$banner_img = dqtheme('header_banner_img_default');
if( dqtheme('header_type') == '1'){?>
<section class="inner-area text-align-left" style="background-image: url('<?php echo $banner_img['url'];?>');">
  <div class="container">
    <div class="section-content">
      <div class="row">
        <div class="col-12">
          <h4># <?php echo single_term_title(); ?></h4>
        </div>
      </div>
    </div>
  </div>
</section>
<?php }?>

<section class="breadcrumbs">
	<div class="container">
      <?php if (function_exists('get_breadcrumbs')){get_breadcrumbs(); } ?>
	</div>
</section>

<section class="blog-section sidebar">
  <div class="container">
    <div class="row">

    <?php if( dqtheme('dq_sidebar_right') ){ get_sidebar(); }?>
    <div class="col-md-8 col-lg-9">
      <div class="row">

        <?php
        while( have_posts() ): the_post();
        include TEMPLATEPATH.'/template-parts/loop/5.php';
        endwhile; //结束while?>

      </div>
    </div>
    <?php if( !dqtheme('dq_sidebar_right') ){ get_sidebar(); }?>

    </div>
  </div>
</section>

<section class="paging-section text-center pt-0 pb-70">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-link-item">
          <ul>
            <?php par_pagenavi(9); ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer();?>