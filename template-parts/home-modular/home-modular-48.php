<?php

$modular_48 = $id['modular_48'];
if( $modular_48['modular_48_img_circular'] ){
	$img_circular = 'style="border-radius:10px"';
}

if( !empty( $modular_48 ) ){?>
<section class="home-modular-15 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
	<div class="container">
		<div class="row modular15_wrapper">
			<?php if( $modular_48['modular_48_img_position'] == 'right' ){ ?>
			<div class="col-lg-6 modular15_text_box">
				<h3><?php echo $modular_48['modular_48_title'];?></h3>
				<?php echo wpautop( $modular_48['modular_48_desc'] );?>
				<div class="juzhong_m">
				<?php echo do_shortcode($modular_48['modular_48_btnduan']); ?>
				<?php if( $modular_48['module_48_button'] ){
					$module_48_button = $modular_48['module_48_button'];
					foreach ($module_48_button as $button) {
						$link_48 = $button['link_48'];
						$title_48 = $button['title_48'];
						$icons_48 = $button['modular_48_icons'];
						$size_48 = $button['modular_48_icon_size'];
						$icon_color_48 = $button['modular_48_icon_color'];
						$color_48 = $button['color_48'];
						$background_48 = $button['background_48'];
						echo '<a class="btn btn-outline-primary btn-outline-style" style="margin-left: 10px;height: 43px;padding: 10px 20px;color: '.$color_48.';background-color: '.$background_48.';" href="'.$link_48.'" target="_blank" rel="nofollow"><i class="'.$icons_48.'" style="margin-right: 10px;font-size: '.$size_48.'rem;color: '.$icon_color_48.';"></i>'.$title_48.'</a>';
					}
				}?>
			</div>
			</div>
			<?php }?>
			<?php if( $modular_48['modular_48_media_type'] == 'img' ){?>
			<div class="col-lg-6 modular15_img_box">
				<img loading="lazy" src="<?php echo $modular_48['modular_48_img']['url'];?>" alt="<?php echo get_post_meta( $modular_48['modular_48_img']['id'], '_wp_attachment_image_alt', true );?>" <?php echo $img_circular;?> />
			</div>
			<?php }?>
			<?php if( $modular_48['modular_48_media_type'] == 'gallery' ){?>
			<div class="col-lg-6 modular15_img_box img-grids">
			<?php
			if( ! empty( $modular_48['modular_48_gallery'] ) ) :
				$gallery = explode( ',', $modular_48['modular_48_gallery'] );
				foreach ( $gallery as $id ) :
				$img_url = wp_get_attachment_image_src( $id, 'full' );
				?>
				<a data-fancybox href="<?php echo $img_url[0];?>" rel="nofollow">
					<img loading="lazy" src="<?php echo $img_url[0];?>" alt="<?php echo get_post_meta( $id, '_wp_attachment_image_alt', true );?>" <?php echo $img_circular;?> />
				</a>
			<?php
				endforeach;
			endif;
			?>
			</div>
			<?php }?>
			<?php if( $modular_48['modular_48_media_type'] == 'video' ){
			
			$md5_title = md5( $modular_48['modular_48_title'] );

			?>
			<div class="col-lg-6 modular15_img_box">
			    <img loading="lazy" src="<?php echo $modular_48['modular_48_video_img']['url'];?>" alt="<?php echo get_post_meta( $modular_48['modular_48_video_img']['id'], '_wp_attachment_image_alt', true );?>" <?php echo $img_circular;?> />
			    <a data-fancybox href="#a<?php echo $md5_title;?>" class="play-view text-center position-absolute" rel="nofollow">
					<span class="video-play-icon">
					<i class="fa fa-play"></i>
					</span>
				</a>
				<video loading="lazy" controls id="a<?php echo $md5_title;?>" style="display:none;">
				    <source src="<?php echo $modular_48['modular_48_video'];?>" type="video/mp4">
				</video>
			</div>
			<?php }?>
			<?php if( $modular_48['modular_48_img_position'] == 'left' ){ ?>
			<div class="col-lg-6 modular15_text_box">
				<h3><?php echo $modular_48['modular_48_title'];?></h3>
				<?php echo wpautop( $modular_48['modular_48_desc'] );?>
				<div class="juzhong_m">
				<?php echo do_shortcode($modular_48['modular_48_btnduan']); ?>
				<?php if( $modular_48['module_48_button'] ){
					$module_48_button = $modular_48['module_48_button'];
					foreach ($module_48_button as $button) {
						$link_48 = $button['link_48'];
						$title_48 = $button['title_48'];
						$icons_48 = $button['modular_48_icons'];
						$size_48 = $button['modular_48_icon_size'];
						$icon_color_48 = $button['modular_48_icon_color'];
						$color_48 = $button['color_48'];
						$background_48 = $button['background_48'];
						echo '<a class="btn btn-outline-primary btn-outline-style" style="margin-left: 10px;height: 43px;padding: 10px 20px;color: '.$color_48.';background-color: '.$background_48.';" href="'.$link_48.'" target="_blank" rel="nofollow"><i class="'.$icons_48.'" style="margin-right: 10px;font-size: '.$size_48.'rem;color: '.$icon_color_48.';"></i>'.$title_48.'</a>';
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
	</style>