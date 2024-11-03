<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: 'black';
?>
<section class="home-modular-24 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
  <div class="container">
    <?php if( $modular_title || $modular_describe ){?>
    <div class="section-title">
      <?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
      <?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; }?>
    </div>
    <?php }?>

    <div class="row">
      <?php
      if( ! empty($id['add_modular_24']) ){
      foreach ( $id['add_modular_24'] as $value ): ?>
      <div class="col-lg-6">
        <div class="customized-modular-24<?php if( $value['modular_24_url'] ){ echo ' cursor_pointer'; }?>" style="background-image:url(<?php echo $value['modular_24_img']['url'];?>);">
          <div class="background-overlay"></div>
          <div class="modular-24-content">
            <h3><?php echo $value['modular_24_title'];?></h3>
            <?php
            if( $value['modular_24_desc'] ){
              echo wpautop($value['modular_24_desc']);
            }?>
          </div>
          <?php
          if( $value['modular_24_url'] ){?>
            <a class="modular-24-url" href="<?php echo $value['modular_24_url'];?>" target="_blank" rel="nofollow" aria-label="Read more about <?php echo $value['modular_24_title'];?>"></a>
          <?php }?>
          
        </div>
      </div>
      <?php
      endforeach;
      }?>
    </div>

  </div>
</section>