<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
?>
<div class="why-choose-us">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
						<?php if( $modular_title ){ echo '<h3 class="section-title-one">'.$modular_title .'</h3>'; }?>
						<?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.';font-size: 16px;line-height: 26px;margin: 0 auto;max-width: 800px;margin-top: 15px;text-align: center;">'.$modular_describe .'</p>'; }?>
                            
                        </div>
                    </div>
                    <div class="row why-choose-us-box-wrapper">
					<?php
      if( ! empty($id['add_modular_39']) ){
      foreach ( $id['add_modular_39'] as $value ): ?>
                        <div class="col-lg-4 col-md-4">
                            <div class="why-choose-us-box">
                                <div class="icon">
								 <?php
						$features_icon = $value['modular_39_icons'];
						$icon_size = $value['modular_39_icon_size'];
						$icon_color = $value['modular_39_icon_color'];
						$modular_39_icon = $value['modular_39_img']['url'];
						?>
                                    <?php if(!empty($features_icon)):?>
						<i class="<?php echo $features_icon;?>" style="font-size: <?php echo $icon_size;?>rem;color: <?php echo $icon_color;?>;"></i>
						<?php endif;?>
						<?php if(!empty($modular_39_icon)):?>
            <img src="<?php echo $modular_39_icon;?>" alt="<?php echo $value['modular_39_title'];?>" />
            <?php endif;?>
                                </div>
								<?php if( $value['modular_39_title'] ):?>
                                <span class="title"><?php echo $value['modular_39_title'];?></span>
								<?php endif;?>
								<?php if( $value['modular_39_desc'] ):?>
                                <span class="text"><?php echo $value['modular_39_desc'];?></span>
								<?php endif;?>
                            </div>
                        </div>
						<?php
      endforeach;
      }?>
                </div>
            </div>
			</div>