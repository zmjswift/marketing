<?php
$module_title    = $id['module_title'] ?: '';
$module_button   = $id['module_button'] ?: '';
$module_icon     = $id['module_icon'] ?: '';
?>

<div class="review-section">
    <div class="container-fluid">
        <div class="row">
            <h3 class="section-title-one"><?php echo $module_title; ?></h3>
        </div>

        <div class="row review-items">

            <?php
            if (!empty($module_icon)) {
                $i = 0;
                foreach ($module_icon as $key => $value) {
                    $i++; ?>

                    <div class="col-xl-2">
                        <div class="review-item">
                            <div class="review-image">
                                <img src="<?php echo $value['img']['url']; ?>" alt="<?php echo $value['title']; ?>">
                            </div>

                            <div class="review-title"><?php echo $value['title']; ?></div>

                            <div class="customer">
                                <?php echo $value['desc']; ?>
                            </div>

                            <div id="star-container" class="star-rating star-5">
                                <span class="t4l-star star-1">
                                    <img src="<?php echo DAHUZI_THEME_URL ?>/static-module/images/review/star.png" alt="*">
                                </span>

                                <span class="t4l-star star-2">
                                    <img src="<?php echo DAHUZI_THEME_URL ?>/static-module/images/review/star.png" alt="*">
                                </span>
                                <span class="t4l-star star-3">
                                    <img src="<?php echo DAHUZI_THEME_URL ?>/static-module/images/review/star.png" alt="*">
                                </span>
                                <span class="t4l-star star-4">
                                    <img src="<?php echo DAHUZI_THEME_URL ?>/static-module/images/review/star.png" alt="*">
                                </span>
                                <span class="t4l-star star-5">
                                    <img src="<?php echo DAHUZI_THEME_URL ?>/static-module/images/review/star.png" alt="*">
                                </span>
                            </div>
                        </div>
                    </div>

            <?php   }
            }
            ?>



        </div>

        <div class="row">
            <div class="col-12">
                <div class="more_reviews">
                    <div class="powered_trust">
                        <p>Check out more at</p>
                        <div class="trustp-logo">
                            <img src="<?php echo DAHUZI_THEME_URL ?>/static-module/images/review/trustpilot-logo.png" alt="trustpilot">
                        </div>
                    </div>
                    <a style="color: <?php echo $module_button[0]['color']; ?>;background: <?php echo $module_button[0]['background']; ?>;" href="<?php echo $module_button[0]['link']; ?>" class="wrd-read-more-button"><?php echo $module_button[0]['title']; ?></a>
                </div>
            </div>
        </div>
    </div>
</div><!-- Review Section End -->

</div>