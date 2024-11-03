<?php
$modular_title = $id['modular_title'] ?: '';
$modular_describe = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';?>
<section class="home-modular-9 client-section style-2 pb-70 pt-70 modular_display_<?php echo $id['modular_display'];?> <?php if( $id['modular_bg_f9'] ){ echo 'bg-f9'; }?>">
<div class="container">
	<?php if( $modular_title || $modular_describe ){?>
	<div class="section-title">
		<?php if( $modular_title ){ echo '<h2>'.$modular_title.'</h2>'; }?>
		<?php if( $modular_describe ){ echo '<p style="color: '.$mmodular_describe_color.'">'.$modular_describe.'</p>'; }?>
	</div>
	<?php }?>
	<div class="row">
		<div class="col-md-12">
			<div id="client_carousel" class="owl-carousel">
			    <?php
			    if( ! empty($id['add_modular_9']) ){ // 必要时可通过php判断，项目数量超过6个在启用轮播显示......
			    foreach ( $id['add_modular_9'] as $value ): ?>
				<div class="item">
					<div class="client-img-item">
						<?php if($value['modular_9_url']){?>
							<a href="<?php echo $value['modular_9_url'];?>" target="_blank" rel="nofollow">
						<img loading="lazy" src="<?php echo $value['modular_9_img']['url'];?>" alt="<?php echo $value['modular_9_title'];?>">
						</a>
						<?php }else{?>
						<img loading="lazy" src="<?php echo $value['modular_9_img']['url'];?>" alt="<?php echo $value['modular_9_title'];?>">
						<?php }?>
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