<?php

$modular_15 = $id['modular_15'];
if( $modular_15['modular_15_img_circular'] ){
	$img_circular = 'style="border-radius:10px"';
}

if( !empty( $modular_15 ) ){?>
<section class="home-modular-15 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
	<div class="container">
		<div class="row modular15_wrapper">
			<?php if( $modular_15['modular_15_img_position'] == 'right' ){ ?>
			<div class="col-lg-6 modular15_text_box">
				<h3><?php echo $modular_15['modular_15_title'];?></h3>
				<?php echo wpautop( $modular_15['modular_15_desc'] );?>
				<?php if( $modular_15['modular_15_btn'] || $modular_15['modular_15_btn_url'] ){
					echo '<a class="btn btn-outline-primary btn-outline-style mt-4" href="'.$modular_15['modular_15_btn_url'].'" target="_blank" rel="nofollow">'.$modular_15['modular_15_btn'].'</a>';
				}?>
			</div>
			<?php }?>
			<?php if( $modular_15['modular_15_media_type'] == 'img' ){?>
			<div class="col-lg-6 modular15_img_box">
				<img loading="lazy" src="<?php echo $modular_15['modular_15_img']['url'];?>" alt="<?php echo get_post_meta( $modular_15['modular_15_img']['id'], '_wp_attachment_image_alt', true );?>" <?php echo $img_circular;?> />
			</div>
			<?php }?>
			<?php if( $modular_15['modular_15_media_type'] == 'gallery' ){?>
			<div class="col-lg-6 modular15_img_box img-grids">
			<?php
			if( ! empty( $modular_15['modular_15_gallery'] ) ) :
				$gallery = explode( ',', $modular_15['modular_15_gallery'] );
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
			<?php if( $modular_15['modular_15_media_type'] == 'video' ){
			
			$md5_title = md5( $modular_15['modular_15_title'] );

			?>
			<div class="col-lg-6 modular15_img_box">
			    <img loading="lazy" src="<?php echo $modular_15['modular_15_video_img']['url'];?>" alt="<?php echo get_post_meta( $modular_15['modular_15_video_img']['id'], '_wp_attachment_image_alt', true );?>" <?php echo $img_circular;?> />
			    <a data-fancybox href="#a<?php echo $md5_title;?>" class="play-view text-center position-absolute" rel="nofollow">
					<span class="video-play-icon">
					<i class="fa fa-play"></i>
					</span>
				</a>
				<video loading="lazy" controls id="a<?php echo $md5_title;?>" style="display:none;">
				    <source src="<?php echo $modular_15['modular_15_video'];?>" type="video/mp4">
				</video>
			</div>
			<?php }?>
			<?php if( $modular_15['modular_15_img_position'] == 'left' ){ ?>
			<div class="col-lg-6 modular15_text_box">
				<h3><?php echo $modular_15['modular_15_title'];?></h3>
				<?php echo wpautop( $modular_15['modular_15_desc'] );?>
				<?php if( $modular_15['modular_15_btn'] || $modular_15['modular_15_btn_url'] ){
					echo '<a class="btn btn-outline-primary btn-outline-style mt-4" href="'.$modular_15['modular_15_btn_url'].'" target="_blank" rel="nofollow">'.$modular_15['modular_15_btn'].'</a>';
				}?>
			</div>
			<?php }?>
		</div>
	</div>
</section>
<?php }?>