<?php
$modular_title = $id['modular_title'] ?: '模块标题';
$modular_describe = $id['modular_describe'] ?: '无需编码技能，您也可以创建出一个独特的网站（DQTheme）';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';?>
<section class="home-modular-8 contact-section pb-70 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
<div class="container">
    <div class="row contact-bg">
        <div class="col-md-12 col-lg-4 p-0">
            <div class="contact-text">
                <h2><?php echo $modular_title; ?></h2>
                <p style="color: <?php echo $mmodular_describe_color; ?>"><?php echo $modular_describe; ?></p>
                <?php
                if( ! empty($id['add_modular_8']) ){
                foreach ( $id['add_modular_8'] as $value ): ?>
                <div class="contact-info">
                    <div class="icon-box">
                        <?php
						$features_icon = $value['modular_8_icons'];
						$icon_size = $value['modular_8_icon_size'];
						$icon_color = $value['modular_8_icon_color'];
						$modular_8_icon = $value['modular_8_icon']['url'];
						?>
						<?php if(!empty($features_icon)):?>
						<i class="<?php echo $features_icon;?>" style="font-size: <?php echo $icon_size;?>rem;color: <?php echo $icon_color;?>;"></i>
						<?php endif;?>
                        <?php if(!empty($modular_8_icon)):?>
                        <img loading="lazy" src="<?php echo $modular_8_icon;?>" alt="<?php echo get_post_meta( $value['modular_8_icon']['id'], '_wp_attachment_image_alt', true );?>">
                        <?php endif;?>
                    </div>
                    <h6><?php echo $value['modular_8_title'];?></h6>
                </div>
                <?php
                endforeach;
                }?>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 style-2">

            <?php
            if( $id['modular_8_cf7_shortcode'] ){
              echo do_shortcode( '[contact-form-7 id="82ac4b2" title="new form"]');
            }?>

        </div>
    </div>
</div>
</section>