<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
?>
<section class="home-modular-18 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
  <div class="container">
    <?php if( $modular_title || $modular_describe ){?>
    <div class="section-title">
      <?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
      <?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; }?>
    </div>
    <?php }?>
    <div class="row">
      <?php
      if( ! empty($id['modular_18']) ){
      foreach ( $id['modular_18'] as $value ): ?>
      <div class="col-lg-<?php echo $id['modular_18_col'];?> col-6 mt-3 mb-3">
        <div class="grids-speci">
          <h3 class="title-spe"><?php echo $value['modular_18_title'];?></h3>
          <p><?php echo $value['modular_18_desc'];?></p>
        </div>
      </div>
      <?php
      endforeach;
      }?>
    </div>
  </div>
</section>