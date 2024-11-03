<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';?>

<section class="home-modular-11 contact-details modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
  <div class="container">
    <?php if( $modular_title || $modular_describe ){?>
    <div class="section-title">
      <?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
      <?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; }?>
    </div>
    <?php }?>
    <div <?php if( ! empty($id['modular_mobile_slider']) && wp_is_mobile() ){ echo 'class="owl-carousel" id="modular_11_mobile"'; }else{ echo 'class="row"'; }?>>
      <?php
      if( ! empty($id['add_modular_11']) ){
      foreach ( $id['add_modular_11'] as $value ): ?>
        <div class="col-lg-4">
          <div class="cleaning-service-item">
            <div class="thumb">
              <img src="<?php echo $value['modular_11_img']['url'];?>" alt="<?php echo get_post_meta( $value['modular_11_img']['id'], '_wp_attachment_image_alt', true );?>" loading="lazy">
              <img class="img-carv" src="<?php echo get_template_directory_uri();?>/static/images/serv-bg.png" alt="<?php echo $value['modular_11_title'];?>" loading="lazy">
              <?php
						$features_icon = $value['modular_11_icons'];
						$icon_size = $value['modular_11_icon_size'];
						$icon_color = $value['modular_11_icon_color'];
						?>
						<?php if (!empty($features_icon)) {
    $modular_11_ico_bg_color = isset( $value['modular_11_ico_bg_color'] ) ? $value['modular_11_ico_bg_color'] : '#fcab00';
    ?>
    <div class="icon-box" style="background-color: <?php echo $modular_11_ico_bg_color;?>">
        <i class="<?php echo $features_icon; ?> modular_11_icon" style="font-size: <?php echo $icon_size; ?>rem; color: <?php echo $icon_color; ?>;"></i>
    </div>
<?php } ?>
              <?php if( $value['modular_11_ico']['url'] ){
                
                $modular_11_ico_bg_color = isset( $value['modular_11_ico_bg_color'] ) ? $value['modular_11_ico_bg_color'] : '#fcab00';

              ?>
              <div class="icon-box" style="background-color: <?php echo $modular_11_ico_bg_color;?>">
                <img src="<?php echo $value['modular_11_ico']['url'];?>" alt="<?php echo get_post_meta( $value['modular_11_ico']['id'], '_wp_attachment_image_alt', true );?>" loading="lazy">
              </div>
              <?php }?>
            </div>
            <div class="content">
              <h4><?php echo $value['modular_11_title'];?></h4>
              <p><?php echo $value['modular_11_desc'];?></p>
              <?php if($value['modular_11_url']){?>
              <a href="<?php echo $value['modular_11_url'];?>" target="_blank" rel="nofollow">More</a>
              <?php }?>
            </div>
          </div>
        </div>
      <?php
      endforeach;
      }?>
    </div>
  </div>
</section>
