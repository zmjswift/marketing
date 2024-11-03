<?php
$modular_title = $id['modular_title'] ?: exit('标题为空');
$moduler_desc = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
$modular_52 = $id['add_modular_52'];
$btn_52 = $id['add_modular_52_btn'];
foreach ($btn_52 as $item_nav) {
$navcolor_52 = $item_nav['navcolor_52'];
}
if (!empty($modular_52)) {
?>
    <section style="margin-bottom: -70px;">
        <div class="container">
            <div class="section-title">
                <h2><?php echo $modular_title; ?></h2>
                <p style="color: <?php echo $mmodular_describe_color; ?>;max-width: 1000px;"><?php echo $moduler_desc; ?></p>
            </div>
        </div>
    </section>
	<section>
    <div class="container">
        <div class="row modular15_wrapper">
            <?php
            $i = 1;
            echo '<div class="col-lg-12 modular15_img_box"><div class="row">';
            foreach ($modular_52 as $item) {
                $title_52 = $item['modular_52_title'];
                $desc_52 = $item['modular_52_desc'];
                $type_52 = $item['modular_52_media_type'];
                $img_52 = $item['modular_52_img']['url'];
                $video_52 = $item['modular_52_video'];
                $video_img_52 = $item['modular_52_video_img']['url'];
                echo '<div class="col-lg-3 modular_52_class">';
                echo '<div class="img_h">';
                if ($type_52 == 'img') {
                    echo '<img loading="lazy" src="' . $img_52 . '" alt="' . $title_52 . '" style="border-radius: 10px;" />';
                } elseif ($type_52 == 'video') {
                    echo '<video autoplay muted poster="' . $video_img_52 . '" style="width: 100%;border-radius: 10px;"><source src="' . $video_52 . '" type="video/mp4"></video>';
                }
                echo '</div>';
                echo '<p class="sumbg">' . $i++ . '</p>';
                echo '<h3 style="line-height: 1.4;margin-top: 10px;">' . $title_52 . '</h3>';
                echo '<div class="juzhong_m_52">';
                if (!empty($stdcode)) {
                    echo do_shortcode($stdcode);
                } else {
                    echo '<p style="font-size: 15px;line-height: 1.6;">' . $desc_52 . '</p>';
                }
                echo '</div>';
                echo '</div>';
            }
            echo '</div></div>';
            ?>
        </div>
        <?php
        foreach ($btn_52 as $item) {
            $icons_52 = $item['modular_52_icons'];
            $icon_size_52 = $item['modular_52_icon_size'];
            $icon_color_52 = $item['modular_52_icon_color'];
            $btn_title_52 = $item['title_52'];
            $btn_color_52 = $item['color_52'];
            $btn_bg_52 = $item['background_52'];
            $btn_link_52 = $item['link_52'];
            if (empty($btn_bg_52)) {
                $btnop = 'btn-outline-primary';
            }
            echo '<div class="button-container"><a class="btn ' . $btnop . ' btn-outline-style" style="margin-left: 10px;height: 43px;padding: 10px 20px;color: ' . $btn_color_52 . ';background-color: ' . $btn_bg_52 . ';" href="' . $btn_link_52 . '" target="_blank" rel="nofollow"><i class="' . $icons_52 . '" style="margin-right: 10px;font-size: ' . $icon_size_52 . 'rem;color: ' . $icon_color_52 . ';"></i>' . $btn_title_52 . '</a></div>';
        }
        ?>
    </div>
	</section>
    <?php
}
?>
<style>
    .std-popup-trigger {
        border-radius: 5px!important;
        height: 43px!important;
        padding: 5px 15px!important;
        float: left;
        background-color: #fcab03!important;
    }

    .juzhong_m_52 {
        float: none;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    @media (max-width: 767px) {
        .juzhong_m_52 {
            float: none;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            margin: 10px 0px;
        }

        .std-popup-trigger {
            float: none;
        }
    }

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .modular15_img_box {
        text-align: center;
    }

    .modular15_img_box img {
        max-width: 100%;
        height: auto;
    }

    .modular15_img_box h3 {
        margin-top: 10px;
    }

    .modular_52_class {
        padding: 0px 20px;
    }

    .button-container {
        display: flex;
        justify-content: center;
        margin: 50px 0;
    }


    .sumbg {
        width: 70px;
        height: 70px;
        background-color: <?php echo $navcolor_52;?>;
        color: #fff;
        border-radius: 50%;
        display: inline-block;
        font-size: 38px;
        font-weight: 600;
        line-height: 70px;
        margin: 20px 0px;
    }

    @media (min-width: 768px) {
        .modular_52_class:first-child .sumbg:after {
            content: "";
            display: block;
            width: 300px;
            height: 3px;
            background-color: <?php echo $navcolor_52;?>;
            margin-top: -34px;
			z-index: -1;
			position: absolute;
        }

        .modular_52_class:not(:first-child):not(:last-child) .sumbg:after {
            content: "";
            display: block;
            width: 300px;
            height: 3px;
            background-color: <?php echo $navcolor_52;?>;
            margin-top: -34px;
			z-index: -1;
			position: absolute;
        }
    }

    .img_h {
        min-height: 240px;
    }
</style>
