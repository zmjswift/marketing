<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
?>
<section class="home-modular-1 welcome-feature-section pb-40 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
<div class="container">
  <?php if( $modular_title || $modular_describe ){?>
  <div class="section-title">
    <?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
    <?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; }?>
  </div>
  <?php }?>
  <div <?php if( ! empty($id['modular_mobile_slider']) && wp_is_mobile() ){ echo 'class="owl-carousel" id="modular_1_mobile_slider"'; }else{ echo 'class="row"'; }?>>
    <?php
    if( ! empty($id['add_modular_1']) ){
    foreach ( $id['add_modular_1'] as $value ): ?>
    <?php if( $id['modular1_col_img_num'] == '2' ){
      echo '<div class="col-md-6">';
    }else if( $id['modular1_col_img_num'] == '3' ){
      echo '<div class="col-md-4">';
    }else if( $id['modular1_col_img_num'] == '4' ){
      echo '<div class="col-md-3">';
    }else{
      echo '<div class="col-md-4">';
    }?>
      <div class="welcome-feature">
        <div class="thumb">
          <img src="<?php echo $value['modular_1_img']['url'];?>" alt="<?php echo get_post_meta( $value['modular_1_img']['id'], '_wp_attachment_image_alt', true );?>" loading="lazy">
        </div>
        <?php if( $value['modular_1_title'] ){?>
        <div class="content" style="text-align: center;">
          <h2><?php echo $value['modular_1_title'];?></h2>
        </div>
        <?php }?>
        <?php if($value['modular_1_url']){?>
        <a class="u-permalink" href="<?php echo $value['modular_1_url'];?>" <?php if( $value['modular_1_url_blank'] ){?>target="_blank" rel="nofollow"<?php } ?> aria-label="Read more about <?php echo $value['modular_1_title'];?>"></a>
        <?php }?>
      </div>
    </div>
    <?php
    endforeach;
    }?>
  </div>
</div>
</section>