<?php
/**
 * @Author: 大胡子
 * @Email:  dq@dqtheme.com
 * @Link:   www.dq.me
 * @Date:   2020-10-17 22:19:20
 * @Last Modified by:   dq
 * @Last Modified time: 2020-12-30 11:41:35
 */
$post_img_height = '230';
$post_img_width = '350';
get_header();
get_template_part( 'template-parts/home-modular/banner');
$banner = dqtheme('banner');?>

<section class="blog-section sidebar" style="background-color:#f7f7f7;padding-top: 30px;">
  <div class="container">
    <div class="row">
    <?php if( dqtheme('dq_sidebar_right') ){ get_sidebar(); }?>
    <div class="col-md-8 col-lg-9">
      <div class="row">
        <?php
        if ( have_posts() ) {
      while ( have_posts() ) {
        the_post();
        include TEMPLATEPATH.'/template-parts/loop/5.php';
      }

    } else {
      echo '<p>抱歉，当前网站没有已发布文章！</p>';
    }?>
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

<?php
get_footer();
