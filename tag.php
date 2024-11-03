<?php
$cat_layout = dq_taxonomy('cat_layout') ?: '1';
$cat_posts_num = dq_taxonomy('cat_posts_num') ?: '3';
$post_img_height = dq_taxonomy('post_img_height') ?: '230';
$post_img_width = dq_taxonomy('post_img_width') ?: '350';
$cat_posts_num_mobile = dq_taxonomy('cat_posts_num_mobile') ?: '2';
$current_category = get_queried_object();
$category_id = $current_category->term_id;
// if (!empty($_SERVER['HTTP_REFERER'])){
//     $postid = url_to_postid($_SERVER['HTTP_REFERER']);
//     if (!empty($postid)){
//         $tmp_post = get_post($postid);
//         if (!empty($tmp_post->post_category)){
//             $tmp_post_category = $tmp_post->post_category;
//             $cat = implode(',',$tmp_post_category);
//         }
//     }
// }

// 获取分类的元数据
$taxonomy_options = get_term_meta($category_id, '_dq_taxonomy_options', true);

// 检查元数据是否存在并且不是空的
if ( !empty($taxonomy_options) && isset($taxonomy_options['cat_desc']) ) {
    $cat_desc = $taxonomy_options['cat_desc'];
} else {
    $cat_desc = ''; // 或者您可以设置为一个默认值
}

get_header(); ?>

<?php
$banner_img = dq_taxonomy('cat_banner_img');
if (isset($banner_img['url']) || dqtheme('header_type') == '1') { ?>
    <section class="inner-area <?php if (dq_taxonomy('banner_cat_desc') == '2') {
                                    echo ' text-align-left';
                                } ?>" style="background-image: url('<?php echo $banner_img['url']; ?>');">
        <?php if (dq_taxonomy('banner_cat_desc') != '3') { ?>
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-12">
                            <h4><?php single_term_title(); ?></h4>
                            <p><?php echo $cat_desc; ?><p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
<?php } ?>

<section class="breadcrumbs">
    <div class="container">
        <?php if (function_exists('get_breadcrumbs')) {
            get_breadcrumbs();
        } ?>
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
                            'cat' => $cat,
                            'tag_id' => $category_id
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
                        'cat' => $cat,
                        'tag_id' => $category_id
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
                    <p><?php echo $cat_desc; ?><p>
                        <?php par_pagenavi(9); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>