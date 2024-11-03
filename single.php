<?php
$single_ad = dqtheme('single_ad');

$post_header_banner = dqtheme('post_header_banner');

$single_header_img  = dqtheme('single_header_img');

$single_header_url  = isset($single_header_img['url']) ? $single_header_img['url'] : '';



$category = get_the_category();

if ($category[0]) {

    $catid = $category[0]->term_id;
}

$category_data = get_term_meta($catid, '_dq_taxonomy_options', true);

if ($single_header_url) {

    $banner_img = isset($single_header_img['url']) ? $single_header_img['url'] : '';
} else {

    $banner_img = isset($category_data['cat_banner_img']['url']) ? $category_data['cat_banner_img']['url'] : '';
}



//判断产品文章
$showproduct_head = get_post_meta(get_the_ID(), 'showproduct_head', true);
//产品图片
$produc_img_1 = get_post_meta(get_the_ID(), 'produc_img_1', true);

$produc_img_1 = isset($produc_img_1['url']) ? $produc_img_1['url'] : '';



$produc_img_2 = get_post_meta(get_the_ID(), 'produc_img_2', true);

$produc_img_2 = isset($produc_img_2['url']) ? $produc_img_2['url'] : '';



$produc_img_3 = get_post_meta(get_the_ID(), 'produc_img_3', true);

$produc_img_3 = isset($produc_img_3['url']) ? $produc_img_3['url'] : '';



$produc_img_4 = get_post_meta(get_the_ID(), 'produc_img_4', true);

$produc_img_4 = isset($produc_img_4['url']) ? $produc_img_4['url'] : '';





// 产品视频

$produc_video_1       = get_post_meta(get_the_ID(), 'produc_video_1', true);

$produc_video_2       = get_post_meta(get_the_ID(), 'produc_video_2', true);

$produc_video_1_cover_meta = get_post_meta(get_the_ID(), 'produc_video_1_cover', true);

$produc_video_1_cover = isset($produc_video_1_cover_meta['url']) ? $produc_video_1_cover_meta['url'] : '';



$produc_video_2_cover_meta = get_post_meta(get_the_ID(), 'produc_video_2_cover', true);

$produc_video_2_cover = isset($produc_video_2_cover_meta['url']) ? $produc_video_2_cover_meta['url'] : '';





//产品参数

$produc_abstract = get_post_meta(get_the_ID(), 'produc_abstract', true);

//文章来源

$single_source     = get_post_meta(get_the_ID(), 'single_source', true);

$single_source_url = get_post_meta(get_the_ID(), 'single_source_url', true);

//youtube_id

$youtube_id = get_post_meta(get_the_ID(), 'youtube_id', true);

//branding

$branding = get_post_meta(get_the_ID(), 'branding', true);

get_header();

$produc_layout = get_post_meta(get_the_ID(), 'produc_layout', true);
if ($produc_layout == '1') {
    include(locate_template('single-content-1.php'));
} else {
    include(locate_template('single-content.php'));
}

get_footer();


?>



<?php if ($showproduct_head and dqtheme('mobile_foot_menu_sw')) : ?>

    <div class="footer-inquiry-mb" style="display:none">

        <a href="<?php echo dqtheme('mobile_foot_inquiry_link') ?>" class="btn btn-theme w-100"><i

                class="fa fa-envelope"></i> Inquiry</a>

    </div>

    <style>
        @media screen and (max-width: 767px) {

            .footer-inquiry-mb {

                display: block !important;

                position: fixed;

                bottom: 50px;

                left: 0;

                width: 100%;

                z-index: 9999;

            }



            .slide-bar {

                bottom: 15%;

            }

        }
    </style>

<?php endif; ?>

<?php

$showproduct_head = get_post_meta(get_the_ID(), 'showproduct_head', true);

$header_type = $showproduct_head ? '1' : '2';

?>

<style>
    .nav-pills-fixed {

        position: fixed;

        top: 0;

        left: 0;

        width: 100%;

        z-index: 9999;

    }



    .nav-pills-fixed-pc {

        border-bottom: 0 !important;

    }

    #navbar-collapse-<?php echo $header_type; ?>.hidden-collapse {

        display: none !important;

    }
</style>

<script>
    jQuery(document).ready(function($) {

        $('body').on("click", '[data-to]', function(e) {

            e.preventDefault();

            $(this).addClass("active").parent().siblings().find("a").removeClass("active");



            let obj = $(this).data("to");

            let h = $("#" + obj).offset().top;

            //var s = $(".navbar").height();

            $('html , body').animate({

                scrollTop: h

            }, 'slow');

        });



        var position = $(window).scrollTop();

        var h_nav_pills = $(".nav-pills").offset().top;

        var logo = $(".navbar-brand").html();

        var headerType = "<?php echo $header_type; ?>";



        $(window).scroll(function() {

            var scroll = $(window).scrollTop();

            if ($(window).width() < 768) {

                position > h_nav_pills ? $('.nav-pills').addClass('nav-pills-fixed') : $('.nav-pills').removeClass('nav-pills-fixed');

            } else {

                if (headerType === '1') {

                    var html0 = $(".navbar-brand").html();

                    let html1 = '<div class="nav nav-pills nav-pills-fixed-pc">';

                    let html2 = $(".nav-pills").html();

                    let html3 = "</div>";

                    position > h_nav_pills ? $(".navbar-brand").html(html1 + html2 + html3) : $(".navbar-brand").html(logo);

                }

            }





            let h1 = $("#tab1").offset().top;

            let h2 = $("#tab2").offset().top;

            let h3 = $("#tab3").offset().top;

            let h4 = $("#tab4").offset().top;



            if (scroll > h1) {

                $(".tab1").addClass("active").parent().siblings().find("a").removeClass("active");

            }

            if (scroll > h2) {

                $(".tab2").addClass("active").parent().siblings().find("a").removeClass("active");

            }

            if (scroll > h3) {

                $(".tab3").addClass("active").parent().siblings().find("a").removeClass("active");

            }

            if (scroll > h4) {

                $(".tab4").addClass("active").parent().siblings().find("a").removeClass("active");

            }



            position = scroll;

            if (scroll > h_nav_pills) {

                $('.navbar-collapse').addClass('hidden-collapse');

            } else {

                $('.navbar-collapse').removeClass('hidden-collapse');

            }

        });



    });
</script>