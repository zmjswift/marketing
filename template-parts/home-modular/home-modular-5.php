<?php $modular5_bg_color = isset( $id['modular5_bg_color'] ) ? $id['modular5_bg_color'] : '#091426';?>
<section class="home-modular-5 contact-divider pb-70 modular_display_<?php echo $id['modular_display'];?>" style="background-color:<?php echo $modular5_bg_color;?>">
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="contact-item">
				<?php if($id['modular5_subtitle']){ echo '<h5>'.$id['modular5_subtitle'].'</h5>'; }?>
				<?php if($id['modular5_title']){ echo '<h3>'.$id['modular5_title'].'</h3>'; }?>
				<?php if($id['modular5_describe']){ echo '<p>'.$id['modular5_describe'].'</p>'; }?>
			</div>
		</div>
		<div class="col-md-4 offset-md-0">
			<div class="contact-btn-item mt-3">
				<?php if($id['modular5_subtitle']){ echo '<a class="contact-btn style-1" href="'.$id['modular5_but_url'].'" target="_blank" rel="nofollow">'.$id['modular5_but_title'].'</a>'; }?>
				<?php if($id['modular5_phone']){ echo '<h3>'.$id['modular5_phone'].'</h3>'; }?>
			</div>
		</div>
	</div>
</div>
</section>