<?php

$modular_49 = $id['modular_49'];
if( $modular_49['modular_49_img_circular'] ){
	$img_circular = 'style="border-radius:10px"';
}

if( !empty( $modular_49 ) ){?>
<section class="home-modular-15 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
	<div class="container">
		<div class="row modular15_wrapper">
			<?php if( $modular_49['modular_49_img_position'] == 'right' ){ ?>
			<div class="col-lg-6 modular15_text_box">
				<h3><?php echo $modular_49['modular_49_title'];?></h3>
				<?php echo wpautop( $modular_49['modular_49_desc'] );?>
				<div class="juzhong_m">
				<?php echo do_shortcode($modular_49['modular_49_btnduan']); ?>
				<?php if( $modular_49['module_49_button'] ){
					$module_49_button = $modular_49['module_49_button'];
					foreach ($module_49_button as $button) {
						$link_49 = $button['link_49'];
						$title_49 = $button['title_49'];
						$icons_49 = $button['modular_49_icons'];
						$size_49 = $button['modular_49_icon_size'];
						$icon_color_49 = $button['modular_49_icon_color'];
						$color_49 = $button['color_49'];
						$background_49 = $button['background_49'];
						echo '<a class="btn btn-outline-primary btn-outline-style" style="margin-left: 10px;height: 43px;padding: 10px 20px;color: '.$color_49.';background-color: '.$background_49.';" href="'.$link_49.'" target="_blank" rel="nofollow"><i class="'.$icons_49.'" style="margin-right: 10px;font-size: '.$size_49.'rem;color: '.$icon_color_49.';"></i>'.$title_49.'</a>';
					}
				}?>
			</div>
			</div>
			<?php }?>
			<?php if( $modular_49['module_49_img'] ){
				echo '<div class="col-lg-6 modular15_img_box"><div class="row">';
					$module_49_img = $modular_49['module_49_img'];
					foreach ($module_49_img as $Img_49) {
						$title_49 = $Img_49['title'];
						$img_49 = $Img_49['img']['url'];
						echo '<div class="col-lg-4 modular49_img_box">
						  <img loading="lazy" src="'.$img_49.'" alt="'.$title_49.'" />
						  <p style="font-size: 14px;line-height: 1.4;font-style: italic;margin-top: 5px;">'.$title_49.'</p>
						</div>';
					}
					echo '</div></div>';
				}?>
			<?php if( $modular_49['modular_49_img_position'] == 'left' ){ ?>
			<div class="col-lg-6 modular15_text_box">
				<h3><?php echo $modular_49['modular_49_title'];?></h3>
				<?php echo wpautop( $modular_49['modular_49_desc'] );?>
				<div class="juzhong_m">
				<?php echo do_shortcode($modular_49['modular_49_btnduan']); ?>
				<?php if( $modular_49['module_49_button'] ){
					$module_49_button = $modular_49['module_49_button'];
					foreach ($module_49_button as $button) {
						$link_49 = $button['link_49'];
						$title_49 = $button['title_49'];
						$icons_49 = $button['modular_49_icons'];
						$size_49 = $button['modular_49_icon_size'];
						$icon_color_49 = $button['modular_49_icon_color'];
						$color_49 = $button['color_49'];
						$background_49 = $button['background_49'];
						echo '<a class="btn btn-outline-primary btn-outline-style" style="margin-left: 10px;height: 43px;padding: 10px 20px;color: '.$color_49.';background-color: '.$background_49.';" href="'.$link_49.'" target="_blank" rel="nofollow"><i class="'.$icons_49.'" style="margin-right: 10px;font-size: '.$size_49.'rem;color: '.$icon_color_49.';"></i>'.$title_49.'</a>';
					}
				}?>
			</div>
			<?php }?>
			</div>
		</div>
	</div>
</section>
<?php }?>
<style>
.std-popup-trigger{border-radius: 5px!important;
    height: 43px!important;
    padding: 5px 15px!important;
	float: left;
	background-color: #fcab03!important;
}
	@media (max-width: 767px) {
      .juzhong_m {
        float: none;
        margin: 0 auto;
        display: flex;
		justify-content: center;
      }
	  .std-popup-trigger{
		float: none;
	  }
	}

	.row {
  display: flex;
  flex-wrap: wrap;
}

.col-lg-4 {
  width: 33.33%;
  padding: 10px;
  box-sizing: border-box;
}

.modular15_img_box {
  text-align: center;
}

.modular15_img_box img {
  max-width: 100%;
  height: auto;
}

.modular15_img_box h3 {
  margin-top: 10px;
}
.modular49_img_box img{
border-radius: 8px 8px 8px 8px;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.16)
}
	</style>