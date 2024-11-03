<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
?>
<section class="home-modular-13 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
  <div class="container">
    <?php if( $modular_title || $modular_describe ){?>
    <div class="section-title">
      <?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
      <?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; }?>
    </div>
    <?php }?>
    <div <?php if( ! empty($id['modular_mobile_slider']) && wp_is_mobile() ){ echo 'class="owl-carousel" id="modular_13_mobile_slider"'; }else{ echo 'class="row"'; }?>>
    <?php
    if( ! empty($id['add_modular_13']) ){
    foreach ( $id['add_modular_13'] as $value ): ?>
      <div class="col-lg-4">
        <div class="modular-13 service-item style-2">
          <div class="content">
            <h5>
              <?php
						$features_icon = $value['modular_13_icons'];
						$icon_size = $value['modular_13_icon_size'];
						$icon_color = $value['modular_13_icon_color'];
						?>
						<?php if(!empty($features_icon)):?>
						<i class="<?php echo $features_icon;?>" style="font-size: <?php echo $icon_size;?>rem;color: <?php echo $icon_color;?>;"></i>
						<?php endif;?>
              <?php if($value['modular_13_ico']['url']){?><img class="modular-13-ico" src="<?php echo $value['modular_13_ico']['url'];?>" alt="<?php echo get_post_meta( $value['modular_13_ico']['id'], '_wp_attachment_image_alt', true );?>" loading="lazy"><?php }?><?php echo $value['modular_13_title'];?></h5>
            <p><?php echo $value['modular_13_desc'];?></p>
            <?php if($value['modular_13_url']){?>
            <a class="btn-link" href="<?php echo $value['modular_13_url'];?>" target="_blank"><?php echo $value['modular_13_url_text'] ?: 'More';?> <i class="fa fa-long-arrow-right"></i></a>
            <?php }?>
          </div>
          <?php if($value['modular_13_img']['url']){?><img src="<?php echo $value['modular_13_img']['url'];?>" alt="<?php echo get_post_meta( $value['modular_13_img']['id'], '_wp_attachment_image_alt', true );?>" loading="lazy"><?php }?>
        </div>
      </div>
    <?php
    endforeach;
    }?>
    </div>
  </div>
</section>
