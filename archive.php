<?php
$cat_layout = dq_taxonomy('cat_layout') ?: '1';
$cat_posts_num = dq_taxonomy('cat_posts_num') ?: '3';
$post_img_height = dq_taxonomy('post_img_height') ?: '230';
$post_img_width = dq_taxonomy('post_img_width') ?: '350';
$cat_posts_num_mobile = dq_taxonomy('cat_posts_num_mobile') ?: '2';
$tag_description = dq_taxonomy('tag_description');
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
              <h4><?php single_term_title(); ?></h4>
              <?php echo "<p>" . $tag_description . "</p>"; ?>
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

      <?php if ($cat_layout == '5') { ?>
        <?php if (dqtheme('dq_sidebar_right')) {
          get_sidebar();
        } ?>
        <div class="col-md-8 col-lg-9">
          <div class="row">
          <?php } ?>

          <?php
          $sticky_ids = get_option('sticky_posts');
          if (!empty($sticky_ids)) {
            $sticky = Dq_Query(array(
              'post__in'            => get_option('sticky_posts'),
              //'posts_per_page'      => 3,
              'ignore_sticky_posts' => true,
              'cat' => $cat
              // date descending is default sort so we don't need it explicitly
            ));
            while ($sticky->have_posts()) : $sticky->the_post();
              include TEMPLATEPATH . '/template-parts/loop/' . $cat_layout . '.php';
            endwhile;
            wp_reset_postdata();
          } ?>

          <?php
          $the_query = Dq_Query(array(
            'post__not_in' => get_option('sticky_posts'),
            'paged' => get_query_var('paged'),
            'cat' => $cat
          ));
          if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
              include TEMPLATEPATH . '/template-parts/loop/' . $cat_layout . '.php';
            endwhile; //结束while

          else :
            echo '<div class="col-md-12"><h5>抱歉，当前分类下暂无文章！</h5></div>';
          endif; //结束if
          ?>
          <?php if ($cat_layout == '5') { ?>
          </div>
        </div>
        <?php if (!dqtheme('dq_sidebar_right')) {
              get_sidebar();
            } ?>
      <?php } ?>

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
$current_category = get_queried_object();
$category_id = $current_category->term_id;
$is_cat_desc = get_term_meta($category_id, '_dq_taxonomy_options', true)['is_cat_desc'];
$cat_desc = get_term_meta($category_id, '_dq_taxonomy_options', true)['cat_desc'];
    
    if ($is_cat_desc) {
        if (!empty($cat_desc)) {
            $cat_desc = $cat_desc;
        } else {
            $cat_desc = '';
        }

        echo '<section class="paging-section text-center pt-0 pb-70">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="page-link-item">
                <ul>
                ' . $cat_desc . '
                </ul>
        </div>
      </div>
    </div>
  </div>
</section>';
    }

?>

<?php get_footer(); ?>
