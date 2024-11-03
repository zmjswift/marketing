<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
?>
<section class="home-modular-16 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
	<div class="container">
		<?php if( $modular_title || $modular_describe ){?>
		<div class="section-title">
			<?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
			<?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; }?>
		</div>
		<?php }?>
		<?php if( $id['modular_16_img_url'] ){?>
		<a href="<?php echo $id['modular_16_img_url'];?>" target="_blank" rel="nofollow" aria-label="Read more about <?php echo $modular_title;?>">
			<img loading="lazy" src="<?php echo $id['modular_16_img']['url']; ?>" alt="<?php echo get_post_meta( $id['modular_16_img']['id'], '_wp_attachment_image_alt', true );?>" />
		</a>
		<?php }else{?>
		<img loading="lazy" src="<?php echo $id['modular_16_img']['url']; ?>" alt="<?php echo get_post_meta( $id['modular_16_img']['id'], '_wp_attachment_image_alt', true );?>" />
		<?php }?>
	</div>
</section>