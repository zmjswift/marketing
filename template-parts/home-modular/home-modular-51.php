<?php
$modular_title = $id['modular_title'] ?: exit('标题为空');
$moduler_desc = $id['modular_describe'] ?: '';
$mmodular_describe_color = $id['mmodular_describe_color'] ?: '';
$modular_51 = $id['add_modular_51'];

if( !empty( $modular_51 ) ){?>
<section style="margin-bottom: -40px;">
  <div class="container">
    <div class="section-title">
	<h2><?php echo $modular_title;?></h2>
    <p style="color: <?php echo $mmodular_describe_color; ?>;max-width: 1000px;"><?php echo $moduler_desc;?></p>
    </div>
</div>
</section>
	<div class="container">
	<div class="row modular15_wrapper">
    <?php
    echo '<div class="col-lg-12 modular15_img_box"><div class="row">';
    foreach ($modular_51 as $item) {
        $title_51 = $item['modular_51_title'];
		$img_51 = $item['modular_51_img']['url'];
		$stdcode = $item['modular_51_btnduan'];
		$icons_51 = $item['modular_51_icons'];
		$icon_size_51 = $item['modular_51_icon_size'];
		$icon_color_51 = $item['modular_51_icon_color'];
		$btn_title_51 = $item['title_51'];
		$btn_color_51 = $item['color_51'];
		$btn_bg_51 = $item['background_51'];
		$btn_link_51 = $item['link_51'];
        echo '<div class="col-lg-3 modular49_img_box" style="padding-right: 0;padding-left: 0;">
		<div class="bg" >
            <img loading="lazy" src="' . $img_51 . '" alt="' . $title_51 . '" style="border-radius: 0;"/>
            <p style="font-size: 16px;line-height: 1.4;font-weight: 600;margin-top: 10px;">' . $title_51 . '</p>
        </div>';
		echo '<div class="juzhong_m">';
		if(!empty($stdcode)){
			echo do_shortcode($stdcode);
		}else{
		echo '<a class="btn btn-outline-primary btn-outline-style" style="margin-left: 10px;height: 43px;padding: 10px 20px;color: '.$btn_color_51.';background-color: '.$btn_bg_51.';" href="'.$btn_link_51.'" target="_blank" rel="nofollow"><i class="'.$icons_51.'" style="margin-right: 10px;font-size: '.$icon_size_51.'rem;color: '.$icon_color_51.';"></i>'.$btn_title_51.'</a>';
	}
	echo '</div>';
	echo '</div>';
}
    echo '</div></div>';
    ?>
</div>
		</div>
	</div>
<?php }?>
<style>
.std-popup-trigger{border-radius: 5px!important;
    height: 43px!important;
    padding: 5px 15px!important;
	float: left;
	background-color: #fcab03!important;
}
.juzhong_m {
        float: none;
        margin: 0 auto;
        display: flex;
		justify-content: center;
		margin-top: 10px;
      }
	@media (max-width: 767px) {
      .juzhong_m {
        float: none;
        margin: 0 auto;
        display: flex;
		justify-content: center;
		margin: 10px 0px;
      }
	  .std-popup-trigger{
		float: none;
	  }
	}

	.row {
  display: flex;
  flex-wrap: wrap;
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
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1)
}
.bg {
  /*background: linear-gradient(to top, #eaf9ff 10%, #ffffff 70%); */
  padding: 10px 20px;
}

	</style>