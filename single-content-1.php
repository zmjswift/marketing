<?php
echo "<!-- single-content-1.php -->";
while (have_posts()) : the_post();
    if ($post_header_banner && ! $showproduct_head || dqtheme('header_type') == '1' && ! $showproduct_head) { ?>
        <section class="inner-area text-align-left" style="background-image: url('<?php echo $banner_img; ?>');">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-12">
                            <h1><?php the_title_attribute(); ?></h1>
                            <div class="banner-entry-meta">
                                <?php if (dqtheme('dqtheme_single_author1')) { ?>
                                    <span>By：<?php echo get_the_author() ?></span>
                                <?php } ?>
                                <?php if (dqtheme('dqtheme_single_category')) { ?>
                                    <span><i class="fa fa-folder"></i> <?php the_category(', ') ?></span>
                                <?php } ?>
                                <?php if (dqtheme('dqtheme_single_time')) { ?>
                                    <span><i class="fa fa-clock-o"></i> <?php echo dq_post_time(); ?><?php //echo get_the_date('Y-m-d H:i'); 
                                                                                                        ?></span>
                                <?php } ?>
                                <?php if (dqtheme('dqtheme_single_views')) { ?>
                                    <span>Views：<?php post_views('', ''); ?> 次</span>
                                <?php } ?>
                                <?php if ($single_source) { ?>
                                    <?php if ($single_source_url) { ?>
                                        <span>From：<a href="<?php echo $single_source_url; ?>" target="_blank"
                                                rel="nofollow"><?php echo $single_source; ?></a></span>
                                    <?php } else { ?>
                                        <span>From：<?php echo $single_source; ?></span>
                                    <?php } ?>
                                <?php } ?>
                                <span><?php edit_post_link('[编辑文章]'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
    <?php if ($showproduct_head) { ?>
        <div class="showproduct-head single-content-1">
            <div class="container">
                <div class="single-breadcrumbs">
                    <?php if (function_exists('get_breadcrumbs')) {
                        get_breadcrumbs();
                    } ?>
                </div>
                <div class="showproduct-wrap">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-product-gallery" style="position: sticky; top: 0px;">
                            <div class="product-gallery-zoom">
                                    <div class="product-image">
                                        <img src="<?php echo $produc_img_1; ?>" xoriginal="<?php echo $produc_img_1; ?>"
                                            class="xzoom" width="100%" height="auto" />
                                        <?php if ($produc_video_1) { ?>
                                            <video id="video1" src="<?php echo $produc_video_1; ?>" controls="controls" width="100%"
                                                height="auto"></video>
                                        <?php } ?>
                                        <?php if ($produc_video_2) { ?>
                                            <video id="video2" src="<?php echo $produc_video_2; ?>" controls="controls" width="100%"
                                                height="auto"></video>
                                        <?php } ?>
                                    </div>
                            </div>
                            <div class="product-thumbs-wrapper">
                                    <span class="jcarousel-control-prev radius-lt"><i class="fa fa-angle-left"></i></span>
                                    <div class="product-thumbs-gallery">
                                        <ol class="flex-control-nav flex-control-thumbs">
                                            <?php $keywords = get_post_meta($post->ID, 'seo_keywords', true); ?>
                                            <?php if ($produc_video_1) { ?>
                                                <li class="flex-thumb flex-active">
                                                    <span class="fa fa-play-circle-o"
                                                        style="position: absolute;top: 50%;left: 10%;transform: translate(-50%, -50%);font-size: 40px;"></span>
                                                    <img id="video1_cover" src="<?php echo $produc_video_1_cover; ?>" width="150"
                                                        height="150" />
                                                </li>
                                            <?php } ?>
                                            <?php if ($produc_video_2) { ?>
                                                <li class="flex-thumb">
                                                    <span class="fa fa-play-circle-o"
                                                        style="position: absolute;top: 50%;left: 30%;transform: translate(-50%, -50%);font-size: 40px;"></span>
                                                    <img id="video2_cover" src="<?php echo $produc_video_2_cover; ?>" width="150"
                                                        height="150" />
                                                </li>
                                            <?php } ?>
                                            <?php if ($produc_img_1) { ?>
                                                <li class="flex-thumb">
                                                    <img src="<?php echo $produc_img_1; ?>" xpreview="<?php echo $produc_img_1; ?>"
                                                        alt="<?php echo $keywords; ?>" width="150" height="150" />
                                                </li>
                                            <?php } ?>
                                            <?php if ($produc_img_2) { ?>
                                                <li class="flex-thumb">
                                                    <img src="<?php echo $produc_img_2; ?>" xpreview="<?php echo $produc_img_2; ?>"
                                                        alt="<?php echo $keywords; ?>" width="150" height="150" />
                                                </li>
                                            <?php } ?>
                                            <?php if ($produc_img_3) { ?>
                                                <li class="flex-thumb">
                                                    <img src="<?php echo $produc_img_3; ?>" xpreview="<?php echo $produc_img_3; ?>"
                                                        alt="<?php echo $keywords; ?>" width="150" height="150" />
                                                </li>
                                            <?php } ?>
                                            <?php if ($produc_img_4) { ?>
                                                <li class="flex-thumb">
                                                    <img src="<?php echo $produc_img_4; ?>" xpreview="<?php echo $produc_img_4; ?>"
                                                        alt="<?php echo $keywords; ?>" width="150" height="150" />
                                                </li>
                                            <?php } ?>
                                        </ol>
                                    </div>
                                    <span class="jcarousel-control-next radius-rt"><i class="fa fa-angle-right"></i></span>
                                </div>
                            </div>

                            <script>
                                jQuery(document).ready(function($) {
                                    if ($(window).width() > 1023) {
                                        $(".xzoom, .xzoom-gallery").xzoom({
                                            tint: "#000",
                                            tintOpacity: 0.25,
                                            lens: "#fff",
                                            lensOpacity: 0.1,
                                            defaultScale: -1,
                                            scroll: true,
                                            Xoffset: 15
                                        });
                                    }

                                    // 判断 video 是否存在
                                    if ($('.product-thumbs-gallery li').find('img').attr('id') == 'video1_cover' || $(
                                            '.product-thumbs-gallery li').find('img').attr('id') == 'video2_cover') {
                                        // 视频存在则隐藏图片
                                        $('.product-image img').hide();
                                        // 隐藏视频2
                                        $('#video2').hide();
                                        $('.product-thumbs-gallery').on('click', 'li', function() {
                                            if ($(this).find('img').attr('id') == 'video1_cover' || $(this).find(
                                                    'img').attr('id') == 'video2_cover') {
                                                // 视频
                                                //$('.product-image video').show();
                                                // 判断是视频1还是视频2
                                                if ($(this).find('img').attr('id') == 'video1_cover') {
                                                    $('#video1').show();
                                                    $('#video2').hide();
                                                    $('#video2')[0].pause();
                                                    $('#video1')[0].play();
                                                } else {
                                                    $('#video1').hide();
                                                    $('#video2').show();
                                                    $('#video1')[0].pause();
                                                    $('#video2')[0].play();
                                                }


                                                $('.product-image img').hide();
                                            } else {
                                                // 图片
                                                $('.product-image video').hide();
                                                $('.product-image img').show();
                                            }
                                        });
                                        // 监听两个 span 的点击事件
                                        $('.fa-play-circle-o').on('click', function() {
                                            // 判断是视频1还是视频2
                                            if ($(this).parent().find('img').attr('id') == 'video1_cover') {
                                                $('#video1').show();
                                                $('#video2').hide();
                                                $('#video2')[0].pause();
                                                $('#video1')[0].play();
                                            } else {
                                                $('#video1').hide();
                                                $('#video2').show();
                                                $('#video1')[0].pause();
                                                $('#video2')[0].play();
                                            }
                                            $('.product-image img').hide();
                                        });
                                    }
                                    $('.nav-pills li').on('click', function() {
                                        var to = $(this).find('a').attr('data-to');
                                        $('.tab-pane').removeClass('active');
                                        $('.tab-pane').removeClass('show');
                                        $('#' + to).addClass('active');
                                        $('#' + to).addClass('show');
                                    });
                                });
                            </script>
                        </div>
                        <style>
                            @media only screen and (max-width: 600px) {
                                .fa-qrcode {
                                    display: none !important;
                                }
                            }
                        </style>
                        <div class="col-lg-6">
                            <div class="product-text" style="padding-right: 10px;">
                                <h1><?php the_title(); ?></h1>
                                <ul class="product_meta">
                                    <li><i class="fa fa-folder"></i> <?php the_category(', ') ?></li>
                                    <?php if (dqtheme('dqtheme_single_time')) { ?>
                                        <li><i class="fa fa-clock-o"></i> <?php echo dq_post_time(); ?></li>
                                    <?php } ?>
                                    <li><i class="fa fa-qrcode" data-article-url="<?php echo esc_url(get_the_permalink()); ?>" style="font-size: 24px;"></i></li>
                                </ul>
                                <?php
                                if ($produc_abstract) {
                                    // WPKF
                                    echo wpautop($produc_abstract);
                                } else {
                                    echo dq_excerpt(150, '...');
                                }
                                ?>
                                <?php
                                $produc_parameter = get_post_meta(get_the_ID(), 'produc_parameter', true);
                                if ($produc_parameter) { ?>
                                    <ul class="produc-parameter parameter-col-<?php echo $produc_parameter_col; ?>">
                                        <?php if (is_array($produc_parameter)) {
                                            foreach ($produc_parameter as $value) : ?>
                                                <li><?php echo $value['parameter_text'] ?></li>
                                            <?php endforeach; ?>
                                        <?php } ?>
                                    </ul>
                                <?php }
                                // 按钮开始
                                // if ( $post_add_button ) {
                                // 	$add_button = $post_add_button;
                                // } else {
                                // 	$add_button = dqtheme( 'add_button' );
                                // }
                                $add_button = dqtheme('add_button');
                                if (is_array($add_button)) { ?>
                                    <div class="produc_button">
                                        <?php
                                        foreach ($add_button as $value) :
                                            $md5_title = 'a' . md5($value['button_title']);
                                        ?>
                                            <?php if ($value['produc_button_type'] == 'link') { ?>
                                                <a class="<?php echo $md5_title; ?>"
                                                    href="<?php echo $value['button_url']; ?>?product_id=<?php echo get_the_ID(); ?>"
                                                    rel="nofollow" target="_blank"><?php if ($value['button_icon']) {
                                                                                        echo '<i class="' . $value['button_icon'] . '"></i> ';
                                                                                    } ?><?php echo $value['button_title']; ?></a>
                                            <?php } elseif ($value['produc_button_type'] == 'img') { ?>
                                                <a class="<?php echo $md5_title; ?>" data-fancybox href="#<?php echo $md5_title; ?>"
                                                    class="button_img"><?php if ($value['button_icon']) {
                                                                            echo '<i class="' . $value['button_icon'] . '"></i> ';
                                                                        } ?><?php echo $value['button_title']; ?></a>
                                                <div id="<?php echo $md5_title; ?>" style="display:none;">
                                                    <img src="<?php echo $value['button_img']['url']; ?>">
                                                    <p style="text-align:center;font-size:16px;color:#333">
                                                        <?php echo $value['button_title']; ?></p>
                                                </div>

                                            <?php } else { ?>
                                                <a class="<?php echo $md5_title; ?>"
                                                    href="<?php if (wp_is_mobile()) { ?>mqqwpa://im/chat?chat_type=wpa&uin=<?php echo $value['button_qq']; ?>&version=1&src_type=web&web_src=oicqzone.com<?php } else { ?>http://wpa.qq.com/msgrd?v=3&uin=<?php echo $value['button_qq']; ?>&site=qq&menu=yes<?php } ?>"
                                                    rel="nofollow"
                                                    target="_blank"><?php if ($value['button_icon']) {
                                                                        echo '<i class="' . $value['button_icon'] . '"></i> ';
                                                                    } ?><?php echo $value['button_title']; ?>
                                                </a>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <style>
                                        <?php foreach ($add_button as $value) : $md5_title = 'a' . md5($value['button_title']);
                                        ?>.showproduct-head .produc_button .<?php echo $md5_title;

                                                                            ?> {
                                            background: <?php echo $value['button_color'] ?>;
                                            color: <?php echo $value['button_text_color'] ?>;
                                            border: 1px solid<?php echo $value['button_color'] ?>
                                        }

                                        .showproduct-head .produc_button .<?php echo $md5_title;

                                                                            ?>:hover {
                                            background: 0 0;
                                            color: <?php echo $value['button_color'] ?>
                                        }

                                        <?php endforeach;
                                        ?>
                                    </style>
                                <?php } ?>
                                <?php if ($branding) { ?>
                                    <div class="branding" style="padding: 10px 0;">
                                        <img src="<?php echo $branding; ?>" style="max-width: 64%;">
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="produc-detail container">
                                <div class="row">
                                    <?php if (dqtheme('dq_sidebar_right') && ! dqtheme('post_no_sidebar_all') && ! $showproduct_head) {
                                        get_sidebar();
                                    } ?>
                                    <div class="col-md-8 <?php if (! dqtheme('post_no_sidebar_all') && ! $showproduct_head) {
                                                                echo 'col-lg-9';
                                                            } else {
                                                                echo 'col-lg-12';
                                                            } ?>">
                                        <?php if (! $showproduct_head) { ?>
                                            <div class="single-breadcrumbs">
                                                <?php if (function_exists('get_breadcrumbs')) {
                                                    get_breadcrumbs();
                                                } ?>
                                            </div>
                                        <?php } ?>
                                        <?php if ($showproduct_head) { ?>
                                            <!-- WPKF -->
                                            <ul class="nav nav-pills">
                                                <li class="item">
                                                    <a data-toggle="tab" aria-expanded="true" data-to="tab0" class="tab active">
                                                        Product Details
                                                    </a>
                                                </li>
                                                <?php if (dq('tab-title-1')) { ?>
                                                    <li class="item">
                                                        <a data-toggle="tab" aria-expanded="false" data-to="tab1" class="tab">
                                                            <?php echo dq('tab-title-1'); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if (dq('tab-title-2')) { ?>
                                                    <li class="item">
                                                        <a data-toggle="tab" aria-expanded="false" data-to="tab2" class="tab">
                                                            <?php echo dq('tab-title-2'); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if (dq('tab-title-3')) { ?>
                                                    <li class="item">
                                                        <a data-toggle="tab" aria-expanded="false" data-to="tab3" class="tab">
                                                            <?php echo dq('tab-title-3'); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } ?>

                                        <div class="product-details">
                                            <div class="details-content mb-40">
                                                <?php if (! $post_header_banner && ! $showproduct_head) { ?>
                                                    <h1><?php the_title_attribute(); ?></h1>
                                                    <div class="entry-meta">
                                                        <?php if (dqtheme('dqtheme_single_author1')) { ?>
                                                            <span>作者：<?php echo get_the_author() ?></span>
                                                        <?php } ?>
                                                        <?php if (dqtheme('dqtheme_single_category')) { ?>
                                                            <span><i class="fa fa-folder"></i> <?php the_category(', ') ?></span>
                                                        <?php } ?>
                                                        <?php if (dqtheme('dqtheme_single_time')) { ?>
                                                            <span><i class="fa fa-clock-o"></i> <?php echo dq_post_time(); ?><?php //echo get_the_date('Y-m-d H:i'); 
                                                                                                                                ?></span>
                                                        <?php } ?>
                                                        <?php if (dqtheme('dqtheme_single_views')) { ?>
                                                            <span>浏览：<?php post_views('', ''); ?> 次</span>
                                                        <?php } ?>
                                                        <?php if ($single_source) { ?>
                                                            <?php if ($single_source_url) { ?>
                                                                <span>来源：<a href="<?php echo $single_source_url; ?>" target="_blank"
                                                                        rel="nofollow"><?php echo $single_source; ?></a></span>
                                                            <?php } else { ?>
                                                                <span>来源：<?php echo $single_source; ?></span>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <span><?php edit_post_link('[编辑文章]'); ?></span>
                                                    </div>
                                                <?php } ?>

                                                <?php if (! empty($single_ad['single_ad_top']['url'])) { ?>
                                                    <div class="single-top">
                                                        <?php if (! empty($single_ad['single_ad_top_url'])) { ?><a
                                                                href="<?php echo $single_ad['single_ad_top_url']; ?>" target="_blank"
                                                                rel="nofollow"><?php } ?>
                                                            <img src="<?php echo $single_ad['single_ad_top']['url']; ?>"
                                                                alt="<?php echo $single_ad['single_ad_top']['title']; ?>">
                                                            <?php if (! empty($single_ad['single_ad_top_url'])) { ?></a><?php } ?>
                                                    </div>
                                                <?php } ?>

                                                <?php if ($showproduct_head) { ?>
                                                    <div class="tab-contents">
                                                        <div id="tab0" class="tab-pane fade-in active">
                                                            <?php the_content(); ?>
                                                        </div>

                                                        <?php if (dq('tab-content-1')) { ?>
                                                            <div id="tab1" class="tab-pane">
                                                                <?php echo wpautop(dq('tab-content-1')); ?>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if (dq('tab-content-2')) { ?>
                                                            <div id="tab2" class="tab-pane">
                                                                <?php echo wpautop(dq('tab-content-2')); ?>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if (dq('tab-content-3')) { ?>
                                                            <div id="tab3" class="tab-pane">
                                                                <?php echo wpautop(dq('tab-content-3')); ?>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <?php if ($youtube_id) { ?>
                                                                <div class="youtube_box">
                                                                    <iframe width="560" height="315"
                                                                        src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" frameborder="0"
                                                                        allowfullscreen=""></iframe>
                                                                </div>
                                                            <?php } ?>
                                                <?php } elseif ($youtube_id) { ?>
                                                    <div class="youtube_box">
                                                        <iframe width="560" height="315"
                                                            src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>" frameborder="0"
                                                            allowfullscreen=""></iframe>
                                                    </div>
                                                    <?php the_content(); ?>
                                                <?php } else {
                                                    the_content();
                                                } ?>

                                                <div class="entry-tags">
                                                    <?php the_tags('Tags: ', ' · ', ''); ?>
                                                </div>

                                                <?php if (! empty($single_ad['single_ad_bottom']['url'])) { ?>
                                                    <div class="single-bottom">
                                                        <?php if (! empty($single_ad['single_ad_bottom_url'])) { ?><a
                                                                href="<?php echo $single_ad['single_ad_bottom_url']; ?>" target="_blank"
                                                                rel="nofollow"><?php } ?>
                                                            <img src="<?php echo $single_ad['single_ad_bottom']['url']; ?>"
                                                                alt="<?php echo $single_ad['single_ad_bottom']['title']; ?>">
                                                            <?php if (! empty($single_ad['single_ad_bottom_url'])) { ?></a><?php } ?>
                                                    </div>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                    <?php if (! dqtheme('dq_sidebar_right') && ! dqtheme('post_no_sidebar_all') && ! $showproduct_head) {
                                        get_sidebar();
                                    } ?>
                                </div>
                            </div>

                            <div class="share-links-wrap top-right">
                                <ul class="share-links vertical">
                                    <?php

                                    $links   = dq_sharing_links();
                                    $options = dqtheme('dq_sharing_links', array(
                                        'facebook',
                                        'twitter',
                                        'pinterest',
                                        'linkedin',
                                        'whatsapp'
                                    ));

                                    foreach ($options as $option) : ?>
                                        <li><a class="<?php echo esc_attr($option); ?>"
                                                href="<?php echo esc_attr($links[$option]['link']); ?>" target="_blank">
                                                <i class="fa fa-<?php echo esc_attr($links[$option]['icon']); ?>"></i>
                                            </a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <section class="blog-section sidebar single-wrapper">
        <div class="container">
            <div class="row">
                <?php if (dqtheme('dq_sidebar_right') && ! dqtheme('post_no_sidebar_all') && ! $showproduct_head) {
                    get_sidebar();
                } ?>
                <div class="col-md-8 <?php if (! dqtheme('post_no_sidebar_all') && ! $showproduct_head) {
                                            echo 'col-lg-9';
                                        } else {
                                            echo 'col-lg-12';
                                        } ?>">
                    <?php if (! $showproduct_head) { ?>
                        <div class="single-breadcrumbs">
                            <?php if (function_exists('get_breadcrumbs')) {
                                get_breadcrumbs();
                            } ?>
                        </div>
                    <?php } ?>
                    <div class="blog-details">
                        <div class="details-content mb-40">
                        <?php if (dqtheme('dqtheme_single_related')) {
                            if ($showproduct_head) {
                                get_template_part('template-parts/product-related');
                            } else {
                                get_template_part('template-parts/related');
                            }
                        } ?>

                        <?php
                        //CF7短代码
                        if (dqtheme('cf7_form') && dqtheme('cf7_shortcode')) {
                            echo do_shortcode(dqtheme('cf7_shortcode'));
                            //get_template_part( 'template-parts/dq_contact');
                        } ?>
                        <div class="btn-box mt-30">
                            <?php //获取同分类下的上一篇 下一篇
                            $categories  = get_the_category();
                            $categoryIDS = array();
                            foreach ($categories as $category) {
                                array_push($categoryIDS, $category->term_id);
                            }
                            $categoryIDS = implode(",", $categoryIDS);

                            $prev_post = get_previous_post($categoryIDS);
                            $next_post = get_next_post($categoryIDS);
                            if (! empty($prev_post)) : ?>
                                <a href="<?php echo get_permalink($prev_post->ID); ?>" target="_blank" class="post-prev">
                                    <div class="thumb">
                                        <img loading="lazy" alt="<?php echo $prev_post->post_title; ?>"
                                            src="<?php echo dqtheme_prev_thumbnail_url(); ?>" style="width: -webkit-fill-available;">
                                    </div>
                                    <div class="post-title">
                                        <p>Prev:</p>
                                        <h3><?php echo $prev_post->post_title; ?></h3>
                                    </div>
                                </a>
                            <?php endif; ?>
                            <?php
                            if (! empty($next_post)) : ?>
                                <a href="<?php echo get_permalink($next_post->ID); ?>" target="_blank" class="post-next">
                                    <div class="thumb">
                                        <img loading="lazy" alt="<?php echo $next_post->post_title; ?>"
                                            src="<?php echo dqtheme_next_thumbnail_url(); ?>" style="width: -webkit-fill-available;">
                                    </div>
                                    <div class="post-title">
                                        <p>Next:</p>
                                        <h3><?php echo $next_post->post_title; ?></h3>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>
                        <?php if (dqtheme('dqtheme_single_author')) { ?>
                            <div class="blog-admin">
                                <?php echo get_avatar(get_the_author_meta('ID'), '180'); ?>
                                <div class="blog-admin-desc">
                                    <div class="clearfix">
                                        <h5><?php echo get_the_author() ?></h5>
                                    </div>
                                    <p><?php if (get_the_author_meta('description')) {
                                            echo the_author_meta('description');
                                        } else {
                                            echo '请到「后台-用户-个人资料」中填写个人说明。';
                                        } ?></p>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        if (comments_open() || get_comments_number()) {
                            comments_template();
                        }
                        ?>
                        
                    </div>
                    </div>
                </div>
                <?php if (! dqtheme('dq_sidebar_right') && ! dqtheme('post_no_sidebar_all') && ! $showproduct_head) {
                    get_sidebar();
                } ?>
            </div>
        </div>
        <section>

        <?php
    endwhile; // End of the loop.