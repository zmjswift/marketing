<?php
/*
Template Name: 产品聚合页
*/

get_header();
if (has_post_thumbnail()) { ?>
    <section class="inner-area text-align-left" style="background-image: url('<?php the_post_thumbnail_url(); ?>');">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-12">
                        <h1><?php the_title_attribute(); ?></h1>
                        <?php if (has_excerpt()) {
                            dq_excerpt(120, '...');
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<style>
.widget_categories li a {
	font-size: 16px;
}
.widget_categories .children {
	margin-left: 20px;
}
.widget_categories .cat-item ul li {
  margin-bottom: 0;
}
.widget_categories .children .cat-item ul li a {
	color: #414141
}
</style>

<section class="breadcrumbs">
    <div class="container">
        <?php if (function_exists('get_breadcrumbs')) {
            get_breadcrumbs();
        } ?>
    </div>
</section>

<section class="blog-section sidebar">
    <div class="container">
        <div class="row">

            <div class="col-md-4 col-lg-3 d-none d-md-block">
                <div class="theme-sidebar">
                    <?php dynamic_sidebar('widget_products') ?>
                </div>
            </div>
            <div class="col-md-8 col-lg-9">

                <div class="blog-details">
                    <div class="details-content mb-40">

                        <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array(
                            'post_type' => 'post',
                            'post_status'   => 'publish',
                            'paged' => $paged,
                            'meta_query' => array(
                                array(
                                    'key' => 'showproduct_head',
                                    'value' => false,
                                    'compare' => '!=',
                                    'type' => 'BOOLEAN',
                                ),
                            ),
                        );
                        $query = new WP_Query($args);
                        ?>

                        <?php if (!has_post_thumbnail()) { ?>
                            <h1 class="pt-0">
                            <?php the_title_attribute(); ?>
                            <small class="float-right"><?php echo $query->found_posts; ?> products found</small>
                            </h1>
                        <?php } ?>

                        <?php
                        //print_r($query);
                        if ($query->have_posts()) : ?>

                            <!--
                            <div class="filter-page">
                                <div class="sel-products float-left">
                                    <span class="sel-text"><?php echo $query->found_posts; ?> products found</span>
                                </div>
                                <div class="view-as float-right">
                                    <span class="tool-name">View</span>
                                    <a href="javascript:;" rel="nofollow" title="List" class="view-tool"><i class="fa fa-list"></i></a>
                                    <a href="javascript:;" rel="nofollow" title="List" class="view-tool"><i class="fa fa-th"></i></a>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                            -->

                            <div class="row" style="margin-top:25px">
                                <?php while ($query->have_posts()) : $query->the_post(); ?>

                                    <?php include TEMPLATEPATH . '/template-parts/loop/8.php'; ?>

                                <?php endwhile; ?>
                            </div>
                        <?php else : ?>
                        <?php endif;
                        wp_reset_postdata();
                        ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="paging-section text-center pt-0 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-link-item">
                    <ul>
                        <?php wpkf_pagenavi($query, $paged); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>