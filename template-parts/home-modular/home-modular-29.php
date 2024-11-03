<?php
//echo 11111;
//print_r($id);
$module_title    = $id['module_title'] ?: "Women's Suits";
$module_subtitle = $id['module_subtitle'] ?: '189€';
$module_desc     = $id['module_desc'] ?: "";
$module_img      = $id['module_img'] ?: '';
$module_icon     = $id['module_icon'] ?: '';
$module_button   = $id['module_button'] ?: '';

//if (!wp_style_is('module')) {
//wp_enqueue_style('module');
//}
?>

<style>
    .wpkf-module-women img {
        width: auto;
    }
</style>

<link rel="stylesheet" href="<?php echo DAHUZI_THEME_URL ?>/static-module/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo DAHUZI_THEME_URL ?>/static-module/css/fontawesome.min.css">
<link rel="stylesheet" href="<?php echo DAHUZI_THEME_URL ?>/static-module/css/slick-slider.css">
<link rel="stylesheet" href="<?php echo DAHUZI_THEME_URL ?>/static-module/css/slicknav.min.css">
<link rel="stylesheet" href="<?php echo DAHUZI_THEME_URL ?>/static-module/css/animate.min.css">
<link rel="stylesheet" href="<?php echo DAHUZI_THEME_URL ?>/static-module/style.css">

<div class="wpkf-module-women" style="margin-top: 1px;">

<div class="product-details-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-5 col-md-5">
                <div class="product-detail-img-slider">

                    <?php
                    if (!empty($module_img)) {
                        foreach ($module_img as $value) {
                            echo '<div class="product-details-img">
				        <img src="' . $value['img']['url'] . '" alt="' . $value['title'] . '" />
                    </div>';
                        }
                    }
                    ?>


                </div>
            </div>

            <div class="col-xl-6 col-lg-7 col-md-7 my-auto">
                <div class="product-details-desc text-center">
                    <h1 class="top_title"><?php echo $module_title ?></h1>

                    <div class="info_container">
                        <span class="from ">from</span>
                        <span class="price"><?php echo $module_subtitle ?></span>
                    </div>

                    <div class="product-details-button">

                        <?php
                        if (!empty($module_button)) {
                            foreach ($module_button as $value) {
                                echo '<a href="' . $value['link'] . '" class="wrd-button" style="color:' . $value['color'] . ';background:' . $value['background'] . ';">' . $value['title'] . '</a>';
                            }
                        }
                        ?>

                    </div>

                    <?php echo $module_desc ?>

                    <div class="featured-box">
                        <p class="featured_title">Featured in:</p>

                        <div class="featured-images">

                            <?php
                            if (!empty($module_icon)) {
                                foreach ($module_icon as $value) {
                                    echo '<a href="' . $value['link'] . '" target="_blank"><img src="' . $value['img']['url'] . '" alt="Featured"></a>';
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Product Details End -->

<script src="<?php echo DAHUZI_THEME_URL ?>/static-module/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo DAHUZI_THEME_URL ?>/static-module/js/popper.min.js"></script>
<script src="<?php echo DAHUZI_THEME_URL ?>/static-module/js/bootstrap.min.js"></script>
<script src="<?php echo DAHUZI_THEME_URL ?>/static-module/js/slick-slider.min.js"></script>
<script src="<?php echo DAHUZI_THEME_URL ?>/static-module/js/slicknav.min.js"></script>
<script src="<?php echo DAHUZI_THEME_URL ?>/static-module/js/main.js"></script>