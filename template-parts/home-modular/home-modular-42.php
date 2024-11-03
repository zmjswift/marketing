<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$modular_42 = $id['module_42_button']?: '';
?>
<section class="home-modular-42 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
  <div class="container">
    <?php if( $modular_title || $modular_describe ){?>
    <div class="section-title">
      <?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
    </div>
    <?php }?>

    <div class="row">
      <?php
      if( ! empty($id['add_modular_42']) ){
      foreach ( $id['add_modular_42'] as $value ): ?>
      <div class="col-lg-3">
        <div class="customized-modular-42<?php if( $value['modular_42_url'] ){ echo ' cursor_pointer'; }?>">
          <div class="modular-42-icon">
            <?php
						$features_icon = $value['modular_42_icons'];
						$icon_size = $value['modular_42_icon_size'];
						$icon_color = $value['modular_42_icon_color'];
            $modular_42_icon = $value['modular_42_img']['url'];
						?>
						<?php if(!empty($features_icon)):?>
						<i class="<?php echo $features_icon;?>" style="font-size: <?php echo $icon_size;?>rem;color: <?php echo $icon_color;?>;display: grid;place-items: center;"></i>
						<?php endif;?>
            <?php if(!empty($modular_42_icon)):?>
            <img src="<?php echo $modular_42_icon;?>" alt="<?php echo $value['modular_42_title'];?>" style="display: block;margin: auto;width: <?php echo $icon_size;?>rem;"/>
            <?php endif;?>
          </div>
          <div class="modular-42-content" style="margin: 2rem 0rem;font-size: 16px;">
            <?php echo wpautop($value['modular_42_content']);?>
          </div>
          <?php
          if( $value['modular_42_url'] ){?>
            <a class="modular-42-url" href="<?php echo $value['modular_42_url'];?>" target="_blank" rel="nofollow"></a>
          <?php }?>
        </div>
      </div>
      <?php
      endforeach;
      }?>
      <?php
      if( ! empty($id['module_42_button']) ){
      foreach ( $id['module_42_button'] as $value ): ?>
      <a class="button-42" href="<?php echo $value['link_42'];?>" style="background-color: <?php echo $value['background_42'];?>;"><span style="display: flex;align-items: center;color: #ffffff;"><p style="color: <?php echo $value['color_42'];?>;font-size: 1rem;"><?php echo $value['title_42'];?></p><i class="fa fa-angle-right" style="font-size: 2rem;margin-left: 10px;"></i></span></a>
      <?php
      endforeach;
      }?>
        </div>

  </div>
</section>
<style>
.button-42{
  padding: 15px 30px;
    border-radius: 5px;
    text-transform: uppercase;
    font-size: 13px;
    margin-left: auto;
    margin-right: auto;
    font-weight: 600;
    margin-top: 3rem;
}
  </style>