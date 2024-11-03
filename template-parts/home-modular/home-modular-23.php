<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
?>
<section class="home-modular-23 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
  <div class="container">
    <?php if( $modular_title || $modular_describe ){?>
    <div class="section-title">
      <?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
      <?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; }?>
    </div>
    <?php }?>

    <div class="row">
      <?php
      if( ! empty($id['add_modular_23']) ){
      foreach ( $id['add_modular_23'] as $value ): ?>
      <div class="col-lg-6">
        <div class="customized-modular-23<?php if( $value['modular_23_url'] ){ echo ' cursor_pointer'; }?>">
          <div class="modular-23-icon">
            <?php
						$features_icon = $value['modular_23_icons'];
						$icon_size = $value['modular_23_icon_size'];
						$icon_color = $value['modular_23_icon_color'];
						$modular_23_icon = $value['modular_23_img']['url'];
						?>
						<?php if(!empty($features_icon)):?>
						<i class="<?php echo $features_icon;?>" style="font-size: <?php echo $icon_size;?>rem;color: <?php echo $icon_color;?>;"></i>
						<?php endif;?>
            <?php if(!empty($modular_23_icon)):?>
            <img src="<?php echo $modular_23_icon;?>" alt="<?php echo $value['modular_23_title'];?>" />
            <?php endif;?>
          </div>
          <div class="modular-23-content">
            <h3><?php echo $value['modular_23_title'];?></h3>
            <?php
            if( $value['modular_23_desc'] ){
              echo wpautop($value['modular_23_desc']);
            }?>
          </div>
          <?php
          if( $value['modular_23_url'] ){?>
            <a class="modular-23-url" href="<?php echo $value['modular_23_url'];?>" target="_blank" rel="nofollow"></a>
          <?php }?>
          
        </div>
      </div>
      <?php
      endforeach;
      }?>
    </div>

  </div>
</section>