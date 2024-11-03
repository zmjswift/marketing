<?php
$module_title    = $id['module_title'] ?: '';
$module_img      = $id['module_img'] ?: '';
$module_button   = $id['module_button'] ?: '';

?>

<div class="how-it-works">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h3 class="section-title-one"><?php echo $module_title ?></h3>
            </div>
        </div>

        <div class="row">

            <?php
            if (!empty($module_img)) {
                foreach ($module_img as $value) {
                    echo '<div class="col-xl-4 col-lg-4 col-md-4">
                            <div class="step-box">
					            <div class="step-image">
					                <img src="' . $value['img']['url'] . '" alt="' . $value['title'] . '">
					            </div>
					            <h4 class="step-title">' . $value['title'] . '</h4>
					            ' . $value['desc'] . '
					        </div>
			            </div>';
                }
            }
            ?>

        </div>

        <div class="row text-center how-it-works-buttons">
            <div class="col-12" style="margin-top: 10px;">
                <a style="color: <?php echo $module_button[0]['color']; ?>;background: <?php echo $module_button[0]['background']; ?>;" href="<?php echo $module_button[0]['link']; ?>" class="wrd-read-more-button">
                    <?php echo $module_button[0]['title']; ?>
                </a>

                <a style="color: <?php echo $module_button[1]['color']; ?>;" href="<?php echo $module_button[1]['link']; ?>" class="wrd-text-button">
                    <?php echo $module_button[1]['title']; ?>
                </a>
            </div>
        </div>
    </div>
</div><!-- How It Works End -->