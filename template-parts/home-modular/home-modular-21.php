<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
?>
<section class="home-modular-21 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?> <?php if( $id['modular_21_img_circular'] ){ echo 'img_circular'; }?>">
  <div class="container">
    <?php if( $modular_title || $modular_describe ){?>
    <div class="section-title">
      <?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
      <?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; }?>
    </div>
    <?php }?>

    <div class="row">
      <?php
      if( ! empty($id['add_modular_21']) ){ // 必要时可通过php判断，项目数量超过6个在启用轮播显示......
      foreach ( $id['add_modular_21'] as $value ): ?>
      <div class="col-lg-<?php echo $id['modular_21_col'];?> col-md-3 col-xs-6">
        <?php if($value['modular_21_url']){?>
        <a href="<?php echo $value['modular_21_url'];?>" target="_blank" rel="nofollow">
          <img loading="lazy" class="modular21-img" src="<?php echo $value['modular_21_img']['url'];?>" alt="<?php echo $value['modular_21_title'];?>">
        </a>
        <?php }else{?>
        <img loading="lazy" class="modular21-img" src="<?php echo $value['modular_21_img']['url'];?>" alt="<?php echo $value['modular_21_title'];?>">
        <?php }?>
      </div>
      <?php
      endforeach;
      }?>
    </div>

  </div>
</section>