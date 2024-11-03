<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';?>
<style>
 .modular_10_icon{
    border: 1px solid #eee;
    border-radius: 50%;
    height: 60px;
    line-height: 58px;
    text-align: center;
    width: 60px;
    max-width: 60px;
    } 
</style> 
<section class="contact-details modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
  <div class="container">
    <?php if( $modular_title || $modular_describe ){?>
    <div class="section-title">
      <?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
      <?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; }?>
    </div>
    <?php }?>
    <div class="row">
    <?php
    if( ! empty($id['add_modular_10']) ){
    foreach ( $id['add_modular_10'] as $value ): ?>
      <div class="col-lg-4">
        <div class="service-item style-1 border-1px">
          <?php
						$features_icon = $value['modular_10_icons'];
						$icon_size = $value['modular_10_icon_size'];
						$icon_color = $value['modular_10_icon_color'];
						?>
						<?php if (!empty($features_icon)) {
    $modular_10_img_bg_color = isset($value['modular_10_img_bg_color']) ? $value['modular_10_img_bg_color'] : '#fcab00';
    ?>
    <div class="service-icon">
        <i class="<?php echo $features_icon; ?> modular_10_icon" style="font-size: <?php echo $icon_size; ?>rem; color: <?php echo $icon_color; ?>; background-color: <?php echo $modular_10_img_bg_color; ?>"></i>
    </div>
<?php } ?>

          <?php if($value['modular_10_img']['url']){

            $modular_10_img_bg_color = isset( $value['modular_10_img_bg_color'] ) ? $value['modular_10_img_bg_color'] : '#fcab00';

          ?>
          <div class="service-icon">
            <img src="<?php echo $value['modular_10_img']['url'];?>" alt="<?php echo get_post_meta( $value['modular_10_img']['id'], '_wp_attachment_image_alt', true );?>" style="background-color: <?php echo $modular_10_img_bg_color;?>" loading="lazy">
          </div>
          <?php }?>
          <div class="content">
            <?php if($value['modular_10_url']){?>
            <h5><a href="<?php echo $value['modular_10_url'];?>" target="_blank" rel="nofollow"><?php echo $value['modular_10_title'];?></a></h5>
            <?php }else{?>
            <span style="font-size: 18px; font-weight: 600; margin-bottom: 10px; text-transform: uppercase;"><?php echo $value['modular_10_title'];?></span>
            <?php }?>
            <p><?php echo $value['modular_10_desc'];?></p>
          </div>
        </div>
      </div>
    <?php
    endforeach;
    }?>
    </div>
  </div>
</section>
