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
    <div class="row">
      <?php
      if( ! empty($id['add_modular_54']) ){
      foreach ( $id['add_modular_54'] as $value ): ?>
        <div class="col-lg-4">
          <div class="cleaning-service-item">
            <div class="thumb">
              <img src="<?php echo $value['modular_54_img']['url'];?>" alt="<?php echo get_post_meta( $value['modular_54_img']['id'], '_wp_attachment_image_alt', true );?>" loading="lazy">
            </div>
            <div class="content">
              <h4 style="font-weight: bold;font-size: 1.5rem;"><?php echo $value['modular_54_title'];?></h4>
              <p style="font-size: 1rem;"><?php echo $value['modular_54_desc'];?></p>
            </div>
          </div>
        </div>
      <?php
      endforeach;
      }?>
      </div>
    </div>
  </div>
</section>
<style>
  .cleaning-service-item {
    box-shadow: initial;
    background-color: initial;
    margin-bottom: initial;
}
  </style>
