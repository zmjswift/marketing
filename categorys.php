<?php
/*
Template Name: 分类聚合页
*/
$cat_layout = dq_taxonomy('cat_layout') ?: '1';
$cat_posts_num = dq_taxonomy('cat_posts_num') ?: '3';
$post_img_height = dq_taxonomy('post_img_height') ?: '230';
$post_img_width = dq_taxonomy('post_img_width') ?: '350';
$cat_posts_num_mobile = dq_taxonomy('cat_posts_num_mobile') ?: '2';
get_header(); ?>

<?php
$banner_img = dq_taxonomy('cat_banner_img');
if ($banner_img['url'] || dqtheme('header_type') == '1') { ?>
  <section class="inner-area <?php if (dq_taxonomy('banner_cat_desc') == '2') {
                                echo ' text-align-left';
                              } ?>" style="background-image: url('<?php echo $banner_img['url']; ?>');">
    <?php if (dq_taxonomy('banner_cat_desc') != '3') { ?>
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-12">
              <h4><?php echo get_the_title(); ?></h4>
              <?php echo get_post_field('post_content', get_the_ID()); ?>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </section>
<?php } ?>

<?php
$this_category = get_the_category();
$category_id = isset($this_category[0]->cat_ID) ? $this_category[0]->cat_ID : '';
$parent_id = get_category_root_id($category_id);
$category_link = get_category_link($parent_id);
$childcat = get_categories('child_of=' . $parent_id); ?>

<section class="breadcrumbs<?php if ($childcat && $parent_id) {
                              echo ' category-child-menu';
                            } ?>">
  <div class="container">
    <?php if ($childcat && $parent_id) { ?>
      <li<?php if ($cat == $parent_id) {
            echo ' class="current-cat"';
          } ?>>
               <a href="<?php echo get_category_link($parent_id); ?>" title="ALL" target="_blank">ALL</a>
        </li>
        <?php wp_list_categories("orderby=id&child_of=" . $parent_id . "&depth=2&title_li=0&hide_empty=0&children=1"); /* hierarchical=0 不显示子菜单下的子菜单 */ ?>
      <?php } else { ?>
        <?php if (function_exists('get_breadcrumbs')) {
          get_breadcrumbs();
        } ?>
      <?php }
    wp_reset_query(); ?>
  </div>
</section>

<section class="blog-section<?php if ($cat_layout == '5') { ?> sidebar<?php } ?>">
  <div class="container">
    <div class="row<?php if ($cat_posts_num_mobile == '2' && wp_is_mobile()) {
                      echo ' cat-mobile-col-2';
                    } ?>">

<?php include TEMPLATEPATH . '/template-parts/loop/7.php';?>
         
          </div>
        </div>
    </div>
  </div>
</section>


<?php get_footer(); ?>