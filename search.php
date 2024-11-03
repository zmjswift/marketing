<?php
$post_img_height = dq_taxonomy('post_img_height') ?: '230';
$post_img_width = dq_taxonomy('post_img_width') ?: '350';
get_header();?>

<?php
//echo dq_search_analysis($s);
$banner_img = dqtheme('header_banner_img_default');
if( dqtheme('header_type') == '1'){?>
<section class="inner-area text-align-left" style="background-image: url('<?php echo $banner_img['url'];?>');">
  <div class="container">
    <div class="section-content">
      <div class="row">
        <div class="col-12">
          <h4>搜索：<?php echo get_search_query(); ?></h4>
          <?php //global $wp_query; echo '共搜索到 ' . $wp_query->found_posts . ' 篇文章';?>
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
        while( have_posts() ): the_post();?>

        <div class="col-md-6 col-lg-12 cat-5-item">
          <div class="projects-item">
            <div class="thumb">
              <a href="<?php the_permalink(); ?>">
                <img loading="lazy" src="<?php echo post_thumbnail($post_img_width,$post_img_height); ?>" alt="<?php echo post_thumbnail_alt();?>">
              </a>
            </div>
            <div class="content">
                <?php if( is_sticky() ){ echo '<div class="post-sticky">置顶</div>'; }?>
                <h2>
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_the_title();?></a>
                </h2>
                <!--div class="meta">
                    <div class="date">
                        <i class="fa fa-clock-o"></i> <?php the_time('Y-m-d') ?>
                    </div>
                </div-->
                <?php dq_excerpt( 300, '...' );?>
            </div>
          </div>
        </div>

        <?php endwhile; //结束while?>

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