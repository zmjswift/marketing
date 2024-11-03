<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';?>
<section class="testimonials-section pb-70 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
<div class="container">
	<?php if( $modular_title || $modular_describe ){?>
	<div class="section-title">
		<?php if( $modular_title ){ echo '<h2>'.$modular_title .'</h2>'; }?>
		<?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe .'</p>'; }?>
	</div>
	<?php }?>
	<div class="testimonials-post" style="background-image: url(<?php echo $id['modular_6_bgimg']['url'];?>);">
		<div class="col-md-12">
			<div id="testimonials_carousel" class="owl-carousel">
			    <?php
			    if( is_array($id['add_modular_6']) ){
			    foreach ( $id['add_modular_6'] as $value ): ?>
				<div class="item">
					<div class="testimonials-item">
						<div class="thumb">
							<img loading="lazy" src="<?php echo $value['modular_6_img']['url'];?>" alt="<?php echo get_post_meta( $value['modular_6_img']['id'], '_wp_attachment_image_alt', true );?>">
						</div>
						<div class="content">
							<p style="color: <?php echo $value['modular_6_describe_color'];?>;">
								<i class="fa fa-quote-left"></i><?php echo $value['modular_6_describe'];?><i class="fa fa-quote-right"></i>
							</p>
							<small><strong style="color: <?php echo $value['modular_6_title_color'];?>;"><?php echo $value['modular_6_title'];?></strong></small>
						</div>
					</div>
				</div>
			    <?php
			    endforeach;
			    }?>
			</div>
		</div>
	</div>
</div>
</section>
<style>
	.testimonials-post:after {
    background-color: <?php echo $id['modular_6_bg_color'];?>! important;
}
.testimonials-post {
    border: none !important;
}
	</style>